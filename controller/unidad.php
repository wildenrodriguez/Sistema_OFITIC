<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
	require_once "controller/utileria.php";
	require_once "model/unidad.php";
	require_once "model/dependencia.php";


	$titulo = "Gestionar Unidades";
	$cabecera = array('#', "Dependencia", "Nombre", "Modificar/Eliminar");

	$unidad = new Unidad();
	$dependencia = new Dependencia();

	if (isset($_POST["entrada"])) {
		$json['resultado'] = "entrada";
		echo json_encode($json);
		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Unidad";

		Bitacora($msg, "Unidad");
		exit;
	}

	if (isset($_POST["registrar"])) {

		if (preg_match("/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{3,45}$/", $_POST["nombre"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Nombre no válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió datos no válidos";

		} else if (preg_match("/^[0-9]{1,11}$/", $_POST["id_dependencia"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Dependencia no valida";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió datos no válidos";

		} else {
			$peticion['peticion'] = "validar";
			$dependencia->set_id($_POST["id_dependencia"]);
			$validar = $dependencia->Transaccion($peticion);
			if ($validar['bool'] == 1 && $validar['arreglo']['estatus'] == 1) {
				$unidad->set_nombre($_POST["nombre"]);
				$unidad->set_id_dependencia($_POST["id_dependencia"]);
				$peticion["peticion"] = "registrar";
				$json = $unidad->Transaccion($peticion);

				if ($json['estado'] == 1) {
					$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nueva unidad";
				} else {
					$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nueva unidad";
				}
			} else {
				$json['resultado'] = "error";
				$json['mensaje'] = "Error, Dependencia no existe";
				$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió datos no válidos";
			}

		}
		echo json_encode($json);
		Bitacora($msg, "Unidad");
		exit;
	}

	if (isset($_POST['consultar'])) {
		$peticion["peticion"] = "consultar";
		$json = $unidad->Transaccion($peticion);
		echo json_encode($json);
		exit;
	}


	if (isset($_POST["modificar"])) {
		if (preg_match("/^[0-9 a-zA-ZáéíóúüñÑçÇ -.]{3,45}$/", $_POST["nombre"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Nombre no válido";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió datos no válidos";

		} else if (preg_match("/^[0-9]{1,11}$/", $_POST["id_dependencia"]) == 0) {
			$json['resultado'] = "error";
			$json['mensaje'] = "Error, Dependencia no valida";
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió datos no válidos";

		} else {
			$peticion['peticion'] = "validar";
			$dependencia->set_id($_POST["id_dependencia"]);
			$validar = $dependencia->Transaccion($peticion);

			if ($validar['bool'] == 1 && $validar['arreglo']['estatus'] == 1) {

			} else {
				$unidad->set_id($_POST["id_unidad"]);
				$unidad->set_nombre($_POST["nombre"]);
				$unidad->set_id_dependencia($_POST["id_dependencia"]);
				$peticion["peticion"] = "actualizar";
				$json = $unidad->Transaccion($peticion);
			}

		}
		echo json_encode($json);

		if ($json['estado'] == 1) {
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
		$json = $unidad->Transaccion($peticion);
		echo json_encode($json);

		if ($json['estado'] == 1) {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un unidad";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un unidad";
		}
		Bitacora($msg, "Unidad");
		exit;
	}

	if (isset($_POST['cargar_dependencia'])) {
		$peticion["peticion"] = "consultar";
		$json = $dependencia->Transaccion($peticion);
		$json['resultado'] = "consultar_dependencia";
		echo json_encode($json);
		exit;
	}

	if (isset($_POST["reporte"])) {

	}

	require_once "view/" . $page . ".php";
} else {
	require_once "view/404.php";
}
