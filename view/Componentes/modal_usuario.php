<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true"
  data-bs-backdrop="static">
  <div class="modal-dialog modal-lg dialog-scrollable" role="document">
    <div class="modal-content card">
      <div class="modal-header card-header">
        <h5 class="modal-title" id="modalTitleId"></h5>
        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center" id="Fila1">
          <div class="col-md-6">
            <div class="form-floating mb-3">
              <input placeholder="Cédula de Identidad" class="form-control" name="nombre_usuario" type="text"
                id="nombre_usuario" maxlength="45">
              <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
              <span id="snombre_usuario"></span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating mb-3">
              <input placeholder="Cédula de Identidad" class="form-control" name="cedula" type="text" id="cedula"
                maxlength="45">
              <label for="cedula" class="form-label">Cédula de Identidad</label>
              <span id="scedula"></span>
            </div>
          </div>
        </div>
        <div class="row justify-content-center" id="Fila2">
          <div class="col-md-6">
            <div class="form-floating mb-3">
              <input placeholder="Nombre" class="form-control" name="nombre" type="text" id="nombre" maxlength="45">
              <label for="nombre" class="form-label">Nombre</label>
              <span id="snombre"></span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating mb-3">
              <input placeholder="Apellido" class="form-control" name="apellido" type="text" id="apellido"
                maxlength="45">
              <label for="apellido" class="form-label">Apellido</label>
              <span id="sapellido"></span>
            </div>
          </div>
        </div>
        <div class="row justify-content-center" id="Fila3">
          <div class="col-md-6">
            <div class="form-floating mb-3">
              <input placeholder="Teléfono" class="form-control" name="telefono" type="text" id="telefono"
                maxlength="15">
              <label for="telefono" class="form-label">Teléfono</label>
              <span id="stelefono"></span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating mb-3">
              <input placeholder="Correo" class="form-control" name="correo" type="email" id="correo" maxlength="45">
              <label for="correo" class="form-label">Correo Electrónico</label>
              <span id="scorreo"></span>
            </div>
          </div>
        </div>
        <div class="row justify-content-center" id="Fila4">
          <div class="col-md-6">
            <div class="form-floating mb-3">
              <input placeholder="Contraseña" class="form-control" name="clave" type="password" id="clave"
                maxlength="15">
              <label for="clave" class="form-label">Contraseña</label>
              <span id="sclave"></span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating mb-3">
              <input placeholder="Repita Contraseña" class="form-control" name="rclave" type="password" id="rclave" maxlength="45">
              <label for="rclave" class="form-label">Repita la Contraseña</label>
              <span id="srclave"></span>
            </div>
          </div>
        </div>
        <div class="row justify-content-center" id="Fila5">
          <div class="col-md-8">
            <div class="form-floating mb-3">
              <select class="form-select" name="rol" id="rol">
                <option selected value="default">Seleccione un Rol</option>
              </select>
              <span id="srol"></span>
              <label for="rol">Rol</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id="enviar" name="enviar" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>