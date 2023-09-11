<?php

namespace App\Http\Livewire;

use App\Models\monedas as ModelsMonedas;
use Livewire\Component;
use Livewire\WithPagination;

class Monedas extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap'; //para dar e estilo numerico al paginador

    public $search = '';
    public $perPage = 10;

    protected $listeners = ['refreshPanelMonedas' => '$refresh'];

   

    public function updatingSearch()
    {
        $this->resetPage();
    }

    //// metodo para borrar

    public function delete($id){
        ModelsMonedas::where('id', $id)->delete();
  // ////// emit para refrescar el panel vendedores  y actualizar datos en tiempo real
    $this->emit('refreshPanelMonedas');
    }


    public function render()
    {
        $registros =  ModelsMonedas::where(function($query) {
            $query->where('moneda', 'like', '%' . $this->search . '%');
        })
        ->where('pais_id', auth()->user()->pais_id)
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);

        return view('livewire.monedas',compact('registros'));
    }
}
