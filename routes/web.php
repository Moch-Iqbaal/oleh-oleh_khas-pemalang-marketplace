<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// Toko (bisa diakses tamu)
Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/produk/{product:slug}', [ShopController::class, 'show'])->name('shop.show');

// Halaman auth hanya untuk tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    // Belanja khusus customer
    Route::middleware('role:customer')->group(function () {
        Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
        Route::post('/keranjang/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::patch('/keranjang/{product}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/keranjang/{product}', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout');
        Route::get('/pesanan', [OrderController::class, 'index'])->name('orders.index');
    });

    // Detail pesanan: customer (miliknya sendiri), staff, admin
    Route::get('/pesanan/{transaction}', [OrderController::class, 'show'])->name('orders.show');
});

// Panel admin: admin dan staff boleh masuk
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('products', ProductController::class)->except('show');

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{transaction}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');

    // Khusus admin: kelola role user
    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.role');
    });
});
