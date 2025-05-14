<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
	require_once "controller/utileria.php";
	require_once "model/marca.php";


	$titulo = "Gestionar Marcas";
	$cabecera = array('#', "Nombre", "Modificar/Eliminar");

	$marca = new Marca();

	if (isset($_POST["entrada"])) {
		$json['resultado'] = "entrada";
		echo json_encode($json);
		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Marca";
		
		Bitacora($msg, "Marca");
		exit;
	}

	if (isset($_POST["registrar"])) {
		$marca->set_nombre($_POST["nombre"]);
		$peticion["peticion"] = "registrar";
		$datos = $marca->Transaccion($peticion);
		echo json_encode($datos);

		if($datos['estado'] == 1){
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nueva marca";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nueva marca";
		}
		Bitacora($msg, "Marca");
		exit;
	}

	if (isset($_POST['consultar'])) {
		$peticion["peticion"] = "consultar";
		$datos = $marca->Transaccion($peticion);
		echo json_encode($datos);
		exit;
	}


	if (isset($_POST["modificar"])) {
		$marca->set_codigo($_POST["id_marca"]);
		$marca->set_nombre($_POST["nombre"]);
		$peticion["peticion"] = "actualizar";
		$datos = $marca->Transaccion($peticion);
		echo json_encode($datos);

		if($datos['estado'] == 1){
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del marca";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar marca";
		}
		Bitacora($msg, "Marca");
		exit;
	}

	if (isset($_POST["eliminar"])) {
		$marca->set_codigo($_POST["id_marca"]);
		$peticion["peticion"] = "eliminar";
		$datos = $marca->Transaccion($peticion);
		echo json_encode($datos);

		if($datos['estado'] == 1){
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un marca";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un marca";
		}
		Bitacora($msg, "Marca");
		exit;
	}

	if (isset($_POST["reporte"])) {

	}

	require_once "view/" . $page . ".php";
} else {
	require_once "view/404.php";
}
