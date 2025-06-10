<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
{
    \Log::info('Authenticate Middleware triggered for URL: '.$request->url());

    if (! $request->expectsJson()) {
        if ($request->is('admin/*')) {
            \Log::info('Redirecting to admin login');
            return route('admin.login');
        }

        if ($request->is('pedagang/*')) {
            \Log::info('Redirecting to pedagang login');
            return route('pedagang.login');
        }

        \Log::info('Redirecting to default pedagang login');
        return route('pedagang.login');
    }
}


}
