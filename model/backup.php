<?php
require_once "model/conexion.php";

class Backup extends Conexion
{
    private $backupPath;
    private $conex;
    private $baseDatos;

    public function __construct()
    {
        $this->conex = new Conexion($this->baseDatos = "usuario");
        $this->conex = $this->conex->Conex();
        $this->backupPath = "backups/"; // Carpeta donde se guardarán los backups
    }

    public function setBaseDatos($baseDatos)
    {
        $this->baseDatos = $baseDatos;
        $this->conex = new Conexion($this->baseDatos);
        $this->conex = $this->conex->Conex();
    }

    public function GenerarBackup()
    {
        $dato = [];
        try {
            $dbname = $this->conex->query("SELECT DATABASE()")->fetchColumn();
            $filename = $this->backupPath . "backup_" . date("Y-m-d_H-i-s") . "_" . $this->baseDatos .".sql";

            $command = "mysqldump --user=" . _DB_USER_ . " --password=" . _DB_PASS_ . " --host=" . _DB_HOST_ . " --databases $dbname --add-drop-database > $filename";
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

    public function ImportarBackup($filename)
    {
        $dato = [];
        try {
            // Verificar que el archivo existe
            $filePath = $this->backupPath . $filename;
            if (!file_exists($filePath)) {
                throw new Exception("El archivo de backup no existe.");
            }

            // Obtener el nombre de la base de datos actual
            $dbname = $this->conex->query("SELECT DATABASE()")->fetchColumn();
            if (empty($dbname)) {
                throw new Exception("No se ha seleccionado una base de datos.");
            }

            // Comando para importar
            $command = "mysql --user=" . _DB_USER_ . " --password=" . _DB_PASS_ . 
                      " --host=" . _DB_HOST_ . " $dbname < $filePath";
            
            system($command, $output);

            if ($output === 0) {
                $dato['estado'] = 1;
                $dato['mensaje'] = "Backup importado exitosamente a la base de datos: $dbname";
            } else {
                $dato['estado'] = -1;
                $dato['mensaje'] = "Error al importar el backup. Código de error: $output";
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
            
            case 'importar':
            return $this->ImportarBackup($peticion['filename']);

            default:
                return ["estado" => -1, "mensaje" => "Operación no válida"];
        }
    }
}
?>
