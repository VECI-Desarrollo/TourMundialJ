<div>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
                                    <input type="text" class="form-control" placeholder="Search&hellip;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button"  class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarVendedor">
                    Agregar Vendedor
                   </button>
                   <button type="button"  class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarTipoPagoModal">
                    Agregar Tipo de pago
                   </button>
                   <button type="button"  class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarProductoPagadoModal">
                    Agregar producto
                   </button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Agencia</th>
                            <th>Expediente</th>
                            <th>Tipo de Pago</th>
                            <th>Monto</th>
                            <th>Archivo</th>
                            <th>Tipo de Producto</th>
                            <th>Moneda</th>
                            <th>Fecha de Depósito</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                 @foreach ($registros as $registro)
              <tr>
                <td>{{ $registro->agenciaNombre }}</td>
                <td>{{ $registro->expediente }}</td>
                <td>{{ $registro->tiposPagos_id }}</td>
                <td>${{ $registro->monto }}</td>
                <td><a href="#" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a></td>
                <td>{{ $registro->tiposProductos_id }}</td>
                <td>{{ $registro->moneda }}</td>
                <td>{{ $registro->fechaDeposito }}</td>
                <td>
                    {{--  <a href="#" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                    <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                    <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>  --}}
                </td>
              </tr>
              @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#">Previous</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link">Next</a></li>
                    </ul>
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


    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }
        .table-responsive {
            margin: 30px 0;
        }
        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }
        .table-title {
            font-size: 15px;
            padding-bottom: 10px;
            margin: 0 0 10px;
            min-height: 45px;
        }
        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }
        .table-title select {
            border-color: #ddd;
            border-width: 0 0 1px 0;
            padding: 3px 10px 3px 5px;
            margin: 0 5px;
        }
        .table-title .show-entries {
            margin-top: 7px;
        }
        .search-box {
            position: relative;
            float: right;
        }
        .search-box .input-group {
            min-width: 200px;
            position: absolute;
            right: 0;
        }
        .search-box .input-group-addon, .search-box input {
            border-color: #ddd;
            border-radius: 0;
        }
        .search-box .input-group-addon {
            border: none;
            border: none;
            background: transparent;
            position: absolute;
            z-index: 9;
        }
        .search-box input {
            height: 34px;
            padding-left: 28px;
            box-shadow: none !important;
            border-width: 0 0 1px 0;
        }
        .search-box input:focus {
            border-color: #3FBAE4;
        }
        .search-box i {
            color: #a0a5b1;
            font-size: 19px;
            position: relative;
            top: 8px;
        }
        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
        }
        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }
        table.table td:last-child {
            width: 130px;
        }
        table.table td a {
            color: #a0a5b1;
            display: inline-block;
            margin: 0 5px;
        }
        table.table td a.view {
            color: #03A9F4;
        }
        table.table td a.edit {
            color: #FFC107;
        }
        table.table td a.delete {
            color: #E34724;
        }
        table.table td i {
            font-size: 19px;
        }
        .pagination {
            float: right;
            margin: 0 0 5px;
        }
        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            padding: 0 10px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 30px !important;
            text-align: center;
        }
        .pagination li a:hover {
            color: #666;
        }
        .pagination li.active a {
            background: #03A9F4;
        }
        .pagination li.active a:hover {
            background: #0397d6;
        }
        .pagination li.disabled i {
            color: #ccc;
        }
        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }
        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }
        </style>


<livewire:modales.agregar-producto-pagado-modal/>
<livewire:modales.agregar-tipo-pago-modal/>
<livewire:modales.agregar-vendedor-modal/>


</div>
