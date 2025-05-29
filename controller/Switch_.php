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

    $bien = $switch->Transaccion(['peticion' => 'consultar_bien']);

    if (isset($_POST["entrada"])) {
        $json['resultado'] = "entrada";
        echo json_encode($json);
        $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Switch";
        Bitacora($msg, "Switch");
        exit;
    }

    if (isset($_POST["registrar"])) {

        $codigos_bien_validos = array_column($bien, 'codigo_bien');

        if (!in_array($_POST["codigo_bien"], $codigos_bien_validos)) {

            $json['resultado'] = "error";
            $json['mensaje'] = "Error, Seleccione un Código de Bien";
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

        } else if (!in_array($_POST["cantidad_puertos"], ["8", "10", "16", "24", "28", "48", "52"])) {
            $json['resultado'] = "error";
            $json['mensaje'] = "Error <br>Cantidad de Puertos no válido";
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";
                
        } else if (preg_match("/^[0-9a-zA-ZáéíóúüñÑçÇ\/\-.,# ]{3,45}$/", $_POST["serial_switch"]) == 0) {

            $json['resultado'] = "error";
            $json['mensaje'] = "Error, Serial del Switch no válido";
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

        } else {

            $switch->set_codigo_bien($_POST["codigo_bien"]);
            $switch->set_cantidad_puertos($_POST["cantidad_puertos"]);
            $switch->set_serial_switch($_POST["serial_switch"]);

            $peticion["peticion"] = "registrar";
            $json = $switch->Transaccion($peticion);

            if($json['estado'] == 1){
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo Switch";
            } else {
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo Switch";
            }

        }

        echo json_encode($json);
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

       if (!in_array($_POST["cantidad_puertos"], ["8", "10", "16", "24", "28", "48", "52"])) {
            $json['resultado'] = "error";
            $json['mensaje'] = "Error <br>Cantidad de Puertos no válido";
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";
                
        } else if (preg_match("/^[0-9a-zA-ZáéíóúüñÑçÇ\/\-.,# ]{3,45}$/", $_POST["serial_switch"]) == 0) {

            $json['resultado'] = "error";
            $json['mensaje'] = "Error, Serial del Switch no válido";
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";

        } else {

            $switch->set_codigo_bien($_POST["codigo_bien"]);
            $switch->set_cantidad_puertos($_POST["cantidad_puertos"]);
            $switch->set_serial_switch($_POST["serial_switch"]);

            $peticion["peticion"] = "actualizar";
            $json = $switch->Transaccion($peticion);

            if($json['estado'] == 1){
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del Switch";
            } else {
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar el Switch";
            }
    }

    echo json_encode($json);
    Bitacora($msg, "Switch");
    exit;
}

    if (isset($_POST["eliminar"])) {

            $switch->set_codigo_bien($_POST["codigo_bien"]);
            $peticion["peticion"] = "eliminar";
            $datos = $switch->Transaccion($peticion);


            if($datos['estado'] == 1){
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un Switch";
            } else {
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un Switch";
            }
        

        echo json_encode($datos);
        Bitacora($msg, "Switch");
        exit;

    }

   

    require_once "view/" . $page . ".php";

} else {
    require_once "view/404.php";
}

?>