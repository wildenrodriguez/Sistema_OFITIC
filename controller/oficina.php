<?php
if (!$_SESSION) {
    echo '<script>window.location="?page=login"</script>';
    $msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
    require_once "controller/utileria.php";
    require_once "model/oficina.php";

    $titulo = "Gestionar Oficinas";
    $cabecera = array('#', "Nombre", "Piso", "Edificio", "Modificar/Eliminar");

    $oficina = new Oficina();

    if (isset($_POST["entrada"])) {
        $json['resultado'] = "entrada";
        echo json_encode($json);
        $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Oficina";
        Bitacora($msg, "Oficina");
        exit;
    }

    if (isset($_POST["registrar"])) {
        $oficina->set_id_piso($_POST["id_piso"]);
        $oficina->set_nombre($_POST["nombre"]);
        $peticion["peticion"] = "registrar";
        $datos = $oficina->Transaccion($peticion);
        echo json_encode($datos);

        if($datos['estado'] == 1){
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró una nueva oficina";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar una nueva oficina";
        }
        Bitacora($msg, "Oficina");
        exit;
    }

    if (isset($_POST['consultar'])) {
        $peticion["peticion"] = "consultar";
        $datos = $oficina->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["consultar_eliminadas"])) {
        $peticion["peticion"] = "consultar_eliminadas";
        $datos = $oficina->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["restaurar"])) {
        $oficina->set_id($_POST["id_oficina"]);
        $peticion["peticion"] = "restaurar";
        $datos = $oficina->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST['consultar_pisos'])) {
        $peticion["peticion"] = "consultar_pisos";
        $datos = $oficina->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["modificar"])) {
        $oficina->set_id($_POST["id_oficina"]);
        $oficina->set_id_piso($_POST["id_piso"]);
        $oficina->set_nombre($_POST["nombre"]);
        $peticion["peticion"] = "actualizar";
        $datos = $oficina->Transaccion($peticion);
        echo json_encode($datos);

        if($datos['estado'] == 1){
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro de la oficina";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar oficina";
        }
        Bitacora($msg, "Oficina");
        exit;
    }

    if (isset($_POST["eliminar"])) {
        $oficina->set_id($_POST["id_oficina"]);
        $peticion["peticion"] = "eliminar";
        $datos = $oficina->Transaccion($peticion);
        echo json_encode($datos);

        if($datos['estado'] == 1){
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó una oficina";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar una oficina";
        }
        Bitacora($msg, "Oficina");
        exit;
    }

    $pisos = $oficina->Transaccion(['peticion' => 'consultar_pisos']);

    require_once "view/" . $page . ".php";
} else {
    require_once "view/404.php";
}
?>