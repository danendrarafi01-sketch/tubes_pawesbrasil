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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('id_reseller')
                  ->constrained('reseller')
                  ->cascadeOnDelete();
        
            $table->date('tanggal_pesan');
            $table->integer('total_produk');
            $table->decimal('total_harga', 15, 2);
        
            $table->text('alamat_pengiriman')->nullable();
            $table->string('no_telepon_pengiriman', 20)->nullable();
        
            $table->enum('status', ['Diterima','Diproses','Dikirim','Selesai'])
                  ->default('Diterima');
        
            $table->text('keterangan')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
