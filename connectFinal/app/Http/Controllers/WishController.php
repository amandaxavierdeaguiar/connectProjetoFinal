<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WishController extends Controller
{
    // $desejos = DB::table('desejo')->where('skill_type', 2)->get();
    // Para desejos

    // $skills = DB::table('desejo')->where('skill_type', 1)->get();
    // Para skills

    public function viewWish(){
        $wishes = DB::table('desejo')->get();
        // $wishes = DB::table('desejo')
        // ->join('linguagem', 'desejo.id_linguagem', '=', 'linguagem.id')
        // ->select('desejo.*', 'linguagem.name as linguagens')
        // ->get();

        return view('wish.list_wish', compact('wishes'));
    }

    // public function createWish(Request $request) {
    //         $userId = Auth::user()->id;

    //         $request->validate([
    //             'linguagem' => 'required|array',
    //             'linguagem.*' => 'exists:linguagem,id',
    //             'skill_type' => 'required|in:skill,desejo',
    //         ]);

    //         foreach ($request->wishes  as $linguagemId) {
    //             DB::table('desejo')->insert([
    //                 'user_id' => $userId,
    //                 'linguagem_id' => $linguagemId,
    //                 'tipo' => $request->tipo,
    //             ]);
    //         }

    //         return redirect()->route('wish.list')->with('message', 'Linguagens cadastradas com sucesso!');
    // }

    public function createWish(Request $request) {
        // Captura o ID do usuário logado
        $userId = Auth::user()->id;

        $request->validate([
            'linguagem' => 'required|array', // Este deve ser 'linguagem'
            'linguagem.*' => 'exists:linguagem,id', // Valida se cada id de linguagem existe
            'skill_type' => 'required|in:1,2', // Valida se o tipo é 'skill' ou 'desejo'
        ]);

        // Itera sobre as linguagens selecionadas
        foreach ($request->linguagem as $linguagemId) { // Aqui também deve ser 'linguagem'
            // Insere na tabela de relacionamentos
            DB::table('desejo')->insert([
                'id_users' => $userId,
                'id_linguagem' => $linguagemId,
                'skill_type' => $request->skill_type, // Corrigido para usar skill_type
            ]);
        }

        return redirect()->route('wish.list')->with('message', 'Linguagens cadastradas com sucesso!');
    }

    public function createWishForm() {
        $linguages = DB::table('linguagem')->get(); // Ensure this table name matches your database
        return view('wish.wish_show', compact('linguages')); // Ensure the view name matches your file
    }

}
