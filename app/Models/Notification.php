<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pedagang;
use App\Models\Admin;

class Notification extends Model
{
    // Tambahkan ini agar model tahu pakai tabel custom_notifications
    protected $table = 'custom_notifications';

    protected $fillable = [
        'user_id',
        'role',
        'title',
        'message',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(
            $this->role === 'pedagang' ? Pedagang::class : Admin::class,
            'user_id'
        );
    }
}
