<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Es Kopi Brasil</title>
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

        .user-name {
            font-size: 14px;
            color: #333;
        }

        /* CARD */
        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
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

        /* FORM */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #1a472a;
        }

        .form-group .error {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .btn-submit {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-submit:hover {
            background: #218838;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-cancel:hover {
            background: #5a6268;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .current-photo {
            margin: 10px 0;
        }
        .current-photo img {
            max-width: 150px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <!-- SIDEBAR -->
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
            <div class="nav-item" onclick="alert('Fitur sedang dalam pengembangan')">
                <div class="nav-icon">📝</div>
                <span class="nav-text">Pesanan</span>
            </div>
            <div class="nav-item" onclick="alert('Fitur sedang dalam pengembangan')">
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
            <div class="page-title">Edit Produk</div>
            <div class="user-info">
                <span class="user-name">Halo, {{ Auth::user()->name }}</span>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="card">
            <div class="card-header">
                <h2>✏️ Edit Produk: {{ $produk->nama_produk }}</h2>
            </div>

            @if ($errors->any())
                <div class="alert-error">
                    <ul style="margin-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Produk *</label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                    @error('nama_produk') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>SKU *</label>
                    <input type="text" name="sku" value="{{ old('sku', $produk->sku) }}" required>
                    @error('sku') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Harga (Rp) *</label>
                    <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" min="0" required>
                    @error('harga') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Stok *</label>
                    <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" min="0" required>
                    @error('stok') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Foto Saat Ini</label>
                    <div class="current-photo">
                        @if($produk->foto)
                            <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto Produk">
                        @else
                            <p>Tidak ada foto</p>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label>Ganti Foto Produk</label>
                    <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg">
                    <small style="color: #666;">Format: JPG, PNG. Maks 2MB. Kosongkan jika tidak ingin mengganti.</small>
                    @error('foto') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" rows="4">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                    @error('deskripsi') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Update Produk</button>
                    <a href="{{ route('produk.index') }}" class="btn-cancel">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 