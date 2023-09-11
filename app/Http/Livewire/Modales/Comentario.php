<?php

namespace App\Http\Livewire\Modales;

use App\Models\registrospagosagencias;
use Livewire\Component;

class Comentario extends Component
{
     public $Id,$comentarios,$comFinazas;

    
    
    protected $listeners =
    [
        'RecibirDatos'
    ];
    

    protected $rules = [
        'comentarios.comentario_finanzas' => 'required|',
        'comentarios.comentario_general' => 'required'
       
    ];

    public function RecibirDatos($id)
    {
        
        
          $this->Id = $id; 
          $this->comentarios = registrospagosagencias::where('id', $id)->first();


    }


    public function save()
    { 
         $this->validate();

         if(auth()->user()->rol == "finanzas" || auth()->user()->rol == "admin"){

         $this->comentarios->update([
            'comentario_finanzas' => $this->comentarios['comentario_finanzas']
        ]);

    }/// fin del if finanzas

    }
 


    public function render()
    {

        
        return view('livewire.modales.comentario');
    }
}
