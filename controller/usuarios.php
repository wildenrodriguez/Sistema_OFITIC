<?php 
    if (!$_SESSION) {
		echo'<script>window.location="?page=login"</script>';
	}

	ob_start();

	require_once "model/Usuarios.php";
	$usuario = new Usuario();
	if(!$usuario->validar_entrada($_SESSION['user']['rol'],["Super usuario"]))
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

			if (!$usuario->validar()){
				$usuario->set_rol($_POST['rol']);

				if($usuario->crear()){
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
			$usuario->eliminar();
			ob_clean();
			header("Refresh:0");
		}

		$registros=[];
		$info=$usuario->consulta_usuarios();
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