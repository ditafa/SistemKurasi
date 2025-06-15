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
    public function index(Request $request)
    {
        $pedagang = Auth::guard('pedagang')->user();

        $query = Product::where('pedagang_id', $pedagang->id)->with(['photos', 'variations']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(10)->withQueryString();

        // Hitung harga & stok display
        foreach ($products as $product) {
            if ($product->type === 'variation') {
                $minPrice = $product->variations->min('price');
                $maxPrice = $product->variations->max('price');

                if ($minPrice === $maxPrice) {
                    $product->display_price = $minPrice ?? 0;
                } else {
                    $product->display_price = "{$minPrice} - {$maxPrice}";
                }

                $product->display_stock = $product->variations->sum('stock');
            } else {
                $product->display_price = $product->price;
                $product->display_stock = $product->stock;
            }
        }

        $categories = Category::all();

        return view('pedagang.products.index', compact('products', 'categories'));
    }

    public function dashboard()
    {
        return view('pedagang.dashboard');
    }

    public function create()
    {
        $categories = Category::with('children.children')->get();

        return view('pedagang.products.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required',
            'description' => 'required|string',
            'type' => 'required|in:single,variation',
            'price' => 'nullable|numeric',
            'stock' => 'nullable|integer',
            'variations' => 'array',
            'variations.*.price' => 'nullable|numeric',
            'variations.*.stock' => 'nullable|integer',
            'variations.*.attributes' => 'nullable|string',
        ]);

        $product = Product::create([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'description' => $data['description'],
            'type' => $data['type'],
            'price' => $data['type'] === 'single' ? $data['price'] : null,
            'stock' => $data['type'] === 'single' ? $data['stock'] : null,
            'pedagang_id' => auth()->user()->id,
            'status' => 'diajukan',
        ]);

        if ($data['type'] === 'variation' && isset($data['variations'])) {
            foreach ($data['variations'] as $variation) {
                $product->variations()->create([
                    'attributes' => $variation['attributes'],
                    'price' => $variation['price'] ?? 0,
                    'stock' => $variation['stock'] ?? 0,
                ]);
            }
        }

        return redirect()->route('pedagang.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);

        $categories = Category::all();

        return view('pedagang.products.edit', compact('product', 'categories'));
    }

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

        if ($request->hasFile('gambar')) {
            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }
            $product->gambar = $request->file('gambar')->store('produk', 'public');
        }

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

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('produk', 'public');
                ProductPhoto::create([
                    'product_id' => $product->id,
                    'url' => $path,
                ]);
            }
        }

        $product->curationTimeline()->create([
            'status' => $validated['status'],
            'description' => 'Status produk diubah menjadi ' . $validated['status'],
        ]);

        return redirect()->route('pedagang.produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }

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

    public function destroyPhoto($id)
    {
        $photo = ProductPhoto::findOrFail($id);
        $pedagang = Auth::guard('pedagang')->user();

        if ($photo->product->pedagang_id !== $pedagang->id) {
            abort(403, 'Akses tidak diizinkan.');
        }

        Storage::disk('public')->delete($photo->url);
        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    public function show($id)
{
    // Mendapatkan pedagang yang sedang login
    $pedagang = Auth::guard('pedagang')->user();

    // Pastikan pedagang ada
    if (!$pedagang) {
        return redirect()->route('pedagang.login')->with('error', 'Anda harus login terlebih dahulu.');
    }

    // Ambil produk dengan relasi yang dibutuhkan
    $product = Product::with([
        'category',
        'photos',
        'variations',
        'curationTimelines' => function ($query) {
            $query->orderBy('created_at', 'desc');
        },
        'statusHistories' // Pastikan relasi ini sesuai dengan yang ada di model
    ])
    ->where('pedagang_id', $pedagang->id)
    ->findOrFail($id);

    // Inisialisasi array untuk warna dan ukuran
    $warna = [];
    $ukuran = [];

    // Periksa apakah tipe produk adalah 'variation'
    if ($product->type === 'variation') {
        // Loop melalui variasi produk
        foreach ($product->variations as $variation) {
            foreach ($variation->variation_options as $option) {
                // Kategorikan atribut berdasarkan 'warna' atau 'ukuran'
                if (strtolower($option['attribute']) === 'warna') {
                    $warna[] = $option['value'];
                } elseif (in_array(strtolower($option['attribute']), ['ukuran', 'ukuran kaki', 'ukuran baju'])) {
                    $ukuran[] = $option['value'];
                }
            }
        }

        // Hilangkan nilai warna dan ukuran yang duplikat
        $warna = array_unique($warna);
        $ukuran = array_unique($ukuran);
    }

    // Kirim variabel ke view
    return view('pedagang.products.detail_produk', compact('product', 'warna', 'ukuran'));
}
}