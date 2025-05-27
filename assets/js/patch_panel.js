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
					consultar();

				} else if (lee.resultado == "consultar") {

					crearDataTable(lee.datos);

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

	$('#codigo_bien').on('change blur input focusout mouseleave', function () {

		const obj = validarSelect();

		if (obj.bool === 0) { }
	})

	$('#codigo_bien').on('change blur input focusout mouseleave', function () {

		const obj = validarSelect();

		if (obj.bool === 0) { }
	});
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
			{
				data: null, render: function () {
					const botones = `<button onclick="rellenar(this, 0)" class="btn btn-update"><i class="fa-solid fa-pen-to-square"></i></button>
					<button onclick="rellenar(this, 1)" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>`;
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


function limpia() {
	/*

	$("#codigo_bien").removeClass("is-valid is-invalid");
	$("#codigo_bien option:first-child").prop('selected', true);
	$("#scodigo_bien").val("");
	$('#codigo_bien').prop('disabled', false);
	*/

	$("#div_codigo_oculto").css("display", "none");
	$("#codigo_bien_a").attr("id", "codigo_bien");
	$("#codigo_bien").attr("id", "codigo_bien_oculto").prop('readonly', false);
	$("#codigo_visible").css("display", "block");

	$('#tipo_patch_panel').prop('disabled', false);
	$('#cantidad_puertos').prop('disabled', false);

	
}


function rellenar(pos, accion) {
	
	linea = $(pos).closest('tr');

	


	//buscarSelect('#codigo_bien', $(linea).find("td:eq(0)").text(), "value");

	$("#div_codigo_oculto").css("display", "block");
	$("#codigo_bien").attr("id", "codigo_bien_a");
	$("#codigo_bien_oculto").attr("id", "codigo_bien").prop('readonly', true).val($(linea).find("td:eq(0)").text());
	$("#codigo_visible").css("display", "none");



	$("#cantidad_puertos").val($(linea).find("td:eq(1)").text());
	$("#tipo_patch_panel").val($(linea).find("td:eq(2)").text());

	if (accion == 0) {

		//$('#codigo_bien').prop('disabled', true);
		$('#tipo_patch_panel').prop('disabled', false);
		$('#cantidad_puertos').prop('disabled', false);
		$("#modalTitleId").text("Modificar Patch Panel")
		$("#enviar").text("Modificar");
	}
	else {
		//$('#codigo_bien').prop('disabled', true);
		$('#tipo_patch_panel').prop('disabled', true);
		$('#cantidad_puertos').prop('disabled', true);
		$("#modalTitleId").text("Eliminar Patch Panel")
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
		beforeSend: function () { },
		timeout: 10000,
		success: function (respuesta) {

			try {

				var lee = JSON.parse(respuesta);

				if (lee.resultado == "consultar_eliminadas") {

					if ($.fn.DataTable.isDataTable('#tablaEliminadas')) {
						$('#tablaEliminadas').DataTable().destroy();
					}

					$('#tablaEliminadas').DataTable({

						data: lee.datos,
						columns: [
							{ data: 'codigo_bien' },
							{ data: 'tipo_patch_panel' },
							{ data: 'cantidad_puertos' },
							{
								data: null,
								render: function () {
									return `<button onclick="restaurarPatchPanel(this)" class="btn btn-success">
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
		error: function (request, status, err) {

			mensajes("error", null, "Error al cargar Patch Panel eliminados", "Intente nuevamente");

		}
	});
}


function restaurarPatchPanel(boton) {

	var linea = $(boton).closest('tr');
	var id = $(linea).find('td:eq(0)').text();

	Swal.fire({

		title: '¿Restaurar Patch Panel?',
		text: "¿Está seguro que desea restaurar este Patch Panel?",
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
			datos.append('codigo_bien', id);

			$.ajax({

				url: "",
				type: "POST",
				data: datos,
				processData: false,
				contentType: false,
				success: function (respuesta) {

					try {

						var lee = JSON.parse(respuesta);

						if (lee.estado == 1) {

							mensajes("success", null, "Patch Panel Restaurado", lee.mensaje);
							consultarEliminadas();
							consultar();

						} else {

							mensajes("error", null, "Error", lee.mensaje);

						}

					} catch (e) {

						mensajes("error", null, "Error", "Error procesando la respuesta");

					}
				},
				error: function () {

					mensajes("error", null, "Error", "No se pudo restaurar el Patch Panel");

				}
			});
		}
	});

}