<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pedagang;
use App\Models\Admin;

class Notification extends Model
{
    // Tentukan nama tabel
    protected $table = 'custom_notifications';

    // Field yang dapat diisi
    protected $fillable = [
        'user_id',
        'role',      // 'admin' atau 'pedagang'
        'title',
        'message',
        'is_read',
    ];

    // Casting ke tipe data
    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Relasi ke model Pedagang.
     */
    public function pedagang()
    {
        return $this->belongsTo(Pedagang::class, 'user_id');
    }

    /**
     * Relasi ke model Admin.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }

    /**
     * Getter dinamis untuk mengakses user sesuai role.
     * Contoh: $notif->user
     */
    public function getUserAttribute()
    {
        return $this->role === 'pedagang' ? $this->pedagang : $this->admin;
    }
}
