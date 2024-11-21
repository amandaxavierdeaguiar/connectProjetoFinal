<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishController extends Controller
{
    public function createStudy(Request $request) {
            // Captura o ID do usuário logado
            $userId = auth()->id(); // Assumindo que você está usando o Auth do Laravel

            // Validação da requisição
            $request->validate([
                'linguagens' => 'required|array',
                'linguagens.*' => 'exists:linguagens,id', // Valida se cada id de linguagem existe
                'tipo' => 'required|in:skill,desejo', // Valida se o tipo é 'skill' ou 'desejo'
            ]);

            // Itera sobre as linguagens selecionadas
            foreach ($request->linguagens as $linguagemId) {
                // Insere na tabela de relacionamentos
                DB::table('user_linguagens')->insert([
                    'user_id' => $userId,
                    'linguagem_id' => $linguagemId,
                    'tipo' => $request->tipo,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->route('study.list')->with('message', 'Linguagens cadastradas com sucesso!');
    }
}
