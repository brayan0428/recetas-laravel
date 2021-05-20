<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriaReceta;

class InicioController extends Controller
{
    public function index(){
        $nuevas = Receta::latest()->limit(5)->withCount('likes')->get();
        $categorias = CategoriaReceta::all();
        $votadas = Receta::withCount('likes')->orderBy('likes_count','desc')->take(3)->get();
        $recetas = [];
        foreach($categorias as $categoria){
            $r = Receta::where('categoria_id', $categoria->id)->limit(5)->get();
            if(count($r) > 0){
                $recetas[Str::slug($categoria->nombre)][] = $r;
            }
        }
        return view('inicio.index', compact('nuevas', 'recetas', 'votadas'));
    }
}
