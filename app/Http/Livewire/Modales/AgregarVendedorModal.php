<?php

namespace App\Http\Livewire\Modales;

use App\Models\User;
use App\Models\vendedores;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class AgregarVendedorModal extends Component
{

    //// variable
    public $nombre, $apellido , $email, $yankee, $password;



     ///// sava vendedores metodo
     public function save(){


        $this->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',
            'yankee' => 'required',
            'password' => 'required',

        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'yankee.required' => 'Debe ingresar Yankee del vendedor',
            'password' => 'contraseña necesaria',

        ]);


        ////// se guarda el vendedor en la base de datos

             vendedores::updateOrCreate(
            ['nombre' => $this->nombre, 'apellido' => $this->apellido, 'email'=>$this->email, 'pais_id' => auth()->user()->pais_id ] ,

        );

        ///// tambien se agrega a la tabla user para el login del vedeor

        User::create([
            'name' =>  $this->nombre. $this->apellido,
            'yankee' => $this->yankee,
            'rol' => 'vendedor',
            'pais_id' => auth()->user()->pais_id,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);



        //////// reset todos los campos del formulario
        $this->reset(
            [ 'nombre',
            'apellido',
            'email',
            'yankee',
            'password', ]);


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
