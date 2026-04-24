<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Es Kopi Brasil</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: Arial, sans-serif; 
            background: linear-gradient(135deg, #1a472a 0%, #2d5a3b 100%);
            min-height: 100vh;
        }
        
        /* Navbar */
        .navbar {
            background: rgba(255,255,255,0.95);
            color: #1a472a;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .logo {
            font-size: 20px;
            font-weight: bold;
        }
        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-btn:hover {
            background: #c82333;
        }
        
        /* Container */
        .container { 
            max-width: 1200px; 
            margin: 30px auto; 
            padding: 0 20px; 
        }
        
        /* Card */
        .card {
            background: rgba(255,255,255,0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }
        h2 { color: #1a472a; margin-bottom: 10px; }
        
        /* Gallery Scroll */
        .gallery-container {
            position: relative;
            margin: 20px 0;
        }
        .gallery-scroll {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            gap: 15px;
            padding: 10px 5px;
            scrollbar-width: thin;
        }
        .gallery-scroll::-webkit-scrollbar {
            height: 8px;
        }
        .gallery-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .gallery-scroll::-webkit-scrollbar-thumb {
            background: #1a472a;
            border-radius: 10px;
        }
        .gallery-item {
            flex: 0 0 auto;
            width: 250px;
            text-align: center;
        }
        .gallery-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: transform 0.3s;
        }
        .gallery-item img:hover {
            transform: scale(1.05);
        }
        .gallery-item p {
            margin-top: 8px;
            color: #1a472a;
            font-weight: bold;
        }
        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #1a472a;
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
            z-index: 10;
        }
        .scroll-btn:hover {
            background: #2d5a3b;
        }
        .scroll-left {
            left: -15px;
        }
        .scroll-right {
            right: -15px;
        }
        
        /* Profile Section */
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
            box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
        }
        
        /* Description */
        .description {
            font-size: 14px;
            line-height: 1.8;
            text-align: justify;
            color: #444;
        }
        
        /* Bottom Grid */
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
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(255,255,255,0.3);
        }
        .info-panel ul {
            list-style: none;
        }
        .info-panel li {
            font-size: 14px;
            margin-bottom: 8px;
        }
        .info-panel a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            display: block;
            margin-bottom: 10px;
        }
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.9);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
        }
        .close-modal {
            position: absolute;
            top: 20px;
            right: 30px;
            background: red;
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
        }
        
        @media (max-width: 768px) {
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
    <nav class="navbar">
        <div class="logo">☕ Es Kopi Brasil Purwokerto</div>
        <div>
            <span>Halo, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 15px;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <!-- Welcome Card -->
        <div class="card">
            <h2>Selamat Datang di Dashboard</h2>
            <p>Anda login sebagai: <strong>{{ Auth::user()->role }}</strong></p>
            <p>Email: {{ Auth::user()->email }}</p>
        </div>

        <!-- PROFIL PERUSAHAAN -->
        <div class="card">
            <h2 style="text-align: center;">PROFIL PERUSAHAAN</h2>
            
            <div class="profile-wrapper">
                <div class="profile-info">
                    <div class="shop-name">ES KOPI & BRASIL</div>
                    <div class="address">
                        Jl. Jendral Suprapto No.25, Kauman Lama, Purwokerto Lor,<br>
                        Kec. Purwokerto Tim., Kabupaten Banyumas, Jawa Tengah 53114
                    </div>
                    <a href="https://maps.google.com/?q=Jl.+Jendral+Suprapto+No.25+Purwokerto" class="google-maps" target="_blank">
                        📍 Google Maps
                    </a>
                </div>
                <div class="profile-image">
                    <img src="{{ asset('images/bg-toko.jpeg') }}" alt="Foto Toko" onerror="this.src='https://placehold.co/250x150/1a472a/white?text=Toko'">
                </div>
            </div>
        </div>

        <!-- DESKRIPSI -->
        <div class="card">
            <p class="description">
                Berdiri sejak tahun 1968, Ruko Es & Kopi Brasil telah berkembang menjadi lokasi pusat penjualan produk-produk
                unggulan Brasil, oleh-oleh khas Purwokerto, dan tempat makan prasmanan tradisional. Nama "Brasil" dalam merk ini 
                bukan merujuk ke negara, melainkan singkatan dari kata "berhasil", sebagai doa dan harapan dari pendiri agar usaha 
                ini sukses dan terus dikenal luas. Selama 56 tahun, Es Brasil terus menjadi usaha keluarga yang turun-temurun 
                mempertahankan cita rasa khas tradisional es puter & es krim untuk dinikmati bersama. Selain es puter tradisional, 
                juga menyediakan varian es krim dengan rasa yang modern seperti Oreo, Green Tea, Blackforest, Almond, Mocca dan 
                masih banyak lagi. Kini, Es Brasil telah berkembang menjadi salah satu merek es tradisional yang sangat dikenal 
                oleh masyarakat, tidak hanya di Purwokerto tetapi juga di daerah lainnya, seperti Jakarta.
            </p>
        </div>

        <!-- GALERI SCROLL HORIZONTAL -->
        <div class="card">
            <h2 style="text-align: center;">📸 GALERI PRODUK</h2>
            
            <div class="gallery-container">
                <button class="scroll-btn scroll-left" onclick="scrollGallery('left')">◀</button>
                
                <div class="gallery-scroll" id="galleryScroll">
                    <!-- Image1.jpg -->
                    <div class="gallery-item">
                        <img src="{{ asset('images/Image1.jpg') }}" alt="Produk 1" onclick="showImage(this.src)">
                        <p>Es Krim Special</p>
                    </div>
                    <!-- Image2.jpg -->
                    <div class="gallery-item">
                        <img src="{{ asset('images/Image2.jpg') }}" alt="Produk 2" onclick="showImage(this.src)">
                        <p>Ice Cream Brasil</p>
                    </div>
                    <!-- Image3.jpg -->
                    <div class="gallery-item">
                        <img src="{{ asset('images/Image3.jpg') }}" alt="Produk 3" onclick="showImage(this.src)">
                        <p>Varian Rasa</p>
                    </div>
                    <!-- Image4.jpg -->
                    <div class="gallery-item">
                        <img src="{{ asset('images/Image4.jpg') }}" alt="Produk 4" onclick="showImage(this.src)">
                        <p>Produk Unggulan</p>
                    </div>
                    <!-- Ulang Image1 untuk tambahan -->
                    <div class="gallery-item">
                        <img src="{{ asset('images/Image1.jpg') }}" alt="Produk 5" onclick="showImage(this.src)">
                        <p>Es Krim Cone</p>
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('images/Image2.jpg') }}" alt="Produk 6" onclick="showImage(this.src)">
                        <p>Es Puter</p>
                    </div>
                </div>
                
                <button class="scroll-btn scroll-right" onclick="scrollGallery('right')">▶</button>
            </div>
        </div>

        <!-- BOTTOM GRID -->
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
                <p>📱 @esbrasilpurwokerto</p>
                <p style="margin-top: 15px; font-size: 12px;">Ikuti kami di Instagram untuk info stok terbaru!</p>
            </div>
            <div class="info-panel">
                <h3>COMPANY</h3>
                <a href="#" onclick="alert('Fitur sedang dalam pengembangan')">📄 Profil Perusahaan</a>
                <a href="#" onclick="alert('Fitur sedang dalam pengembangan')">📞 Hubungi Kami</a>
            </div>
        </div>
    </div>

    <!-- Modal untuk preview gambar -->
    <div id="imageModal" class="modal" onclick="closeModal()">
        <img id="modalImage" src="">
        <button class="close-modal" onclick="closeModal()">✕</button>
    </div>

    <script>
        function scrollGallery(direction) {
            const container = document.getElementById('galleryScroll');
            const scrollAmount = 300;
            if (direction === 'left') {
                container.scrollLeft -= scrollAmount;
            } else {
                container.scrollLeft += scrollAmount;
            }
        }
        
        function showImage(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').style.display = 'flex';
        }
        
        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
        }
    </script>
</body>
</html>