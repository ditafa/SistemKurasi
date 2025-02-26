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

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|string',
        'notes' => 'nullable|string',
    ]);

    try {
        $product = Product::findOrFail($id);

        // Simpan status baru ke dalam product_status_histories
        $statusHistory = new ProductStatusHistory([
            'product_id' => $product->id,
            'admin_id' => 1, // Ganti dengan auth()->id() jika menggunakan authentication
            'status' => $request->status,
            'notes' => $request->notes ?? '',
        ]);

        $statusHistory->save();

        // Update status produk jika diperlukan
        $product->status = $request->status;
        $product->save();

        // Load ulang relasi
        $product->load(['statusHistories.admin']);
        
        return response()->json([
            'success' => true,
            'message' => 'Status produk berhasil diperbarui.',
            'timeline' => $this->getTimeline($product),
        ]);
    } catch (\Exception $e) {
        // Log error untuk debugging
        \Log::error('Error updating product status: ' . $e->getMessage());
        \Log::error($e->getTraceAsString());
        
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat memperbarui status.',
        ], 500);
    }
}

private function getTimeline($product)
{
    try {
        $timeline = collect([
            [
                'status' => 'Diajukan',
                'notes' => 'Produk baru diajukan',
                'admin' => $product->user ? $product->user->name : 'System',
                'created_at' => $product->created_at,
                'color' => 'blue'
            ]
        ]);

        // Pastikan statusHistories sudah di-load
        if (!$product->relationLoaded('statusHistories')) {
            $product->load('statusHistories.admin');
        }

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
                'admin' => $history->admin ? $history->admin->name : 'System',
                'created_at' => $history->created_at,
                'color' => $colors[strtolower($history->status)] ?? 'gray'
            ];
        }));

        return $timeline->sortBy('created_at')->values();
    } catch (\Exception $e) {
        \Log::error('Error generating timeline: ' . $e->getMessage());
        // Return empty timeline in case of error
        return collect([]);
    }
}

public function getVariation($productId, $variationId)
{
    try {
        // Log input untuk debugging
        \Log::info("getVariation called with productId: $productId, variationId: $variationId");
        
        // Ambil produk tanpa relasi dulu untuk memastikan produk ada
        $product = Product::findOrFail($productId);
        \Log::info("Product found: " . $product->name);
        
        // Cek apakah variasi ada dalam database
        $variation = $product->variations()->find($variationId);
        
        if (!$variation) {
            \Log::warning("Variation with ID $variationId not found for product $productId");
            return response()->json([
                'success' => false,
                'message' => "Variasi dengan ID $variationId tidak ditemukan"
            ], 404);
        }
        
        \Log::info("Variation found: " . $variation->name);
        
        // Response berhasil dengan data minimal
        return response()->json([
            'success' => true,
            'variation' => [
                'id' => $variation->id,
                'name' => $variation->name,
                'price' => $product->price, // Gunakan harga produk sebagai default
            ],
        ]);
    } catch (\Exception $e) {
        // Log error detail
        \Log::error('Error fetching variation: ' . $e->getMessage());
        \Log::error($e->getTraceAsString());
        
        // Response error dengan detail untuk debugging
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}
}