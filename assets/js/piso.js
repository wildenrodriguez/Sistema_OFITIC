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
					datos.append('tipo_piso', $("#tipo_piso").val());
					datos.append('nro_piso', $("#nro_piso").val());
					enviaAjax(datos);
				}
				break;
			case "Modificar":
				if (validarenvio()) {
					var datos = new FormData();
					datos.append('modificar', 'modificar');
					datos.append('id_piso', $("#id_piso").val());
					datos.append('tipo_piso', $("#tipo_piso").val());
					datos.append('nro_piso', $("#nro_piso").val());
					enviaAjax(datos);
				}
				break;
			case "Eliminar":
				if (validarenvio()) {
					var datos = new FormData();
					datos.append('eliminar', 'eliminar');
					datos.append('id_piso', $("#id_piso").val());
					enviaAjax(datos);
				}
				break;

			default:
				mensajes("question", 10000, "Error", "Acción desconocida: " + $(this).text());;
		}
		if (!validarenvio()) {
			$('#enviar').prop('disabled', false);
		} else {
			$('#enviar').prop('disabled', true)
		};
	});

	$("#btn-registrar").on("click", function () { //<---- Evento del Boton Registrar
		limpia();
		$("#modalTitleId").text("Registrar Piso");
		$("#enviar").text("Registrar");
		$("#modal1").modal("show");
	}); //<----Fin Evento del Boton Registrar
});

function datosEdificio() {
	var datos = new FormData();
	datos.append('listar_edificio', 'listar_edificio');
	enviaAjax(datos);
};

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

	$('#tipo_piso').on('change blur input focusout mouseleave', function () {

		const obj = validarSelect();

		if (obj.bool === 0) { }
	})

	$('#nro_piso').on('change blur input focusout mouseleave', function () {

		const obj = validarSelect();

		if (obj.bool === 0) { }
	});
}

function validarSelect() {

	let bool = null;
	let mensaje = "";

	const validar = { bool, mensaje };

	if ($('#tipo_piso').val() === 'default') {

		estadoSelect('#tipo_piso', '#stipo_piso', "Seleccione un tipo de Piso", 0);
		estadoSelect('#nro_piso', '#snro_piso', "", 0);
		validar.bool = 0;
		validar.mensaje = "Seleccione un tipo de Piso";

	} else if ($('#nro_piso').val() === 'default') {

		estadoSelect('#nro_piso', '#snro_piso', "Seleccione un número de Piso", 0);
		validar.bool = 0;
		validar.mensaje = "Seleccione un número de Piso";
	}

	else if ($('#nro_piso').val() === '0' && $('#tipo_piso').val() != 'Planta Baja') {

		estadoSelect('#nro_piso', '#snro_piso', "", 0);
		estadoSelect('#tipo_piso', '#stipo_piso', "Solo Planta Baja empieza en 0", 0);

		validar.bool = 0;
		validar.mensaje = "Solo Planta Baja empieza en 0";

	} else if ($(nro_piso).val() != '0' && $('#tipo_piso').val() === 'Planta Baja') {

		estadoSelect('#nro_piso', '#snro_piso', "", 0);
		estadoSelect('#tipo_piso', '#stipo_piso', "Solo Planta Baja empieza en 0", 0);

		validar.bool = 0;
		validar.mensaje = "Solo Planta Baja empieza en 0";

	} else {

		estadoSelect('#nro_piso', '#snro_piso', "", 1);
		estadoSelect('#tipo_piso', '#stipo_piso', "", 1);

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

	console.log(arreglo);
	tabla = $('#tabla1').DataTable({
		data: arreglo,
		columns: [
			{ data: 'id_piso' },
			{ data: 'tipo_piso' },
			{ data: 'nro_piso' },
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
	$("#idPiso").remove();

	$("#id_edificio").removeClass("is-valid is-invalid");
	$("#id_edificio option:first-child").prop('selected', true);
	$("#sid_edificio").val("");

	$("#tipo_piso").removeClass("is-valid is-invalid");
	$("#tipo_piso option:first-child").prop('selected', true);
	$("#stipo_piso").val("");

	$("#nro_piso").removeClass("is-valid is-invalid");
	$("#nro_piso option:first-child").prop('selected', true);
	$("#snro_piso").val("");


	$('#enviar').prop('disabled', false);
}


function rellenar(pos, accion) {

	linea = $(pos).closest('tr');

	$("#idPiso").remove();
	$("#Fila1").prepend(`<div class="col-4" id="idPiso">
            <div class="form-floating mb-3">
              <input placeholder="" class="form-control" name="id_piso" type="text" id="id_piso" readOnly>
              <span id="sid_piso"></span>
              <label for="id_piso" class="form-label">ID del Piso</label>
            </div>`);

	var edificio = $(linea).find("td:eq(0)").text();
	if ($("#id_edificio option[value='" + edificio + "']").length > 0) {
		$("#id_edificio").val(edificio).change();
	} else {
		console.error("El valor '" + edificio + "' no se encuentra en el campo select.");
	}

	$("#id_piso").val($(linea).find("td:eq(2)").text());

	var tipo_piso = $(linea).find("td:eq(3)").text();
	if ($("#tipo_piso option[value='" + tipo_piso + "']").length > 0) {
		$("#tipo_piso").val(tipo_piso).change();
	} else {
		console.error("El valor '" + tipo_piso + "' no se encuentra en el campo select.");
	}

	var nro_piso = $(linea).find("td:eq(4)").text();
	if ($("#nro_piso option[value='" + nro_piso + "']").length > 0) {
		$("#nro_piso").val(nro_piso).change();
	} else {
		console.error("El valor '" + nro_piso + "' no se encuentra en el campo select.");
	}

	if (accion == 0) {
		$("#modalTitleId").text("Modificar Piso")
		$("#enviar").text("Modificar");
	}
	else {
		$("#modalTitleId").text("Eliminar Piso")
		$("#enviar").text("Eliminar");
	}
	$('#enviar').prop('disabled', false);
	$("#modal1").modal("show");
}