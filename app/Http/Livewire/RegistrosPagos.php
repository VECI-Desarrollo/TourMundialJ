<?php

namespace App\Http\Livewire;

use App\Models\monedas;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\registrospagosagencias;
use App\Models\vendedores;

class RegistrosPagos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; //para dar e estilo numerico al paginador
    public $estadosSeleccionados = [];


    public $search = '';
    public $perPage = 30;
    public $filtroMes, $filtroEstado,$monedas,$filtroMoneda,$filtroVendedor,$vendedores;

    protected $listeners = ['refreshPanel' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }
////// Mount
   public function mount()
   {
     $this->filtroMes = null;
     $this->filtroEstado = null;
     $this->filtroMoneda = null;
     $this->filtroVendedor= null;
   }


   //// select monedas 

   public function monedas()
   {
    //// obtener monedas que utiliza el pais ára recibir sus pagos

    $this->monedas =monedas::where('pais_id', auth()->user()->pais_id )->select('moneda')->get();
   }
    
///////metodo para obtener todo los vendedores 
public function vendedores()
{
   $this->vendedores = vendedores::where('pais_id', auth()->user()->pais_id )->get();
}


    public function changeEstate($id, $estado)
    {

      registrospagosagencias::where('id', $id)->update(['estado' => $estado]);
    }


    public function render()
    {
        self::monedas();
        self::vendedores();
        $r = registrospagosagencias::where(function($query) {
            $query->where('agenciaNombre', 'like', '%' . $this->search . '%')
                  ->orWhere('expediente', 'like', '%' . $this->search . '%')
                  ->orWhere('vendedor', 'like', '%' . $this->search . '%')
                  ->orWhere('tiposPagos_id', 'like', '%' . $this->search . '%')
                  ->orWhere('monto', 'like', '%' . $this->search . '%')
                  ->orWhere('tiposProductos_id', 'like', '%' . $this->search . '%')
                  ->orWhere('moneda', 'like', '%' . $this->search . '%')
                  ->orWhere('fechaDeposito', 'like', '%' . $this->search . '%')
                  ->orWhere('agenteViajes', 'like', '%' . $this->search . '%')
                  ->orWhere('id', 'like', '%' . $this->search . '%');
        })
        ->when((auth()->user()->rol == "vendedor" ), function ($query)  {
            $query->where('id_vendedor', auth()->user()->id);
        })
        ->when($this->filtroMes, function ($query)  {
            $query->whereMonth('created_at', $this->filtroMes);
        })
        ->when($this->filtroEstado, function ($query)  {
            $query->where('estado', $this->filtroEstado);
        })
        ->when($this->filtroMoneda, function ($query)  {
            $query->where('moneda', $this->filtroMoneda);
        })
        ->when($this->filtroVendedor, function ($query)  {
            $query->where('id_vendedor', (int) $this->filtroVendedor);
        })
        ->where('pais_id', auth()->user()->pais_id)
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);

        
        return view('livewire.registros-pagos',['registros'=> $r]);
    }
}
