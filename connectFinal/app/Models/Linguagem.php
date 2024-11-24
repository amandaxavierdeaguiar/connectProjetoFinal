<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Linguagem extends Model
{
    use HasFactory;
    protected $table = 'linguagem';
    protected $fillable = ['name', 'foto', 'id_categoria'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_linguagem', 'id_linguagem', 'id_curso');
    }

    public function desejos()
    {
        return $this->hasMany(Desejo::class, 'id_linguagem');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_linguagem');
    }
}
