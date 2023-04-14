<div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="agregarVendedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Vendedor </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

         {{-- --------------seccion para  agregar alos vendedores --}}


            {{-- ------------------------Nombre --}}
            <label class="sr-only" for="inlineFormInputName2">Nombre</label>
            @error('nombre') <span class="text-red-500">{{ $message }}</span> @enderror
            <input type="text" wire:model.defer="nombre" class="form-control mb-2 mr-sm-2" placeholder="Ingresa Nombre"><br>

            {{-- ----------------------- Apellido- --}}
            <label class="sr-only" for="inlineFormInputName2">Apellido</label> @error('apellido') <span class="text-red-500">{{ $message }}</span> @enderror
            <input type="text" wire:model.defer="apellido" class="form-control mb-2 mr-sm-2" placeholder="Ingresa Apellido">

             {{-- ------------------------Email --}}
            <label class="sr-only" for="inlineFormInputGroupUsername2">E-mail</label>
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text">@</div>
              </div>
              <input  wire:model.defer="email" type="text" class="form-control"  placeholder="Email">

            </div>


            <button  wire:click="save()" class="btn btn-primary mb-2">Guardar</button>
            {{-- ----------------mensaje de  ingreso correcto --}}

{{--
                <div x-on:name-updated.window="showAlert = true" class="alert alert-success" role="alert">
                  This is a success alert—check it out!
                </div>  --}}


          </div> <!-- /.modal-body -->

          </div>
        </div>
      </div>






</div>
