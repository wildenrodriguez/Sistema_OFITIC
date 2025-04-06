$(document).ready(function(){

	$(".registrar").prop("disabled", true);

	$("#falla").on("keypress",function(e){
		validarKeyPress(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.\b]*$/, e);
	});
	$("#falla").on("keyup", function () {
      validarKeyUp(
        /^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{3,200}$/,
        $(this),
        $("#sfalla"),
        "El motivo debe tener entre 3 y 200 caracteres"
      ); 
	  habilitarBotonRegistrar1();
    });	

	
	
	//Manejador de eventos para los botones
	//Se muestra el de incluir, agregar el resto
	$("#solicitar").on("click",function(){
		if(validarenvio()){
			var datos = new FormData();
			datos.append('solicitud','');
			datos.append('motivo',$("#falla").val());
			enviaAjax(datos);
		}
	});
	
	
	
});

function enviaAjax(datos) {
	$.ajax({
	  async: true,
	  url: "",
	  type: "POST",
	  dataType: "json",
	  contentType: false,
	  data: datos,
	  processData: false,
	  cache: false,
	  beforeSend: function () {},
	  timeout: 10000, //tiempo maximo de espera por la respuesta del servidor
	  success: function (respuesta) {
		console.log(respuesta);
		try {
		  var data = JSON.parse(respuesta);
		  var tr = $(document.createElement("tr"));
		  // Agrega el HTML al elemento tr
		  tr.html(data);
		  // Agrega el elemento tr a la tabla
		  $("#tabla").append(tr);
		} catch (e) {
		  alert("Error en JSON " + e.name);
		}
	  },
	  error: function (request, status, err) {
		if (status == "timeout") {
		  muestraMensaje("Servidor ocupado, intente de nuevo");
		} else {
		  muestraMensaje("ERROR: <br/>" + request + status + err);
		}
	  },
	  complete: function () {},
	});
  }
	

function validarenvio(){
//OJO TAREA, AGREGAR LA VALIDACION DEL nro	
	if(validarKeyUp(
        /^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{3,30}$/,
        $("#falla"),
        $("#sfalla"),
        "El motivo debe de tener 3 letras minimo"
      )==0)
	  {
		  alert("Verifique el motivo");
		  return false;
	} 
	
	
	return true;
}


function validarKeyPress(er, e) {
  key = e.keyCode;
  tecla = String.fromCharCode(key);
  a = er.test(tecla);
  if (!a) {
    e.preventDefault();
  }
}

function validarKeyUp(er, etiqueta, etiquetamensaje, mensaje) {
	a = er.test(etiqueta.val());
	if (a) {
	  // Si el contenido es válido, verificamos la longitud
	  if (etiqueta.val().length >= 3 && etiqueta.val().length <= 200) {
		etiquetamensaje.text("");
		return 1;
	  } else {
		// La longitud no está dentro del rango permitido
		etiquetamensaje.text("El motivo debe tener entre 3 y 200 caracteres");
		return 0;
	  }
	} else {
	  // El contenido no cumple con la expresión regular
	  etiquetamensaje.text(mensaje);
	  return 0;
	}
  }

function habilitarBotonRegistrar1() {
	$(".registrar").prop("disabled", $("#falla").val().trim() === "" || $("#falla").val().length <= 2 );
  }