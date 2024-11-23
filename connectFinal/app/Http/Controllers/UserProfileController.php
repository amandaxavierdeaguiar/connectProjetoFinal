<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function viewUserProfile()
    {
        // Captura o ID do usuário logado
        // $users = Auth::user()->id;
        $users = Auth::user();
        $linguages = DB::table('linguagem')->get();
        $linguagensSelecionadas = DB::table('desejo')
            ->where('id_users', Auth::user()->id)
            ->pluck('id_linguagem')
            ->toArray();
        $skillUser  = DB::table('desejo')
        ->join('linguagem', 'desejo.id_linguagem', '=', 'linguagem.id')
        ->where('desejo.id_users', $users->id)
        ->where('desejo.skill_type', 1)
        ->select('linguagem.id', 'linguagem.name', 'linguagem.foto')
        ->get();

        $wishUser  = DB::table('desejo')
        ->join('linguagem', 'desejo.id_linguagem', '=', 'linguagem.id')
        ->where('desejo.id_users', $users->id)
        ->where('desejo.skill_type', 2)
        ->select('linguagem.id', 'linguagem.name', 'linguagem.foto')
        ->get();

        // $cursoUsers  = DB::table('users')
        // ->join('curso', 'users.id_curso', '=', 'curso.id')
        // ->where('curso.id', $users->id_curso)
        // ->where('id_users', Auth::user()->id)
        // ->select('curso.id', 'curso.nome' as 'curso')
        // ->get();

        $cursoUsers = DB::table('users')
        ->join('curso', 'users.id_curso', '=', 'curso.id')
        ->where('curso.id', $users->id_curso)
        ->where('users.id', Auth::user()->id)
        ->select('curso.id', 'curso.nome as curso')
        ->get();

        return view('user_profile.for_you', compact('users','linguages', 'linguagensSelecionadas', 'skillUser', 'wishUser','cursoUsers'));
    }
}
