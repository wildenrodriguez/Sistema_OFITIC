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
                    <div class="col-4">
                        <div class="form-floating mb-3 mt-4">
                            <input placeholder="" class="form-control" name="codigo_bien" type="text" id="codigo_bien">
                            <span id="scodigo_bien"></span>
                            <label for="codigo_bien" class="form-label">Código del Bien</label>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-floating mb-3 mt-4">
                            <input placeholder="" class="form-control" name="descripcion" type="text" id="descripcion" maxlength="100">
                            <span id="sdescripcion"></span>
                            <label for="descripcion" class="form-label">Descripción</label>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="form-floating mb-3 mt-4">
                            <select class="form-select" name="id_tipo_bien" id="id_tipo_bien">
                                <option value="">Seleccione un tipo</option>
                                <?php foreach ($tipos_bien as $tipo): ?>
                                    <option value="<?= $tipo['id_tipo_bien'] ?>">
                                        <?= $tipo['nombre_tipo_bien'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span id="sid_tipo_bien"></span>
                            <label for="id_tipo_bien" class="form-label">Tipo de Bien</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3 mt-4">
                            <select class="form-select" name="id_marca" id="id_marca">
                                <option value="">Seleccione una marca</option>
                                <?php foreach ($marcas as $marca): ?>
                                    <option value="<?= $marca['id_marca'] ?>">
                                        <?= $marca['nombre_marca'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span id="sid_marca"></span>
                            <label for="id_marca" class="form-label">Marca</label>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="form-floating mb-3 mt-4">
                            <select class="form-select" name="estado" id="estado">
                                <option value="">Seleccione un estado</option>
                                <option value="Nuevo">Nuevo</option>
                                <option value="Usado">Usado</option>
                                <option value="Dañado">Dañado</option>
                                <option value="En Reparación">En Reparación</option>
                                <option value="Obsoleto">Obsoleto</option>
                            </select>
                            <span id="sestado"></span>
                            <label for="estado" class="form-label">Estado</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3 mt-4">
                            <select class="form-select" name="id_oficina" id="id_oficina">
                                <option value="">Seleccione una oficina</option>
                                <?php foreach ($oficinas as $oficina): ?>
                                    <option value="<?= $oficina['id_oficina'] ?>">
                                        <?= $oficina['nombre_oficina'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span id="sid_oficina"></span>
                            <label for="id_oficina" class="form-label">Oficina</label>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="form-floating mb-3 mt-4">
                            <select class="form-select" name="cedula_empleado" id="cedula_empleado">
                                <option value="">Seleccione un empleado</option>
                                <?php foreach ($empleados as $empleado): ?>
                                    <option value="<?= $empleado['cedula_empleado'] ?>">
                                        <?= $empleado['nombre_completo'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span id="scedula_empleado"></span>
                            <label for="cedula_empleado" class="form-label">Empleado Asignado</label>
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