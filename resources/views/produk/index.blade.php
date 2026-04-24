    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Produk - Es Kopi Brasil</title>
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

            /* SIDEBAR */
            .sidebar {
                width: 280px;
                height: 100vh;
                background: white;
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
                width: 80px;
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
                background: white;
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

            .user-name {
                font-size: 14px;
                color: #333;
            }

            /* CARD */
            .card {
                background: white;
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

            .btn-add {
                background: #28a745;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
                text-decoration: none;
                display: inline-block;
            }

            .btn-add:hover {
                background: #218838;
            }

            /* TABLE */
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

            td {
                font-size: 14px;
                color: #333;
            }

            tr:hover {
                background: #f9f9f9;
            }

            /* ACTION BUTTONS */
            .btn-edit {
                background: #ffc107;
                color: #333;
                border: none;
                padding: 5px 12px;
                border-radius: 3px;
                cursor: pointer;
                font-size: 12px;
                margin-right: 5px;
                text-decoration: none;
                display: inline-block;
            }

            .btn-delete {
                background: #dc3545;
                color: white;
                border: none;
                padding: 5px 12px;
                border-radius: 3px;
                cursor: pointer;
                font-size: 12px;
            }

            /* PAGINATION */
            .pagination {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 20px;
                padding-top: 15px;
                border-top: 1px solid #eee;
            }

            .pagination-links {
                display: flex;
                gap: 5px;
            }

            .pagination-links a, .pagination-links span {
                padding: 8px 12px;
                border: 1px solid #ddd;
                border-radius: 5px;
                text-decoration: none;
                color: #333;
                font-size: 14px;
            }

            .pagination-links a:hover {
                background: #1a472a;
                color: white;
                border-color: #1a472a;
            }

            .pagination-links .active {
                background: #1a472a;
                color: white;
                border-color: #1a472a;
            }

            .empty {
                text-align: center;
                padding: 40px;
                color: #999;
            }

            /* BOTTOM MENU */
            .bottom-menu {
                margin-top: auto;
                padding-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="logo-area" style="text-align: center; padding: 30px 20px 10px 20px;">
                <img src="/images/LogoBrasilMerah.png" 
                alt="Logo Brasil" 
                style="width: 150px; height: auto; margin-bottom: 10px;">
            </div>
            
            <div class="nav-menu">
                <div class="nav-item" onclick="location.href='/dashboard'">
                    <div class="nav-icon">📊</div>
                    <span class="nav-text">Dashboard</span>
                </div>
                <div class="nav-item active">
                    <div class="nav-icon">📦</div>
                    <span class="nav-text">Produk</span>
                </div>
                <div class="nav-item" onclick="location.href='/orders'">
                    <div class="nav-icon">📝</div>
                    <span class="nav-text">Pesanan</span>
                </div>
                <div class="nav-item" onclick="location.href='/stok'">
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
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>
        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <!-- TOP BAR -->
            <div class="top-bar">
                <div class="page-title">Daftar Produk</div>
                <div class="user-info">
                    <span class="user-name">Halo, Selamat Datang di Website Manajemen Stok</span>
                </div>
            </div>

            <!-- CARD PRODUK -->
            <div class="card">
                <div class="card-header">
                    <h2>📋 Daftar Produk</h2>
                    <a href="{{ route('produk.create') }}" class="btn-add">+ Tambah Produk</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nama Produk</th>
                            <th>SKU Produk</th>
                            <th>Harga Produk</th>
                            <th>Jumlah Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produks as $index => $produk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($produk->foto)
                                <img src="{{ asset('storage/' . $produk->foto) }}" 
                                style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                @else
                                <span style="color: #999; font-size: 12px;">Tidak ada foto</span>
                                @endif
                            </td>
                            <td>{{ $produk->nama_produk }}</td>
                            <td>{{ $produk->sku }}</td>
                            <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td>{{ $produk->stok }}</td>
                            <td>
                                <a href="{{ route('produk.edit', $produk->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="empty">Belum ada data produk. Silakan tambah produk terlebih dahulu.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Tampilkan jumlah total produk -->
                 <div style="margin-top: 20px; padding: 15px; background: #1a472a; border-radius: 8px; text-align: center;">
                    <strong style="color: white;">Total Produk:</strong> <span style="color: white;">{{ $produks->count() }} produk</span>
                </div>
            </div>