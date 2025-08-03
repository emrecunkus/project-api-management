<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\CheckRole;

// Kullanıcı kayıt & giriş
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Herkes erişebilir - ürün listeleme
Route::get('/products', [ProductController::class, 'index']);

// 🔐 Sadece admin erişebilir - ürün yönetimi
Route::middleware(['auth:sanctum', CheckRole::class . ':admin'])->group(function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
});

// 🛒 Sipariş işlemleri

// ✅ Hem admin hem müşteri erişebilir
Route::middleware(['auth:sanctum', CheckRole::class . ':admin|customer'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index']);      // Admin: tümü, müşteri: kendi siparişleri
    Route::get('/orders/{id}', [OrderController::class, 'show']);  // Admin: her şeyi, müşteri: sadece kendi
});

// ✅ Sadece müşteri sipariş oluşturabilir
Route::middleware(['auth:sanctum', CheckRole::class . ':customer'])->post('/orders', [OrderController::class, 'store']);
