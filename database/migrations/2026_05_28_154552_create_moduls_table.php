<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('moduls', function (Blueprint $table) {
            $table->id();
            $table->enum('modul', ['SIBI', 'BISINDO']);
            $table->string('huruf', 1);
            $table->string('thumbnail')->nullable();
            $table->text('penjelasan')->nullable();
            $table->timestamps();

            $table->unique(['modul', 'huruf']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moduls');
    }
};
