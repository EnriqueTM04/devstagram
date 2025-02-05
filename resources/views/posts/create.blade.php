@extends('layouts.app')

@section('titulo')
    Crear Post    
@endsection

{{-- para solo cargar en esta hoja --}}
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> 
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>

        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf

                {{-- mostrar error con back --}}
                @if ($errors->has('mensaje'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        <p>{{ $errors->first('mensaje') }}</p>
                    </div>
                @endif
            

                <div class="mb-5">
                    <label 
                        for="titulo" 
                        class="mb-2 block uppercase font-bold text-gray-500"
                    >
                        Titulo
                    </label>
                    <input 
                        type="text" 
                        name="titulo" 
                        id="titulo" 
                        class="border p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror" 
                        placeholder="Titulo de la Publicación"
                        required
                        value="{{ old('titulo') }}"
                    >
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label 
                        for="descripcion" 
                        class="mb-2 block uppercase font-bold text-gray-500"
                    >
                        Descripción
                    </label>
                    <textarea 
                        name="descripcion" 
                        id="descripcion" 
                        class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror" 
                        placeholder="Descripción de la Publicación"
                        required
                    >{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input 
                        type="hidden"
                        name="imagen"
                        value="{{ old('imagen') }}"
                    >
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>                        
                    @enderror
                </div>

                <input type="submit" value="Publicar" class="bg-sky-600 hover:bg-sky-700 w-full p-4 text-white uppercase font-bold rounded-lg cursor-pointer">
            </form>
        </div>
    </div>
@endsection