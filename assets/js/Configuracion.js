$(document).ready(function(){

  // Deshabilitar los botones al cargar la página
  $(".unidad").prop("disabled", true);
  $(".dependencia").prop("disabled", true);
  $(".marca").prop("disabled", true);

  $("#unidad").on("keypress", function(e){
    validarKeyPress(/^[a-zA-ZáéíóúüñÑçÇ -.\b]*$/, e);
  });

  $("#unidad").on("keyup", function () {
    validarKeyUp(
      /^[a-zA-ZáéíóúüñÑçÇ -.]{3,30}$/,
      $(this),
      $("#sunidad"),
      "La unidad debe de tener 3 letras mínimo"
    ); 
    habilitarBotonRegistrar1();
  });

  // Validaciones para el campo "dependencia"
  $("#dependencia").on("keypress", function(e){
    validarKeyPress(/^[a-zA-ZáéíóúüñÑçÇ -.\b]*$/, e);
  });

  $("#dependencia").on("keyup", function () {
    validarKeyUp(
      /^[a-zA-ZáéíóúüñÑçÇ -.]{3,30}$/,
      $(this),
      $("#sdependencia"),
      "La dependencia debe de tener 3 letras mínimo"
    ); 
    habilitarBotonRegistrar2();
  });

  $("#marca").on("keypress", function(e){
    validarKeyPress(/^[a-zA-ZáéíóúüñÑçÇ -.\b]*$/, e);
  });

  $("#marca").on("keyup", function () {
    validarKeyUp(
      /^[a-zA-ZáéíóúüñÑçÇ -.]{3,30}$/,
      $(this),
      $("#smarca"),
      "La marca debe de tener 3 letras mínimo"
    ); 
    habilitarBotonRegistrar3();
  });

  // Manejador de eventos para el botón de eliminar
  $('#t_configuracion').on('submit','#form_config',(e)=>{
    e.preventDefault();
    if (confirm('¿Seguro que quiere eliminar este Equipo?')) {
      e.target.submit();
      // console.log(e.target)
    } else {
      return;
    }
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
      datos.append('unidad', $("#unidad").val());
      datos.append('dependencia', $("#dependencia").val());
      enviaAjax(datos);
    }
  });
  function validarenvio(){
    if(validarKeyUp(
      /^[a-zA-ZáéíóúüñÑçÇ -.]{3,30}$/,
      $("#unidad"),
      $("#sunidad"),
      "La unidad debe de tener 3 letras mínimo"
    ) == 0)
    {
      alert("Verifique la unidad");
      return false;
    } 
    
    if(validarKeyUp(
      /^[a-zA-ZáéíóúüñÑçÇ -.]{3,30}$/,
      $("#dependencia"),
      $("#sdependencia"),
      "La dependencia debe de tener 3 letras mínimo"
    ) == 0)
    {
      alert("Verifique la dependencia");
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
    $(".unidad").prop("disabled", $("#unidad").val().trim() === "");
  }
  
  function habilitarBotonRegistrar2() {
    $(".dependencia").prop("disabled", $("#dependencia").val().trim() === "");
  }
  
  function habilitarBotonRegistrar3() {
    $(".marca").prop("disabled", $("#marca").val().trim() === "");
  }
  $("#elquesea").on("click",()=>{
    dato = {
      enviar: '',
      nombre: "pablo",
      apellido: "domingo",
      edad: "87"
    }

    ajax(dato);

  })

  function ajax(dato){
    // console.log(dato);
    $.ajax({
      
      async: true,
      url: "",
      type: "POST",
      data: dato,

      success: function (respuesta) { 
        try {
          var lee = JSON.parse(respuesta);
          if (lee.resultado == "consultar") {
            console.log("consulta");
            console.log(lee.datos);
            DataTable(lee.datos);
          }
          else if (lee.resultado == "registrar") {
            $("#modal1").modal("hide");
            mensajes('success', 10000, 'Usuario Registrado Correctamente',
              '');
            consultar();
          }
          
          else if (lee.resultado == "actividad") {
            console.log("Ya registro");
          }
  
          else if (lee.resultado == "modificar") {
            $("#modal1").modal("hide");
            mensajes('success', 10000, 'Registro Modificado Correctamente',
              '');
            consultar();
          }
          else if (lee.resultado == "eliminar") {
            $("#modal1").modal("hide");
            mensajes('success', 10000, 'Registro Eliminado Correctamente',
              '');
            consultar();
          }
          else if (lee.resultado == "error") {
            mensajes('warning', 10000, 'Ocurrió un error',
              lee.mensaje);
          }
        } catch (e) {
          alert("Error en JSON " + e.name);
        }
      },
      error: function (request, status, err) {
        // si ocurrio un error en la trasmicion
        // o recepcion via ajax entra aca
        // y se muestran los mensaje del error
        if (status == "timeout") {
          //pasa cuando superan los 10000 10 segundos de timeout
          muestraMensaje("Servidor ocupado, intente de nuevo");
        } else {
          //cuando ocurre otro error con ajax
          muestraMensaje("ERROR: <br/>" + request + status + err);
        }
      },
      complete: function () { },
    })

  }

});




