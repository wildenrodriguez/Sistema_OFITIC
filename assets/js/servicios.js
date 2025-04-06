$(document).ready(function(){

	$("#falla").on("keypress",function(e){
		validarKeyPress(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.\b]*$/, e);
	});
	$("#falla").on("keyup", function () {
      validarKeyUp(
        /^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{3,200}$/,
        $(this),
        $("#sfalla"),
        "El motivo debe tener 3 letras minimo"
      ); 
    });	

	
	
	//Manejador de eventos para los botones
	//Se muestra el de incluir, agregar el resto
	$("#incluir").on("click",function(){
		//Se llama a validar envio
		//Si retorna true
        //Se coloca el valor en input accion y se envia
		//con $("#id formulario").submit
		//en el controlador de esta pagina
		// ustedes deben leer el envio $_POST
		// de esta forma
		/**
		if(!empty($_POST)){
		  
		  
		  $accion = $_POST['accion'];
		  
		  if($accion=='incluir'){
			//llamada al maetodo de incluir
		  }
		  elseif($accion=='modificar'){
			
			
		  }
		  elseif($accion=='eliminar'){
			
			
		  }
		  elseif($accion=='consultar'){
			
			
		  }
		}
		**/
		if(validarenvio()){
			$("#accion").val("incluir");	
			$("#f").submit();
		}
	});
	
	
	
});

function validarenvio(){
//OJO TAREA, AGREGAR LA VALIDACION DEL nro	
	if(validarKeyUp(
        /^[0-9]{7,9}$/,
        $("#falla"),
        $("#sfalla"),
        "El formato es invalido"
      )==0)
	  {
		  alert("Verifique la falla de identidad");
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
    etiquetamensaje.text("");
    return 1;
  } else {
    etiquetamensaje.text(mensaje);
    return 0;
  }
}