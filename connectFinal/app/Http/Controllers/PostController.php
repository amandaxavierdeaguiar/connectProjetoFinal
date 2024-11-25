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

        $noticias = $posts->where('post_type', 'Notícias');
        $vagas = $posts->where('post_type', 'Vagas de Estágio');
        $cursos = $posts->where('post_type', 'Cursos');
        $eventos = $posts->where('post_type', 'Eventos');
        $forum = $posts->where('post_type', 'Fórum');

        return view('post.manage_post', compact('noticias', 'vagas', 'cursos', 'eventos', 'posts', 'forum'));
    }

    // Exibir formulário para editar um post
    public function edit(Post $post)
    {
        $categorias = Categoria::all();
        $linguagens = Linguagem::all();
        $users = User::all(); // Certifique-se de carregar todos os usuários

        return view('post.edit', compact('post', 'categorias', 'linguagens', 'users'));
    }

    // Atualizar um post existente
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'descricao' => 'required|string|max:500',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'titulo' => 'required|string|max:255',
            'id_categoria' => 'required|exists:categoria,id',
            'id_linguagem' => 'required|exists:linguagem,id',
            'post_type' => 'required|string',
        ]);

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $post->update($validatedData);

        return redirect()->route('post.index')->with('success', 'Post atualizado com sucesso!');
    }
}
