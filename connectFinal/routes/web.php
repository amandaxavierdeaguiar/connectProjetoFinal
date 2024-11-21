<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LanguagesController;

Route::get('/', function () {
    return view('welcome');
});

// Rota para pagina inicial users
// Route::get('/', [IndexController::class, 'viewPageUsers'])->name('users.index');

// VIEWS PARA CATEGORIA
// Categoria
// Lista dos Categoria
Route::get('/list_category', [CategoriaController::class, 'viewCategory'])->name('category.list');

// Criação de uma novo Categoria
Route::get('/add_category', [CategoriaController::class, 'createCategoryForm'])->name('category.create.form');


// Ver e atualizar Categoria
Route::get('/show_category/{id}', [CategoriaController::class, 'showCategory'])->name('category.show');

// Criar ou atualizar Categoria
Route::post('/create_category', [CategoriaController::class,'createCategory'])
->name('category.create');

//Rota para apagar Categoria
Route::get('/category/delete/{id}', [CategoriaController::class, 'deleteCategory'])->name('category.delete');


// VIEWS PARA LINGUAGEM
// Linguagem
// Lista dos Linguagem
Route::get('/list_language', [LanguagesController::class, 'viewLanguages'])->name('language.list');

// Criação de uma novo Linguagem
Route::get('/add_language', [LanguagesController::class, 'createLanguageForm'])->name('language.create.form');


// Ver e atualizar Linguagem
Route::get('/show_language/{id}', [LanguagesController::class, 'showLanguage'])->name('language.show');

// Criar ou atualizar Linguagem
Route::post('/create_language', [LanguagesController::class,'createLanguages'])
->name('language.create');

//Rota para apagar Linguagem
Route::get('/language/delete/{id}', [LanguagesController::class, 'deleteLanguage'])->name('language.delete');
