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
    $(etiqueta).removeClass("is-invalid");
    $(etiqueta).addClass("is-valid")
    $(etiquetamensaje).removeClass("invalid-feedback");
    $(etiquetamensaje).addClass("valid-feedback")
    etiquetamensaje.text("");
    return 1;
  } else {
    $(etiqueta).removeClass("is-valid");
    $(etiqueta).addClass("is-invalid")
    $(etiquetamensaje).removeClass("valid-feedback");
    $(etiquetamensaje).addClass("invalid-feedback")
    etiquetamensaje.text(mensaje);
    return 0;
  }
}

function estadoSelect(input, span, mensaje, estado) {

  if (estado === 1) {

    $(input).addClass("is-valid");
    $(input).removeClass("is-invalid");
    $(span).removeClass("invalid-feedback");
    $(span).addClass("valid-feedback");
    $(span).text("");

  } else {

    $(input).addClass("is-invalid");
    $(input).removeClass("is-valid");
    $(span).removeClass("valid-feedback");
    $(span).addClass("invalid-feedback");
    $(span).text(mensaje);

  }
};

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