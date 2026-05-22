<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quiz_results', function (Blueprint $table) {
            // Tambah kolom durasi dalam detik, boleh null (untuk data lama)
            $table->unsignedInteger('duration_seconds')->nullable()->after('score_percentage');
        });
    }

    public function down(): void
    {
        Schema::table('quiz_results', function (Blueprint $table) {
            $table->dropColumn('duration_seconds');
        });
    }
};