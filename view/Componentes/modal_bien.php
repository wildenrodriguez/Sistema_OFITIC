<div class="modal fade" id="modal-bien" tabindex="-1" aria-labelledby="modal-bien-label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-bien-label">Registrar Nuevo Bien</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="form-bien" autocomplete="off">
        <div class="modal-body">
          <input type="hidden" id="codigo-bien" name="codigo_bien">

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="tipo-bien" class="form-label">Tipo de Bien *</label>
              <input type="text" class="form-control" id="tipo-bien" name="tipo_bien" required>
            </div>
            <div class="col-md-6">
              <label for="estado" class="form-label">Estado *</label>
              <input type="text" class="form-control" id="estado" name="estado" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="ci-responsable" class="form-label">Responsable</label>
              <input type="text" class="form-control" id="ci-responsable" name="ci_responsable">
            </div>
            <div class="col-md-6">
              <label for="id-oficina" class="form-label">Oficina</label>
              <select class="form-select" id="id-oficina" name="id_oficina">
                <option value="" selected disabled>Seleccione una oficina</option>
                <?php foreach ($oficinas as $oficina): ?>
                  <option value="<?= $oficina['id_oficiona'] ?>"><?= $oficina['nombre'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="estatus" class="form-label">Estatus *</label>
              <select class="form-select" id="estatus" name="estatus" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" id="btn-guardar">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
