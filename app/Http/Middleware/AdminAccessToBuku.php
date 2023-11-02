<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminAccessToBuku
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
