<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class DataProductController extends Controller
{
    // Tampilkan daftar produk milik pedagang yang sedang login
    public function index()
    {
        $pedagang = Auth::guard('pedagang')->user();
        $products = Product::where('pedagang_id', $pedagang->id)
            ->with('photos')
            ->paginate(10);

        $categories = Category::all();

        return view('pedagang.products.index', compact('products'));
    }

    // Halaman dashboard pedagang
    public function dashboard()
    {
        return view('pedagang.dashboard');
    }

    // Tampilkan form tambah produk
    public function create()
    {
        // Ambil kategori beserta parentnya (jika ada)
        $categories = Category::with('parent')->get();
        return view('pedagang.products.create', compact('categories'));
    }

    // Simpan produk baru
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required|string',
        'type' => 'required|in:single,variation',
        'price' => 'required|numeric',
        'status' => 'required|string',
        'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Ambil pedagang_id dari user yang login
    $pedagangId = auth()->guard('pedagang')->id(); // sesuaikan guard jika perlu

    // Upload gambar jika ada
    $gambarPaths = [];
    if ($request->hasFile('gambar')) {
        foreach ($request->file('gambar') as $gambarFile) {
            $gambarPaths[] = $gambarFile->store('products', 'public');
        }
    }

    // Simpan produk
    $product = \App\Models\Product::create([
        'pedagang_id' => $pedagangId, // wajib disertakan
        'name' => $validated['name'],
        'category_id' => $validated['category_id'],
        'description' => $validated['description'],
        'type' => $validated['type'],
        'price' => $validated['price'],
        'status' => $validated['status'],
        'gambar' => json_encode($gambarPaths),
    ]);

    return redirect()->route('pedagang.produk.index')->with('success', 'Produk berhasil ditambahkan.');
}

    // Tampilkan form edit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product); // otorisasi update, bukan delete

        $categories = Category::all();

        return view('pedagang.products.edit', compact('product', 'categories'));
    }


    // Update produk
    public function update(Request $request, Product $product)
{
    $pedagang = Auth::guard('pedagang')->user();
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'type' => 'required|in:single,variation',
        'status' => 'required|in:diajukan,diterima,ditolak,revisi',
        'category_id' => 'required|exists:categories,id',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'photos' => 'nullable|array',
        'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        'color' => 'nullable|array',
        'color.*' => 'string|max:50',
        'size' => 'nullable|array',
        'size.*' => 'string|max:10',
    ]);

    // Ganti gambar utama jika ada upload baru
    if ($request->hasFile('gambar')) {
        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }
        $product->gambar = $request->file('gambar')->store('produk', 'public');
    }

    // Update data produk
    $product->update([
        'name' => $validated['name'],
        'description' => $validated['description'] ?? null,
        'price' => $validated['price'],
        'type' => $validated['type'],
        'status' => $validated['status'],
        'category_id' => $validated['category_id'],
        'color' => $validated['color'] ?? null,
        'size' => $validated['size'] ?? null,
        'gambar' => $product->gambar,
    ]);

    // Simpan foto tambahan baru
    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('produk', 'public');
            ProductPhoto::create([
                'product_id' => $product->id,
                'url' => $path,
            ]);
        }
    }

    // Simpan status kurasi ke timeline setelah update
    $product->curationTimeline()->create([
        'status' => $validated['status'],
        'description' => 'Status produk diubah menjadi ' . $validated['status'],
    ]);

    return redirect()->route('pedagang.produk.index')->with('success', 'Produk berhasil diperbarui!');
}


    // Hapus produk dan semua foto terkait
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Jika kamu pakai Policy, mungkin ada ini:
        $this->authorize('delete', $product); // <- bisa jadi penyebab 403

        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }

    // Tampilkan foto berdasarkan ID (untuk download/view)
    public function showPhoto($id)
    {
        $photo = ProductPhoto::findOrFail($id);

        $extension = pathinfo($photo->url, PATHINFO_EXTENSION);
        $mime = match (strtolower($extension)) {
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            default => 'application/octet-stream',
        };

        return response(Storage::disk('public')->get($photo->url))
            ->header('Content-Type', $mime);
    }

    // Hapus foto produk tertentu (foto tambahan)
    public function destroyPhoto($id)
    {
        $photo = ProductPhoto::findOrFail($id);
        $pedagang = Auth::guard('pedagang')->user();

        // Pastikan foto milik produk pedagang yang sedang login
        if ($photo->product->pedagang_id !== $pedagang->id) {
            abort(403, 'Akses tidak diizinkan.');
        }

        // Hapus file di storage dan hapus record foto
        Storage::disk('public')->delete($photo->url);
        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    public function show($id)
{
    // Ambil data produk berdasarkan ID beserta relasi curationTimeline
    $product = Product::with('curationTimeline')->findOrFail($id);

    // Kembalikan view dengan data produk dan timeline kurasi
    return view('pedagang.detail_produk', compact('product'));
}

}
