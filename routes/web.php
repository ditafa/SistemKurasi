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

Route::get('/', [ProductController::class, 'index']);
Route::get('/detail/{id}', [ProductController::class, 'show']);
