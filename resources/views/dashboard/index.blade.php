<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Es Kopi Brasil</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: url('/images/bg-toko.jpeg') no-repeat center center fixed;
            background-size: cover;
            overflow-x: hidden;
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
            font-size: 24px;
            margin-right: 15px;
        }

        .nav-text {
            font-size: 16px;
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
            font-size: 16px;
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
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .search-box {
            width: 400px;
            height: 40px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px 16px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
        }

        .top-menu {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .top-menu a {
            text-decoration: none;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: #d9d9d9;
            border-radius: 50%;
        }

        /* CARDS */
        /* PROFILE CARD */
        .profile-card {
            display: flex;
            gap: 30px;
            align-items: center;
            flex-wrap: wrap;
        }
        .profile-card img {
            width: 250px;  /* ukuran tetap */
            height: 160px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2)
        }
        .card-white {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 800;
            color: #1a472a;
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #1a472a;
            display: inline-block;
            width: 100%;
        }

        .profile-wrapper {
            display: flex;
            gap: 30px;
            align-items: center;
            flex-wrap: wrap;
        }

        .profile-info {
            flex: 2;
        }

        .shop-name {
            font-size: 24px;
            font-weight: bold;
            color: #1a472a;
            margin-bottom: 10px;
        }

        .address {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .google-maps {
            display: inline-block;
            background: #1a472a;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .profile-image {
            flex: 1;
            text-align: center;
        }

        .profile-image img {
            width: 100%;
            max-width: 250px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* GALLERY */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .gallery-img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }

        /* DESCRIPTION */
        .description {
            font-size: 14px;
            line-height: 1.8;
            text-align: justify;
            color: #444;
        }

        /* BOTTOM GRID */
        .bottom-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .info-panel {
            background: #1a472a;
            padding: 25px;
            color: white;
            border-radius: 10px;
        }

        .info-panel h3 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(255,255,255,0.3);
        }

        .info-panel ul {
            list-style: none;
        }

        .info-panel li {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .info-panel .social {
            font-size: 14px;
        }

        .info-panel a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            display: block;
            margin-bottom: 10px;
        }

        .info-panel a:hover {
            text-decoration: underline;
        }

        @media (max-width: 1200px) {
            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            .bottom-grid {
                grid-template-columns: 1fr;
            }
            .profile-wrapper {
                flex-direction: column;
                text-align: center;
            }
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
        <div class="nav-item active">
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
        <div class="nav-item" onclick="location.href='/stok'">
            <div class="nav-icon">📊</div>
            <span class="nav-text">Stok</span>
        </div>
        <div class="divider"></div>
        <div class="nav-item" onclick="alert('Fitur sedang dalam pengembangan')">
            <div class="nav-icon">🏪</div>
            <span class="nav-text">Reseller</span>
        </div>
        <div class="divider"></div>
        <div class="nav-item" onclick="alert('Fitur sedang dalam pengembangan')">
            <div class="nav-icon">📈</div>
            <span class="nav-text">Statistik</span>
        </div>
    </div>
    
    <div class="logout-area">
        <div class="divider"></div>
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
            <input type="text" class="search-box" placeholder="Cari produk di sini">
            <div class="top-menu">
                <a href="#" onclick="alert('Fitur sedang dalam pengembangan')">HUBUNGI KAMI</a>
                <a href="#" onclick="alert('Fitur sedang dalam pengembangan')">FAQ</a>
                <div class="avatar"></div>
            </div>
        </div>

        <!-- PROFIL PERUSAHAAN TITLE -->
        <div class="card-white">
            <h2 class="section-title">PROFIL PERUSAHAAN</h2>
            
            <!-- PROFILE CARD -->
            <div class="profile-card">
                <img src="{{ asset('images/bg-toko.jpeg') }}" class="profile-image" onerror="this.src='https://via.placeholder.com/253x135?text=Toko'">
                <div>
                    <div class="shop-name">ES KOPI & BRASIL</div>
                    <div class="address">
                        Jl. Jendral Suprapto No.25, Kauman Lama, Purwokerto Lor,<br>
                        Kec. Purwokerto Tim., Kabupaten Banyumas, Jawa Tengah 53114
                    </div>
                    <a href="https://maps.google.com/?q=Jl.+Jendral+Suprapto+No.25+Purwokerto" class="google-maps" target="_blank">
                        📍 Google Maps
                    </a>
                </div>
            </div>
        </div>

        <!-- GALLERY -->
        <div class="card-white">
            <div class="gallery-grid">
                @for ($i = 1; $i <= 6; $i++)
                    <img src="{{ asset('images/galeri' . $i . '.jpg') }}" class="gallery-img" onerror="this.src='https://via.placeholder.com/313x199?text=Galeri'">
                @endfor
            </div>
        </div>

        <!-- DESCRIPTION -->
        <div class="card-white">
            <p class="description">
                Berdiri sejak tahun 1968, Ruko Es & Kopi Brasil telah berkembang menjadi lokasi pusat penjualan produk-produk
                unggulan Brasil, oleh-oleh khas Purwokerto, dan tempat makan prasmanan tradisional. Nama "Brasil" dalam merk ini 
                bukan merujuk ke negara, melainkan singkatan dari kata "berhasil", sebagai doa dan harapan dari pendiri agar usaha 
                ini sukses dan terus dikenal luas. Selama 56 tahun, Es Brasil terus menjadi usaha keluarga yang turun-temurun 
                mempertahankan cita rasa khas tradisional es puter & es krim untuk dinikmati bersama. Selain es puter tradisional, 
                juga menyediakan varian es krim dengan rasa yang modern seperti Oreo, Green Tea, Blackforest, Almond, Mocca dan 
                masih banyak lagi. Kini, Es Brasil telah berkembang menjadi salah satu merek es tradisional yang sangat dikenal 
                oleh masyarakat, tidak hanya di Purwokerto tetapi juga di daerah lainnya, seperti Jakarta. Dengan konsistensi 
                rasa yang tetap terjaga dan inovasi produk yang terus berkembang, perusahaan ini tetap relevan dari masa ke masa 
                dan menjadi salah satu ikon kuliner daerah yang tak lekang oleh waktu.
            </p>
        </div>

        <!-- BOTTOM GRID (PRODUK, STOK, COMPANY) -->
        <div class="bottom-grid">
            <div class="info-panel">
                <h3>PRODUK</h3>
                <ul>
                    <li>• Es Puter Cup</li>
                    <li>• Es Krim Cone</li>
                    <li>• Es Kecil</li>
                    <li>• Es Lilin</li>
                    <li>• Es Kotak</li>
                    <li>• Es Rujak</li>
                </ul>
            </div>
            <div class="info-panel">
                <h3>STOK BARANG</h3>
                <div class="social">📱 @esbrasilpurwokerto</div>
                <p style="margin-top: 20px; font-size: 16px;">Ikuti kami di Instagram untuk info stok terbaru!</p>
            </div>
            <div class="info-panel">
                <h3>COMPANY</h3>
                <a href="#" onclick="alert('Fitur sedang dalam pengembangan')">📄 Profil Perusahaan</a>
                <a href="#" onclick="alert('Fitur sedang dalam pengembangan')">📞 Hubungi Kami</a>
            </div>
        </div>
    </div>
</body>
</html>