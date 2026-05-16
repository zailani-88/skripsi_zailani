<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Daftar role yang diizinkan masuk ke area admin
        $rolesPetugas = ['super_admin', 'admin_kantor', 'kasir'];

        // 3. Jika rolenya termasuk petugas, izinkan lewat
        if (in_array(Auth::user()->role, $rolesPetugas)) {
            return $next($request);
        }

        // 4. Jika bukan petugas (pelanggan), tendang ke dashboard pelanggan
        return redirect()->route('dashboard')->with('error', 'Akses Ditolak! Anda bukan petugas Orbit Print.');
    }
}