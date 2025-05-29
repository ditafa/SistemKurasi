<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // Pastikan model Product sudah ada

class DataProductController  extends Controller
{
    public function index()
    {
        $products = Product::with('pedagang')->get(); // Ambil data produk, pagination optional
        return view('admin.dataproduk', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.produk_detail', compact('product')); // Buat view jika belum ada
    }

    // Tambahkan metode lain jika perlu: create, store, edit, update, destroy
}
