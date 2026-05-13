<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PembelajaranController;
use App\Http\Controllers\HistoriController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AdminAuthController;


Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');

Route::get('/pembelajaran', [PembelajaranController::class, 'index'])
    ->name('pembelajaran');

Route::get('/latihan', function () {
    return view('latihan');
})->name('latihan');

Route::get('/histori', function () {
    return view('histori');
})->name('histori');


Route::get('/pembelajaran/{modul}/{huruf}/detail', [PembelajaranController::class, 'showDetail'])->name('pembelajaran.detail');

Route::get('/pembelajaran/sibi', function () {
    return view('pembelajaran.sibi');
})->name('pembelajaran.sibi');

Route::get('/pembelajaran/bisindo', function () {
    return view('pembelajaran.bisindo');
})->name('pembelajaran.bisindo');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/profil', [ProfilController::class, 'index'])->name('profile');


Route::get('/pembelajaran.index', [PembelajaranController::class, 'index'])->name('pembelajaran.index');
Route::get('/pembelajaran/{modul}/{huruf}', [PembelajaranController::class, 'showHuruf'])->name('pembelajaran.huruf');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/pengguna', [AdminController::class, 'pengguna'])->name('pengguna');
    Route::get('/modul', [AdminController::class, 'modul'])->name('modul');
    Route::get('/kuis', [AdminController::class, 'kuis'])->name('kuis');
});


Route::get('/admin/login', function () {
    return view('auth.admin');  // merujuk ke resources/views/auth/admin.blade.php
})->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');

Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::get('/histori', [HistoriController::class, 'index'])->name('histori');
