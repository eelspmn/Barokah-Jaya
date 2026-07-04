<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Jika belum login, tendang ke halaman login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Jika role di database sesuai dengan role di routing, izinkan masuk
        if (Auth::user()->role === $role) {
            return $next($request);
        }

        // Jika rute tidak sesuai role (misal user maksa masuk ke /owner), tendang ke error
        return redirect('/unauthorized');
    }
}