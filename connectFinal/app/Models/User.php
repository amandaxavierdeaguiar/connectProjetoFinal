<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // ANTIGO
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];


    const ADMIN = 1;
    const USER = 2;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nif', 'photo',
        'data_nascimento',
        'endereco',
        'telefone',
        'user_type',
        'id_curso',
    ];

    public function isAdmin()
    {
        return $this->user_type === self::ADMIN;
    }

    // Verifica se o usuário é comum
    public function isUser()
    {
        return $this->user_type === self::USER;
    }
   
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso');
    }

    public function desejos()
    {
        return $this->hasMany(Desejo::class, 'id_users');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_users');
    }

    public function games()
    {
        return $this->hasMany(Game::class, 'id_users');
    }
}
