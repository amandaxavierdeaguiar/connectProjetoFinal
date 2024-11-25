<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Linguagem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Mostrar todos os posts
    public function index()
    {
        $posts = Post::with(['user', 'categoria', 'linguagem'])->get();

        // Agrupando os posts por tipo
        $noticias = $posts->where('post_type', 'Notícias');
        $vagas = $posts->where('post_type', 'Vagas de Estágio');
        $cursos = $posts->where('post_type', 'Cursos');
        $eventos = $posts->where('post_type', 'Eventos');
        $forum = $posts->where('post_type', 'Fórum');

        return view('post.manage_post', compact('noticias', 'vagas', 'cursos', 'eventos', 'posts', 'forum'));
    }

    // Exibir formulário para criar um novo post
    public function create()
    {
        $categorias = Categoria::all();
        $linguagens = Linguagem::all();

        // Tipos de postagem permitidos com base no tipo de usuário
        $postTypes = Auth::check() && Auth::user()->user_type === 1
            ? Post::$postTypes // Todos os tipos para admin
            : ['Fórum']; // Apenas Fórum para usuários comuns

        return view('post.create', compact('categorias', 'linguagens', 'postTypes'));
    }

    // Armazenar um novo post
    public function store(Request $request)
{
    $user = Auth::user();

    // Tipos de postagem permitidos com base no tipo de usuário
    $allowedPostTypes = $user->user_type === 1
        ? Post::$postTypes
        : ['Fórum'];

    $validatedData = $request->validate([
        'descricao' => 'required|string|max:500',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'titulo' => 'required|string|max:255',
        'id_categoria' => 'required|exists:categoria,id',
        'id_linguagem' => 'required|exists:linguagem,id',
        'post_type' => ['required', 'string', Rule::in($allowedPostTypes)],
        'created_at' => 'required|date',
    ]);

    if ($request->hasFile('foto')) {
        $validatedData['foto'] = $request->file('foto')->store('fotos', 'public');
    } else {
        $validatedData['foto'] = 'default-post.png';
    }

    // Adiciona o ID do usuário autenticado
    $validatedData['id_users'] = Auth::id();

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
        $categorias = Categoria::all();
        $linguagens = Linguagem::all();

        return view('post.edit', compact('post', 'categorias', 'linguagens'));
    }

    // Atualizar um post existente
    public function update(Request $request, Post $post)
    {
        $user = Auth::user();

        // Tipos de postagem permitidos com base no tipo de usuário
        $allowedPostTypes = $user->user_type === 1
            ? Post::$postTypes
            : ['Fórum'];

        $validatedData = $request->validate([
            'id_users' => 'nullable',
            'descricao' => 'required|string|max:500',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'titulo' => 'required|string|max:255',
            'id_categoria' => 'required|exists:categoria,id',
            'id_linguagem' => 'required|exists:linguagem,id',
            'post_type' => ['required', 'string', Rule::in($allowedPostTypes)],
            'created_at'=>'required|date',
        ]);

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('fotos', 'public');
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
