<?php

namespace App\Http\Livewire;

use \Anhskohbo\NoCaptcha\NoCaptcha;

use App\Mail\DemoMail;
use App\Models\agenciapagadora;
use App\Models\agenteviajes;
use App\Models\bancos;
use App\Models\correosadjuntos;
use App\Models\registrospagosagencias;
use App\Models\tipospagos;
use App\Models\tiposproductos;
use App\Models\vendedores;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Livewire\WithFileUploads;
use Livewire\Component;

use Illuminate\Support\Facades\Validator;



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
           $listaBancos,
           $productoPagado,
           $moneda,
           $monto,
           $banco,
           $fechaDeposito,
           $comprobante,
           $nombreAgenteViajes,
           $agentesDeViajes,
           $MonedaMontoPagado,
           $bancoActive,
           $comentario_general;

       public $recaptcha,$h;
       public $captcha;
       public $switchCountry ;

 /////////////// listeners
           protected $listeners = ['refresForm' => '$refresh'];


  /// para los inputs del array Numero de expediente accept=".jpg,.jpeg,.png,.webp,.pdf"
    public $inputs = [];

 ///  variables para el input nombre agencia pagadora
 public $agenciasPagadoras = [];


 protected $rules = [
    'captcha' => 'required|captcha',
];


 ////// Montaje /////////////

 public function mount()
 {
$this->bancoActive=false;
$this->switchCountry = 152;
 }

 //// switch pais 
 public function switchCountry($idCountry)
 {
    $this->switchCountry = ($idCountry === 'cl') ? 152 : 484;

 }

 public function seleccionarAgenciaPagadora($nombre)
{
    $this->nombreAgenciaPagadora = $nombre;
    $this->agenciasPagadoras = [];
}

/////// selecionar agente de viajes de la db

public function seleccionarAgentesDeViajes($nombre)
{


    $this->nombreAgenteViajes = $nombre;
    $this->agentesDeViajes = [];
}


/////// Insertar el nombre de la agencia de viajes para recordarlo en BD ////////
 public function updatedNombreAgenciaPagadora($value)
 {
     if (strlen($value) >= 3) {
         $this->agenciasPagadoras = agenciapagadora::where('nombre', 'LIKE', '%'.$value.'%')->where('pais_id', $this->switchCountry)->get();
     } else {
         $this->agenciasPagadoras = [];
     }
 }


 ///////// Insertar el nombre del agente de viajes para recordarlo en la BD /////////

 public function updatedNombreAgenteViajes($value)
 {
     if (strlen($value) >= 3) {
         $this->agentesDeViajes = agenteviajes::where('nombre', 'LIKE', '%'.$value.'%')->where('pais_id', $this->switchCountry)->get();
     } else {
         $this->agentesDeViajes = [];
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
     $this->vendedores =vendedores::where('estado', 1)->where('pais_id', $this->switchCountry)->get();

     /////// Consulta para el select tipo de pago
     $this->tipoPago = tipospagos::where('estado', 1)->where('pais_id', $this->switchCountry)->orderBy('tipoPago')->get();

     ////// Consulta para el select tipos de productos
     $this->tiposProducto =tiposproductos::where('estado', 1)->where('pais_id', $this->switchCountry)->orderBy('tipoProducto')->get();

     //////Consulta select para el listado de bancos
     $this->listaBancos =bancos::where('pais_id', $this->switchCountry)->get();


    }

     ////// metodo que para el areglo de correos

        public function correos()
        {
           $correosAdjuntos = correosadjuntos::select('email')->where('pais_id', $this->switchCountry)->toArray();

        }


    //=============== [ Metodo para la insercion de los registros ] =================//

    public function SaveRegistro(){

 $captcha = new \Anhskohbo\NoCaptcha\NoCaptcha(env('NOCAPTCHA_SECRET'), env('NOCAPTCHA_SITEKEY'));

 //dd($this->recaptcha);


$inputs = $this->inputs;

        $this->validate([
            'comprobante' => 'required|mimes:jpg,jpeg,png,webp,pdf|max:5120',
            'vendedor' => 'required',
            'nombreAgenciaPagadora' => 'required',
            'tipoPagoValor'=> 'required',
            'productoPagado'=> 'required',
          

            // 'moneda'=> 'required',
            'monto' => 'required',
            'fechaDeposito' => 'required',
            'nombreAgenteViajes'=> 'required',
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
            // 'moneda' => 'Seleccione moneda de pago es obligatorio.',
            //========== monto
            'monto' => 'Ingrese el monto pagado es obligatorio ',
            //========== fechaDeposito
            'fechaDeposito' => 'La fecha del deposito o pago con tarjeta de credito es obligatoria.',
            //=========== nombreAgenteViajes
            'nombreAgenteViajes' => 'El nombre del agente es obligatorio',
                //=========== recaptcha



        ]);

//               if (!$this->recaptcha) {
//     //$this->h = "Respuesta válida";
//     return $this->h = "El captcha es necesario";
// }


       ///// se combinan los inputs del array con el contenido del numero de expediente si existe
       if($this->numeroExpediente):
         array_push($this->inputs,$this->numeroExpediente);
       endif;
         /// se convierte el array en una cadena string separa por comas para insertarla en la bd
         $numerosExpediente=  implode(',', $this->inputs);

         /// se obtiene el nombre original del archivo  comprobante
        $originalName = $this->comprobante->getClientOriginalName();


        /////// se saca el nombre del vendeor con su id

        $nombreVendedor = Vendedores::where('id', $this->vendedor)->first();

        ////// se genera id de archivo unico

        $nombreArchivo=uniqid().$originalName;

        // dd( $nombreVendedor->nombre);

        //// selecionar el tipo e moneda en  base al tipo de pago

        $moneda = tipospagos::Where('tipoPago', $this->tipoPagoValor)->first();

        // dd( $moneda->moneda);



        $insertTicket = registrospagosagencias::create([
            'vendedor' => $nombreVendedor->nombre . ' ' . $nombreVendedor->apellido,
            'id_vendedor' => $nombreVendedor->id,
            'agenciaNombre' => $this->nombreAgenciaPagadora,
            'agenteViajes'=> $this->nombreAgenteViajes,
            'expediente' => $numerosExpediente,
            'tiposPagos_id' => $this->tipoPagoValor,
            'monto' => $this->monto,
            'comprobante' => $nombreArchivo,
            'tiposProductos_id' => $this->productoPagado,
            'fechaDeposito' => $this->fechaDeposito,
            'moneda' => $moneda->moneda,
            'banco' => $this->banco,
            'comentario_general' => $this->comentario_general,

        ]);

         ////////// se guarda la agencia si , no exite en la lista
       agenciapagadora::updateOrCreate(
            ['nombre' => $this->nombreAgenciaPagadora],

        );

        ////////// se guarda el nombre del agente de viaje si , no exite en la lista
       agenteviajes::updateOrCreate(
        ['nombre' => $this->nombreAgenteViajes],

    );
            ///// se define si el archivo el pdf o imagen para guardar en la carpeta correspondiente
          $tipoArchivo= substr($originalName, -3);
          if($tipoArchivo == 'pdf'){
            $this->comprobante->storeAs('archivos/pdf',$nombreArchivo,'public2');
          }else{
            $this->comprobante->storeAs('archivos/img',$nombreArchivo,'public2');
          }



        //    dd($insertTicket);

        /////================================[Seccion para el envio de emails] ========////

          /// se genera el array  para pasar los valores a la vista de email DemoEmail
            $mailData = [
                'title' => 'Registro de pago TourMundial.',
                'subTitle' => 'Detalles del registro de pago.',
                'vendedor'=>$nombreVendedor->nombre,
                'apellido'=> $nombreVendedor->apellido,
                'agencia'=> $this->nombreAgenciaPagadora,
                'agenteViajes'=> $this->nombreAgenteViajes,
                'expediente'=> $numerosExpediente,
                'tipoPago' => $this->tipoPagoValor,
                'monto' => $this->monto,
                'tipoProducto'=>$this->productoPagado,
                'fechaRegistro'=> date('Y-m-d'),
                'fechaDeposito'=>$this->fechaDeposito,
                'moneda'=> $this->moneda,
                'archivo' => $nombreArchivo,
                'id'=> $insertTicket->id,


            ];

    //////// se obtienen los email aosciado y el del vendedor en un array
    $emailsAdjuntos = correosadjuntos::pluck('email');
    $emailVendedor = Vendedores::where('id', $this->vendedor)->pluck('email');
    $emails = $emailsAdjuntos->merge($emailVendedor)->toArray();


            //  dd($emails);

//    ////// se utliza el metodo para envio ásando el arreglo de
            FacadesMail::to($emails)->send(new DemoMail($mailData));

            //////// reset todos los campos del formulario
         $this->reset(
            [ 'vendedor',
              'nombreAgenciaPagadora',
              'numeroExpediente',
              'inputs',
              'tipoPagoValor',
              'monto',
              'productoPagado',
              'fechaDeposito',
              'moneda',
            ]);

            $this->comprobante=null;
            $this->dispatchBrowserEvent('successfully', ['message' => "se envio con exito!"]);
            // dd("Email is sent successfully.");



    }


    public function render()
    {   self::ConsultasSelects();



        $m= tipospagos::Where('tipoPago', $this->tipoPagoValor)->where('pais_id', $this->switchCountry)->first();

        if($m){

        $this->MonedaMontoPagado = $m->moneda;
        }


        return view('livewire.cotizador')->layout('layouts.guest');
    }
}
