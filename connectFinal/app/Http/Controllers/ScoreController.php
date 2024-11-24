<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ScoreController extends Controller
{
    // Recuperar todas as pontuações
    public function createGame()
    {
        return view('game.game_show');
         //return response()->json(Score::orderBy('score', 'desc')->take(10)->get());
    }

    // Salvar ou atualizar pontuação de um jogador
    public function store(Request $request)
    {
        $request->validate([
            'player_name' => 'required|string|max:255',
            'score' => 'required|integer|min:0',
        ]);

        // Atualiza a pontuação do jogador ou cria um novo registro
        $score = Score::updateOrCreate(
            ['player_name' => $request->player_name],
            ['score' => $request->score]
        );

        return response()->json($score, 201);
    }
}
