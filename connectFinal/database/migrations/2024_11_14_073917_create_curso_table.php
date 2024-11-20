<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('curso', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->longText('descricao')->nullable();
            $table->unsignedBigInteger('quantidade_horas')->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')->references('id')->on('categoria')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('curso');
    }
};
