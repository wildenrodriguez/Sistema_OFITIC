<?php
	if (!$_SESSION) {
		echo'<script>window.location="?page=login"</script>';
		$msg["danger"] = "Sesion Finalizada.";
	}

	ob_start();
	if (is_file("view/mis_servicios.php")) {
		$peticion = [];

		$titulo = "Mis Solicitudes";
		$css = ["alert","style"];
		$cabecera = array("#", "Motivo", "Fecha", "Estado","Resultado");

		$cabecera = array('#',"Motivo","Fecha Reporte","Estado","Resultado");

		$btn_color = "warning";
		$btn_icon = "filetype-pdf";
		$btn_name = "reporte";
		$btn_value = "0";
		$origen = "";

		require_once "model/solicitud.php";
		$solicitud = new Solicitud();
		$solicitud->set_cedula_solicitante($_SESSION['user']['cedula']);

		$peticion["peticion"] = "solicitud_usuario";
		$servicios = $solicitud->Transaccion($peticion);
		$registros = [];
		foreach ($servicios as $i => $servicio) {
			$registros[$i] = [$servicio["ID"],$servicio["Motivo"],$servicio["Inicio"],$servicio["Estatus"],$servicio["Resultado"]];
		}
		
		require_once "model/usuarios.php";
		$usuario = new Usuario();
		$usuario->set_cedula($_SESSION['user']['cedula']);
		
		$datos = $_SESSION['user'];
		$datos = $datos + $usuario->datos();

		if(isset($_POST["solicitud"]) and $_POST["motivo"]!=NULL){	
			require_once "model/solicitud.php";
            $solicitud = new Solicitud();
            $solicitud->set_cedula_solicitante($datos["cedula"]);
            $solicitud->set_motivo($_POST["motivo"]);
			$peticion["peticion"] = "registrar";
			ob_start();
			echo  json_encode($solicitud->Transaccion($peticion));
			$respuesta = ob_get_contents();
			ob_end_clean();
			
		}

		if(isset($_POST["reporte"])){	
			require_once "model/hoja_servicio.php";
            $hoja = new Hoja();
            $hoja->set_nro_solicitud($_POST["reporte"]);
            $hojas = $hoja->mis_hojas();
			$info=[];
			foreach ($hojas as $nro) {
				$hoja->set_cod_hoja($nro["cod_hoja"]);
				$datos_hoja = $hoja->datos_hoja();
				$aux = $hoja->consulta_detalles_hoja();
				$valores=[];
				foreach ($aux as $detalle) {
					$valores[$detalle["componente"]]=$detalle["detalle"];
				}
				$info[]=[$datos_hoja,$valores];
				
			}
			require_once "model/reporte.php";
			$reporte = new reporte();
			ob_clean();
			$reporte->mis_servicios($info);
		}

		require_once "view/mis_servicios.php";
	} else {
		require_once "view/404.php";
	}
	
 ?>