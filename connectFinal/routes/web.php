<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

Route::get('/', function () {
    return view('welcome');
});

// Rota para pagina inicial users
// Route::get('/', [IndexController::class, 'viewPageUsers'])->name('users.index');
