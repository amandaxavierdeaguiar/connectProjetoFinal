<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     if (!Auth::check() || Auth::user()->user_type !== User::ADMIN) {
    //         return view('user_profile.for_you');
    //     }
    //     return view('dashboard');
    // }

    public function index()
    {
        if (!Auth::check() || Auth::user()->user_type !== User::ADMIN) {
            return redirect('/userprofile');
        }
        return view('dashboard');
    }
}
