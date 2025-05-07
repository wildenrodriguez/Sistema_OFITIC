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
					datos.append('direccion', $("#direccion").val());
					enviaAjax(datos);
				}
				break;
			case "Modificar":
				if (validarenvio()) {
					var datos = new FormData();
					datos.append('modificar', 'modificar');
					datos.append('id_edificio', $("#id_edificio").val());
					datos.append('nombre', $("#nombre").val());
					datos.append('direccion', $("#direccion").val());
					enviaAjax(datos);
				}
				break;
			case "Eliminar":
				if (validarenvio()) {
					var datos = new FormData();
					datos.append('eliminar', 'eliminar');
					datos.append('id_edificio', $("#id_edificio").val());
					enviaAjax(datos);
				}
				break;

			default:
				mensajes("question", 10000, "Error", "Acción desconocida: " + $(this).text());;
		}

	});

	$("#btn-registrar").on("click", function () { //<---- Evento del Boton Registrar
		limpia();
		$("#idEdificio").remove();
		$("#modalTitleId").text("Registrar Edificio");
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
					iniciarTabla(lee.datos);

				} else if (lee.resultado == "modificar") {
					$("#modal1").modal("hide");
					mensajes("success", 10000, lee.mensaje, null);
					consultar();

				} else if (lee.resultado == "eliminar") {
					$("#modal1").modal("hide");
					mensajes("success", 10000, lee.mensaje, null);
					consultar();

				} else if(lee.resultado == "entrada") {

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
			"El nombre del edificio debe tener de 4 a 45 carácteres"
		);
	});

	$("#direccion").on("keypress", function (e) {
		validarKeyPress(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.\b]*$/, e);
	});
	$("#direccion").on("keyup", function () {
		validarKeyUp(/^[0-9 a-zA-ZáéíóúüñÑçÇ -./#]{10,100}$/, $(this), $("#sdireccion"),
			"La dirección del edificio debe tener de 10 a 100 carácteresLa dirección del edificio debe tener de 10 a 100 carácteres"
		);
	});
}

function validarenvio() {
	//OJO TAREA, AGREGAR LA VALIDACION DEL nro	
	if (validarKeyUp(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{3,45}$/, $("#nombre"), $("#snombre"), "") == 0) {
		mensajes("error", 10000, "Verifica", "El nombre del edificio debe tener de 4 a 45 carácteres");
		return false;

	} else if (validarKeyUp(/^[0-9 a-zA-ZáéíóúüñÑçÇ -./#]{10,100}$/, $("#direccion"), $("#sdireccion"), "") == 0) {
		mensajes("error", 10000, "Verifica", "La dirección del edificio debe tener de 10 a 100 carácteres");
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
			{ data: 'ubicacion' },
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
		$("#modalTitleId").text("Modificar Edificio")
		$("#enviar").text("Modificar");
	}
	else {
		$("#modalTitleId").text("Eliminar Edificio")
		$("#enviar").text("Eliminar");
	}
	$("#modal1").modal("show");
}