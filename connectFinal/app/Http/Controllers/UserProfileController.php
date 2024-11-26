<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    private function getUserData()
    {
    // Captura o ID do usuário logado
    $users = Auth::user();


    $linguages = DB::table('linguagem')->get();

    $categoria = DB::table('categoria')->get();

    // filtrar os post pela vaga de estágio
    $postJob = DB::table('post')->where('post_type', 'Vagas de Estágio')->get();

    // filtrar os post pelos Cursos
    $postCurso = DB::table('post')->where('post_type', 'Cursos')->get();

    // filtrar os post pelos Eventos
    $postEvento = DB::table('post')->where('post_type', 'Eventos')->get();

    // filtrar os post pelos Eventos
    $postForum = DB::table('post')->where('post_type', 'Forum')->get();



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

    return compact('users', 'linguages', 'linguagensSelecionadas', 'skillUser','wishUser', 'cursoUsers', 'usuariosComDesejosIguais', 'categoria', 'postJob', 'postCurso','postEvento', 'postForum');
    }

    public function viewUserProfile()
    {
        $data = $this->getUserData();
        return view('user_profile.for_you', $data);
    }

    public function viewUserPostVagas()
    {
        $data = $this->getUserData();

        return view('user_profile.post_vagas', $data);
    }

    public function viewUserPostCurso()
    {
        $data = $this->getUserData();

        return view('user_profile.post_curso', $data);
    }

    public function viewUserPostEvento()
    {
        $data = $this->getUserData();

        return view('user_profile.post_eventos', $data);
    }

    // public function formsForum()
    // {
    //     // $data = $this->getUserData();
    //     $posts = DB::table('post')->get();

    //     // return view('user_profile.create_post_forum', $data);

    //     return view('user_profile.create_post_forum',  compact('posts'));
    // }

    public function viewUserPostForum()
    {
        $data = $this->getUserData();
        // $posts = DB::table('post')->get();

       return view('user_profile.post_forum', $data);
    }
}
    // public function showForum($id)
    // {
    //     // para pegar id categoria
    //     $categoria = DB::table('categoria')->get();
    //     // para pegar id linguagem
    //     $linguagem = DB::table('linguagem')->get();

    //     $posts = DB::table('post')->where('id', $id)->first();


    //    return view('user_profile.post_forum', compact('posts', 'categoria', 'linguagem'));
    // }

//     public function showForum($id)
//     {
//         // para pegar id categoria
//         $categoria = DB::table('categoria')->get();
//         // para pegar id linguagem
//         $linguagem = DB::table('linguagem')->get();

//         $posts = DB::table('post')->where('id', $id)->first();


//        return view('user_profile.create_post_forum', compact('posts', 'categoria', 'linguagem'));
//     }


//     public function storeUserProfile(Request $request)
//     {
//         $user = Auth::user();

//         if(isset($request->id)){
//             $action = 'atualizado';
//             // Atualiza post existente
//             $request->validate([
//                 'descricao' => 'required|string|max:500',
//                 'foto' => 'nullable|image',
//                 'titulo' => 'required|string|max:255',
//                 'id_categoria' => 'required|exists:categoria,id',
//                 'id_linguagem' => 'required|exists:linguagem,id',
//                 'post_type' => 'required|string|in:Fórum',
//             ]);

//             // Buscar o post existente
//             $post = DB::table('post')->where('id', $request->id)->first();
//             $foto = $post->foto; // Mantém a imagem atual

//             // Verifica se um novo arquivo foi enviado
//             if($request->hasFile('foto')) {
//                 // Remove a imagem antiga do storage, se existir
//                 if ($foto) {
//                     Storage::delete($foto);
//                 }
//                 // Armazena a nova imagem
//                 $foto = Storage::putFile('uploadedPhotos', $request->foto);
//             }
//             // Atualiza o post
//             DB::table('post')
//             ->where('id', $request->id)
//             ->update([
//                 'foto' => $foto,
//                 'titulo' => $request->titulo,
//                 'id_categoria' => $request->id_categoria,
//                 'id_linguagem' => $request->id_linguagem,
//                 'descricao' => $request->descricao,
//                 'post_type' => 'Fórum', // Define o post_type como 'Fórum'
//                 'id_users' => $user,
//             ]);
//         } else {
//             $action = 'inserido';

//             $request->validate([
//                 'descricao' => 'required|string|max:500',
//                 'foto' => 'nullable|image',
//                 'titulo' => 'required|string|max:255',
//                 'id_categoria' => 'required|exists:categoria,id',
//                 'id_linguagem' => 'required|exists:linguagem,id',
//                 'post_type' => 'required|string|in:Fórum',
//             ]);

//             $foto = null;

//             if($request->hasFile('foto')) {
//                 $foto = Storage::putFile('uploadedPhotos', $request->foto);
//             }

//             // Insere o nova linguagem
//             DB::table('post')
//             ->insert([
//                 'foto' => $foto,
//                 'titulo' => $request->titulo,
//                 'id_categoria' => $request->id_categoria,
//                 'id_linguagem' => $request->id_linguagem,
//                 'descricao' => $request->descricao,
//                 'post_type' => 'Fórum', // Define o post_type como 'Fórum'
//                 'id_users' => $user,
//             ]);
//         }

//         return redirect()->route('user.post.forum')->with('message', 'Post  '.$action.' com sucesso!');
//     }
// }





    // public function updateUserProfile(Request $request)
    // {
    //     if(isset($request->id)){
    //         $action = 'atualizado';
    //         $request->validate([
    //             'name' => 'required|string|max:255',
    //             'email' => 'required|email|unique:users,email',
    //             'password' => 'required|string|min:6',
    //             'nif' => 'nullable|string|max:255',
    //             'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //             'data_nascimento' => 'nullable|date',
    //             'endereco' => 'nullable|string|max:255',
    //             'telefone' => 'nullable|string|max:255',
    //             'id_curso' => 'nullable|exists:curso,id',
    //             ]);

    //         // Buscar o user existente
    //         $fotoUser = DB::table('users')->where('id',$request->id)->first();
    //         $photo = $fotoUser->photo; // Mantém a imagem atual

    //         if($request->hasFile('photo')) {
    //             if ($photo) {
    //                 Storage::delete($photo);
    //             }
    //             $photo = Storage::putFil('uploadedPhotos', $request->photo);
    //         }

    //         DB::table('users')
    //         ->where('id', $request->id)
    //         ->update([
    //             'name' => $request->name,
    //             'photo' => $photo,
    //             'email' => $request->email,
    //             'password' => $request->bcrypt($request->password),
    //             'nif' => $request->nif,
    //             'data_nascimento' => $request->date,
    //             'endereco' => $request->endereco,
    //             'telefone' => $request->telefone,
    //             'id_curso' => $request->id_curso,
    //         ]);
    //     } else {
    //         $action = 'inserido';
    //         $request->validate([
    //             'name' => 'required|string|max:255',
    //             'email' => 'required|email|unique:users,email',
    //             'password' => 'required|string|min:6',
    //             'nif' => 'nullable|string|max:255',
    //             'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //             'data_nascimento' => 'nullable|date',
    //             'endereco' => 'nullable|string|max:255',
    //             'telefone' => 'nullable|string|max:255',
    //             'id_curso' => 'nullable|exists:curso,id',
    //         ]);

    //         $photo = null;

    //         if($request->hasFile('photo')) {
    //             $photo = Storage::putFil('uploadedPhotos', $request->photo);
    //         }

    //         DB::table('users')
    //         ->insert([
    //             'name' => $request->name,
    //             'photo' => $photo,
    //             'email' => $request->email,
    //             'password' => $request->bcrypt($request->password),
    //             'nif' => $request->nif,
    //             'data_nascimento' => $request->date,
    //             'endereco' => $request->endereco,
    //             'telefone' => $request->telefone,
    //             'id_curso' => $request->id_curso,
    //         ]);
    //     }

    //     return redirect()->route('user_profile.for_you')->with('message', 'User '.$action.' com sucesso!');
    //     }



    // }





