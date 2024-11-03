<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthVerifyRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function index(): View // Metode untuk menampilkan halaman login
    {
        return view('auth.login'); // Mengembalikan view 'auth.login'
    }

    public function verify(UserAuthVerifyRequest $request): RedirectResponse // Metode untuk memverifikasi kredensial pengguna
    {
        $data = $request->validated(); // Mengambil data yang telah divalidasi dari request

        // Mencoba untuk autentikasi sebagai admin
        if (Auth::guard('admin')->attempt(['username' => $data['username'], 'password' => $data['password'], 'level' => 'admin'])) {
            $request->session()->regenerate(); // Mengregenerasi session untuk keamanan
            return redirect()->intended('/admin/home'); // Mengarahkan ke halaman home admin
        }
        // Mencoba untuk autentikasi sebagai resepsionis
        else if (Auth::guard('resepsionis')->attempt(['username' => $data['username'], 'password' => $data['password'], 'level' => 'resepsionis'])) {
            $request->session()->regenerate(); // Mengregenerasi session
            return redirect()->intended('/resepsionis/home'); // Mengarahkan ke halaman home resepsionis
        }
        // Mencoba untuk autentikasi sebagai user biasa
        else if (Auth::guard('user')->attempt(['username' => $data['username'], 'password' => $data['password'], 'level' => 'user'])) {
            $request->session()->regenerate(); // Mengregenerasi session
            return redirect()->intended('/user/home'); // Mengarahkan ke halaman home user
        }
        // Jika semua upaya autentikasi gagal
        else {
            return redirect(route('login'))->with('msg', 'username dan password salah'); // Mengarahkan kembali ke halaman login dengan pesan kesalahan
        }
    }

    public function logout(): RedirectResponse // Metode untuk logout pengguna
    {
        // Memeriksa dan logout berdasarkan guard yang aktif
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout(); // Logout untuk admin
        } else if (Auth::guard('resepsionis')->check()) {
            Auth::guard('resepsionis')->logout(); // Logout untuk resepsionis
        } else if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout(); // Logout untuk user
        }
        return redirect(route('login')); // Mengarahkan kembali ke halaman login setelah logout
    }
}
