<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');
Route::get('/pembelajaran', function () {
    return view('pembelajaran');
})->name('pembelajaran');

Route::get('/latihan', function () {
    return view('latihan');
})->name('latihan');

Route::get('/histori', function () {
    return view('histori');
})->name('histori');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/pembelajaran/sibi', function () {
    return view('pembelajaran.sibi');
})->name('pembelajaran.sibi');

Route::get('/pembelajaran/bisindo', function () {
    return view('pembelajaran.bisindo');
})->name('pembelajaran.bisindo');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

