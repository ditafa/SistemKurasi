<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemilik');
            $table->string('nama_usaha');
            $table->string('email');
            $table->string('telepon');
            $table->text('alamat');
            $table->string('nama_produk');
            $table->string('kategori');
            $table->text('deskripsi');
            $table->integer('harga');
            $table->json('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
