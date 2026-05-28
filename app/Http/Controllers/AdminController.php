<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin-dashboard');
    }

    public function pengguna()
    {
        $users = User::latest()->get();

        return view('admin_akun', compact('users'));
    }

    public function modul()
    {
        return view('admin-modul');
    }

    public function kuis()
    {
        return view('admin_kuis');
    }
}
