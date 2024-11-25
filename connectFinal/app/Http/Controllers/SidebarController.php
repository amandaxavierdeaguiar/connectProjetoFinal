<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SidebarController extends Controller
{
    public function viewSidebar(Request $request)
    {
        // Captura o ID do usuário logado
        // $users = Auth::user()->id;
        $users = Auth::user();

        $linguages = DB::table('linguagem')->get();



        $categoria = DB::table('categoria')->get();
        // Recupera todas as linguagens disponíveis

        // $categoria = DB::table('categoria')->get();

        // Recupera as linguagens já selecionadas pelo usuário
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

        // Obtém todos os ids_desejo do usuário autenticado
        $desejosUsuario = DB::table('desejo')
        ->where('id_users', Auth::user()->id)
        ->pluck('id'); // Pluck para obter uma coleção de ids_desejo

        // Busca todos os usuários que têm desejos iguais aos do usuário autenticado
        $usuariosComDesejosIguais = DB::table('desejo')
        ->join('users', 'desejo.id_users', '=', 'users.id')
        ->whereIn('desejo.id_linguagem', function($query) use ($desejosUsuario) {
            $query->select('id_linguagem')
                ->from('desejo')
                ->whereIn('id', $desejosUsuario);
        })
        ->where('users.id', '!=', Auth::user()->id) // Exclui o usuário autenticado
        ->select('users.*')
        ->distinct() // Para evitar usuários duplicados
        ->get();

        // Pega o curso que a pessoa fez
        $cursoUsers = DB::table('users')
        ->join('curso', 'users.id_curso', '=', 'curso.id')
        ->where('curso.id', $users->id_curso)
        ->where('users.id', Auth::user()->id)
        ->select('curso.id', 'curso.nome as curso')
        ->get();

        // Verifica se o modo de edição está ativado
        $isEditing = $request->query('edit') === 'true';

        return view('user_profile.for_you', compact('users','linguages', 'linguagensSelecionadas', 'skillUser', 'wishUser', 'cursoUsers','usuariosComDesejosIguais', 'categoria', 'isEditing'));
    }
}
