<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotifikasiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil notifikasi dari admin yang login
        $admin = auth('admin')->user();

        // Bisa difilter: semua / belum dibaca
        $notifikasis = $admin->notifications()->latest()->paginate(10);

        return view('admin.notifikasi', compact('notifikasis'));
    }

    public function markAsRead($id)
    {
        $admin = auth('admin')->user();
        $notification = $admin->notifications()->findOrFail($id);

        $notification->markAsRead();

        return back()->with('success', 'Notifikasi ditandai sudah dibaca.');
    }

    public function markAllAsRead()
    {
        $admin = auth('admin')->user();
        $admin->unreadNotifications->markAsRead();

        return back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }
}
