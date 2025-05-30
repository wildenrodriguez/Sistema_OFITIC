<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
	require_once "controller/utileria.php";
	require_once "model/ente.php";


	$titulo = "Entes";
	$cabecera = array('#', "Nombre", "Responsable", "Teléfono", "Ubicación", "Modificar/Eliminar");

	$ente = new Ente();

	if (isset($_POST["entrada"])) {
		$json['resultado'] = "entrada";
		echo json_encode($json);
		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Ente";

		Bitacora($msg, "Ente");
		exit;
	}

	if (isset($_POST["registrar"])) {

		if (preg_match("/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{4,90}$/", $_POST["nombre"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Nombre del Ente no válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

		} else if (preg_match("/^[0-9a-zA-ZáéíóúüñÑçÇ\/\-.,# ]{10,100}$/", $_POST["direccion"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Dirección no válida";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

		} else if (preg_match("/^[0-9]{4}[-]{1}[0-9]{7,8}$/", $_POST["telefono"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Teléfono válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

		} else if (preg_match("/^[a-zA-ZáéíóúüñÑçÇ -.]{4,65}$/", $_POST["responsable"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Nombre del Responsable no válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

		} else {

			$ente->set_nombre($_POST["nombre"]);
			$ente->set_direccion($_POST["direccion"]);
			$ente->set_telefono($_POST["telefono"]);
			$ente->set_responsable($_POST["responsable"]);
			$peticion["peticion"] = "registrar";
			$json = $ente->Transaccion($peticion);
			if ($json['estado'] == 1) {
				$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo ente";
			} else {
				$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo ente";
			}
		}

		echo json_encode($json);
		Bitacora($msg, "Ente");
		exit;
	}

	if (isset($_POST['consultar'])) {
		$peticion["peticion"] = "consultar";
		$json = $ente->Transaccion($peticion);
		echo json_encode($json);
		exit;
	}


	if (isset($_POST["modificar"])) {

		if (preg_match("/^[0-9]{1,11}$/", $_POST["id_ente"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Id no válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

		} else if (preg_match("/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{4,90}$/", $_POST["nombre"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Nombre del Ente no válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

		} else if (preg_match("/^[0-9a-zA-ZáéíóúüñÑçÇ\/\-.,# ]{10,100}$/", $_POST["direccion"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Dirección no válida";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

		} else if (preg_match("/^[0-9]{4}[-]{1}[0-9]{7,8}$/", $_POST["telefono"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Teléfono válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

		} else if (preg_match("/^[a-zA-ZáéíóúüñÑçÇ -.]{4,65}$/", $_POST["responsable"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Nombre del Responsable no válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

		} else {


			$ente->set_id($_POST["id_ente"]);
			$ente->set_nombre($_POST["nombre"]);
			$ente->set_direccion($_POST["direccion"]);
			$ente->set_telefono($_POST["telefono"]);
			$ente->set_responsable($_POST["responsable"]);
			$peticion["peticion"] = "actualizar";
			$json = $ente->Transaccion($peticion);
			
			if ($json['estado'] == 1) {
				$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del Ente";
			} else {
				$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar Ente";
			}
			
		}

		echo json_encode($json);
		Bitacora($msg, "Ente");
		exit;
	}

	if (isset($_POST["eliminar"])) {

		if (preg_match("/^[0-9]{1,11}$/", $_POST["id_ente"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Id no válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

		} else {

			$ente->set_id($_POST["id_ente"]);
			$peticion["peticion"] = "eliminar";
			$json = $ente->Transaccion($peticion);
			
			if ($json['estado'] == 1) {
				$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un Ente";
			} else {
				$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un Ente";
			}
		}
		echo json_encode($json);
		Bitacora($msg, "Ente");
		exit;
	}

	if (isset($_POST["reporte"])) {

	}

	require_once "view/" . $page . ".php";
} else {
	require_once "view/404.php";
}
