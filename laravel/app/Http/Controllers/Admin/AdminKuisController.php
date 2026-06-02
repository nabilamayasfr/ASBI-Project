<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizQuestion;

class AdminKuisController extends Controller
{
    /**
     * Tampilkan halaman admin kuis.
     */
    public function index()
    {
        return view('admin.kuis');
    }

    /**
     * API: Ambil semua soal dikelompokkan per (bahasa + level).
     * GET /admin/kuis/data
     * Ini yang menggantikan loadData() dari localStorage.
     */
    public function getData()
    {
        // Ambil semua soal, dikelompokkan jadi "kuis" per bahasa+level
        $soalSemua = QuizQuestion::orderBy('language')->orderBy('level')->orderBy('id')->get();

        // Buat "grup kuis" berdasarkan bahasa + level
        // Contoh: bisindo-pemula, bisindo-menengah, dst
        $kuisGrup = [];
        $kuisId   = 1;

        $urutanLevel = ['pemula' => 1, 'menengah' => 2, 'mahir' => 3];

        foreach (['bisindo', 'sibi'] as $bahasa) {
            foreach (['pemula', 'menengah', 'mahir'] as $level) {
                $soalDiLevel = $soalSemua->filter(
                    fn($s) => $s->language === $bahasa && $s->level === $level
                )->values();

                $kuisGrup[] = [
                    'id'          => $kuisId++,
                    'bahasa'      => $bahasa,
                    'level'       => $level,
                    'nama'        => strtoupper($bahasa) . ' — ' . ucfirst($level),
                    'jumlah_soal' => $soalDiLevel->count(),
                    'soal'        => $soalDiLevel->map(fn($s) => [
                        'id'             => $s->id,
                        'image_url'      => $s->image_url,   // accessor dari model
                        'image_path'     => $s->image_path,
                        'correct_answer' => $s->correct_answer,
                        'options'        => $s->options,
                        'explanation'    => $s->explanation,
                    ])->values(),
                ];
            }
        }

        return response()->json([
            'kuis'        => $kuisGrup,
            'total_soal'  => $soalSemua->count(),
            'total_level' => 6, // 2 bahasa x 3 level
        ]);
    }

    /**
     * API: Tambah soal baru.
     * POST /admin/soal
     */
    public function tambahSoal(Request $request)
    {
        $request->validate([
            'bahasa'         => 'required|in:bisindo,sibi',
            'level'          => 'required|in:pemula,menengah,mahir',
            'correct_answer' => 'required|string|max:5',
            'options'        => 'required|array|min:2',
            'explanation'    => 'nullable|string',
            'gambar'         => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // Handle upload gambar
        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $file      = $request->file('gambar');
            $huruf     = strtolower($request->correct_answer);
            $folder    = "assets/soal/{$request->bahasa}/{$request->level}";
            $filename  = $huruf . '.png';

            // Simpan ke public/assets/soal/bahasa/level/huruf.png
            $file->move(public_path($folder), $filename);
            $imagePath = "{$request->bahasa}/{$request->level}/{$filename}";
        } else {
            // Kalau tidak ada gambar, pakai path default
            $huruf     = strtolower($request->correct_answer);
            $imagePath = "{$request->bahasa}/{$request->level}/{$huruf}.png";
        }

        $soal = QuizQuestion::create([
            'language'       => $request->bahasa,
            'level'          => $request->level,
            'image_path'     => $imagePath,
            'correct_answer' => strtoupper($request->correct_answer),
            'options'        => $request->options,
            'explanation'    => $request->explanation,
        ]);

        return response()->json([
            'message' => 'Soal berhasil ditambahkan',
            'soal'    => $soal,
        ]);
    }

    /**
     * API: Edit soal.
     * PUT /admin/soal/{id}
     */
    public function editSoal(Request $request, $id)
    {
        $soal = QuizQuestion::findOrFail($id);

        $request->validate([
            'correct_answer' => 'required|string|max:5',
            'options'        => 'required|array|min:2',
            'explanation'    => 'nullable|string',
            'gambar'         => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // Handle upload gambar baru kalau ada
        if ($request->hasFile('gambar')) {
            $file     = $request->file('gambar');
            $huruf    = strtolower($request->correct_answer);
            $folder   = "assets/soal/{$soal->language}/{$soal->level}";
            $filename = $huruf . '.png';
            $file->move(public_path($folder), $filename);
            $soal->image_path = "{$soal->language}/{$soal->level}/{$filename}";
        }

        $soal->correct_answer = strtoupper($request->correct_answer);
        $soal->options        = $request->options;
        $soal->explanation    = $request->explanation;
        $soal->save();

        return response()->json(['message' => 'Soal berhasil diupdate', 'soal' => $soal]);
    }

    /**
     * API: Hapus soal.
     * DELETE /admin/soal/{id}
     */
    public function hapusSoal($id)
    {
        $soal = QuizQuestion::findOrFail($id);
        $soal->delete();

        return response()->json(['message' => 'Soal berhasil dihapus']);
    }
}