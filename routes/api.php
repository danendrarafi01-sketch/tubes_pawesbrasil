<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/produk', [ProductController::class, 'index']);
Route::post('/produk', [ProductController::class, 'store']);
Route::put('/produk/{id}', [ProductController::class, 'update']);
Route::delete('/produk/{id}', [ProductController::class, 'destroy']);

Route::get('/external', [ProductController::class, 'externalApi']);