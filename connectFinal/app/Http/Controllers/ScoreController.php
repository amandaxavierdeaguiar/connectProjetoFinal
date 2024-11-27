<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{

    public function getAllScoreByUser()
    {

        $allScoreUser  = DB::table('users')
        ->leftjoin('post', 'post.id_users', '=', 'users.id')
        ->leftjoin('curso', 'curso.id', '=', 'users.id_curso')
        ->select('users.id', 'users.name AS aluno', DB::raw('count(post.id) AS totalPost'), DB::raw('count(curso.id) AS totalCurso'))
        ->groupby('users.id', 'users.name')
        ->get();

        return view('score.score_show', compact('allScoreUser'));

    }

    // Recuperar todas as pontuações
    // public function createGame() {
    //     return view('game.game_show');
    //      //return response()->json(Score::orderBy('score', 'desc')->take(10)->get());
    // }

    // Salvar ou atualizar pontuação de um jogador
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'player_name' => 'required|string|max:255',
    //         'score' => 'required|integer|min:0',
    //     ]);

    //     // Atualiza a pontuação do jogador ou cria um novo registro
    //     $score = Score::updateOrCreate(
    //         ['player_name' => $request->player_name],
    //         ['score' => $request->score]
    //     );

    //     return response()->json($score, 201);
    // }
}
