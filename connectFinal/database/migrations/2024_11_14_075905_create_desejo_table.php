<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('desejo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_linguagem');
            $table->foreign('id_linguagem')->references('id')->on('linguagem')->onDelete('cascade');
            $table->unsignedBigInteger('skill_type')->default(1);
        });
    }

    public function down(): void {
        Schema::dropIfExists('desejo');
    }
};
