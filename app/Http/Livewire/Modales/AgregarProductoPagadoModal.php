<?php

namespace App\Http\Livewire\Modales;

use App\Models\tiposproductos;
use Livewire\Component;

class AgregarProductoPagadoModal extends Component
{
    public $tipoProducto;


    public function save(){

       ////// se guarda  el tipo pago en la BD

       tiposproductos::updateOrCreate(
          ['tipoProducto' => $this->tipoProducto],

      );

      // ////// emit para refrescar el panel tipos de pago  y actualizar datos en tiempo real
  $this->emit('refreshPanelProductos');
    }

    public function render()
    {
        return view('livewire.modales.agregar-producto-pagado-modal');
    }
}
