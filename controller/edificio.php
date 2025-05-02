<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
	require_once "model/usuario.php";
	require_once "model/bitacora.php";
	require_once "model/edificio.php";

	$peticion = [];

	$titulo = "Gestionar Edificios";
	$css = ["alert", "style"];
	$cabecera = array('#', "Nombre", "Ubicación", "Modificar/Eliminar");

	$btn_color = "warning";
	$btn_icon = "filetype-pdf";
	$btn_name = "reporte";
	$btn_value = "0";
	$origen = "";

	$usuario = new Usuario();
	$edificio = new Edificio();
	$bitacora = new Bitacora();

	$usuario->set_cedula($_SESSION['user']['cedula']);
	$datos = $_SESSION['user'];
	$datos = $datos + $usuario->Transaccion(['peticion' => 'perfil']);


	if (isset($_POST["entrada"])) {
		$json['resultado'] = "entrada";
		echo json_encode($json);
		$peticion['peticion'] = "registrar";
		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Edificio";
		$hora = date('H:i:s');
		$fecha = date('Y-m-d');

		$bitacora->set_usuario($_SESSION['user']['nombre_usuario']);
		$bitacora->set_modulo("Edificio");
		$bitacora->set_accion($msg);
		$bitacora->set_fecha($fecha);
		$bitacora->set_hora($hora);
		$bitacora->Transaccion($peticion);
		exit;
	}

	if (isset($_POST["registrar"])) {
		if ($_POST['lugar'] == NULL) {
			$edificio->set_lugar(NULL);
		} else {
			$edificio->set_lugar($_POST["lugar"]);
		}
		$edificio->set_nombre($_POST["nombre"]);
		$edificio->set_stock($_POST["stock"]);
		$peticion["peticion"] = "registrar";
		echo json_encode($edificio->Transaccion($peticion));

		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo edificio";
		$hora = date('H:i:s');
		$fecha = date('Y-m-d');

		$bitacora->set_usuario($_SESSION['user']['nombre_usuario']);
		$bitacora->set_modulo("Edificio");
		$bitacora->set_accion($msg);
		$bitacora->set_fecha($fecha);
		$bitacora->set_hora($hora);
		$bitacora->Transaccion($peticion);
		exit;
	}

	if (isset($_POST['consultar'])) {
		$peticion["peticion"] = "consultar";
		echo json_encode($edificio->Transaccion($peticion));
		exit;
	}


	if (isset($_POST["actualizar"])) {
		$edificio->set_id($datos["cedula"]);
		$edificio->set_nombre($_POST["nombre"]);
		$peticion["peticion"] = "actualizar";
		echo json_encode($edificio->Transaccion($peticion));

		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Actualizo registro de un edificio";
		$hora = date('H:i:s');
		$fecha = date('Y-m-d');

		$bitacora->set_usuario($_SESSION['user']['nombre_usuario']);
		$bitacora->set_modulo("Edificio");
		$bitacora->set_accion($msg);
		$bitacora->set_fecha($fecha);
		$bitacora->set_hora($hora);
		$bitacora->Transaccion($peticion);
		exit;
	}

	if (isset($_POST["eliminar"])) {
		$edificio->set_id($_POST["id"]);
		$peticion["peticion"] = "eliminar";
		echo json_encode($edificio->Transaccion($peticion));

		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Eliminó un edificio";
		$hora = date('H:i:s');
		$fecha = date('Y-m-d');

		$bitacora->set_usuario($_SESSION['user']['nombre_usuario']);
		$bitacora->set_modulo("Edificio");
		$bitacora->set_accion($msg);
		$bitacora->set_fecha($fecha);
		$bitacora->set_hora($hora);
		$bitacora->Transaccion($peticion);
		exit;
	}

	if (isset($_POST["reporte"])) {

	}
	require_once "view/" . $page . ".php";
} else {
	require_once "view/404.php";
}
