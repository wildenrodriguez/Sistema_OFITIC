<?php 
	if (!$_SESSION) {
		echo'<script>window.location="?page=login"</script>';
		$msg["danger"] = "Sesion Finalizada.";
	}
	ob_start();	

	require_once "model/Usuarios.php";
	$usuario = new Usuario();
	if(!$usuario->validar_entrada($_SESSION['user']['rol'],["Super usuario","Técnico"]))
		echo'<script>window.location="?page=404"</script>';

	if (is_file("view/".$page.".php")) {	

	

		
		$css = ["alert"];
		$usuario->set_cedula($_SESSION['user']['cedula']);
		
		$datos = $_SESSION['user'];
		$datos = $datos + $usuario->datos();
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
		$hoja=new hoja;
		$registros=[];
		if ($datos["tipo"]!="super") {
			$hoja->set_tipo_servicio($datos["tipo"]);
			$servicios=$hoja->servicios_t();
			foreach ($servicios as $servicio) {
				$registros[$servicio["hoja"]]=[$servicio["nro"],$servicio["solicitante"],$servicio["tipo"]."/".$servicio["marca"],$servicio["serial"]."/".$servicio["nro_bien"],$servicio["motivo"],$servicio["fecha"]];
			}
		} else {
			$servicios=$hoja->servicios_s();
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