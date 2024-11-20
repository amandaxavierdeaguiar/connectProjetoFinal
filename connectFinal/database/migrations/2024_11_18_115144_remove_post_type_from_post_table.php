<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('post', function (Blueprint $table) {
            // Remove a chave estrangeira antes de apagar a coluna
            $table->dropForeign(['post_type']);
            $table->dropColumn('post_type');
        });
    }

    public function down(): void
    {
        Schema::table('post', function (Blueprint $table) {
            // Recria a coluna e a chave estrangeira no método de rollback
            $table->unsignedBigInteger('post_type');
            $table->foreign('post_type')->references('id')->on('post_type')->onDelete('cascade');
        });
    }
};

