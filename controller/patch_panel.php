<?php

    if (!$_SESSION) {

        echo '<script>window.location="?page=login"</script>';
        $msg["danger"] = "Sesion Finalizada.";

    }

    ob_start();

    if (is_file("view/" . $page . ".php")) {

        require_once "controller/utileria.php";
        require_once "model/patch_panel.php";

        $titulo = "Gestionar Patch Panel";
        $cabecera = array('Código de Bien', "Cantidad de Puertos", "Tipo de Patch Panel", "Modificar / Eliminar");

        $patch_panel = new patch_panel();

        if (isset($_POST["entrada"])) {

            $json['resultado'] = "entrada";
            echo json_encode($json);
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Patch Panel";
            Bitacora($msg, "Patch Panel");

            exit;
        }

        if (isset($_POST["registrar"])) {

            $patch_panel->set_codigo_bien($_POST["codigo_bien"]);
            $patch_panel->set_tipo_patch_panel($_POST["tipo_patch_panel"]);
            $patch_panel->set_cantidad_puertos($_POST["cantidad_puertos"]);
            $peticion["peticion"] = "registrar";
            $datos = $patch_panel->Transaccion($peticion);
            echo json_encode($datos);

            if($datos['estado'] == 1){
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo Patch Panel";
            } else {
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo Patch Panel";
            }
            Bitacora($msg, "Patch Panel");

            exit;
        }

        if (isset($_POST['consultar'])) {

            $peticion["peticion"] = "consultar";
            $datos = $patch_panel->Transaccion($peticion);
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

            $patch_panel->set_id($_POST["codigo_bien"]);
            $peticion["peticion"] = "restaurar";
            $datos = $patch_panel->Transaccion($peticion);
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

            $patch_panel->set_codigo_bien($_POST["codigo_bien"]);
            $patch_panel->set_tipo_patch_panel($_POST["tipo_patch_panel"]);
            $patch_panel->set_cantidad_puertos($_POST["cantidad_puertos"]);

            $peticion["peticion"] = "actualizar";
            $datos = $patch_panel->Transaccion($peticion);
            echo json_encode($datos);

            if($datos['estado'] == 1){

                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del Patch Panel";

            } else {

                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar el Patch Panel";

            }

            Bitacora($msg, "patch_panel");

            exit;
        }

        if (isset($_POST["eliminar"])) {

            $patch_panel->set_codigo_bien($_POST["codigo_bien"]);
            $peticion["peticion"] = "eliminar";
            $datos = $patch_panel->Transaccion($peticion);
            echo json_encode($datos);

            if($datos['estado'] == 1){

                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un Patch Panel";

            } else {
                
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un Patch Panel";
            }

            Bitacora($msg, "patch_panel");

            exit;
        }

        $bien = $patch_panel->Transaccion(['peticion' => 'consultar_bien']);

        require_once "view/" . $page . ".php";

    } else {

        require_once "view/404.php";

    }

?>