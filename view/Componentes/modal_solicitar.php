 <!-- Modal -->
  <div class="modal fade" id="Falla" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="FallaLabel" aria-hidden="true">
    <form method="post" class="modal-dialog" autocomplete="off">
      <div class="modal-content card">
        <div class="modal-header card-header">
          <h1 class="modal-title fs-5" id="FallaLabel">Crear Solicitud</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" >
          <div class="mb-3">
            <label for="falla" class="form-label">Solicitud</label>
            <input placeholder="Describa el servicio solicitado" class="form-control" name="motivo" type="text" id="falla" maxlength="200">
            <span id="sfalla"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="solicitar" name="solicitud" class="btn btn-primary registrar">Enviar</button>
        </div>
      </div>
    </form>
  </div>