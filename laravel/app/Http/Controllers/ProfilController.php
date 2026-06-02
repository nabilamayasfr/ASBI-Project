<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\QuizResult;

class ProfilController extends Controller
{
    /**
     * Tampilkan halaman profil + statistik user.
     */
    public function index()
    {
        $user   = Auth::user();
        $userId = $user->id;

        // ── Total latihan (berapa kali kuis diselesaikan) ──
        $totalLatihan = QuizResult::where('user_id', $userId)->count();

        // ── Huruf terakhir yang dipelajari ──
        // Ambil hasil kuis terbaru, lalu ambil jawaban terakhir yang BENAR
        $hurufTerakhir = '-';
        $hasilTerakhir = QuizResult::where('user_id', $userId)
                                   ->latest()
                                   ->first();

        if ($hasilTerakhir && $hasilTerakhir->answers_detail) {
            // Cari jawaban terakhir yang benar dari kuis paling baru
            $jawabanBenar = collect($hasilTerakhir->answers_detail)
                ->filter(fn($a) => $a['is_correct'] === true)
                ->last();

            if ($jawabanBenar) {
                $hurufTerakhir = $jawabanBenar['correct_answer'];
            }
        }

        // ── Progress: berapa huruf unik yang sudah pernah dijawab benar ──
        // Kita kumpulkan semua jawaban benar dari semua kuis user ini
        $semuaHasil = QuizResult::where('user_id', $userId)->get();

        $hurufDikuasai = collect();
        foreach ($semuaHasil as $hasil) {
            if (!$hasil->answers_detail) continue;
            foreach ($hasil->answers_detail as $ans) {
                if ($ans['is_correct'] === true) {
                    // Tambahkan huruf ke koleksi (nanti di-unique)
                    $hurufDikuasai->push(strtoupper($ans['correct_answer']));
                }
            }
        }

        // Hitung huruf unik yang sudah pernah benar (dari 26 huruf)
        $progressCount   = $hurufDikuasai->unique()->count();
        $progressPercent = round(($progressCount / 26) * 100);

        // ── Statistik tambahan per bahasa (untuk info detail) ──
        $statPerBahasa = [
            'bisindo' => [
                'total'        => QuizResult::where('user_id', $userId)->where('language', 'bisindo')->count(),
                'rata_skor'    => round(QuizResult::where('user_id', $userId)->where('language', 'bisindo')->avg('score_percentage') ?? 0),
                'skor_terbaik' => QuizResult::where('user_id', $userId)->where('language', 'bisindo')->max('score_percentage') ?? 0,
            ],
            'sibi' => [
                'total'        => QuizResult::where('user_id', $userId)->where('language', 'sibi')->count(),
                'rata_skor'    => round(QuizResult::where('user_id', $userId)->where('language', 'sibi')->avg('score_percentage') ?? 0),
                'skor_terbaik' => QuizResult::where('user_id', $userId)->where('language', 'sibi')->max('score_percentage') ?? 0,
            ],
        ];

        return view('profil', compact(
            'user',
            'totalLatihan',
            'hurufTerakhir',
            'progressCount',
            'progressPercent',
            'statPerBahasa',
        ));
    }

    /**
     * Simpan perubahan profil user.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_lengkap'  => 'required|string|max:100',
            'username'      => ['nullable', 'string', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],
            'email'         => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'nomor_telepon' => 'nullable|string|max:20',
            'password'      => 'nullable|string|min:8|confirmed',
        ]);

        // Update field dasar
        $user->name  = $request->nama_lengkap;
        $user->email = $request->email;

        // Update username jika kolom ada
        if (isset($user->username)) {
            $user->username = $request->username;
        }

        // Update phone jika kolom ada
        if (isset($user->phone)) {
            $user->phone = $request->nomor_telepon;
        }

        // Update password hanya kalau diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui!');
    }
}