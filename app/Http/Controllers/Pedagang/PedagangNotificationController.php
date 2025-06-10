<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class PedagangNotificationController extends Controller
{
    // Menampilkan semua notifikasi untuk pedagang yang sedang login
    public function index()
{
    $pedagang = auth()->guard('pedagang')->user();

    $notifikasis = Notification::where('pedagang_id', $pedagang->id)
        ->orderBy('created_at', 'desc')
        ->get();

    // Hitung jumlah notifikasi yang belum dibaca
    $jumlahBelumDibaca = Notification::where('pedagang_id', $pedagang->id)
        ->where('is_read', false)
        ->count();

    return view('pedagang.notifikasi', compact('notifikasis', 'jumlahBelumDibaca'));
}


    // Tandai satu notifikasi sebagai sudah dibaca
    public function markAsRead($id)
    {
        $pedagang = auth()->guard('pedagang')->user();

        $notif = Notification::where('id', $id)
            ->where('pedagang_id', $pedagang->id)
            ->firstOrFail();

        $notif->is_read = true;
        $notif->save();

        return redirect()->back();
    }

    // Tandai semua notifikasi pedagang sebagai sudah dibaca
    public function markAllAsRead()
    {
        $pedagang = auth()->guard('pedagang')->user();

        Notification::where('pedagang_id', $pedagang->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return redirect()->back();
    }
}
