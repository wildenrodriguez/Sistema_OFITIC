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
                    datos.append('codigo_bien', $("#codigo_bien").val());
                    datos.append('id_tipo_bien', $("#id_tipo_bien").val());
                    datos.append('id_marca', $("#id_marca").val());
                    datos.append('descripcion', $("#descripcion").val());
                    datos.append('estado', $("#estado").val());
                    datos.append('cedula_empleado', $("#cedula_empleado").val());
                    datos.append('id_oficina', $("#id_oficina").val());
                    enviaAjax(datos);
                }
                break;
            case "Modificar":
                if (validarenvio()) {
                    var datos = new FormData();
                    datos.append('modificar', 'modificar');
                    datos.append('codigo_bien', $("#codigo_bien").val());
                    datos.append('id_tipo_bien', $("#id_tipo_bien").val());
                    datos.append('id_marca', $("#id_marca").val());
                    datos.append('descripcion', $("#descripcion").val());
                    datos.append('estado', $("#estado").val());
                    datos.append('cedula_empleado', $("#cedula_empleado").val());
                    datos.append('id_oficina', $("#id_oficina").val());
                    enviaAjax(datos);
                }
                break;
            case "Eliminar":
                if (validarenvio()) {
                    var datos = new FormData();
                    datos.append('eliminar', 'eliminar');
                    datos.append('codigo_bien', $("#codigo_bien").val());
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
        $("#codigo_bien").parent().parent().show();
        $("#modalTitleId").text("Registrar Bien");
        $("#enviar").text("Registrar");
        $("#modal1").modal("show");
    });

    $("#btn-consultar-eliminados").on("click", function() {
        consultarEliminadas();
        $("#modalEliminadas").modal("show");
    });
});

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
                    mensajes("success", 10000, lee.mensaje, null);
                    consultar();

                } else if (lee.resultado == "consultar") {
                    iniciarTabla(lee.datos);

                } else if (lee.resultado == "modificar") {
                    $("#modal1").modal("hide");
                    mensajes("success", 10000, lee.mensaje, null);
                    consultar();

                } else if (lee.resultado == "eliminar") {
                    $("#modal1").modal("hide");
                    mensajes("success", 10000, lee.mensaje, null);
                    consultar();

                } else if (lee.resultado == "entrada") {
                    // No action needed
                } else if (lee.resultado == "error") {
                    mensajes("error", null, lee.mensaje, null);
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
        },
        complete: function () { },
    });
}

function capaValidar() {
    $("#codigo_bien").on("keypress", function (e) {
        validarKeyPress(/^[0-9a-zA-Z\-\b]*$/, e);
    });
    $("#codigo_bien").on("keyup", function () {
        validarKeyUp(
            /^[0-9a-zA-Z\-]{3,20}$/, $(this), $("#scodigo_bien"),
            "El código debe tener de 3 a 20 caracteres (letras, números o guiones)"
        );
    });

    $("#descripcion").on("keypress", function (e) {
        validarKeyPress(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.,\b]*$/, e);
    });
    $("#descripcion").on("keyup", function () {
        validarKeyUp(
            /^[0-9 a-zA-ZáéíóúüñÑçÇ -.,]{3,100}$/, $(this), $("#sdescripcion"),
            "La descripción debe tener de 3 a 100 caracteres"
        );
    });

    $("#id_tipo_bien").on("change", function () {
        estadoSelect($(this), $("#sid_tipo_bien"), "Debe seleccionar un tipo de bien", $(this).val() != "");
    });

    $("#id_marca").on("change", function () {
        estadoSelect($(this), $("#sid_marca"), "Debe seleccionar una marca", $(this).val() != "");
    });

    $("#estado").on("change", function () {
        estadoSelect($(this), $("#sestado"), "Debe seleccionar un estado", $(this).val() != "");
    });

    $("#id_oficina").on("change", function () {
        estadoSelect($(this), $("#sid_oficina"), "Debe seleccionar una oficina", $(this).val() != "");
    });
}

function validarenvio() {
    if (validarKeyUp(/^[0-9a-zA-Z\-]{3,20}$/, $("#codigo_bien"), $("#scodigo_bien"), "") == 0) {
        mensajes("error", 10000, "Verifica", "El código debe tener de 3 a 20 caracteres (letras, números o guiones)");
        return false;
    } else if (validarKeyUp(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.,]{3,100}$/, $("#descripcion"), $("#sdescripcion"), "") == 0) {
        mensajes("error", 10000, "Verifica", "La descripción debe tener de 3 a 100 caracteres");
        return false;
    } else if ($("#id_tipo_bien").val() == "") {
        mensajes("error", 10000, "Verifica", "Debe seleccionar un tipo de bien");
        return false;
    } else if ($("#estado").val() == "") {
        mensajes("error", 10000, "Verifica", "Debe seleccionar un estado");
        return false;
    } else if ($("#id_oficina").val() == "") {
        mensajes("error", 10000, "Verifica", "Debe seleccionar una oficina");
        return false;
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
    tabla = $('#tabla1').DataTable({
        data: arreglo,
        columns: [
            { data: null, render: function(data, type, row, meta) {
                return meta.row + 1;
            }},
            { data: 'codigo_bien' },
            { data: 'nombre_tipo_bien' },
            { data: 'nombre_marca' },
            { data: 'descripcion' },
            { data: 'estado' },
            { data: 'nombre_oficina' },
            { data: 'empleado' },
            {
                data: null, render: function () {
                    const botones = `<button onclick="rellenar(this, 0)" class="btn btn-update"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button onclick="rellenar(this, 1)" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>`;
                    return botones;
                }
            }],
        language: {
            url: idiomaTabla,
        }
    });
}

function limpia() {
    $("#codigo_bien").removeClass("is-valid is-invalid");
    $("#codigo_bien").val("");
    
    $("#descripcion").removeClass("is-valid is-invalid");
    $("#descripcion").val("");
    
    $("#id_tipo_bien").removeClass("is-valid is-invalid");
    $("#id_tipo_bien").val("");
    
    $("#id_marca").removeClass("is-valid is-invalid");
    $("#id_marca").val("");
    
    $("#estado").removeClass("is-valid is-invalid");
    $("#estado").val("");
    
    $("#id_oficina").removeClass("is-valid is-invalid");
    $("#id_oficina").val("");
    
    $("#cedula_empleado").removeClass("is-valid is-invalid");
    $("#cedula_empleado").val("");

    $('#enviar').prop('disabled', false);
}

function rellenar(pos, accion) {
    linea = $(pos).closest('tr');

    limpia();
    
    $("#codigo_bien").val($(linea).find("td:eq(1)").text());
    $("#descripcion").val($(linea).find("td:eq(4)").text());
    
    // Seleccionar tipo de bien
    var tipoBien = $(linea).find("td:eq(2)").text();
    $("#id_tipo_bien option").each(function() {
        if ($(this).text() == tipoBien) {
            $(this).prop("selected", true);
            $("#id_tipo_bien").trigger("change");
            return false;
        }
    });
    
    // Seleccionar marca
    var marca = $(linea).find("td:eq(3)").text();
    $("#id_marca option").each(function() {
        if ($(this).text() == marca) {
            $(this).prop("selected", true);
            $("#id_marca").trigger("change");
            return false;
        }
    });
    
    // Seleccionar estado
    var estado = $(linea).find("td:eq(5)").text();
    $("#estado option").each(function() {
        if ($(this).text() == estado) {
            $(this).prop("selected", true);
            $("#estado").trigger("change");
            return false;
        }
    });
    
    // Seleccionar oficina
    var oficina = $(linea).find("td:eq(6)").text();
    $("#id_oficina option").each(function() {
        if ($(this).text() == oficina) {
            $(this).prop("selected", true);
            $("#id_oficina").trigger("change");
            return false;
        }
    });
    
    // Seleccionar empleado
    var empleado = $(linea).find("td:eq(7)").text();
    $("#cedula_empleado option").each(function() {
        if ($(this).text() == empleado) {
            $(this).prop("selected", true);
            $("#cedula_empleado").trigger("change");
            return false;
        }
    });

    if (accion == 0) {
        $("#modalTitleId").text("Modificar Bien")
        $("#enviar").text("Modificar");
    } else {
        $("#modalTitleId").text("Eliminar Bien")
        $("#enviar").text("Eliminar");
    }
    $('#enviar').prop('disabled', false);
    $("#modal1").modal("show");
}

function consultarEliminadas() {
    var datos = new FormData();
    datos.append('consultar_eliminadas', 'consultar_eliminadas');
    
    $.ajax({
        async: true,
        url: "",
        type: "POST",
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        beforeSend: function() {},
        timeout: 10000,
        success: function(respuesta) {
            try {
                var lee = JSON.parse(respuesta);
                if (lee.resultado == "consultar_eliminadas") {
                    if ($.fn.DataTable.isDataTable('#tablaEliminadas')) {
                        $('#tablaEliminadas').DataTable().destroy();
                    }
                    
                    $('#tablaEliminadas').DataTable({
                        data: lee.datos,
                        columns: [
                            { data: null, render: function(data, type, row, meta) {
                                return meta.row + 1;
                            }},
                            { data: 'codigo_bien' },
                            { data: 'nombre_tipo_bien' },
                            { data: 'nombre_marca' },
                            { data: 'descripcion' },
                            { data: 'estado' },
                            {
                                data: null, 
                                render: function() {
                                    return `<button onclick="restaurarBien(this)" class="btn btn-success">
                                            <i class="fa-solid fa-recycle"></i>
                                            </button>`;
                                }
                            }
                        ],
                        language: {
                            url: idiomaTabla,
                        }
                    });
                }
            } catch (e) {
                console.error("Error procesando datos:", e);
            }
        },
        error: function(request, status, err) {
            mensajes("error", null, "Error al cargar bienes eliminados", "Intente nuevamente");
        }
    });
}

function restaurarBien(boton) {
    var linea = $(boton).closest('tr');
    var codigo = $(linea).find('td:eq(1)').text();
    
    Swal.fire({
        title: '¿Restaurar Bien?',
        text: "¿Está seguro que desea restaurar este bien?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, restaurar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            var datos = new FormData();
            datos.append('restaurar', 'restaurar');
            datos.append('codigo_bien', codigo);
            
            $.ajax({
                url: "",
                type: "POST",
                data: datos,
                processData: false,
                contentType: false,
                success: function(respuesta) {
                    try {
                        var lee = JSON.parse(respuesta);
                        if (lee.estado == 1) {
                            mensajes("success", null, "Bien restaurado", lee.mensaje);
                            consultarEliminadas();
                            consultar();
                        } else {
                            mensajes("error", null, "Error", lee.mensaje);
                        }
                    } catch (e) {
                        mensajes("error", null, "Error", "Error procesando la respuesta");
                    }
                },
                error: function() {
                    mensajes("error", null, "Error", "No se pudo restaurar el bien");
                }
            });
        }
    });
}