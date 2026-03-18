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
     * @param  Closure(Request): (Response)  $next
     */
  public function handle(Request $request, Closure $next): Response
{
    // Cek apakah user sudah login dan apakah rolenya admin
    if (auth()->check() && auth()->user()->role === 'admin') {
        return $next($request);
    }

    // Jika bukan admin, lempar balik ke halaman utama
    return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
}
}
