<?php

namespace App\Http\Controllers\Auth;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        // Login sukses, redirect ke admin dashboard
        return redirect()->intended(route('admin.dashboard'));
    }

    // Login gagal, kembali dengan pesan error
    return back()->withErrors(['email' => 'The provided credentials do not match our records.'])
                 ->withInput($request->only('email'));
}

public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
