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

Route::get('/', 'InicioController')->name('inicio');

// Route::get('/', 'HomeController@inicio');
Route::post('/busqueda/buscar', 'VacanteController@buscar')->name('vacantes.buscar');
Route::get('/busqueda/buscar', 'VacanteController@resultados')->name('vacantes.resultado');
//rutas protegidas
Route::group(['middleware' =>['auth', 'verified']], function(){
    Route::get('/notificaciones', 'NotificacionesController')->name('notificaciones');
    Route::post('/vacantes/{vacante}', 'VacanteController@estadovacante' )->name('vacantes.estado');
});

Auth::routes(['verify' => true]);

Route::resource('/vacantes', 'VacanteController')->names('vacantes');
Route::post('/candidatos/store', 'CandidatoController@store')->name('candidatos.store');
Route::get('/candidatos/{id}', 'CandidatoController@index')->name('candidatos.index');
Route::get('/categorias/{categoria}', 'CategoriaController@show')->name('categoria.show');


Route::post('/vacantes/imagen', 'VacanteController@imagen')->name('vacantes.imagen');
Route::post('/vacantes/borrarimagen', 'VacanteController@borrarimagen')->name('vacantes.borrarimagen');



//subir imagen

