$(document).ready(function(){

  // Deshabilitar los botones al cargar la página
  //$(".registrar").prop("disabled", true);

  $("#serial").on("keypress", function(e){
  validarKeyPress(/^[a-zA-Z0-9\-_]*$/, e);
});

$("#serial").on("keyup", function () {
  validarKeyUp(
    /^(?=.*[a-zA-Z0-9])[a-zA-Z0-9\-_]{3,50}$/,
    $(this),
    $("#sserial"),
    "El serial debe tener entre 3 y 50 caracteres alfanuméricos, guiones o guiones bajos"
  ); 
  habilitarBotonRegistrar1(); // Ajusta según sea necesario
});

$("#tipo").on("keypress", function(e){
    validarKeyPress(/^[a-zA-Z0-9áéíóúüñÑçÇ -.\b]*$/, e);
  });

  $("#tipo").on("keyup", function () {
    validarKeyUp(
      /^[a-zA-Z0-9áéíóúüñÑçÇ -.]{3,50}$/,
      $(this),
      $("#stipo"),
      "El tipo debe tener al menos 3 caracteres"
    ); 
    habilitarBotonRegistrar1();
  });

  

  // $('#t_configuracion').on('click','#eliminar',(e)=>{
  //   e.preventDefault();
  //   if (confirm('¿Seguro que quiere eliminar este Equipo?')) {
  //     let form = $(e.target).closest('form');
  //     form.submit();
  //   } else {
  //     return;
  //   }
  // });

  // Manejador de eventos para el botón de registrar
  $(".registrar1").on("click", function(){
    if(validarenvio()){
      var datos = new FormData();
      datos.append('registrar1', '');
      datos.append('registrar', $("#registrar").val());
      datos.append('dependencia', $("#dependencia").val());
      enviaAjax(datos);
    }
  });
});

function validarenvio(){
  if(validarKeyUp(
    /^[a-zA-ZáéíóúüñÑçÇ -.]{3,30}$/,
    $("#serial"),
    $("#sserial"),
    "El serial debe de tener 3 caracteres mínimo"
  ) == 0)
  {
    alert("Verifique el serial");
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

function habilitarBotonRegistrar1() {
  $(".registrar").prop("disabled", $("#serial").val().trim() === "" || $("#tipo").val().trim() === "");
}


