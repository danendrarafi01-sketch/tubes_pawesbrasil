<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // Nomor order unik (penting untuk Midtrans)
            $table->string('order_id')->unique();
            
            // Relasi ke user (boleh kosong jika belum login)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            // Total harga pesanan
            $table->decimal('total_amount', 15, 2);
            
            // Status pembayaran
            $table->string('status')->default('pending');
            
            // Data dari Midtrans
            $table->string('snap_token')->nullable();
            $table->string('payment_url')->nullable();
            
            // Informasi customer (nama, email, no hp)
            $table->json('customer_details')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};