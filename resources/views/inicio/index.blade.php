@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('hero')
    <div class="hero-categorias">
        <form class="container h-100" method="GET" action="{{route('receta.search')}}">
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display-4">Encuentra una receta para tu próxima comida</p>
                    <input type="search" name="buscar" class="form-control" placeholder="Buscar receta...">
                </div>
            </div>
        </form>
    </div>
@endsection
@section('content')
    <h2 class="text-primary">Ultimas Recetas</h2>
    <div class="owl-carousel mt-3">
        @foreach ($nuevas as $nueva )
            <div class="card">
                <img class="card-img-top" src="/storage/{{$nueva->imagen}}" alt="">
                <div class="card-body">
                    <h6 class="card-title">{{Str::title($nueva->titulo)}}</h6>
                    <p class="card-text">
                        {{Str::words(strip_tags($nueva->preparacion), 10)}}
                    </p>
                    <a href="{{route('recetas.show', ['receta' => $nueva->id])}}" class="btn btn-primary">Ver Receta</a>
                </div>
            </div>
        @endforeach
    </div>
    @foreach ($recetas as $key => $grupo)
        <h2 class="text-primary my-4">{{Str::title(str_replace('-', ' ', $key))}}</h2>
        <div class="row">
            @foreach ($grupo as $recetas)
                @foreach ($recetas as $receta )
                    <div class="col-md-4">
                       @include('components.card-receta')
                    </div>
                @endforeach
            @endforeach
        </div>
    @endforeach

    <h2 class="text-primary my-3">Mas Votadas</h2>
    <div class="row">
        @foreach ($votadas as $receta )
            <div class="col-md-4">
                @include('components.card-receta')
            </div>
        @endforeach
    </div>
@endsection