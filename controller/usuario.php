<?php 
    if (!$_SESSION) {
		echo'<script>window.location="?page=login"</script>';
	}

	ob_start();

	require_once "model/usuario.php";
	require_once "model/empleado.php";
	require_once "model/bitacora.php";
	
	$usuario = new Usuario();
	$empleado = new Empleado();
	$peticion = [];
	$peticion['peticion'] = "permiso";
	$peticion['user'] = $_SESSION['user']['rol'];
	$peticion['rol'] = 'ADMINISTRADOR';
	$permiso = $usuario->Transaccion($peticion);

	if($permiso == 0){ echo'<script>window.location="?page=404"</script>';}

	$cabecera = array("Cedula","Nombre","Apellido","Rol","Técnico", "Servicio", "Acciones");
	
	if (is_file("view/".$page.".php")) {
		$titulo = "Usuarios";
		$css = ["alert"];

		$usuario->set_cedula($_SESSION['user']['cedula']);
		
		$datos = $_SESSION['user'];
		$datos = $datos + $usuario->Transaccion(['peticion' => 'perfil']);

		$cedulas = $empleado->no_usuarios();

		if (isset($_POST["registrar_usuario"])) {
			
			$usuario->set_cedula($_POST['cedula']);
			$clave = password_hash($_POST['cedula'], PASSWORD_BCRYPT);
			$usuario->set_clave($clave);

			if (!$usuario->validar()){
				$usuario->set_rol($_POST['rol']);

				if($usuario->Registrar()){
                    if ($_POST['rol']=="Técnico") {
                        $usuario->set_tipo($_POST['tipo']);
                        $usuario->crear_tecnico();
                    }
                    ob_clean();
					header("Refresh:0");
				}else{
				}
			}else{
			}

		}

		if(isset($_POST['consultar'])){
			$peticion['peticion'] = "consultar"; 
			echo json_encode($usuario->Transaccion($peticion));
			exit;
		}
		
		if (isset($_POST['eliminar'])) {
			
			$usuario->set_cedula($_POST['eliminar']);
			$usuario->Eliminar();
			ob_clean();
			header("Refresh:0");
		}


		require_once "view/$page.php";
	} else {
		require_once "view/404.php";
	}
 ?>