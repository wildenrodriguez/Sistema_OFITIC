$(document).ready(function () {
    consultar();
    datosPiso();
    registrarEntrada();

    $("#enviar").on("click", function () {
        switch ($(this).text()) {
            case "Registrar":
                if (validarenvio()) {
                    var datos = new FormData();
                    datos.append('registrar', 'registrar');
                    datos.append('id_piso', $("#id_piso").val());
                    datos.append('nombre', $("#nombre").val());
                    enviaAjax(datos);
                }
                break;
            case "Modificar":
                if (validarenvio()) {
                    var datos = new FormData();
                    datos.append('modificar', 'modificar');
                    datos.append('id_oficina', $("#id_oficina").val());
                    datos.append('nombre', $("#nombre").val());
                    enviaAjax(datos);
                }
                break;
            case "Eliminar":
                var datos = new FormData();
                datos.append('eliminar', 'eliminar');
                datos.append('id_oficina', $("#id_oficina").val());
                enviaAjax(datos);
                break;
            default:
                mensajes("question", 10000, "Error", "Acción desconocida: " + $(this).text());
        }
    });

    $("#btn-registrar").on("click", function () {
        limpia();
        $("#modalTitleId").text("Registrar Oficina");
        $("#enviar").text("Registrar");
        $("#modal1").modal("show");
    });
});

function datosPiso() {
    var datos = new FormData();
    datos.append('listar_piso', 'listar_piso');
    enviaAjax(datos);
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
        success: function (respuesta) {
            try {
                var lee = JSON.parse(respuesta);
                if (lee.resultado == "registrar" || lee.resultado == "modificar" || lee.resultado == "eliminar") {
                    $("#modal1").modal("hide");
                    mensajes("success", 10000, lee.mensaje, null);
                    consultar();
                } else if (lee.resultado == "consultar") {
                    iniciarTabla(lee.datos);
                } else if (lee.resultado == "lista_piso") {
                    selectPiso(lee.datos);
                } else if (lee.resultado == "error") {
                    mensajes("error", null, lee.mensaje, null);
                }
            } catch (e) {
                mensajes("error", null, "Error en JSON: " + e.message);
            }
        },
        error: function () {
            mensajes("error", null, "Ocurrió un error", "Intente de nuevo");
        }
    });
}

function selectPiso(arreglo) {
    $("#id_piso").empty();
    $("#id_piso").append(new Option('Seleccione un Piso', null));
    arreglo.forEach(item => {
        $("#id_piso").append(new Option(item.tipo_piso, item.id_piso));
    });
}

function validarenvio() {
    if ($("#id_piso").val() === 'null') {
        mensajes("error", 10000, "Verifica", "Debe seleccionar un piso");
        return false;
    } else if ($("#nombre").val().trim() === '') {
        mensajes("error", 10000, "Verifica", "Debe ingresar un nombre");
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
}

function crearDataTable(arreglo) {
    tabla = $('#tabla1').DataTable({
        data: arreglo,
        columns: [
            { data: 'id_oficiona' },
            { data: 'id_piso' },
            { data: 'tipo_piso' },
            { data: 'nombre' },
            {
                data: null, render: function () {
                    return `<button onclick="rellenar(this, 0)" class="btn btn-update"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button onclick="rellenar(this, 1)" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>`;
                }
            }
        ],
        order: [[1, 'asc']],
        language: { url: idiomaTabla }
    });
}

function limpia() {
    $("#id_piso").val(null);
    $("#nombre").val("");
}

function rellenar(pos, accion) {
    var linea = $(pos).closest('tr');
    $("#id_oficina").val($(linea).find("td:eq(0)").text());
    $("#id_piso").val($(linea).find("td:eq(1)").text());
    $("#nombre").val($(linea).find("td:eq(3)").text());

    if (accion == 0) {
        $("#modalTitleId").text("Modificar Oficina");
        $("#enviar").text("Modificar");
    } else {
        $("#modalTitleId").text("Eliminar Oficina");
        $("#enviar").text("Eliminar");
    }
    $("#modal1").modal("show");
}
