<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
}

ob_start();
require_once "model/usuarios.php";
$usuario = new Usuario();
if (!$usuario->validar_entrada($_SESSION['user']['rol'], ["Super usuario", "Administrador"]))
	echo '<script>window.location="?page=404"</script>';

if (is_file("view/" . $page . ".php")) {
	$css = ["alert"];

	require_once "model/configuracion.php";
	$config = new Configuracion();
	$config->set_tabla("dependencia");
	$dependencias = $config->Transaccion("consultar");

	require_once "model/empleado.php";
	$emp = new Empleado();
	$cedulas = $emp->obtener_cedulas();

	require_once "model/equipo.php";
	$equipo = new Equipo();
	$peticion["peticion"] = "consultar";
	$datos = $equipo->Transaccion($peticion);

	// Check for AJAX request
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
				$soli = $emp->Empleados_dependencia($dependenciaId);
				echo json_encode($soli);
				break;
		}
		exit;
	}

	$usuario->set_cedula($_SESSION['user']['cedula']);

	$datos = $_SESSION['user'];
	$datos = $datos + $usuario->datos();

	require_once "model/hoja_servicio.php";
	$hoja = new Hoja();

	require_once "model/configuracion.php";
	$config = new Configuracion();
	$config->set_tabla("dependencia");
	$dependencias = $config->Transaccion("consultar");


	$titulo = "Solicitudes";


	$cabecera = array('#', "Solicitante", "Equipo", "Cedula", "Motivo", "Estado", "Fecha Reporte");
	$btn_color = "warning";
	$btn_icon = "info-circle";
	$btn_name = "informacion";
	$modal = "solicitud";
	$origen = "";
	require_once "model/solicitud.php";
	$servi = new Solicitud;
	$servicios = $servi->servicios();
	$registros = [];
	foreach ($servicios as $i => $servicio) {
		$registros[$i] = [$servicio["ID"], $servicio["Solicitante"], $servicio["Equipo"], $servicio["Cedula"], $servicio["Motivo"], $servicio["Estatus"], $servicio["Inicio"]];
	}

	if (isset($_POST["solicitar"]) and $_POST["motivo"] != NULL) {
		if ($_POST['cedula'] != " ") {
			$servi->set_motivo($_POST["motivo"]);
			if ($_POST["serial"] == " ") {
				$equipo = null;
			} else {
				$equipo = $_POST["serial"];
			}
			$servi->set_id_equipo($equipo);
			$servi->set_cedula_solicitante($_POST["cedula"]);
			$hoja->set_nro_solicitud($servi->crear());
			$hoja->set_tipo_servicio($_POST["area"]);
			$hoja->nueva_hoja();
			header("refresh: 0");
		}

	} else

		if (isset($_POST["enviar"]) and $_POST["motivo"] != NULL) {
			$servi->set_nro_solicitud($_POST["nrosol"]);
			$servi->set_motivo($_POST["motivo"]);
			$equ->set_serial($_POST['serial']);
			if ($_POST["serial"] == " " or $equ->validar_equipo()) {
				$equipo = null;
			} else {
				$equipo = $_POST["serial"];
			}
			print_r($equipo);
			$servi->set_id_equipo($equipo);
			$servi->actualizar_solicitud();
			$hoja->set_nro_solicitud($_POST["nrosol"]);
			$hoja->set_tipo_servicio($_POST["area"]);
			$hoja->nueva_hoja();
			header("refresh: 0");
		}

	if (isset($_POST['eliminar'])) {
		$servi->set_nro_solicitud($_POST['eliminar']);

		if ($servi->eliminar()) {
			header("refresh:0");
		} else {
		}
	}


	if (isset($_POST["reporte"])) {
		require_once "model/reporte.php";
		$reporte = new reporte();
		$servi->set_fecha_inicio($_POST["inicio"]);
		$servi->set_fecha_final($_POST["final"]);
		ob_end_clean();
		$reporte->solicitudes($servi->consulta_reporte());
	}

	require_once "view/$page.php";
} else {
	require_once "view/404.php";
}
?>