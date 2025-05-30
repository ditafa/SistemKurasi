<?php

use Illuminate\Support\Facades\Route;

// Controller Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataProductController as AdminProductController;
use App\Http\Controllers\Admin\NotifikasiController as AdminNotifikasiController;
use App\Http\Controllers\Admin\StatistikController;

// Controller Auth
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\LoginPedagangController;

// Controller Pedagang
use App\Http\Controllers\Pedagang\DataProductController as PedagangProductController;
use App\Http\Controllers\Pedagang\ProductPhotoController;
use App\Http\Controllers\Pedagang\ProfileController;
use App\Http\Controllers\Pedagang\NotificationController as PedagangNotificationController;
use App\Http\Controllers\Pedagang\StatisticsController;

// =============================
// Alias route 'login' default supaya middleware 'auth' tidak error mencari route 'login'
// Redirect ke login pedagang (bisa disesuaikan ke admin jika mau)
Route::redirect('/login', '/login-pedagang')->name('login');

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
Route::post('/logout-admin', [LoginAdminController::class, 'logout'])->name('admin.logout');

// =============================
// Route Group Admin (Autentikasi dan Akses Admin)
// =============================
Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dataproduk', [AdminProductController::class, 'index'])->name('dataproduk.index');
    Route::get('/dataproduk/{id}', [AdminProductController::class, 'show'])->name('dataproduk.show');
    Route::post('/dataproduk/{id}/kurasi', [AdminProductController::class, 'kurasi'])->name('dataproduk.kurasi');

    Route::get('/produk/{id}', [AdminProductController::class, 'show'])->name('produk.detail');

    Route::resource('products', AdminProductController::class);

    Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');

    Route::view('/profile', 'admin.profile')->name('profile');

    Route::get('/notifikasi', [AdminNotifikasiController::class, 'index'])->name('notifikasi');
});


// =============================
// Login & Logout Pedagang
// =============================
Route::get('/login-pedagang', [LoginPedagangController::class, 'showLoginForm'])->name('pedagang.login');
Route::post('/login-pedagang', [LoginPedagangController::class, 'login'])->name('pedagang.login.submit');
Route::post('/logout-pedagang', [LoginPedagangController::class, 'logout'])->name('pedagang.logout');

// =============================
// Route Group Pedagang (Autentikasi dan Akses Pedagang)
// =============================
Route::prefix('pedagang')->name('pedagang.')->middleware(['auth:pedagang'])->group(function () {

    // Dashboard pedagang
    Route::get('/dashboard', [PedagangProductController::class, 'dashboard'])->name('dashboard');

    // Daftar produk pedagang
    Route::get('/dataproduk', [PedagangProductController::class, 'index'])->name('dataproduk');

    // Tambah produk (form)
    Route::get('/produk/create', [PedagangProductController::class, 'create'])->name('produk.create');

    // Simpan produk baru
    Route::post('/produk', [PedagangProductController::class, 'store'])->name('produk.store');

    // Detail produk pedagang
    Route::get('/produk/{product}', [PedagangProductController::class, 'show'])->name('produk.show');

    // Edit produk pedagang
    Route::get('/produk/{product}/edit', [PedagangProductController::class, 'edit'])->name('produk.edit');

    // Update produk pedagang
    Route::put('/produk/{product}', [PedagangProductController::class, 'update'])->name('produk.update');

    // Hapus produk pedagang
    Route::delete('/produk/{product}', [PedagangProductController::class, 'destroy'])->name('produk.destroy');

    // Halaman profil pedagang
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Notifikasi pedagang
    Route::get('/notifikasi', [PedagangNotificationController::class, 'index'])->name('notifikasi');

    // Statistik pedagang
    Route::get('/statistik', [StatisticsController::class, 'index'])->name('statistik');
});
