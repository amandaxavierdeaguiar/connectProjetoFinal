<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EditPerfilUserController extends Controller
{
    public function viewUserProfile(){
        $userProfile = DB::table('users')->where('id', Auth::id())->first();


        $curso = DB::table('curso')->get();

        return view('edit_perfil_user.list_user', compact('userProfile', 'curso', 'user'));
    }

    public function createUserProfile(Request $request){
        // $user = Auth::user();

        if(isset($request->id)){
            $action = 'atualizado';

            $request->validate([
                'name' => 'required|string|max:255',
                'nif' => 'nullable|string|max:255',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'linkedin' => 'nullable|string|max:255',
                'github' => 'nullable|string|max:255',
                'formacao' => 'nullable|string|max:255',
                'data_nascimento' => 'nullable|date',
                'endereco' => 'nullable|string|max:255',
                'telefone' => 'nullable|string|max:255',
                'id_curso' => 'nullable|exists:curso,id',
            ]);

            // Buscar o user existente
            $user = DB::table('users')->where('id', $request->id)->first();
            $photo = $user->photo; // Mantém a imagem atual

            // Verifica se um novo arquivo foi enviado
            if($request->hasFile('photo')) {
                // Remove a imagem antiga do storage, se existir
                if ($photo) {
                    Storage::delete($photo);
                }
                // Armazena a nova imagem
                $photo = Storage::putFile('uploadedPhotos', $request->photo);
            }
            // Atualiza o post
            DB::table('users')
            ->where('id', $request->id)
            ->update([
                'photo' => $photo,
                'name' => $request->name,
                'nif' => $request->nif,
                'linkedin' => $request->linkedin,
                'github' => $request->github,
                'formacao' => $request->formacao,
                'data_nascimento' => $request->data_nascimento,
                'endereco' => $request->endereco,
                'telefone' => $request->telefone,
                'id_curso' => $request->id_curso,
            ]);
        } else {
            $action = 'inserido';

            $request->validate([
                'name' => 'required|string|max:255',
                'nif' => 'nullable|string|max:255',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'linkedin' => 'nullable|string|max:255',
                'github' => 'nullable|string|max:255',
                'formacao' => 'nullable|string|max:255',
                'data_nascimento' => 'nullable|date',
                'endereco' => 'nullable|string|max:255',
                'telefone' => 'nullable|string|max:255',
                'id_curso' => 'nullable|exists:curso,id',
            ]);

            $photo = null;

            if($request->hasFile('photo')) {
                $photo = Storage::putFile('uploadedPhotos', $request->photo);
            }

            // Insere o nova linguagem
            DB::table('users')
            ->insert([
                'photo' => $photo,
                'name' => $request->name,
                'nif' => $request->nif,
                'linkedin' => $request->linkedin,
                'github' => $request->github,
                'formacao' => $request->formacao,
                'data_nascimento' => $request->data_nascimento,
                'endereco' => $request->endereco,
                'telefone' => $request->telefone,
                'id_curso' => $request->id_curso,
            ]);
        }

        // return redirect()->route('edit_perfil_user.edit_user_show')->with('message', 'Post  '.$action.' com sucesso!');

        // return redirect()->route('edit_perfil_user.list_user')->with('message', 'Post  '.$action.' com sucesso!');

        return redirect()->route('user.foryou')->with('message', 'Post  '.$action.' com sucesso!');
    }

    // Add no formulario
    public function createEditProfileForm() {

        $categoria = DB::table('categoria')->get();

        $linguagem = DB::table('linguagem')->get();

        $linguages = DB::table('linguagem')->get();

        $users = Auth::user();
        $user = Auth::user();

        $curso = DB::table('curso')->get();

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

        return view('edit_perfil_user.edit_user_show', compact( 'user','categoria','linguagem', 'users', 'linguages', 'curso','linguagensSelecionadas', 'skillUser','wishUser', 'cursoUsers', 'usuariosComDesejosIguais', 'categoria'));
    }

    public function showUser($id) {

        $user = Auth::user();
        // $infoUser = DB::table('users')->where('id', $id)->first();
        $curso = DB::table('curso')->get();



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

        return view('edit_perfil_user.edit_user_show', compact('user', 'curso', 'linguagem', 'users', 'linguages', 'linguagensSelecionadas', 'skillUser','wishUser', 'cursoUsers', 'usuariosComDesejosIguais', 'categoria'));
    }

}
