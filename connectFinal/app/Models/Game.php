<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Game extends Model
{
    use HasFactory;

    protected $fillable = ['id_users',
     'titulo', 
     'descricao',
      'foto', 
      'id_categoria'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
