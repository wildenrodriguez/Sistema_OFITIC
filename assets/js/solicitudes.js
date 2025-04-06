$(document).ready(function(){

  //$(".registrar").prop("disabled", true);

  // Deshabilitar los botones al cargar la página
  $(".registrar").prop("disabled", true);

   $("#dependencia").on("change", function() {
        habilitarBotonRegistrar();
    });

  // Validaciones para el campo "falla"
  $("#falla").on("keypress", function(e){
    validarKeyPress(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.\b]*$/, e);
  });

  $("#falla").on("keyup", function () {
    validarKeyUp(
      /^[0-9a-zA-ZáéíóúüñÑçÇ -.]{3,200}$/,
      $(this),
      $("#sfalla"),
      "El motivo debe de tener entre 3 y 200 caracteres"
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
    validarKeyPress(/^[VEJ0-9-\b]*$/,e);
  });

  $("#cedula").on("keyup", function () {
    validarKeyUp(/^[VEJ]{1}[-]{1}[0-9]{7,8}$/,$(this),
      $("#scedula"),
      "El formato debe ser con V,E o J-12345678"
    ); 
    habilitarBotonRegistrar();
  });

  // Validaciones para el campo "telefono"
  $("#telefono").on("keypress", function(e){
    validarKeyPress(/^[0-9\b]*$/, e);
  });

  $("#telefono").on("keyup", function () {
    validarKeyUp(
      /^[0-9]{7,15}$/,
      $(this),
      $("#stelefono"),
      "El teléfono debe tener entre 7 y 15 dígitos"
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
      datos.append('falla', $("#falla").val());
      datos.append('apellido', $("#apellido").val());
      enviaAjax(datos);
    }
  });
});

function validarenvio(){
  if(validarKeyUp(
    /^[a-zA-ZáéíóúüñÑçÇ -.]{3,200}$/,
    $("#falla"),
    $("#sfalla"),
    "La falla debe tener entre 3 y 200 caracteres"
  ) == 0)
  {
    alert("Verifique el falla");
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

function validarInput(er, etiqueta) {
  a = er.test(etiqueta.val());
  if (a) {
    return 1;
  } else {
    return 0;
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
function activarBoton2(selectorBoton) {
  // Función para verificar si todos los inputs cumplen con la expresión regular
  function todosValidos() {
    let todosValidos = true;
    
      if (!/^[0-9a-zA-ZáéíóúüñÑçÇ -.]{3,200}$/.test($("#motivo2").val())) {
        todosValidos = false;
        return false;
      }
    return todosValidos;
  }

  // Activa o desactiva el botón dependiendo de la validez de los inputs
  $("#motivo2").on("keyup", function() {
    if (todosValidos()) {
      $("#enviar2").prop("disabled", false);
    } else {
      $("#enviar2").prop("disabled", true);
    }
  });

  // Desactiva el botón al iniciar
  $("#enviar2").prop("disabled", true);
}

function activarBoton1(selectorBoton) {
  // Función para verificar si todos los inputs cumplen con la expresión regular
  function todosValidos() {
    let todosValidos = true;
    
      if (!/^[0-9a-zA-ZáéíóúüñÑçÇ -.]{3,200}$/.test($("#falla").val())) {
        todosValidos = false;
        return false;
      }
    return todosValidos;
  }

  // Activa o desactiva el botón dependiendo de la validez de los inputs
  $("#falla").on("keyup", function() {
    if (todosValidos()) {
      $("#enviar").prop("disabled", false);
    } else {
      $("#enviar").prop("disabled", true);
    }
  });

  // Desactiva el botón al iniciar
  $("#enviar").prop("disabled", true);
}

activarBoton2();


activarBoton1();

/*function habilitarBotonRegistrar1() {
    var camposLlenos = (
        $("#falla").val().trim() !== "" &&
        $("#apellido").val().trim() !== "" &&
        $("#cedula").val().trim() !== "" &&
        $("#telefono").val().trim() !== "" &&
        $("#correo").val().trim() !== "" &&
        //validarDependencia()
    );

    $(".registrar").prop("disabled", !camposLlenos);
}*/


const $dependencia = document.getElementById('dependencia');
const $equipo = document.getElementById('equipo');
const $solicitante = document.getElementById('solicitante');

const $dependencia2 = document.getElementById('dependencia2');
const $equipo2 = document.getElementById('equipo2');

$dependencia.addEventListener('change', () => {
  const dependenciaId = $dependencia.value;

  // AJAX request to load equipos
  $.ajax({
    url: '',
    type: 'POST',
    data: { action: 'load_equipos', dependencia_id: dependenciaId },
    success: function(data) {
      
      var solic = JSON.parse(data);
      $equipo.innerHTML = '';
      const todosOption = document.createElement('option');
      todosOption.value = ' ';
      todosOption.textContent = 'Todos';
      $equipo.appendChild(todosOption);

      for (const equipo of solic) {
        const option = document.createElement('option');
        option.value = equipo.id;
        option.textContent = equipo.serial +"-"+ equipo.tipo;
        $equipo.appendChild(option);
      }
    }
  });

  // AJAX request to load solicitantes
  $.ajax({
    url: '',
    type: 'POST',
    data: { action: 'load_solicitantes', dependencia_id: dependenciaId },
    success: function(data) {
      var solic = JSON.parse(data);
      $solicitante.innerHTML = '';
      const todosOption = document.createElement('option');
      todosOption.value = ' ';
      todosOption.textContent = 'Todos';
      $solicitante.appendChild(todosOption);

      for (const solicitante of solic) {
        const option = document.createElement('option');
        console.log(solicitante);
        option.value = solicitante.cedula;
        option.textContent = solicitante.nombre +"-"+ solicitante.cedula;
        $solicitante.appendChild(option);
      }
    }
  });
});

$dependencia2.addEventListener('change', () => {
  const dependenciaId = $dependencia2.value;

  console.log($dependencia2.value);

  // AJAX request to load equipos
  $.ajax({
    url: '',
    type: 'POST',
    data: { action: 'load_equipos', dependencia_id: dependenciaId },
    success: function(data) {
      
      var solic = JSON.parse(data);
      $equipo2.innerHTML = '';
      const todosOption = document.createElement('option');
      todosOption.value = ' ';
      todosOption.textContent = 'Todos';
      $equipo2.appendChild(todosOption);

      for (const equipo of solic) {
        const option = document.createElement('option');
        option.value = equipo.id;
        option.textContent = equipo.serial +"-"+ equipo.tipo;
        $equipo2.appendChild(option);
      }
    }
  });
});
