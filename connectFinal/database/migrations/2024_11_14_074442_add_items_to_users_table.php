<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->string('nif')->nullable()->after('name');
            $table->string('photo')->nullable()->after('nif');
            $table->date('data_nascimento')->nullable()->after('photo');
            $table->string('endereco')->nullable()->after('data_nascimento');
            $table->string('telefone')->nullable()->after('endereco');
            $table->unsignedBigInteger('user_type')->default(1)->comment('user_type_Admin==0')->after('telefone');
            $table->unsignedBigInteger('id_curso')->nullable()->after('user_type');
            $table->foreign('id_curso')->references('id')->on('curso')->onDelete('set null')->after('id_curso');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            
        });
    }
};
