<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SidebarController extends Controller
{
    public function viewSidebar()
    {
        // Captura o ID do usuário logado
        // $users = Auth::user()->id;
        $users = Auth::user();

        return view('sidebar.index_sidebar', compact('users'));
    }
}
