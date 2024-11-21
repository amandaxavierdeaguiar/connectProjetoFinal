<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WishController extends Controller
{
    public function createStudy(Request $request) {
            // Captura o ID do usuário logado
            $userId = Auth::user()->id;

            $request->validate([
                'linguagem' => 'required|array',
                'linguagem.*' => 'exists:linguagem,id', // Valida se cada id de linguagem existe
                'skill_type' => 'required|in:skill,desejo', // Valida se o tipo é 'skill' ou 'desejo'
            ]);

            // Itera sobre as linguagens selecionadas
            foreach ($request->linguagens as $linguagemId) {
                // Insere na tabela de relacionamentos
                DB::table('desejo')->insert([
                    'user_id' => $userId,
                    'linguagem_id' => $linguagemId,
                    'tipo' => $request->tipo,
                ]);
            }

            return redirect()->route('study.list')->with('message', 'Linguagens cadastradas com sucesso!');
    }
}
