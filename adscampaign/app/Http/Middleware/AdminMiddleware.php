<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna saat ini memiliki peran admin
        if ($request->user() && $request->user()->role !== 'admin') {
            // Jika pengguna bukan admin, arahkan mereka ke halaman lain atau kembalikan pesan error
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        // Jika pengguna memiliki peran admin, lanjutkan permintaan
        return $next($request);
    }
}
