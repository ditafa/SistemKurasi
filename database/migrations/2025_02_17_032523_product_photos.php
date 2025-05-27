<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Relasi dengan products
            $table->foreignId('variation_id')->nullable()->constrained('product_variations')->onDelete('cascade'); // Relasi dengan product_variations
            $table->string('url')->comment('URL foto produk atau variasi');
            $table->timestamps();
        });
    }

        public function uploadPhoto(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variation_id' => 'nullable|exists:product_variations,id',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('photo')->store('product_photos', 'public');

        \App\Models\ProductPhoto::create([
            'product_id' => $request->product_id,
            'variation_id' => $request->variation_id,
            'url' => $path,
        ]);

        return response()->json(['message' => 'Foto berhasil diupload']);
    }

    public function down(): void
    {
        Schema::dropIfExists('product_photos');
    }
};
