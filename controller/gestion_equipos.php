<?php
	if (!$_SESSION) {
		echo'<script>window.location="?page=login"</script>';
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
	var_dump($_SESSION['user']['rol']);
	if(is_file("view/$page.php")){

		$peticion = [];
		// Estilos de Pagina
		$titulo = "Gestion de Equipos";
		$css = ["alert","style"];

		if(isset($_POST["solicitud"]) and $_POST["motivo"]!=NULL){	
			require_once "model/solicitud.php";
            $soli = new Solicitud();
            $soli->set_cedula_solicitante($datos["cedula"]);
            $soli->set_motivo($_POST["motivo"]);
			$nro_solicitud = $soli->solicitar();
		}

		$usuario->set_cedula($_SESSION['user']['cedula']);
		
		$datos = $_SESSION['user'];
		$datos = $datos + $usuario->Transaccion(['peticion' => 'perfil']);

		// Lógica del Modelo
		require_once('model/equipo.php');
		$equipo = new Equipo();
		require_once('model/configuracion.php');
		$config = new Configuracion();

		$cabecera = array("#","Serial","Tipo","Marca","Nro. bien","Dependencia");

		// Opciones del Modulo
		if (isset($_POST)) {
			$equipo = new Equipo();
			$equipo->set_datos($_POST);

			if (isset($_POST['registrar'])) {
				$peticion['peticion'] = "validar";
				if (!$equipo->Transaccion($peticion)) {
					$peticion['peticion'] = "registrar";
					if($equipo->Transaccion($peticion['peticion'])){
						echo json_encode(['mensaje'=>'Se registró el Equipo','color'=>'alert-success']);
					}else{
						echo json_encode(['mensaje'=>'No se pudo registrar el Equipo','color'=>'alert-danger']);
					}
				}else{
					echo json_encode(['mensaje'=>'Serial ya registrado','color'=>'alert-warning']);
				}

				die();

			}else if (isset($_POST['modificar'])) {
				if($equipo->modificar()){
					echo json_encode(['mensaje'=>'Se modificó el Equipo','color'=>'alert-success']);
				}else{
					echo json_encode(['mensaje'=>'No se pudo modificar el Equipo','color'=>'alert-danger']);
				}
				die();
			}else if (isset($_POST['eliminar'])) {
				$equipo->set_datos($_POST['eliminar']);
				
				if($equipo->eliminar()){
					echo json_encode(['mensaje'=>'Se eliminó el Equipo','color'=>'alert-success']);
				}else{
					echo json_encode(['mensaje'=>'No se pudo eliminar el Equipo','color'=>'alert-danger']);
				}
				die();
			}
			if (isset($_POST['obtener_equipos'])) {
				echo json_encode($equipo->consultar());
				die();
			}
		}

		if(isset($_POST["reporte"])){
			require_once "model/reporte.php";
			$reporte = new reporte();
			require_once "model/equipo.php";
			$equipo = new Equipo();
			
			ob_end_clean();
			$reporte->equipos($equipo->consultar());
		}
		$peticion['peticion'] = "consulta_marcas";
		$marcas = $equipo->Transaccion($peticion);
		$config->set_tabla('dependencia');
		$dependencias = $config->Transaccion("consultar");

		require_once "view/$page.php";
	}else{
		require_once "view/404.php";
	}

?>
