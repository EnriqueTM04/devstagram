<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
        $imagen = $request->file('file');
        // Generar ID único para la imagen
        $nombreImagen = Str::uuid() . '.' . $imagen->extension();

        return response()->json(['imagen' => $nombreImagen]);
    }
}
