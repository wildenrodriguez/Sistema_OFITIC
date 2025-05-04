<?php
if (!$_SESSION) {
    echo '<script>window.location="?page=login"</script>';
    $msg["danger"] = "Sesion Finalizada.";
}

require_once "model/usuario.php";
$usuario = new Usuario();

if(is_file("view/$page.php")){
    $peticion = [];
    $titulo = "Gestion de Equipos";
    $css = ["alert","style"];
    $cabecera = array("#","Serial","Tipo","Marca","Nro. bien","Dependencia", "Acciones");

    $usuario->set_cedula($_SESSION['user']['cedula']);
    $datos = $_SESSION['user'];
    $datos = $datos + $usuario->Transaccion(['peticion' => 'perfil']);

    require_once('model/equipo.php');
    $equipo = new Equipo();
    require_once('model/configuracion.php');
    $config = new Configuracion();
    require_once('model/bien.php');
    $bien = new Bien();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['accion'])) {
            $equipo->set_datos($_POST);
            
            switch ($_POST['accion']) {
                case 'registrar':
                    // Validar serial
                    if ($equipo->Transaccion(['peticion' => 'validar'])) {
                        echo json_encode([
                            'success' => false,
                            'message' => 'El serial ya está registrado'
                        ]);
                        exit;
                    }
                    
                    // Validar que el bien no tenga equipo asignado
                    if (!empty($_POST['nro_bien'])) {
                        $bienAsignado = $equipo->Transaccion([
                            'peticion' => 'validar_bien',
                            'nro_bien' => $_POST['nro_bien']
                        ]);
                        
                        if ($bienAsignado) {
                            echo json_encode([
                                'success' => false,
                                'message' => 'El bien ya tiene un equipo asignado'
                            ]);
                            exit;
                        }
                    }
                    
                    // Registrar equipo
                    $result = $equipo->Transaccion(['peticion' => 'registrar']);
                    echo json_encode([
                        'success' => $result,
                        'message' => $result ? 'Equipo registrado exitosamente' : 'Error al registrar el equipo'
                    ]);
                    exit;
                    
                case 'modificar':
                    // Validar que el nuevo bien no tenga equipo asignado (excepto si es el mismo equipo)
                    if (!empty($_POST['nro_bien'])) {
                        $bienAsignado = $equipo->Transaccion([
                            'peticion' => 'validar_bien',
                            'nro_bien' => $_POST['nro_bien'],
                            'excluir' => $_POST['id']
                        ]);
                        
                        if ($bienAsignado) {
                            echo json_encode([
                                'success' => false,
                                'message' => 'El bien ya tiene un equipo asignado'
                            ]);
                            exit;
                        }
                    }
                    
                    // Actualizar equipo
                    $result = $equipo->Transaccion(['peticion' => 'modificar']);
                    echo json_encode([
                        'success' => $result,
                        'message' => $result ? 'Equipo actualizado exitosamente' : 'Error al actualizar el equipo'
                    ]);
                    exit;
                    
                case 'eliminar':
                    $result = $equipo->Transaccion(['peticion' => 'eliminar']);
                    echo json_encode([
                        'success' => $result,
                        'message' => $result ? 'Equipo eliminado exitosamente' : 'Error al eliminar el equipo'
                    ]);
                    exit;
                    
                case 'consultar':
                    $equipos = $equipo->Transaccion(['peticion' => 'consultar']);
                    echo json_encode([
                        'data' => $equipos
                    ]);
                    exit;
                    
                case 'bienes_disponibles':
                    $bienes = $bien->Transaccion([
                        'peticion' => 'listar_disponibles',
                        'excluir_bien' => $_POST['excluir_bien'] ?? null
                    ]);
                    echo json_encode($bienes);
                    exit;
            }
        }
        
        if (isset($_POST["reporte"])) {
            require_once "model/reporte.php";
            $reporte = new reporte();
            ob_clean();
            $reporte->equipos($equipo->Transaccion(['peticion' => 'consultar']));
            exit;
        }
    }

    $peticion['peticion'] = "consulta_marcas";
    $marcas = $equipo->Transaccion($peticion);
    
    $config->set_tabla('dependencia');
    $dependencias = $config->Transaccion("consultar");
    
    $bienes = $bien->Transaccion(['peticion' => 'listar_disponibles']);
    require_once "view/$page.php";
} else {
    require_once "view/404.php";
}
?>