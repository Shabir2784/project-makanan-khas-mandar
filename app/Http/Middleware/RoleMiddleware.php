<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, \Closure $next, $role)
    {
        if (Auth::guard('penggunas')->check() && Auth::guard('penggunas')->user()->role === $role) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Akses ditolak');
    }
}
