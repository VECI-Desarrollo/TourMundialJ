<?php

namespace App\Http\Livewire;

use App\Models\Pais;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
class NavigationBar extends Component
{
     public $pais;

    //// seleccion de pais 
    public function pais()
    {
      $this->pais= Pais::where('id', auth()->user()->pais_id)->first(); 

    }

    public function render()
    {
        self::pais();
        return view('livewire.navigation-bar');
    }
}
