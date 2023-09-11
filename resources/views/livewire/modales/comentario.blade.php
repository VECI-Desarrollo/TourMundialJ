<div>
   

    
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="comentarios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Comentarios </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
    <div class="modal-body" ><!-- modal-body -->

         {{-- --------------seccion para  agregar alos vendedores --}}
         <div wire:loading>
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div> 
         </div>
    <div wire:loading.remove>
         <div  style="display: flex; flex-direction: column; align-items: center;">
            <h6>Área de Finanzas</h6>
            <textarea   wire:model.defer="comentarios.comentario_finanzas" name="textarea" cols="50" 
            {{ (auth()->user()->rol == 'finanzas') ?  : 'readonly' ;}} >Escribe tus comentarios</textarea>
        </div><br>
        <div style="display: flex; flex-direction: column; align-items: center;">
            <h6>General</h6>
            <textarea  wire:model.defer="comentarios.comentario_general" name="textarea" rows="7" cols="50" readonly>Escribe tus comentarios</textarea>
        </div>
          <br>
         <button   {{ (auth()->user()->rol == 'finanzas') ?  : 'hidden' ;}}  wire:click="save" type="button" class="btn btn-secondary btn-sm" >
            <span  >Guardar</span>
              
          </button>
        
            </div><!--- fin del din wire loading remove -->
          

    </div> <!-- /.modal-body -->
         

          </div>
        </div>
      </div>









</div>
