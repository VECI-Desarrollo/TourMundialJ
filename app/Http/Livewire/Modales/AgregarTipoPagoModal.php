<?php

namespace App\Http\Livewire\Modales;

use App\Models\tipospagos;
use Livewire\Component;

class AgregarTipoPagoModal extends Component
{


      public $tipoPago;


      public function save(){

        $this->validate([
            'tipoPago' => 'required',

        ], [
            'tipoPago.required' => 'Debes ingresar un tipo de pago.',

        ]);
         ////// se guarda  el tipo pago en la BD

         tipospagos::updateOrCreate(
            ['tipoPago' => $this->tipoPago],

        );

        //////// reset todos los campos del formulario
        $this->reset(
            ['tipoPago', ]);

  // ////// emit para refrescar el panel tipos de pago  y actualizar datos en tiempo real
  $this->emit('refreshPanelPagos');
      }

    public function render()
    {


        return view('livewire.modales.agregar-tipo-pago-modal');
    }
}
