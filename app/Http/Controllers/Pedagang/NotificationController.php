<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Contoh data notifikasi, nanti bisa diganti dengan query dari DB
        $notifikasis = [
            ['id' => 1, 'pesan' => 'Produk Anda sudah disetujui oleh admin.', 'waktu' => '2025-05-26 08:00'],
            ['id' => 2, 'pesan' => 'Produk Anda perlu revisi, cek detailnya.', 'waktu' => '2025-05-25 10:30'],
            ['id' => 3, 'pesan' => 'Pesan dari admin: Pastikan data produk lengkap.', 'waktu' => '2025-05-24 15:00'],
        ];

        return view('pedagang.notifikasi', compact('notifikasis'));
    }
}
