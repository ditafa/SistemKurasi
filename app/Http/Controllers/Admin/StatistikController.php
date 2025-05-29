<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index()
    {
            //dd('Controller Statistik jalan');
        return view('admin.statistik');
    }
}
