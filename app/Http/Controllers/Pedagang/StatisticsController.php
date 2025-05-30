<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
    public function index()
    {
        return view('pedagang.statistik.index');
    }
}
