<?php

namespace App\Http\Livewire\Modales;

use App\Models\registrospagosagencias;
use Livewire\Component;

class InfoRegistro extends Component
{   
    public $query;
   
    protected $listeners = ['RecibirDatosInfo'];


    protected $rules = [
        'query.tiposProductos_id' => 'required|',
        'query.moneda' => 'required|',
        'query.fechaDeposito' => 'required|',
        'query.banco' => 'required|',
        'query.id' => 'required|',
        'query.comentario_finanzas'  => 'required',
        'query.comentario_general'  => 'required',

       
    ];

    


    public function RecibirDatosInfo($idInfo)
    {
       $this->query= registrospagosagencias::where('id', $idInfo)->first();
    }


    public function save()
    { 
     
         if(auth()->user()->rol == "finanzas" ){

       
            $this->query->save();

    }/// fin del if finanzas

    }

    public function render()
    {
        return view('livewire.modales.info-registro');
    }
}
