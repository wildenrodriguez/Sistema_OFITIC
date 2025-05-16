$(document).ready(function () {
    consultarCargos();

    $("#enviarCargo").on("click", function () {
        switch ($(this).text()) {
            case "Registrar":
                if (validarEnvioCargo()) {
                    var datos = new FormData();
                    datos.append('registrar', 'registrar');
                    datos.append('nombre_cargo', $("#nombre_cargo").val());
                    enviarAjaxCargo(datos);
                }
                break;
            case "Modificar":
                if (validarEnvioCargo()) {
                    var datos = new FormData();
                    datos.append('modificar', 'modificar');
                    datos.append('id_cargo', $("#id_cargo").val());
                    datos.append('nombre_cargo', $("#nombre_cargo").val());
                    enviarAjaxCargo(datos);
                }
                break;
            case "Eliminar":
                var datos = new FormData();
                datos.append('eliminar', 'eliminar');
                datos.append('id_cargo', $("#id_cargo").val());
                enviarAjaxCargo(datos);
                break;
            default:
                mensajes("error", null, "Acción desconocida: " + $(this).text());
        }
    });

    $("#btn-registrar-cargo").on("click", function () {
        limpiarCargo();
        $("#modalCargoTitle").text("Registrar Cargo");
        $("#enviarCargo").text("Registrar");
        $("#modalCargo").modal("show");
    });
});

function enviarAjaxCargo(datos) {
    $.ajax({
        url: "",
        type: "POST",
        data: datos,
        processData: false,
        contentType: false,
        success: function (respuesta) {
            try {
                var res = JSON.parse(respuesta);
                if (res.resultado === "registrar" || res.resultado === "modificar" || res.resultado === "eliminar") {
                    mensajes("success", null, res.mensaje);
                    consultarCargos();
                    $("#modalCargo").modal("hide");
                } else {
                    mensajes("error", null, res.mensaje);
                }
            } catch (e) {
                mensajes("error", null, "Error procesando la respuesta");
            }
        },
        error: function () {
            mensajes("error", null, "Error en la solicitud");
        }
    });
}

function consultarCargos() {
    var datos = new FormData();
    datos.append('consultar', 'consultar');
    $.ajax({
        url: "",
        type: "POST",
        data: datos,
        processData: false,
        contentType: false,
        success: function (respuesta) {
            try {
                var res = JSON.parse(respuesta);
                if (res.resultado === "consultar") {
                    iniciarTablaCargos(res.datos);
                }
            } catch (e) {
                mensajes("error", null, "Error procesando la respuesta");
            }
        },
        error: function () {
            mensajes("error", null, "Error en la solicitud");
        }
    });
}

function iniciarTablaCargos(datos) {
    if ($.fn.DataTable.isDataTable('#tablaCargos')) {
        $('#tablaCargos').DataTable().destroy();
    }
    $('#tablaCargos').DataTable({
        data: datos,
        columns: [
            { data: 'id_cargo' },
            { data: 'nombre_cargo' },
            {
                data: null,
                render: function () {
                    return `<button onclick="rellenar(this, 0)" class="btn btn-update"><i class="fa-solid fa-pen-to-square"></i></button>
					<button onclick="rellenar(this, 1)" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>`;
                }
            }
        ],
        language: {
            url: idiomaTabla
        }
    });
}

function rellenar(pos, accion) {

    linea = $(pos).closest('tr');

    $("#idCargo").remove();
    $("#Fila1").prepend(`<div class="col-4" id="idCargo">
            <div class="form-floating mb-3 mt-4">
              <input placeholder="" class="form-control" name="id_cargo" type="text" id="id_cargo" readOnly>
              <span id="sid_cargo"></span>
              <label for="id_cargo" class="form-label">ID del Cargo</label>
            </div>`);

    $("#id_cargo").val($(linea).find("td:eq(0)").text());
    $("#nombre_cargo").val($(linea).find("td:eq(1)").text());


    if (accion == 0) {
        $("#modalCargoTitle").text("Modificar Edificio")
        $("#enviarCargo").text("Modificar");
    }
    else {
        $("#modalCargoTitle").text("Eliminar Edificio")
        $("#enviarCargo").text("Eliminar");
    }
    $('#enviarCargo').prop('disabled', false);
    $("#modalCargo").modal("show");
}

function limpiarCargo() {
    $("#idCargo").remove();
    $("#id_cargo").val("");
    $("#nombre_cargo").val("");
}

function validarEnvioCargo() {
    if ($("#nombre_cargo").val().length < 3) {
        mensajes("error", null, "El nombre del cargo debe tener al menos 3 caracteres");
        return false;
    }
    return true;
}
