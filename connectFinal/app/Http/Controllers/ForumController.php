<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function viewForum(){
        // $postForum = DB::table('post')->get();
        $postForum = DB::table('post')->where('post_type', 'Fórum')->get();

        $categoria = DB::table('categoria')->get();

        $linguagem = DB::table('linguagem')->get();

        return view('forum.list_forum', compact('postForum', 'categoria', 'linguagem'));
    }



    public function createForum(Request $request){
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('forum.list')->with('error', 'Usuário não autenticado.');
        }

        if(isset($request->id)){
            $action = 'atualizado';
            // Atualiza post existente
            $request->validate([
                'descricao' => 'required|string|max:500',
                'foto' => 'nullable|image',
                'titulo' => 'required|string|max:255',
                'id_categoria' => 'required|exists:categoria,id',
                'id_linguagem' => 'required|exists:linguagem,id',
                'post_type' => 'required|string|in:Fórum',
            ]);

            // Buscar o post existente
            $post = DB::table('post')->where('id', $request->id)->first();
            $foto = $post->foto; // Mantém a imagem atual

            // Verifica se um novo arquivo foi enviado
            if($request->hasFile('foto')) {
                // Remove a imagem antiga do storage, se existir
                if ($foto) {
                    Storage::delete($foto);
                }
                // Armazena a nova imagem
                $foto = Storage::putFile('uploadedPhotos', $request->foto);
            }
            // Atualiza o post
            DB::table('post')
            ->where('id', $request->id)
            ->update([
                'foto' => $foto,
                'titulo' => $request->titulo,
                'id_categoria' => $request->id_categoria,
                'id_linguagem' => $request->id_linguagem,
                'descricao' => $request->descricao,
                'post_type' => $request->post_type, // Define o post_type como 'Fórum'
                'id_users' => $user->id,
            ]);
        } else {
            $action = 'inserido';

            $request->validate([
                'descricao' => 'required|string|max:500',
                'foto' => 'nullable|image',
                'titulo' => 'required|string|max:255',
                'id_categoria' => 'required|exists:categoria,id',
                'id_linguagem' => 'required|exists:linguagem,id',
                'post_type' => 'required|string|in:Fórum',
            ]);

            $foto = null;

            if($request->hasFile('foto')) {
                $foto = Storage::putFile('uploadedPhotos', $request->foto);
            }

            // Insere o nova linguagem
            DB::table('post')
            ->insert([
                'foto' => $foto,
                'titulo' => $request->titulo,
                'id_categoria' => $request->id_categoria,
                'id_linguagem' => $request->id_linguagem,
                'descricao' => $request->descricao,
                'post_type' => $request->post_type,
                'id_users' => $user->id,
            ]);
        }

        // return redirect()->route('forum.list')->with('message', 'Post  '.$action.' com sucesso!');
        return redirect()->route('user.post.forum')->with('message', 'Post  '.$action.' com sucesso!');
    }

    public function createForumForm() {
        $postForum = DB::table('post')->get();

        $categoria = DB::table('categoria')->get();

        $linguagem = DB::table('linguagem')->get();

        $linguages = DB::table('linguagem')->get();


        $users = Auth::user();

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


        return view('forum.forum_show', compact('postForum', 'categoria','linguagem', 'users', 'linguages', 'linguagensSelecionadas', 'skillUser','wishUser', 'cursoUsers', 'usuariosComDesejosIguais', 'categoria'));
    }

    public function showForum($id) {
        // para pegar id categoria
        $categoria = DB::table('categoria')->get();

        $linguagem = DB::table('linguagem')->get();


        $postForum = DB::table('post')->where('id', $id)->first();

        return view('forum.forum_show', compact('postForum', 'categoria', 'linguagem'));
    }

    public function deletePostForum($id){
        DB::table('post')->where('id', $id)->delete();

        return back();
    }

}
