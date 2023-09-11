<?php

namespace App\Http\Livewire\Modales;

use App\Models\correosadjuntos;
use Livewire\Component;

class AgregarCorreoAd extends Component
{

    public $email;


    public function save(){

        $this->validate([
            'email' => 'required',

        ], [
            'email.required' => 'Debes ingresar email.',

        ]);

       ////// se guarda  el tipo pago en la BD

       correosadjuntos::updateOrCreate(
          ['email' => $this->email , 'pais_id' => auth()->user()->pais_id],

      );

// ////// emit para refrescar el panel tipos de pago  y actualizar datos en tiempo real
$this->emit('refreshPanelCorreosAd');
 ///// se llama swwet alert
$this->dispatchBrowserEvent('successfully', ['message' => "se envio con exito!"]);

    }


    public function render()
    {
        return view('livewire.modales.agregar-correo-ad');
    }
}
