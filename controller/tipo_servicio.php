<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
	require_once "controller/utileria.php";
	require_once "model/tipo_servicio.php";


	$titulo = "Gestionar Tipo de Servicio";
	$cabecera = array('#', "Nombre", "Modificar/Eliminar");

	$tipo_servicio = new TipoServicio();

	if (isset($_POST["entrada"])) {
		$json['resultado'] = "entrada";
		echo json_encode($json);
		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Tipo de Servicio";
		
		Bitacora($msg, "Tipo de Servicio");
		exit;
	}

	if (isset($_POST["registrar"])) {
		$tipo_servicio->set_nombre($_POST["nombre"]);
		$peticion["peticion"] = "registrar";
		$datos = $tipo_servicio->Transaccion($peticion);
		echo json_encode($datos);

		if($datos['estado'] == 1){
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo servicio";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo servicio";
		}
		Bitacora($msg, "Tipo de Servicio");
		exit;
	}

	if (isset($_POST['consultar'])) {
		$peticion["peticion"] = "consultar";
		$datos = $tipo_servicio->Transaccion($peticion);
		echo json_encode($datos);
		exit;
	}


	if (isset($_POST["modificar"])) {
		$tipo_servicio->set_codigo($_POST["id_servicio"]);
		$tipo_servicio->set_nombre($_POST["nombre"]);
		$peticion["peticion"] = "actualizar";
		$datos = $tipo_servicio->Transaccion($peticion);
		echo json_encode($datos);

		if($datos['estado'] == 1){
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del servicio";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar servicio";
		}
		Bitacora($msg, "Tipo de Servicio");
		exit;
	}

	if (isset($_POST["eliminar"])) {
		$tipo_servicio->set_codigo($_POST["id_servicio"]);
		$peticion["peticion"] = "eliminar";
		$datos = $tipo_servicio->Transaccion($peticion);
		echo json_encode($datos);

		if($datos['estado'] == 1){
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un servicio";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un servicio";
		}
		Bitacora($msg, "Tipo de Servicio");
		exit;
	}

	if (isset($_POST["reporte"])) {

	}

	require_once "view/" . $page . ".php";
} else {
	require_once "view/404.php";
}
