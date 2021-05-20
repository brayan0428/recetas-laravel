<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('show');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        $recetas = $perfil->usuario->recetas()->paginate(10);
        return view('perfiles.show')->with(['perfil' => $perfil, 'recetas' => $recetas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        $this->authorize('view', $perfil);
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        $request->validate([
            'nombre' => 'required',
            'url' => 'required|url',
            'biografia' => 'required'
        ]);
        
        $user = auth()->user();
        $user->name = $request['nombre'];
        $user->url = $request['url'];

        if($request['imagen']){
            $rutaImagen = $request['imagen']->store('uploads-perfiles', 'public');
            $imagen = Image::make("storage/{$rutaImagen}")->fit(600,600);
            $imagen->save();
        }
        $user->perfil()->update([
            "biografia" => $request['biografia'],
            "imagen" => $rutaImagen ?? ''
        ]);
        
        $user->save();
        return redirect()->route('recetas.index');
    }
}
