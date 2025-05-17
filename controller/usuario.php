<?php 
    if (!$_SESSION) {
		echo'<script>window.location="?page=login"</script>';
	}

	ob_start();

	require_once "controller/utileria.php";
	require_once "model/empleado.php";
	
	$usuario = new Usuario();
	$empleado = new Empleado();
	$peticion = [];
	$peticion['peticion'] = "permiso";
	$peticion['user'] = $_SESSION['user']['rol'];
	$peticion['rol'] = 'ADMINISTRADOR';
	$permiso = $usuario->Transaccion($peticion);

	if($permiso == 0){ echo'<script>window.location="?page=404"</script>';}

	$cabecera = array("Nombre de Usuario","Cedula","Nombre","Apellido","Rol", "Modificar/Eliminar");
	
	if (is_file("view/".$page.".php")) {
		$titulo = "Usuarios";
		$css = ["alert"];

		$usuario->set_cedula($_SESSION['user']['cedula']);
		
		$datos = $_SESSION['user'];
		$datos = $datos + $usuario->Transaccion(['peticion' => 'perfil']);

		if (isset($_POST["registrar"])) {
			
			$usuario->set_cedula($_POST['cedula']);
			$clave = password_hash($_POST['cedula'], PASSWORD_BCRYPT);
			$usuario->set_clave($clave);
		}

		if(isset($_POST['consultar'])){
			$peticion['peticion'] = "consultar"; 
			echo json_encode($usuario->Transaccion($peticion));
			exit;
		}
		
		if (isset($_POST['eliminar'])) {
			$peticion['peticion'] = "peticion";
			$usuario->set_cedula($_POST['eliminar']);
			$usuario->Transaccion();
			ob_clean();
			header("Refresh:0");
		}


		require_once "view/$page.php";
	} else {
		require_once "view/404.php";
	}
 ?>