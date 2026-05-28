<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Hardcoded credentials
        if ($request->username === 'mara26' && $request->password === '12345') {
            // Set session admin
            Session::put('admin_logged_in', true);
            Session::put('admin_username', $request->username);

            return redirect()->route('admin.pengguna'); // pastikan route ini ada
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Session::forget('admin_logged_in');
        Session::forget('admin_username');
        return redirect()->route('admin.login');
    }
}
