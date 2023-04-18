<?php

namespace App\Http\Livewire;

use App\Models\correosadjuntos as ModelsCorreosadjuntos;
use Livewire\Component;
use Livewire\WithPagination;

class CorreosAdjuntos extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap'; //para dar e estilo numerico al paginador

    public $search = '';
    public $perPage = 10;

    protected $listeners = ['refreshPanelCorreosAd' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

     //// metodo para borrar
     public function delete($id){
        ModelsCorreosadjuntos::where('id', $id)->delete();
  // ////// emit para refrescar el panel vendedores  y actualizar datos en tiempo real
    $this->emit('refreshPanelCorreosAd');
    }

    public function render()
    {
        $registros = ModelsCorreosadjuntos::where(function($query) {
            $query->where('email', 'like', '%' . $this->search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);


        return view('livewire.correos-adjuntos',compact('registros'));
    }
}
