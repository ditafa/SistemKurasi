<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductStatusHistory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class DataProductController extends Controller
{
    public function __construct()
    {
$this->middleware('auth:admin')->only(['updateStatus', 'getVariation']);
    }

    public function index(Request $request)
    {
        $categories = Cache::remember('categories_main', 600, fn() =>
            Category::whereNull('parent_id')->get()
        );

        $statuses = ProductStatusHistory::select('status')
            ->distinct()
            ->pluck('status')
            ->map(fn($status) => $this->formatStatus($status))
            ->unique()
            ->values();

        $statuses = collect(['Diajukan'])->concat($statuses);

        $query = Product::with(['category', 'variations', 'photos', 'latestHistory']);

        if ($request->filled('status')) {
            $requestedStatus = strtolower($request->status);
            if ($requestedStatus === 'diajukan') {
                $query->whereDoesntHave('latestHistory');
            } else {
                $query->whereHas('latestHistory', function($q) use ($requestedStatus) {
                    $status = $requestedStatus === 'revisi' ? 'diterima dengan revisi' : $requestedStatus;
                    $q->where('status', $status);
                });
            }
        }

        $selectedCategory = null;
        if ($request->filled('category')) {
            $categoryId = $request->category;
            $categoryIds = Cache::remember("category_subtree_{$categoryId}", 600, function() use ($categoryId) {
                return $this->getCategoryAndSubcategories($categoryId);
            });

            $query->whereHas('category', fn($q) => $q->whereIn('id', $categoryIds));
            $selectedCategory = Category::find($categoryId);
        }

        if ($request->filled('search')) {
            $searchTerm = strtolower(trim($request->search));
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$searchTerm}%"])
                  ->orWhereRaw('LOWER(description) LIKE ?', ["%{$searchTerm}%"]);
            });
        }

$products = $query->paginate(7);

        $products->each(function ($product) {
            $product->first_photo = $product->photos->first();
$rawStatus = $product->latestHistory->status ?? 'Diajukan';
            $status = $this->formatStatus($rawStatus);

            $product->statusColor = match ($status) {
                'Diterima' => ['bg' => 'bg-green-500', 'text' => 'text-white'],
                'Ditolak' => ['bg' => 'bg-red-500', 'text' => 'text-white'],
                'Revisi'  => ['bg' => 'bg-yellow-500', 'text' => 'text-white'],
                default   => ['bg' => 'bg-blue-500', 'text' => 'text-white'],
            };

            $product->formatted_status = $status;
        });

        return view('admin.products.dataproduk', compact('products', 'categories', 'statuses', 'selectedCategory'));
    }

    private function getCategoryAndSubcategories($categoryId)
    {
        $categoryIds = collect([$categoryId]);
        $subcategories = Category::where('parent_id', $categoryId)->pluck('id');

        foreach ($subcategories as $subcategory) {
            $categoryIds = $categoryIds->merge($this->getCategoryAndSubcategories($subcategory));
        }

        return $categoryIds->unique()->values();
    }

    private function formatStatus(string $rawStatus): string
    {
        return match (strtolower($rawStatus)) {
            'diterima dengan revisi' => 'Revisi',
            'diajukan' => 'Diajukan',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
            default => ucfirst(strtolower($rawStatus)),
        };
    }

    public function show($id)
    {
        $product = Product::with([
            'category',
            'variations',
            'photos',
            'statusHistories' => fn($q) => $q->with('admin')->orderBy('created_at', 'desc'),
            'user'
        ])->findOrFail($id);

        $product->first_photo = $product->photos->first();

        $timeline = collect([
            [
                'status' => 'Diajukan',
                'notes' => 'Produk baru diajukan',
                'admin' => $product->user ? $product->user->name : 'System',
                'created_at' => $product->created_at,
                'color' => 'blue'
            ]
        ])->concat(
            $product->statusHistories->map(function ($history) {
                $colors = [
                    'diajukan' => 'blue',
                    'diterima' => 'green',
                    'ditolak' => 'red',
                    'diterima dengan revisi' => 'yellow',
                ];

                $status = $this->formatStatus($history->status);

                return [
                    'status' => $status,
                    'notes' => $history->notes ?? 'Tidak ada catatan',
                    'admin' => $history->admin ? $history->admin->name : 'System',
                    'created_at' => $history->created_at,
                    'color' => $colors[strtolower($history->status)] ?? 'gray',
                ];
            })
        )->sortBy('created_at')->values();

        return view('admin.products.detail_produk', compact('product', 'timeline'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:diajukan,diterima,ditolak,diterima dengan revisi,revisi',
            'notes' => 'nullable|string',
        ]);

        try {
            $product = Product::with('statusHistories')->findOrFail($id);

            $isProcessed = $product->statusHistories->contains(fn($history) =>
    in_array(strtolower($history->status), ['diterima', 'ditolak'])
);


            if ($isProcessed) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk ini sudah diproses dan tidak dapat diubah statusnya.',
                ], 403);
            }

            $statusToSave = strtolower($request->status) === 'revisi' ? 'diterima dengan revisi' : $request->status;

            $statusHistory = new ProductStatusHistory([
                'product_id' => $product->id,
                'admin_id' => Auth::id(),
                'status' => $statusToSave,
                'notes' => $request->notes ?? '',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ]);
            $statusHistory->save();

            $product->status = $statusToSave;
            $product->save();

            $product->load(['statusHistories.admin']);

            return response()->json([
                'success' => true,
                'message' => 'Status produk berhasil diperbarui.',
                'timeline' => $this->getTimeline($product),
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating product status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui status.',
            ], 500);
        }
    }

    private function getTimeline(Product $product)
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

            if (!$product->relationLoaded('statusHistories')) {
                $product->load('statusHistories.admin');
            }

            $timeline = $timeline->concat(
                $product->statusHistories->map(function ($history) {
                    $colors = [
                        'diajukan' => 'blue',
                        'diterima' => 'green',
                        'ditolak' => 'red',
                        'diterima dengan revisi' => 'yellow',
                    ];

                    $status = $this->formatStatus($history->status);

                    return [
                        'status' => $status,
                        'notes' => $history->notes ?? 'Tidak ada catatan',
                        'admin' => $history->admin ? $history->admin->name : 'System',
                        'created_at' => $history->created_at,
                        'color' => $colors[strtolower($history->status)] ?? 'gray',
                    ];
                })
            );

            return $timeline->sortBy('created_at')->values();
        } catch (\Exception $e) {
            \Log::error('Error generating timeline: ' . $e->getMessage());
            return collect([]);
        }
    }

    public function getVariation($productId, $variationId)
    {
        try {
            \Log::info("getVariation called with product: $productId, variation: $variationId");

            $product = Product::findOrFail($productId);
            $variation = $product->variations()->findOrFail($variationId);

            return response()->json([
                'success' => true,
                'variation' => [
                    'id' => $variation->id,
                    'name' => $variation->name,
                    'price' => $variation->price ?? $product->price,
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error("Error in getVariation: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Terjadi kesalahan: " . $e->getMessage()
            ], 500);
        }
    }

    public function kurasi(Request $request, $id)
{
    $request->validate([
        'kurasi_status' => 'required|string|in:diterima,ditolak,diterima dengan revisi',
        'kurasi_notes' => 'nullable|string',
    ]);

    try {
        $product = Product::with('statusHistories')->findOrFail($id);
        $statusToSave = strtolower($request->kurasi_status);

        // Simpan status baru ke riwayat status
        $statusHistory = new ProductStatusHistory([
            'product_id' => $product->id,
            'admin_id' => Auth::id(),
            'status' => $statusToSave,
            'notes' => $request->kurasi_notes ?? '',
            'created_at' => Carbon::now('Asia/Jakarta'),
        ]);
        $statusHistory->save();

        // Update status terakhir produk
        $product->status = $statusToSave;
        $product->save();

        return redirect()->back()->with('success', 'Produk berhasil dikurasi.');
    } catch (\Exception $e) {
        \Log::error('Error in kurasi method: ' . $e->getMessage());
        return redirect()->back()->withErrors('Terjadi kesalahan saat proses kurasi.');
    }
}

}
