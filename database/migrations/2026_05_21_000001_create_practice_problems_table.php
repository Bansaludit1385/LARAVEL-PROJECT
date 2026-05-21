<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('practice_problems', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('difficulty'); // easy, medium, hard
            $table->string('category'); // Array, String, Stack, Two Pointers, DP, etc.
            $table->text('description'); // Markdown content detailing task
            $table->text('starter_code_py')->nullable(); // Python template
            $table->text('starter_code_cpp')->nullable(); // C++ template
            $table->text('starter_code_java')->nullable(); // Java template
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('practice_problems');
    }
};
