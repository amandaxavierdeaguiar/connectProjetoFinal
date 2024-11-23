<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Curso;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Curso::all();

        return view('curso.manage_curso', compact('cursos'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cursos=Curso::all();// Aqui estou populando os campos do formulário com os dados da tabela cursos
        return view('curso.create_curso', compact('cursos'));
    }

    /**
     * Store a newly created resource in storage.
     */
  

     public function store(Request $request)
     {
         $request->validate([
             'nome' => 'required|string|max:255',
             'descricao' => 'required|string|max:65535', 
             'quantidade_horas' => 'required|integer', 
             'data_inicio' => 'required|date', 
             'data_fim' => 'required|date', 
             'id_categoria' => 'required|integer|exists:categorias,id', 
         ]);
     
         $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

         Curso::create([
             'nome' => $request->nome_curso,
             'descricao' => $request->descricao,
             'quantidade_horas' => $request->quantidade_horas,
             'data_inicio' => $request->data_inicio,
             'data_fim' => $request->data_fim,
             'id_categoria' => $request->id_categoria,
         ]);
     
         return redirect()->route('cursos.index')->with('success', 'Curso criado com sucesso!');
     }
     


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
        $curso= Curso::all();
        $categorias= Categoria::all();
        return view('curso.show_curso', compact('cursos','categorias'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:65535', 
            'quantidade_horas' => 'required|integer', 
            'data_inicio' => 'required|date', 
            'data_fim' => 'required|date', 
            'id_categoria' => 'required|integer|exists:categorias,id', 
        ]);

        $curso= Curso::findOrFail($id);
        $curso->nome=$request->nome;
        $curso->descricao=$request->descricao;
        $curso->quantidade_horas=$request->quantidade_horas;
        $curso->data_inicio=$request->data_inicio;
        $curso->data_fim=$request->data_fim;
        $curso->id_categoria=$request->id_categoria;

        $curso ->save();

        return redirect()->route('curso.index')->with('success', 'Curso atualizado com sucesso!');
       

         
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $curso=User::findOrFail($id);
        $curso ->delete();
        return redirect()->route('curso.index')->with('success', 'Curso deletado com sucesso!');
    }
}
