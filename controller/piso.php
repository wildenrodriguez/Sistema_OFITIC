<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
	require_once "model/usuario.php";
	require_once "model/bitacora.php";
	require_once "model/pisos.php";

	$peticion = [];

	$titulo = "Gestionar Pisos";
	$css = ["alert", "style"];
	$cabecera = array('#', "Nombre", "Cantidad", "Ubicación", "Reponer/Gastar", "Modificar/Eliminar");

	$btn_color = "warning";
	$btn_icon = "filetype-pdf";
	$btn_name = "reporte";
	$btn_value = "0";
	$origen = "";

	$usuario = new Usuario();
	$empleado = new Empleado();
	$material = new Material();
	$bitacora = new Bitacora();

	$usuario->set_cedula($_SESSION['user']['cedula']);
	$datos = $_SESSION['user'];
	$datos = $datos + $usuario->Transaccion(['peticion' => 'perfil']);


	if (isset($_POST["entrada"])) {
		$json['resultado'] = "entrada";
		echo json_encode($json);
		$peticion['peticion'] = "registrar";
		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Materiales";
		$hora = date('H:i:s');
		$fecha = date('Y-m-d');

		$bitacora->set_usuario($_SESSION['user']['nombre_usuario']);
		$bitacora->set_modulo("Material");
		$bitacora->set_accion($msg);
		$bitacora->set_fecha($fecha);
		$bitacora->set_hora($hora);
		$bitacora->Transaccion($peticion);
		exit;
	}

	if (isset($_POST["registrar"])) {
		if ($_POST['lugar'] == NULL) {
			$material->set_lugar(NULL);
		} else {
			$material->set_lugar($_POST["lugar"]);
		}
		$material->set_nombre($_POST["nombre"]);
		$material->set_stock($_POST["stock"]);
		$peticion["peticion"] = "registrar";
		echo json_encode($material->Transaccion($peticion));

		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo material";
		$hora = date('H:i:s');
		$fecha = date('Y-m-d');

		$bitacora->set_usuario($_SESSION['user']['nombre_usuario']);
		$bitacora->set_modulo("Material");
		$bitacora->set_accion($msg);
		$bitacora->set_fecha($fecha);
		$bitacora->set_hora($hora);
		$bitacora->Transaccion($peticion);
		exit;
	}

	if (isset($_POST['consultar'])) {
		$peticion["peticion"] = "consultar";
		echo json_encode($material->Transaccion($peticion));
		exit;
	}


	if (isset($_POST["actualizar"])) {
		$material->set_id($datos["cedula"]);
		$material->set_nombre($_POST["nombre"]);
		$peticion["peticion"] = "actualizar";
		echo json_encode($material->Transaccion($peticion));

		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Actualizo registro de un material";
		$hora = date('H:i:s');
		$fecha = date('Y-m-d');

		$bitacora->set_usuario($_SESSION['user']['nombre_usuario']);
		$bitacora->set_modulo("Material");
		$bitacora->set_accion($msg);
		$bitacora->set_fecha($fecha);
		$bitacora->set_hora($hora);
		$bitacora->Transaccion($peticion);
		exit;
	}

	if (isset($_POST["eliminar"])) {
		$material->set_id($_POST["id"]);
		$peticion["peticion"] = "eliminar";
		echo json_encode($material->Transaccion($peticion));

		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Eliminó un material";
		$hora = date('H:i:s');
		$fecha = date('Y-m-d');

		$bitacora->set_usuario($_SESSION['user']['nombre_usuario']);
		$bitacora->set_modulo("Material");
		$bitacora->set_accion($msg);
		$bitacora->set_fecha($fecha);
		$bitacora->set_hora($hora);
		$bitacora->Transaccion($peticion);
		exit;
	}

	if (isset($_POST["stock"])) {
		$material->set_id($_POST["id"]);
		$material->set_stock($_POST["stock"]);
		$peticion["peticion"] = "registrar";
		echo json_encode($material->Transaccion($peticion));

		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), " . $_POST['operacion'] . " " . $material->set_stock($_POST["stock"]);
		$hora = date('H:i:s');
		$fecha = date('Y-m-d');

		$bitacora->set_usuario($_SESSION['user']['nombre_usuario']);
		$bitacora->set_modulo("Material");
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
