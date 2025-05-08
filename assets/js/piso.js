$(document).ready(function () {
	consultar();
	datosEdificio();
	registrarEntrada();
	capaValidar();

	$("#enviar").on("click", function () {
		switch ($(this).text()) {

			case "Registrar":
				if (validarenvio()) {
					var datos = new FormData();
					datos.append('registrar', 'registrar');
					datos.append('id_edificio', $("#id_edificio").val());
					datos.append('tipo_piso', $("#tipo_piso").val());
					datos.append('nro_piso', $("#nro_piso").val());
					enviaAjax(datos);
				}
				break;
			case "Modificar":
				if (validarenvio()) {
					var datos = new FormData();
					datos.append('modificar', 'modificar');
					datos.append('id_edificio', $("#id_edificio").val());
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
		$("#idEdificio").remove();
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

				} else if (lee.resultado == "lista_edificio") {
					selectEdificio(lee.datos);

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
	$('#id_edificio').on('change blur', function () {
		if ($(this).val() === 'null') {
			$(this).removeClass("is-valid");
			$(this).addClass("is-invalid");
			$('#sid_edificio').removeClass("valid-feedback");
			$('#sid_edificio').addClass("invalid-feedback");
			$('#sid_edificio').text("Debe seleccionar un edificio");
		} else {
			$(this).removeClass("is-invalid");
			$(this).addClass("is-valid")
			$('#sid_edificio').removeClass("invalid-feedback");
			$('#sid_edificio').addClass("valid-feedback");
			$('#sid_edificio').text("");
		}
	});

	$('#tipo_piso').on('change blur input focusout mouseleave', function () {
		;

		const obj = validarSelect();

		if (obj.bool === 0) { }
	})

	$('#nro_piso').on('change blur input focusout mouseleave', function () {
		;

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

	if ($("#id_edificio").val() === 'null') {
		mensajes("error", 10000, "Verifica", "Debe seleccionar un edificio");
		return false;

	} else if (obj.bool == 0) {
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
			{ data: 'id_edificio' },
			{ data: 'nombre' },
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
			[4, 'asc']   
		],
		language: {
			url: idiomaTabla,
		}
	});
}

function selectEdificio(arreglo) {
	$("#id_edificio").empty();

	$("#id_edificio").append(
		new Option('Seleccione un Edificio', null)
	);
	arreglo.forEach(item => {
		$("#id_edificio").append(
			new Option(item.nombre, item.id_edificio)
		);
	});
}

function limpia() {
	$("#nombre").removeClass("is-valid is-invalid");
	$("#nombre").val("");

	$("#direccion").removeClass("is-valid is-invalid");
	$("#direccion").val("");

	$('#enviar').prop('disabled', false);
}


function rellenar(pos, accion) {

	linea = $(pos).closest('tr');

	$("#idEdificio").remove();
	$("#Fila1").prepend(`<div class="col-4" id="idEdificio">
            <div class="form-floating mb-3 mt-4">
              <input placeholder="" class="form-control" name="id_edificio" type="text" id="id_edificio" readOnly>
              <span id="sid_edificio"></span>
              <label for="id_edificio" class="form-label">ID del Edificio</label>
            </div>`);


	$("#id_edificio").val($(linea).find("td:eq(0)").text());
	$("#nombre").val($(linea).find("td:eq(1)").text());
	$("#direccion").val($(linea).find("td:eq(2)").text());


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