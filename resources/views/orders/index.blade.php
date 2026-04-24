<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesanan - Es Kopi Brasil</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
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
            margin-bottom: 25px;
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
            background: #1a472a;
            color: white;
            font-weight: 600;
        }

        .qty-input {
            width: 70px;
            padding: 5px;
            text-align: center;
        }

        .btn-add {
            background: #28a745;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-add:hover {
            background: #218838;
        }

        .cart-table {
            margin-top: 20px;
        }

        .cart-table th {
            background: #1a472a;
        }

        .btn-remove {
            background: #dc3545;
            color: white;
            border: none;
            padding: 5px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-checkout {
            background: #28a745;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        .btn-checkout:hover {
            background: #218838;
        }

        .btn-checkout:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .total-harga {
            font-size: 20px;
            font-weight: bold;
            margin-top: 15px;
            text-align: right;
        }

        .btn-back {
            background: #6c757d;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
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
            <div class="nav-item active" onclick="location.href='/orders'">
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
        <div class="top-bar">
            <div class="page-title">Buat Pesanan</div>
            <div class="user-info">
                <span>Halo, Selamat Datang di Website Manajemen Stok</span>
            </div>
        </div>

        <button class="btn-back" onclick="location.href='/dashboard'">← Kembali ke Dashboard</button>

        <!-- DAFTAR PRODUK -->
        <div class="card">
            <div class="card-header">
                <h2>📋 Daftar Produk</h2>
            </div>
            <table id="produk-table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produks as $produk)
                    <tr data-id="{{ $produk->id }}" data-nama="{{ $produk->nama_produk }}" data-harga="{{ $produk->harga }}" data-stok="{{ $produk->stok }}">
                        <td>{{ $produk->nama_produk }}</td>
                        <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                        <td class="stok-cell">{{ $produk->stok }}</td>
                        <td><input type="number" class="qty-input" value="0" min="0" max="{{ $produk->stok }}"></td>
                        <td><button class="btn-add add-to-cart">Tambah</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- KERANJANG BELANJA -->
        <div class="card">
            <div class="card-header">
                <h2>🛒 Keranjang Belanja</h2>
            </div>
            <table class="cart-table" id="cart-table" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    <tr>
                        <td colspan="5" style="text-align: center;">Keranjang masih kosong</td>
                    </tr>
                </tbody>
            </table>
            <div class="total-harga">Total: Rp <span id="cart-total">0</span></div>
            <button id="checkout-button" class="btn-checkout" disabled>Checkout</button>
        </div>
    </div>

    <script>
        const cart = [];

        function updateCartDisplay() {
            const cartItemsBody = document.getElementById('cart-items');
            const cartTotalSpan = document.getElementById('cart-total');
            let total = 0;
            
            if (cart.length === 0) {
                cartItemsBody.innerHTML = '<tr><td colspan="5" style="text-align: center;">Keranjang masih kosong</td></tr>';
                cartTotalSpan.innerText = '0';
                document.getElementById('checkout-button').disabled = true;
                return;
            }

            cartItemsBody.innerHTML = '';
            cart.forEach((item, index) => {
                const subtotal = item.harga * item.qty;
                total += subtotal;
                const row = cartItemsBody.insertRow();
                row.insertCell(0).innerText = item.nama;
                row.insertCell(1).innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(item.harga);
                row.insertCell(2).innerHTML = `<input type="number" class="cart-qty" data-index="${index}" value="${item.qty}" min="1" max="${item.stok}" style="width:70px; padding:5px;">`;
                row.insertCell(3).innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);
                row.insertCell(4).innerHTML = `<button class="btn-remove" data-index="${index}">Hapus</button>`;
            });
            cartTotalSpan.innerText = new Intl.NumberFormat('id-ID').format(total);
            document.getElementById('checkout-button').disabled = cart.length === 0;
        }

        // Tambah ke keranjang
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', (e) => {
                const row = e.target.closest('tr');
                const id = row.dataset.id;
                const nama = row.dataset.nama;
                const harga = parseInt(row.dataset.harga);
                const stok = parseInt(row.dataset.stok);
                const qtyInput = row.querySelector('.qty-input');
                let qty = parseInt(qtyInput.value);
                
                if (qty <= 0 || isNaN(qty)) qty = 0;
                if (qty > stok) {
                    alert(`Stok tidak mencukupi! Stok tersedia: ${stok}`);
                    qtyInput.value = 0;
                    return;
                }
                if (qty === 0) return;
                
                const existingItem = cart.find(item => item.id === id);
                if (existingItem) {
                    if (existingItem.qty + qty > stok) {
                        alert(`Stok tidak mencukupi! Stok tersedia: ${stok}`);
                        return;
                    }
                    existingItem.qty += qty;
                } else {
                    cart.push({ id, nama, harga, qty, stok });
                }
                qtyInput.value = 0;
                updateCartDisplay();
            });
        });

        // Update jumlah dari keranjang
        document.getElementById('cart-items').addEventListener('click', (e) => {
            if (e.target.classList.contains('btn-remove')) {
                const index = parseInt(e.target.dataset.index);
                cart.splice(index, 1);
                updateCartDisplay();
            }
        });

        document.getElementById('cart-items').addEventListener('change', (e) => {
            if (e.target.classList.contains('cart-qty')) {
                const index = parseInt(e.target.dataset.index);
                let newQty = parseInt(e.target.value);
                const item = cart[index];
                if (isNaN(newQty) || newQty < 1) newQty = 1;
                if (newQty > item.stok) {
                    alert(`Stok tidak mencukupi! Maksimal ${item.stok}`);
                    e.target.value = item.qty;
                    return;
                }
                item.qty = newQty;
                updateCartDisplay();
            }
        });

        // Checkout
        document.getElementById('checkout-button').addEventListener('click', () => {
            if (cart.length === 0) return;

            const itemsToSend = cart.map(item => ({ id: item.id, qty: item.qty }));

            const checkoutBtn = document.getElementById('checkout-button');
            const originalText = checkoutBtn.textContent;
            checkoutBtn.textContent = '⏳ Memproses...';
            checkoutBtn.disabled = true;
            
            const baseUrl = 'https://diane-nummary-obdurately.ngrok-free.dev';
            fetch(baseUrl + '/orders/process', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ items: itemsToSend })
            })
            .then(response => response.json())
            .then(data => {
                if (data.snap_token) {
                    snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            window.location.href = baseUrl + '/callback/success?order_id=' + result.order_id + '&ngrok-skip-browser-warning=true';
                        },
                        onPending: function(result) {
                            window.location.href = baseUrl + '/callback/pending?order_id=' + result.order_id + '&ngrok-skip-browser-warning=true';
                        },
                        onError: function(result) {
                            window.location.href = baseUrl + '/callback/error?order_id=' + result.order_id + '&ngrok-skip-browser-warning=true';
                        },
                        onClose: function() {
                            checkoutBtn.textContent = originalText;
                            checkoutBtn.disabled = false;
                            alert('Pembayaran dibatalkan');
                        }
                    });
                } else {
                    alert('Gagal memproses pesanan: ' + (data.error || 'Unknown error'));
                    checkoutBtn.textContent = originalText;
                    checkoutBtn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memproses pesanan: ' + error.message);
                checkoutBtn.textContent = originalText;
                checkoutBtn.disabled = false;
            });
        });
    </script>
</body>
</html>