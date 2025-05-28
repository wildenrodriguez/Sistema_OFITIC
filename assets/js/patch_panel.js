$(document).ready(function () {

	consultar();
	registrarEntrada();
	capaValidar();

	$("#enviar").on("click", async function () {

		
		$('#enviar').prop('disabled', false);

		let confirmacion = false;

		switch ($(this).text()) {

			case "Registrar":

				if (validarenvio()) {

					confirmacion = await confirmarAccion("Se registrará un Patch Panel", "¿Está seguro?", "question");

					if (confirmacion) {

						var datos = new FormData();
						datos.append('registrar', 'registrar');
						datos.append('codigo_bien', $("#codigo_bien").val());
						datos.append('tipo_patch_panel', $("#tipo_patch_panel").val());
						datos.append('cantidad_puertos', $("#cantidad_puertos").val());
						datos.append('serial_patch_panel', $("#serial_patch_panel").val());

						enviaAjax(datos);

					}
				}

			break;

			case "Modificar":

				if (validarenvio()) {

					confirmacion = await confirmarAccion("Se modificará el Patch Panel", "¿Está seguro?", "question");

					if (confirmacion) {

						var datos = new FormData();
						datos.append('modificar', 'modificar');
						datos.append('codigo_bien', $("#codigo_bien").val());
						datos.append('tipo_patch_panel', $("#tipo_patch_panel").val());
						datos.append('cantidad_puertos', $("#cantidad_puertos").val());
						datos.append('serial_patch_panel', $("#serial_patch_panel").val());

						enviaAjax(datos);

					}

				}

			break;

			case "Eliminar":

				if (validarenvio()) {

					confirmacion = await confirmarAccion("Se eliminará el Patch Panel", "¿Está seguro?", "warning");

					if (confirmacion) {

						var datos = new FormData();
						datos.append('eliminar', 'eliminar');
						datos.append('codigo_bien', $("#codigo_bien").val());

						enviaAjax(datos);

					}

				}

			break;

			default:

				mensajes("question", 10000, "Error", "Acción desconocida: " + $(this).text()); //;

		}


		if (!validarenvio()) {

			$('#enviar').prop('disabled', false);

		} else {

			$('#enviar').prop('disabled', true);

		};

		if (!confirmacion) {

			$('#enviar').prop('disabled', false);

		}

	});

	$("#btn-registrar").on("click", function () { 

		limpia();

		$("#modalTitleId").text("Registrar Patch Panel");
		$("#enviar").text("Registrar");
		$("#enviar").prop('disabled', false);
		$("#enviar").attr("title", "Registrar Patch Panel");
		$("#modal1").modal("show");

	}); 

	$("#btn-consultar-eliminados").on("click", function () {
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
		timeout: 10000, //tiempo maximo de espera por la respuesta del servidor

		success: function (respuesta) {

			console.log(respuesta);

			try {

				var lee = JSON.parse(respuesta);

				if (lee.resultado == "registrar") {

					$("#modal1").modal("hide");
					mensajes("success", 10000, lee.mensaje, null);
					actualizarSelectBien();
					consultar();

				} else if (lee.resultado == "consultar") {

					crearDataTable(lee.datos);

				} else if (lee.resultado == "modificar") {

					$("#modal1").modal("hide");
					mensajes("success", 10000, lee.mensaje, null);
					actualizarSelectBien();
					consultar();

				} else if (lee.resultado == "eliminar") {
					
					$("#modal1").modal("hide");
					mensajes("success", 10000, lee.mensaje, null);
					actualizarSelectBien();
					consultar();

				} else if (lee.resultado == "consultar_eliminadas") {

                    TablaEliminados(lee.datos);

                } else if (lee.resultado == "restaurar") {

                    mensajes("success", 10000, lee.mensaje, null);
                    consultarEliminadas();
					actualizarSelectBien();
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

	$('#codigo_bien').on('change blur input focusout mouseleave', function () {

		const obj = validarSelect();

		if (obj.bool === 0) { }
	})

}

function validarSelect() {

	let bool = null;
	let mensaje = "";

	const validar = { bool, mensaje };

	if ($('#codigo_bien').val() === 'default') {

		estadoSelect('#codigo_bien', '#scodigo_bien', "Seleccione un Bien", 0);

		validar.bool = 0;
		validar.mensaje = "Seleccione un Bien";

	} else {

		estadoSelect('#codigo_bien', '#scodigo_bien', "", 1);

		validar.bool = 1;
		validar.mensaje = "";

	}

	return validar;
}

function validarenvio() {

	const obj = validarSelect();

	if (obj.bool == 0) {

		mensajes("error", 10000, "Verifica", obj.mensaje);

		return false;
	}

	return true;
}

function crearDataTable(arreglo) {

	console.log(arreglo);

	if ($.fn.DataTable.isDataTable('#tabla1')) {

		$('#tabla1').DataTable().destroy();

	}

	$('#tabla1').DataTable({

		data: arreglo,

		columns: [
			{ data: 'codigo_bien' },
			{ data: 'cantidad_puertos' },
			{ data: 'tipo_patch_panel' },
			{ data: 'serial' },
			{
				data: null, render: function () {
					const botones = `<button onclick="rellenar(this, 0)" class="btn btn-update" title="Modificar Patch Panel"><i class="fa-solid fa-pen-to-square"></i></button>
					<button onclick="rellenar(this, 1)" class="btn btn-danger" title="Eliminar Patch Panel"><i class="fa-solid fa-trash"></i></button>`;
					return botones;
				}
			}],
		order: [
			[1, 'asc'],
			[2, 'asc']
		],
		language: {
			url: idiomaTabla,
		}
	});
}

function actualizarSelectBien() {
    $.ajax({
        url: '', 
        type: 'POST',
        data: { consultar_bien: 'consultar_bien' },
        success: function(respuesta) {
            try {
                let datos = JSON.parse(respuesta);
                if (Array.isArray(datos)) {
                    let $select = $("#codigo_bien");
                    $select.empty();
                    $select.append('<option selected value="default" disabled>Seleccione un Código de Bien</option>');
                    datos.forEach(function(bien) {
                        $select.append(`<option value="${bien.codigo_bien}">${bien.codigo_bien} - ${bien.descripcion}</option>`);
                    });
                }
            } catch (e) {

                mensajes("error", 5000, "Error", "No se pudo actualizar el listado de bienes.");

            }
        },
		error: function() {
            mensajes("error", 5000, "Error", "No se pudo conectar con el servidor.");
        }

    });
}

function consultarEliminadas() {

	var datos = new FormData();
	datos.append('consultar_eliminadas', 'consultar_eliminadas');

	enviaAjax(datos);
}

function TablaEliminados(arreglo) {

    if ($.fn.DataTable.isDataTable('#tablaEliminadas')) {

        $('#tablaEliminadas').DataTable().destroy();

    }

    $('#tablaEliminadas').DataTable({

        data: arreglo,
        columns: [
            {
                data: null, render: function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            { data: 'codigo_bien' },
			{ data: 'tipo_patch_panel' },
			{ data: 'cantidad_puertos' },
			{ data: 'serial' },
            {
                data: null,
                render: function () {
                    return `<button onclick="restaurarPatchPanel(this)" class="btn btn-success" title="Restaurar Patch Panel Eliminado">
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

async function restaurarPatchPanel(boton) {

	var confirmacion = false;
	var linea = $(boton).closest('tr');
	var codigo_bien = $(linea).find('td:eq(1)').text();

	confirmacion = await confirmarAccion("¿Restaurar Patch Panel?", "¿Está seguro que desea restaurar este Patch Panel?", "question");

    if (confirmacion) {

        var datos = new FormData();
        datos.append('restaurar', 'restaurar');
        datos.append('codigo_bien', codigo_bien);
        enviaAjax(datos);

    }

}

function limpia() {

	$("#codigo_bien").val("default");
	$("#tipo_patch_panel").val("");
	$("#cantidad_puertos").val("");
	$("#serial_patch_panel").val("");

	$('#codigo_bien').prop('disabled', false);
	$('#tipo_patch_panel').prop('disabled', false);
	$('#cantidad_puertos').prop('disabled', false);
	$('#serial_patch_panel').prop('disabled', false);

	$("#codigo_bien option.opcion_temporal").remove();

}

function rellenar(pos, accion) {

	limpia();
	
    let linea = $(pos).closest('tr');
    let codigoBien = $(linea).find("td:eq(0)").text().trim();

    if ($("#codigo_bien option[value='" + codigoBien + "']").length === 0) {
        $("#codigo_bien").append(
            $("<option>", {
                value: codigoBien,
               	text: codigoBien,
            	class: "opcion_temporal"
            })
        );
    }

    $("#codigo_bien").val(codigoBien);


	$("#cantidad_puertos").val($(linea).find("td:eq(1)").text());
	$("#tipo_patch_panel").val($(linea).find("td:eq(2)").text());
	$("#serial_patch_panel").val($(linea).find("td:eq(3)").text());

	if (accion == 0) {

		$('#codigo_bien').prop('disabled', true);
		$('#tipo_patch_panel').prop('disabled', false);
		$('#cantidad_puertos').prop('disabled', false);
		$('#serial_patch_panel').prop('disabled', false);
		$("#modalTitleId").text("Modificar Patch Panel")
		$("#enviar").attr("title", "Modificar Patch Panel");
		$("#enviar").text("Modificar");
	}
	else {
		$('#codigo_bien').prop('disabled', true);
		$('#tipo_patch_panel').prop('disabled', true);
		$('#cantidad_puertos').prop('disabled', true);
		$('#serial_patch_panel').prop('disabled', true);
		$("#modalTitleId").text("Eliminar Patch Panel")
		$("#enviar").attr("title", "Eliminar Patch Panel");
		$("#enviar").text("Eliminar");
	}

	$('#enviar').prop('disabled', false);
	$("#modal1").modal("show");

}
