<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Data statistik (contoh - sesuaikan dengan database Anda)
        $totalLatihan = 25;
        $hurufTerakhir = 'K';
        $progressCount = 12;
        $progressPercent = round(($progressCount / 26) * 100);

        return view('profil', compact('user', 'totalLatihan', 'hurufTerakhir', 'progressCount', 'progressPercent'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'nomor_telepon' => 'nullable|string|max:15',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->nama_lengkap;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->nomor_telepon;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
