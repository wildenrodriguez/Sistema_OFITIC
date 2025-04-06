<!-- Modal -->
<div class="modal fade modal-xl" id="mostra" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mostra" aria-hidden="true">
      <form method="post" class="modal-dialog" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="FallaLabel">Crear Solicitud</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" >

          <div class="row">
            
            <div class="col-8">
              <label for="falla" class="form-label">Motivo</label>
              <input class="form-control" placeholder="Describa el servicio solicitado" class="form-control" name="motivo" type="text" id="falla" required maxlength="200">
              <span id="sfalla"></span>
            </div>

            <div class="col-4">
              <label for="area" class="form-label">Tipo de servicio</label>
              <select class="col-sm-3 form-control" placeholder="Describa el servicio solicitado" name="area" id="area" required>
                <option selecte hidden value="">Seleccione una opcion</option>
                <option value="1">Soporte técnico</option>
                <option value="4">Electrónica</option>
                <option value="2">Redes</option>
                <option value="3">telefonía</option>
              </select>
            </div>
            </div>

  <div class="row">

  <div class="col-12">
          <label for="dependencia" class="form-label">Dependencia</label>
          <select name="dependencia" class="form-select" id="dependencia">
            <option selected hidden value="0">Seleccionar</option>
            <?php foreach ($dependencias as $dependencia) { ?>
              <option value="<?php echo $dependencia['codigo']; ?>"><?php echo $dependencia['nombre']; ?></option>
           <?php } ?>
          </select>
          <div class="invalid-feedback">Selecciona una condición!</div>
        </div>

      <div class="col-sm-6">
                  <label class="input-label" for="cedula" class="form-label">Cedula del solicitante</label>
                    <select class="form-control my-3" id="solicitante" name="cedula" required>
                    <option selected hidden value="">Seleccionar</option>
                      <?php foreach ($cedulas as $cedula) {
                        echo "<option value='".$cedula["cedula"]."'>".$cedula["cedula"]."</option>";
                      } ?>
                      
                    </select>
                </div>
    
                <div class="col-sm-6">
                  <label class="input-label" for="serial" class="form-label">Serial del equipo</label>
                  <select class="form-control my-3" id="equipo" name="serial">
                  <option selected>Seleccionar</option>
                      <?php foreach ($equipos as $equipo) {
                        echo "<option value='".$equipo["serial"]."'>".$equipo["serial"]."</option>";
                      } ?>
                      
                    </select>
                </div>
            </div>
              
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="solicitar" class="btn btn-primary" id="enviar">Enviar</button>
          </div>
        </div>
      </form>
    </div>

    