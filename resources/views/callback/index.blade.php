<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Callback - Es Kopi Brasil</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a472a 0%, #2d5a3b 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon {
            font-size: 64px;
            margin-bottom: 20px;
        }

        .success {
            color: #28a745;
        }

        .pending {
            color: #ffc107;
        }

        .failed {
            color: #dc3545;
        }

        h2 {
            margin-bottom: 15px;
            font-size: 24px;
        }

        p {
            color: #666;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .order-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: left;
        }

        .order-info p {
            margin: 8px 0;
            color: #333;
        }

        .order-info strong {
            color: #1a472a;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .btn {
            background: #1a472a;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background: #2d5a3b;
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid #1a472a;
            color: #1a472a;
        }

        .btn-outline:hover {
            background: #1a472a;
            color: white;
        }
    </style>
</head>
<body>
    <div class="card">
        <?php if($status == 'success'): ?>
            <div class="icon success">✅</div>
            <h2 style="color: #28a745;">Pembayaran Berhasil!</h2>
            <p>Terima kasih telah berbelanja di Es Kopi Brasil.</p>
            <div class="order-info">
                <p><strong>Order ID:</strong> <?php echo e($transaction->order_id ?? '-'); ?></p>
                <p><strong>Total:</strong> Rp <?php echo e(number_format($transaction->gross_amount ?? 0, 0, ',', '.')); ?></p>
                <p><strong>Status:</strong> <span style="color: #28a745;">✓ Sukses</span></p>
            </div>
            <p>Stok produk akan segera diperbarui.</p>
            
        <?php elseif($status == 'pending'): ?>
            <div class="icon pending">⏳</div>
            <h2 style="color: #ffc107;">Menunggu Pembayaran</h2>
            <p>Silakan selesaikan pembayaran Anda.</p>
            <div class="order-info">
                <p><strong>Order ID:</strong> <?php echo e($transaction->order_id ?? '-'); ?></p>
                <p><strong>Total:</strong> Rp <?php echo e(number_format($transaction->gross_amount ?? 0, 0, ',', '.')); ?></p>
                <p><strong>Status:</strong> <span style="color: #ffc107;">⏳ Menunggu</span></p>
            </div>
            <p>Setelah pembayaran selesai, pesanan akan diproses.</p>
            
        <?php else: ?>
            <div class="icon failed">❌</div>
            <h2 style="color: #dc3545;">Pembayaran Gagal</h2>
            <p>Maaf, pembayaran Anda gagal diproses.</p>
            <div class="order-info">
                <p><strong>Order ID:</strong> <?php echo e($transaction->order_id ?? '-'); ?></p>
                <p><strong>Total:</strong> Rp <?php echo e(number_format($transaction->gross_amount ?? 0, 0, ',', '.')); ?></p>
                <p><strong>Status:</strong> <span style="color: #dc3545;">✗ Gagal</span></p>
            </div>
            <p>Silakan coba lagi atau hubungi customer service.</p>
        <?php endif; ?>
        
        <div class="btn-group">
            <button class="btn" onclick="window.location.href='/orders/history'">📋 Riwayat Pesanan</button>
            <button class="btn" onclick="window.location.href='/orders'">🛒 Buat Pesanan Baru</button>
            <button class="btn btn-outline" onclick="window.location.href='/dashboard'">📊 Dashboard</button>
        </div>
    </div>

    <script>
        // Redirect otomatis setelah 5 detik untuk status success
        <?php if($status == 'success'): ?>
            setTimeout(function() {
                window.location.href = '/orders/history';
            }, 5000);
        <?php endif; ?>
        
        // Redirect otomatis setelah 3 detik untuk status pending
        <?php if($status == 'pending'): ?>
            setTimeout(function() {
                window.location.href = '/orders/history';
            }, 3000);
        <?php endif; ?>
    </script>
</body>
</html>