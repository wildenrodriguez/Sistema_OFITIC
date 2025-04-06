<div class="modal modal-lg fade" id="crear_usuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="FallaLabel" aria-hidden="true">
  <form method="post" class="modal-dialog" autocomplete="off">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="FallaLabel">Registrar Solicitante</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body gap-3">

        <div class="row mx-3">
          <div class="col-sm">
            <label for="nombre" class="form-label">Nombres</label>
            <input type="text" name="nombre" class="form-control" id="nombre" required maxlength="50">
            <div class="invalid-feedback">Ingresa un nombre!</div>
            <span id="snombre"></span>
          </div>
          <div class="col-sm">
            <label for="apellido" class="form-label">Apellidos</label>
            <input type="text" name="apellido" class="form-control" id="apellido" required maxlength="50">
              <divclass="invalid-feedback"></div>
              <span id="sapellido"></span>
          </div>
        </div>

        <div class="row mx-3">
         <div class="col-sm">
            <label for="cedula" class="form-label">Cedula</label>
              <input type="text" class="form-control" aria-describedby="basic-addon3" name="cedula" id="cedula" value="V-" maxlength="12" text-transform="uppercase">
              <span id="scedula"></span>
              
            
          </div>
          <div class="col-sm">
          <label for="unidad" class="form-label">Unidad</label>
          <select name="unidad" class="form-select" required>
            <option selected hidden value="">Seleccionar</option>
            <?php foreach ($unidades as $unidad) { ?>
              <option value="<?php echo $unidad['codigo']; ?>"><?php echo $unidad['nombre']; ?></option>
           <?php } ?>
          </select>
          <div class="invalid-feedback">Selecciona una Unidad!</div>
        </div>

        <div class="col-sm">
          <label for="dependencia" class="form-label">Dependencia</label>
          <select name="dependencia" class="form-select" id="dependencia" required>
            <option selected hidden value="">Seleccionar</option>
            <?php foreach ($dependencias as $dependencia) { ?>
              <option value="<?php echo $dependencia['codigo']; ?>"><?php echo $dependencia['nombre']; ?></option>
           <?php } ?>
          </select>
          <div class="invalid-feedback">Selecciona una condición!</div>
        </div>
        </div>

        <div class="row mx-3">
          <div class="col-sm-5">
            <label for="text" class="form-label">Número de Teléfono</label>
            <div class="input-group" id="number">
              
              <input type="text" class="form-control" aria-describedby="basic-addon3" name="telefono" min="0" id="telefono" maxlength="15">
              <div class="invalid-feedback">Ingresa un numero de teléfono!</div>
              <span id="stelefono"></span>
            </div>
          </div>
          <div class="col-sm">
            <label for="Email" class="form-label">Correo</label>
            <input type="text" name="correo" class="form-control" id="correo" required maxlength="100">
            <div class="invalid-feedback">Ingresa un correo valido!</div>
            <span id="scorreo"></span>
          </div>
        </div>

      <div class="modal-footer mt-3">

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button class="btn btn-primary registrar" type="submit" name="registrar_solicitante">Registrar Solicitante</button>
        
      </div>
    </div>
  </form>
</div>
