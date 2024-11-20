<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function viewPageUsers(){
        return view('users.index_users');
    }
}
