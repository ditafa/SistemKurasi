<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    //use HasFactory;
    use Notifiable;
    protected $table = 'admins';

    protected $fillable = [
        'name', 'email', 'password', // tambahkan field yang sesuai dengan tabel Anda
    ];
}
  
