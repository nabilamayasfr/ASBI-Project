<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = [
        'language',
        'level',
        'image_path',
        'correct_answer',
        'options',
        'explanation',
    ];

    // Otomatis convert kolom 'options' dari JSON string ke array PHP
    protected $casts = [
        'options' => 'array',
    ];

    /**
     * Helper: kembalikan URL lengkap gambar
     * Contoh: /assets/soal/bisindo/pemula/a.png
     */
    public function getImageUrlAttribute(): string
    {
        return asset('assets/soal/' . $this->image_path);
    }
}