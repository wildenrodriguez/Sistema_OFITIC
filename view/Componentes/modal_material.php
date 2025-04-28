<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true"
  data-bs-backdrop="static">
  <div class="modal-dialog modal-lg dialog-scrollable" role="document">
    <div class="modal-content card">
      <div class="modal-header card-header">
        <h5 class="modal-title" id="modalTitleId"></h5>
        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="material" class="form-label">Nombre del Material</label>
          <input placeholder="Nombre del Material" class="form-control" name="material" type="text"
            id="material" maxlength="45">
          <span id="smaterial"></span>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id="enviar" name="enviar" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>