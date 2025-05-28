<?php

if (!$_SESSION) {
    echo '<script>window.location="?page=login"</script>';
    $msg["danger"] = "Sesion Finalizada.";
}

ob_start();

if (is_file("view/" . $page . ".php")) {

    require_once "controller/utileria.php";
    require_once "model/Switch_.php";

    $titulo = "Gestionar Switch";
    $cabecera = array('Código de Bien', "Cantidad de Puertos", "Serial", "Modificar / Eliminar");

    $switch = new Switch_();

    if (isset($_POST["entrada"])) {
        $json['resultado'] = "entrada";
        echo json_encode($json);
        $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Switch";
        Bitacora($msg, "Switch");
        exit;
    }

    if (isset($_POST["registrar"])) {
        $switch->set_codigo_bien($_POST["codigo_bien"]);
        $switch->set_cantidad_puertos($_POST["cantidad_puertos"]);
        $switch->set_serial_switch($_POST["serial_switch"]);

        $peticion["peticion"] = "registrar";
        $datos = $switch->Transaccion($peticion);
        echo json_encode($datos);

        if($datos['estado'] == 1){
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo Switch";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo Switch";
        }
        Bitacora($msg, "Switch");
        exit;
    }

    if (isset($_POST['consultar'])) {
        $peticion["peticion"] = "consultar";
        $datos = $switch->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["consultar_eliminadas"])) {
        $peticion["peticion"] = "consultar_eliminadas";
        $datos = $switch->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST['consultar_bien'])) {
        $datos = $switch->ConsultarBien();
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["restaurar"])) {
        $switch->set_codigo_bien($_POST["codigo_bien"]);
        $peticion["peticion"] = "restaurar";
        $datos = $switch->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["modificar"])) {
        $switch->set_codigo_bien($_POST["codigo_bien"]);
        $switch->set_cantidad_puertos($_POST["cantidad_puertos"]);
        $switch->set_serial_switch($_POST["serial_switch"]);

        $peticion["peticion"] = "actualizar";
        $datos = $switch->Transaccion($peticion);
        echo json_encode($datos);

        if($datos['estado'] == 1){
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del Switch";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar el Switch";
        }
        Bitacora($msg, "Switch");
        exit;
    }

    if (isset($_POST["eliminar"])) {
        $switch->set_codigo_bien($_POST["codigo_bien"]);
        $peticion["peticion"] = "eliminar";
        $datos = $switch->Transaccion($peticion);
        echo json_encode($datos);

        if($datos['estado'] == 1){
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un Switch";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un Switch";
        }
        Bitacora($msg, "Switch");
        exit;
    }

    $bien = $switch->Transaccion(['peticion' => 'consultar_bien']);

    require_once "view/" . $page . ".php";

} else {
    require_once "view/404.php";
}

?>