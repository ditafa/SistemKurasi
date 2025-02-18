<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil semua produk beserta kategori, variasi, dan foto
        $products = Product::with([
            'category', 
            'variation',
            'photos',
            'mainPhoto'
        ])->get();
        
        return view('homepage', compact('products'));
    }

    public function show($id)
    {
        // Ambil detail produk berdasarkan ID beserta relasi yang diperlukan
        $product = Product::with([
            'category',
            'variation',
            'photos',
            'mainPhoto',
            'statusHistories'
        ])->findOrFail($id);
        
        return view('detailproduk', compact('product'));
    }
    
}