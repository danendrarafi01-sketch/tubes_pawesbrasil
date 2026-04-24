<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('new_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('order_id')->unique();
            $table->decimal('gross_amount', 15, 2)->default(0);
            $table->enum('payment_status', ['pending', 'success', 'failed'])->default('pending');
            $table->string('payment_type')->nullable();
            $table->string('snap_token')->nullable();
            $table->json('payment_details')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('new_transactions');
    }
};