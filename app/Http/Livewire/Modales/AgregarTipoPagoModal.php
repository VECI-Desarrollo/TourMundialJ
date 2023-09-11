<?php

namespace App\Http\Livewire\Modales;

use App\Models\monedas;
use App\Models\tipospagos;
use Livewire\Component;

class AgregarTipoPagoModal extends Component
{


      public $tipoPago,
             $monedas,
             $moneda;


      ////// select tipo de moneda
      public function selectMoneda()
      {
       $this->monedas= monedas::where('pais_id',auth()->user()->pais_id)->get();

      }


      public function save(){

        $this->validate([
            'tipoPago' => 'required',
            'moneda'=> 'required',

        ], [
            'tipoPago.required' => 'Debes ingresar un tipo de pago.',
            'moneda.required' => 'Debe asociar una moneda',

        ]);
         ////// se guarda  el tipo pago en la BD

         tipospagos::updateOrCreate(
            ['tipoPago' => $this->tipoPago,
             'moneda' => $this->moneda,
            'pais_id' => auth()->user()->pais_id,
            ],

        );

        //////// reset todos los campos del formulario
        $this->reset(
            ['tipoPago', 'moneda' ]);

  // ////// emit para refrescar el panel tipos de pago  y actualizar datos en tiempo real
  $this->emit('refreshPanelPagos');
  //////  se activa el sweet alert
  $this->dispatchBrowserEvent('successfully', ['message' => "se envio con exito!"]);
      }

    public function render()
    {
     self::selectMoneda();

        return view('livewire.modales.agregar-tipo-pago-modal');
    }
}
