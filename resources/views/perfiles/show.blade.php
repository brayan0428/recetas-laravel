@extends('layouts.app')

@section('content')
    <div class="row mt-4">
        <div class="col-md-5">
            @if ($perfil->imagen)
                <img src="/storage/{{$perfil->imagen}}" class="w-100 rounded-circle" alt="$perfil->usuario->name"/>
            @endif
        </div>
        <div class="col-md-7">
            <h1 class="text-center text-primary">{{$perfil->usuario->name}}</h1>
            <p><span class="text-primary">Email: </span>{{$perfil->usuario->email}}</p>
            <a href="{{$perfil->usuario->url}}" target="_blank">Visitar Sitio Web</a>
            <div class="biografia mt-2">
                {!! $perfil->biografia !!}
            </div>
        </div>
    </div>
    <h2 class="text-center my-3 text-primary">Recetas Creadas</h2>
    <div class="row mt-2">
        @if (count($recetas) > 0)
            @foreach ($recetas as $receta)
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="/storage/{{$receta->imagen}}" alt="{{$receta->titulo}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$receta->titulo}}</h5>
                            <a href="{{route('recetas.show', ['receta' => $receta->id])}}">Ver Receta</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-warning" role="alert">
                Actualmente este usuario no tiene recetas creadas
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{$recetas->links()}}
    </div>
@endsection