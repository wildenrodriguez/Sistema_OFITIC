
//<--Peticion AJAX para que cargue la tabla con la pagina--> //
function consultar() {
  var peticion = new FormData();
  peticion.append('consultar', 'consultar');
  enviaAjax(peticion);
}

//<--Peticion AJAX para capturar cualquier evento y actividad del sistema--> //
function bitacora(parametro) {
  var peticion = new FormData();
  peticion.append('bitacora', 'registrar');
  peticion.append('modulo', 'usuario');
 
  if (parametro == 'registrar') {
    peticion.append('accion', 'registrar');
  } else if (parametro == 'consultar') {
    peticion.append('accion', 'consultar');
  } else if (parametro == 'modificar') {
    peticion.append('accion', 'modificar');
  } else if (parametro == 'eliminar') {
    peticion.append('accion', 'eliminar');
  }

  enviaAjax(peticion);
}


$(document).ready(function () {
  consultar();
  bitacora('consultar');
//<--Capa de Validacion de Campos de Entrada de Formularios--> //

  $("#cedula").on("keypress", function (e) { validarKeyPress(/^[0-9\b]*$/, e); });
  $("#cedula").on("keyup", function () {
    validarKeyUp(/^[0-9]{7,10}$/, $(this), $("#scedula"),
      "El formato debe ser 9999999"
    );
  });

  $("#nombre").on("keypress", function (e) { validarKeyPress(/^[A-Za-z \u00f1\u00d1\u00E0-\u00FC\u00C0-\u00DC]$/, e); });
  $("#nombre").on("keyup", function () {
    validarKeyUp(/^[A-Za-z \u00f1\u00d1\u00E0-\u00FC\u00C0-\u00DC]{3,45}$/, $(this), $("#snombre"),
      "El nombre debe tener entre 3 a 45 caracteres");
  });

  $("#apellido").on("keypress", function (e) { validarKeyPress(/^[A-Za-z \u00f1\u00d1\u00E0-\u00FC\u00C0-\u00DC]$/, e); });
  $("#apellido").on("keyup", function () {
    validarKeyUp(/^[A-Za-z \u00f1\u00d1\u00E0-\u00FC\u00C0-\u00DC]{3,45}$/, $(this), $("#sapellido"),
      "El apellido debe tener entre 3 a 45 caracteres");
  });

  $("#correo").on("keypress", function (e) { validarKeyPress(/^[A-Za-z@_.0-9\b\u00f1\u00d1\u00E0-\u00FC-]*$/, e); });
  $("#correo").on("keyup", function () {
    validarKeyUp(
      /^[A-Za-z_0-9\u00f1\u00d1\u00E0-\u00FC-]{3,20}[@]{1}[A-Za-z0-9]{3,8}[.]{1}[A-Za-z]{2,3}$/,
      $(this), $("#scorreo"),
      "El formato debe ser usuario@servidor.com"
    );
  });

  $("#tlf").on("keypress", function (e) { validarKeyPress(/^[0-9\b-]*$/, e); });
  $("#tlf").on("keyup", function () {
    validarKeyUp(/^[0-9]{4}[-]{1}[0-9]{7,8}$/, $(this), $("#stlf"),
      "El formato debe ser ****-*******"
    );
  });

  $("#fecha_nacimiento").on('change', function (event) {
  });

  $("#password").on("keypress", function (e) { validarKeyPress(/^[A-Za-z-+*_.,0-9]$/, e); });
  $("#password").on("keyup", function () {
    validarKeyUp(/^[A-Za-z-+*_.,0-9]{8,45}$/, $(this), $("#spassword"),
      "La contraseña debe tener mínimo 8 carácteres (se puede usar: -+*_)");
  });

  $("#vpassword").on("keypress", function (e) { validarKeyPress(/^[A-Za-z-+*_.,0-9]$/, e); });
  $("#vpassword").on("keyup", function () {
    validarKeyUp(/^[A-Za-z-+*_.,0-9]{8,45}$/, $(this), $("#svpassword"),
      "La contraseña debe tener mínimo 8 carácteres (se puede usar: -+*_)");
  });

  $("#nombreusuario").on("keypress", function (e) { validarKeyPress(/^[a-z0-9_]$/, e); });
  $("#nombreusuario").on("keyup", function () {
    validarKeyUp(/^[a-z0-9_]{3,45}$/, $(this), $("#snombreusuario"),
      "El nombre de usuario debe tener letras minúsculas y al menos de 3 a 45 caracteres");
  });


  $("#direccion").on("keypress", function (e) {
    validarKeyPress(/^[A-Za-z0-9\s\u00f1\-\/\,\.\u00d1\u00E0-\÷\#\u00FC\u00C0-\u00DC]*$/, e);
  });

  $("#direccion").on("keyup", function () {
    validarKeyUp(/^[A-Za-z0-9\s\u00f1\-\/\,\.\u00d1\u00E0-\÷\#\u00FC\u00C0-\u00DC]{20,150}$/, $(this), $("#sdireccion"),
      "La direccion debe contener al menos 20 caracteres (Se permiten /, #, ÷, -)")
  });
//<--Fin de la Capa de Validacion de Campos de Entrada de Formularios--> //


//<--Capa de captura de Eventos de los Botones de Formulario--> //
  $("#proceso").on("click", function () {
    if ($(this).text() == "Registrar") { //<---- Registrar
      if (validarenvio()) {
        var datos = new FormData();
        datos.append('registrar', 'registrar');
        datos.append('cedula', $("#cedula").val());
        datos.append('nombres', $("#nombre").val());
        datos.append('apellidos', $("#apellido").val());

        if ($("#masculino").is(":checked")) {
          datos.append('sexo', 'M');
        }
        else {
          datos.append('sexo', 'F');
        }

        datos.append('correo', $("#correo").val());
        datos.append('tlf', $("#tlf").val());
        datos.append('fecha_nacimiento', $("#fecha_nacimiento").val());
        datos.append('grado_instruccion', $("#grado_instruccion").val());
        datos.append('password', $("#vpassword").val());
        datos.append('nombreusuario', $("#nombreusuario").val());
        datos.append('rol', $("#rol").val());
        datos.append('direccion', $("#direccion").val());
        enviaAjax(datos);
      }
    } //<---- Fin Registrar
    else if ($(this).text() == "Modificar") { //<---- Modificar
      if (validarenvio()) {
        var datos = new FormData();
        datos.append('modificar', 'modificar');
        datos.append('cedula', $("#cedula").val());
        datos.append('nombres', $("#nombre").val());
        datos.append('apellidos', $("#apellido").val());

        if ($("#masculino").is(":checked")) {
          datos.append('sexo', 'M');
        }
        else {
          datos.append('sexo', 'F');
        }

        datos.append('correo', $("#correo").val());
        datos.append('tlf', $("#tlf").val());
        datos.append('fecha_nacimiento', $("#fecha_nacimiento").val());
        datos.append('grado_instruccion', $("#grado_instruccion").val());
        datos.append('password', $("#vpassword").val());
        datos.append('nombreusuario', $("#nombreusuario").val());
        datos.append('rol', $("#rol").val());
        datos.append('direccion', $("#direccion").val());
        enviaAjax(datos);
      }
    } //<---- Fin Modificar
    if ($(this).text() == "ELIMINAR") { //<---- Eliminar
      if (validarkeyup(/^[0-9]{7,8}$/, $("#cedula"),
        $("#scedula"), "El formato debe ser 9999999") == 0) {
        muestraMensaje("La cedula debe coincidir con el formato <br/>" +
          "99999999");
      }
      else {
        var datos = new FormData();
        datos.append('accion', 'eliminar');
        datos.append('cedula', $("#cedula").val());
        enviaAjax(datos);
      }
    } //<---- Fin Eliminar
  });

  $("#incluir").on("click", function () { //<---- Evento del Boton Registrar
    limpia();
    $("#modalTitleId").text("Registrar Usuario");
    $("#proceso").text("Registrar");
    $("#proceso").last().addClass(["btn-success"]);
    $("#modal1").modal("show");
  }); //<----Fin Evento del Boton Registrar
});

//<----Fin del evento ready()---->


function validarenvio() {
  var f1 = new Date(1970, 0, 1);
  var aux = $("#fecha_nacimiento").val();
  var f2 = new Date(aux);

  if (validarKeyUp(/^[0-9]{7,10}$/, $("#cedula"), $("#scedula"),
    "") == 0) {

    mensajes('error', 10000, 'Verifique su Cédula de Identidad',
      'El formato debe ser 9999999');
    return false;

  } else if (validarKeyUp(/^[A-Za-z \u00f1\u00d1\u00E0-\u00FC\u00C0-\u00DC]{3,45}$/, $("#nombre"), $("#snombre"),
    "") == 0) {
    mensajes('error', 10000, 'Verifique su Nombre',
      'El nombre debe tener entre 3 a 45 caracteres');
    return false;

  } else if (validarKeyUp(/^[A-Za-z \u00f1\u00d1\u00E0-\u00FC\u00C0-\u00DC]{3,45}$/, $("#apellido"), $("#sapellido"),
    "") == 0) {
    mensajes('error', 10000, 'Verifique su Apellido',
      'El nombre debe tener entre 3 a 45 caracteres');
    return false;

  } else if (!$("#masculino").is(":checked") && !$("#femenino").is(":checked")) {
    mensajes('error', 10000, 'Verifique su Sexo',
      'Debe seleccionar un sexo');
    return false;

  } else if (validarKeyUp(
    /^[A-Za-z_0-9\u00f1\u00d1\u00E0-\u00FC-]{3,20}[@]{1}[A-Za-z0-9]{3,8}[.]{1}[A-Za-z]{2,3}$/,
    $("#correo"), $("#scorreo"),
    "") == 0) {
    mensajes('error', 10000, 'Verifique su Correo Electrónico',
      'El formato debe ser usuario@servidor.com');
    return false;

  } else if (validarKeyUp(/^[0-9]{4}[-]{1}[0-9]{7,8}$/, $("#tlf"), $("#stlf"),
    "") == 0) {
    mensajes('error', 10000, 'Verifique su Número Telefónico',
      'El formato debe ser ****-*******');
    return false;

  } else if (f2 < f1) {
    $("#sfechas").text("Fecha no válida");
    mensajes('error', 10000, 'Verifique su Fecha de Nacimiento',
      'Su fecha de nacimiento no debe ser menor a 1970');
    return false;

  } else if (!aux) {
    mensajes('error', 10000, 'Verifique su Fecha de Nacimiento',
      'El campo de fecha de nacimiento no puede estar vacío');
    return false;

  } else if (validarKeyUp(/^[A-Za-z-+*_.,0-9]{8,45}$/, $("#password"), $("#spassword"),
    "") == 0) {
    mensajes('error', 10000, 'Verifique su Contraseña',
      'La contraseña debe tener mínimo 8 carácteres (se puede usar: -+*_)');
    return false;

  } else if (validarKeyUp(/^[A-Za-z-+*_.,0-9]{8,45}$/, $("#vpassword"), $("#svpassword"),
    "") == 0) {
    mensajes('error', 10000, 'Verifique su Contraseña',
      'La contraseña debe tener mínimo 8 carácteres (se puede usar: -+*_)');
    return false;

  } else if ($("#password").val() != $("#vpassword").val()) {
    mensajes('error', 10000, 'Verifique su Contraseña',
      'La contraseña no coincide');
    return false;

  } else if (validarKeyUp(/^[a-z0-9_]{3,45}$/, $("#nombreusuario"), $("#snombreusuario"),
    "") == 0) {
    mensajes('error', 10000, 'Verifique su Nombre de Usuarios',
      'El nombre de usuario debe tener letras minúsculas y al menos de 3 a 45 caracteres');
    return false

  } else if (validarKeyUp(/^[A-Za-z0-9\s\u00f1\-\/\,\.\u00d1\u00E0-\÷\#\u00FC\u00C0-\u00DC]{20,150}$/, $("#direccion"), $("#sdireccion"),
    "") == 0) {
    mensajes('error', 10000, 'Verifique su Dirección',
      'La direccion debe contener al menos 20 caracteres (Se permiten /, #, ÷, -)');
    return false;

  }
  return true;
}


function enviaAjax(datos) { //<---Objeto FormData con datos de formularios o otros 
  $.ajax({
    async: true,
    url: "",
    type: "POST",
    data: datos,
    beforeSend: function () { },
    timeout: 10000, //tiempo maximo de espera por la respuesta del servidor
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
  });
}


function limpia() {

  var fecha = new Date(1980, 0, 1);
  $("#proceso").last().removeClass(["btn-danger"])
  $("#cedula").val("");
  $("#nombre").val("");
  $("#apellido").val("");
  $("#correo").val("");
  $("#telefono").val("");
  $("#fecha_nacimiento").val(fecha.toISOString().split('T')[0]);
  $("#tlf").val("");
  $("#masculino").prop("checked", false);
  $("#femenino").prop("checked", false);
  $("#direccion").val("");
}

function rellenar(pos, accion) {

  linea = $(pos).closest('tr');

  $("#cedula").val($(linea).find("td:eq(0)").text());
  $("#nombreusuario").val($(linea).find("td:eq(1)").text());
  $("#nombre").val($(linea).find("td:eq(2)").text());
  $("#apellido").val($(linea).find("td:eq(3)").text());
  $("#fecha_nacimiento").val($(linea).find("td:eq(4)").text());

  if ($(linea).find("td:eq(5)").text() == 'M') {
    $("#masculino").prop("checked", true);
    $("#femenino").prop("checked", false);
  }
  else {
    $("#masculino").prop("checked", false);
    $("#femenino").prop("checked", true);
  }
  
  $("#direccion").val($(linea).find("td:eq(6)").text());
  $("#tlf").val($(linea).find("td:eq(7)").text());
  $("#correo").val($(linea).find("td:eq(8)").text());

  var gradoInstruccion = $(linea).find("td:eq(9)").text();
  if ($("#grado_instruccion option[value='" + gradoInstruccion + "']").length > 0) {
    $("#grado_instruccion").val(gradoInstruccion).change();
  } else {
    console.error("El valor '" + gradoInstruccion + "' no se encuentra en el campo select.");
  }
  var rol = $(linea).find("td:eq(10)").text();
  cambiarSeleccionPorTexto(rol);

  if (accion == 0) {
    $("#modalTitleId").text("Modificar Usuario")
    $("#proceso").text("Modificar");
    $("#proceso").last().addClass([["btn-success"]])
  }
  else {
    $("#modalTitleId").text("Eliminar Usuario")
    $("#proceso").text("Eliminar");
    $("#proceso").last().addClass(["btn-danger"])
  }

  $("#modal1").modal("show");
}