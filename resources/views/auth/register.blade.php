@extends('layouts.app')

@section('titulo')
    Registrate en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-14 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen Registro">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            {{-- para evitar ataques necesario para post --}}
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label 
                        for="name" 
                        class="mb-2 block uppercase font-bold text-gray-500"
                    >
                        Nombre de usuario
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" 
                        placeholder="Tu Nombre"
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label 
                        for="username" 
                        class="mb-2 block uppercase font-bold text-gray-500"
                    >
                        Username
                    </label>
                    <input 
                        type="text" 
                        name="username" 
                        id="username" 
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" 
                        placeholder="Tu Nombre de Usuario"
                        required
                        value="{{ old('username') }}"
                    >
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label 
                        for="email" 
                        class="mb-2 block uppercase font-bold text-gray-500"
                    >
                        Correo electrónico
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" 
                        placeholder="Tu correo de registro"
                        required
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label 
                        for="password" 
                        class="mb-2 block uppercase font-bold text-gray-500"
                    >
                        Contraseña
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" 
                        placeholder="Tu contraseña"
                        required
                    >
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label 
                    {{-- tiene que ser asi porque laravel tiene la funcionalidad implementada --}}
                        for="password_confirmation" 
                        class="mb-2 block uppercase font-bold text-gray-500"
                    >
                        Repetir Contraseña
                    </label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        class="border p-3 w-full rounded-lg" 
                        placeholder="Repite tu contraseña"
                        required
                    >
                </div>

                <input type="submit" value="Registrarse" class="bg-sky-600 hover:bg-sky-700 w-full p-4 text-white uppercase font-bold rounded-lg cursor-pointer">
            </form>
        </div>
    </div>
@endsection