<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Cotizador;
use App\Http\Livewire\PanelControl;
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
//     return view('welcome');
// });

Route::get('/', Cotizador::class)->name('cotizador');
Route::get('panelControl/RegistroPagos', PanelControl::class)->name('RegistroPagos');
Route::get('panelControl/Vendedores', Vendedores::class)->name('Vendedores');
Route::get('panelControl/TiposDePago', TiposDePago::class)->name('TiposPago');
Route::get('panelControl/TiposDeProductos', TiposDeProducto ::class)->name('TiposProducto');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
