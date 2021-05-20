<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use App\Models\CategoriaReceta;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['show', 'search']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$recetas = auth()->user()->recetas()->paginate(2);
        $user = auth()->user();
        $recetas = Receta::where('user_id', $user->id )->paginate(2);
        return view('recetas.index')->with([
            'recetas' => $recetas,
            'usuario' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categorias = DB::table('categoria_recetas')->get()->pluck('nombre','id');
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image'
        ]);
        $rutaImagen = $request['imagen']->store('uploads-recetas', 'public');
        $imagen = Image::make("storage/{$rutaImagen}")->fit(1000,550);
        $imagen->save();
        
        // DB::table('recetas')->insert([
        //     'titulo' => $request['titulo'],
        //     'preparacion' => $request['preparacion'],
        //     'ingredientes' => $request['ingredientes'],
        //     'categoria_id' => $request['categoria'],
        //     'user_id' => $request->user()->id,
        //     'imagen' => $rutaImagen
        // ]);

        $user = auth()->user();
        $user->recetas()->create([
            'titulo' => $request['titulo'],
            'preparacion' => $request['preparacion'],
            'ingredientes' => $request['ingredientes'],
            'categoria_id' => $request['categoria'],
            'imagen' => $rutaImagen
        ]);

        return redirect()->route('recetas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        $user = auth()->user();
        $like = $user ? $user->likes->contains($receta->id) : false;
        $likes = $receta->likes->count();
        return view('recetas.show', compact('receta', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $this->authorize('view', $receta);
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.edit')->with([
            'categorias' => $categorias,
            'receta' => $receta
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        $this->authorize('update', $receta);
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required'
        ]);
        if($request['imagen']){
            $rutaImagen = $request['imagen']->store('uploads-recetas', 'public');
            $imagen = Image::make("storage/{$rutaImagen}")->fit(1000,550);
            $imagen->save();

            $receta->imagen = $rutaImagen;
        }
        $receta->titulo = $request['titulo'];
        $receta->preparacion = $request['preparacion'];
        $receta->ingredientes = $request['ingredientes'];
        $receta->categoria_id = $request['categoria'];
        $receta->save();
        return redirect()->route('recetas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        $this->authorize('delete', $receta);
        $receta->delete();
        return redirect()->route('recetas.index');
    }

    public function search(Request $request){
        $busqueda = $request->get('buscar');
        $recetas = Receta::where('titulo', 'like', "%{$busqueda}%")->paginate(6);
        $recetas->appends(['buscar' => $busqueda]);
        return view('busqueda.show', ['recetas' => $recetas, 'busqueda' => $busqueda]);
    }
}
