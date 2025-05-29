$(document).ready(function () {
	consultar();

	$("#enviar").on("click", async function () {

		var confirmacion = false;
		var envio = false;

		switch ($(this).text()) {

			case "Registrar":
				if (validarenvio()) {
					confirmacion = await confirmarAccion("Se registrará una Unidad", "¿Está seguro de realizar la acción?", "question");
					if (confirmacion) {
						var datos = new FormData();
						datos.append('registrar', 'registrar');
						datos.append('nombre', $("#nombre").val());
						enviaAjax(datos);
						envio = true;
					}
				}
				break;
			case "Modificar":
				if (validarenvio()) {
					confirmacion = await confirmarAccion("Se modificará una Unidad", "¿Está seguro de realizar la acción?", "question");
					if (confirmacion) {
						var datos = new FormData();
						datos.append('modificar', 'modificar');
						datos.append('id_rol', $("#id_rol").val());
						datos.append('nombre', $("#nombre").val());
						enviaAjax(datos);
						envio = true;
					}
				}
				break;
			case "Eliminar":
				if (validarKeyUp(/^[0-9]{1,11}$/, $("#id_rol"), $("#sid_rol"), "") == 1) {
					confirmacion = await confirmarAccion("Se eliminará una Unidad", "¿Está seguro de realizar la acción?", "warning");
					if (confirmacion) {
						var datos = new FormData();
						datos.append('eliminar', 'eliminar');
						datos.append('id_rol', $("#id_rol").val());
						enviaAjax(datos);
						envio = true;
					}
				}
				break;

			default:
				mensajes("question", 10000, "Error", "Acción desconocida: " + $(this).text());;
		}
		if (envio) {
			$('#enviar').prop('disabled', true);
		} else {
			$('#enviar').prop('disabled', false);
		}

		if (!confirmacion) {
			$('#enviar').prop('disabled', false);
		} else {
			$('#enviar').prop('disabled', true);
		}
	});

	$("#btn-registrar").on("click", function () { //<---- Evento del Boton Registrar
		limpia();
		$("#idRol").remove();
		$("#modalTitleId").text("Registrar Unidad");
		$("#enviar").text("Registrar");
		$("#modal1").modal("show");
	}); //<----Fin Evento del Boton Registrar
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
		timeout: 10000, //tiempo maximo de espera por la respuesta del servidor
		success: function (respuesta) {
			console.log(respuesta);
			try {
				var lee = JSON.parse(respuesta);
				if (lee.resultado == "registrar") {
					$("#modal1").modal("hide");
					mensajes("success", 10000, lee.mensaje, null);
					consultar();

				} else if (lee.resultado == "consultar") {
					crearDataTable(lee.datos);

				} else if (lee.resultado == "consultar_dependencia") {
					selectDependencia(lee.datos);

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
			"El nombre de la unidad debe tener de 4 a 45 carácteres"
		);
	});
}


function crearDataTable(arreglo) {
	if ($.fn.DataTable.isDataTable('#tabla1')) {
		$('#tabla1').DataTable().destroy();
	}

	$('#tabla1').DataTable({
		data: arreglo,
		order: [[0, "desc"]],
		columns: [
			{ data: 'id_rol' },
			{ data: 'nombre_rol' },
			{
				data: null, render: function () {
					const botones = `<button onclick="rellenar(this, 0)" class="btn btn-update"><i class="fa-solid fa-pen-to-square"></i></button>`;
					return botones;
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

	$("#id_dependencia").removeClass("is-valid is-invalid");
	$("#id_dependencia").val("default");

	$("#nombre").prop('readOnly', false);
	$("#id_dependencia").prop('disabled', false);
	$('#enviar').prop('disabled', false);
}


function rellenar(pos, accion) {
	limpia();
	linea = $(pos).closest('tr');

	$("#idRol").remove();
	$("#Fila1").prepend(`<div class="col-4" id="idRol">
            <div class="form-floating mb-3 mt-4">
              <input placeholder="" class="form-control" name="id_rol" type="text" id="id_rol" readOnly>
              <span id="sid_rol"></span>
              <label for="id_rol" class="form-label">ID de la Unidad</label>
            </div>`);

	$("#id_rol").val($(linea).find("td:eq(0)").text());
	$("#nombre").val($(linea).find("td:eq(1)").text());

	if (accion == 0) {

    const datos = [];
    
    // Seleccionar todos los divs que contienen módulos
    $('[data-modulo-string]').each(function() {
        const modulo = $(this);
        const moduloString = modulo.data('moduloString');
        const permisos = [];
        
        // Obtener todos los checkboxes dentro del módulo
        modulo.find('.form-check-input').each(function() {
            const checkbox = $(this);
			var bool;
            if (checkbox.prop('checked')) {
                bool = 1;
            } else {
				bool = 0;
			}
			permisos.push({
                    accion: checkbox.val(),
                    estado: bool
                });
        });
        
        if (permisos.length > 0) {
            datos.push({
                modulo: moduloString,
                permisos: permisos
            });
        }
    });


		console.log(datos);

		$("#modalTitleIdPermiso").text("Permisos");
		$("#modalPermiso").modal("show");
		$("#enviar_permiso").text("Guardar");
	} else {
		$("#nombre").prop('readOnly', true);
		$("#id_dependencia").prop('disabled', true);
		$("#modalTitleId").text("Eliminar Unidad");
		$("#enviar").text("Eliminar");
	}
	$('#enviar').prop('disabled', false);
}