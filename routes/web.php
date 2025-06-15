<?php

use Illuminate\Support\Facades\Route;

// =============================
// Import Controllers
// =============================

// Auth Controllers
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\LoginPedagangController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DataProductController as AdminDataProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NotifikasiController;
use App\Http\Controllers\Admin\StatistikController;

// Pedagang Controllers
use App\Http\Controllers\Pedagang\DashboardController as PedagangDashboardController;
use App\Http\Controllers\Pedagang\DataProductController as PedagangDataProductController;
use App\Http\Controllers\Pedagang\PedagangNotificationController;
use App\Http\Controllers\Pedagang\ProfileController;
use App\Http\Controllers\Pedagang\StatisticsController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ContactController;


// =============================
// Halaman Umum (Publik)
// =============================

Route::view('/', 'landing')->name('landing'); // Halaman landing page
Route::view('/about', 'about')->name('about'); // Halaman about
Route::view('/kontak', 'kontak')->name('kontak');  // Halaman kontak
Route::get('/pendaftaran', [PendaftaranController::class, 'showForm']);
Route::post('/pendaftaran', [PendaftaranController::class, 'submitForm'])->name('pendaftaran.submit');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

// Alias route 'login' agar default Laravel tidak error, redirect ke pedagang login
Route::get('/login', fn () => redirect()->route('pedagang.login'))->name('login');

// =============================
// Login & Logout Admin
// =============================

Route::middleware('guest:admin')->group(function () {
    // Menampilkan form login admin
    Route::get('/login-admin', [LoginAdminController::class, 'showLoginForm'])->name('admin.login');
    // Menangani login admin
    Route::post('/login-admin', [LoginAdminController::class, 'login'])->name('admin.login.submit');
});

// Menangani logout admin
Route::post('/logout-admin', [LoginAdminController::class, 'logout'])
    ->middleware('auth:admin')
    ->name('admin.logout');

// =============================
// Login & Logout Pedagang
// =============================

Route::middleware('guest:pedagang')->group(function () {
    // Menampilkan form login pedagang
    Route::get('/login-pedagang', [LoginPedagangController::class, 'showLoginForm'])->name('pedagang.login');
    // Menangani login pedagang
    Route::post('/login-pedagang', [LoginPedagangController::class, 'login'])->name('pedagang.login.submit');
});

// Menangani logout pedagang
Route::post('/logout-pedagang', [LoginPedagangController::class, 'logout'])
    ->middleware('auth:pedagang')
    ->name('pedagang.logout');

// =============================
// Route Admin (middleware auth:admin)
// =============================

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Resource route produk admin
    Route::resource('products', AdminDataProductController::class);

    // Route khusus untuk kurasi produk (POST)
    Route::post('products/{product}/kurasi', [AdminDataProductController::class, 'kurasi'])->name('products.kurasi');

    // Resource route kategori produk
    Route::resource('kategori', CategoryController::class);

    // Notifikasi Admin
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');

    // Tandai semua notifikasi sebagai sudah dibaca
    Route::post('/notifikasi/mark-all-as-read', [NotifikasiController::class, 'markAllAsRead'])->name('notifikasi.markAllAsRead');

    // Tandai satu notifikasi sebagai sudah dibaca
    Route::patch('/notifikasi/{id}/mark-as-read', [NotifikasiController::class, 'markAsRead'])->name('notifikasi.markAsRead');

    // Statistik Admin
    Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');
    Route::get('/admin/statistik/export', [\App\Http\Controllers\Admin\StatistikController::class, 'export'])->name('admin.statistik.export');

    // Profile Admin
    Route::view('/profile', 'admin.profile')->name('profile');
});


// Menambahkan route pencarian produk khusus admin
Route::get('/admin/products/search', [AdminDataProductController::class, 'search']);

// =============================
// Route Pedagang (middleware auth:pedagang)
// =============================

Route::prefix('pedagang')->name('pedagang.')->middleware('auth:pedagang')->group(function () {
    // Dashboard Pedagang
    Route::get('/dashboard', [PedagangDashboardController::class, 'index'])->name('dashboard');

    // Resource route produk pedagang
    Route::resource('produk', PedagangDataProductController::class);

    // Aliasing '/dataproduk' ke index produk pedagang
    Route::get('/dataproduk', fn () => redirect()->route('pedagang.produk.index'))->name('dataproduk');

    // Notifikasi Pedagang
    Route::get('/notifikasi', [PedagangNotificationController::class, 'index'])->name('notifikasi');
    Route::post('/notifikasi/{id}/baca', [PedagangNotificationController::class, 'markAsRead'])->name('notifikasi.baca');

    // Statistik Pedagang
    Route::get('/statistik', [StatisticsController::class, 'index'])->name('statistik');

    // Profile Pedagang
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
