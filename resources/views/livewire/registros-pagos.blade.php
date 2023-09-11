

<div  style="margin-top: 70px;">{{-----div main -----}}

    <!-- Navbar -->

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/css-toggle-switch@latest/dist/toggle-switch.css" />
   

    <!--Content -->

 <div class="container-xxl flex-grow-1 container-p-y">

    <!--  Datatable -->

    <div class="card">
        {{--  <h5 class="card-header">Responsive Datatable</h5>  --}}
        <div class="card-datatable table-responsive">


    <div class="container-xxl">
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
                                    <span class="input-group-addon"><i class='bx bx-search-alt-2'>&#xE8B6;</i></span>
                                    <input type="text" class="form-control" placeholder="Busca..&hellip;" wire:model="search">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--  <button type="button"  class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarVendedor">
                    Agregar Vendedor
                   </button>
                   <button type="button"  class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarTipoPagoModal">
                    Agregar Tipo de pago
                   </button>
                   <button type="button"  class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarProductoPagadoModal">
                    Agregar producto
                   </button>  --}}
                    <div style="background-color: #eaedeccd; width: 100%; padding: 10px; border-radius: 6px 6px 0px 0px "> 

                          {{-- -------------Filtro por vendedor solo admins --}}
                          @if(auth()->user()->rol == "admin" || auth()->user()->rol == "finanzas"  )
                          <label style="margin-right: 10px;">
                            <span> <i class='bx bxs-user'></i>Vendedor</span>
                            <select wire:model="filtroVendedor"
                              class="form-select " style="max-width: 150px;"
                            >
                            <option value="">--Todos--</option>
                            @foreach ($vendedores as $ven )
                            <option value="{{ $ven->id }}">{{ $ven->nombre. $ven->apellido }}</option>
                            @endforeach
                            </select>
                          </label>
                          @endif
                      {{-- -----------Filtro por mes --}}
                        <label style="margin-right: 10px;">
                            <span> <i class='bx bx-calendar' ></i>Mes</span>
                            <select wire:model="filtroMes" class="form-select" style="max-width: 150px;">
                                <option value="">--Todos--</option>
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </label>

                       {{-- -------------Filtro por estado --}}
                       <label style="margin-right: 10px;">
                            <span> <i class='bx bx-filter' ></i>Estado</span>
                            <select wire:model="filtroEstado"
                              class="form-select " style="max-width: 150px;"
                            >
                            <option value="">--Todos--</option>
                            <option value="rechazado">Rechazado</option>
                            <option value="en curso">En curso</option>
                            <option value="aceptado">Aceptado</option>
                            </select>
                          </label>
                             {{-- -------------Filtro por Moneda --}}
                       <label style="margin-right: 10px;">
                        <i class='bx bx-money' ></i>Moneda</span>
                        <select wire:model="filtroMoneda"
                          class="form-select " style="max-width: 150px;"
                        >
                        <option value="">--Todas--</option>
                        @foreach ($monedas as $moneda )
                        <option value="{{ $moneda->moneda }}">{{ $moneda->moneda }}</option>
                        @endforeach
                        </select>
                      </label>

                        {{-- -------------seccion informacion iconos --}}
                        <label  style="margin-right: 10px; border: 0px dotted #8e8d8d; padding: 15px;  align-items: center;">
                            <span>  Representación de los estados: </span>
                            <i class="bx bx-task-x me-1" style="color:#ff5b5c;" ></i>Rechazados</span> |
                            <i class="bx bx-time-five me-1" style="color:#fdac41;"></i>En curso</span> |
                            <i class="bx bx-check me-1 " style="color:#10b981;"></i>Aceptados</span>
                            
                          </label>

    




                    </div>    
                   <div x-data="{ isOpen: [], colors: ['rgba(255, 184, 178, 0.5)', 'rgba(178, 223, 219, 0.5)', 'rgba(187, 228, 255, 0.5)', 'rgba(239, 215, 255, 0.5)'] }">
                   <table class="table table-bordered table-auto">
                    <thead class="bg-light"  >
                        <tr>
                            <th scope="col" style="position: sticky; top: 0px;" > Agencia</th>
                            @if(auth()->user()->rol == "admin" || auth()->user()->rol == "finanzas"  )
                            <th scope="col" class="text-nowrap" style="text-align: center;">Vendedor <br> TM</th>
                            @endif
                            <th scope="col" class="text-nowrap" style="text-align: center;">Vendedor <br> AGV</th>
                            <th scope="col" class="text-nowrap">Expediente</th>
                            <th scope="col" class="text-nowrap">Tipo de Pago</th>
                            <th scope="col" class="text-nowrap">Monto


                            </th>
                            <th  scope="col" class="text-nowrap"> <span wire:loading.remove wire:target="changeEstate">Estado</span>
                                                                                                         {{-- Spinner --}}
                               
<div wire:loading wire:target="changeEstate">
    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>    
                            </th>
                            {{--  <th scope="col" class="text-nowrap">Tipo de Producto</th>
                            <th scope="col" class="text-nowrap">Moneda</th>
                            <th scope="col" class="text-nowrap">Banco</th>
                            <th scope="col" class="text-nowrap">Fecha de Depósito</th>
                            <th scope="col" class="text-nowrap">Id</th>  --}}
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach ($registros as $index => $registro)
                    
                        <tr >  
                            <td
                             scope="col" class="text-nowrap"> <i class='bx bx-area' wire:click="$emit('RecibirDatosInfo','{{ $registro->id }}')" data-bs-toggle="modal" data-bs-target="#InfoRegistro"></i>  <i class='bx bxs-plus-circle'   class="clickable-row" @click="isOpen[{{ $index }}] = !isOpen[{{ $index }}]" :style="{'background-color': isOpen[{{ $index }}] ? colors[{{ $index }} % colors.length] : 'transparent' }"  ></i> 
                              {{ $registro->agenciaNombre }}</td>
                              @if(auth()->user()->rol == "admin" || auth()->user()->rol == "finanzas"  )
                            <td scope="col" class="text-nowrap">{{ $registro->vendedor }}</td>
                            @endif
                            <td scope="col" class="text-nowrap">{{ $registro->agenteViajes }}</td>
                            <td scope="col" class="text-nowrap">{{ $registro->expediente }}</td>
                            <td scope="col" class="text-nowrap">{{ $registro->tiposPagos_id }}</td>
                            <td scope="col" class="text-nowrap">${{ number_format($registro->monto, 2) }}</td>
                            <td scope="col" class="text-nowrap">
                                @if(auth()->user()->rol == "admin" || auth()->user()->rol == "finanzas"  )
                                <fieldset >

                                    <div class="custom-switch">
                                        {{-- ---------[Rechazado]---------- --}}
                                        @if($registro->estado == "rechazado")
                                        <input checked id="rechazado{{ $registro->id }}"  type="radio" wire:click="changeEstate('{{$registro->id}}', 'rechazado')">
                                        @else
                                        <input  id="rechazado{{ $registro->id }}"  type="radio" wire:click="changeEstate('{{$registro->id}}', 'rechazado')">
                                        @endif
                                        <label for="rechazado{{ $registro->id }}"><i class="bx bx-task-x me-1" ></i></label>
                                        {{---------[en curso ]----------}}
                                        @if($registro->estado == "en curso")
                                        <input checked id="curso{{ $registro->id }}"  type="radio"  wire:click="changeEstate('{{ $registro->id}}','en curso') ">
                                        @else
                                        <input  id="curso{{ $registro->id }}"  type="radio" wire:click="changeEstate('{{ $registro->id}}', 'en curso') ">
                                        @endif
                                        <label for="curso{{ $registro->id }}"> <i class="bx bx-time-five me-1" ></i></label>

                                        {{-- -----[Aceptado]------- --}}
                                        @if($registro->estado == "aceptado")
                                        <input checked id="aceptado{{ $registro->id }}"  type="radio"  wire:click="changeEstate('{{$registro->id}}', 'aceptado')">
                                        @else
                                        <input id="aceptado{{ $registro->id }}"  type="radio" wire:click="changeEstate('{{$registro->id}}', 'aceptado')">
                                        @endif
                                        <label for="aceptado{{ $registro->id }}"> <i class="bx bx-check me-1 " ></i></label>
                                    </div>

                                            
                                            {{-- ----------------Seccion de comentarios----- --}}
                                  <i  wire:click="$emit('RecibirDatos','{{ $registro->id }}')" data-bs-toggle="modal" data-bs-target="#comentarios" class='bx bx-message-square-dots' style="font-size: 16pt;" title="Agregar Comentario"></i>

                                  
                                </fieldset>
                                    @endif

                                    @if(auth()->user()->rol == "vendedor")
                                    <div >
                                        {{-- ---------[Rechazado]---------- --}}
                                        @if($registro->estado == "rechazado")
                                        <i class="bx bx-task-x me-1 parpadea " style="color:#ff5b5c;" ></i>
                                        {{-- ---------[en curso]---------- --}}
                                        @elseif($registro->estado =="en curso")
                                        <i class="bx bx-time-five me-1 parpadea " style="color:#fdac41;"></i>
                                        {{-- ---------[acpetado]---------- --}}
                                        @elseif($registro->estado == "aceptado")
                                        <i class="bx bx-check me-1 parpadea " style="color:#10b981;"></i>
                                        @endif

                                        
                                    </div>
                                    @endif
                                    
                              

   
                         
                            </td>
                            {{--  <td scope="col" class="text-nowrap">{{ $registro->tiposProductos_id }}</td>
                            <td scope="col" class="text-nowrap">{{ $registro->moneda }}</td>
                            <td scope="col" class="text-nowrap">{{ $registro->banco }}</td>
                            <td scope="col" class="text-nowrap">{{ \Carbon\Carbon::parse($registro->fechaDeposito)->format('d/m/Y') }}
                            </td>
                            <td scope="col" class="text-nowrap"><small>{{ $registro->id }}</small></td>  --}}
                        </tr>
                        <tr x-show="isOpen[{{ $index }}]" class="extra-row" >
                            <td colspan="12">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                        <th scope="col" class="text-nowrap">Tipo de Producto</th>
                            <th scope="col" class="text-nowrap">Moneda</th>
                            <th scope="col" class="text-nowrap">Banco</th>
                            <th scope="col" class="text-nowrap">Comentarios</th>
                            <th scope="col" class="text-nowrap">Archivo</th>
                            <th scope="col" class="text-nowrap">Fecha de Depósito</th>
                            <th scope="col" class="text-nowrap">Registro Id</th>
                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                           <td scope="col" class="text-nowrap">{{ $registro->tiposProductos_id }}</td>
                            <td scope="col" class="text-nowrap">{{ $registro->moneda }}</td>
                            <td scope="col" class="text-nowrap">
                                @if($registro->banco == Null)
                                <i class='bx bxs-x-circle' style="font-size: 16pt; color: rgb(155, 57, 57);" title="No aplica"></i>
                              @else
                                {{ $registro->banco }}
                                @endif
                            </td>
                            {{-----------[ Comentarios ]--------------}}
                            <td>  
                                <i  wire:click="$emit('RecibirDatos','{{ $registro->id }}')" data-bs-toggle="modal" data-bs-target="#comentarios" class='bx bx-message-square-dots' style="font-size: 16pt;" title="Agregar Comentario"></i>
                                 
                            </td>
                            {{-----------[ Archivo ]--------------}}
                            <td scope="col" class="text-nowrap">
                                @if(substr($registro->comprobante, -3) == 'pdf')
                                <a href="archivos/pdf/{{ $registro->comprobante }}" target="_blank" class="view" title="Ver PDF"
                                    data-toggle="tooltip"><i class='bx bxs-file-pdf' style="font-size: 16pt; color: rgb(214, 67, 67);" ></i>
                                @else
                                <a href="archivos/img/{{ $registro->comprobante }}" target="_blank" class="view" title="Ver Imagen"
                                    data-toggle="tooltip"><i class='bx bx-image-alt' style="font-size: 16pt;"></i>
                                @endif
                            </td>
                            <td scope="col" class="text-nowrap">{{ \Carbon\Carbon::parse($registro->fechaDeposito)->format('d/m/Y') }}
                            </td>
                            <td scope="col" class="text-nowrap"><small>{{ $registro->id }}</small></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        

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


</div>
</div>

    <!--/  Datatable -->






 </div>

    <!--/ Content -->


    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" integrity="sha384-dgdz7mDEmS7J6aZ5onr15VVpZ2rN0EGTW27hj433+8EuR3LCZVVM/2uZBfn1Q6b8" crossorigin="anonymous"></script>


    <!-- Modales --->
<livewire:modales.comentario/>
<livewire:modales.info-registro/>

</div>{{-----/div main -----}}

