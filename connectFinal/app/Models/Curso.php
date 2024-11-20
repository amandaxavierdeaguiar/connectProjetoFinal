<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao', 
        'quantidade_horas',
        'data_inicio', 
        'data_fim', 'foto',
         'id_categoria',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function linguagens()
    {
        return $this->belongsToMany(Linguagem::class, 'curso_linguagem', 'id_curso', 'id_linguagem');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_curso');
    }
}

