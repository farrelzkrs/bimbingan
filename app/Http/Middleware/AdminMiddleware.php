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
    // Cek jika user login DAN role-nya admin
    if ($request->user() && $request->user()->role === 'admin') {
        return $next($request);
    }

    // Jika bukan admin, lempar error 403 atau redirect
    abort(403, 'Anda tidak memiliki akses ke halaman Admin.');
}
}
