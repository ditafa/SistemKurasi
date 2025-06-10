<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    // contoh di Controller Pedagang\StatisticsController.php

public function index()
{
    $userId = auth()->id();

    // Query contoh untuk data statistik per bulan (format: YYYY-MM)
    // Gunakan raw SQL atau query builder untuk grup berdasarkan bulan dan status
    $produkStats = \DB::table('products')
        ->selectRaw("to_char(created_at, 'YYYY-MM') as bulan, status, count(*) as total")
        ->where('pedagang_id', $userId)
        ->groupBy('bulan', 'status')
        ->orderBy('bulan')
        ->get();

    // Siapkan labels bulan unik (urut)
    $labels = $produkStats->pluck('bulan')->unique()->values()->all();

    // Siapkan data untuk tiap status per bulan, default 0 kalau tidak ada
    $dataDiterima = [];
    $dataRevisi = [];
    $dataDitolak = [];

    foreach ($labels as $bulan) {
        $dataDiterima[] = $produkStats->where('bulan', $bulan)->where('status', 'diterima')->first()?->total ?? 0;
        $dataRevisi[] = $produkStats->where('bulan', $bulan)->where('status', 'revisi')->first()?->total ?? 0;
        $dataDitolak[] = $produkStats->where('bulan', $bulan)->where('status', 'ditolak')->first()?->total ?? 0;
    }

    return view('pedagang.statistik', compact('labels', 'dataDiterima', 'dataRevisi', 'dataDitolak'));
}
}