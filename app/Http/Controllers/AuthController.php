<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthVerifyRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
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

    public function register(): View
    {
        return view('auth.register');
    }

    public function verify(UserAuthVerifyRequest $request): RedirectResponse // Metode untuk memverifikasi kredensial pengguna
    {
        $data = $request->validated(); // Mengambil data yang telah divalidasi dari request

        // Mencoba untuk autentikasi sebagai admin
        if (Auth::guard('admin')->attempt(['username' => $data['username'], 'password' => $data['password'], 'level' => 'admin'])) {
            $request->session()->regenerate(); // Mengregenerasi session untuk keamanan
            notify()->success('Anda berhasil login!');
            return redirect()->intended('/admin/kamar'); // Mengarahkan ke halaman home admin
        }
        // Mencoba untuk autentikasi sebagai resepsionis
        else if (Auth::guard('resepsionis')->attempt(['username' => $data['username'], 'password' => $data['password'], 'level' => 'resepsionis'])) {
            $request->session()->regenerate(); // Mengregenerasi session
            notify()->success('Anda berhasil login!');
            return redirect()->intended('/resepsionis/home'); // Mengarahkan ke halaman home resepsionis
        }
        // Mencoba untuk autentikasi sebagai user biasa
        else if (Auth::guard('user')->attempt(['username' => $data['username'], 'password' => $data['password'], 'level' => 'user'])) {
            $request->session()->regenerate(); // Mengregenerasi session
            notify()->success('Anda berhasil login!');
            return redirect()->intended('/user/home'); // Mengarahkan ke halaman home user
        }
        // Jika semua upaya autentikasi gagal
        else {
            return redirect(route('login'))->with('msg', 'username dan password salah!'); // Mengarahkan kembali ke halaman login dengan pesan kesalahan
        }
    }

    public function registerUser(UserRegisterRequest $request): RedirectResponse
    {
        // Validasi data yang diterima
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        // Tambahkan level user
        $data['level'] = 'user';

        // Simpan data pengguna baru
        User::create($data);


        notify()->success('Anda berhasil daftar akun silahkan login!');
        return redirect()->route('login');
    }


    public function logout(): RedirectResponse
    {
        // Memeriksa dan logout berdasarkan guard yang aktif
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout(); // Logout untuk admin
        } else if (Auth::guard('resepsionis')->check()) {
            Auth::guard('resepsionis')->logout(); // Logout untuk resepsionis
        } else if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout(); // Logout untuk user
        }
        notify()->info('Anda berhasil Logout!');
        return redirect(route('login')); // Mengarahkan kembali ke halaman login setelah logout
    }
}
