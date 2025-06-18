<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class penjualMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'penjual') {
            return $next($request);
        }
        abort(403, 'Akses hanya untuk penjual.');
    }
}
