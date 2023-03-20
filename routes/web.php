<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InicioController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\HomeController;

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

Route::get('Inicio', [InicioController::class, 'index']);
Route::get('/MiPerfil', [UsuariosController::class, 'MiPerfil'])->name('MiPerfil');
Route::put('/MiPerfil', [UsuariosController::class, 'MiPerfilUpdate'])->name('MiPerfilUpdate');

Route::get('/Usuarios', [UsuariosController::class, 'index'])->name('index');
Route::post('/Usuarios', [UsuariosController::class, 'store'])->name('store');


Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('Eliminar-Usuario/{id}', [UsuariosController::class, 'destroy']);
Route::match(['put', 'post'],'/Usuarios/{id}/actualizar', [UsuariosController::class, 'edit'])->name('usuarios.actualizar');

Route::get('Clientes', [ClientesController::class, 'index'])->name('clientes');
Route::post('Clientes', [ClientesController::class, 'store'])->name('store');
Route::match(['put', 'post'],'/Clientes/{id}/actualizar', [ClientesController::class, 'edit'])->name('clientes.actualizar');
Route::get('Eliminar-Cliente/{id}', [ClientesController::class, 'destroy']);
