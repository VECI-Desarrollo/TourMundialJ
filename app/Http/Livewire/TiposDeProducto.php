<?php

namespace App\Http\Livewire;

use App\Models\tiposproductos;
use Livewire\Component;
use Livewire\WithPagination;

class TiposDeProducto extends Component
{

    use WithPagination;

    public $search = '';
    public $perPage = 5;

    protected $listeners = ['refreshPanelProductos' => '$refresh'];

    public function render()
    {
        $registros = tiposproductos::where(function($query) {
            $query->where('tipoProducto', 'like', '%' . $this->search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);


        return view('livewire.tipos-de-producto',compact('registros'));
    }
}
