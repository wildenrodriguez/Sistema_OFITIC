<?php 
	if (!$_SESSION) {
		echo'<script>window.location="?page=login"</script>';
		$msg["danger"] = "Sesion Finalizada.";
	}
	ob_start();

	require_once "model/usuario.php";
	$peticion = [];
	$usuario = new Usuario();
	$usuario->set_cedula($_SESSION['user']['cedula']);
	$petición['peticion'] = "perfil";
	$datos = $_SESSION['user'];
	$datos = $datos + $usuario->Transaccion($petición);

	if (is_file("view/".$page.".php")) {

		
		require_once "model/usuario.php";
		require_once "model/empleado.php";
		$usuario = new Usuario();
		$empleado = new Empleado();

		$titulo = "Mi Perfil";
		$css = ["alert"];

		if (isset($_POST['cambiar'])) {
			
			$nombre = $_POST['Nombre'];
			$apellido = $_POST['apellido'];
			$correo = $_POST['correo'];
			$tlf = $_POST['telefono'];

			$empleado->set_cedula($_SESSION['user']['cedula']);
			$empleado->set_nombre($nombre);
			$empleado->set_apellido($apellido);
			$empleado->set_telefono($tlf);
			$empleado->set_correo($correo);

			$empleado->modificar();
			if ($empleado->modificar()) {
				$msg["success"] = "Actualizado";
			} else {
				$msg["danger"] = "No se pudo actualizar";
			}
			$usuario->set_cedula($_SESSION['user']['cedula']);
			$datos = $empleado->datos_empleado() + $usuario->datos();
			$_SESSION['user']=$datos;

			ob_clean();
//			$registro = $usuario->datos();
//			foreach($registro as $campo => $dato)
//				$datos[$campo]=$dato;
		}

		if (isset($_POST['passw'])) {

			if ($_POST['newpassword'] == $_POST['renewpassword']){
	
				$usuario->set_clave($_POST['newpassword']);
				$usuario->set_cedula($_SESSION['user']["cedula"]);
				ob_clean();
				if ($usuario->ActualizarClave()) {
					unset($msg);
					$msg["success"] = "Actualizado";
				} else {
					$msg["danger"] = "No se pudo actualizar";
				}
			}else {
				$msg["danger"] = "Las contraseñas no coinciden";
			}
		}

		

		if ($datos['clave'] == $datos['cedula']) {
		
		$active3 = "active";
		$active4 = "show active";
	} else{$active1 = "active";
		   $active2 = "show active"; }

		require_once "view/users-profile.php";
      }else {
		require_once "view/404.php";
	  }
               
		
	
 ?>