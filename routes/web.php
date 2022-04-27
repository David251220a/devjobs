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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', 'HomeController@inicio');

//rutas protegidas
Route::group(['middleware' =>['auth', 'verified']], function(){
    Route::get('/notificaciones', 'NotificacionesController')->name('notificaciones');
    Route::post('/vacantes/{vacante}', 'VacanteController@estadovacante' )->name('vacantes.estado');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/vacantes', 'VacanteController')->names('vacantes');
Route::post('/candidatos/store', 'CandidatoController@store')->name('candidatos.store');
Route::get('/candidatos/{id}', 'CandidatoController@index')->name('candidatos.index');

//subir imagen

Route::post('/vacantes/imagen', 'VacanteController@imagen')->name('vacantes.imagen');
Route::post('/vacantes/borrarimagen', 'VacanteController@borrarimagen')->name('vacantes.borrarimagen');

