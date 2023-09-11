<div>
  

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="agregarTipoMonedaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Tipo de moneda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @error('moneda') <span class="text-red-500">{{ $message }}</span> @enderror
            <label class="sr-only" for="inlineFormInputName2">Especifica tipo de moneda</label>
            <input type="text" wire:model="moneda" class="form-control mb-2 mr-sm-2" placeholder="Tipo de pago">
           
        <br>
            <button  wire:click="save()" type="submit" class="btn btn-primary mb-2">Guardar</button>
          </div>

          </div>
        </div>
      </div>
    </div>


    <script>

        window.addEventListener('successfully', event => {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Se guardo tipo de pago',
                showConfirmButton: false,
                timer: 3000
              })
        });

    </script>




</div>
