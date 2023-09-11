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
    public $vendedor;



    protected $listeners = ['refreshPanelVendedores' => '$refresh'];

    public function mount()
    {

   // si no esta definido admin u otro con permisos se pasa el id del vendedor por defecto
   $this->vendedor =  (auth()->user()->rol == "admin" ) ? 0 : auth()->user()->id;
   
    }       

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
         ->where('pais_id', auth()->user()->pais_id)
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);

        return view('livewire.vendedores',compact('registros'));
    }
}
