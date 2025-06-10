<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
class StatistikController extends Controller
{
    public function index()
{
    $userId = auth()->id();

    $produkStats = DB::table('products')
        ->selectRaw("to_char(created_at, 'YYYY-MM') as bulan, status as status, count(*) as total")
        ->where('pedagang_id', $userId)
        ->groupBy('bulan', 'status')
        ->orderBy('bulan')
        ->get();

    $labels = $produkStats->pluck('bulan')->unique()->values()->all();

    $dataDiterima = [];
    $dataRevisi = [];
    $dataDitolak = [];

    foreach ($labels as $bulan) {
        $dataDiterima[] = $produkStats->where('bulan', $bulan)->where('status', 'diterima')->first()?->total ?? 0;
        $dataRevisi[] = $produkStats->where('bulan', $bulan)->where('status', 'revisi')->first()?->total ?? 0;
        $dataDitolak[] = $produkStats->where('bulan', $bulan)->where('status', 'ditolak')->first()?->total ?? 0;
    }

    $produkPedagang = Product::with('category')  // kalau relasi nama method di model adalah category, bukan kategori
    ->where('pedagang_id', $userId)
    ->orderBy('created_at', 'desc')
    ->get();

    return view('admin.statistik', compact('labels', 'dataDiterima', 'dataRevisi', 'dataDitolak', 'produkPedagang'));
}

}
