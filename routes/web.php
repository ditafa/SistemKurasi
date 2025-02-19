<?php
/*
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('coba'); // Menampilkan halaman cobe
});

Route::get('/detail', function () {
    return view('detail'); // Menampilkan halaman detail
});

*/


use App\Http\Controllers\ProductController;

// Route untuk halaman utama
Route::get('/', [ProductController::class, 'index']);

// Route untuk detail produk
Route::get('/detail/{id}', [ProductController::class, 'show']);

// Route untuk update status produk
Route::post('/products/{id}/status', [ProductController::class, 'updateStatus'])->name('products.update-status');

// Resource route untuk products
Route::resource('products', ProductController::class);
