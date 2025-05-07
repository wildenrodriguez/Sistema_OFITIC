<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
	require_once "controller/utileria.php";
	require_once "model/edificio.php";
	require_once "model/piso.php";

	$titulo = "Gestionar Pisos";
	$cabecera = array('#', "Nombre", "Ubicación", "Modificar/Eliminar");

	$edificio = new Edificio();
	$piso = new Piso();

	if (isset($_POST["entrada"])) {
		$json['resultado'] = "entrada";
		echo json_encode($json);
		$peticion['peticion'] = "registrar";
		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Piso";

		exit;
	}

	if (isset($_POST["registrar"])) {
		$edificio->set_nombre($_POST["nombre"]);
		$edificio->set_ubicacion($_POST["direccion"]);
		$peticion["peticion"] = "registrar";
		$datos = $edificio->Transaccion($peticion);
		echo json_encode($datos);

		if ($datos['estado'] == 1) {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo piso";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo piso";
		}

		exit;
	}

	if (isset($_POST['consultar'])) {
		$peticion["peticion"] = "consultar";
		echo json_encode($edificio->Transaccion($peticion));
		exit;
	}


	if (isset($_POST["modificar"])) {
		$edificio->set_id($_POST["id_edificio"]);
		$edificio->set_nombre($_POST["nombre"]);
		$edificio->set_ubicacion($_POST["direccion"]);
		$peticion["peticion"] = "actualizar";
		$datos = $edificio->Transaccion($peticion);
		echo json_encode($datos);

		if ($datos['estado'] == 1) {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del piso";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar piso";
		}
		
		exit;
	}

	if (isset($_POST["eliminar"])) {
		$edificio->set_id($_POST["id_edificio"]);
		$peticion["peticion"] = "eliminar";
		$datos = $edificio->Transaccion($peticion);
		echo json_encode($datos);

		if ($datos['estado'] == 1) {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un piso";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un piso";
		}

		exit;
	}

	if (isset($_POST["reporte"])) {

	}
	require_once "view/" . $page . ".php";
} else {
	require_once "view/404.php";
}
