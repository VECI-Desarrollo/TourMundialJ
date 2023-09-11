<?php

namespace App\Http\Livewire\Modales;

use App\Models\monedas;
use Livewire\Component;

class AgregarTipoMoneda extends Component
{

    public $moneda;



      public function save(){

        $this->validate([
            'moneda'=> 'required',

        ], [
            'moneda.required' => 'Debe asociar una moneda',

        ]);
         ////// se guarda  el tipo pago en la BD

         monedas::updateOrCreate(
            [
             'moneda' => $this->moneda,
            'pais_id' => auth()->user()->pais_id,
            ],

        );

        //////// reset todos los campos del formulario
        $this->reset(
            [ 'moneda' ]);

  // ////// emit para refrescar el panel tipos de pago  y actualizar datos en tiempo real
  $this->emit('refreshPanelMonedas');
  //////  se activa el sweet alert
  $this->dispatchBrowserEvent('successfully', ['message' => "se guarado con exito!"]);
      }

    public function render()
    {
        return view('livewire.modales.agregar-tipo-moneda');
    }
}
