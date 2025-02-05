<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!$credentials) {
            return back()->withErrors([
                'mensaje' => 'Las credenciales son incorrectas.',
            ]);
        }

        if (Auth::attempt($credentials, $request->remember)) {
            // se puede pasar como parametro el nombre de usuario, para que se redireccione a la pagina de inicio
            return redirect()->route('posts.index', Auth::user()->username);
        }

        return back()->withErrors([
            'mensaje' => 'Las credenciales son incorrectas.',
        ]);
    }
}
