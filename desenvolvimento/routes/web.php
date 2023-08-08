<?php

use App\Http\Controllers\CorController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Autenticador;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;


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
Route::get('/', [HomeController::class, 'index'])->name('home.index')->secure();

//Route::get('/', function () {
//    return view('welcome');
//});

//home
Route::get('/home', [HomeController::class, 'index'])->name('home.index')->secure();

//cor
Route::resource('/cor',CorController::class)->except(['show'])->middleware(Autenticador::class);
//usuarios
Route::resource('/usuario', UsuarioController::class)->middleware(Autenticador::class);




//marca
Route::get('/marca', [MarcaController::class, 'index'])->name('marca.index')->secure();
Route::get('/marca/criar', [MarcaController::class, 'create'])->name('marca.create');
Route::get('/marca/excluir/{id}', [MarcaController::class, 'destroy'])->name('marca.destroy');
Route::get('/marca/salvar', [MarcaController::class, 'store'])->name('marca.salvar');

//modelo
Route::get('/modelo', [ModeloController::class, 'index'])->name('modelo.index');
Route::get('/modelo/criar', [ModeloController::class, 'create'])->name('modelo.create');
Route::get('/modelo/excluir/{id}', [ModeloController::class, 'destroy'])->name('modelo.destroy');
Route::get('/modelo/salvar', [ModeloController::class, 'store'])->name('modelo.salvar');

//Route::get('login/google', "SocialiteController@redirectToProvider");
//Route::get('login/google/callback', 'SocialiteController@handleProviderCalback');
Route::get('login/google', [SocialiteController::class, 'redirectToProvider'])->name('login');
Route::get('login/google/callback', [SocialiteController::class, 'hendProviderCallback']);
Route::get('login/logout', [SocialiteController::class, 'destroy'])->name('logout');
