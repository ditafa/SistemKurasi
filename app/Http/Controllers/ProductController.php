<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kategori utama (tanpa parent)
        $categories = Category::whereNull('parent_id')->get();
        
        // Ambil semua status unik dari tabel products
        $statuses = Product::select('status')->distinct()->pluck('status');

        // Buat query produk dengan relasi
        $query = Product::with(['category', 'variations', 'photos']);

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori
        if ($request->has('category') && $request->category !== '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('id', $request->category);
            });
        }

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search !== '') {
            $searchTerm = strtolower($request->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . $searchTerm . '%'])
                  ->orWhereRaw('LOWER(description) LIKE ?', ['%' . $searchTerm . '%']);
            });
        }

        // Ambil produk dengan pagination
        $products = $query->paginate(3);

        // Tambahkan warna status & foto pertama untuk setiap produk
        $products->each(function ($product) {
            $product->first_photo = $product->photos->first();
            $status = ucfirst($product->status ?? 'pending'); // Default jika null

            $product->statusColor = match ($status) {
                'Diterima' => ['bg' => 'bg-green-500', 'text' => 'text-white'],
                'Ditolak' => ['bg' => 'bg-red-500', 'text' => 'text-white'],
                'Revisi' => ['bg' => 'bg-yellow-500', 'text' => 'text-black'],
                default => ['bg' => 'bg-blue-500', 'text' => 'text-white'],
            };
        });

        return view('homepage', compact('products', 'categories', 'statuses'));
    }

    public function show($id)
    {
        // Ambil detail produk dengan relasinya
        $product = Product::with([
            'category',
            'variations',
            'photos',
            'statusHistories'
        ])->findOrFail($id);

        // Tambahkan foto pertama
        $product->first_photo = $product->photos->first();

        return view('detailproduk', compact('product'));
    }
}
