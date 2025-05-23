$(document).ready(function () {
    consultar();
    registrarEntrada();
    capaValidar();

    $("#enviar").on("click", function () {
        switch ($(this).text()) {
            case "Registrar":
                if (validarenvio()) {
                    var datos = new FormData();
                    datos.append('registrar', 'registrar');
                    datos.append('nro_solicitud', $("#nro_solicitud").val());
                    datos.append('id_tipo_servicio', $("#id_tipo_servicio").val());
                    enviaAjax(datos);
                }
                break;
            case "Modificar":
                if (validarenvio()) {
                    var datos = new FormData();
                    datos.append('actualizar', 'actualizar');
                    datos.append('codigo_hoja_servicio', $("#codigo_hoja_servicio").val());
                    datos.append('resultado_hoja_servicio', $("#resultado_hoja_servicio").val());
                    datos.append('observacion', $("#observacion").val());
                    enviaAjax(datos);
                }
                break;
            case "Finalizar":
                if (confirmarAccion("¿Finalizar Hoja de Servicio?", "¿Está seguro que desea finalizar esta hoja de servicio?", "question")) {
                    var datos = new FormData();
                    datos.append('finalizar', 'finalizar');
                    datos.append('codigo_hoja_servicio', $("#codigo_hoja_servicio").val());
                    enviaAjax(datos);
                }
                break;
            default:
                mensajes("question", 10000, "Error", "Acción desconocida: " + $(this).text());
        }
        $('#enviar').prop('disabled', true);
    });

    $("#btn-registrar").on("click", function () {
        limpia();
        $("#modalTitleId").text("Registrar Hoja de Servicio");
        $("#enviar").text("Registrar");
        $("#fila-resultado").hide();
        $("#fila-observacion").hide();
        $("#fila-detalles").hide();
        $("#modal1").modal("show");
    });

    $("#btn-agregar-detalle").on("click", function() {
        var nuevaFila = `
            <tr>
                <td><input type="text" class="form-control componente" placeholder="Componente"></td>
                <td><input type="text" class="form-control detalle" placeholder="Detalle"></td>
                <td><button type="button" class="btn btn-danger btn-sm btn-eliminar-detalle"><i class="bi bi-trash"></i></button></td>
            </tr>
        `;
        $("#tablaDetallesModal tbody").append(nuevaFila);
    });

    $(document).on("click", ".btn-eliminar-detalle", function() {
        $(this).closest("tr").remove();
    });
});

function consultarDetalles(codigo) {
    var datos = new FormData();
    datos.append('consultar_detalles', 'consultar_detalles');
    datos.append('codigo_hoja_servicio', codigo);
    enviaAjax(datos);
}

function verDetalles(codigo) {
    var datos = new FormData();
    datos.append('consultar', 'consultar');
    datos.append('codigo_hoja_servicio', codigo);
    
    $.ajax({
        async: true,
        url: "",
        type: "POST",
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        beforeSend: function () { },
        timeout: 10000,
        success: function (respuesta) {
            try {
                var lee = JSON.parse(respuesta);
                if (lee) {
                    // Llenar los datos principales
                    $("#detalle-solicitante").text(lee.nombre_solicitante + " (" + lee.telefono_empleado + ")");
                    $("#detalle-equipo").text(lee.tipo_equipo + " " + (lee.nombre_marca || "") + " - Serial: " + (lee.serial || "N/A"));
                    $("#detalle-motivo").text(lee.motivo);
                    $("#detalle-fecha-solicitud").text(lee.fecha_solicitud);
                    $("#detalle-resultado").text(lee.resultado_hoja_servicio || "No especificado");
                    $("#detalle-observacion").text(lee.observacion || "No especificado");
                    
                    // Consultar los detalles técnicos
                    consultarDetalles(codigo);
                    
                    // Mostrar el modal
                    $("#modalDetalles").modal("show");
                }
            } catch (e) {
                mensajes("error", null, "Error en JSON Tipo: " + e.name + "\n" +
                    "Mensaje: " + e.message + "\n" +
                    "Posición: " + e.lineNumber);
            }
        },
        error: function (request, status, err) {
            if (status == "timeout") {
                mensajes("error", null, "Servidor ocupado", "Intente de nuevo");
            } else {
                mensajes("error", null, "Ocurrió un error", "ERROR: <br/>" + request + status + err);
            }
        }
    });
}

function enviaAjax(datos) {
    $.ajax({
        async: true,
        url: "",
        type: "POST",
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        beforeSend: function () { },
        timeout: 10000,
        success: function (respuesta) {
            try {
                var lee = JSON.parse(respuesta);
                if (lee.resultado == "registrar") {
                    $("#modal1").modal("hide");
                    mensajes("success", 10000, "Hoja de servicio registrada", null);
                    consultar();

                } else if (lee.resultado == "consultar") {
                    iniciarTabla(lee.datos);

                } else if (lee.resultado == "consultar_detalles") {
                    // Llenar la tabla de detalles en el modal
                    $("#tablaDetalles tbody").empty();
                    lee.forEach(function(detalle) {
                        $("#tablaDetalles tbody").append(`
                            <tr>
                                <td>${detalle.componente || ""}</td>
                                <td>${detalle.detalle || ""}</td>
                            </tr>
                        `);
                    });

                } else if (lee.resultado == "tipos_disponibles") {
                    // Actualizar el select con los tipos disponibles
                    $("#id_tipo_servicio").empty();
                    $("#id_tipo_servicio").append(new Option("Seleccione un tipo", ""));
                    lee.forEach(function(tipo) {
                        $("#id_tipo_servicio").append(new Option(tipo.nombre_tipo_servicio, tipo.id_tipo_servicio));
                    });

                } else if (lee.resultado == "consultar_tipos") {
                    // No action needed, already loaded on page load

                } else if (lee.resultado == "actualizar") {
                    $("#modal1").modal("hide");
                    mensajes("success", null, "Hoja de servicio actualizada", lee.mensaje);
                    consultar();

                } else if (lee.resultado == "registrar_detalles") {
                    mensajes("success", null, "Detalles registrados", lee.mensaje);

                } else if (lee.resultado == "finalizar") {
                    $("#modal1").modal("hide");
                    mensajes("success", null, "Hoja de servicio finalizada", lee.mensaje);
                    consultar();

                } else if (lee.resultado == "listar") {
                    // No action needed, used for other purposes

                } else if (lee.resultado == "entrada") {
                    // No action needed

                } else if (lee.resultado == "error") {
                    mensajes("error", null, lee.mensaje, null);
                }
            } catch (e) {
                mensajes("error", null, "Error en JSON Tipo: " + e.name + "\n" +
                    "Mensaje: " + e.message + "\n" +
                    "Posición: " + e.lineNumber);
                    console.log(respuesta);
            }
        },
        error: function (request, status, err) {
            if (status == "timeout") {
                mensajes("error", null, "Servidor ocupado", "Intente de nuevo");
            } else {
                mensajes("error", null, "Ocurrió un error", "ERROR: <br/>" + request + status + err);
            }
        },
        complete: function () { },
    });
}

function capaValidar() {
    $("#nro_solicitud").on("keypress", function (e) {
        validarKeyPress(/^[0-9\b]*$/, e);
    });
    $("#nro_solicitud").on("keyup", function () {
        validarKeyUp(
            /^[0-9]{1,10}$/, $(this), $("#snro_solicitud"),
            "El número de solicitud debe ser numérico"
        );
    });

    $("#id_tipo_servicio").on("change", function () {
        estadoSelect($(this), $("#sid_tipo_servicio"), "Debe seleccionar un tipo de servicio", $(this).val() != "");
    });

    $("#resultado_hoja_servicio").on("keypress", function (e) {
        validarKeyPress(/^[A-Za-z0-9\sáéíóúüñÁÉÍÓÚÜÑ.,\-()\b]*$/, e);
    });
    $("#resultado_hoja_servicio").on("keyup", function () {
        validarKeyUp(
            /^[A-Za-z0-9\sáéíóúüñÁÉÍÓÚÜÑ.,\-()]{3,100}$/, $(this), $("#sresultado_hoja_servicio"),
            "El resultado debe tener entre 3 y 100 caracteres"
        );
    });

    $("#observacion").on("keypress", function (e) {
        validarKeyPress(/^[A-Za-z0-9\sáéíóúüñÁÉÍÓÚÜÑ.,\-()\b]*$/, e);
    });
    $("#observacion").on("keyup", function () {
        validarKeyUp(
            /^[A-Za-z0-9\sáéíóúüñÁÉÍÓÚÜÑ.,\-()]{3,200}$/, $(this), $("#sobservacion"),
            "La observación debe tener entre 3 y 200 caracteres"
        );
    });
}

function validarenvio() {
    if ($("#modalTitleId").text() === "Registrar Hoja de Servicio") {
        if (validarKeyUp(/^[0-9]{1,10}$/, $("#nro_solicitud"), $("#snro_solicitud"), "") == 0) {
            mensajes("error", 10000, "Verifica", "El número de solicitud debe ser válido");
            return false;
        } else if ($("#id_tipo_servicio").val() == "") {
            mensajes("error", 10000, "Verifica", "Debe seleccionar un tipo de servicio");
            return false;
        }
    } else if ($("#modalTitleId").text() === "Modificar Hoja de Servicio") {
        if (validarKeyUp(/^[A-Za-z0-9\sáéíóúüñÁÉÍÓÚÜÑ.,\-()]{3,100}$/, $("#resultado_hoja_servicio"), $("#sresultado_hoja_servicio"), "") == 0) {
            mensajes("error", 10000, "Verifica", "El resultado debe tener entre 3 y 100 caracteres");
            return false;
        }
    }
    return true;
}

var tabla;

function iniciarTabla(arreglo) {
    if (tabla == null) {
        crearDataTable(arreglo);
    } else {
        tabla.destroy();
        crearDataTable(arreglo);
    }
};

function crearDataTable(arreglo) {
    if ($.fn.DataTable.isDataTable('#tabla1')) {
        $('#tabla1').DataTable().destroy();
    }
    $('#tabla1').DataTable({
        data: arreglo,
        columns: [
            {
                data: null, render: function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            { data: 'codigo_hoja_servicio' },
            { data: 'nro_solicitud' },
            { data: 'nombre_tipo_servicio' },
            { data: 'fecha_resultado' },
            { data: 'nombre_tecnico' },
            { data: 'resultado_hoja_servicio' },
            {
                data: null, render: function (data, type, row) {
                    const botones = `
                        <button onclick="rellenar(this, 0)" class="btn btn-update" title="Modificar">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button onclick="verDetalles('${row.codigo_hoja_servicio}')" class="btn btn-info" title="Ver Detalles">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    `;
                    return botones;
                }
            }],
        language: {
            url: idiomaTabla,
        }
    });
}

function limpia() {
    $("#codigo_hoja_servicio").val("");
    
    $("#nro_solicitud").removeClass("is-valid is-invalid");
    $("#nro_solicitud").val("");
    
    $("#id_tipo_servicio").removeClass("is-valid is-invalid");
    $("#id_tipo_servicio").val("");
    
    $("#resultado_hoja_servicio").removeClass("is-valid is-invalid");
    $("#resultado_hoja_servicio").val("");
    
    $("#observacion").removeClass("is-valid is-invalid");
    $("#observacion").val("");
    
    $("#tablaDetallesModal tbody").empty();
    
    $('#enviar').prop('disabled', false);
}

function rellenar(pos, accion) {
    linea = $(pos).closest('tr');

    limpia();

    $("#codigo_hoja_servicio").val($(linea).find("td:eq(1)").text());
    $("#nro_solicitud").val($(linea).find("td:eq(2)").text());
    buscarSelect("#id_tipo_servicio", $(linea).find("td:eq(3)").text(), "text");
    
    // Mostrar campos adicionales para modificación
    $("#fila-resultado").show();
    $("#fila-observacion").show();
    $("#fila-detalles").show();
    
    if (accion == 0) {
        $("#modalTitleId").text("Modificar Hoja de Servicio")
        $("#enviar").text("Modificar");
    } else {
        $("#modalTitleId").text("Finalizar Hoja de Servicio")
        $("#enviar").text("Finalizar");
    }
    
    // Cargar detalles existentes
    consultarDetalles($(linea).find("td:eq(1)").text());
    
    $('#enviar').prop('disabled', false);
    $("#modal1").modal("show");
}

function consultar() {
    var peticion = new FormData();
    peticion.append('consultar', 'consultar');
    enviaAjax(peticion);
}

function registrarEntrada() {
    var peticion = new FormData();
    peticion.append('entrada', 'entrada');
    enviaAjax(peticion);
}