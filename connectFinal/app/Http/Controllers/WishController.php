<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishController extends Controller
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
}
