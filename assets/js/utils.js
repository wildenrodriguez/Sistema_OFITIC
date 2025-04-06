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

  function ajax(datos, func) {
    $.ajax({
      url: "archivo.php",
      data: datos,
      type: "POST",
  
      success: function (response) {
        console.log(response);
        const res = JSON.parse(response);
        func(res);
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
  