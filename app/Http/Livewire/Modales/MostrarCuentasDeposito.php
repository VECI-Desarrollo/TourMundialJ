<?php

namespace App\Http\Livewire\Modales;

use Livewire\Component;

class MostrarCuentasDeposito extends Component
{
    public $images = [
        'cuenta1.png',
        'cuenta2.png',
    ];

    public $currentIndex = 0;

    public $moneda;

    public function mount(){
        $this->moneda="CLP";
    }

    public function toggle()
    {
        $this->currentIndex = ($this->currentIndex + 1) % count($this->images);
        $this->moneda = ( $this->moneda == "CLP" ) ?  "USD" : "CLP";     
        
      
    }

    public function render()
    {

        $currentImage = $this->images[$this->currentIndex];
        $nextIndex = ($this->currentIndex + 1) % count($this->images);
        $nextImage = $this->images[$nextIndex];

        return view('livewire.modales.mostrar-cuentas-deposito', [
            'currentImage' => asset("img/$currentImage"),
            'nextImage' => asset("img/$nextImage"),
        ]);
    }
}
