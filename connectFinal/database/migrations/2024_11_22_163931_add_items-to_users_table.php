<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('linkedin')->after('photo')->nullable();
            $table->string('github')->after('linkedin')->nullable();
            $table->string('formacao')->after('github')->nullable();
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('linkedin')->after('photo')->nullable();
            $table->string('github')->after('linkedin')->nullable();
            $table->string('formacao')->after('github')->nullable();
        });
    }
};
