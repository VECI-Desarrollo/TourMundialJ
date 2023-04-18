<html>
<head>
    <title>Regsitro Ticket Tour Mundial</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['subTitle'] }}</p>

    <p>Vendedor:  <strong class="text-inverse">{{ $mailData['vendedor'] }} {{ $mailData['apellido'] }}</strong><br></p>
    <p>Agencia Pagadora:  <strong class="text-inverse">{{ $mailData['agencia'] }}</strong><br></p>
    <p>Producto pagado:  <strong class="text-inverse">{{ $mailData['tipoProducto'] }}</strong><br></p>
    <p>Monto:  ${{ $mailData['monto'] }}<br></p>
    <p>Fecha de Registro:  {{ $mailData['fechaRegistro'] }}<br></p>
    <p>Fecha de Deposito:  {{ $mailData['fechaDeposito'] }}<br></p>
    <p>Id del ticket:  <strong class="text-inverse"> {{ $mailData['id'] }}</strong><br></p>


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
