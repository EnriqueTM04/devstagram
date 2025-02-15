<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    // middleware para proteger solo algunas cosas
    public static function middleware(): array {
        return [
            new Middleware('auth', except: ['index', 'show'])
        ];
    }

    // otra forma
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('auth', except: ['show', 'index']),
    //     ];
    // }
 
    // o también: ...
    // new Middleware('auth', only: ['create']),

    public function index(User $user)
    {

        $posts = Post::where('user_id', $user->id)->latest()->paginate(8);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:250',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // una forma de crear registros
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => Auth::user()->id
        // ]);

        // otra forma de crear registros
        // $post = new Post();
        // $post->titulo = $request->titulo;
        // etc

        // otra forma de crear registros
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('posts.index', Auth::user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Request $request, Post $post)
    {
        // comprobar si el usuario puede eliminar el post con la política
        // cannot() es lo contrario a can() y es para ver si el usuario no puede hacer algo
        if($request->user()->cannot('delete', $post)) {
            return abort(403);
        }

        $post->delete();

        // eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

        if(File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', Auth::user()->username);
    }
}
