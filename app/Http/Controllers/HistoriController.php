<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizResult;
use App\Models\QuizQuestion;
use Illuminate\Support\Facades\Auth;

class HistoriController extends Controller
{
    const PER_PAGE = 10;

    public function index()
    {
        // ← $userId WAJIB di baris pertama
        $userId = Auth::id();

        // Ambil dengan pagination
        $hasilKuis = QuizResult::where('user_id', $userId)
                               ->latest()
                               ->paginate(self::PER_PAGE);

        // ── FIX N+1: Kumpulkan semua question_id dari semua hasil sekaligus ──
        // Daripada query ke quiz_questions satu per satu per soal,
        // kita ambil semua yang dibutuhkan dalam SATU query
        $semuaQuestionIds = $hasilKuis->getCollection()
            ->flatMap(function ($result) {
                if (!$result->answers_detail) return [];
                return collect($result->answers_detail)
                    ->pluck('question_id')
                    ->filter();
            })
            ->unique()
            ->values()
            ->toArray();

        // Satu query untuk semua soal yang dibutuhkan, simpan ke array indexed by id
        $soalCache = QuizQuestion::whereIn('id', $semuaQuestionIds)
                                 ->get()
                                 ->keyBy('id');  // ['1' => QuizQuestion, '2' => QuizQuestion, ...]

        // Map ke format Blade, dengan soalCache dikirim masuk
        $riwayat = $hasilKuis->getCollection()->map(function ($result) use ($soalCache) {
            return $this->formatHasilKuis($result, $soalCache);
        });

        // Statistik dari semua data user (bukan hanya halaman ini)
        $allResults = QuizResult::where('user_id', $userId)->get();
        $stats = [
            'total_kuis'   => $allResults->count(),
            'rata_skor'    => $allResults->count() > 0
                              ? round($allResults->avg('score_percentage'))
                              : 0,
            'skor_terbaik' => $allResults->count() > 0
                              ? $allResults->max('score_percentage')
                              : 0,
        ];

        // Data grafik 30 hari terakhir
        $grafikData = QuizResult::where('user_id', $userId)
            ->where('created_at', '>=', now()->subDays(30))
            ->latest()
            ->get()
            ->map(fn($r) => [
                'tanggal' => $r->created_at->format('d/m'),
                'skor'    => $r->score_percentage,
                'level'   => ucfirst($r->level),
                'bahasa'  => strtoupper($r->language),
            ])
            ->reverse()
            ->values();

        // Kalau AJAX (load more)
        if (request()->ajax()) {
            return response()->json([
                'html'      => view('partials.riwayat-items', compact('riwayat'))->render(),
                'next_page' => $hasilKuis->nextPageUrl(),
            ]);
        }

        return view('histori', [
            'riwayat'   => $riwayat,
            'stats'     => $stats,
            'next_page' => $hasilKuis->nextPageUrl(),
            'grafik'    => $grafikData,
        ]);
    }

    // ── Terima $soalCache sebagai parameter, bukan query lagi ──
    private function formatHasilKuis(QuizResult $result, $soalCache = null): array
    {
        $bahasa     = strtoupper($result->language);
        $levelLabel = ucfirst($result->level);
        $tanggal    = $result->created_at->locale('id')->isoFormat('D MMMM YYYY, HH:mm');
        $benar      = $result->correct_answers;
        $salah      = $result->total_questions - $benar;

        $soalDetail = [];
        if ($result->answers_detail) {
            foreach ($result->answers_detail as $idx => $ans) {
                $soalDetail[] = [
                    'nomor'         => $idx + 1,
                    'soal'          => 'Huruf apa yang ditunjukkan gerakan ini?',
                    'img'           => ltrim(parse_url($ans['image_url'] ?? '', PHP_URL_PATH), '/'),
                    'jawaban_benar' => $ans['correct_answer'] ?? '',
                    'jawaban_user'  => $ans['user_answer']    ?? '',
                    'benar'         => $ans['is_correct']     ?? false,
                    'pilihan'       => $this->getPilihanFromCache($ans, $soalCache),
                ];
            }
        }

        return [
            'tipe'        => 'kuis',
            'judul'       => 'Kuis ' . $bahasa,
            'subjudul'    => 'Level ' . $levelLabel . ' · ' . $result->created_at->locale('id')->isoFormat('D MMM YYYY'),
            'skor'        => $result->score_percentage,
            'benar'       => $benar,
            'salah'       => $salah,
            'total_soal'  => $result->total_questions,
            'tanggal'     => $tanggal,
            'durasi'      => isset($result->duration_seconds) && $result->duration_seconds
                             ? gmdate('i:s', $result->duration_seconds) . ' menit'
                             : '—',
            'kategori'    => $bahasa,
            'level'       => $levelLabel,
            'soal_detail' => $soalDetail,
        ];
    }

    // ── Ambil pilihan dari cache, bukan query ──
    private function getPilihanFromCache(array $ans, $soalCache = null): array
    {
        if ($soalCache && !empty($ans['question_id'])) {
            $soal = $soalCache->get($ans['question_id']);
            if ($soal) return $soal->options;
        }

        // Fallback kalau soal sudah dihapus atau cache kosong
        $pilihan = [$ans['correct_answer'] ?? ''];
        if (isset($ans['user_answer']) && $ans['user_answer'] !== $ans['correct_answer']) {
            $pilihan[] = $ans['user_answer'];
        }
        return array_unique($pilihan);
    }
}