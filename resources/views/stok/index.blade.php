<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok - Es Kopi Brasil</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('/images/bg-toko.jpeg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

        /* SIDEBAR */
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

        /* MAIN CONTENT */
        .main-content {
            margin-left: 280px;
            padding: 20px;
        }

        /* TOP BAR */
        .top-bar {
            background: rgba(255, 255, 255, 0.95);
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            color: #1a472a;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* CARD */
        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            padding: 25px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .card-header h2 {
            font-size: 20px;
            color: #1a472a;
        }

        .btn-perbarui {
            background: #17a2b8;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-perbarui:hover {
            background: #138496;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #555;
            font-size: 14px;
        }

        .stok-badge {
            background: #1a472a;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            display: inline-block;
        }

        .stok-rendah {
            background: #dc3545;
        }

        .btn-edit-produk {
            background: #ffc107;
            color: #333;
            border: none;
            padding: 5px 12px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            text-decoration: none;
            display: inline-block;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .total-stok {
            margin-top: 20px;
            padding: 15px;
            background: #1a472a;
            color: white;
            border-radius: 8px;
            text-align: center;
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
            <div class="nav-item" onclick="location.href='/orders'">
                <div class="nav-icon">📝</div>
                <span class="nav-text">Pesanan</span>
            </div>
            <div class="nav-item active">
                <div class="nav-icon">📊</div>
                <span class="nav-text">Stok</span>
            </div>
            <div class="nav-item" onclick="alert('Fitur sedang dalam pengembangan')">
                <div class="nav-icon">🏪</div>
                <span class="nav-text">Reseller</span>
            </div>
            <div class="nav-item" onclick="alert('Fitur sedang dalam pengembangan')">
                <div class="nav-icon">📈</div>
                <span class="nav-text">Statistik</span>
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
            <div class="page-title">Daftar Stok</div>
            <div class="user-info">
                <span>Halo, Selamat Datang di Website Manajemen Stok</span>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>📊 Daftar Stok Barang</h2>
                <a href="{{ route('stok.perbarui') }}" class="btn-perbarui">✏️ Perbarui Stok</a>
            </div>

            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 5px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>SKU</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                            @else
                                <span style="color: #999;">-</span>
                            @endif
                        </td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->sku }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="stok-badge {{ $item->stok < 50 ? 'stok-rendah' : '' }}">
                                {{ $item->stok }} unit
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('produk.edit', $item->id) }}" class="btn-edit-produk">Edit Produk</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="empty">Belum ada data produk. Silakan tambah produk terlebih dahulu.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="total-stok">
                <strong>Total Stok Keseluruhan:</strong> {{ $produk->sum('stok') }} unit
            </div>
        </div>
    </div>
</body>
</html>