<?php 
	if (!$_SESSION) {
		echo'<script>window.location="?page=login"</script>';
		$msg["danger"] = "Sesion Finalizada.";
	}
	ob_start();

	require_once "model/Usuarios.php";
	$usuario = new Usuario();
	if(!$usuario->validar_entrada($_SESSION['user']['rol'],["Super usuario"]))
		echo'<script>window.location="?page=404"</script>';
	
	if (is_file("view/".$page.".php")) {

		$titulo = "Registrar usuario";
		$css = ["alert","create_user"];
			
		$usuario->set_cedula($_SESSION['user']);
		
		$datos = array();
		$datos_u = $usuario->datos_s();
		foreach($datos_u as $campo => $dato)
			$datos[$campo]=$dato;

		
		
		if ($_POST) {
		$super = new superusuario();

		$data = array();
        $data['Tlf'] = "";

		foreach ($_POST as $Dato => $value) {

			if ($Dato == 'particle' || $Dato == 'phone') {
                $data['Tlf'] = $data['Tlf'].$value;
			} else { if ($Dato != 'Foto') 
				$data[$Dato] = $value;
			}
			
		}
		ob_clean();
		$msg = $super->CreateUser($data,'Cedula', $data['Cedula']);

        }
		require_once "view/$page.php";
	} else {
		require_once "view/404.php";
	}
 ?>