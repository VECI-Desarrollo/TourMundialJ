<?php

namespace App\Http\Livewire\Modales;

use App\Models\tipospagos;
use Livewire\Component;

class AgregarTipoPagoModal extends Component
{


      public $tipoPago;


      public function save(){

         ////// se guarda  el tipo pago en la BD

         tipospagos::updateOrCreate(
            ['tipoPago' => $this->tipoPago],

        );
      }

    public function render()
    {


        return view('livewire.modales.agregar-tipo-pago-modal');
    }
}
