<?php

use App\Http\Livewire\Bancos;
use App\Http\Livewire\CorreosAdjuntos;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Cotizador;
use App\Http\Livewire\Cuentas;
use App\Http\Livewire\Inicio;
use App\Http\Livewire\Monedas;
use App\Http\Livewire\PanelControl;
use App\Http\Livewire\RegistrosPagos;
use App\Http\Livewire\TiposDePago;
use App\Http\Livewire\TiposDeProducto;
use App\Http\Livewire\Vendedores;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('auth/login');
// });

Route::get('/', Cotizador::class)->name('cotizador');
Route::get('RegistroPagos', function () {
    return view('auth.login');
})->name('RegistroPagos');
//  Route::get('panel', PanelControl::class)->name('panel');



// Route::get('Cuentas', Cuentas::class)->name('Cuentas');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/panel' ,PanelControl::class)->name('panel');

    Route::get('Vendedores', Vendedores::class)->name('Vendedores');
    Route::get('TiposDePago', TiposDePago::class)->name('TiposPago');
    Route::get('TiposDeProductos', TiposDeProducto ::class)->name('TiposProducto');
    Route::get('CorreosAdjuntos', CorreosAdjuntos::class)->name('CorreosAdjuntos');
    Route::get('Bancos' , Bancos::class)->name('Bancos');
    Route::get('Monedas' , Monedas::class)->name('Monedas');
    Route::get('Registros' , RegistrosPagos::class)->name('Registros');

});


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });





