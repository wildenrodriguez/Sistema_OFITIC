<div class="modal modal-lg fade" id="m_equipo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="equipoLabel" aria-hidden="true">
  <form method="post" class="modal-dialog" autocomplete="off">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="equipoLabel">Registrar Equipo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body gap-3">

        <div class="row">
          <div class="col-sm">
            <label for="serial" class="form-label">Serial</label>
            <input type="text" name="serial" class="form-control" id="serial" required maxlength="50">
            <div class="invalid-feedback">Ingrese un Serial!</div>
            <span id="sserial"></span>
          </div>
          <div class="col-sm">
            <label for="nro_bien" class="form-label">Numero de Bien</label>
            <input type="text" name="nro_bien" class="form-control" id="nro_bien" required maxlength="20">
            <div class="invalid-feedback">Ingrese un Numero de Bien!</div>
            <span id="snro_bien"></span>
          </div>
        </div>

        <div class="row">
          <div class="col-sm">
            <label for="marca" class="form-label">Marca</label>
            <select name="marca" class="form-control" id="marca" required>
              <option hidden selected>Seleccionar</option>
              <?php 
                if (isset($marcas)) {

                  foreach ($marcas as $marca) { ?>
                    <option value="<?php echo $marca['codigo'] ?>"><?php echo $marca['nombre'] ?></option>
              <?php 
                  }
                }
               ?>
            </select>
            <div class="invalid-feedback">Elija una Marca!</div>
            <span id="smarca"></span>
          </div>

          <div class="col-sm">
            <label for="dependencia" class="form-label">Dependencia a la que pertenece</label>
            <select name="dependencia" class="form-control" id="dependencia" required>
              <option hidden selected>Seleccionar</option>
              <?php 
                if (isset($dependencias)) {

                  foreach ($dependencias as $dependencia) { ?>
                    <option value="<?php echo $dependencia['codigo'] ?>"><?php echo $dependencia['nombre'] ?></option>
              <?php 
                  }
                }
               ?>
            </select>
            <div class="invalid-feedback">Elija una Dependencia!</div>
            <span id="sdependencia"></span>
          </div>
        </div>

        <div class="row">
          <div class="col-sm">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" name="tipo" class="form-control" id="tipo" required maxlength="50">
            <div class="invalid-feedback">Ingrese un Tipo de Equipo!</div>
            <span id="stipo"></span>
          </div>
        </div>

    </div>
    <div class="modal-footer mt-2">

        <button type="button" class="btn btn-primary registrar" id="btn_modal_equipo" name="registrar">Registrar Equipo</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    </div>
  </form>
</div>
