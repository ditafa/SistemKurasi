<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $produk = Produk::where('user_id', $user->id)->paginate(10);

        return view('pedagang.dashboard', compact('produk'));
    }
}
