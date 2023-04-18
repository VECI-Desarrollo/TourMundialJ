<div>

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <h2 class="text-center">Registro de <b>pagos</b></h2>
                        </div>
                        <div class="col-sm-4">
                            <div class="search-box">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                                    <input type="text" class="form-control" placeholder="Search&hellip;" wire:model="search">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @livewire('navigation-bar')
                {{--  <button type="button"  class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarVendedor">
                    Agregar Vendedor
                   </button>
                   <button type="button"  class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarTipoPagoModal">
                    Agregar Tipo de pago
                   </button>
                   <button type="button"  class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarProductoPagadoModal">
                    Agregar producto
                   </button>  --}}
                <table class="table table-bordered table-auto">
                    <thead>
                        <tr>
                            <th scope="col">Agencia</th>
                            <th scope="col" class="w-auto">Vendedor</th>
                            <th scope="col" class="w-auto">Expediente</th>
                            <th scope="col" class="w-auto"> Tipo de Pago</th>
                            <th scope="col" class="w-auto">Monto</th>
                            <th scope="col" class="w-auto">Archivo</th>
                            <th scope="col" class="w-auto">Tipo de Producto</th>
                            <th scope="col" class="w-auto">Moneda</th>
                            <th scope="col" class="w-auto">Fecha de Depósito</th>
                            <th scope="col" class="w-auto" >Id </th>
                            {{--  <th>Actions</th>  --}}
                        </tr>
                    </thead>
                    <tbody>
                 @foreach ($registros as $registro)
              <tr>
                <td scope="col" class="w-auto">{{ $registro->agenciaNombre }}</td>
                <td scope="col" class="w-auto">{{ $registro->vendedor }}</td>
                <td scope="col" class="w-auto">{{ $registro->expediente }}</td>
                <td scope="col" class="w-auto">{{ $registro->tiposPagos_id }}</td>
                <td scope="col" class="w-auto">${{  number_format($registro->monto,2) }}</td>
                <td scope="col" class="w-auto">
                    @if(substr( $registro->comprobante, -3)  == 'pdf' )
                    <a href="archivos/pdf/{{ $registro->comprobante }}" target="_blank" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a></td>
                    @else
                    <a href="archivos/img/{{ $registro->comprobante }}" target="_blank" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a></td>
                    @endif
                <td scope="col" class="w-auto">{{ $registro->tiposProductos_id }}</td>
                <td scope="col" class="w-auto">{{ $registro->moneda }}</td>
                <td scope="col" class="w-auto">{{ \Carbon\Carbon::parse($registro->fechaDeposito)->format('d/m/Y') }}  </td>
                <td scope="col" class="w-auto"><small>{{ $registro->id }}</small></td>
                {{--  <td>  --}}
                    {{--  <a href="#" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                    <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                    <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>  --}}
                {{--  </td>  --}}
              </tr>
              @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <div>
                        Mostrando {{ $registros->firstItem() }} - {{ $registros->lastItem() }} de {{ $registros->total() }} registros
                    </div>
                    <div>
                        {{ $registros->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>



{{--

    <div class="text-center mt-10">
        <div class="row mt-5">
            <div class="col-sm-4">
                <button type="button"  class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#agregarVendedor">
                   Agregar Vendedor
                  </button>
            </div>
            <div class="col-sm-4">
                <button type="button"  class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#agregarTipoPagoModal">
                   Agregar Tipo de pago
                  </button>
            </div>
            <div class="col-sm-4">
                <button type="button"  class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#agregarProductoPagadoModal">
                   Agregar producto
                  </button>
            </div>
          </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Buscar" wire:model="search">
        </div>

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Agencia</th>
                <th>Expediente</th>
                <th>Tipo de Pago</th>
                <th>Monto</th>
                <th>Comprobante</th>
                <th>Tipo de Producto</th>
                <th>Moneda</th>
                <th>Fecha de Depósito</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($registros as $registro)
              <tr>
                <td>{{ $registro->agenciaNombre }}</td>
                <td>{{ $registro->expediente }}</td>
                <td>{{ $registro->tiposPagos_id }}</td>
                <td>${{ $registro->monto }}</td>
                <td>{{ $registro->comprobante }}</td>
                <td>{{ $registro->tiposProductos_id }}</td>
                <td>{{ $registro->moneda }}</td>
                <td>{{ $registro->fechaDeposito }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="mt-4">
          {{ $registros->links() }}
        </div>


    </div>  --}}








</div>
