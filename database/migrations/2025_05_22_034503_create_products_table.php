<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 12, 2);
            $table->string('gambar')->nullable();
            $table->enum('jenis', ['tunggal', 'variasi']);
            $table->string('status_kurasi')->default('pending'); // pending, diterima, revisi, ditolak
            $table->text('catatan_revisi')->nullable();
            $table->foreignId('created_by')->constrained('users'); // asumsi pedagang disimpan di users table
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('products');
    }
}
