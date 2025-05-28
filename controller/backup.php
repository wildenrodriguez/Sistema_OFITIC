<?php
if (!$_SESSION) {
    echo '<script>window.location="?page=login"</script>';
    $msg["danger"] = "Sesión Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
    require_once "controller/utileria.php";
    require_once "model/backup.php";

    $titulo = "Gestión de Backups";
    $backup = new Backup();


    if (isset($_POST["generar"])) {
        
        $backup->setBaseDatos($_POST["base_datos"]);
        $peticion["peticion"] = "generar";
        $datos = $backup->Transaccion($peticion);

        

        if ($datos['estado'] == 1) {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se generó un nuevo backup";
            echo "<script>
                    Swal.fire('Éxito', '{$datos['mensaje']}', 'success').then(() => {
                        window.location = '?page=backup';
                    });
                </script>";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al generar un backup";
            echo "<script>
                    Swal.fire('Error', '{$datos['mensaje']}', 'error').then(() => {
                        window.location = '?page=backup';
                    });
                </script>";
        }
        Bitacora($msg, "Backup");
        

        header("Location: ?page=backup");
        exit;
    }

    if (isset($_POST["eliminar"])) {
        $peticion["peticion"] = "eliminar";
        $peticion["filename"] = $_POST["filename"];
        $datos = $backup->Transaccion($peticion);

        if ($datos['estado'] == 1) {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un backup";
            echo "<script>
                    Swal.fire('Éxito', '{$datos['mensaje']}', 'success').then(() => {
                        window.location = '?page=backup';
                    });
                </script>";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un backup";
            echo "<script>
                    Swal.fire('Error', '{$datos['mensaje']}', 'error').then(() => {
                        window.location = '?page=backup';
                    });
                </script>";
        }
        Bitacora($msg, "Backup");
        header("Location: ?page=backup");
        exit;
    }
    if (isset($_POST["importar"])) {
        $peticion["peticion"] = "importar";
        $peticion["filename"] = $_POST["filename"];
        $datos = $backup->Transaccion($peticion);

        if ($datos['estado'] == 1) {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se importó un backup";
            echo "<script>
                    Swal.fire('Éxito', '{$datos['mensaje']}', 'success').then(() => {
                        window.location = '?page=backup';
                    });
                </script>";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al importar un backup";
            echo "<script>
                    Swal.fire('Error', '{$datos['mensaje']}', 'error').then(() => {
                        window.location = '?page=backup';
                    });
                </script>";
        }
        Bitacora($msg, "Backup");
        header("Location: ?page=backup");
        exit;
    }


    $backups = $backup->Transaccion(['peticion' => 'listar']);
    require_once "view/" . $page . ".php";
} else {
    require_once "view/404.php";
}
