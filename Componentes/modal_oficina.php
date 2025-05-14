<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formulario">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="id_piso" name="id_piso">
                            <option value="null" selected>Seleccione un Piso</option>
                        </select>
                        <label for="id_piso">Piso</label>
                        <span id="sid_piso" class="invalid-feedback"></span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la Oficina">
                        <label for="nombre">Nombre de la Oficina</label>
                        <span id="snombre" class="invalid-feedback"></span>
                    </div>
                    <input type="hidden" id="id_oficina" name="id_oficina">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="enviar"></button>
            </div>
        </div>
    </div>
</div>
