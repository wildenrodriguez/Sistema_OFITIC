<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
	require_once "controller/utileria.php";
	require_once "model/empleado.php";


	$titulo = "Gestionar Empleados";
	$cabecera = array('Cédula', "Nombre", "Apellido", "Teléfono", "Correo","Dependencia", "Unidad", "Cargo", "Servicio", "Modificar/Eliminar");

	$empleado = new empleado();

	if (isset($_POST["entrada"])) {
		$json['resultado'] = "entrada";
		echo json_encode($json);
		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Empleado";

		Bitacora($msg, "Empleado");
		exit;
	}

	if (isset($_POST["registrar"])) {
		$empleado->set_cedula($_POST["cedula"]);
		$empleado->set_nombre($_POST["nombre"]);
		$empleado->set_apellido($_POST["apellido"]);
		$empleado->set_telefono($_POST["telefono"]);
		$empleado->set_correo($_POST["correo"]);
		$empleado->set_dependencia($_POST["dependencia"]);
		$empleado->set_unidad($_POST["unidad"]);
		$empleado->set_cargo($_POST["dependencia"]);
		$peticion["peticion"] = "registrar";
		$datos = $empleado->Transaccion($peticion);
		echo json_encode($datos);

		if ($datos['estado'] == 1) {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo empleado";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo empleado";
		}
		Bitacora($msg, "Empleado");
		exit;
	}

	if (isset($_POST['consultar'])) {
		$peticion["peticion"] = "consultar";
		$datos = $empleado->Transaccion($peticion);
		echo json_encode($datos);
		exit;
	}

	if (isset($_POST["modificar"])) {
		$empleado->set_cedula($_POST["cedula"]);
		$empleado->set_nombre($_POST["nombre"]);
		$empleado->set_apellido($_POST["apellido"]);
		$empleado->set_telefono($_POST["telefono"]);
		$empleado->set_correo($_POST["correo"]);
		$empleado->set_dependencia($_POST["dependencia"]);
		$empleado->set_unidad($_POST["unidad"]);
		$empleado->set_cargo($_POST["dependencia"]);
		$peticion["peticion"] = "actualizar";
		$datos = $empleado->Transaccion($peticion);
		echo json_encode($datos);

		if ($datos['estado'] == 1) {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del empleado";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar empleado";
		}
		Bitacora($msg, "Empleado");
		exit;
	}

	if (isset($_POST["eliminar"])) {
		$empleado->set_cedula($_POST["cedula"]);
		$peticion["peticion"] = "eliminar";
		$datos = $empleado->Transaccion($peticion);
		echo json_encode($datos);

		if ($datos['estado'] == 1) {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un empleado";
		} else {
			$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un empleado";
		}
		Bitacora($msg, "Empleado");
		exit;
	}

	if (isset($_POST["reporte"])) {

	}

	require_once "view/" . $page . ".php";
} else {
	require_once "view/404.php";
}
