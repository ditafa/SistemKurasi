<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStatusHistory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

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

        // Filter berdasarkan kategori bertingkat
        if ($request->has('category') && $request->category !== '') {
            $categoryIds = $this->getCategoryAndSubcategories($request->category);
            $query->whereHas('category', function ($q) use ($categoryIds) {
                $q->whereIn('id', $categoryIds);
            });
        }

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $searchTerm = trim($request->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(name) ILIKE ?', ["%".strtolower($searchTerm)."%"])
                  ->orWhereRaw('LOWER(description) ILIKE ?', ["%".strtolower($searchTerm)."%"]);
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

    private function getCategoryAndSubcategories($categoryId)
    {
        $categoryIds = collect([$categoryId]);
        $subcategories = Category::where('parent_id', $categoryId)->pluck('id');
        
        foreach ($subcategories as $subcategory) {
            $categoryIds = $categoryIds->merge($this->getCategoryAndSubcategories($subcategory));
        }

        return $categoryIds;
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
        $product = Product::with('statusHistories')->findOrFail($id);
        
        // Cek apakah produk sudah pernah diterima atau ditolak
        $isProcessed = $product->statusHistories->contains(function($history) {
            return in_array(strtolower($history->status), ['diterima', 'ditolak']);
        });
        
        if ($isProcessed) {
            return response()->json([
                'success' => false,
                'message' => 'Produk ini sudah diproses dan tidak dapat diubah statusnya.',
            ], 403);
        }

        // Gunakan Carbon untuk mendapatkan waktu saat ini dalam zona waktu WIB
        $currentTime = Carbon::now('Asia/Jakarta');

        // Simpan status baru ke dalam product_status_histories
        $statusHistory = new ProductStatusHistory([
            'product_id' => $product->id,
            'admin_id' => 1, // Ganti dengan auth()->id() jika menggunakan authentication
            'status' => $request->status,
            'notes' => $request->notes ?? '',
        ]);

        // Set created_at secara eksplisit
        $statusHistory->created_at = $currentTime;
        
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

public function getVariation($product, $variation)
{
    try {
        // Log input (untuk debugging)
        \Log::info("getVariation called with product: $product, variation: $variation");
        
        // Ambil produk
        $productModel = Product::findOrFail($product);
        
        // Ambil variasi
        $variationModel = $productModel->variations()->findOrFail($variation);
        
        // Siapkan data respons
        $response = [
            'id' => $variationModel->id,
            'name' => $variationModel->name,
            'price' => $variationModel->price ?? $productModel->price,
            // Tambahkan informasi lain yang diperlukan
        ];
        
        // Kembalikan respons sukses
        return response()->json([
            'success' => true,
            'variation' => $response
        ]);
    } catch (\Exception $e) {
        // Log error
        \Log::error("Error in getVariation: " . $e->getMessage());
        
        // Kembalikan respons error
        return response()->json([
            'success' => false,
            'message' => "Terjadi kesalahan: " . $e->getMessage()
        ], 500);
    }
}
}