<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/".$page.".php")) {
	require_once "model/usuario.php";
	require_once "model/bitacora.php";

	$peticion = [];

	$titulo = "Bitacora";
	$css = ["alert", "style"];
	$cabecera = array('#', "Usuario", "Módulo", "Acción", "Fecha", "Hora");

	$btn_color = "warning";
	$btn_icon = "filetype-pdf";
	$btn_name = "reporte";
	$btn_value = "0";
	$origen = "";

	$usuario = new Usuario();
	$bitacora = new Bitacora();

	$usuario->set_cedula($_SESSION['user']['cedula']);
	$datos = $_SESSION['user'];
	$datos = $datos + $usuario->Transaccion(['peticion' => 'perfil']);

	$peticion['peticion'] = "registrar";
	$msg = "(".$_SESSION['user']['nombre_usuario']."), Ingresó al módulo de Bitácora";
	$hora = date('H:i:s');
	$fecha = date('Y-m-d');

	$bitacora->set_usuario($_SESSION['user']['nombre_usuario']);
	$bitacora->set_modulo("Bitácora");
	$bitacora->set_accion($msg);
	$bitacora->set_fecha($fecha);
	$bitacora->set_hora($hora);
	$bitacora->Transaccion($peticion);

	if (isset($_POST['consultar'])) {
		$peticion["peticion"] = "consultar";
		echo json_encode($bitacora->Transaccion($peticion));
		exit;
	}

	require_once "view/".$page.".php";
} else {
	require_once "view/404.php";
}
