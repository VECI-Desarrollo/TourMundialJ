<?php

namespace App\Http\Livewire;

use App\Models\vendedores as ModelsVendedores;
use Livewire\Component;
use Livewire\WithPagination;

class Vendedores extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;

    protected $listeners = ['refreshPanelVendedores' => '$refresh'];

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
