@extends('layouts.app')

@section('titulo')
    DevUser - Editar perfil: {{ Auth::user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('perfil.store', Auth::user()->username) }}" method="POST" class="mt-10 md:mt-0" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label 
                        for="username" 
                        class="mb-2 block uppercase font-bold text-gray-500"
                    >
                        Username
                    </label>
                    <input 
                        name="username" 
                        type="text"
                        id="username" 
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" 
                        placeholder="Tu username"
                        value="{{ Auth::user()->username }}"
                    >
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label 
                        for="imagen" 
                        class="mb-2 block uppercase font-bold text-gray-500"
                    >
                        Imagen de perfil
                    </label>
                    <input 
                        name="imagen"
                        type="file"
                        accept="image/*"
                        id="imagen" 
                        class="border p-3 w-full rounded-lg" 
                    >
                </div>

                <hr class="my-5 border-gray-300">

                <h3 class="font-bold text-lg mb-1 text-blue-500">Cambiar contraseña (opcional)</h3>
                <p class="text-sm text-gray-500 mb-5">Si quieres cambiar la contraseña ingresa tu contraseña actual</p>

                {{-- contra anterior --}}
                <div class="mb-5">
                    <label 
                        for="password_old" 
                        class="mb-2 block uppercase font-bold text-gray-500"
                    >
                        Contraseña actual
                    </label>
                    <input 
                        name="password_old" 
                        type="password"
                        id="password_old" 
                        class="border p-3 w-full rounded-lg @error('password_old') border-red-500 @enderror" 
                        placeholder="Tu contraseña actual"
                    >
                    @error('password_old')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                {{-- casilla cambiar contrase --}}
                <div class="mb-5">
                    <label 
                        for="password" 
                        class="mb-2 block uppercase font-bold text-gray-500"
                    >
                        Cambiar contraseña
                    </label>
                    <input 
                        name="password" 
                        type="password"
                        id="password" 
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror" 
                        placeholder="Tu contraseña nueva"
                    >
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                {{-- casilla confirmar contrase --}}    
                <div class="mb-5">
                    <label 
                        for="password_confirmation" 
                        class="mb-2 block uppercase font-bold text-gray-500"
                    >
                        Confirmar contraseña
                    </label>
                    <input 
                        name="password_confirmation" 
                        type="password"
                        id="password_confirmation" 
                        class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-500 @enderror" 
                        placeholder="Confirma tu contraseña"
                    >
                    @error('password_confirmation')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" value="Guardar cambios" class="bg-sky-600 hover:bg-sky-700 w-full p-4 text-white uppercase font-bold rounded-lg cursor-pointer">
            
            </form>
        </div>
    </div>
@endsection