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
					datos.append('tipo_equipo', $("#tipo_equipo").val());
					datos.append('serial', $("#serial").val());
					datos.append('codigo_bien', $("#codigo_bien").val());
					datos.append('id_unidad', $("#id_unidad").val());
					enviaAjax(datos);
				}
				break;
			case "Modificar":
				if (validarenvio()) {
					var datos = new FormData();
					datos.append('modificar', 'modificar');
					datos.append('id_equipo', $("#id_equipo").val());
					datos.append('tipo_equipo', $("#tipo_equipo").val());
					datos.append('serial', $("#serial").val());
					datos.append('codigo_bien', $("#codigo_bien").val());
					datos.append('id_unidad', $("#id_unidad").val());
					enviaAjax(datos);
				}
				break;
			case "Eliminar":
				if (validarenvio()) {
					var datos = new FormData();
					datos.append('eliminar', 'eliminar');
					datos.append('id_equipo', $("#id_equipo").val());
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
		$("#id_equipo").parent().parent().remove();
        $("#tipo_equipo").parent().parent().show();
        $("#serial").parent().parent().show();
        $("#codigo_bien").parent().parent().show();
        $("#id_unidad").parent().parent().show();
		$("#modalTitleId").text("Registrar Equipo");
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
	$("#tipo_equipo").on("keypress", function (e) {
		validarKeyPress(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.\b]*$/, e);
	});
	$("#tipo_equipo").on("keyup", function () {
		validarKeyUp(
			/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{3,45}$/, $(this), $("#stipo_equipo"),
			"El tipo de equipo debe tener de 3 a 45 carácteres"
		);
	});

	$("#serial").on("keypress", function (e) {
		validarKeyPress(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.\b]*$/, e);
	});
	$("#serial").on("keyup", function () {
		validarKeyUp(
			/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{3,45}$/, $(this), $("#sserial"),
			"El serial debe tener de 3 a 45 carácteres"
		);
	});

	$("#codigo_bien").on("change", function () {
		if ($(this).val() == "") {
			$(this).addClass("is-invalid");
			$(this).removeClass("is-valid");
			$("#scodigo_bien").addClass("invalid-feedback");
			$("#scodigo_bien").removeClass("valid-feedback");
			$("#scodigo_bien").text("Debe seleccionar un código de bien");
		} else {
			$(this).addClass("is-valid");
			$(this).removeClass("is-invalid");
			$("#scodigo_bien").addClass("valid-feedback");
			$("#scodigo_bien").removeClass("invalid-feedback");
			$("#scodigo_bien").text("");
		}
	});

	$("#id_unidad").on("change", function () {
		if ($(this).val() == "") {
			$(this).addClass("is-invalid");
			$(this).removeClass("is-valid");
			$("#sid_unidad").addClass("invalid-feedback");
			$("#sid_unidad").removeClass("valid-feedback");
			$("#sid_unidad").text("Debe seleccionar una unidad");
		} else {
			$(this).addClass("is-valid");
			$(this).removeClass("is-invalid");
			$("#sid_unidad").addClass("valid-feedback");
			$("#sid_unidad").removeClass("invalid-feedback");
			$("#sid_unidad").text("");
		}
	});
}

function validarenvio() {
	if (validarKeyUp(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{3,45}$/, $("#tipo_equipo"), $("#stipo_equipo"), "") == 0) {
		mensajes("error", 10000, "Verifica", "El tipo de equipo debe tener de 3 a 45 carácteres");
		return false;

	} else if (validarKeyUp(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{3,45}$/, $("#serial"), $("#sserial"), "") == 0) {
		mensajes("error", 10000, "Verifica", "El serial debe tener de 3 a 45 carácteres");
		return false;

	} else if ($("#codigo_bien").val() == "") {
		mensajes("error", 10000, "Verifica", "Debe seleccionar un código de bien");
		return false;

	} else if ($("#id_unidad").val() == "") {
		mensajes("error", 10000, "Verifica", "Debe seleccionar una unidad");
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
			{ data: 'id_equipo' },
			{ data: 'tipo_equipo' },
			{ data: 'serial' },
			{ data: 'codigo_bien' },
			{ data: 'nombre_unidad' },
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
	$("#tipo_equipo").removeClass("is-valid is-invalid");
	$("#tipo_equipo").val("");

	$("#serial").removeClass("is-valid is-invalid");
	$("#serial").val("");

	$("#codigo_bien").removeClass("is-valid is-invalid");
	$("#codigo_bien").val("");

	$("#id_unidad").removeClass("is-valid is-invalid");
	$("#id_unidad").val("");

	$('#enviar').prop('disabled', false);
}

function rellenar(pos, accion) {
	linea = $(pos).closest('tr');

	if (!$("#id_equipo").length) {
		$("#Fila1").prepend(`<div class="col-4">
            <div class="form-floating mb-3 mt-4">
                <input placeholder="" class="form-control" name="id_equipo" type="text" id="id_equipo" readonly>
                <span id="sid_equipo"></span>
                <label for="id_equipo" class="form-label">ID Equipo</label>
            </div>`);
	}

	$("#id_equipo").val($(linea).find("td:eq(0)").text());
	$("#tipo_equipo").val($(linea).find("td:eq(1)").text());
	$("#serial").val($(linea).find("td:eq(2)").text());
	
	$("#codigo_bien").val($(linea).find("td:eq(3)").text());
	$("#codigo_bien").trigger("change");
	
	$("#id_unidad option").each(function() {
		if ($(this).text() == $(linea).find("td:eq(4)").text()) {
			$(this).prop("selected", true);
			$("#id_unidad").trigger("change");
			return false;
		}
	});

	if (accion == 0) {
		$("#modalTitleId").text("Modificar Equipo")
		$("#enviar").text("Modificar");
	}
	else {
		$("#modalTitleId").text("Eliminar Equipo")
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
      beforeSend: function() {},
      timeout: 10000,
      success: function(respuesta) {
          try {
              var lee = JSON.parse(respuesta);
              if (lee.resultado == "consultar_eliminadas") {
                  if ($.fn.DataTable.isDataTable('#tablaEliminadas')) {
                      $('#tablaEliminadas').DataTable().destroy();
                  }
                  
                  $('#tablaEliminadas').DataTable({
                      data: lee.datos,
                      columns: [
                          { data: 'id_equipo' },
                          { data: 'tipo_equipo' },
                          { data: 'serial' },
                          { data: 'codigo_bien' },
                          { data: 'nombre_unidad' },
                          
                          {
                              data: null, 
                              render: function() {
                                  return `<button onclick="restaurarEquipo(this)" class="btn btn-success">
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
      error: function(request, status, err) {
          mensajes("error", null, "Error al cargar equipos eliminados", "Intente nuevamente");
      }
  });
}

function restaurarEquipo(boton) {
    var linea = $(boton).closest('tr');
    var id = $(linea).find('td:eq(0)').text();
    
    Swal.fire({
        title: '¿Restaurar Equipo?',
        text: "¿Está seguro que desea restaurar este equipo?",
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
            datos.append('id_equipo', id);
            
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
                            mensajes("success", null, "Equipo restaurado", lee.mensaje);
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
                    mensajes("error", null, "Error", "No se pudo restaurar el equipo");
                }
            });
        }
    });
}