<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminIdToProductsTable extends Migration
{
    /**
     * Menjalankan migrasi untuk menambah kolom admin_id ke tabel products.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Menambahkan kolom admin_id
            $table->unsignedBigInteger('admin_id')->nullable();

            // Menambahkan foreign key jika ingin mengaitkan produk dengan admin
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Membalikkan migrasi (rollback) untuk menghapus kolom admin_id.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Menghapus foreign key dan kolom admin_id
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
        });
    }
}
