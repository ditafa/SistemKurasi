<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade'); // sesuaikan jika admin di tabel lain
            $table->enum('status', ['diajukan', 'diterima', 'ditolak', 'revisi', 'diterima dengan revisi'])
                ->default('diajukan')
                ->comment('diajukan/diterima/ditolak/revisi/diterima dengan revisi');
            $table->text('notes')->nullable()->comment('Catatan revisi dari admin');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_status_histories');
    }
};
