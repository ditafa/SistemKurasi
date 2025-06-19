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
        $table->string('nama_usaha')->index();
        $table->string('email')->index();
        $table->string('telepon');
        $table->text('alamat');
        $table->string('nama_produk');
        $table->string('kategori', 50);
        $table->text('deskripsi');
        $table->unsignedInteger('harga');
        $table->json('foto');
        $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
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
