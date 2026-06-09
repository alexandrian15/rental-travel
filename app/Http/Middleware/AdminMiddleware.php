<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->customer()->role != 'admin') {
            abort(403, 'Akses Ditolak');
        }

        return $next($request);
    }
}