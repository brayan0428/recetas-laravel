@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" />
@endsection
@section('content')
    <h2 class="text-center mb-2">Editar Perfil</h2>
    <div class="d-flex justify-content-center">
        <div class="col-md-10">
            <a href="{{route('recetas.index')}}" class="btn btn-primary mb-3">Volver</a>
            <form method="post" action="{{route('perfiles.update', ['perfil' => $perfil->id])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{old('nombre') ?? $perfil->usuario->name}}">
                    @error('nombre')
                        <span class="invalid-feedback d-block"><strong>{{$message}}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nombre">Sitio Web</label>
                    <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" value="{{old('url') ?? $perfil->usuario->url}}">
                    @error('url')
                        <span class="invalid-feedback d-block"><strong>{{$message}}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="biografia">Biografia</label>
                    <input id="biografia" class="form-control" type="hidden" name="biografia" value="{{$perfil->biografia}}">
                    <trix-editor input="biografia" class="form-control @error('biografia') is-invalid @enderror"></trix-editor>
                    @error('biografia')
                        <span class="invalid-feedback d-block"><strong>{{$message}}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input id="imagen" class="form-control @error('imagen') is-invalid @enderror" type="file" name="imagen">
                    @error('imagen')
                        <span class="invalid-feedback d-block"><strong>{{$message}}</strong></span>
                    @enderror
                    @if ($perfil->imagen)
                        <div class="mt-3">
                            <p>Imagen Actual:</p>
                            <img src="/storage/{{$perfil->imagen}}" alt="{{$perfil->usuario->nombre}}" style="width:300px">
                        </div>
                    @endif
                </div>
                <button class="btn btn-primary">Guardar Datos</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>
@endsection