<div class="modal modal-lg fade" id="crear_usuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="FallaLabel" aria-hidden="true">
  <form method="post" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="FallaLabel">Crear Nuevo Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body gap-3 row">
       <div class="col-sm-6">
          <label class="input-label" for="cedula" class="form-label">Cedula del empleado</label>
            <select class="form-control my-3" id="cedula" name="cedula"  required>
            <option selected hidden value="">Seleccionar</option>
              <?php foreach ($cedulas as $cedula) {
                echo "<option value='$cedula[cedula]'>$cedula[cedula] - $cedula[nombre]</option>";
              } ?>
              
            </select>
        </div>
        <div class="col-sm">
        <label for="rol" class="form-label">Rol</label>
        <select name="rol" id="rol" class="form-select" required>
          <option selected hidden value="">Seleccionar</option>
          <option value="Super usuario">Super usuario</option>
          <option value="Técnico">Técnico</option>
          <option value="Administrador">Administrador</option>
          <option value="Usuario">Usuario</option>
        </select>
      </div>

      <div class="col-sm">
        <label for="tipo" class="form-label">Tipo de Técnico</label>
        <select class="col-sm-3 form-control" placeholder="Describa el servicio solicitado" name="tipo" id="tipo" required>
              <option selected value="1">Soporte técnico</option>
              <option value="4">Electrónica</option>
              <option value="2">Redes</option>
              <option value="3">telefonía</option>
            </select>
          </div>

      </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button class="btn btn-primary" name="registrar_usuario" type="submit">Crear Usuario</button>
        
      </div>
    </div>
  </form>
</div>
