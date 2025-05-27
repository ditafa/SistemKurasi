<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('admin.login')->with('error', 'Silakan login sebagai admin terlebih dahulu.');
        }

        // Opsional: Cek apakah user memiliki role admin
        // Uncomment dan sesuaikan dengan struktur database Anda
        /*
        $user = auth()->user();
        if (!$user->is_admin || $user->role !== 'admin') {
            auth()->logout();
            return redirect()->route('admin.login')->with('error', 'Akses ditolak. Anda bukan admin.');
        }
        */

        return $next($request);
    }
}