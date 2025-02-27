@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')

    <div class="container mx-auto md:flex">
        <div class="md:w-1/2" data-post-id="{{ $post->id }}">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen de post {{ $post->titulo }}" class="object-cover w-full rounded-3xl">

            <div class="p-3 flex items-center gap-3">
                @auth

                    {{-- <livewire:like-post :post=$post> --}}
                    @livewire('like-post', ['post' => $post])

                    {{-- @if ($post->checkLike(Auth::user()))
                        <form class="formulario_likes__dislike" action="{{ route('posts.likes.destroy', $post) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="my-4">
                                
                            </div>    
                        </form>
                    @else
                        <form class="formulario_likes__like" action="{{ route('posts.likes.store', $post) }}" method="POST">
                            @csrf
                            <div class="my-4">
                                <button>
                                    <svg id="corazon_like" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                </button>
                            </div>    
                        </form>
                    @endif --}}
                    
                @endauth
                
            </div>

            <div class="">
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5">{{ $post->descripcion }}</p>

                @auth
                    @if ($post->user_id === Auth::user()->id)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @method('DELETE') {{-- Esto es un METHOD SPOOFING --}}
                            @csrf
                            <input 
                                type="submit"
                                value="Eliminar Publicacion"
                                class="bg-red-500 hover:bg-red-600 p-2 text-white font-bold rounded-lg cursor-pointer mt-4"
                            >
                        </form>
                    @endif
                @endauth
            </div>
        </div>

        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-4 mb-5">
                @auth()
                
                    <p class="text-xl font-bold text-center mb-4">Deja un comentario</p>

                    @if (session('success'))
                        <div class="p-2 rounded-lg mb-6">
                            <p class="bg-green-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST" novalidate>
                        
                        @csrf

                        <div class="mb-5">
                            <label 
                                for="comentario" 
                                class="mb-2 block uppercase font-bold text-gray-500"
                            >
                                Agregar comentario
                            </label>
                            <textarea 
                                name="comentario" 
                                id="comentario" 
                                class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror" 
                                placeholder="Comentar la Publicación"
                                required
                            ></textarea>
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="submit" value="Publicar" class="bg-sky-600 hover:bg-sky-700 w-full p-4 text-white uppercase font-bold rounded-lg cursor-pointer">
                        
                    </form>
                @endauth
                
                @guest()
                    <p class="font-bold text-lg text-center text-blue-500">Inicia sesión para dejar un comentario</p>
                @endguest

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    <p class="text-center font-bold border-b p-5">Comentarios</p>
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">{{ $comentario->user->username }}</a>
                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                                <p class="mt-2">{{ $comentario->comentario }}</p>
                            </div>  
                        @endforeach                      
                    @else
                        <p class="p-3 text-center">No hay comentarios</p>                        
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection