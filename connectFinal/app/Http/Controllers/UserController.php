<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Exibir lista de usuários
    public function index()
    {
        $users = User::all();
        $users = User::with('curso')->get();
        $userCount = $users->count();


        // Para reutilizar o thumb


        return view('users.manage_users', compact('users','userCount',));


    }

    // Exibir formulário para criar um novo usuário

    public function create()
    {
        $cursos = Curso::all(); // Para popular o campo id_curso no formulário
        return view('users.create', compact('cursos'));
    }

    // Salvar novo usuário no banco de dados
    public function store(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'nif' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'data_nascimento' => 'nullable|date',
            'endereco' => 'nullable|string|max:255',
            'telefone' => 'nullable|string|max:255',
            'user_type' => 'required|integer|in:' . implode(',', [User::ADMIN, User::USER]),
            'id_curso' => 'nullable|exists:curso,id',
            'formacao'=> 'nullable|string|max:255',
            'github'=>'nullable|string|max:255',
            'linkedin'=>'nullable|string|max:255',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nif' => $request->nif,
            'photo' => $photoPath,
            'data_nascimento' => $request->data_nascimento,
            'endereco' => $request->endereco,
            'telefone' => $request->telefone,
            'user_type' => $request->user_type,
            'id_curso' => $request->id_curso,
            'formacao'=> $request->formacao,
            'github'=>$request->github,
            'linkedin'=>$request->linkedin,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }



    public function edit($id)
    {
        $user = User::findOrFail($id);
        $cursos = Curso::all(); // Para popular o campo id_curso no formulário
        return view('users.edit', compact('user', 'cursos'));
    }


    public function update(Request $request, $id)

    {


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'nif' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'data_nascimento' => 'nullable|date',
            'endereco' => 'nullable|string|max:255',
            'telefone' => 'nullable|string|max:255',
            'user_type' => 'required|integer|in:' . implode(',', [User::ADMIN, User::USER]),
            'id_curso' => 'nullable|exists:curso,id',
            'formacao'=> 'nullable|string|max:255',
            'github'=>'nullable|string|max:255',
            'linkedin'=>'nullable|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->nif = $request->nif;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $user->photo = $photoPath;
        }

        $user->data_nascimento = $request->data_nascimento;
        $user->endereco = $request->endereco;
        $user->telefone = $request->telefone;
        $user->user_type = $request->user_type ?? $user->user_type ?? 1;
        $user->id_curso = $request->id_curso;
        $user->formacao = $request->formacao;
        $user->linkedin = $request->linkedin;
        $user->github = $request->github;


        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }


    // public function show($id)
    // {
    //     $user = User::findOrFail($id);
    //     return view('users.show', compact('user'));
    // }


    public function destroy($id)

    {


        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }







    public function show($id)

    {
        $user = User::findOrFail($id);
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


        return view('users.show', compact('user','users', 'linguages', 'linguagensSelecionadas', 'skillUser','wishUser', 'cursoUsers', 'usuariosComDesejosIguais', 'categoria', 'postJob', 'postCurso','postEvento', 'postForum'));
    }



}
