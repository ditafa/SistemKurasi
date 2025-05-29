<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk; // pastikan model Produk sudah benar namespace-nya

class DashboardController extends Controller
{
    // Pastikan controller ini hanya bisa diakses oleh pedagang yang sudah login
    public function index()
    {
        return view('pedagang.dashboard');
    }
}