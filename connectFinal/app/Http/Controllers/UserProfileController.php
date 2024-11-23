<?php

namespace App\Http\Controllers;

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

        return view('user_profile.for_you', compact('users','linguages', 'linguagensSelecionadas', 'skillUser', 'wishUser'));
    }
}
