<?php

namespace App\Http\Livewire\Modales;

use App\Models\vendedores;
use Livewire\Component;

class AgregarVendedorModal extends Component
{

    //// variable
    public $nombre, $apellido , $email;



     ///// sava vendedores metodo
     public function save(){


        $this->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',

        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'email.required' => 'El email es obligatorio.',

        ]);


        ////// se guarda el vendedor en la base de datos

             vendedores::updateOrCreate(
            ['nombre' => $this->nombre, 'apellido' => $this->apellido, 'email'=>$this->email],

        );

        //////// reset todos los campos del formulario
        $this->reset(
            [ 'nombre',
            'apellido',
            'email', ]);


        // ////// emit para refrescar el panel vendedores  y actualizar datos en tiempo real
         $this->emit('refreshPanelVendedores');
        // $this->dispatchBrowserEvent('name-updated');

        $this->dispatchBrowserEvent('successfully', ['message' => "se envio con exito!"]);

     }

    public function render()
    {



        return view('livewire.modales.agregar-vendedor-modal');
    }
}
