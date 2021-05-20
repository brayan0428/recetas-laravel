<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'InicioController@index');

Route::resource('/recetas', 'RecetaController');
Route::get('/search', 'RecetaController@search')->name('receta.search');
Route::resource('/perfiles', 'PerfilController')->parameters(['perfiles' => 'perfil'])->only(['edit','update' ,'show']);
Route::put('/likes/{receta}', 'LikeReceta@update');
Route::get('/categorias/{categoriaReceta}', 'CategoriasController@show')->name('categorias.show');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
