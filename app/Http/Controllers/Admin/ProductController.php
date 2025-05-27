<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; // Pastikan ini ada
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

        return view('admin.home_page', compact('products', 'categories', 'statuses'));
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
    $product = Product::with([
        'category',
        'variations',
        'photos',
        'statusHistories' => function($query) {
            $query->with('admin')->orderBy('created_at', 'desc');
        },
        'user' // pastikan relasi user juga dimuat
    ])->findOrFail($id);

    $product->first_photo = $product->photos->first();

    // Buat timeline menggunakan method getTimeline (untuk konsistensi)
    $timeline = $this->getTimeline($product);

    return view('admin.detail_produk', compact('product', 'timeline'));
}


    public function updateStatus(Request $request, $id)
{
    // Validasi input dasar
    $request->validate([
        'status' => 'required|string',
        'notes' => 'nullable|string',
    ]);

    // Validasi custom: notes wajib diisi jika status bukan "diterima"
    if (strtolower($request->status) !== 'diterima' && empty(trim($request->notes))) {
        return response()->json([
            'success' => false,
            'message' => 'Catatan wajib diisi jika status bukan diterima.'
        ], 422);
    }

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

        // Waktu sekarang di zona WIB
        $currentTime = Carbon::now('Asia/Jakarta');

        // Tentukan notes sesuai kondisi
        $notes = null;
        if (strtolower($request->status) !== 'diterima') {
            $notes = $request->notes ?? '';
        }

        // Buat riwayat status baru
        $statusHistory = new ProductStatusHistory([
            'product_id' => $product->id,
            'admin_id' => Auth::id() ?? 1, // Ganti 1 dengan Auth::id() kalau sudah pakai auth
            'status' => $request->status,
            'notes' => $notes,
        ]);

        $statusHistory->created_at = $currentTime;
        $statusHistory->save();

        // Update status produk
        $product->status = $request->status;
        $product->save();

        // Load ulang relasi agar timeline up to date
        $product->load(['statusHistories.admin']);

        return response()->json([
            'success' => true,
            'message' => 'Status produk berhasil diperbarui.',
            'timeline' => $this->getTimeline($product),
        ]);
    } catch (\Exception $e) {
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
    $timeline = collect([
        [
            'status' => 'Diajukan',
            'notes' => 'Produk baru diajukan',
            'admin' => $product->user ? $product->user->name : 'System',
            'created_at' => $product->created_at,
            'color' => 'blue'
        ]
    ]);

    if (!$product->relationLoaded('statusHistories')) {
        $product->load('statusHistories.admin');
    }

    $timeline = $timeline->concat($product->statusHistories->map(function($history) {
        $colors = [
            'diajukan' => 'blue',
            'diterima' => 'green',
            'ditolak' => 'red',
            'diterima dengan revisi' => 'yellow'
        ];

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

public function dashboard() {
        $produkPending = Product::where('status_kurasi', 'pending')->get();
        return view('admin.home_page', compact('produkPending'));
    }

    public function kurasiProduk(Request $request, $id) {
        $request->validate([
            'status_kurasi' => 'required|in:diterima,revisi,ditolak',
            'catatan_revisi' => 'nullable|string',
        ]);

        $produk = Product::findOrFail($id);
        $produk->status_kurasi = $request->input('status_kurasi');
        $produk->catatan_revisi = $request->input('catatan_revisi');
        $produk->save();

        return redirect()->route('admin.home')->with('success', 'Produk berhasil dikurasi.');
    }
}