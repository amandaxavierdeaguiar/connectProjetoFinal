<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    /**
     * Fetch user data and related information.
     */
    private function getUserData()
    {
        // Logged-in user
        $users = Auth::user();

        // All languages
        $linguages = DB::table('linguagem')->get();

        // All categories
        $categoria = DB::table('categoria')->get();

        // Filter posts by types
        $postJob = DB::table('post')->where('post_type', 'Vagas de Estágio')->get();
        $postCurso = DB::table('post')->where('post_type', 'Cursos')->get();
        $postEvento = DB::table('post')->where('post_type', 'Eventos')->get();
        $postForum = DB::table('post')->where('post_type', 'Forum')->get();
        $postNoticias = DB::table('post')->where('post_type', 'Notícias')->get();

        // Group categories by post ID
        $postCategoriaName = DB::table('post')
            ->join('categoria', 'categoria.id', '=', 'post.id_categoria')
            ->select('post.id as post_id', 'categoria.nome as categoria_nome')
            ->get()
            ->groupBy('post_id'); // Groups categories by the post ID


        // Group categories by post ID
        // $postLinguagemName = DB::table('linguagem')
        //     ->join('linguagem', 'linguagem.id', '=', 'post.id_linguagem')
        //     ->select('post.id as post_id', 'linguagem.name as linguagem_name')
        //     ->get()
        //     ->groupBy('post_id'); // Groups categories by the post ID

        // User selected languages
        $linguagensSelecionadas = DB::table('desejo')
            ->where('id_users', $users->id)
            ->pluck('id_linguagem')
            ->toArray();

        // User skills
        $skillUser = DB::table('desejo')
            ->join('linguagem', 'desejo.id_linguagem', '=', 'linguagem.id')
            ->where('desejo.id_users', $users->id)
            ->where('desejo.skill_type', 1)
            ->select('linguagem.id', 'linguagem.name', 'linguagem.foto')
            ->get();

        // User wishes
        $wishUser = DB::table('desejo')
            ->join('linguagem', 'desejo.id_linguagem', '=', 'linguagem.id')
            ->where('desejo.id_users', $users->id)
            ->where('desejo.skill_type', 2)
            ->select('linguagem.id', 'linguagem.name', 'linguagem.foto')
            ->get();

        // User's course
        $cursoUsers = DB::table('users')
            ->join('curso', 'users.id_curso', '=', 'curso.id')
            ->where('curso.id', $users->id_curso)
            ->where('users.id', $users->id)
            ->select('curso.id', 'curso.nome as curso')
            ->get();

        // Users with similar wishes
        $desejosUsuario = DB::table('desejo')
            ->where('id_users', $users->id)
            ->pluck('id'); // Collect all wish IDs for the current user

        $usuariosComDesejosIguais = DB::table('desejo')
            ->join('users', 'desejo.id_users', '=', 'users.id')
            ->whereIn('desejo.id_linguagem', function ($query) use ($desejosUsuario) {
                $query->select('id_linguagem')
                    ->from('desejo')
                    ->whereIn('id', $desejosUsuario);
            })
            ->where('users.id', '!=', $users->id) // Exclude the logged-in user
            ->select('users.*')
            ->distinct() // Avoid duplicate users
            ->get();

        return compact(
            'users',
            'linguages',
            'linguagensSelecionadas',
            'skillUser',
            'wishUser',
            'cursoUsers',
            'usuariosComDesejosIguais',
            'categoria',
            'postJob',
            'postCurso',
            'postEvento',
            'postForum',
            'postNoticias',
            'postCategoriaName',
        );
    }

        // ); 'postLinguagemName'
    // }

    /**
     * View the "For You" page.
     */
    public function viewUserProfile()
    {
        $data = $this->getUserData();
        return view('user_profile.for_you', $data);
    }

    /**
     * View internship posts.
     */
    public function viewUserPostVagas()
    {
        $data = $this->getUserData();
        return view('user_profile.post_vagas', $data);
    }

    /**
     * View course posts.
     */
    public function viewUserPostCurso()
    {
        $data = $this->getUserData();
        return view('user_profile.post_curso', $data);
    }

    /**
     * View event posts.
     */
    public function viewUserPostEvento()
    {
        $data = $this->getUserData();
        return view('user_profile.post_eventos', $data);
    }

    /**
     * View news posts.
     */
    public function viewUserPostNoticias()
    {
        $data = $this->getUserData();
        return view('components.card_post_user', $data);
    }

    /**
     * View forum posts.
     */
    public function viewUserPostForum()
    {
        $data = $this->getUserData();
        return view('user_profile.post_forum', $data);
    }
}


