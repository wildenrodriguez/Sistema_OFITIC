<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
	require_once "controller/utileria.php";
	require_once "model/ente.php";
	require_once "model/dependencia.php";


	$titulo = " Dependencia";
	$cabecera = array('#', "Nombre", "Ente", "Modificar/Eliminar");

	$dependencia = new Dependencia();
	$ente = new Ente();

	if (isset($_POST['cargar_ente'])) {
		$peticion["peticion"] = "consultar";
		$json = $ente->Transaccion($peticion);
		$json['resultado'] = "cargar_ente";
		echo json_encode($json);
		exit;
	}

	if (isset($_POST["entrada"])) {
		$json['resultado'] = "entrada";
		echo json_encode($json);
		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Depedencia";

		Bitacora($msg, "Depedencia");
		exit;
	}

	if (isset($_POST["registrar"])) {

		if (preg_match("/^[0-9]{1,11}$/", $_POST["ente"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Id no válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

		} else if (preg_match("/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{4,45}$/", $_POST["nombre"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Nombre no válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";
		} else {
			$peticion['peticion'] = "validar";
			$ente->set_id($_POST["ente"]);
			$validar = $ente->Transaccion($peticion);

			if ($validar['bool'] === 1 && $validar['arreglo']['estatus'] === 1) {

				$dependencia->set_nombre($_POST["nombre"]);
				$dependencia->set_id_ente($_POST["ente"]);
				$peticion["peticion"] = "registrar";
				$json = $dependencia->Transaccion($peticion);

				if ($json['estado'] == 1) {
					$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo Depedencia";
				} else {
					$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo Depedencia";
				}

			} else {
				$json['resultado'] = "error";
				$json['mensaje'] = "Error, Ente no existe";
				$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";
			}

		}

		echo json_encode($json);
		Bitacora($msg, "Depedencia");
		exit;
	}

	if (isset($_POST['consultar'])) {
		$peticion["peticion"] = "consultar";
		$json = $dependencia->Transaccion($peticion);
		echo json_encode($json);
		exit;
	}


	if (isset($_POST["modificar"])) {

		if (preg_match("/^[0-9]{1,11}$/", $_POST["ente"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Ente no válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

		} else if (preg_match("/^[0-9]{1,11}$/", $_POST["id_dependencia"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Id no válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

		} else if (preg_match("/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{4,45}$/", $_POST["nombre"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Nombre no válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";
		} else {
			$peticion['peticion'] = "validar";
			$ente->set_id($_POST["ente"]);
			$validar = $ente->Transaccion($peticion);

			if ($validar['bool'] === 1 && $validar['arreglo']['estatus'] === 1) {
				$dependencia->set_id($_POST["id_dependencia"]);
				$dependencia->set_nombre($_POST["nombre"]);
				$dependencia->set_id_ente($_POST["ente"]);
				$peticion["peticion"] = "actualizar";
				$json = $dependencia->Transaccion($peticion);
				if ($json['estado'] == 1) {
					$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del Depedencia";
				} else {
					$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar Depedencia";
				}
			} else {
				$json['resultado'] = "error";
				$json['mensaje'] = "Error, Ente no existe";
				$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";
			}

		}

		echo json_encode($json);

		Bitacora($msg, "Depedencia");
		exit;
	}

	if (isset($_POST["eliminar"])) {
		if (preg_match("/^[0-9]{1,11}$/", $_POST["id_dependencia"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Id no válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

		} else {
			$dependencia->set_id($_POST["id_dependencia"]);
			$peticion["peticion"] = "eliminar";
			$json = $dependencia->Transaccion($peticion);

			if ($json['estado'] == 1) {
				$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un Depedencia";
			} else {
				$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un Depedencia";
			}
		}

		echo json_encode($json);
		Bitacora($msg, "Depedencia");
		exit;
	}

	if (isset($_POST["reporte"])) {

	}

	require_once "view/" . $page . ".php";
} else {
	require_once "view/404.php";
}