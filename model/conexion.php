<?php
require_once 'config/config.php';
class Conexion extends PDO
{
    private $conex;
    public function __construct($bd)
    {
        $nombre_bd = "";
        if ($bd == "sistema") {
            require_once 'config/system.php';
            $nombre_bd = _DB_NAME_SYSTEM_;
        } else if ($bd == "usuario") {
            require_once 'config/user.php';
            $nombre_bd = _DB_NAME_USER_;
        } else {
            $nombre_bd = "error";
        }
        $conexstring = "mysql:host=" . _DB_HOST_ . ";dbname=" . $nombre_bd . ";charset=utf8";
        try {
            $this->conex = new PDO($conexstring, _DB_USER_, _DB_PASS_);
            $this->conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conex->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET SESSION TRANSACTION ISOLATION LEVEL READ COMMITTED"
            );
        } catch (PDOException $e) {
            die("Conexión Fallida" . _DB_HOST_ . $nombre_bd . _DB_USER_ . _DB_PASS_ . $e->getMessage());
        }
    }
    protected function Conex()
    {
        return $this->conex;
    }

    protected function Cerrar_Conexion(&$conexion, &$stm)
    {
        unset($conexion);
        unset($stm);
    }
}
?>