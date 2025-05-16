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
					datos.append('nombre', $("#nombre").val());
					enviaAjax(datos);
				}
				break;
			case "Modificar":
				if (validarenvio()) {
					var datos = new FormData();
					datos.append('modificar', 'modificar');
					datos.append('id_tipo_bien', $("#id_tipo_bien").val());
					datos.append('nombre', $("#nombre").val());
					enviaAjax(datos);
				}
				break;
			case "Eliminar":
				if (validarenvio()) {
					var datos = new FormData();
					datos.append('eliminar', 'eliminar');
					datos.append('id_tipo_bien', $("#id_tipo_bien").val());
					enviaAjax(datos);
				}
				break;

			default:
				mensajes("question", 10000, "Error", "Acción desconocida: " + $(this).text());;
		}
		$('#enviar').prop('disabled', true);
	});

	$("#btn-registrar").on("click", function () {
		limpia();
		$("#id_tipo_bien").parent().parent().remove();
        $("#nombre").parent().parent().show();
		$("#modalTitleId").text("Registrar Tipo de Bien");
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

				} else if (lee.resultado == "consultar_eliminadas") {
					iniciarTablaEliminadas(lee.datos);

				} else if (lee.resultado == "modificar") {
					$("#modal1").modal("hide");
					mensajes("success", 10000, lee.mensaje, null);
					consultar();

				} else if (lee.resultado == "eliminar") {
					$("#modal1").modal("hide");
					mensajes("success", 10000, lee.mensaje, null);
					consultar();

				} else if (lee.resultado == "entrada") {

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
	$("#nombre").on("keypress", function (e) {
		validarKeyPress(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.\b]*$/, e);
	});
	$("#nombre").on("keyup", function () {
		validarKeyUp(
			/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{3,45}$/, $(this), $("#snombre"),
			"El nombre del tipo de bien debe tener de 3 a 45 carácteres"
		);
	});
}

function validarenvio() {
	if (validarKeyUp(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{3,45}$/, $("#nombre"), $("#snombre"), "") == 0) {
		mensajes("error", 10000, "Verifica", "El nombre del tipo de bien debe tener de 3 a 45 carácteres");
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
			{ data: 'id_tipo_bien' },
			{ data: 'nombre_tipo_bien' },
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

function iniciarTablaEliminadas(arreglo) {
    if ($.fn.DataTable.isDataTable('#tablaEliminadas')) {
        $('#tablaEliminadas').DataTable().destroy();
    }
    
    $('#tablaEliminadas').DataTable({
        data: arreglo,
        columns: [
            { data: 'id_tipo_bien' },
            { data: 'nombre_tipo_bien' },
            {
                data: null, 
                render: function() {
                    return `<button onclick="restaurarTipoBien(this)" class="btn btn-success">
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

function limpia() {
	$("#nombre").removeClass("is-valid is-invalid");
	$("#nombre").val("");
	$('#enviar').prop('disabled', false);
}

function rellenar(pos, accion) {
	linea = $(pos).closest('tr');

	if (!$("#id_tipo_bien").length) {
		$("#Fila1").prepend(`<div class="col-4">
            <div class="form-floating mb-3 mt-4">
                <input placeholder="" class="form-control" name="id_tipo_bien" type="text" id="id_tipo_bien" readonly>
                <span id="sid_tipo_bien"></span>
                <label for="id_tipo_bien" class="form-label">ID Tipo de Bien</label>
            </div>`);
	}

	$("#id_tipo_bien").val($(linea).find("td:eq(0)").text());
	$("#nombre").val($(linea).find("td:eq(1)").text());

	if (accion == 0) {
		$("#modalTitleId").text("Modificar Tipo de Bien")
		$("#enviar").text("Modificar");
	}
	else {
		$("#modalTitleId").text("Eliminar Tipo de Bien")
		$("#enviar").text("Eliminar");
	}
	$('#enviar').prop('disabled', false);
	$("#modal1").modal("show");
}

function consultarEliminadas() {
    var datos = new FormData();
    datos.append('consultar_eliminadas', 'consultar_eliminadas');
    enviaAjax(datos);
}

function restaurarTipoBien(boton) {
    var linea = $(boton).closest('tr');
    var id = $(linea).find('td:eq(0)').text();
    
    Swal.fire({
        title: '¿Restaurar Tipo de Bien?',
        text: "¿Está seguro que desea restaurar este tipo de bien?",
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
            datos.append('id_tipo_bien', id);
            
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
                            mensajes("success", null, "Tipo de bien restaurado", lee.mensaje);
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
                    mensajes("error", null, "Error", "No se pudo restaurar el tipo de bien");
                }
            });
        }
    });
}