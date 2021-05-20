@extends('layouts.app')

@section('content')
    <h2 class="text-center mb-2">Administra tus recetas</h2>
    <a href="{{route('recetas.create')}}" class="btn btn-primary mb-3">
        <svg class="w-6 h-6 icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        Crear Receta
    </a>
    <table class="table">
        <thead class="bg-primary text-light">
            <tr>
                <th>Titulo</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recetas as $receta )
                <tr>
                    <td>{{$receta->titulo}}</td>
                    <td>{{$receta->categoria->nombre}}</td>
                    <td>
                        <a href="{{route('recetas.edit', ['receta' => $receta->id])}}" class="btn btn-warning">Editar</a>
                        <eliminar-receta receta-id="{{$receta->id}}"></eliminar-receta>
                        <a href="{{route('recetas.show', ['receta' => $receta->id])}}" class="btn btn-secondary">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{$recetas->links()}}
    </div>
    <h2 class="text-center text-primary mt-4">Tus Recetas Favoritas</h2>
    <ul class="list-group">
        @foreach ($usuario->likes as $receta )
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <p>{{$receta->titulo}}</p>
                <a href="{{route('recetas.show', ['receta' => $receta->id])}}" class="btn btn-outline-success">Ver</a>
            </li>
        @endforeach
    </ul>
@endsection
 