<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\GoogleAuthController;

// 1. AREA PUBLIK (Bisa diakses tanpa login)
Route::get('/', [ShopController::class, 'index'])->name('home');

// (Opsional) Tambah ke keranjang masih dibolehkan tanpa login
Route::get('/add-to-cart/{id}', [ShopController::class, 'addToCart'])->name('add.to.cart');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('product.show');
// 2. AREA AKUN PELANGGAN (Harus Login)
Route::middleware(['auth'])->group(function () {
    Route::post('/product/{id}/review', [ShopController::class, 'storeReview'])->name('review.store');
    // Pindahkan rute Keranjang dan Checkout ke sini!
    Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
    Route::post('/checkout', [ShopController::class, 'checkout'])->name('checkout');
    
    // Rute Dashboard Pelanggan yang sudah ada
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    // Manajemen Kuantitas Keranjang
    Route::get('/cart/increase/{id}', [ShopController::class, 'increaseCart'])->name('cart.increase');
    Route::get('/cart/decrease/{id}', [ShopController::class, 'decreaseCart'])->name('cart.decrease');
    Route::get('/cart/remove/{id}', [ShopController::class, 'removeCart'])->name('cart.remove');
});

// 3. AREA MANAJEMEN SUPER ADMIN (Harus Login & Role: super_admin)
// Route untuk Google Login
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

Route::get('/payment/{id}', [ShopController::class, 'paymentInstruction'])->name('payment.instruction');

Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/admin/inventory', [InventoryController::class, 'index'])->name('admin.inventory');
Route::post('/admin/inventory', [InventoryController::class, 'store'])->name('admin.inventory.store');
Route::delete('/admin/inventory/{id}', [InventoryController::class, 'destroy'])->name('admin.inventory.destroy');

Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
Route::patch('/admin/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.status');
});

 Route::get('/admin/inventory/{id}/edit', [InventoryController::class, 'edit'])->name('admin.inventory.edit');
    Route::put('/admin/inventory/{id}', [InventoryController::class, 'update'])->name('admin.inventory.update');
    
    Route::delete('/admin/inventory/{id}', [InventoryController::class, 'destroy'])->name('admin.inventory.destroy');
require __DIR__.'/auth.php';
