const idiomaTabla = 'assets/js/datatable-plugin-es.js';

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
      $(etiqueta).last().removeClass("is-invalid");
      $(etiqueta).last().addClass("is-valid")
      $(etiquetamensaje).last().removeClass("invalid-feedback");
      $(etiquetamensaje).last().addClass("valid-feedback")
      etiquetamensaje.text("");
      return 1;
    } else {
      $(etiqueta).last().removeClass("is-valid");
      $(etiqueta).last().addClass("is-invalid")
      $(etiquetamensaje).last().removeClass("valid-feedback");
      $(etiquetamensaje).last().addClass("invalid-feedback")
      etiquetamensaje.text(mensaje);
      return 0;
    }
  }

  function mensajes(icono, tiempo, titulo, mensaje) {
    Swal.fire({
      icon: icono,
      timer: tiempo,
      title: titulo,
      text: mensaje,
      showConfirmButton: true,
      confirmButtonText: 'Aceptar',
    });
  }
  
  function consultar() {
    var peticion = new FormData();
    peticion.append('consultar', 'consultar');
    enviaAjax(peticion);
  }
  
  function registrarEntrada() {
    var peticion = new FormData();
    peticion.append('entrada', 'entrada');
    enviaAjax(peticion);
  }