<?php

namespace App\Http\Livewire\Modales;

use App\Models\bancos;
use Livewire\Component;

class AgregarBanco extends Component
{
    public $banco;


    public function save(){

        $this->validate([
            'banco' => 'required',

        ], [
            'banco.required' => 'Debes ingresar un valor.',

        ]);

       ////// se guarda  el tipo pago en la BD

       bancos::updateOrCreate(
          ['nombre' => $this->banco, 'pais_id' => auth()->user()->pais_id],

      );

      $this->reset(
        [ 'banco', ]);

// ////// emit para refrescar el panel banco  y actualizar datos en tiempo real
$this->emit('refreshPanelBancos');
 ///// se llama swwet alert
$this->dispatchBrowserEvent('successfully', ['message' => "se envio con exito!"]);

    }




    public function render()
    {
        return view('livewire.modales.agregar-banco');
    }
}
