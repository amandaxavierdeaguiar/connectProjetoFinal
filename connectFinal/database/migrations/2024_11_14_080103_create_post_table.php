<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->longText('descricao');
            $table->string('foto')->nullable();
            $table->string('titulo');
            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')->references('id')->on('categoria')->onDelete('cascade');
            $table->unsignedBigInteger('id_linguagem');
            $table->foreign('id_linguagem')->references('id')->on('linguagem')->onDelete('cascade');
            $table->unsignedBigInteger('post_type');
            $table->foreign('post_type')->references('id')->on('post_type')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('post');
    }
};
