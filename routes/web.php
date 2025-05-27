<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\LoginPedagangController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Pedagang\ProductController as PedagangProductController;
use App\Http\Controllers\Pedagang\ProductPhotoController;
use App\Http\Controllers\Pedagang\ProfileController;
use App\Http\Controllers\Pedagang\NotificationController;
use App\Http\Controllers\Pedagang\StatisticsController;

// =============================
// Route Publik (Umum)
// =============================
Route::view('/', 'landing')->name('landing');
Route::view('/about', 'about')->name('about');
Route::view('/kontak', 'contact')->name('kontak');

// Produk publik (AdminProductController)
Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [AdminProductController::class, 'show'])->name('products.show');
Route::get('/detail/{product}/variation/{variation}', [AdminProductController::class, 'getVariation'])->name('products.get-variation');

// =============================
// Login & Logout Admin
// =============================
Route::get('/login-admin', [LoginAdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login-admin', [LoginAdminController::class, 'login'])->name('admin.login.submit');

Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [AdminProductController::class, 'index'])->name('dashboard');
    
    // Detail produk admin
    Route::get('/produk/{id}', [AdminProductController::class, 'show'])->name('produk.detail');
    
    // Resource routes products untuk admin
    Route::resource('products', AdminProductController::class);
    
    Route::post('/logout', [LoginAdminController::class, 'logout'])->name('logout');
});

// =============================
// Login & Logout Pedagang
// =============================
Route::get('/login-pedagang', [LoginPedagangController::class, 'showLoginForm'])->name('pedagang.login');
Route::post('/login-pedagang', [LoginPedagangController::class, 'login'])->name('pedagang.login.submit');

Route::prefix('pedagang')->name('pedagang.')->middleware(['auth:pedagang'])->group(function () {
    Route::get('/dashboard', [PedagangProductController::class, 'index'])->name('dashboard');
    
    // Detail produk pedagang
    Route::get('/produk/{id}', [PedagangProductController::class, 'show'])->name('produk.detail');
    
    // Resource routes products untuk pedagang
    Route::resource('products', PedagangProductController::class);

    // Halaman statis / view langsung
    Route::view('/home', 'pedagang.home_page')->name('home');
    Route::view('/produk/tambah-tunggal', 'pedagang.Create_produkTunggal')->name('produk.tambah-tunggal');
    Route::view('/produk/tambah-variasi', 'pedagang.Create_prodkVariasi')->name('produk.tambah-variasi');

    // Upload foto produk pedagang
    Route::post('/produk/upload-foto', [ProductPhotoController::class, 'store'])->name('produk.upload-foto');

    // Profil pedagang
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); // jika ada update profile
    
Route::middleware(['auth', 'role:pedagang'])->prefix('pedagang')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('pedagang.profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('pedagang.profile.update');
});

    // Notifikasi pedagang
    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifikasi');

    // Statistik pedagang
    Route::get('/statistik', [StatisticsController::class, 'index'])->name('statistik');

    Route::post('/logout', [LoginPedagangController::class, 'logout'])->name('logout');
});
