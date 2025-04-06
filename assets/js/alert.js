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
		cerrar = setTimeout(cerrarAlert,3000);
	}
	function cerrarAlert() {
		$('#alertjs').removeClass('show');
		clearTimeout(cerrar);
		setTimeout(()=>{
			$('#alertjs').removeClass(color_alert);
		},100);
	}

})