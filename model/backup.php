<?php
require_once "model/conexion.php";

class Backup extends Conexion
{
    private $backupPath;

    public function __construct()
    {
        $this->conex = new Conexion();
        $this->conex = $this->conex->Conex();
        $this->backupPath = "backups/"; // Carpeta donde se guardarán los backups
    }

    public function GenerarBackup()
    {
        $dato = [];
        try {
            $dbname = $this->conex->query("SELECT DATABASE()")->fetchColumn();
            $filename = $this->backupPath . "backup_" . date("Y-m-d_H-i-s") . ".sql";

            $command = "mysqldump --user=" . _DB_USER_ . " --password=" . _DB_PASS_ . " --host=" .  _DB_HOST_ . " $dbname > $filename";
            system($command, $output);

            if ($output === 0) {
                $dato['estado'] = 1;
                $dato['mensaje'] = "Backup generado exitosamente en: $filename";
            } else {
                $dato['estado'] = -1;
                $dato['mensaje'] = "Error al generar el backup.";
            }
        } catch (Exception $e) {
            $dato['estado'] = -1;
            $dato['mensaje'] = $e->getMessage();
        }
        return $dato;
    }

    public function ListarBackups()
    {
        $dato = [];
        try {
            if (!is_dir($this->backupPath)) {
                mkdir($this->backupPath, 0777, true); // Crear la carpeta si no existe
            }

            $files = array_diff(scandir($this->backupPath), ['.', '..']);
            $dato['estado'] = 1;
            $dato['archivos'] = $files;
        } catch (Exception $e) {
            $dato['estado'] = -1;
            $dato['mensaje'] = $e->getMessage();
        }
        return $dato;
    }

    public function EliminarBackup($filename)
    {
        $dato = [];
        try {
            $filePath = $this->backupPath . $filename;
            if (file_exists($filePath)) {
                unlink($filePath);
                $dato['estado'] = 1;
                $dato['mensaje'] = "Backup eliminado exitosamente.";
            } else {
                $dato['estado'] = -1;
                $dato['mensaje'] = "El archivo no existe.";
            }
        } catch (Exception $e) {
            $dato['estado'] = -1;
            $dato['mensaje'] = $e->getMessage();
        }
        return $dato;
    }

    public function Transaccion($peticion)
    {
        switch ($peticion['peticion']) {
            case 'generar':
                return $this->GenerarBackup();

            case 'listar':
                return $this->ListarBackups();

            case 'eliminar':
                return $this->EliminarBackup($peticion['filename']);

            default:
                return ["estado" => -1, "mensaje" => "Operación no válida"];
        }
    }
}
?>
