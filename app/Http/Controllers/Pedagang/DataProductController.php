<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;
use App\Models\Product; 
use Illuminate\Support\Facades\Auth;
use App\Models\Category;  
use Illuminate\Http\Request;

class DataProductController extends Controller
{
    public function index()
    {
        // Ambil pedagang yang login
        $pedagang = Auth::guard('pedagang')->user();

        // Ambil produk milik pedagang tersebut
        $products = Product::where('pedagang_id', $pedagang->id)->get();

        // Kirim ke view
        return redirect()->route('pedagang.dataproduk')->with('success', 'Produk berhasil ditambahkan! Lihat di daftar produk.');
    }

    public function dashboard()
    {
        return view('pedagang.dashboard');
    }

    public function create()
    {
            //$categories = \App\Models\Category::all();  // Ambil semua kategori
        $categories = Category::with('parent')->get();
        return view('pedagang.products.create', compact('categories'));  // kirim ke view
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'type' => 'required|in:single,variation',
        'status' => 'required|in:diajukan,diterima,ditolak,revisi',
        'category_id' => 'required|exists:categories,id',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->hasFile('gambar')) {
        $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
    }

    $product = new \App\Models\Product($validated);
    //$product->pedagang_id = auth()->guard('pedagang')->id();
    $product->user_id = auth()->guard('pedagang')->id(); 
    $product->save();

    return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
}
}