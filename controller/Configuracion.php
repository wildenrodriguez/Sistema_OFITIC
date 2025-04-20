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
    require_once "vendor/autoload.php"; // Asegúrate que apunte al autoload de Composer
    
    $tabla = $_POST['reporte'];
    $config->set_tabla($tabla);
    $datos = $config->Transaccion("reporte");
    
    // Configurar opciones de DOMPDF
    $options = new Dompdf\Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    
    // Instanciar DOMPDF
    $dompdf = new Dompdf\Dompdf($options);
    
    // HTML para el PDF
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Reporte de '.$tabla.'</title>
        <style>
            body { font-family: Arial, sans-serif; }
            h1 { color: #333; text-align: center; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th { background-color: #f8f9fa; text-align: left; padding: 8px; }
            td { padding: 8px; border-bottom: 1px solid #ddd; }
            .header { margin-bottom: 20px; }
            .logo { width: 100px; }
            .fecha { text-align: right; }
        </style>
    </head>
    <body>
        <div class="header">
            <img src="'.$_SERVER['DOCUMENT_ROOT'].'/img/OFITIC.jpg" class="logo">
            <div class="fecha">Fecha: '.date('d/m/Y').'</div>
        </div>
        <h1>Reporte de '.ucfirst($tabla).'</h1>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>';
    
    foreach ($datos as $index => $fila) {
        $html .= '<tr>
                    <td>'.($index+1).'</td>
                    <td>'.$fila['nombre'].'</td>
                  </tr>';
    }
    
    $html .= '
            </tbody>
        </table>
    </body>
    </html>';
    
    // Cargar HTML
    $dompdf->loadHtml($html);
    
    // Configurar papel y orientación
    $dompdf->setPaper('A4', 'portrait');
    
    // Renderizar PDF
    $dompdf->render();
    
    // Enviar PDF al navegador para mostrarlo
    $dompdf->stream("reporte_".$tabla."_".date('Ymd').".pdf", array("Attachment" => false));
    
    exit();
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
