<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('pedagang.profile.edit');
    }

    public function update(Request $request)
    {
        // Logic update profil
        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
