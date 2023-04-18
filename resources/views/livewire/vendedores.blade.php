<div>

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <x-slot name="active"> active  </x-slot>
                        <div class="col-sm-4">
                            <h2 class="text-center">Registro de <b>vendedores</b></h2>
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
                <button type="button"  class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarVendedor">
                    Agregar Vendedor
                   </button>
                   @livewire('navigation-bar')


                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre del vendedor</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                 @foreach ($registros as $registro)
              <tr>
                <td>{{ $registro->nombre }}</td>
                <td>{{ $registro->apellido }}</td>
                <td>{{ $registro->email }}</td>

                <td>
                    <a href="#" class="edit" title="Edit" data-toggle="tooltip"    data-bs-toggle="modal" data-bs-target="#editarVendedor{{ $registro->id }}"  ><i class="material-icons">&#xE254;</i></a>
                    <a href="#" class="delete" onclick="confirm('¿Seguro que quieres eliminar?') || event.stopImmediatePropagation()"   wire:click="delete('{{$registro->id }}')"  title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>

                </td>
              </tr>
              <livewire:modales.edit-vendedor :edit="$registro" :wire:key="$registro->id" />
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


    <livewire:modales.agregar-vendedor-modal/>





</div>
