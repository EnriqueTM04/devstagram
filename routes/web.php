<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [RegisterController::class, 'index']);

// REGISTRO
Route::get('/register', [RegisterController::class, 'crear'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// POSTS
// buscar en la base de datos mediante un atributo
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index')->middleware();
Route::get('posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware();

// COMENTARIOS
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store')->middleware('auth');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('auth')->name('posts.destroy');

// Imagenes API
Route::post('imagenes', [ImagenController::class, 'store'])->name('imagenes.store')->middleware('auth');

// Like a las fotos
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store')->middleware('auth');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy')->middleware('auth');
// API para conatdor de likes
Route::get('/posts/{post}/likes/count', function (Post $post) {
    return response()->json([
        'usuario_like' => $post->checkLike(Auth::user()),
        'contador_likes' => $post->likes->count()
    ]);
})->middleware('auth');

// Perfil
Route::get('{user:username}/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index')->middleware('auth');
Route::post('{user:username}/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store')->middleware('auth');
