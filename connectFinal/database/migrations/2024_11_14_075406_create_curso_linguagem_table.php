<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('curso_linguagem', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_curso')->nullable();
            $table->foreign('id_curso')->references('id')->on('curso')->onDelete('cascade');
            $table->unsignedBigInteger('id_linguagem');
            $table->foreign('id_linguagem')->references('id')->on('linguagem')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('curso_linguagem');
    }
};
