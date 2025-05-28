<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true"
  data-bs-backdrop="static">
  <div class="modal-dialog modal-lg dialog-scrollable" role="document">
    <div class="modal-content card">
      <div class="modal-header card-header">
        <h5 class="modal-title" id="modalTitleId"></h5>
        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center" id="Fila1"></div>
        <div class="row justify-content-center">
          <div class="col-6">
            <div class="form-floating mb-3">
              <select class="form-select" name="codigo_bien" id="codigo_bien">
                <option selected value="default" disabled>Seleccione un Código de Bien</option>
                <?php foreach ($bien as $bien): ?>
                  <option value="<?= $bien['codigo_bien'] ?>">
                    <?= $bien['codigo_bien'] . " - " .  $bien['descripcion'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <span id="scodigo_bien"></span>
              <label for="codigo_bien">Código de Bien</label>
            </div>
          </div>
          <div class="col-5">
            <div class="form-floating mb-3">
              <input placeholder="" class="form-control" name="serial_switch" type="text" id="serial_switch">
              <span id="sserial_switch"></span>
              <label for="serial_switch" class="form-label">Serial del Switch</label>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-floating mb-3">
              <input placeholder="" class="form-control" name="cantidad_puertos" type="number" id="cantidad_puertos">
              <span id="scantidad_puertos"></span>
              <label for="cantidad_puertos" class="form-label">Cantidad de Puertos</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id="enviar" name="" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>