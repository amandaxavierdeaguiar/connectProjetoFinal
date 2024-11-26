<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LanguagesController;
use App\Http\Controllers\UserProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/userprofile', [UserProfileController::class,'viewUserProfile'])->name('user.foryou');

Route::get('/post_job', [UserProfileController::class,'viewUserPostVagas'])->name('user.post.job');

Route::get('/post_curso', [UserProfileController::class,'viewUserPostCurso'])->name('user.post.curso');

Route::get('/post_evento', [UserProfileController::class,'viewUserPostEvento'])->name('user.post.evento');

//Formulario Forum Criar
// Route::get('/form_forum', [UserProfileController::class, 'formsForum'])
// ->name('form.forum');

//ver e atualizar formulario
// Route::get('/show_forum/{id}', [UserProfileController::class, 'showForum'])->name('forum.show');

//Criar ou atualizar linguagem
// Route::post('/create_post_forum', [UserProfileController::class,'storeUserProfile'])
// ->name('post.forum.user.create');

Route::get('/post_forum', [UserProfileController::class,'viewUserPostForum'])->name('user.post.forum');



// Route::get('/forumprofile', [ForumController::class,'viewForum'])->name('user.forum');

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



// FORUM - USER

Route::get('/posts_forum', [ForumController::class, 'viewForum'])->name('forum.list');

// Criação de uma novo forum - formulario
Route::get('/add_forum', [ForumController::class, 'createForumForm'])->name('forum.create.form');

// Ver e atualizar Linguagem
Route::get('/show_forum/{id}', [ForumController::class, 'showForum'])->name('forum.show');

// Criar ou atualizar Post Forum
Route::post('/create_post_forum', [ForumController::class,'createForum'])
->name('forum.create');

// Apagar Post Forum
Route::get('/forum/delete/{id}', [ForumController::class, 'deletePostForum'])->name('forum.delete');



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

// WISH

Route::get('/wish/create', [WishController::class, 'createWishForm'])->name('wish.create.Form');

Route::post('/wish', [WishController::class, 'createWish'])->name('wish.create');

Route::get('/wishes', [WishController::class, 'viewWish'])->name('wish.list');

//Sidebar
Route::get('/sidebar', [SidebarController::class, 'viewSidebar'])->name('sidebar.view');
// Route::get('/sidebar', function () {
//     return view('sidebar.index_sidebar');
// });


// Route::post('/wishes/create', [WishController::class, 'createWish'])->name('wish.create');

// Criação de uma novo album
// Route::get('/add_wish', [WishController::class, 'createWishForm'])->name('wish.create.form');

// if(Auth::user()->user_type==\App\Models\User::ADMIN))
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




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


// WISH

Route::get('/wish/create', [WishController::class, 'createWishForm'])->name('wish.create.Form');

Route::post('/wish', [WishController::class, 'createWish'])->name('wish.create');

Route::get('/wishes', [WishController::class, 'viewWish'])->name('wish.list');




// Route::post('/wishes/create', [WishController::class, 'createWish'])->name('wish.create');

// Criação de uma novo album
// Route::get('/add_wish', [WishController::class, 'createWishForm'])->name('wish.create.form');



// Route::get('/dashboard', function () {
//     if (!Auth::check() || Auth::user()->role !== 'ADMIN') {
//         return redirect('/userprofile');
//     }

//     return view('dashboard');
// })->name('dashboard');


// Rotas para o UserController
Route::resource('users', UserController::class);

// Rota par apost

Route::resource('post', PostController::class);







require __DIR__.'/auth.php';

