$(document).ready(function(){

  // Deshabilitar los botones al cargar la página
  $(".cambio").prop("disabled", true);
  // $(".cc").prop("disabled", true);

  // Validaciones para el campo "Nombre"
  $("#Nombre").on("keypress", function(e){
    validarKeyPress(/^[a-zA-ZáéíóúüñÑçÇ -.\b]*$/, e);
  });

  $("#Nombre").on("keyup", function () {
    validarKeyUp(
      /^[a-zA-ZáéíóúüñÑçÇ -.]{3,30}$/,
      $(this),
      $("#snombre"),
      "El Nombre debe tener al menos 3 letras"
    ); 
    habilitarBotonRegistrar1();
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
    habilitarBotonRegistrar1();
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
    habilitarBotonRegistrar2();
  });

  $("#newPassword").on("keyup", function () {
  validarKeyUp(
    /^[a-zA-Z0-9áéíóúüñÑçÇ -.\b]{3,30}$/,
    $(this),
    $("#scontraseña"),
    "La contraseña debe tener entre 3 y 30 caracteres"
  ); 
  habilitarBotonRegistrar3();
});

  $("#renewPassword").on("keyup", function () {
  validarKeyUp(
    /^[a-zA-Z0-9áéíóúüñÑçÇ -.\b]{3,30}$/,
    $(this),
    $("#scontraseña"),
    "La contraseña debe tener entre 3 y 30 caracteres"
  ); 
  habilitarBotonRegistrar3();
});


  // Validaciones para el campo "correo"
  $("#correo").on("keyup", function () {
    validarCorreo(
      /^[a-zA-ZáéíóúüñÑçÇ0-9._-]+@[a-zA-ZáéíóúüñÑçÇ0-9.-]+\.[a-zA-ZáéíóúüñÑçÇ]{2,6}$/,
      $(this),
      $("#scorreo"),
      "Correo electrónico inválido"
    ); 
    habilitarBotonRegistrar2();
  });

  // Manejador de eventos para los botones
  $(".registrar1").on("click", function(){
    if(validarenvio()){
      var datos = new FormData();
      datos.append('registrar1', '');
      datos.append('Nombre', $("#Nombre").val());
      datos.append('apellido', $("#apellido").val());
      enviaAjax(datos);
    }
  });
});

function validarenvio(){
  if(validarKeyUp(
    /^[a-zA-ZáéíóúüñÑçÇ -.]{3,30}$/,
    $("#Nombre"),
    $("#snombre"),
    "El Nombre debe tener al menos 3 letras"
  ) == 0)
  {
    alert("Verifique el Nombre");
    return false;
  } 
  
  if(validarKeyUp(
    /^[a-zA-ZáéíóúüñÑçÇ -.]{3,30}$/,
    $("#apellido"),
    $("#sapellido"),
    "El apellido debe tener al menos 3 letras"
  ) == 0)
  {
    alert("Verifique el apellido");
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

function habilitarBotonRegistrar1() {
  $(".cambio").prop("disabled", $("#Nombre").val().trim() === "" || $("#apellido").val().trim() === "");
  //$(".cambio").prop("disabled", $("#apellido").val().trim() === "");
}

function habilitarBotonRegistrar2() {
  $(".cambio").prop("disabled", $("#telefono").val().trim() === "" || $("#correo").val().trim() === "");
 // $(".registrar7").prop("disabled", $("#telefono").val().trim() === "" || $("#correo").val().trim() === "");
}

function habilitarBotonRegistrar3() {
  $(".cc").prop("disabled", $("#newPassword").val().trim() === "" || $("#renewpassword").val().trim() === "");
 // $(".registrar7").prop("disabled", $("#telefono").val().trim() === "" || $("#correo").val().trim() === "");
}