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
    return view('User/citas');
});
Route::get('vistaLogin', 'App\Http\Controllers\UserController@viewLogin');
Route::get('vistaRegistro', 'App\Http\Controllers\UserController@viewRegister');
Route::get('roles', 'App\Http\Controllers\UserController@roles');
Route::get('perfil', 'App\Http\Controllers\UserController@viewPerfil');
Route::get('citas', 'App\Http\Controllers\CitasController@viewCitas');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('guardar-horario', 'App\Http\Controllers\MedicoController@guardarHorario');
    Route::post('guardar-especialidad-new', 'App\Http\Controllers\MedicoController@guardarEspecialidadNew');
    Route::put('guardar-especialidad/{id}', 'App\Http\Controllers\MedicoController@guardarEspecialidad');
    Route::post('list-especialidades', 'App\Http\Controllers\MedicoController@listEspecialidades');
    Route::post('data-citas', 'App\Http\Controllers\CitasController@citas');
    Route::post('guardar-citas', 'App\Http\Controllers\CitasController@guardarCita');
    Route::put('editar-citas/{id}', 'App\Http\Controllers\CitasController@EditarCita');
    Route::get('info-citas/{id}', 'App\Http\Controllers\CitasController@infoCita');
});
