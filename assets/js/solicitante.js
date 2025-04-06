$(document).ready(function(){

  // Deshabilitar los botones al cargar la página
  $(".registrar").prop("disabled", true);

   $("#dependencia").on("change", function() {
        habilitarBotonRegistrar();
    });

  // Validaciones para el campo "nombre"
  $("#nombre").on("keypress", function(e){
    validarKeyPress(/^[a-zA-ZáéíóúüñÑçÇ -.\b]*$/, e);
  });

  $("#nombre").on("keyup", function () {
    validarKeyUp(
      /^[a-zA-ZáéíóúüñÑçÇ -.]{3,30}$/,
      $(this),
      $("#snombre"),
      "El nombre debe tener al menos 3 letras"
    ); 
    habilitarBotonRegistrar();
  });

  // Validaciones para el campo "apellido"
  $("#apellido").on("keypress", function(e){
    validarKeyPress(/^[a-zA-ZáéíóúüñÑçÇ -.\b]*$/, e);
  });

  $("#apellido").on("keyup", function () {
    validarKeyUp(
      /^[a-zA-ZáéíóúüñÑçÇ -.]{3,30}$/,
      $(this),
      $("#sapellido"),
      "El apellido debe tener al menos 3 letras"
    ); 
    habilitarBotonRegistrar();
  });

  // Validaciones para el campo "cedula"
  $("#cedula").on("keypress", function(e){
    validarKeyPress(/^[veVE0-9-\b]*$/,e);
  });

  $("#cedula").on("keyup", function () {
    $(this).val($(this).val().toUpperCase());
    validarKeyUp(/^[VE]{1}[-]{1}[0-9]{7,8}$/,$(this),
      $("#scedula"),
      "El formato debe ser con V- o E-12345678"
    );
    habilitarBotonRegistrar();
  });

  // Validaciones para el campo "telefono"
  $("#telefono").on("keypress", function(e){
    validarKeyPress(/^[0-9-.\b]*$/, e);
  });

  $("#telefono").on("keyup", function () {
    validarKeyUp(
      /^[0-9]{3,4}[-]{1}[0-9]{7,15}$/,
      $(this),
      $("#stelefono"),
      "El teléfono debe cumplir con el formato 0400-1234567"
    ); 
    habilitarBotonRegistrar();
  });

  // Validaciones para el campo "correo"
  $("#correo").on("keyup", function () {
    validarCorreo(
      /^[a-zA-ZáéíóúüñÑçÇ0-9._-]+@[a-zA-ZáéíóúüñÑçÇ0-9.-]+\.[a-zA-ZáéíóúüñÑçÇ]{2,6}$/,
      $(this),
      $("#scorreo"),
      "Correo electrónico inválido"
    ); 
    habilitarBotonRegistrar();
  });

  // Manejador de eventos para los botones
  $(".registrar1").on("click", function(){
    if(validarenvio()){
      var datos = new FormData();
      datos.append('registrar1', '');
      datos.append('nombre', $("#nombre").val());
      datos.append('apellido', $("#apellido").val());
      enviaAjax(datos);
    }
  });
});

function validarenvio(){
  if(validarKeyUp(
    /^[a-zA-ZáéíóúüñÑçÇ -.]{3,30}$/,
    $("#nombre"),
    $("#snombre"),
    "El nombre debe tener al menos 3 letras"
  ) == 0)
  {
    alert("Verifique el nombre");
    return false;
  } 
  
  if(validarKeyUp(
    /^[a-zA-ZáéíóúüñÑçÇ]{3,30}$/,
    $("#apellido"),
    $("#sapellido"),
    "El apellido debe tener al menos 3 letras"
  ) == 0)
  {
    alert("Verifique el apellido");
    return false;
  } 

  if(validarKeyUp(
    /^[VE]{1}[-]{1}[0-9]{7,8}$/,
    $("#cedula"),
    $("#scedula"),
    "El cedula debe tener al menos 3 letras"
  ) == 0)
  {
    alert("Verifique la cedula");
    return false;
  }

  return true;
}

function validarDependencia() {
    var valorSeleccionado = $("#dependencia").val();
    return valorSeleccionado !== null && valorSeleccionado !== "";
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

function validarCorreo(er, etiqueta, etiquetamensaje, mensaje) {
  a = er.test(etiqueta.val());
  if (a) {
    etiquetamensaje.text("");
    return 1;
  } else {
    etiquetamensaje.text(mensaje);
    return 0;
  }
}

function habilitarBotonRegistrar() {
    var camposLlenos = (
        $("#nombre").val().trim() !== "" &&
        $("#apellido").val().trim() !== "" &&
        $("#cedula").val().trim() !== "" &&
        $("#telefono").val().trim() !== "" &&
        $("#correo").val().trim() !== "" &&
        validarDependencia()
    );

    $(".registrar").prop("disabled", !camposLlenos);
}
