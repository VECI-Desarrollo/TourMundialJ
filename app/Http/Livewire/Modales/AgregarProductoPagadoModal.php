<?php

namespace App\Http\Livewire\Modales;

use App\Models\tiposproductos;
use Livewire\Component;

class AgregarProductoPagadoModal extends Component
{
    public $tipoProducto;


    public function save(){

        $this->validate([
            'tipoProducto' => 'required',

        ], [
            'tipoProducto.required' => 'Debes ingresar un tipo producto.',

        ]);

       ////// se guarda  el tipo pago en la BD

       tiposproductos::updateOrCreate(
          ['tipoProducto' => $this->tipoProducto],

      );

      // ////// emit para refrescar el panel tipos de pago  y actualizar datos en tiempo real
  $this->emit('refreshPanelProductos');

  /// activa el sweet alert
            $this->dispatchBrowserEvent('successfully', ['message' => "se envio con exito!"]);
    }

    public function render()
    {
        return view('livewire.modales.agregar-producto-pagado-modal');
    }
}
