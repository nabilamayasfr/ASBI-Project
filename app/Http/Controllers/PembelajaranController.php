<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modul;

class PembelajaranController extends Controller
{
    public function index()
    {
        return view('pembelajaran');
    }

    public function showHuruf($modul, $huruf)
    {
        $dataModul = Modul::where('modul', strtoupper($modul))
            ->where('huruf', strtoupper($huruf))
            ->first();

        return view('huruf', [
            'modul' => strtolower($modul),
            'huruf' => strtolower($huruf),
            'dataModul' => $dataModul
        ]);
    }

    public function showDetail($modul, $huruf)
    {
        $dataModul = Modul::where('modul', strtoupper($modul))
            ->where('huruf', strtoupper($huruf))
            ->firstOrFail();

        return view('detail', [
            'modul' => strtolower($modul),
            'huruf' => strtolower($huruf),
            'dataModul' => $dataModul
        ]);
    }
}
