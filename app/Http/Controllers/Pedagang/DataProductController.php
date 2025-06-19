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
use Illuminate\Support\Str;

class DataProductController extends Controller
{

    public function dashboard()
    {
        return view('pedagang.dashboard');
    }

    public function index(Request $request)
    {
        $pedagang = Auth::guard('pedagang')->user();

        $query = Product::where('pedagang_id', $pedagang->id)
                        ->with(['photos', 'variations'])
                        ->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

            $products = $query->with('variations')->paginate(8)->withQueryString();

            foreach ($products as $product) {
                if ($product->type === 'variation') {
                    if ($product->variations->count() > 0) {
                        $minPrice = $product->variations->min('price') ?? 0;
                        $maxPrice = $product->variations->max('price') ?? 0;

                        if ($minPrice === $maxPrice) {
                            $product->display_price = 'Rp ' . number_format($minPrice, 0, ',', '.');
                        } else {
                            $product->display_price = 'Rp ' . number_format($minPrice, 0, ',', '.') . ' - Rp ' . number_format($maxPrice, 0, ',', '.');
                        }

                        $product->display_stock = $product->variations->sum('stock');
                    } else {
                        $product->display_price = 'Rp 0';
                        $product->display_stock = 0;
                    }
                } else {
                    $product->display_price = 'Rp ' . number_format($product->price ?? 0, 0, ',', '.');
                    $product->display_stock = $product->stock ?? 0;
                }
            }

                    $categories = Category::all();

                    return view('pedagang.products.index', compact('products', 'categories'));
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
    $request->validate([
        'name' => 'required|string',
        'category_id' => 'required|integer|exists:categories,id',
        'description' => 'required|string',
        'type' => 'required|in:single,variation',
        'price' => 'nullable|numeric|min:0',
        'stock' => 'nullable|integer|min:0',
        'gambar' => 'required|image|max:2048', // max 2MB
        'photos.*' => 'nullable|image|max:2048',
    ]);

    $product = new Product();
    $product->pedagang_id = auth()->guard('pedagang')->id();
    $product->category_id = $request->category_id;
    $product->name = $request->name;
    $product->description = $request->description;
    $product->type = $request->type;
    $product->status = 'pending';
    $product->kurasi_status = 'belum_dikurasi';

    if ($request->type === 'single') {
        $product->price = $request->price;
        $product->stock = $request->stock;
    } elseif ($request->type === 'variation') {
        $minPrice = collect($request->input('variations'))->min('price');
        $product->price = $minPrice ?? 0;
        $product->stock = null;
    }

    // Simpan gambar utama
    if ($request->hasFile('gambar')) {
        $product->gambar = $request->file('gambar')->store('produk', 'public');
    }

    $product->save();

    // Simpan foto tambahan jika ada
    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $photo) {
            $product->photos()->create([
                'path' => $photo->store('produk', 'public'),
            ]);
        }
    }

    // Simpan variasi jika tipe adalah variation
    if ($request->type === 'variation') {
        foreach ($request->input('variations') as $variation) {
            $product->variations()->create([
                'attributes' => $variation['attributes'],
                'price' => $variation['price'],
                'stock' => $variation['stock'],
            ]);
        }
    }

    return redirect()->route('pedagang.produk.index')->with('success', 'Produk berhasil ditambahkan.');
}


    public function show($id)
    {
        $pedagang = Auth::guard('pedagang')->user();

        if (!$pedagang) {
            return redirect()->route('pedagang.login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $product = Product::with([
            'category',
            'photos',
            'variations.variation_options',
            'curationTimelines' => fn ($q) => $q->orderBy('created_at', 'desc'),
            'statusHistories'
        ])->where('pedagang_id', $pedagang->id)->findOrFail($id);

        $warna = [];
        $ukuran = [];

        if ($product->type === 'variation') {
            foreach ($product->variations as $variation) {
                foreach ($variation->variation_options as $option) {
                    $attr = strtolower($option['attribute']);
                    if ($attr === 'warna') {
                        $warna[] = $option['value'];
                    } elseif (in_array($attr, ['ukuran', 'ukuran kaki', 'ukuran baju'])) {
                        $ukuran[] = $option['value'];
                    }
                }
            }

            $warna = array_unique($warna);
            $ukuran = array_unique($ukuran);
        }

        return view('pedagang.products.detail_produk', compact('product', 'warna', 'ukuran'));
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
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required_if:type,single|nullable|numeric|min:0',
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

        if ($request->type === 'variation') {
    $validated = $request->validate([
        'variations' => 'required|array',
        'variations.*.attributes' => 'required|string',
        'variations.*.price' => 'required|numeric|min:0',
        'variations.*.stock' => 'required|integer|min:0',
    ]);
}

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

        // Hapus foto dan variasi juga
        foreach ($product->photos as $photo) {
            Storage::disk('public')->delete($photo->url);
            $photo->delete();
        }

        $product->variations()->delete();

        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }

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
}
