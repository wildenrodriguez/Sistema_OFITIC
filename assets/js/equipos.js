$(document).ready(function(){

  var texto_alert;
  var color_alert;
  var cerrar;

  $('#boton').on('click',mostrarAlert)
  $('#btnCerrarAlert').on('click',cerrarAlert);

  function mostrarAlert () {
    clearTimeout(cerrar);
    $('#alertjs').addClass('show');
    $('#alertjs').addClass(color_alert);
    $('#alertjs').find('strong').text(texto_alert);
    cerrar = setTimeout(cerrarAlert,5000);
  }
  function cerrarAlert() {
    $('#alertjs').removeClass('show');
    clearTimeout(cerrar);
    setTimeout(()=>{
      $('#alertjs').removeClass(color_alert);
    },100);
  }


  obtener_equipos();
  function obtener_equipos(){
    enviaAjax('obtener_equipos','obtener_equipos');
  }

  function mostrar_equipos(respuesta){
    $('#t_equipos').html("");

    if (respuesta){
      respuesta.forEach((valor)=>{
        let tr = `
        <tr>
          <td>${valor.id_equipo}</td>
          <td>${valor.serial}</td>
          <td>${valor.tipo}</td>
          <td id="${valor.id_marca}">${valor.marca}</td>
          <td>${valor.nro_bien}</td>
          <td id="${valor.id_dependencia}">${valor.dependencia}</td>
          <td>
            <button id="modificar" title="Modificar" class="btn btn-warning h-100" data-bs-toggle="modal" data-bs-target="#m_equipo"><i class="bi bi-pencil-square"></i></button>
            <button id="eliminar" title="Eliminar" type="button" class="btn btn-danger h-100" name="eliminar" value="${valor.id_equipo}"><i class="bi bi-trash3"></i></button>
          </td>
        </tr>`;

        $('#t_equipos').append(tr);
      })
    }else{
      let tr = '<tr><td colspan="7"><h3 class="text-center">No hay Equipos Registrados</h3></td></tr>';
      $('#t_equipos').append(tr);
    }
  }
  $('#btn_modal_equipo').on('click',(e)=>{
    
    let inputs=$('#m_equipo').find(':input');
    let btn = e.target;
    let datos = {
      serial: inputs[1].value,
      nro_bien: inputs[2].value,
      marca: inputs[3].value,
      dependencia: inputs[4].value,
      tipo: inputs[5].value
    };
    $(datos).prop(btn.name,btn.value);
    
    if(e.target.name=='modificar'){

      if(confirm('¿Seguro que quiere Guardar los Cambios?')){
        enviaAjax(datos,'equipos');
      }
    }else {
      enviaAjax(datos,'equipos');
    }

    $('#m_equipo').modal('hide');
  })
  $('#btnreg').on('click',(e)=>{
    $(".registrar").prop("disabled", true);
    let formulario = $('#m_equipo');
    let inputs=$('#m_equipo').find(':input');
    formulario.find(':input').val('');
    inputs[6].name = "registrar";
    inputs[6].innerText = "Registrar Equipo";
    inputs[6].classList.remove('btn-success');
    inputs[6].classList.add('btn-primary');
    inputs[3].value ="Seleccionar";
    inputs[4].value ="Seleccionar";
  })
  $('#t_equipos').on('click','#modificar',(e)=>{
    $(".registrar").prop("disabled", false);
    let tr = e.target.closest('tr');
    let btn = $('#btn_modal_equipo');
    let inputs=$('#m_equipo').find(':input');

    inputs[1].value = $(tr).find('td:eq(1)').text();
    inputs[5].value = $(tr).find('td:eq(2)').text();
    inputs[3].value = $(tr).find('td:eq(3)').prop('id');
    inputs[2].value = $(tr).find('td:eq(4)').text();
    inputs[4].value = $(tr).find('td:eq(5)').prop('id');

    btn.prop('name','modificar');
    btn.text('Guardar Cambios');
    btn.val($(tr).find('td:eq(0)').text());
    inputs[6].classList.remove('btn-primary');
    inputs[6].classList.add('btn-success');
  })

  $('#t_equipos').on('click','#eliminar',(e)=>{
    if (confirm('¿Seguro que quiere eliminar este Equipo?')) {
      let btn = e.target.closest('button');
      let datos = {};
      $(datos).prop(btn.name,btn.value);
      enviaAjax(datos,'equipos');
    }else {
      return;
    }
  })

  // ========================== AJAX ==========================

  function enviaAjax(datos,opc) {
    
    $.ajax({
      async: true,
      url: "",
      type: "POST",
      data: datos,
      timeout: 10000,

      success: function (respuesta) {
        respuesta = JSON.parse(respuesta);
        // console.log(respuesta);
        if (respuesta && 'mensaje' in respuesta) {
          texto_alert = respuesta.mensaje;
          color_alert = respuesta.color;
          mostrarAlert();
        }
        try {

          if(opc == 'obtener_equipos'){
            mostrar_equipos(respuesta);
          }else if (opc == 'equipos') {
            enviaAjax('obtener_equipos','obtener_equipos');
          }

        } catch (e) {

          alert("Error en JSON " + e.name);

        }
      },

      error: function (request, status, err) {
        if (status == "timeout") {
          muestraMensaje("Servidor ocupado, intente de nuevo");
        } else {
          muestraMensaje("ERROR: <br/>" + request + status + err);
        }
      },

    });
  }
})
