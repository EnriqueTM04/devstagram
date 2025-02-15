<div>
    @if ($posts->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
                        <img class="rounded-full" src="{{ asset('uploads'). '/' . $post->imagen }}" alt="Imagen de post {{ $post->titulo }}">
                    </a>
                    @if (isset($titulo))
                        <p class="text-gray-800 text-center text-sm mt-2 font-bold">{{ $post->titulo }}</p>
                    @endif
                    
                </div>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else
        <div class="text-center">
            No hay publicaciones aun, sigue a mas personas para ver sus publicaciones
        </div>
        
    @endif
</div>