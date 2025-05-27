<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 
class ProductController extends Controller
{
    // Tampilkan halaman dashboard pedagang (bisa berisi ringkasan atau daftar produk)
    public function index()
    {
        // Contoh ambil semua produk milik pedagang yang sedang login
$products = Product::where('user_id', auth()->id())->get();

        // Kirim data produk ke view dashboard pedagang
        return view('pedagang.listProduk', compact('products'));
    }

    // Tampilkan form tambah produk
    public function create()
    {
        return view('pedagang.products.create');
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            // validasi lain sesuai kebutuhan
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'pedagang_id' => auth()->guard('pedagang')->id(),
            // isi field lain sesuai kebutuhan
        ]);

        return redirect()->route('pedagang.dashboard')->with('success', 'Produk berhasil ditambahkan');
    }

    // Tampilkan detail produk
    public function show(Product $product)
    {
        // Pastikan hanya produk milik pedagang yang bisa diakses
        $this->authorize('view', $product);

        return view('pedagang.products.show', compact('product'));
    }

    // Tampilkan form edit produk
    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        return view('pedagang.products.edit', compact('product'));
    }

    // Update produk
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('pedagang.dashboard')->with('success', 'Produk berhasil diperbarui');
    }

    // Hapus produk
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('pedagang.dashboard')->with('success', 'Produk berhasil dihapus');
    }

    public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}

}
