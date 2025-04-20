<?php 
	if (!$_SESSION) {
		echo'<script>window.location="?page=login"</script>';
		$msg["danger"] = "Sesion Finalizada.";
	}
	ob_start();	

	require_once "model/usuario.php";
	$usuario = new Usuario();
	if(!$usuario->Transaccion([
		'peticion' => 'permiso',
		'user' => $_SESSION['user']['rol'],
		'rol' => ["Super usuario", "Técnico"]
	])) {
		echo '<script>window.location="?page=404"</script>';
	}

	if (is_file("view/".$page.".php")) {	

	

		
		$css = ["alert"];
		$usuario->set_cedula($_SESSION['user']['cedula']);
		
		$datos = $_SESSION['user'];
		$datos = $datos + $usuario->Transaccion(['peticion' => 'perfil']);
		if ($datos["rol"] == "Técnico") {
			require_once "model/tecnico.php";
			$tec = new tecnico();
			$tec->set_cedula($_SESSION['user']["cedula"]);
			$datos = $datos + $tec->tipo();
		}elseif ($datos["rol"] == "Super usuario") {
			$datos = $datos + ["tipo"=>"super"];
		}
		
		$titulo="Servicios";
		
		if ($datos["tipo"]!="super") {
			$cabecera = array('# Solicitud',"Solicitante","Equipo/Marca","Serial/N° Bien","Motivo","Fecha");
		} else {
			$cabecera = array('# Solicitud',"Solicitante","Equipo/Marca","Serial/N° Bien","Motivo","Fecha","Tipo");
		}
		
		$btn_color = "warning";
		$btn_icon = "info-circle";
		$btn_name = "nro_hoja";
		$btn_value = "1";
		$modal = "solicitud";
		$origen = "";
		require_once "model/Hoja_servicio.php";
		$hoja = new Hoja();
		$peticion = [];
		$registros = [];
		if ($datos["tipo"] != "super") {
			$hoja->set_tipo_servicio($datos["tipo"]);
			$peticion["peticion"] = "servicio_tipo";
			$servicios = $hoja->Transaccion($peticion);;
			foreach ($servicios as $servicio) {
				$registros[$servicio["hoja"]]=[$servicio["nro"],$servicio["solicitante"],$servicio["tipo"]."/".$servicio["marca"],$servicio["serial"]."/".$servicio["nro_bien"],$servicio["motivo"],$servicio["fecha"]];
			}
		} else {
			$peticion["peticion"] = "servicio_semanal";
			$servicios = $hoja->Transaccion($peticion);
			foreach ($servicios as $servicio) {
				$registros[$servicio["hoja"]]=[$servicio["nro"],$servicio["solicitante"],$servicio["tipo"]."/".$servicio["marca"],$servicio["serial"]."/".$servicio["nro_bien"],$servicio["motivo"],$servicio["fecha"],$servicio["tipo_s"]];
			}
		}

		ob_clean();
		
		require_once "view/$page.php";
	} else {
		require_once "view/404.php";
	}
 ?>