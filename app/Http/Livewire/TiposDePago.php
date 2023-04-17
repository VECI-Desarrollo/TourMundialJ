<?php

namespace App\Http\Livewire;

use App\Models\tipospagos;
use Livewire\Component;
use Livewire\WithPagination;

class TiposDePago extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap'; //para dar e estilo numerico al paginador

    public $search = '';
    public $perPage = 3;

    protected $listeners = ['refreshPanelPagos' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    //// metodo para borrar

    public function delete($id){
        tipospagos::where('id', $id)->delete();
  // ////// emit para refrescar el panel vendedores  y actualizar datos en tiempo real
    $this->emit('refreshPanelPagos');
    }


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
