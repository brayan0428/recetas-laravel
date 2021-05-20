@extends('layouts.app')

@section('content')
    <h2 class="text-primary my-3">Categoria: {{$categoriaReceta->nombre}}</h2>
    <div class="row">
        @forelse ($recetas as $receta)
            <div class="col-md-4">
                @include('components.card-receta')
            </div>
        @empty
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
                    Actualmente no tenemos recetas para esta categoria
                </div>
            </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center">
        {{$recetas->links()}}
    </div>
@endsection