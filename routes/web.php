<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InicioController;

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
    return view('modulos.ingresar');
});

Auth::routes();

Route::get('inicio', [InicioController::class, 'inicio'])->name('inicio');

Route::get('/perfil', [App\Http\Controllers\UsuariosController::class, 'perfil'])->name('perfil');
Route::get('/perfil', [App\Http\Controllers\UsuariosController::class, 'perfilUpt'])->name('perfilUpt');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

