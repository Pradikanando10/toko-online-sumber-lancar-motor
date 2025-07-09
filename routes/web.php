<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\CartController;
// use App\Http\Controllers\CheckoutController;
// use App\Http\Controllers\OrderController;
// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\UserDashboardController;

// // Route untuk Registrasi dan Login
// Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// // Route untuk Home dan Produk
// Route::get('/home', [HomeController::class, 'index'])->name('home'); 
// // Menampilkan produk di halaman home
// Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// // Route untuk Keranjang
// Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
// Route::post('/cart', [CartController::class, 'add'])->name('cart.add');

// // Route untuk Checkout
// Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
// Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

// // Route untuk Pesanan Pengguna
// Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

// // Rute untuk Admin Login
// Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
// Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
// Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// // Rute untuk Admin Dashboard
// Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

// // Rute untuk Manajemen Order Admin
// Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
// Route::put('/admin/orders/{id}', [AdminController::class, 'update'])->name('admin.orders.update');

// // Rute untuk Manajemen Produk Admin
// Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
// Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
// Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
// Route::get('/admin/products/{id}', [ProductController::class, 'show'])->name('admin.products.show');
// Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit'); // Rute untuk menampilkan form edit produk
// Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('admin.products.update'); // Rute untuk memperbarui produk
// Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy'); // Rute untuk menghapus produk

// // Rute untuk Dashboard Pengguna
// Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
// Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('user.orders'); // Menggunakan OrderController
// Route::get('/dashboard/profile', [UserDashboardController::class, 'profile'])->name('user.profile');
// Route::post('/logout', [UserDashboardController::class, 'logout'])->name('user.logout');

// // Route untuk Halaman Utama
// Route::get('/', function () {
//     return redirect()->route('home');
// });


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserDashboardController;

// Route untuk Registrasi dan Login
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Route untuk Home dan Produk
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Route untuk Keranjang
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Route untuk Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

// Route untuk Pesanan Pengguna
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

// Rute untuk Admin Login
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Rute untuk Admin Dashboard
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

// Rute untuk Manajemen Order Admin
Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
Route::put('/admin/orders/{id}', [AdminController::class, 'update'])->name('admin.orders.update');

// Rute untuk Manajemen Produk Admin
Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{id}', [ProductController::class, 'show'])->name('admin.products.show');
Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

// Rute untuk Dashboard Pengguna
Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('user.orders');
Route::get('/dashboard/profile', [UserDashboardController::class, 'profile'])->name('user.profile');
Route::post('/logout', [UserDashboardController::class, 'logout'])->name('user.logout');

// Route untuk Halaman Utama
Route::get('/', function () {
    return redirect()->route('home');
});
