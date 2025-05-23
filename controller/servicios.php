<?php
if (!$_SESSION) {
    echo '<script>window.location="?page=login"</script>';
    $msg["danger"] = "Sesión Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
    require_once "controller/utileria.php";
    require_once "model/hoja_servicio.php";

    $titulo = "Gestión de Servicios Técnicos";
    $cabecera = array('#', "N° Solicitud", "Tipo Servicio", "Solicitante", "Equipo", "Marca", "Serial", "Código Bien", "Motivo", "Fecha Solicitud", "Acciones");

    $hojaServicio = new HojaServicio();

    if (isset($_POST["entrada"])) {
        $json['resultado'] = "entrada";
        echo json_encode($json);
        $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Servicios Técnicos";
        Bitacora($msg, "Servicio");
        exit;
    }

    if (isset($_POST["registrar"])) {
        $hojaServicio->set_nro_solicitud($_POST["nro_solicitud"]);
        $hojaServicio->set_id_tipo_servicio($_POST["id_tipo_servicio"]);
        $peticion["peticion"] = "nuevo";
        $datos = $hojaServicio->Transaccion($peticion);
        echo json_encode($datos);

        if($datos){
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo servicio";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Error al registrar servicio";
        }
        Bitacora($msg, "Servicio");
        exit;
    }

    if (isset($_POST['consultar'])) {
        $peticion["peticion"] = "consultar";
        $datos = $hojaServicio->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST['consultar_tipos'])) {
        $peticion["peticion"] = "consultar_tipos";
        $datos = $hojaServicio->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST['tipos_disponibles'])) {
        $hojaServicio->set_nro_solicitud($_POST['nro_solicitud']);
        $peticion["peticion"] = "tipos_disponibles";
        $datos = $hojaServicio->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST['consultar_detalles'])) {
        $hojaServicio->set_codigo_hoja_servicio($_POST['codigo_hoja_servicio']);
        $peticion["peticion"] = "consultar_detalles";
        $datos = $hojaServicio->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST['servicios_por_tipo'])) {
        $hojaServicio->set_id_tipo_servicio($_POST['id_tipo_servicio']);
        $peticion["peticion"] = "servicios_por_tipo";
        $datos = $hojaServicio->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST['finalizar'])) {
        $hojaServicio->set_codigo_hoja_servicio($_POST['codigo_hoja_servicio']);
        $hojaServicio->set_cedula_tecnico($_POST['cedula_tecnico']);
        $hojaServicio->set_resultado_hoja_servicio($_POST['resultado_hoja_servicio']);
        $hojaServicio->set_observacion($_POST['observacion']);
        $peticion["peticion"] = "finalizar";
        $datos = $hojaServicio->Transaccion($peticion);
        echo json_encode($datos);

        if($datos){
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se finalizó el servicio " . $_POST['codigo_hoja_servicio'];
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Error al finalizar servicio";
        }
        Bitacora($msg, "Servicio");
        exit;
    }

    if (isset($_POST['registrar_detalles'])) {
        $hojaServicio->set_codigo_hoja_servicio($_POST['codigo_hoja_servicio']);
        $hojaServicio->set_detalles($_POST['detalles']);
        $peticion["peticion"] = "registrar_detalles";
        $datos = $hojaServicio->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST['limpiar_detalles'])) {
        $hojaServicio->set_codigo_hoja_servicio($_POST['codigo_hoja_servicio']);
        $peticion["peticion"] = "limpiar_detalles";
        $datos = $hojaServicio->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST['consultar_eliminados'])) {
        $peticion["peticion"] = "servicios_eliminados";
        $datos = $hojaServicio->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST['restaurar'])) {
        $hojaServicio->set_codigo_hoja_servicio($_POST['codigo_hoja_servicio']);
        $peticion["peticion"] = "restaurar";
        $datos = $hojaServicio->Transaccion($peticion);
        echo json_encode($datos);

        if($datos){
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se restauró el servicio " . $_POST['codigo_hoja_servicio'];
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Error al restaurar servicio";
        }
        Bitacora($msg, "Servicio");
        exit;
    }

    $tipos_servicio = $hojaServicio->Transaccion(['peticion' => 'consultar_tipos']);

    require_once "view/" . $page . ".php";
} else {
    require_once "view/404.php";
}
?>