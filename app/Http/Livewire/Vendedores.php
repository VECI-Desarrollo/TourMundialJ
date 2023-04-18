<?php

namespace App\Http\Livewire;

use App\Models\vendedores as ModelsVendedores;
use Livewire\Component;
use Livewire\WithPagination;

class Vendedores extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; //para dar e estilo numerico al paginador

    public $search = '';
    public $perPage = 10;

    //// variables para edit
    public $vendedorId;
    public $nombre;
    public $apellido;
    public $email;


    protected $listeners = ['refreshPanelVendedores' => '$refresh'];
   ///// metodo editar vendedor
    public function edit($id)
{
    $vendedor = ModelsVendedores::find($id);
    $this->vendedorId = $vendedor->id;
    $this->nombre = $vendedor->nombre;
    $this->apellido = $vendedor->apellido;
    $this->email = $vendedor->email;
}


    public function updatingSearch()
    {
        $this->resetPage();
    }


    //// metodo para borrar

    public function delete($id){

        ModelsVendedores::where('id', $id)->delete();
  // ////// emit para refrescar el panel vendedores  y actualizar datos en tiempo real
    $this->emit('refreshPanelVendedores');
    }




    public function render()
    {

        $registros = ModelsVendedores::where(function($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%')
                  ->orWhere('apellido', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);

        return view('livewire.vendedores',compact('registros'));
    }
}
