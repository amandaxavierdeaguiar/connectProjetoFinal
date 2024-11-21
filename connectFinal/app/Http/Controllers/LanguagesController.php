<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LanguagesController extends Controller
{
    // Visualizar bandas
    public function viewLanguages(){
        $language = DB::table('linguagem')
        ->join('categoria', 'linguagem.id_categoria', '=', 'categoria.id')
        ->select('linguagem.*', 'categoria.nome as categoria.nome')
        ->get();

        //dd($bands);
        // $search = request()->query('search') ? request()->query('search') : null;
        // $users = $this->getAllUsersFromDB($search);
        return view('languages.list_language', compact('language'));
    }

    public function createLanguages(Request $request){
        if(isset($request->id)){
            // dd('Atualizar');
            $action = 'atualizado';
            // Atualiza banda existente
            $request->validate([
                'name' => 'required|string|max:50',
                'foto' => 'nullable|image',
                'id_categoria' => 'required',
            ]);

            // Buscar o linguagem existente
            $language = DB::table('linguagem')->where('id', $request->id)->first();
            $foto = $language->foto; // Mantém a imagem atual

            // Verifica se um novo arquivo foi enviado
            if($request->hasFile('photo')) {
                // Remove a imagem antiga do storage, se existir
                if ($foto) {
                    Storage::delete($foto);
                }
                // Armazena a nova imagem
                $foto = Storage::putFile('uploadedPhotos', $request->foto);
            }

            // Atualiza a linguagem
            DB::table('linguagem')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'foto' => $foto,
                'id_categoria' => $request->id_categoria,
            ]);
        } else {
            // dd($request->all());
            $action = 'inserido';
            // Inserir nova album
            $request->validate([
                'name' => 'required|string|max:50',
                'foto' => 'nullable|image',
                'id_categoria' => 'required',
            ]);

            $foto = null;

            if($request->hasFile('photo')) {
                $foto = Storage::putFile('uploadedPhotos', $request->photo);
            }

            // Insere o novo álbum
            DB::table('linguagem')
            ->insert([
                'name' => $request->name,
                'foto' => $foto,
                'id_categoria' => $request->id_categoria,
            ]);
        }

        return redirect()->route('language.list')->with('message', 'Linguagem  '.$action.' com sucesso!');
    }

    public function createLanguageForm() {
        $language = DB::table('linguagem')->get();
        return view('languages.language_show', compact('language'));
    }

    public function showLanguage($id) {

        // para pegar id banda
        $categoria = DB::table('categoria')->get();

        $language = DB::table('linguagem')->where('id', $id)->first();

        return view('languages.language_show', compact('categoria', 'language'));
    }

    public function deleteLanguage($id){
        DB::table('linguagem')->where('id', $id)->delete();

        return back();
    }
}
