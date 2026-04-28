<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\NewTransaction;
use App\Models\NewTransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class OrderController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
        
        Log::info('Midtrans Config Loaded', [
            'server_key' => Config::$serverKey ? 'Set' : 'Not Set',
            'client_key' => Config::$clientKey ? 'Set' : 'Not Set',
            'is_production' => Config::$isProduction
        ]);
    }

    // Menampilkan halaman pemesanan
    public function index()
    {
        $produks = Produk::orderBy('nama_produk', 'asc')->get();
        return view('orders.index', compact('produks'));
    }

    // Memproses pesanan
    public function process(Request $request)
    {
        try {
            Log::info('Order process started', ['items' => $request->items]);
            
            $request->validate([
                'items' => 'required|array',
                'items.*.id' => 'required|exists:produk,id',
                'items.*.qty' => 'required|integer|min:1',
            ]);

            $user = Auth::user();
            if (!$user) {
                Log::error('User not authenticated');
                return response()->json(['error' => 'User tidak terautentikasi'], 401);
            }
            
            $items = $request->items;

            // Hitung total harga dan validasi stok
            $grossAmount = 0;
            foreach ($items as $item) {
                $produk = Produk::find($item['id']);
                if (!$produk) {
                    return response()->json(['error' => 'Produk tidak ditemukan!'], 404);
                }
                if ($produk->stok < $item['qty']) {
                    return response()->json(['error' => "Stok {$produk->nama_produk} tidak mencukupi! (Sisa: {$produk->stok})"], 400);
                }
                $grossAmount += $produk->harga * $item['qty'];
            }

            // Simpan transaksi ke database
            $transaction = NewTransaction::create([
                'user_id' => $user->id,
                'order_id' => 'ORDER-' . time() . '-' . $user->id,
                'gross_amount' => $grossAmount,
                'payment_status' => 'pending',
            ]);

            Log::info('Transaction created', ['order_id' => $transaction->order_id]);

            // Simpan detail transaksi
            foreach ($items as $item) {
                $produk = Produk::find($item['id']);
                NewTransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'produk_id' => $produk->id,
                    'quantity' => $item['qty'],
                    'price' => $produk->harga,
                ]);
            }

            // Siapkan payload untuk Midtrans
            $payload = [
                'transaction_details' => [
                    'order_id' => $transaction->order_id,
                    'gross_amount' => $grossAmount,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone ?? '08123456789',
                ],
                'item_details' => [],
                'enabled_payments' => [
                    'credit_card',
                    'gopay',
                    'shopeepay',
                    'bank_transfer',
                    'bca_klikpay',
                    'bri_epay',
                    'cimb_clicks',
                    'danamon_online',
                    'akulaku',
                    'kredivo',
                    'indomaret',
                    'alfamart',
                ],
                'credit_card' => [
                    'secure' => true,
                ],
            ];

            foreach ($items as $item) {
                $produk = Produk::find($item['id']);
                $payload['item_details'][] = [
                    'id' => $produk->id,
                    'price' => (int)$produk->harga,
                    'quantity' => (int)$item['qty'],
                    'name' => $produk->nama_produk,
                ];
            }

            // Snap Token dari Midtrans
            try {
                Log::info('Calling Midtrans API for snap token', ['order_id' => $transaction->order_id]);
                $snapToken = Snap::getSnapToken($payload);
                $transaction->snap_token = $snapToken;
                $transaction->save();

                Log::info('Snap token generated successfully', ['snap_token' => $snapToken]);

                return response()->json([
                    'snap_token' => $snapToken,
                    'transaction_id' => $transaction->id,
                ]);
            } catch (\Exception $e) {
                Log::error('Midtrans API Error: ' . $e->getMessage());
                $transaction->delete();
                return response()->json(['error' => 'Midtrans Error: ' . $e->getMessage()], 500);
            }
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error: ' . json_encode($e->errors()));
            return response()->json(['error' => 'Validasi gagal: ' . json_encode($e->errors())], 422);
        } catch (\Exception $e) {
            Log::error('Order process error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    // Notifikasi dari Midtrans (Webhook)
    public function notificationHandler(Request $request)
    {
        Log::info('Notification received', $request->all());
        
        try {
            $notif = new Notification();

            DB::beginTransaction();
            $transaction = NewTransaction::where('order_id', $notif->order_id)->first();
            if (!$transaction) {
                Log::error('Transaction not found: ' . $notif->order_id);
                return response()->json(['message' => 'Transaction not found'], 404);
            }

            Log::info('Transaction found', ['order_id' => $transaction->order_id, 'status' => $transaction->payment_status]);

            if ($transaction->payment_status === 'pending') {
                if ($notif->transaction_status == 'capture' || $notif->transaction_status == 'settlement') {
                    $transaction->payment_status = 'success';
                    Log::info('Payment success, updating stock');
                    // Kurangi stok produk
                    foreach ($transaction->details as $detail) {
                        $produk = $detail->produk;
                        $produk->stok -= $detail->quantity;
                        $produk->save();
                        Log::info('Stock updated', ['product' => $produk->nama_produk, 'new_stock' => $produk->stok]);
                    }
                } elseif ($notif->transaction_status == 'deny' || $notif->transaction_status == 'cancel' || $notif->transaction_status == 'expire') {
                    $transaction->payment_status = 'failed';
                    Log::info('Payment failed', ['status' => $notif->transaction_status]);
                }

                $transaction->payment_type = $notif->payment_type;
                $transaction->payment_details = json_encode($notif);
                $transaction->save();
            }

            DB::commit();
            return response()->json(['message' => 'Notification handled successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Notification error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Callback Success
    public function callbackSuccess(Request $request)
    {
        $orderId = $request->query('order_id');
        Log::info('Callback success called', ['order_id' => $orderId]);
        
        $transaction = NewTransaction::where('order_id', $orderId)->first();
        
        if ($transaction && $transaction->payment_status !== 'success') {
            // UPDATE STATUS MENJADI SUCCESS
            $transaction->payment_status = 'success';
            $transaction->save();
            
            // UPDATE STOK PRODUK
            foreach ($transaction->details as $detail) {
                $produk = Produk::find($detail->produk_id);
                if ($produk) {
                    $produk->stok -= $detail->quantity;
                    $produk->save();
                    Log::info('Stock updated via callback', ['product' => $produk->nama_produk, 'new_stock' => $produk->stok]);
                }
            }
        }
        
        return view('callback.index', [
            'status' => 'success',
            'transaction' => $transaction
        ]);
    }

    // Callback Pending
    public function callbackPending(Request $request)
    {
        $orderId = $request->query('order_id');
        $transaction = NewTransaction::where('order_id', $orderId)->first();
        
        return view('callback.index', [
            'status' => 'pending',
            'transaction' => $transaction
        ]);
    }

    // Callback Error
    public function callbackError(Request $request)
    {
        $orderId = $request->query('order_id');
        $transaction = NewTransaction::where('order_id', $orderId)->first();
        
        return view('callback.index', [
            'status' => 'failed',
            'transaction' => $transaction
        ]);
    }

    // Riwayat transaksi user
    public function history()
    {
        $transactions = NewTransaction::with('details.produk')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('orders.history', compact('transactions'));
    }
}