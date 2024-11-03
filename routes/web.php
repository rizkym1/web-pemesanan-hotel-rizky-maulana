<?php


use Illuminate\Support\Facades\Route;

// Rute untuk halaman utama yang menampilkan view 'welcome'
Route::get('/', function () {
    return view('welcome'); // Mengembalikan tampilan 'welcome'
});

// Rute untuk halaman login, hanya dapat diakses oleh pengguna yang belum login (guest)
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login')->middleware('guest');
// Rute untuk memproses form login, menggunakan metode 'verify' dari AuthController
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'verify'])->name('auth.verify');

// Rute yang hanya dapat diakses oleh admin yang sudah terautentikasi
Route::group(['middleware' => 'auth:admin'], function () {
    // Rute untuk halaman dashboard admin
    Route::get('/admin/home', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');
});

// Rute yang hanya dapat diakses oleh resepsionis yang sudah terautentikasi
Route::group(['middleware' => 'auth:resepsionis'], function () {
    // Rute untuk halaman dashboard resepsionis
    Route::get('/resepsionis/home', [\App\Http\Controllers\Resepsionis\ResepsionisController::class, 'index'])->name('resepsionis.dashboard.index');
});

// Rute yang hanya dapat diakses oleh pengguna biasa yang sudah terautentikasi
Route::group(['middleware' => 'auth:user'], function () {
    // Rute untuk halaman dashboard pengguna
    Route::get('/user/home', [\App\Http\Controllers\User\UserController::class, 'index'])->name('user.dashboard.index');
});

// Rute untuk logout, memanggil metode 'logout' dari AuthController
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
