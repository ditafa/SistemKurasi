<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // migration products
            $table->foreignId('pedagang_id')->constrained('pedagangs')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->enum('type', ['single', 'variation'])->comment('single/variation');
            $table->enum('status', ['diajukan', 'diterima', 'ditolak', 'revisi'])->default('diajukan')->comment('diajukan/diterima/ditolak/revisi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
