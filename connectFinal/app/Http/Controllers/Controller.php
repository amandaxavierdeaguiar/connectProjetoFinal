<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


abstract class Controller
{
    // public function index()
    // {
    //     if (!Auth::check() || Auth::user()->user_type !== User::ADMIN) {
    //         return view('user_profile.for_you');
    //     }
    //     return view('dashboard');
    // }
}
