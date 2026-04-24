<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reseller', function (Blueprint $table) {
            $table->id();
            $table->string('nama_reseller', 150);
            $table->enum('jenis_toko', ['Agen','Reseller','Outlet']);
            $table->string('wilayah', 100)->nullable();
            $table->text('alamat');
            $table->string('no_telepon', 20);
            $table->enum('status', ['Aktif','Tidak Aktif'])->default('Aktif');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reseller');
    }
};