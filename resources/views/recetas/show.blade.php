@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 shadow">
        <h1 class="text-center my-3">{{$receta->titulo}}</h1>
        <img src="/storage/{{$receta->imagen}}" alt="{{$receta->titulo}}" class="w-100"/>
        <div class="meta-receta mt-3">
            <p><span class="font-weight-bold text-primary">Categoria:</span> {{$receta->categoria->nombre}} </p>
            <p><span class="font-weight-bold text-primary">Creado por:</span> <a href="{{route('perfiles.show', ['perfil' => $receta->user->perfil->id])}}">{{$receta->user->name}}</a> </p>
            <p>
                <span class="font-weight-bold text-primary">Fecha:</span> 
                <fecha-receta fecha="{{$receta->created_at}}"></fecha-receta> 
            </p>
            <div class="mt-3">
                <h2>Ingredientes</h2>
                {!! $receta->ingredientes !!}
            </div>
            <div>
                <h2>Preparación</h2>
                {!! $receta->preparacion !!}
            </div>
        </div>
        <like-receta receta-id="{{$receta->id}}" like="{{$like}}" likes="{{$likes}}"></like-receta>
    </div>
@endsection