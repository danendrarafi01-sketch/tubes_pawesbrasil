<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Es Kopi Brasil</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('/images/bg-toko.jpeg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            background: rgba(255, 255, 255, 0.95);
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 100;
            display: flex;
            flex-direction: column;
        }

        .logo-area {
            text-align: center;
            padding: 30px 20px;
            border-bottom: 1px solid #eee;
        }

        .logo-area img {
            width: 120px;
            height: auto;
        }

        .nav-menu {
            flex: 1;
            padding: 20px 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            margin: 5px 15px;
            cursor: pointer;
            border-radius: 10px;
            transition: all 0.3s;
        }

        .nav-item.active {
            background: #dc3545;
        }

        .nav-item.active .nav-text {
            color: white;
        }

        .nav-item:hover:not(.active) {
            background: #f0f0f0;
        }

        .nav-icon {
            font-size: 20px;
            margin-right: 15px;
        }

        .nav-text {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .divider {
            height: 1px;
            background: #eee;
            margin: 10px 25px;
        }

        .logout-area {
            padding: 20px 0;
            border-top: 1px solid #eee;
        }

        .logout-item {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            margin: 5px 15px;
            cursor: pointer;
            border-radius: 10px;
        }

        .logout-item:hover {
            background: #f0f0f0;
        }

        .logout-text {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .main-content {
            margin-left: 280px;
            padding: 20px;
        }

        .top-bar {
            background: rgba(255, 255, 255, 0.95);
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            color: #1a472a;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .card h3 {
            color: #1a472a;
            margin-bottom: 10px;
        }

        .status-pending {
            color: orange;
            font-weight: bold;
        }

        .status-success {
            color: green;
            font-weight: bold;
        }

        .status-failed {
            color: red;
            font-weight: bold;
        }

        .btn-back {
            background: #6c757d;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo-area">
            <img src="/images/LogoBrasilMerah.png" alt="Logo Brasil">
        </div>
        <div class="nav-menu">
            <div class="nav-item" onclick="location.href='/dashboard'">
                <div class="nav-icon">📊</div>
                <span class="nav-text">Dashboard</span>
            </div>
            <div class="nav-item" onclick="location.href='/produk'">
                <div class="nav-icon">📦</div>
                <span class="nav-text">Produk</span>
            </div>
            <div class="nav-item active" onclick="location.href='/orders'">
                <div class="nav-icon">📝</div>
                <span class="nav-text">Pesanan</span>
            </div>
            <div class="nav-item" onclick="location.href='/stok'">
                <div class="nav-icon">📊</div>
                <span class="nav-text">Stok</span>
            </div>
        </div>
        <div class="logout-area">
            <div class="logout-item" onclick="document.getElementById('logout-form').submit()">
                <div class="nav-icon">🚪</div>
                <span class="logout-text">Keluar</span>
            </div>
        </div>
        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">@csrf</form>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="page-title">Riwayat Pesanan</div>
            <div>Halo, {{ Auth::user()->name }}</div>
        </div>

        <button class="btn-back" onclick="location.href='/orders'">← Kembali ke Pesanan</button>

        @forelse ($transactions as $transaction)
        <div class="card">
            <h3>Pesanan: {{ $transaction->order_id }}</h3>
            <p>Tanggal: {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
            <p>Status: 
                @if($transaction->payment_status == 'pending')
                    <span class="status-pending">Menunggu Pembayaran</span>
                @elseif($transaction->payment_status == 'success')
                    <span class="status-success">Sukses</span>
                @else
                    <span class="status-failed">Gagal</span>
                @endif
            </p>
            <p>Total: Rp {{ number_format($transaction->gross_amount, 0, ',', '.') }}</p>
            
            <h4>Detail Produk:</h4>
            <table>
                <thead>
                    <tr><th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th></tr>
                </thead>
                <tbody>
                    @foreach ($transaction->details as $detail)
                    <tr>
                        <td>{{ $detail->produk->nama_produk }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @empty
        <div class="card">
            <p style="text-align: center;">Belum ada riwayat pesanan.</p>
        </div>
        @endforelse
    </div>
</body>
</html>