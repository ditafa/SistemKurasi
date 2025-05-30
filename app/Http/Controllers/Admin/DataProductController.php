<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // Pastikan model Product sudah ada
use Illuminate\Support\Facades\Auth;

class DataProductController  extends Controller
{
    public function index()
    {
        $products = Product::with('pedagang')->get(); // Ambil data produk, pagination optional
        return view('admin.dataproduk', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.detail_produk', compact('product')); // Buat view jika belum ada
    }


public function kurasi(Request $request, $id)
{
    $product = Product::findOrFail($id);

    // update status produk
    $product->status = $request->input('status');
    $product->save();

    // simpan history status produk dengan admin_id yang sedang login
    $product->statusHistories()->create([
        'status' => $request->input('status'),
        'admin_id' => Auth::guard('admin')->id(),
    ]);

    return redirect()->back()->with('success', 'Status produk berhasil diupdate');
}

}
