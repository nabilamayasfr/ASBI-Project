<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_results', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke tabel users (Laravel default)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Bahasa dan level yang dimainkan
            $table->enum('language', ['bisindo', 'sibi']);
            $table->enum('level', ['pemula', 'menengah', 'mahir']);
            
            // Statistik hasil
            $table->integer('total_questions');
            $table->integer('correct_answers');
            $table->integer('score_percentage'); // 0-100
            
            // Detail jawaban user disimpan sebagai JSON
            // Format: [{"question_id":1,"user_answer":"A","correct_answer":"A","is_correct":true}, ...]
            $table->json('answers_detail')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_results');
    }
};