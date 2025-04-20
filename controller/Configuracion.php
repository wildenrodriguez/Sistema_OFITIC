<?php
if (!$_SESSION) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}
ob_start();

if ($_GET['dato'] != "unidad" and $_GET['dato'] != "dependencia" and $_GET['dato'] != "marca") {
	echo '<script>window.location="?page=404"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}

require_once "model/usuario.php";
$usuario = new Usuario();
if(!$usuario->Transaccion([
	'peticion' => 'permiso',
	'user' => $_SESSION['user']['rol'],
	'rol' => ["Super usuario", "Administrador"]
])) {
	//echo '<script>window.location="?page=404"</script>';
}

if (is_file("view/Configuracion.php")) {

	$titulo = "Configuración";
	$css = ["alert", "style"];
	$usuario->set_cedula($_SESSION['user']['cedula']);

	$datos = $_SESSION['user'];
	$datos = $datos + $usuario->Transaccion(['peticion' => 'perfil']);

	$dato = $_GET['dato'];
	$tablas = [$dato];
	$datos_tablas = [];

	# Datos para la tabla

	require_once "model/configuracion.php";
	$config = new Configuracion();


	foreach ($tablas as $tabla) {
		$config->set_tabla($tabla);
		$datos_tablas[$tabla] = $config->Transaccion("consultar");
	}


	if (isset($_POST['registrar'])) {
		$nombre = $_POST['nombre'];
		$tab = $_POST['registrar'];
		$config->set_tabla($tab);
		$config->set_nombre($nombre);

		$config->Transaccion("crear");

		echo '<script>window.location="?page=Configuracion"' . $dato . '"</script>';
		header("refresh:0");
	}

	if (isset($_POST['eliminar'])) {

		$eliminar = explode(" ", $_POST['eliminar']);
		$config->set_tabla($eliminar[0]);
		$config->set_codigo($eliminar[1]);

		$config->Transaccion("eliminar");

		echo '<script>window.location="?page=Configuracion&dato=' . $dato . '"</script>';
		header("refresh:0");
	}

	if (isset($_POST["reporte"])) {
		require_once "model/reporte.php";
		$reporte = new reporte();
		require_once "model/solicitud.php";

		$tabla = $_POST['reporte'];
		$config->set_tabla($tabla);
		ob_end_clean();
		$reporte->Unidades($config->Transaccion("reporte"), $_POST['reporte']);
		//$_SESSION['servicio']=$servi->consulta_reporte();
		//$reporte->mpdf();
	}

	if (isset($_POST["enviar"])) {
		$aray = [
			$_POST["nombre"],
			$_POST["apellido"],
			$_POST["edad"]
		];

		echo json_encode($aray);
		// echo '$aray';
		die();
	}

	require_once "view/Configuracion.php";
} else {
	require_once "view/404.php";
}
