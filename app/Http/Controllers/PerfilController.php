<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Laravel\Facades\Image;

class PerfilController extends Controller
{
    //
    public function index(Request $request) {

        if (Auth::user()->username !== $request->user) {
            abort(403);
        }

        return view('perfil.index');
    }

    public function store(Request $request) {

        $request->request->add([
            'username' => Str::slug($request->username)
        ]);

        $request->validate([
            'username' => ['required', 'unique:users,username,' . Auth::user()->id, 'min:3', 'max:20', 'not_in:register,login,logout,posts,imagenes,comentarios,perfil,editar-perfil'],
        ]);

        if($request->password_old) {
            $request->validate([
                'password_old' => ['required'],
                'password' => ['required', 'confirmed', 'min:6', 'max:20'],
            ]);

            if(!Hash::check($request->password_old, Auth::user()->password)) {
                return back()->withErrors([
                    'password_old' => 'La contraseña actual no coincide'
                ]);
            }
        }

        if(request()->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            // Generar ID único para la imagen
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            $imagenServidor = Image::read($imagen)->crop(1000, 1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        // Guardar valores en modelo
        $usuario = User::find(Auth::user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? Auth::user()->imagen ?? '';
        $usuario->password = Hash::make($request->password) ?? Auth::user()->password;
        $usuario->save();

        // redireccionar
        return redirect()->route('posts.index', $usuario->username);

    }
}
