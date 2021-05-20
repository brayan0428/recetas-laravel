<div class="card">
    <img class="card-img-top" src="/storage/{{$receta->imagen}}" alt="{{$receta->titulo}}">
    <div class="card-body">
        <h5 class="card-title">{{$receta->titulo}}</h5>
        <div class="d-flex justify-content-between">
            <fecha-receta fecha="{{$receta->created_at}}"></fecha-receta>
            <span class="text-primary">A {{$receta->likes_count}} les gusto</span>
        </div>
        <p class="card-text mt-2">
            {{Str::words(strip_tags($receta->preparacion), 10)}}
        </p>
        <a href="{{route('recetas.show', ['receta' => $receta->id])}}" class="btn btn-primary">Ver Receta</a>
    </div>
</div>