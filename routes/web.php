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
    return view('User/login');
});
Route::get('vistaLogin', 'App\Http\Controllers\UserController@viewLogin');
Route::get('vistaRegistro', 'App\Http\Controllers\UserController@viewRegister');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('roles', 'App\Http\Controllers\MedicoConrtroller@roles');
});
