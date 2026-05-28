<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            
            // Bahasa isyarat: 'bisindo' atau 'sibi'
            $table->enum('language', ['bisindo', 'sibi']);
            
            // Level kesulitan
            $table->enum('level', ['pemula', 'menengah', 'mahir']);
            
            // Path gambar relatif dari folder public/assets/soal/
            // Contoh: "bisindo/pemula/a.png"
            $table->string('image_path');
            
            // Jawaban benar, contoh: "A"
            $table->string('correct_answer', 10);
            
            // Pilihan jawaban disimpan sebagai JSON
            // Contoh: ["A","B","C","D"]
            $table->json('options');
            
            // Penjelasan singkat gesture ini
            $table->text('explanation')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};