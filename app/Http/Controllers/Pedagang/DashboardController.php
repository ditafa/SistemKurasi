<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pedagang = Auth::guard('pedagang')->user();

        // Dummy data sementara (ubah sesuai logikamu nanti)
        $pendapatan = 1250000;
        $produkBelumAktif = 2;
        $negoBaru = 3;
        $negoBerlangsung = 1;
        $pesananBaru = 4;
        $pesananBerlangsung = 2;
        $pesananSelesai = 7;

        return view('pedagang.dashboard', compact(
            'pedagang',
            'pendapatan',
            'produkBelumAktif',
            'negoBaru',
            'negoBerlangsung',
            'pesananBaru',
            'pesananBerlangsung',
            'pesananSelesai'
        ));
    }
}
