<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index () {
        return view('principal');
    }

    public function crear() 
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request); // ver los datos que se envian

        // Modificar el request
        $request->request->add([
            'username' => Str::slug($request->username)
        ]);

        // VALIDACION DE DATOS
        $validated = $request->validate([
            'name' => 'required|min:3|max:50',
            // unique es para que no se repita el dato en la base de datos
            'username' => 'required|min:3|max:20|unique:users',
            'email' => 'required|email|max:150|unique:users',
            'password' => 'required|min:6|max:20|confirmed'
        ]);

        if(!$validated) {
            return back()->withErrors($validated);
        }

        // Guardar valores en modelo
        User::create([
            'name' => $request->name,
            // convertir el username a una forma url
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);


        // Autenticar al usuario
        if(Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('posts.index');
        }

        // Regresar a la vista de registro si no se pudo autenticar
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden',
        ])->onlyInput('email');

    }
}
