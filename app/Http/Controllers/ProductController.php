<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStatusHistory;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kategori utama (tanpa parent)
        $categories = Category::whereNull('parent_id')->get();
        
        // Ambil semua status unik dari tabel product_status_histories dan standardisasi namanya
        $statuses = ProductStatusHistory::select('status')
            ->distinct()
            ->pluck('status')
            ->map(function($status) {
                // Standardisasi nama status
                return match(strtolower($status)) {
                    'diterima dengan revisi' => 'Revisi',
                    default => ucfirst(strtolower($status))
                };
            })
            ->unique()  // Untuk menghilangkan duplikat jika ada
            ->values(); // Reset index array

        // Tambahkan status 'Diajukan' ke collection
        $statuses = collect(['Diajukan'])->concat($statuses);

        // Buat query produk dengan relasi
        $query = Product::with(['category', 'variations', 'photos', 'latestHistory']);

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== '') {
            if (strtolower($request->status) === 'diajukan') {
                $query->whereDoesntHave('latestHistory');
            } else {
                $query->whereHas('latestHistory', function($q) use ($request) {
                    // Handle kasus khusus untuk Revisi
                    $status = strtolower($request->status) === 'revisi' ? 'diterima dengan revisi' : $request->status;
                    $q->where('status', $status);
                });
            }
        }

        // Filter berdasarkan kategori
        if ($request->has('category') && $request->category !== '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('id', $request->category)
                  ->orWhere('parent_id', $request->category); // Ambil sub-kategori juga
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
            $rawStatus = $product->latestHistory->status ?? 'Diajukan'; // Default ke Diajukan jika null
            
            // Standardisasi status untuk display
            $status = match(strtolower($rawStatus)) {
                'diterima dengan revisi' => 'Revisi',
                default => ucfirst(strtolower($rawStatus))
            };

            $product->statusColor = match ($status) {
                'Diterima' => ['bg' => 'bg-green-500', 'text' => 'text-white'],
                'Ditolak' => ['bg' => 'bg-red-500', 'text' => 'text-white'],
                'Revisi' => ['bg' => 'bg-yellow-500', 'text' => 'text-white'],
                default => ['bg' => 'bg-blue-500', 'text' => 'text-white'],
            };

            // Tambahkan formatted_status berdasarkan latestHistory
            $product->formatted_status = $status;
        });

        return view('home_page', compact('products', 'categories', 'statuses'));
    }

    public function show($id)
    {
        // Ambil detail produk dengan relasinya
        $product = Product::with([
            'category',
            'variations',
            'photos',
            'statusHistories' => function($query) {
                $query->with('admin')->orderBy('created_at', 'desc');
            }
        ])->findOrFail($id);

        // Tambahkan foto pertama
        $product->first_photo = $product->photos->first();

        // Format status untuk timeline
        $timeline = collect([
            [
                'status' => 'Diajukan',
                'notes' => 'Produk baru diajukan',
                'admin' => $product->user->name,
                'created_at' => $product->created_at,
                'color' => 'blue'
            ]
        ]);

        // Tambahkan history status ke timeline
        $timeline = $timeline->concat($product->statusHistories->map(function($history) {
            $colors = [
                'diajukan' => 'blue',
                'diterima' => 'green',
                'ditolak' => 'red',
                'diterima dengan revisi' => 'yellow'
            ];

            // Standardisasi status untuk display
            $status = match(strtolower($history->status)) {
                'diterima dengan revisi' => 'Diterima Dengan Revisi',
                default => ucfirst(strtolower($history->status))
            };

            return [
                'status' => $status,
                'notes' => $history->notes ?? 'Tidak ada catatan',
                'admin' => $history->admin->name,
                'created_at' => $history->created_at,
                'color' => $colors[strtolower($history->status)] ?? 'gray'
            ];
        }));
        $timeline = $timeline->sortBy('created_at')->values();

        return view('detail_produk', compact('product', 'timeline'));
    }
}