<div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="InfoRegistro" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Información adicional</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"><!-- modal-body -->

                    <div wire:loading>
                        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div> 
                     </div>
                <div wire:loading.remove>
                    @if ($query != null)
                        <!---Tipo de producto --->
                        <div class="col-sm-12">
                            <label for="agency" class="form-label">Tipo de producto</label>
                            <input type="text" wire:model="query.tiposProductos_id" class="form-control"
                                placeholder="Nombre del Agente de viajes" readonly>


                        </div>
                        <!---Moneda --->
                        <div class="col-sm-12">
                            <label for="agency" class="form-label">Moneda</label>
                            <input type="text" wire:model="query.moneda" class="form-control" placeholder="Moneda"
                                readonly>


                        </div>

                        <!---Banco --->
                        <hr>
                        <div class="col-sm-12">
                            <label for="agency" class="form-label">Banco</label>
                            @if($query->banco == Null)
                                <i class='bx bxs-x-circle' style="font-size: 16pt; color: rgb(155, 57, 57);" title="No aplica"></i>
                              @else
                              <input type="text" wire:model="query.banco" class="form-control" placeholder="Banco"
                                readonly>
                                @endif

                        </div>
                        <hr>

                        <!---Cometarios--->
                        <div class="comentarios">
                            <label for="agency" class="form-label">Comentarios</label>
                            <div  style="display: flex; flex-direction: column; align-items: center;">
                                <h6>Área de Finanzas</h6>
                                <textarea   wire:model.defer="query.comentario_finanzas" name="textarea" cols="50" 
                                {{ (auth()->user()->rol == 'finanzas') ?  : 'readonly' ;}} >Escribe tus comentarios</textarea>
                            </div><br>
                            <div style="display: flex; flex-direction: column; align-items: center;">
                                <h6>General</h6>
                                <textarea  wire:model.defer="query.comentario_general" name="textarea"  cols="50" readonly>Escribe tus comentarios</textarea>
                            </div>
                              <br>
                             <button   {{ (auth()->user()->rol == 'finanzas') ?  : 'hidden' ;}}  wire:click="save" type="button" class="btn btn-secondary btn-sm" >
                                <span  >Guardar</span>
                                  
                              </button>
                        </div>

                        <!---Archivo--->
                        <hr>
                        <div class="comentarios">
                            <label for="agency" class="form-label">Archivo</label>
                            @if(substr($query->comprobante, -3) == 'pdf')
                            <a href="archivos/pdf/{{ $query->comprobante }}" target="_blank" class="view" title="Ver PDF"
                                data-toggle="tooltip"><i class='bx bxs-file-pdf' style="font-size: 16pt; color: rgb(214, 67, 67);" ></i>
                            </a>
                            @else
                            <a href="archivos/img/{{ $query->comprobante }}" target="_blank" class="view" title="Ver Imagen"
                                data-toggle="tooltip"><i class='bx bx-image-alt' style="font-size: 16pt;"></i>
                            </a>
                            @endif


                        </div>
                        <hr>


                        <!---Fecha de deposito--->
                        <div class="comentarios">
                            <label for="agency" class="form-label">Fecha de Deposito</label>
                            <input type="text" wire:model="query.fechaDeposito" class="form-control" placeholder="Fecha deposito"
                                readonly>


                        </div>

                        <!---Id--->
                        <div class="comentarios">
                            <label for="agency" class="form-label">Registro ID</label>
                            <input type="text" wire:model="query.id" class="form-control" placeholder="Registro Id"
                                readonly>


                        </div>
                    @endif
                 </div>

                </div> <!-- /.modal-body -->


            </div>
        </div>
    </div>



</div>
