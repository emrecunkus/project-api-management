<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\CheckRole;

use Illuminate\Support\Facades\Route;

// Herkesin erişebileceği rotalar
Route::get('/products', [ProductController::class, 'index']);

// Sadece admin'e izin verilen rotalar
Route::middleware(CheckRole::class . ':admin')->post('/products', [ProductController::class, 'store']);
Route::middleware(CheckRole::class . ':admin')->put('/products/{id}', [ProductController::class, 'update']);
Route::middleware(CheckRole::class . ':admin')->delete('/products/{id}', [ProductController::class, 'destroy']);

// Admin ve müşteri için sipariş rotaları
Route::middleware(CheckRole::class . ':admin')->get('/orders', [OrderController::class, 'index']);
Route::middleware(CheckRole::class . ':customer')->post('/orders', [OrderController::class, 'store']);
Route::middleware(CheckRole::class . ':admin|customer')->get('/orders/{id}', [OrderController::class, 'show']);
