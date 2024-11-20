<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Desejo extends Model
{
    use HasFactory;

    protected $fillable = ['id_users', 'id_linguagem', 'skill_type'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function linguagem()
    {
        return $this->belongsTo(Linguagem::class, 'id_linguagem');
    }
}
