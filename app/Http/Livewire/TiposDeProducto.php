<?php

namespace App\Http\Livewire;

use App\Models\tiposproductos;
use Livewire\Component;
use Livewire\WithPagination;

class TiposDeProducto extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap'; //para dar e estilo numerico al paginador

    public $search = '';
    public $perPage = 10;

    protected $listeners = ['refreshPanelProductos' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

        //// metodo para borrar
        public function delete($id){
            tiposproductos::where('id', $id)->delete();
      // ////// emit para refrescar el panel vendedores  y actualizar datos en tiempo real
        $this->emit('refreshPanelProductos');
        }

    public function render()
    {
        $registros = tiposproductos::where(function($query) {
            $query->where('tipoProducto', 'like', '%' . $this->search . '%');
        })
        ->where('pais_id', auth()->user()->pais_id)
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);


        return view('livewire.tipos-de-producto',compact('registros'));
    }
}
