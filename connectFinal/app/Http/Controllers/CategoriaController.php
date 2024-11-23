<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Função para listar todas as categorias
     */
    public function viewCategory()
    {
        // $categories = Categoria::all();
        $categories = DB::table('categoria')->get();

        return view('category.list_category', compact('categories'));
    }


    public function createCategory(Request $request){
        // Lógica para editar o categoria
        // Validar os dados
        if(isset($request->id)){
            $action = 'atualizado';
            // Atualiza Categoria existente!
            $request->validate([
                'nome' => 'required|string|max:50',
                'descricao' => 'nullable|string',
            ]);

            // Atualizar os dados
            // Categoria::where('id', $request->id)
            DB::table('categoria')
            ->where('id', $request->id)
            ->update([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
            ]);

            // Lógica para inserir uma nova categoria
        } else {
            $action = 'inserido';
            // Inserir novo user
            $request->validate([
                'nome' => 'required|string|max:50',
                'descricao' => 'nullable|string',
            ]);

            // Categoria::insert([
            DB::table('categoria')
            ->insert([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
            ]);
        }

        return redirect()->route('category.list')->with('message', 'Categoria '.$action.' com sucesso!');
    }


    public function createCategoryForm($id = null) {
        $category = null;
        if ($id) {
            $category = DB::table('categoria')->where('id', $id)->first();
        }
        return view('category.category_show', compact('category'));
    }

    public function showCategory($id)
    {
        // Recupera a categoria pelo ID
        // $category = Categoria::where('id', $id)->first();
        $category = DB::table('categoria')->where('id', $id)->first();

        return view('category.category_show', compact('category'));
    }

    public function deleteCategory($id){
        // Categoria::where('id', $id)->delete();
        DB::table('categoria')->where('id', $id)->delete();

        return back();
    }

}