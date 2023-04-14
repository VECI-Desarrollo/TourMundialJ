<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\registrospagosagencias;

class PanelControl extends Component
{

    use WithPagination;

    public $search = '';
    public $perPage = 5;

    protected $listeners = ['refreshPanel' => '$refresh'];

    public function render()
    {

        $registros = registrospagosagencias::where(function($query) {
            $query->where('agenciaNombre', 'like', '%' . $this->search . '%')
                  ->orWhere('expediente', 'like', '%' . $this->search . '%')
                  ->orWhere('fechaDeposito', 'like', '%' . $this->search . '%');
        })
        ->orderBy('fecha', 'desc')
        ->paginate($this->perPage);


        return view('livewire.panel-control', compact('registros'));
    }
}
