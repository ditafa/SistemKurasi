<?php

namespace App\Http\Controllers\Pedagang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductPhoto;

class ProductPhotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variation_id' => 'nullable|exists:product_variations,id',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('photo')->store('product_photos', 'public');

        ProductPhoto::create([
            'product_id' => $request->product_id,
            'variation_id' => $request->variation_id,
            'url' => $path,
        ]);

        return back()->with('success', 'Foto berhasil diupload');
    }
}
