$(document).ready(function () {
	consultar();
	registrarEntrada();
	capaValidar();
	cargarCargo();
	cargarDependencia();

	$("#enviar").on("click", function () {
		switch ($(this).text()) {

			case "Registrar":
				if (validarenvio()) {
					var datos = new FormData();
					datos.append('registrar', 'registrar');
					datos.append('cedula', $("#cedula").val());
					datos.append('nombre', $("#nombre").val());
					datos.append('apellido', $("#apellido").val());
					datos.append('telefono', $("#telefono").val());
					datos.append('correo', $("#correo").val());
					datos.append('unidad', $("#unidad").val());
					datos.append('cargo', $("#cargo").val());
					enviaAjax(datos);
				}
				break;
			case "Modificar":
				if (validarenvio()) {
					var datos = new FormData();
					datos.append('modificar', 'modificar');
					datos.append('cedula', $("#cedula").val());
					datos.append('nombre', $("#nombre").val());
					datos.append('apellido', $("#apellido").val());
					datos.append('telefono', $("#telefono").val());
					datos.append('correo', $("#correo").val());
					datos.append('unidad', $("#unidad").val());
					datos.append('cargo', $("#cargo").val());
					enviaAjax(datos);
				}
				break;
			case "Eliminar":
				if (validarenvio()) {
					var datos = new FormData();
					datos.append('eliminar', 'eliminar');
					datos.append('cedula', $("#cedula").val());
					enviaAjax(datos);
				}
				break;

			default:
				mensajes("question", 10000, "Error", "Acción desconocida: " + $(this).text());;
		}
		$('#enviar').prop('disabled', true);
	});

	$("#btn-registrar").on("click", function () { //<---- Evento del Boton Registrar
		limpia();
		$("#idEmpleado").remove();
		$("#modalTitleId").text("Registrar Empleado");
		$("#enviar").text("Registrar");
		$("#modal1").modal("show");
	}); //<----Fin Evento del Boton Registrar
});

function cargarDependencia() {
	var datos = new FormData();
	datos.append('cargar_dependencia', 'cargar_dependencia');
	enviaAjax(datos);
};

async function cargarUnidad(parametro = 0) {
	var datos = new FormData();
	datos.append('cargar_unidad', 'cargar_unidad');
	datos.append('id_dependencia', parametro);
	await enviaAjax(datos);
	return true;
};

function cargarCargo() {
	var datos = new FormData();
	datos.append('cargar_cargo', 'cargar_cargo')
	enviaAjax(datos);
};

async function enviaAjax(datos) {
	return await $.ajax({
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

				} else if (lee.resultado == "cargar_unidad") {
					selectUnidad(lee.datos);

				} else if (lee.resultado == "cargar_dependencia") {
					selectDependencia(lee.datos);

				} else if (lee.resultado == "cargar_cargo") {
					selectCargo(lee.datos);

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



function selectCargo(arreglo) {
	$("#cargo").empty();
	if (Array.isArray(arreglo) && arreglo.length > 0) {

		$("#cargo").append(
			new Option('Seleccione un Cargo', 'default')
		);
		arreglo.forEach(item => {
			$("#cargo").append(
				new Option(item.nombre_cargo, item.id_cargo)
			);
		});
	} else {
		$("#cargo").append(
			new Option('No Hay Cargos', 'default')
		);
	}
}

function selectDependencia(arreglo) {
	$("#dependencia").empty();
	if (Array.isArray(arreglo) && arreglo.length > 0) {

		$("#dependencia").append(
			new Option('Seleccione una Dependencia', 'default')
		);
		arreglo.forEach(item => {
			$("#dependencia").append(
				new Option(item.ente + " - " + item.nombre, item.id)
			);
		});
	} else {
		$("#dependencia").append(
			new Option('No Hay Dependencias', 'default')
		);
	}
}

async function selectUnidad(arreglo) {
	$("#unidad").removeClass("is-valid is-invalid");
	$("#unidad").val("");
	$("#unidad").empty();
	if (Array.isArray(arreglo) && arreglo.length > 0) {

		$("#unidad").append(
			new Option('Seleccione una Unidad', 'default')
		);
		arreglo.forEach(item => {
			$("#unidad").append(
				new Option(item.nombre_unidad, item.id_unidad)
			);
		});
	} else {
		$("#unidad").append(
			new Option('No hay unidades en esta dependencia', 'default')
		);
		estadoSelect("#unidad", "#sunidad", "", 0);
	}
	return true;
}

function capaValidar() {


	$("#cedula").on("keypress", function (e) {
		validarKeyPress(/^[-0-9V\B]*$/, e);
	});
	$("#cedula").on("keyup", function () {
		validarKeyUp(
			/^[V]{1}[-]{1}[0-9]{7,10}$/, $(this), $("#scedula"),
			"Cédula no válida, el formato es: V-**********"
		);
	});

	$("#nombre").on("keypress", function (e) {
		validarKeyPress(/^[0-9 a-zA-ZáéíóúüñÑçÇ\b]*$/, e);
	});
	$("#nombre").on("keyup", function () {
		validarKeyUp(
			/^[0-9 a-zA-ZáéíóúüñÑçÇ]{4,45}$/, $(this), $("#snombre"),
			"El nombre debe tener de 4 a 45 carácteres"
		);
	});

	$("#apellido").on("keypress", function (e) {
		validarKeyPress(/^[0-9 a-zA-ZáéíóúüñÑçÇ\b]*$/, e);
	});
	$("#apellido").on("keyup", function () {
		validarKeyUp(
			/^[0-9 a-zA-ZáéíóúüñÑçÇ]{4,45}$/, $(this), $("#sapellido"),
			"El apellido debe tener de 4 a 45 carácteres"
		);
	});

	$("#correo").on("keypress", function (e) {
		validarKeyPress(/^[-0-9a-z_.@\b]*$/, e);
	});
	$("#correo").on("keyup", function () {
		validarKeyUp(
			/^[-0-9a-zç_]{4,15}[@]{1}[0-9a-z]{5,10}[.]{1}[com]{3}$/, $(this), $("#scorreo"),
			"El formato del correo electrónico es: usuario@servidor.com"
		);
	});

	$("#telefono").on("keypress", function (e) {
		validarKeyPress(/^[-0-9\b]*$/, e);
	});
	$("#telefono").on("keyup", function () {
		validarKeyUp(
			/^[0-9]{4}[-]{1}[0-9]{10}$/, $(this), $("#stelefono"),
			"El numero de teléfono debe tener el siguiente formato: ****-*******"
		);
	});

	$("#cargo").on("change", function () {
		if ($(this).val() == "default") {
			estadoSelect(this, "#scargo", "Debe seleccionar un cargo", 0);
		} else {
			estadoSelect(this, "#scargo", "", 1);
		}
	});

	$("#dependencia").on("change", function () {
		if ($(this).val() == "default") {
			estadoSelect(this, "#sdependencia", "Debe seleccionar una dependencia", 0);
			estadoSelect("#unidad", "#sunidad", "", 0);
			cargarUnidad(0);
		} else {
			estadoSelect(this, "sid_dependencia", "", 1);
			cargarUnidad($(this).val());
		}
	});

	$("#unidad").on("change", function () {
		if ($(this).val() == "default") {
			estadoSelect(this, "#sunidad", "Debe seleccionar una unidad", 0);
		} else {
			estadoSelect(this, "#sunidad", "", 1);
		}
	});

}

function validarenvio() {
	//OJO TAREA, AGREGAR LA VALIDACION DEL nro	
	if (validarKeyUp(/^[V]{1}[-]{1}[0-9]{7,10}$/, $("#cedula"), $("#scedula"), "") == 0) {
		mensajes("error", 10000, "Verifica", "Cédula no válida, el formato es: V-**********");
		return false;

	} else if (validarKeyUp(/^[0-9 a-zA-ZáéíóúüñÑçÇ.]{4,45}$/, $("#nombre"), $("#snombre"), "") == 0) {
		mensajes("error", 10000, "Verifica", "El nombre del empleado debe tener de 4 a 45 carácteres");
		return false;

	} else if (validarKeyUp(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{4,45}$/, $("#apellido"), $("#sapellido"), "") == 0) {
		mensajes("error", 10000, "Verifica", "El apellido debe tener de 4 a 45 carácteres");
		return false;

	} else if (validarKeyUp(/^[0-9]{4}[-]{1}[0-9]{10}$/, $("#telefono"), $("#stelefono"), "") == 0) {
		mensajes("error", 10000, "Verifica", "El numero de teléfono debe tener el siguiente formato: ****-*******");
		return false;

	} else if (validarKeyUp(/^[-0-9a-zç_]{4,15}[@]{1}[0-9a-z]{5,10}[.]{1}[com]{3}$/, $("correo"), $("#scorreo"), "") == 0) {
		mensajes("error", 10000, "Verifica", "El formato del correo electrónico es: usuario@servidor.com");
		return false;

	} else if ($("#dependencia").val() == "default") {
		mensajes("error", 10000, "Verifica", "Debe seleccionar una dependencia");
		return false;

	} else if ($("#unidad").val() == "default") {
		mensajes("error", 10000, "Verifica", "Debe seleccionar una unidad");
		return false;

	} else if ($("#cargo").val() == "default") {
		mensajes("error", 10000, "Verifica", "Debe seleccionar un cargo");
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
			{ data: 'cedula' },
			{ data: 'nombre' },
			{ data: 'apellido' },
			{ data: 'telefono' },
			{ data: 'correo' },
			{ data: 'dependencia' },
			{ data: 'unidad' },
			{ data: 'cargo' },
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
	$("#nombre").removeClass("is-valid is-invalid");
	$("#nombre").val("");

	$("#direccion").removeClass("is-valid is-invalid");
	$("#direccion").val("");

	$('#enviar').prop('disabled', false);
}

async function rellenar(pos, accion) {

	var espera;
	linea = $(pos).closest('tr');

	$("#cedula").val($(linea).find("td:eq(0)").text());
	$("#nombre").val($(linea).find("td:eq(1)").text());
	$("#apellido").val($(linea).find("td:eq(2)").text());
	$("#telefono").val($(linea).find("td:eq(3)").text());
	$("#correo").val($(linea).find("td:eq(4)").text());
	buscarSelect('#dependencia', $(linea).find("td:eq(5)").text(), 'text');

	espera = await cargarUnidad($('#dependencia').val());

	if (espera) {
		buscarSelect('#unidad', $(linea).find("td:eq(6)").text(), 'text');
	}

	buscarSelect('#cargo', $(linea).find("td:eq(7)").text(), 'text');


	if (accion == 0) {
		$("#modalTitleId").text("Modificar Empleado")
		$("#enviar").text("Modificar");
	}
	else {
		$("#modalTitleId").text("Eliminar Empleado")
		$("#enviar").text("Eliminar");
	}
	$('#enviar').prop('disabled', false);
	$("#modal1").modal("show");
}