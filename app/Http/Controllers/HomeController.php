<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //metodo invocable, cuando solo haya un metodo en el controlador, se llama inmediatamente
    public function __invoke()
    {
        // obtener a quienes seguimos
        $ids = Auth::user()->following->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(9);
        
        return view('home', [
            'posts' => $posts
        ]);
    }
}
