@extends('layouts.app')

@section('titulo')
    Tienda Virtual
@endsection

@section('contenido')
    
    {{-- agregar un componente --}}
    <x-listar-post :posts="$posts">
        {{-- titulo de subseccion --}}
        <x-slot:titulo>       
        </x-slot:titulo>
    </x-listar-post>
@endsection