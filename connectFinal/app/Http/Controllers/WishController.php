<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WishController extends Controller
{

    public function viewWish(){
        $wishes = DB::table('desejo')->get();


        return view('wish.list_wish', compact('wishes'));
    }

    public function createWish(Request $request) {
        // Captura o ID do usuário logado
        $userId = Auth::user()->id;

        // Validação dos dados de entrada
        $request->validate([
            'linguagem' => 'required|array', // Este deve ser 'linguagem'
            'linguagem.*' => 'exists:linguagem,id', // Valida se cada id de linguagem existe
            'skill_type' => 'required|in:1,2', // Valida se o tipo é 'skill' ou 'desejo'
        ]);

        // Verifica se o ID do desejo foi fornecido
        if (isset($request->id)) {
            $action = 'atualizado';
            $desejoId = $request->id; // Captura o ID do desejo a ser atualizado

            // Remove as linguagens antigas associadas ao desejo
            DB::table('desejo')->where('id', $desejoId)->delete();

            // Itera sobre as linguagens selecionadas e insere as novas
            foreach ($request->linguagem as $linguagemId) {
                DB::table('desejo')->insert([
                    'id_users' => $userId,
                    'id_linguagem' => $linguagemId,
                    'skill_type' => $request->skill_type,
                ]);
            }
        } else {
            $action = 'inserido';

            // Itera sobre as linguagens selecionadas e insere na tabela de relacionamentos
            foreach ($request->linguagem as $linguagemId) {
                DB::table('desejo')->insert([
                    'id_users' => $userId,
                    'id_linguagem' => $linguagemId,
                    'skill_type' => $request->skill_type,
                ]);
            }
        }

        return redirect()->route('sidebar.view')->with('message', 'Linguagens ' . $action . ' cadastradas com sucesso!');
    }



    // public function createWish(Request $request) {
    //     // Captura o ID do usuário logado
    //     $userId = Auth::user()->id;

    //     $request->validate([
    //         'linguagem' => 'required|array', // Este deve ser 'linguagem'
    //         'linguagem.*' => 'exists:linguagem,id', // Valida se cada id de linguagem existe
    //         'skill_type' => 'required|in:1,2', // Valida se o tipo é 'skill' ou 'desejo'
    //     ]);

    //     // Itera sobre as linguagens selecionadas
    //     foreach ($request->linguagem as $linguagemId) { // Aqui também deve ser 'linguagem'
    //         // Insere na tabela de relacionamentos
    //         DB::table('desejo')->insert([
    //             'id_users' => $userId,
    //             'id_linguagem' => $linguagemId,
    //             'skill_type' => $request->skill_type, // Corrigido para usar skill_type
    //         ]);
    //     }

    //     return redirect()->route('sidebar.view')->with('message', 'Linguagens cadastradas com sucesso!');
    // }

    public function updateWish(Request $request, $desejoId) {
        // Captura o ID do usuário logado
        $userId = Auth::user()->id;

        $request->validate([
            'linguagem' => 'required|array', // Este deve ser 'linguagem'
            'linguagem.*' => 'exists:linguagem,id', // Valida se cada id de linguagem existe
            'skill_type' => 'required|in:1,2', // Valida se o tipo é 'skill' ou 'desejo'
        ]);

        // Remove as linguagens antigas associadas ao desejo
        DB::table('desejo')->where('id', $desejoId)->delete();

        // Itera sobre as linguagens selecionadas
        foreach ($request->linguagem as $linguagemId) {
            // Insere na tabela de relacionamentos
            DB::table('desejo')->insert([
                'id_users' => $userId,
                'id_linguagem' => $linguagemId,
                'skill_type' => $request->skill_type,
            ]);
        }

        return redirect()->route('sidebar.view')->with('message', 'Linguagens atualizadas com sucesso!');
    }

    public function createWishForm() {
        $linguages = DB::table('linguagem')->get();
        return view('wish.wish_show', compact('linguages'));
    }
}
