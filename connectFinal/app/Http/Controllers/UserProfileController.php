<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    // public function viewUserProfile()
    // {
    //     // Captura o ID do usuário logado
    //     // $users = Auth::user()->id;
    //     $users = Auth::user();
    //     $linguages = DB::table('linguagem')->get();

    //     $categoria = DB::table('categoria')->get();

    //     // Para selecionar as linguagens para nao repetirem e bloquearem para o user clicar.
    //     $linguagensSelecionadas = DB::table('desejo')
    //         ->where('id_users', Auth::user()->id)
    //         ->pluck('id_linguagem')
    //         ->toArray();

    //     // Filtra por skill
    //     $skillUser  = DB::table('desejo')
    //     ->join('linguagem', 'desejo.id_linguagem', '=', 'linguagem.id')
    //     ->where('desejo.id_users', $users->id)
    //     ->where('desejo.skill_type', 1)
    //     ->select('linguagem.id', 'linguagem.name', 'linguagem.foto')
    //     ->get();

    //     //filtra por desejo
    //     $wishUser  = DB::table('desejo')
    //     ->join('linguagem', 'desejo.id_linguagem', '=', 'linguagem.id')
    //     ->where('desejo.id_users', $users->id)
    //     ->where('desejo.skill_type', 2)
    //     ->select('linguagem.id', 'linguagem.name', 'linguagem.foto')
    //     ->get();

    //     // Pega o curso que a pessoa fez
    //     $cursoUsers = DB::table('users')
    //     ->join('curso', 'users.id_curso', '=', 'curso.id')
    //     ->where('curso.id', $users->id_curso)
    //     ->where('users.id', Auth::user()->id)
    //     ->select('curso.id', 'curso.nome as curso')
    //     ->get();

    //     // Obtém todos os ids_desejo do usuário autenticado
    //     $desejosUsuario = DB::table('desejo')
    //     ->where('id_users', Auth::user()->id)
    //     ->pluck('id'); // Pluck para obter uma coleção de ids_desejo

    //     // Busca todos os usuários que têm desejos iguais aos do usuário autenticado
    //     $usuariosComDesejosIguais = DB::table('desejo')
    //     ->join('users', 'desejo.id_users', '=', 'users.id')
    //     ->whereIn('desejo.id_linguagem', function($query) use ($desejosUsuario) {
    //         $query->select('id_linguagem')
    //             ->from('desejo')
    //             ->whereIn('id', $desejosUsuario);
    //     })
    //     ->where('users.id', '!=', Auth::user()->id) // Exclui o usuário autenticado
    //     ->select('users.*')
    //     ->distinct() // Para evitar usuários duplicados
    //     ->get();

    //     return view('user_profile.for_you', compact('users','linguages', 'linguagensSelecionadas', 'skillUser', 'wishUser','cursoUsers','usuariosComDesejosIguais', 'categoria'));
    // }

    // public function viewUserPost()
    // {

    //     $postJob = DB::table('post')
    //     ->where('post_type', '=' ,'Vagas de Estágio')
    //     ->get();

    //     return view('user_profile.post_vagas', compact('postJob'));
    // }

    private function getUserData()
    {
    // Captura o ID do usuário logado
    $users = Auth::user();


    $linguages = DB::table('linguagem')->get();
    $categoria = DB::table('categoria')->get();

    // filtrar os post pela vaga de estágio
    $postJob = DB::table('post')->where('post_type', 'Vagas de Estágio')->get();

    // Para selecionar as linguagens para não repetirem e bloquearem para o usuário clicar.
    $linguagensSelecionadas = DB::table('desejo')
        ->where('id_users', Auth::user()->id)
        ->pluck('id_linguagem')
        ->toArray();

    // Filtra por skill
    $skillUser   = DB::table('desejo')
        ->join('linguagem', 'desejo.id_linguagem', '=', 'linguagem.id')
        ->where('desejo.id_users', $users->id)
        ->where('desejo.skill_type', 1)
        ->select('linguagem.id', 'linguagem.name', 'linguagem.foto')
        ->get();

    // Filtra por desejo
    $wishUser   = DB::table('desejo')
        ->join('linguagem', 'desejo.id_linguagem', '=', 'linguagem.id')
        ->where('desejo.id_users', $users->id)
        ->where('desejo.skill_type', 2)
        ->select('linguagem.id', 'linguagem.name', 'linguagem.foto')
        ->get();

    // Pega o curso que a pessoa fez
    $cursoUsers = DB::table('users')
        ->join('curso', 'users.id_curso', '=', 'curso.id')
        ->where('curso.id', $users->id_curso)
        ->where('users.id', Auth::user()->id)
        ->select('curso.id', 'curso.nome as curso')
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

    return compact('users', 'linguages', 'linguagensSelecionadas', 'skillUser','wishUser', 'cursoUsers', 'usuariosComDesejosIguais', 'categoria', 'postJob');
    }

    public function viewUserProfile()
    {
        $data = $this->getUserData();
        return view('user_profile.for_you', $data);
    }

    public function viewUserPost()
    {
        $data = $this->getUserData();
        // Aqui você pode adicionar lógica específica para viewUser Post, se necessário
        return view('user_profile.post_vagas', $data);
    }
}
