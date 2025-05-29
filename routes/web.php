<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\LoginPedagangController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataProductController as AdminProductController;
use App\Http\Controllers\Admin\NotifikasiController as AdminNotifikasiController;
use App\Http\Controllers\Admin\StatistikController;

// Pedagang Controllers
use App\Http\Controllers\Pedagang\ProductController as PedagangProductController;
use App\Http\Controllers\Pedagang\ProductPhotoController;
use App\Http\Controllers\Pedagang\ProfileController;
use App\Http\Controllers\Pedagang\NotificationController as PedagangNotificationController;
use App\Http\Controllers\Pedagang\StatisticsController;

// =============================
// Alias route 'login' default
// supaya middleware 'auth' tidak error mencari route 'login'
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

    // Dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Data produk admin
    Route::get('/dataproduk', [AdminProductController::class, 'index'])->name('dataproduk.index');

    // Detail produk admin
    Route::get('/produk/{id}', [AdminProductController::class, 'show'])->name('produk.detail');

    // Resource produk admin (CRUD lengkap)
    Route::resource('products', AdminProductController::class);

    // Statistik admin
    Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');

    // Halaman profil admin
    Route::view('/profile', 'admin.profile')->name('profile');

    // Notifikasi admin
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
    Route::get('/dashboard', [PedagangProductController::class, 'index'])->name('dashboard');

    // Daftar produk pedagang
    Route::get('/dataproduk', [PedagangProductController::class, 'index'])->name('dataproduk');

});
