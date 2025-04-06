const $rol = $('#rol');
const $tipo = $('#tipo');

$('#rol').on('change', () => {
    if ($('#rol').val() === 'Técnico') {
        $('#tipo').prop('disabled', false);
        console.log("2");
      } else {
        $('#tipo').prop('disabled', true);
        console.log("1");
      }

});

$(document).ready(function(){

    $('#tipo').prop('disabled', true);

    $('#tabla').on('click','#eliminar',(e)=>{
        console.log('click')
        if (confirm('¿Seguro que quiere eliminar este Usuario?')) {
          let form = e.target.closest('form');
          form.submit();
        }else {
          return;
        }
    })

});  