<?php

namespace App\Http\Livewire;

use App\Models\bancos as ModelsBancos;
use Livewire\Component;
use Livewire\WithPagination;

class Bancos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; //para dar e estilo numerico al paginador

    public $search = '';
    public $perPage = 10;

    protected $listeners = ['refreshPanelBancos' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

     //// metodo para borrar
     public function delete($id){
        ModelsBancos::where('id', $id)->delete();
  // ////// emit para refrescar el panel vendedores  y actualizar datos en tiempo real
    $this->emit('refreshPanelBancos');
    }



    public function render()
    {


        $registros = ModelsBancos::where(function($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        })
        ->where('pais_id', auth()->user()->pais_id)
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);


        return view('livewire.bancos',compact('registros'));
    }
}
