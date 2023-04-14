<div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="agregarProductoPagadoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar producto </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <label class="sr-only" for="inlineFormInputName2">Especifica tipo de producto</label>
            <input type="text" wire:model="tipoProducto" class="form-control mb-2 mr-sm-2" placeholder="Tipo de producto">

            <button  wire:click="save()" type="submit" class="btn btn-primary mb-2">Submit</button>


          </div>

          </div>
        </div>
      </div>
    </div>


</div>
