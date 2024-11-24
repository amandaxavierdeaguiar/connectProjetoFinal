<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Linguagem;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Mostrar todos os posts
    public function index()
    {

    $posts = Post::with(['user', 'categoria', 'linguagem'])->get();

    // AQUI EU TENHO QUeries para os vários tipos de post_type
    $noticias = $posts->where('post_type', 'Notícias');
    $vagas = $posts->where('post_type', 'Vagas de Estágio');
    $cursos = $posts->where('post_type', 'Cursos');
    $eventos = $posts->where('post_type', 'Eventos');
    $forum = $posts->where('post_type', 'Forum');

    return view('post.manage_post', compact('noticias', 'vagas', 'cursos', 'eventos', 'posts'));
    }

    // Exibir formulário para criar um novo post
    public function create()
    {
        $users = User::all();
        $categorias = Categoria::all();
        $linguagens = Linguagem::all();
        return view('post.create', compact('users', 'categorias', 'linguagens'));
    }

    // public function createUserAuth()
    // {
    //     $users = User::Auth();
    //     $categorias = Categoria::all();
    //     $linguagens = Linguagem::all();
    //     return view('post.create', compact('users', 'categorias', 'linguagens'));
    // }

    // Armazenar um novo post
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_users' => 'required|exists:users,id',
            'descricao' => 'required|string|max:500',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'titulo' => 'required|string|max:255',
            'id_categoria' => 'required|exists:categoria,id',
            'id_linguagem' => 'required|exists:linguagem,id',
            'post_type' => 'required|string',
        ]);

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('fotos', 'public');
        } else {
            $validatedData['foto'] = 'default-post.png'; // Caminho para a imagem padrão
        }

        Post::create($validatedData);

        return redirect()->route('post.index')->with('success', 'Post criado com sucesso!');
    }

    // Exibir detalhes de um post específico
    public function show(Post $post)
    {
        $post->load(['user', 'categoria', 'linguagem']);
        return view('post.show', compact('post'));
    }

    // Exibir formulário para editar um post
    public function edit(Post $post)
    {
        $users = User::all();
        $categorias = Categoria::all();
        $linguagens = Linguagem::all();
        return view('post.edit', compact('post', 'users', 'categorias', 'linguagens'));
    }

    // Atualizar um post existente
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'id_users' => 'required|exists:users,id',
            'descricao' => 'required|string|max:500',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'titulo' => 'required|string|max:255',
            'id_categoria' => 'required|exists:categoria,id',
            'id_linguagem' => 'required|exists:linguagem,id',
            'post_type' => 'required|string',
        ]);

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('fotos', 'public');
        } else {
            $validatedData['foto'] = './public/images/default-post.png'; // Mantém a foto atual
        }

        $post->update($validatedData);

        return redirect()->route('post.index')->with('success', 'Post atualizado com sucesso!');
    }


    // Deletar um post
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('success', 'Post deletado com sucesso!');
    }



}
