<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizQuestion;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;

class LatihanController extends Controller
{
    /**
     * Tampilkan halaman latihan utama.
     * Blade akan load data via JavaScript (AJAX), bukan langsung dari sini.
     */
    public function index()
    {
        return view('latihan');
    }

    /**
     * API endpoint: ambil soal dari database.
     * Dipanggil dari JavaScript saat user klik "Mulai Kuis".
     * 
     * URL: GET /latihan/soal?language=bisindo&level=pemula
     */
    public function getSoal(Request $request)
    {
        $request->validate([
            'language' => 'required|in:bisindo,sibi',
            'level'    => 'required|in:pemula,menengah,mahir',
        ]);

        $soal = QuizQuestion::where('language', $request->language)
                            ->where('level', $request->level)
                            ->get()
                            ->map(function ($q) {
                                return [
                                    'id'             => $q->id,
                                    'image_url'      => $q->image_url,  // pakai accessor dari model
                                    'correct_answer' => $q->correct_answer,
                                    'options'        => $q->options,    // sudah auto-cast ke array
                                    'explanation'    => $q->explanation,
                                ];
                            })
                            ->shuffle()  // acak urutan soal
                            ->values();

        return response()->json($soal);
    }

    /**
     * API endpoint: simpan hasil quiz ke database.
     * Dipanggil dari JavaScript saat quiz selesai.
     * 
     * URL: POST /latihan/simpan-hasil
     */
    public function simpanHasil(Request $request)
    {
        // Hanya simpan jika user sudah login
        if (!Auth::check()) {
            return response()->json(['message' => 'Tidak login'], 401);
        }

        $request->validate([
            'language'        => 'required|in:bisindo,sibi',
            'level'           => 'required|in:pemula,menengah,mahir',
            'total_questions' => 'required|integer',
            'correct_answers' => 'required|integer',
            'answers_detail'  => 'required|array',
            'duration_seconds' => 'nullable|integer',
        ]);

        $persen = round(($request->correct_answers / $request->total_questions) * 100);

        QuizResult::create([
            'user_id'          => Auth::id(),
            'language'         => $request->language,
            'level'            => $request->level,
            'total_questions'  => $request->total_questions,
            'correct_answers'  => $request->correct_answers,
            'score_percentage' => $persen,
            'duration_seconds' => $request->duration_seconds,
            'answers_detail'   => $request->answers_detail,
        ]);

        return response()->json(['message' => 'Hasil berhasil disimpan', 'score' => $persen]);
    }
}