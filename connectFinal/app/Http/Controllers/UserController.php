<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Curso;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Exibir lista de usuários
    public function index()
    {
        $users = User::all();
        return view('users.manage_users', compact('users'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'nif' => 'nullable|string|max:255',
            'photo' => 'nullable|string|max:255',
            'data_nascimento' => 'nullable|date',
            'endereco' => 'nullable|string|max:255',
            'telefone' => 'nullable|string|max:255',
            'user_type' => 'nullable|integer',
            'id_curso' => 'nullable|exists:curso,id',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nif' => $request->nif,
            'photo' => $request->photo,
            'data_nascimento' => $request->data_nascimento,
            'endereco' => $request->endereco,
            'telefone' => $request->telefone,
            'user_type' => $request->user_type,
            'id_curso' => $request->id_curso,
        ]);
        
        $user->save();

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
            'photo' => 'nullable|string|max:255',
            'data_nascimento' => 'nullable|date',
            'endereco' => 'nullable|string|max:255',
            'telefone' => 'nullable|string|max:255',
            'user_type' => 'nullable|integer',
            'id_curso' => 'nullable|exists:curso,id',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->nif = $request->nif;
        $user->photo = $request->photo;
        $user->data_nascimento = $request->data_nascimento;
        $user->endereco = $request->endereco;
        $user->telefone = $request->telefone;
        $user->user_type = $request->user_type;
        $user->id_curso = $request->id_curso;
        
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

  
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

   
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }
}