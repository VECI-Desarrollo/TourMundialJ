<div style="margin-top:70px;">

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <h2 class="text-center">Tipos de <b>pagos</b></h2>
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
                <button type="button"  class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarTipoPagoModal">
                    Agregar Tipo de pago
                   </button>


                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tipo de pago</th>
                            <th>Moneda Asociada</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                 @foreach ($registros as $registro)
              <tr>
                <td>{{ $registro->tipoPago }}</td>
                <td>{{ $registro->moneda }}</td>
                <td>    <a href="#" class="delete" onclick="confirm('¿Seguro que quieres eliminar?') || event.stopImmediatePropagation()"   wire:click="delete('{{$registro->id }}')"  title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a> </td>
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

    <livewire:modales.agregar-tipo-pago-modal/>

</div>
