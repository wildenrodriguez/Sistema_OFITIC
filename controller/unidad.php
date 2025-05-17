<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
	require_once "controller/utileria.php";
	require_once "model/unidad.php";


	$titulo = "Gestionar Unidades";
	$cabecera = array('#', "Nombre", "Modificar/Eliminar");

	$unidad = new Unidad();

	if (isset($_POST["entrada"])) {
		$json['resultado'] = "entrada";
		echo json_encode($json);
		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Unidad";
		
		Bitacora($msg, "Unidad");
		exit;
	}

	if (isset($_POST["registrar"])) {
		$unidad->set_nombre($_POST["nombre"]);
		$unidad->set_ubicacion($_POST["direccion"]);
		$peticion["peticion"] = "registrar";
		$datos = $unidad->Transaccion($peticion);
		echo json_encode($datos);

		if($datos['estado'] == 1){
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo unidad";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo unidad";
		}
		Bitacora($msg, "Unidad");
		exit;
	}

	if (isset($_POST['consultar'])) {
		$peticion["peticion"] = "consultar";
		$datos = $unidad->Transaccion($peticion);
		echo json_encode($datos);
		exit;
	}


	if (isset($_POST["modificar"])) {
		$unidad->set_id($_POST["id_Unidad"]);
		$unidad->set_nombre($_POST["nombre"]);
		$unidad->set_ubicacion($_POST["direccion"]);
		$peticion["peticion"] = "actualizar";
		$datos = $unidad->Transaccion($peticion);
		echo json_encode($datos);

		if($datos['estado'] == 1){
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del unidad";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar unidad";
		}
		Bitacora($msg, "Unidad");
		exit;
	}

	if (isset($_POST["eliminar"])) {
		$unidad->set_id($_POST["id_unidad"]);
		$peticion["peticion"] = "eliminar";
		$datos = $unidad->Transaccion($peticion);
		echo json_encode($datos);

		if($datos['estado'] == 1){
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un unidad";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un unidad";
		}
		Bitacora($msg, "Unidad");
		exit;
	}

	if (isset($_POST["reporte"])) {

	}

	require_once "view/" . $page . ".php";
} else {
	require_once "view/404.php";
}
