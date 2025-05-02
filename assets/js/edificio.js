$(document).ready(function () {
	consultar();
	registrarEntrada();

	$("#motivo").on("keypress", function (e) {
		validarKeyPress(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.\b]*$/, e);
	});
	$("#motivo").on("keyup", function () {
		validarKeyUp(
			/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{3,30}$/,
			$(this),
			$("#smotivo"),
			"El motivo debe tener entre 3 y 30 caracteres"
		);
	});

	$("#solicitar").on("click", function () {
		switch ($(this).text()) {

			case "Enviar":
				if (validarenvio()) {
					var datos = new FormData();
					datos.append('solicitud', '');
					datos.append('motivo', $("#motivo").val());
					enviaAjax(datos);
				}

				break;

			default:
				mensajes("question", 10000, "Error", "Acción desconocida: " + $(this).text());;
		}

	});

	$("#btn-solicitud").on("click", function () { //<---- Evento del Boton Registrar
		limpia();
		$("#modalTitleId").text("Crear Solicitud");
		$("#solicitar").text("Enviar");
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
					mensajes("success", 10000, "Se envió la solicitud exitosamente", null);
					consultar();

				} else if (lee.resultado == "consultar") {
					iniciarTabla(lee.datos);

				} else if (lee.resultado == "entrada") {


				} else if (lee.resultado == "error") {
					mensajes("error", null, lee.mensaje, null);
				}
			} catch (e) {
				mensajes("error", null, "Error en JSON Tipo: " + e.name + "\n" +
					"Mensaje: " + e.message + "\n" +
					"Posición: " + e.lineNumber + ":" + e.columnNumber + "\n" +
					"Stack: " + e.stack, null);
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


function validarenvio() {
	//OJO TAREA, AGREGAR LA VALIDACION DEL nro	
	if (validarKeyUp(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{3,30}$/, $("#motivo"),
		$("#smotivo"), "El motivo debe de tener 3 letras minimo") == 0) {
		mensajes("error", 10000, "Verifica", "El motivo debe tener entre 3 y 30 caracteres");
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
					return '<button onclick=rellenar(this, 2) class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button><button onclick=rellenar(this, 3) class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>';
				}
			}],
		language: {
			url: idiomaTabla,
		}
	});

}


function limpia() {
	$("#motivo").last().removeClass("is-valid");
	$("#motivo").last().removeClass("is-invalid");
	$("#motivo").val("");
}