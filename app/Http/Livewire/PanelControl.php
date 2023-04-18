<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\registrospagosagencias;
class PanelControl extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; //para dar e estilo numerico al paginador


    public $search = '';
    public $perPage = 3;

    protected $listeners = ['refreshPanel' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $registros = registrospagosagencias::where(function($query) {
            $query->where('agenciaNombre', 'like', '%' . $this->search . '%')
                  ->orWhere('expediente', 'like', '%' . $this->search . '%')
                  ->orWhere('vendedor', 'like', '%' . $this->search . '%')
                  ->orWhere('tiposPagos_id', 'like', '%' . $this->search . '%')
                  ->orWhere('monto', 'like', '%' . $this->search . '%')
                  ->orWhere('tiposProductos_id', 'like', '%' . $this->search . '%')
                  ->orWhere('moneda', 'like', '%' . $this->search . '%')
                  ->orWhere('fechaDeposito', 'like', '%' . $this->search . '%')
                  ->orWhere('id', 'like', '%' . $this->search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);

        return view('livewire.panel-control', compact('registros'));
    }
}

