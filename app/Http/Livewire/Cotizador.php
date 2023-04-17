<?php

namespace App\Http\Livewire;

use App\Mail\DemoMail;
use App\Mail\Mail;
use App\Models\agenciapagadora;
use App\Models\correosadjuntos;
use App\Models\registrospagosagencias;
use App\Models\TiposPagos;
use App\Models\TiposProductos;
use App\Models\vendedores;
use Illuminate\Support\Facades\Mail as FacadesMail;
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

 ///  variables para el input nombre agencia pagadora
 public $agenciasPagadoras = [];


 ////// Montaje /////////////

 public function mount()
 {



 }


 public function seleccionarAgenciaPagadora($nombre)
{
    $this->nombreAgenciaPagadora = $nombre;
    $this->agenciasPagadoras = [];
}

 public function updatedNombreAgenciaPagadora($value)
 {
     if (strlen($value) >= 3) {
         $this->agenciasPagadoras = agenciapagadora::where('nombre', 'LIKE', '%'.$value.'%')->get();
     } else {
         $this->agenciasPagadoras = [];
     }
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
     $this->vendedores =vendedores::where('estado', 1)->get();

     /////// Consulta para el select tipo de pago
     $this->tipoPago = TiposPagos::where('estado', 1)->orderBy('tipoPago')->get();

     ////// Consulta para el select tipos de productos
     $this->tiposProducto =TiposProductos::where('estado', 1)->orderBy('tipoProducto')->get();


    }

     ////// metodo que para el areglo de correos

        public function correos()
        {
           $correosAdjuntos = correosadjuntos::select('email')->toArray();

        }


    //=============== [ Metodo para la insercion de los registros ] =================//

    public function SaveRegistro(){

$inputs = $this->inputs;
        $this->validate([
            'comprobante' => 'required|mimes:jpg,jpeg,png,webp,pdf|max:5120',
            'vendedor' => 'required',
            'nombreAgenciaPagadora' => 'required',
            'tipoPagoValor'=> 'required',
            'productoPagado'=> 'required',
            'moneda'=> 'required',
            'monto' => 'required',
            'fechaDeposito' => 'required',
            'numeroExpediente'=> [
                function ($attribute, $value, $fail) use ($inputs) {
                    if (empty($inputs)) {
                        if (!$value) {
                            $fail('El número de expediente es requerido cuando $inputs está vacío');
                        }
                    }
                },
            ],

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

         /// se obtiene el nombre original del archivo  comprobante
        $originalName = $this->comprobante->getClientOriginalName();

       $table= registrospagosagencias::create([
            'vendedor' => $this->vendedor,
            'agenciaNombre' => $this->nombreAgenciaPagadora,
            'expediente' => $numerosExpediente,
            'tiposPagos_id' => $this->tipoPagoValor,
            'monto' => $this->monto,
            'comprobante' => $originalName,
            'tiposProductos_id' => $this->productoPagado,
            'fechaDeposito' => $this->fechaDeposito,
            'moneda' => $this->moneda,

        ]);

        agenciapagadora::updateOrCreate(
            ['nombre' => $this->nombreAgenciaPagadora],

        );

          $tipoArchivo= substr($originalName, -3);
          if($tipoArchivo == 'pdf'){
            $this->comprobante->storeAs('archivos/pdf',uniqid()."-".$originalName,'public2');
          }else{
            $this->comprobante->storeAs('archivos/img',uniqid()."-".$originalName ,'public2');
          }

//////// reset todos los campos del formulario
         $this->reset(
            ['vendedor',
              'nombreAgenciaPagadora',
              'numeroExpediente',
              'inputs',
              'tipoPagoValor',
              'monto',
              'productoPagado',
              'fechaDeposito',
              'moneda',
              'comprobante',

            ]);



            $mailData = [
                'title' => 'Mail from Web-tuts.com',
                'body' => 'This is for testing email using smtp.'
            ];


            $emails =correosadjuntos::select('email')->get()->toArray();

            FacadesMail::to($emails)->send(new DemoMail($mailData));


            $this->dispatchBrowserEvent('successfully', ['message' => "se envio con exito!"]);
            // dd("Email is sent successfully.");



    }


    public function render()
    {   self::ConsultasSelects();

        return view('livewire.cotizador');
    }
}
