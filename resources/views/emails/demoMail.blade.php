<html>
<head>
    <title>Regsitro Ticket Tour Mundial</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['subTitle'] }}</p>

    <p>Vendedor:  <strong class="text-inverse">{{ $mailData['vendedor'] }} {{ $mailData['apellido'] }}</strong><br></p>
    <p>Agencia Pagadora:  <strong class="text-inverse">{{ $mailData['agencia'] }}</strong><br></p>
    <p>Agente de Viajes:  <strong class="text-inverse">{{ $mailData['agenteViajes'] }}</strong><br></p>
    <p>Producto pagado:  <strong class="text-inverse">{{ $mailData['tipoProducto'] }}</strong><br></p>
    <p>Tipo de pago:  <strong class="text-inverse">{{ $mailData['tipoPago'] }}</strong><br></p>
    <p>Expediente:  <strong class="text-inverse">{{ $mailData['expediente'] }}</strong><br></p>
    <p>Monto:  ${{ $mailData['monto'] }}<br></p>
    <p>Fecha de Registro:  {{ $mailData['fechaRegistro'] }}<br></p>
    <p>Fecha de Deposito:  {{ $mailData['fechaDeposito'] }}<br></p>
    <p>Id del ticket:  <strong class="text-inverse"> {{ $mailData['id'] }}</strong><br></p>
   
   
    
    @if(substr($mailData['archivo'], -3) == 'pdf')

    <img src="{{ $message->embed(public_path('archivos/pdf/'.$mailData['archivo'] )) }}" alt="pdf">
   @else
   <img src="{{ $message->embed(public_path('archivos/img/'.$mailData['archivo'] )) }}" alt="Imagen">
   @endif

    <div class="invoice-note">
        * Email generado y enviado automaticamente por Tour Mundial.<br>.
     </div>
     <div class="invoice-footer">
        <p class="text-center m-b-5 f-w-600">
          TourMundial {{ date("Y") }} &copy; Todos los Derechos Reservados.
        </p>
     </div>


</body>
</html>
