<?php

namespace App\Http\Livewire\Modales;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\vendedores;

class UserRegister extends Component
{

    public $name,$lastName,$yankee,$rol,$email,$country,$password;


    public function save()
    {

        $this->validate([
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'yankee' => 'required',
            'rol' => 'required',
            'password' => 'required',

        ], [
            'name.required' => 'El nombre es obligatorio.',
            'lastName.required' => 'El apellido es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'rol.required' => 'Asigne un rol',
            'yankee.required' => 'Debe ingresar Yankee del vendedor',
            'password' => 'contraseña necesaria',

        ]);


        User::create([
            'name' => $this->name. " ".$this->lastName,
            'yankee' => $this->yankee,
            'rol' => $this->rol,
            'pais_id' => auth()->user()->pais_id,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            
        ]);

        if($this->rol === "vendedor")
        
        {
   ////// se guarda el vendedor en la base de datos

   vendedores::updateOrCreate(
    ['nombre' => $this->name, 'apellido' => $this->lastName, 'email'=>$this->email, 'pais_id' => auth()->user()->pais_id ] ,

);

        }

             //////// reset todos los campos del formulario
             $this->reset(
                [ 'name',
                'lastName',
                'email',
                'rol',
                'yankee',
                'password', ]);

    }



    public function render()
    {
        return view('livewire.modales.user-register');
    }
}
