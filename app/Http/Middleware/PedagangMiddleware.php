<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PedagangMiddleware
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
            return redirect()->route('pedagang.login')->with('error', 'Silakan login sebagai pedagang terlebih dahulu.');
        }

        // Opsional: Cek apakah user memiliki role pedagang
        // Uncomment dan sesuaikan dengan struktur database Anda
        /*
        $user = auth()->user();
        if (!$user->is_pedagang || $user->role !== 'pedagang') {
            auth()->logout();
            return redirect()->route('pedagang.login')->with('error', 'Akses ditolak. Anda bukan pedagang.');
        }
        */

        return $next($request);
    }
}