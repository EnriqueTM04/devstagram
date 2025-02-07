<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;

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
Route::post('imagenes', [ImagenController::class, 'store'])->name('imagenes.store');
