@extends('layouts.app')

@section('titulo')
    DevUser: <span id="user">{{ $user->username}}</span>
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-5/12 px-5">
                <img src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}" alt="Imagen de usuario" class="object-cover rounded-full mx-auto">
            </div>

            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center py-10 md:py-0 md:items-start">
                <p class="text-gray-700 text-2xl mb-1 font-bold">{{ $user->username }}</p>

                @auth
                    @if ($user->id === Auth::user()->id)
                    <div class="flex items-center gap-2 mb-3">
                        <a href="{{ route('perfil.index', $user) }}" class="text-gray-600 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                      
                        <p class="text-gray-600 text-sm font-bold">Editar perfil</p>
                    </div>
                        
                    @endif
                @endauth

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    <span class="followers">{{ $user->followers->count() }}</span>
                    <span class="font-normal"> @choice('Seguidor|Seguidores', $user->followers->count() )</span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    <span class="following">{{ $user->following->count() }}</span>
                    <span class="font-normal">Siguiendo</span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts->count() }}
                    <span class="font-normal">Posts</span>
                </p>

                @auth
                    @if ($user->id !== auth()->user()->id)
                        <form class="follow hidden" action="{{ route('users.follow', $user) }}" method="POST">
                            @csrf
                            <input type="submit" value="Seguir" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-full text-xs cursor-pointer uppercase">
                        </form>

                        <form class="unfollow hidden" action="{{ route('users.unfollow', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Siguiendo" class="text-blue-600 bg-white border-blue-600 font-bold py-2 px-4 rounded-full text-xs cursor-pointer uppercase">
                        </form>                        
                    @endif
                @endauth
                
            </div>
        </div>
    </div>

    <section class="container mx-auto my-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        <x-listar-post :posts="$posts">
        </x-listar-post>
        
    </section>
@endsection