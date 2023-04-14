<?php

namespace App\Http\Livewire;

use App\Models\tipospagos;
use Livewire\Component;
use Livewire\WithPagination;

class TiposDePago extends Component
{

    use WithPagination;

    public $search = '';
    public $perPage = 5;

    protected $listeners = ['refreshPanelPagos' => '$refresh'];
    public function render()
    {

        $registros = tipospagos::where(function($query) {
            $query->where('tipoPago', 'like', '%' . $this->search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);

        return view('livewire.tipos-de-pago',compact('registros'));
    }
}
