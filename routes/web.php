<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentCallbackController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// LOGIN MANUAL
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// DASHBOARD
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth')->name('dashboard');

// ROUTE PRODUK
Route::middleware('auth')->group(function () {
    Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProductController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('produk.destroy');
});

// ROUTE STOK
Route::middleware('auth')->group(function () {
    Route::get('/stok', [App\Http\Controllers\StokController::class, 'index'])->name('stok.index');
    Route::get('/stok/perbarui', [App\Http\Controllers\StokController::class, 'perbaruiForm'])->name('stok.perbarui');
    Route::post('/stok/perbarui', [App\Http\Controllers\StokController::class, 'perbaruiUpdate'])->name('stok.perbarui.update');
});

// ========== ROUTE ORDER (PESANAN) ==========
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/process', [OrderController::class, 'process'])->name('orders.process');
    Route::post('/orders/notification', [OrderController::class, 'notificationHandler'])->name('orders.notification');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
    
    // ========== ROUTE CALLBACK ==========
    Route::get('/callback/success', [OrderController::class, 'callbackSuccess'])->name('callback.success');
    Route::get('/callback/pending', [OrderController::class, 'callbackPending'])->name('callback.pending');
    Route::get('/callback/error', [OrderController::class, 'callbackError'])->name('callback.error');
    Route::get('/callback', [OrderController::class, 'callbackSuccess'])->name('callback');
    // =====================================
});
// ===========================================

// ========== ROUTE PAYMENT CALLBACK (BARU) ==========
Route::post('/payment-callback', [PaymentCallbackController::class, 'handle'])->name('payment.callback');
Route::get('/payment-success/manual', [PaymentCallbackController::class, 'manualSuccess'])->name('payment.manual.success');
// ===================================================

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';