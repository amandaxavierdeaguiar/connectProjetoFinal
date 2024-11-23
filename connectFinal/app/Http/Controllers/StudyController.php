<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudyController extends Controller
{
    public function viewStudy(){
        // $language = DB::table('linguagem')
        // ->join('categoria', 'linguagem.id_categoria', '=', 'categoria.id')
        // ->select('linguagem.*', 'categoria.nome as categoria.nome')
        // ->get();

        $allStudies = DB::table('curso')->get();

        //dd($bands);
        // $search = request()->query('search') ? request()->query('search') : null;
        // $users = $this->getAllUsersFromDB($search);
        return view('study.list_study', compact('allStudies'));
    }

    public function createStudy(Request $request){

        if(isset($request->id)){
            // dd('Atualizar');
            $action = 'atualizado';
            // Atualiza banda existente
            $request->validate([
                'nome' => 'required|string|max:50',
                'descricao' => 'nullable|string',
                'quantidade_horas' => 'nullable|integer',
                'data_inicio' => 'nullable|date',
                'data_fim' => 'nullable|date',
                'foto' => 'nullable|image',
                'id_categoria' => 'required',
            ]);

            // Buscar o linguagem existente
            $studies = DB::table('curso')->where('id', $request->id)->first();
            $foto = $studies->foto; // Mantém a imagem atual

            // Verifica se um novo arquivo foi enviado
            if($request->hasFile('foto')) {
                // Remove a imagem antiga do storage, se existir
                if ($foto) {
                    Storage::delete($foto);
                }
                // Armazena a nova imagem
                $foto = Storage::putFile('uploadedPhotos', $request->foto);
            }

            // Atualiza a linguagem
            DB::table('curso')
            ->where('id', $request->id)
            ->update([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'quantidade_horas' => $request->quantidade_horas,
                'data_inicio' => $request->data_inicio,
                'data_fim' => $request->data_fim,
                'foto' => $foto,
                'id_categoria' => $request->id_categoria,
            ]);
        } else {
            // dd($request->all());
            $action = 'inserido';
            // Inserir nova album
            $request->validate([
                'nome' => 'required|string|max:50',
                'descricao' => 'nullable|string',
                'quantidade_horas' => 'nullable|integer',
                'data_inicio' => 'nullable|date',
                'data_fim' => 'nullable|date',
                'foto' => 'nullable|image',
                'id_categoria' => 'required',
            ]);

            $foto = null;

            if($request->hasFile('foto')) {
                $foto = Storage::putFile('uploadedPhotos', $request->foto);
            }

            // Insere o nova linguagem
            DB::table('curso')
            ->insert([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'quantidade_horas' => $request->quantidade_horas,
                'data_inicio' => $request->data_inicio,
                'data_fim' => $request->data_fim,
                'foto' => $foto,
                'id_categoria' => $request->id_categoria,
            ]);
        }

        return redirect()->route('study.list')->with('message', 'Curso  '.$action.' com sucesso!');
    }

    // public function createStudyForm() {
    //     $studies = DB::table('curso')->get();
    //     return view('study.study_show', compact('studies'));
    // }

    public function createStudyForm() {
        $allStudies = DB::table('curso')->get(); // Changed variable name

        return view('study.study_show', compact('allStudies'));
    }

    public function showStudy($id) {


        // para pegar id categoria
        // $category = DB::table('categoria')->get();

        $studies = DB::table('curso')->where('id', $id)->first();

        return view('study.study_show', compact('studies'));
    }

    public function deleteStudy($id){
        DB::table('curso')->where('id', $id)->delete();

        return back();
    }
}