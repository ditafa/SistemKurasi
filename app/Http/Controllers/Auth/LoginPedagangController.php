<?php

namespace App\Http\Controllers\Auth;
use App\Models\Pedagang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginPedagangController extends Controller
{
    public function showLoginForm()
    {
        return view('pedagang.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::guard('pedagang')->attempt($credentials)) {
        return redirect()->route('pedagang.dashboard'); // Ganti di sini
    }

        Log::warning('Login pedagang gagal', ['email' => $request->email]);


    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->withInput($request->only('email'));
}


    public function logout(Request $request)
    {
        Auth::guard('pedagang')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pedagang.login');
    }
}
