<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Categoria extends Model

{
    protected $table = 'categoria';
    use HasFactory;
    protected $fillable = ['nome', 'descricao'];

    public function cursos()
    {
        return $this->hasMany(Curso::class, 'id_categoria');
    }

    public function linguagens()
    {
        return $this->hasMany(Linguagem::class, 'id_categoria');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_categoria');
    }

    public function games()
    {
        return $this->hasMany(Game::class, 'id_categoria');
    }
}
