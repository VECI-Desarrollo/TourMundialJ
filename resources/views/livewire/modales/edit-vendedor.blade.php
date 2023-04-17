<div>

    <div wire:ignore.self class="modal fade" id="editarVendedor{{ $edit->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar correo adjunto </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Aquí puedes agregar los campos que quieres editar -->
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" wire:model.defer="edit.nombre">
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" wire:model.defer="edit.apellido">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" wire:model.defer="edit.email">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" wire:click="editSave()">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

</div>
