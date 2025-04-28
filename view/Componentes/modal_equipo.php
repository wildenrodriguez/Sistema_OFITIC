<div class="modal fade" id="modal-equipo" tabindex="-1" aria-labelledby="modal-equipo-label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-equipo-label">Registrar Nuevo Equipo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="form-equipo" autocomplete="off">
        <div class="modal-body">
          <input type="hidden" id="id-equipo" name="id">

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="serial" class="form-label">Serial *</label>
              <input type="text" class="form-control" id="serial" name="serial" required>
              <div class="invalid-feedback" id="error-serial"></div>
            </div>
            <div class="col-md-6">
              <label for="tipo" class="form-label">Tipo *</label>
              <input type="text" class="form-control" id="tipo" name="tipo" required>
              <div class="invalid-feedback" id="error-tipo"></div>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="marca" class="form-label">Marca *</label>
              <select class="form-select" id="marca" name="marca" required>
                <option value="" selected disabled>Seleccione una marca</option>
                <?php foreach ($marcas as $marca): ?>
                  <option value="<?= $marca['codigo'] ?>"><?= $marca['nombre'] ?></option>
                <?php endforeach; ?>
              </select>
              <div class="invalid-feedback" id="error-marca"></div>
            </div>
            <div class="col-md-6">
              <label for="dependencia" class="form-label">Dependencia *</label>
              <select class="form-select" id="dependencia" name="dependencia" required>
                <option value="" selected disabled>Seleccione una dependencia</option>
                <?php foreach ($dependencias as $dependencia): ?>
                  <option value="<?= $dependencia['codigo'] ?>"><?= $dependencia['nombre'] ?></option>
                <?php endforeach; ?>
              </select>
              <div class="invalid-feedback" id="error-dependencia"></div>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="nro-bien" class="form-label">Número de Bien</label>
              <select class="form-select" id="nro-bien" name="nro_bien">
                <option value="" selected>Vincular a bien</option>
                <?php foreach ($bienes as $bien): ?>
                  <option value="<?= $bien['codigo_bien'] ?>"
                    <?= (isset($equipo->nro_bien) && $equipo->nro_bien == $bien['codigo_bien'] ? 'selected' : '') ?>>
                    <?= $bien['codigo_bien'] ?> - <?= $bien['tipo_bien'] ?>
                  </option>
                <?php endforeach; ?>
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