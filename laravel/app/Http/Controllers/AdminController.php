<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Modul;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

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
        $moduls = Modul::orderBy('modul')->orderBy('huruf')->get();

        $bisindo = $moduls->where('modul', 'BISINDO');
        $sibi = $moduls->where('modul', 'SIBI');

        return view('admin-modul', compact('moduls', 'bisindo', 'sibi'));
    }

    public function storeModul(Request $request)
    {
        $request->validate([
            'modul' => 'required|in:SIBI,BISINDO',
            'huruf' => [
                'required',
                'string',
                'size:1',
                Rule::unique('moduls')->where(function ($query) use ($request) {
                    return $query->where('modul', strtoupper($request->modul))
                                 ->where('huruf', strtoupper($request->huruf));
                }),
            ],
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'penjelasan' => 'nullable|string',
        ]);

        $thumbnailPath = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('modul-thumbnails', 'public');
        }

        Modul::create([
            'modul' => strtoupper($request->modul),
            'huruf' => strtoupper($request->huruf),
            'thumbnail' => $thumbnailPath,
            'penjelasan' => $request->penjelasan,
        ]);

        return redirect()->route('admin.modul')->with('success', 'Modul berhasil ditambahkan.');
    }

    public function updateModul(Request $request, $id)
    {
        $modulData = Modul::findOrFail($id);

        $request->validate([
            'modul' => 'required|in:SIBI,BISINDO',
            'huruf' => [
                'required',
                'string',
                'size:1',
                Rule::unique('moduls')->where(function ($query) use ($request) {
                    return $query->where('modul', strtoupper($request->modul))
                                 ->where('huruf', strtoupper($request->huruf));
                })->ignore($modulData->id),
            ],
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'penjelasan' => 'nullable|string',
        ]);

        $thumbnailPath = $modulData->thumbnail;

        if ($request->hasFile('thumbnail')) {
            if ($modulData->thumbnail && Storage::disk('public')->exists($modulData->thumbnail)) {
                Storage::disk('public')->delete($modulData->thumbnail);
            }

            $thumbnailPath = $request->file('thumbnail')->store('modul-thumbnails', 'public');
        }

        $modulData->update([
            'modul' => strtoupper($request->modul),
            'huruf' => strtoupper($request->huruf),
            'thumbnail' => $thumbnailPath,
            'penjelasan' => $request->penjelasan,
        ]);

        return redirect()->route('admin.modul')->with('success', 'Modul berhasil diperbarui.');
    }

    public function kuis()
    {
        return view('admin_kuis');
    }
}
