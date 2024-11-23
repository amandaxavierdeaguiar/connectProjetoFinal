<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SidebarController extends Controller
{
    public function viewSidebar()
    {
        $users = Auth::user()->id;
        $users = Auth::user();

        $linguages = DB::table('linguagem')->get();

        // Recupera as linguagens já selecionadas pelo usuário
        $linguagensSelecionadas = DB::table('desejo')
            ->where('id_users', $users)
            ->pluck('id_linguagem')
            ->toArray();

        // Recupera as habilidades e desejos já cadastrados
        $desejos = DB::table('desejo')->where('id_users', $users)->where('skill_type', 2)->pluck('id_linguagem')->toArray();
        $skills = DB::table('desejo')->where('id_users', $users)->where('skill_type', 1)->pluck('id_linguagem')->toArray();

        return view('sidebar.index_sidebar', compact('linguages', 'linguagensSelecionadas', 'desejos', 'skills','users'));
    }
    // public function viewSidebar()
    // {
    //     // Captura o ID do usuário logado
    //     // $users = Auth::user()->id;
    //     $users = Auth::user();

    //     $linguages = DB::table('linguagem')->get();
    //     // Recupera todas as linguagens disponíveis

    //     // Recupera as linguagens já selecionadas pelo usuário
    //     $linguagensSelecionadas = DB::table('desejo')
    //         ->where('id_users', Auth::user()->id)
    //         ->pluck('id_linguagem')
    //         ->toArray();


    //     return view('sidebar.index_sidebar', compact('users','linguages', 'linguagensSelecionadas'));
    // }
}
