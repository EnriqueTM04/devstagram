@extends('layouts.app')

@section('titulo')
    Inicia Sesión en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-14 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen Registro">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            {{-- para evitar ataques necesario para post --}}
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                {{-- mostrar error con back --}}
                @if ($errors->has('mensaje'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        <p>{{ $errors->first('mensaje') }}</p>
                    </div>
                @endif
            

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
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" 
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
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror" 
                        placeholder="Tu contraseña"
                        required
                    >
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        id="remember" 
                        class="mr-2"
                        {{ old('remember') ? 'checked' : '' }}
                    > <label class="text-gray-500 text-sm">Mantener mi sesión abierta</label>
                </div>

                <input type="submit" value="Iniciar Sesión" class="bg-sky-600 hover:bg-sky-700 w-full p-4 text-white uppercase font-bold rounded-lg cursor-pointer">
            </form>
        </div>
    </div>
@endsection