<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Jika belum ada data dinamis, langsung render view
        return view('pedagang.dashboard');
    }
}
