<?php

if (!$_SESSION) {
    echo '<script>window.location="?page=login"</script>';
    $msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
    require_once "controller/utileria.php";
    require_once "model/punto_conexion.php";
    require_once "model/equipo.php";
    require_once "model/patch_panel.php";

    $titulo = "Gestionar Punto de Conexión";
    $cabecera = array('ID', "Patch Panel", "Equipo", "Puerto", "Modificar / Eliminar");

    $punto_conexion = new punto_conexion();
    $equipo = new equipo();
    $patch_panel = new patch_panel();

    
    $peticion_equipos["peticion"] = "consultar";
    $equipos = $equipo->Transaccion($peticion_equipos);
    $equipos = isset($equipos['datos']) ? $equipos['datos'] : [];
    
    
    $peticion_patch["peticion"] = "consultar";
    $patch_panels = $patch_panel->Transaccion($peticion_patch);
    $patch_panels = isset($patch_panels['datos']) ? $patch_panels['datos'] : [];

    

    if (isset($_POST["entrada"])) {
        $json['resultado'] = "entrada";
        echo json_encode($json);
        $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Punto de Conexión";
        Bitacora($msg, "punto conexion");
        exit;
    }

    if (isset($_POST["registrar"])) {
        
        $punto_conexion->set_id_equipo($_POST["id_equipo"]);
        $punto_conexion->set_codigo_patch_panel($_POST["codigo_patch_panel"]);
        $punto_conexion->set_puerto_patch_panel($_POST["puerto_patch_panel"]);
        $peticion["peticion"] = "registrar";
        $json = $punto_conexion->Transaccion($peticion);

        if ($json['estado'] == 1) {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo Punto de Conexión";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo Punto de Conexión";
        }
        echo json_encode($json);
        Bitacora($msg, "punto_conexion");
        exit;
    }

    if (isset($_POST['consultar'])) {
        $peticion["peticion"] = "consultar";
        $json = $punto_conexion->Transaccion($peticion);
        echo json_encode($json);
        exit;
    }

    if (isset($_POST["modificar"])) {
        $punto_conexion->set_id_punto_conexion($_POST["id_punto_conexion"]);
        $punto_conexion->set_codigo_patch_panel($_POST["codigo_patch_panel"]);
        $punto_conexion->set_id_equipo($_POST["id_equipo"]);
        $punto_conexion->set_puerto_patch_panel($_POST["puerto_patch_panel"]);
        $peticion["peticion"] = "actualizar";
        $json = $punto_conexion->Transaccion($peticion);

        if ($json['estado'] == 1) {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el Punto de Conexión";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar el Punto de Conexión";
        }
        echo json_encode($json);
        Bitacora($msg, "punto_conexion");
        exit;
    }

    if (isset($_POST["eliminar"])) {
        $punto_conexion->set_id_punto_conexion($_POST["id_punto_conexion"]);
        $peticion["peticion"] = "eliminar";
        $json = $punto_conexion->Transaccion($peticion);

        if ($json['estado'] == 1) {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un Punto de Conexión";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un Punto de Conexión";
        }
        echo json_encode($json);
        Bitacora($msg, "punto_conexion");
        exit;
    }

    
    require_once "view/" . $page . ".php";

} else {

    require_once "view/404.php";

}