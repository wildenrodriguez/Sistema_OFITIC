<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/".$page.".php")) {
	require_once "controller/utileria.php";
	
	$titulo = "Bitacora";
	$css = ["alert", "style"];
	$cabecera = array('#', "Usuario", "Módulo", "Acción", "Fecha", "Hora");

	if(isset($_POST['entrada'])){
		$json['resultado'] = "entrada";
		echo json_encode($json);

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
		exit;
	}

	if (isset($_POST['consultar'])) {
		$peticion["peticion"] = "consultar";
		$json = $bitacora->Transaccion($peticion);
		echo json_encode($json);
		exit;
	}

	require_once "view/".$page.".php";
} else {
	require_once "view/404.php";
}
