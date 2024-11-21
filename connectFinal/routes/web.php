<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LanguagesController;
use App\Http\Controllers\StudyController;

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

// VIEWS PARA CURSO
// Curso
// Lista dos Curso
Route::get('/list_study', [StudyController::class, 'viewStudy'])->name('study.list');

// Criação de uma novo Curso
Route::get('/add_study', [StudyController::class, 'createStudyForm'])->name('study.create.form');


// Ver e atualizar Curso
Route::get('/show_study/{id}', [StudyController::class, 'showStudy'])->name('study.show');

// Criar ou atualizar Curso
Route::post('/create_study', [StudyController::class,'createStudy'])
->name('study.create');

//Rota para apagar Curso
Route::get('/study/delete/{id}', [StudyController::class, 'deleteStudy'])->name('study.delete');
