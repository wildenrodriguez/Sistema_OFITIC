$(document).ready(function () {
	registrarEntrada();
	consultar();
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
			////console.log(respuesta);
			try {
				var lee = JSON.parse(respuesta);
				console.log(lee);
				if (lee.resultado == "consultar") {
					iniciarTabla(lee.datos);

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

	////console.log(arreglo);
	tabla = $('#tabla1').DataTable({
		data: arreglo,
		order: [[0, "desc"]],
		columns: [
			{ data: 'id_bitacora'},
			{ data: 'usuario' },
			{ data: 'modulo' },
			{ data: 'accion_bitacora' },
			{ data: 'fecha' },
			{ data: 'hora' }
			
		],
		language: {
			url: idiomaTabla,
		}
	});

}