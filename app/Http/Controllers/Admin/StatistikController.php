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
    $produkStats = DB::table('products')
        ->selectRaw("to_char(created_at, 'YYYY-MM') as bulan, COALESCE(kurasi_status, 'menunggu') as status, count(*) as total")
        ->groupByRaw("to_char(created_at, 'YYYY-MM'), COALESCE(kurasi_status, 'menunggu')")
        ->orderByRaw("to_char(created_at, 'YYYY-MM')")
        ->get();

    $labels = $produkStats->pluck('bulan')->unique()->values()->all();

    $dataDiterima = [];
    $dataRevisi = [];
    $dataDitolak = [];
    $dataMenunggu = [];

    foreach ($labels as $bulan) {
        $dataDiterima[] = $produkStats->where('bulan', $bulan)->where('status', 'diterima')->first()?->total ?? 0;
        $dataRevisi[]   = $produkStats->where('bulan', $bulan)->where('status', 'revisi')->first()?->total ?? 0;
        $dataDitolak[]  = $produkStats->where('bulan', $bulan)->where('status', 'ditolak')->first()?->total ?? 0;
        $dataMenunggu[] = $produkStats->where('bulan', $bulan)->where('status', 'menunggu')->first()?->total ?? 0;
    }

    $produkPedagang = Product::with('category')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.statistik', compact(
        'labels',
        'dataDiterima',
        'dataRevisi',
        'dataDitolak',
        'dataMenunggu',
        'produkPedagang'
    ));
}
}