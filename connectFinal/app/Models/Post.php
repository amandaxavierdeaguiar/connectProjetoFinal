<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;

    protected $fillable = ['id_users', 
    'descricao',
     'foto', 
     'titulo', 
     'id_categoria', 
     'id_linguagem'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function linguagem()
    {
        return $this->belongsTo(Linguagem::class, 'id_linguagem');
    }
}
