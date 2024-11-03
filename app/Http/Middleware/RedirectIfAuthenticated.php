<?php

namespace App\Http\Middleware;

// Mengimpor kelas yang diperlukan
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated as RedirectIfAuthenticatedMiddleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

// Mendefinisikan kelas middleware untuk mengalihkan pengguna yang sudah terautentikasi
class RedirectIfAuthenticated extends RedirectIfAuthenticatedMiddleware
{
    /**
     * Menangani permintaan yang masuk.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string ...$guards  Daftar pengawal yang digunakan untuk memeriksa autentikasi
     * @return Response | JsonResponse
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response | JsonResponse
    {
        // Memeriksa apakah pengguna sudah terautentikasi sebagai admin
        if (Auth::guard('admin')->check()) {
            // Jika ya, alihkan ke dashboard admin
            return redirect(route('admin.dashboard.index'));
        }
        // Memeriksa apakah pengguna sudah terautentikasi sebagai resepsionis
        else if (Auth::guard('resepsionis')->check()) {
            // Jika ya, alihkan ke dashboard resepsionis
            return redirect(route('resepsionis.dashboard.index'));
        }
        // Memeriksa apakah pengguna sudah terautentikasi sebagai user biasa
        else if (Auth::guard('user')->check()) {
            // Jika ya, alihkan ke dashboard user
            return redirect(route('user.dashboard.index'));
        }

        // Jika pengguna tidak terautentikasi, lanjutkan ke permintaan berikutnya
        return $next($request);
    }
}
