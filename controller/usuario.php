<?php 
    if (!$_SESSION) {
		echo'<script>window.location="?page=login"</script>';
	}

	ob_start();

	require_once "model/usuario.php";
	print_r($_SESSION);
	$peticion = [];
	$peticion['peticion'] = "permiso";
	$peticion['user'] = $_SESSION['user']['rol'];
	$peticion['rol'] = 'Super usuario';
	$usuario = new Usuario();
	if(!$usuario->Transaccion($peticion));
		echo'<script>window.location="?page=404"</script>';

	if (is_file("view/".$page.".php")) {

		// Estilos de Pagina
		$titulo = "Usuarios";
		$css = ["alert"];

		// Datos del Usuario Actual
		$usuario->set_cedula($_SESSION['user']['cedula']);
		
		$datos = $_SESSION['user'];
		$datos = $datos + $usuario->datos();

        require_once "model/empleado.php";
		$emp = new empleado();
		$cedulas = $emp->no_usuarios();

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
		if (isset($_POST['eliminar'])) {
			
			$usuario->set_cedula($_POST['eliminar']);
			$usuario->Eliminar();
			ob_clean();
			header("Refresh:0");
		}

		$registros=[];
		$info=$usuario->ConsultaUsuarios();
		$cabecera = array('Cedula',"Nombre","Rol","Tipo","Contraseña");
		foreach ($info as $id => $user) {
				$registros[$id]=[$user["Cedula"],$user["Nombre"],$user["Rol"],$user["Tipo"],$user["Clave"]];
		}
		$btn_color = "danger";
		$btn_icon = "trash3";
		$btn_name = "eliminar";
		$btn_value = "0";
		$origen = "";

		require_once "view/$page.php";
	} else {
		require_once "view/404.php";
	}
 ?>