<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;

class PedagangNotificationController extends Controller
{
    public function index()
    {
        return view('pedagang.notifikasi.index');
    }
}
