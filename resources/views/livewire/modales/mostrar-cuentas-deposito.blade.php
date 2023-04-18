<div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="CuentasDeposito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cuentas de deposito </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" wire:click="toggle()"   class="btn btn-secondary btn-sm">Ver datos de la cuenta  {{ $moneda }}</button>

              </div>
              <div class="border border-dotted p-3 bg-light">
                <!-- Contenido del div -->

                <img src="{{ $currentImage }}" class="image-transition">

              </div>


          </div>

          </div>
        </div>
      </div>
    </div>

</div>
