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

    public function index()
    {
        $posts = Post::with(['user', 'categoria', 'linguagem'])->get();


        $noticias = $posts->where('post_type', 'Notícias');
        $vagas = $posts->where('post_type', 'Vagas de Estágio');
        $cursos = $posts->where('post_type', 'Cursos');
        $eventos = $posts->where('post_type', 'Eventos');
        $forum = $posts->where('post_type', 'Fórum');

        return view('post.manage_post', compact('noticias', 'vagas', 'cursos', 'eventos', 'posts', 'forum'));
    }


    public function create()
    {
        $categorias = Categoria::all();
        $linguagens = Linguagem::all();


        $postTypes = Auth::check() && Auth::user()->user_type === 1
            ? Post::$postTypes
            : ['Fórum'];

        return view('post.create', compact('categorias', 'linguagens', 'postTypes'));
    }


    public function store(Request $request)
    {
        $user = Auth::user();


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


        $validatedData['id_users'] = Auth::id();

        Post::create($validatedData);

        return redirect()->route('post.index')->with('success', 'Post criado com sucesso!');
    }


    public function show(Post $post)
    {
        $post->load(['user', 'categoria', 'linguagem']);
        return view('post.show', compact('post'));
    }


    public function edit(Post $post)
    {
        $categorias = Categoria::all();
        $linguagens = Linguagem::all();
        $users = User::all();

        return view('post.edit', compact('post', 'categorias', 'linguagens', 'users'));
    }


    public function update(Request $request, Post $post)
    {
        $user = Auth::user();


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
        ]);

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $post->update($validatedData);

        return redirect()->route('post.index')->with('success', 'Post atualizado com sucesso!');
    }


    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('success', 'Post deletado com sucesso!');
    }
}
