<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
}

if (is_file("view/" . $page . ".php")) {
	require_once "controller/utileria.php";
	require_once "model/solicitud.php";
	require_once "model/empleado.php";
	require_once "model/hoja_servicio.php";
	require_once "model/equipo.php";

	$titulo = "Solicitudes";
	$cabecera = array('#', "Solicitante", "Cedula","Equipo", "Motivo", "Estado", "Fecha Reporte", "Resultado", "Modificar/Eliminar");

	$solicitud = new Solicitud();
	$empleado = new Empleado();
	$equipo = new Equipo();
	$HojaServicio = new HojaServicio();



	if (isset($_POST["action"])) {
		switch ($_POST["action"]) {
			case "load_equipos":
				$peticion["peticion"] = "equipos";
				$peticion["dependencia_id"] = $_POST["dependencia_id"];
				$equipo_datos = $equipo->Transaccion($peticion);
				echo json_encode($equipo_datos);
				break;
			case "load_solicitantes":
				$dependenciaId = $_POST["dependencia_id"];
				$soli = $empleado->Empleados_dependencia($dependenciaId);
				echo json_encode($soli);
				break;
		}
		exit;
	}

		if (isset($_POST["entrada"])) {
		$json['resultado'] = "entrada";
		echo json_encode($json);
		$msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Solicitud";
		
		Bitacora($msg, "Solicitud");
		exit;
	}

	if (isset($_POST['consultar'])) {
		$peticion['peticion'] = "consultar_servicio";
		$json = $solicitud->Transaccion($peticion);
		echo json_encode($json);
		exit;
	}

	if (isset($_POST['consultar_equipo'])) {
		$peticion["peticion"] = "consultar";
		$datos = $equipo->Transaccion($peticion);
	}

	if (isset($_POST["solicitar"]) and $_POST["motivo"] != NULL) {
		if ($_POST['cedula'] != " ") {
			$solicitud->set_motivo($_POST["motivo"]);
			if ($_POST["serial"] == " ") {
				$equipoSerial = null;
			} else {
				$equipoSerial = $_POST["serial"];
			}
			$peticion['peticion'] = "registrar";
			$solicitud->set_id_equipo($equipoSerial);
			$solicitud->set_cedula_solicitante($_POST["cedula"]);
			$HojaServicio->set_nro_solicitud($solicitud->Transaccion($peticion));
			$HojaServicio->set_tipo_servicio($_POST["area"]);
			$HojaServicio->NuevaHojaServicio();
			header("refresh: 0");
		}

	} else

		if (isset($_POST["enviar"]) and $_POST["motivo"] != NULL) {
			$peticion['peticion'] = "validar";
			$solicitud->set_nro_solicitud($_POST["nrosol"]);
			$solicitud->set_motivo($_POST["motivo"]);
			$equipo->set_serial($_POST['serial']);
			if ($_POST["serial"] == " " or $equipo->Transaccion($peticion)) {
				$equipoSerial = null;
			} else {
				$equipoSerial = $_POST["serial"];
			}
			$peticion['peticion'] = "actualizar";
			$solicitud->set_id_equipo($equipo);
			$solicitud->Transaccion($peticion);
			$HojaServicio->set_nro_solicitud($_POST["nrosol"]);
			$HojaServicio->set_tipo_servicio($_POST["area"]);
			$HojaServicio->NuevaHojaServicio();
			header("refresh: 0");
		}

	if (isset($_POST['eliminar'])) {
		$peticion['peticion'] = "eliminar";
		$solicitud->set_nro_solicitud($_POST['eliminar']);
		if ($solicitud->Transaccion($peticion)) {
			header("refresh:0");
		} else {
		}
	}


	if (isset($_POST["reporte"])) {
		require_once "model/reporte.php";
		$reporte = new reporte();
		$solicitud->set_fecha_inicio($_POST["inicio"]);
		$solicitud->set_fecha_final($_POST["final"]);
		$reporte->solicitudes($solicitud->consulta_reporte());
	}

	require_once "view/$page.php";
} else {
	require_once "view/404.php";
}
?>