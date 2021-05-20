@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" />
@endsection
@section('content')
    <h2 class="text-center mb-2">Editar Receta: {{$receta->titulo}}</h2>
    <div class="d-flex justify-content-center">
        <div class="col-md-10">
            <a href="{{route('recetas.index')}}" class="btn btn-primary mb-3">
                <svg class="w-6 h-6 icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver
            </a>
            <form action="{{route('recetas.update', ['receta' => $receta->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{old('titulo') ?? $receta->titulo}}">
                    @error('titulo')
                        <span class="invalid-feedback d-block"><strong>{{$message}}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select name="categoria" class="form-control @error('categoria') is-invalid @enderror">
                        <option value="">Seleccione</option>
                        @foreach ($categorias as $categoria )
                            <option value="{{$categoria->id}}" {{$receta->categoria_id == $categoria->id ? 'selected' : ''}}>{{$categoria->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="ingredientes">Ingredientes</label>
                    <input id="ingredientes" class="form-control" type="hidden" name="ingredientes" value="{{$receta->ingredientes}}">
                    <trix-editor input="ingredientes" class="form-control @error('ingredientes') is-invalid @enderror"></trix-editor>
                    @error('ingredientes')
                        <span class="invalid-feedback d-block"><strong>{{$message}}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="preparacion">Preparación</label>
                    <input id="preparacion" class="form-control" type="hidden" name="preparacion" value="{{$receta->preparacion}}">
                    <trix-editor input="preparacion" class="form-control @error('preparacion') is-invalid @enderror"></trix-editor>
                    @error('preparacion')
                        <span class="invalid-feedback d-block"><strong>{{$message}}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input id="imagen" class="form-control @error('imagen') is-invalid @enderror" type="file" name="imagen">
                    @error('imagen')
                        <span class="invalid-feedback d-block"><strong>{{$message}}</strong></span>
                    @enderror
                    <div class="mt-3">
                        <p>Imagen Actual:</p>
                        <img src="/storage/{{$receta->imagen}}" alt="{{$receta->titulo}}" style="width:300px">
                    </div>
                </div>
                <button class="btn btn-primary">Editar Receta</button>
            </enctype=>
        </div>
    </div>
@endsection
@section('scripts')
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>
@endsection