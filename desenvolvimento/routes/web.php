<?php

use App\Http\Controllers\CompraController;
use App\Http\Controllers\CompraIngressoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\IngressosController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VendasController;
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
Route::get('/produto/{hash}', [ProdutoController::class, 'processaRetirada']);
//home
Route::get('/home', [HomeController::class, 'index'])->name('home.index')->secure();

//usuarios
Route::resource('/usuario', UsuarioController::class)->middleware(Autenticador::class);
//Produtos
Route::resource('/estoque', EstoqueController::class)->middleware(Autenticador::class);
//compra
Route::resource('/compra', CompraController::class)->middleware(Autenticador::class);
//vendas
Route::resource('/vendas', VendasController::class)->middleware(Autenticador::class);
//pedidos
Route::resource('/pedidos', PedidosController::class)->middleware(Autenticador::class);
//produtos
Route::post('/produtos/concluido', [ProdutoController::class, 'concluido'])->name('produtos.concluido');
Route::get('/produtos/{hash}', [ProdutoController::class, 'processaRetirada'])->middleware(Autenticador::class);
Route::resource('produtos', ProdutoController::class)->middleware(Autenticador::class);
//ingressos
Route::resource('ingressos', IngressosController::class)->middleware(Autenticador::class);
//lote
Route::resource('lote', LoteController::class)->middleware(Autenticador::class);
//compra ingressos
Route::resource('compra_ingressos', CompraIngressoController::class)->middleware(Autenticador::class);


//Gerar qrcode
Route::resource('qrcode', QRCodeController::class)/*->middleware(Autenticador::class)*/;
//Route::get('/qrcode', [QRCodeController::class, 'index'])->name('qrcode');
Route::get('/payment', [PagamentoController::class, 'createPayment'])->name('payment.create');
Route::get('/payment/success', [PagamentoController::class, 'secesso'])->name('payment.secesso');
Route::get('/payment/failure', [PagamentoController::class, 'flaha'])->name('payment.flaha');
Route::get('/payment/pending', [PagamentoController::class, 'pendente'])->name('payment.pendente');


Route::get('/checkout', [MercadoPagoController::class, 'iniciarPagamento'])->name('checkout')->middleware(Autenticador::class);
Route::post('/webhook', [MercadoPagoController::class, 'webhook'])->name('webhook');


//Route::get('login/google', "SocialiteController@redirectToProvider");
//Route::get('login/google/callback', 'SocialiteController@handleProviderCalback');
Route::get('login/google', [SocialiteController::class, 'redirectToProvider'])->name('login');
Route::get('login/google/callback', [SocialiteController::class, 'hendProviderCallback']);
Route::get('login/logout', [SocialiteController::class, 'destroy'])->name('logout');

Route::get('/email_novo_usuario', function (){return new \App\Mail\NovoUsuario();});
Route::get('/email_compra', function (){return new \App\Mail\CompraRealizada();});





