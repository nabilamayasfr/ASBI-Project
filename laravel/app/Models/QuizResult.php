<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $fillable = [
        'user_id',
        'language',
        'level',
        'total_questions',
        'correct_answers',
        'score_percentage',
        'duration_seconds',
        'answers_detail',
    ];

    protected $casts = [
        'answers_detail' => 'array',
    ];

    // Relasi: setiap hasil quiz dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}