<?php

namespace App\Http\Controllers;

use App\Models\NewTransaction;
use App\Models\NewTransactionDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentCallbackController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('Payment Callback Received:', $request->all());

        try {
            DB::beginTransaction();

            // Ambil data dari request
            $orderId = $request->order_id;
            $transactionStatus = $request->transaction_status;
            $statusCode = $request->status_code;
            $paymentType = $request->payment_type;

            // Cari transaksi berdasarkan order_id
            $transaction = NewTransaction::where('order_id', $orderId)->first();

            if (!$transaction) {
                Log::error('Transaction not found: ' . $orderId);
                return response()->json(['message' => 'Transaction not found'], 404);
            }

            // Proses berdasarkan status dari Midtrans
            if ($statusCode == '200') {
                // Pembayaran berhasil
                if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                    $transaction->payment_status = 'success';
                    
                    // Kurangi stok
                    $details = NewTransactionDetail::where('transaction_id', $transaction->id)->get();
                    foreach ($details as $detail) {
                        $produk = Produk::find($detail->produk_id);
                        if ($produk) {
                            $produk->stok -= $detail->quantity;
                            $produk->save();
                            
                            Log::info("Stock updated for product {$produk->nama_produk}: New stock = {$produk->stok}");
                        }
                    }
                } elseif ($transactionStatus == 'pending') {
                    $transaction->payment_status = 'pending';
                } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                    $transaction->payment_status = 'failed';
                }
            } elseif ($statusCode == '201') {
                // Pending
                $transaction->payment_status = 'pending';
            } elseif ($statusCode == '202') {
                // Deny
                $transaction->payment_status = 'failed';
            } elseif ($statusCode == '407') {
                // Expire
                $transaction->payment_status = 'failed';
            }

            $transaction->payment_type = $paymentType;
            $transaction->payment_details = json_encode($request->all());
            $transaction->save();

            DB::commit();

            Log::info("Transaction {$orderId} updated to {$transaction->payment_status}");
            
            return response()->json(['message' => 'OK'], 200);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Callback Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Test endpoint untuk manual success
    public function manualSuccess(Request $request)
    {
        $orderId = $request->query('order_id');
        
        if (!$orderId) {
            return response()->json(['error' => 'order_id required'], 400);
        }
        
        try {
            DB::beginTransaction();
            
            $transaction = NewTransaction::where('order_id', $orderId)->first();
            
            if (!$transaction) {
                return response()->json(['error' => 'Transaction not found'], 404);
            }
            
            if ($transaction->payment_status != 'success') {
                $transaction->payment_status = 'success';
                $transaction->save();
                
                // Kurangi stok
                $details = NewTransactionDetail::where('transaction_id', $transaction->id)->get();
                foreach ($details as $detail) {
                    $produk = Produk::find($detail->produk_id);
                    if ($produk) {
                        $produk->stok -= $detail->quantity;
                        $produk->save();
                    }
                }
            }
            
            DB::commit();
            
            return redirect()->route('orders.history')->with('success', 'Pembayaran berhasil!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}