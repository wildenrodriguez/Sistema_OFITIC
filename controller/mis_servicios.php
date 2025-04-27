<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/".$page.".php")) {
	require_once "model/usuario.php";
	require_once "model/bitacora.php";
	require_once "model/solicitud.php";
	require_once "model/hoja_servicio.php";

	$peticion = [];

	$titulo = "Mis Solicitudes";
	$css = ["alert", "style"];
	$cabecera = array('#', "Motivo", "Fecha Reporte", "Estado", "Resultado");

	$btn_color = "warning";
	$btn_icon = "filetype-pdf";
	$btn_name = "reporte";
	$btn_value = "0";
	$origen = "";

	$usuario = new Usuario();
	$solicitud = new Solicitud();
	$bitacora = new Bitacora();

	$usuario->set_cedula($_SESSION['user']['cedula']);
	$datos = $_SESSION['user'];
	$datos = $datos + $usuario->Transaccion(['peticion' => 'perfil']);

	$peticion['peticion'] = "registrar";
	$msg = "(".$_SESSION['user']['nombre_usuario']."), Ingresó al módulo de Solicitudes, lugar: Mis servicios";
	$hora = date('H:i:s');
	$fecha = date('Y-m-d');

	$bitacora->set_usuario($_SESSION['user']['nombre_usuario']);
	$bitacora->set_modulo("Solicitudes");
	$bitacora->set_accion($msg);
	$bitacora->set_fecha($fecha);
	$bitacora->set_hora($hora);
	$bitacora->Transaccion($peticion);

	if (isset($_POST['consultar'])) {
		$solicitud->set_cedula_solicitante($_SESSION['user']['cedula']);
		$peticion["peticion"] = "solicitud_usuario";
		echo json_encode($solicitud->Transaccion($peticion));
		exit;
	}

	if (isset($_POST["solicitud"]) and $_POST["motivo"] != NULL) {
		$solicitud->set_cedula_solicitante($datos["cedula"]);
		$solicitud->set_motivo($_POST["motivo"]);
		$peticion["peticion"] = "registrar";
		echo json_encode($solicitud->Transaccion($peticion));

		$msg = "(".$_SESSION['user']['nombre_usuario']."), Realizó una solicitud";
		$hora = date('H:i:s');
		$fecha = date('Y-m-d');
	
		$bitacora->set_usuario($_SESSION['user']['nombre_usuario']);
		$bitacora->set_modulo("Solicitudes");
		$bitacora->set_accion($msg);
		$bitacora->set_fecha($fecha);
		$bitacora->set_hora($hora);
		$bitacora->Transaccion($peticion);
		exit;
	}

	if (isset($_POST["reporte"])) {

		$hoja = new Hoja();
		$hoja->set_nro_solicitud($_POST["reporte"]);
		$hojas = $hoja->Transaccion('listar');
		$info = [];
		foreach ($hojas as $nro) {
			$hoja->set_cod_hoja($nro["cod_hoja"]);
			$datos_hoja = $hoja->Transaccion('Datos');
			$aux = $hoja->Transaccion('consultar_detalles');
			$valores = [];
			foreach ($aux as $detalle) {
				$valores[$detalle["componente"]] = $detalle["detalle"];
			}
			$info[] = [$datos_hoja, $valores];
		}
		require_once "model/reporte.php";
		$reporte = new reporte();
		ob_clean();
		$reporte->mis_servicios($info);
	}
	require_once "view/".$page.".php";
} else {
	require_once "view/404.php";
}
