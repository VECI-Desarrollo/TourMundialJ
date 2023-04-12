<?php

namespace App\Http\Livewire;
use App\Models\Despliegues;
use App\Models\formularios;
use App\Models\registrospagosagencias;
use App\Models\TiposPagos;
use App\Models\TiposProductos;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Livewire\Component;

class Cotizador extends Component
{
    ////// use WhithFileUploads para cargar imagenes o archivos 
    use WithFileUploads;   
    //variables publicas
    public $vendedores,
           $vendedor, 
           $nombreAgenciaPagadora,
           $numeroExpediente,
           $tipoPago,
           $tipoPagoValor,
           $tiposProducto, 
           $productoPagado,
           $moneda,
           $monto,
           $fechaDeposito,
           $comprobante;
  /// para los inputs del array Numero de expediente accept=".jpg,.jpeg,.png,.webp,.pdf"
    public $inputs = [];  


 ////// Montaje /////////////
 
 public function mount()
 {

  
  
 }

 



 ////// para evita espacios en blanco en el numero expediente
 public function updatedNumeroExpediente($value)
{
    if (strpos($value, ' ') !== false) {
        $this->addError('numeroExpediente', 'El campo no debe contener espacios en blanco.');
        $this->numeroExpediente = str_replace(' ', '', $value);
    } elseif (!is_numeric($value)) {
        $this->addError('numeroExpediente', 'El campo debe contener solo números.');
        $this->numeroExpediente = '';
    }
}




  //// Metodo para incrementar los inputs 
  public function addInput()
{
    $this->inputs[] = $this->numeroExpediente;

    $this->numeroExpediente = '';
}

// remover Inputs

public function removeInput($key)
{
    unset($this->inputs[$key]);
}


public function saveInputs()
{
    foreach ($this->inputs as $input) {
        // hacer algo con cada valor ingresado
    }
}



    public function ConsultasSelects()
    {

     /////// Consulta para el select vendedores   
     $this->vendedores = 
      Despliegues:: join('Usuarios', 'despliegues.Usuarios_id', '=', 'Usuarios.id')
     ->select('Usuarios.id as id', DB::raw("CONCAT(Usuarios.nombre, ' ', Usuarios.apellido) as vendedor"))
     ->where('despliegues.formularios_id', 1)
     ->orderBy('vendedor')
     ->get();
     
     /////// Consulta para el select tipo de pago 
     $this->tipoPago = TiposPagos::where('estado', 1)->orderBy('tipoPago')->get();

     ////// Consulta para el select tipos de productos
     $this->tiposProducto =TiposProductos::where('estado', 1)->orderBy('tipoProducto')->get();
      

    }

    //=============== [ Metodo para la insercion de los registros ] =================//

    public function SaveRegistro(){
     
        $this->validate([
            'comprobante' => 'required|mimes:jpg,jpeg,png,webp,pdf|max:5120',
            'vendedor' => 'required',
            'nombreAgenciaPagadora' => 'required',
            'numeroExpediente'=> 'required',
            'tipoPagoValor'=> 'required',
            'productoPagado'=> 'required',
            'moneda'=> 'required',
            'monto' => 'required',
            'fechaDeposito' => 'required',

        ], [
            'comprobante.required' => 'El archivo es obligatorio.',
            'comprobante.mimes' => 'El archivo debe ser una imagen o PDF.',
            'comprobante.max' => 'El archivo no debe ser mayor de 5 MB.',
            //========== vendedor
            'vendedor.required'=> 'Se debe seleccionar vendedor.',
            //========== nombreAgenciaPagadora
            'nombreAgenciaPagadora' => 'Nombre de la agencia pagadora es obligatorio.',
            //========== numeroExpediente
            'numeroExpediente'=> 'Número de expediente obligatorio.',
            //========== tipoPagoValor
            'tipoPagoValor' => 'El tipo de pago es obligatorio.',
            //========== productoPagado
            'productoPagado' => 'El Producto pagado es obligatorio.',
            //========== moneda 
            'moneda' => 'Seleccione moneda de pago es obligatorio.',
            //========== monto 
            'monto' => 'Ingrese el monto pagado es obligatorio ',
            //========== fechaDeposito
            'fechaDeposito' => 'La fecha del deposito o pago con tarjeta de credito es obligatoria.',

        ]);
        
       ///// se combinan los inputs del array con el contenido del numero de expediente si existe
       if($this->numeroExpediente):
         array_push($this->inputs,$this->numeroExpediente);
       endif;
         /// se convierte el array en una cadena string separa por comas para insertarla en la bd
         $numerosExpediente=  implode(',', $this->inputs);

       
         $originalName = $this->comprobante->getClientOriginalName();

       $table= registrospagosagencias::create([
            'Usuarios_id' => $this->vendedor,
            'agenciaNombre' => $this->nombreAgenciaPagadora,
            'expediente' => $numerosExpediente,
            'tiposPagos_id' => $this->tipoPagoValor,
            'monto' => $this->monto,
            'comprobante' => $originalName,
            'tiposProductos_id' => $this->productoPagado,
            'fechaDeposito' => $this->fechaDeposito,
            'moneda' => $this->moneda,
            'tipoCambio' => null
        ]);


        
    
       
    }


    public function render()
    {   self::ConsultasSelects();
        return view('livewire.cotizador');
    }
}
