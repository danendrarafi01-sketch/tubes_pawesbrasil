<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perbarui Stok - Es Kopi Brasil</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
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
        }

        .card-header {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .card-header h2 {
            font-size: 20px;
            color: #1a472a;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group select,
        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .btn-submit {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-back {
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-left: 10px;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
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
            <div class="nav-item active">
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
            <div class="page-title">Perbarui Stok</div>
            <div>Halo, Selamat Datang di Website Manajemen Stok</div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>✏️ Form Perbarui Stok Barang</h2>
            </div>

            @if ($errors->any())
                <div class="alert-error">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('stok.perbarui.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Pilih Produk</label>
                    <select name="produk_id" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($produks as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_produk }} (Stok saat ini: {{ $item->stok }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jumlah Stok Baru</label>
                    <input type="number" name="jumlah_stok" placeholder="Masukkan jumlah stok" min="0" required>
                </div>

                <button type="submit" class="btn-submit">Simpan Perubahan</button>
                <a href="{{ route('stok.index') }}" class="btn-back">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>