<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Menampilkan halaman profil pedagang
    public function index()
{
    $user = auth()->guard('pedagang')->user(); // or however you get the logged-in pedagang user

    return view('pedagang.profile', compact('user'));
}


    public function edit()
    {
        // Tampilkan form edit profil
        return view('pedagang.profile_edit');
    }

    // Method update (jika ada)
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return redirect()->route('pedagang.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}