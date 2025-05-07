<?php
require_once "controller/utileria.php";


Bitacora("Cerró sesión", "Usuario");

session_unset();
session_destroy();
echo '<script>window.location="?page=login"</script>';
?>