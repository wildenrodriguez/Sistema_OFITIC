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
	$cabecera = array("ID Edificio","Edificio", "ID Piso", "Piso", "Nro de Piso", "Modificar/Eliminar");

	$edificio = new Edificio();
	$piso = new Piso();

	if (isset($_POST["entrada"])) {
		$json['resultado'] = "entrada";
		echo json_encode($json);
		$peticion['peticion'] = "registrar";
		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Piso";
		Bitacora($msg, "Piso");
		exit;
	}

	if (isset($_POST["listar_edificio"])){
		$peticion['peticion'] = "consultar";
		$datos = $edificio->Transaccion($peticion);
		$datos['resultado'] = "lista_edificio";
		echo json_encode($datos);
		exit;
	}

	if (isset($_POST["registrar"])) {
		$piso->set_id_edificio($_POST["id_edificio"]);
		$piso->set_tipo($_POST["tipo_piso"]);
		$piso->set_nro_piso($_POST["nro_piso"]);
		$peticion["peticion"] = "registrar";
		$datos = $piso->Transaccion($peticion);
		echo json_encode($datos);

		if ($datos['estado'] == 1) {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo piso";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo piso";
		}
		Bitacora($msg, "Piso");
		exit;
	}

	if (isset($_POST['consultar'])) {
		$peticion["peticion"] = "consultar";
		echo json_encode($piso->Transaccion($peticion));
		exit;
	}


	if (isset($_POST["modificar"])) {
		$piso->set_id($_POST["id_piso"]);
		$piso->set_id_edificio($_POST["id_edificio"]);
		$piso->set_tipo($_POST["tipo_piso"]);
		$piso->set_nro_piso($_POST["nro_piso"]);
		$peticion["peticion"] = "actualizar";
		$datos = $piso->Transaccion($peticion);
		echo json_encode($datos);

		if ($datos['estado'] == 1) {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del piso";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar piso";
		}
		Bitacora($msg, "Piso");
		exit;
	}

	if (isset($_POST["eliminar"])) {
		$piso->set_id($_POST["id_piso"]);
		$peticion["peticion"] = "eliminar";
		$datos = $piso->Transaccion($peticion);
		echo json_encode($datos);

		if ($datos['estado'] == 1) {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un piso";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un piso";
		}
		Bitacora($msg, "Piso");
		exit;
	}

	if (isset($_POST["reporte"])) {

	}
	require_once "view/" . $page . ".php";
} else {
	require_once "view/404.php";
}
