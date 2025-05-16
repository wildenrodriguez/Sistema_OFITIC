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
                            <input placeholder="" class="form-control" name="id_equipo" type="text" id="id_equipo" readonly>
                            <span id="sid_equipo"></span>
                            <label for="id_equipo" class="form-label">ID Equipo</label>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-floating mb-3 mt-4">
                            <input placeholder="" class="form-control" name="tipo_equipo" type="text" id="tipo_equipo" maxlength="45">
                            <span id="stipo_equipo"></span>
                            <label for="tipo_equipo" class="form-label">Tipo de Equipo</label>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="form-floating mb-3 mt-4">
                            <input placeholder="" class="form-control" name="serial" type="text" id="serial" maxlength="45">
                            <span id="sserial"></span>
                            <label for="serial" class="form-label">Serial</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3 mt-4">
                            <select class="form-select" name="codigo_bien" id="codigo_bien">
                                <option value="">Seleccione un código de bien</option>
                                <?php foreach ($bienes as $bien): ?>
                                    <option value="<?= $bien['codigo_bien'] ?>">
                                        <?= $bien['codigo_bien'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span id="scodigo_bien"></span>
                            <label for="codigo_bien" class="form-label">Código de Bien</label>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="form-floating mb-3 mt-4">
                            <select class="form-select" name="id_dependencia" id="id_dependencia">
                                <option value="">Seleccione una dependencia</option>
                                <?php foreach ($dependencias as $dependencia): ?>
                                    <option value="<?= $dependencia['id_dependencia'] ?>">
                                        <?= $dependencia['nombre_dependencia'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span id="sid_dependencia"></span>
                            <label for="id_dependencia" class="form-label">Dependencia</label>
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