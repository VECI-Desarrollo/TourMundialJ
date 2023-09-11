<?php

namespace App\Http\Livewire\Modales;

use App\Models\User;
use App\Models\vendedores;
use Livewire\Component;

class EditVendedor extends Component
{
    
    public vendedores $edit;

  


    //// reglas de validacion para que se muestren bien los camps en liveiwre

    protected function rules()
    {

        return ['edit.nombre'=> 'required','edit.apellido'=>'required','edit.email'=>'required'];

    }


      ////// metodo para guardar cambios del edit
      public function editSave()
      {

          $this->edit->save();

          User::where('email' ,$this->edit->email)
          ->update([
            'name' => $this->edit->nombre . ' ' . $this->edit->apellido,
            'email' => $this->edit->email,
            
        ]);
               // ////// emit para refrescar el panel vendedores  y actualizar datos en tiempo real
         $this->emit('refreshPanelVendedores');

      }


    public function render()
    {
        return view('livewire.modales.edit-vendedor');
    }
}
