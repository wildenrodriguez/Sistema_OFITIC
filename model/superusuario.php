<?php
require_once 'model/Usuarios.php';

class SuperUsuario extends usuario{
	

	function __construct(){
		parent::__construct();
		$this->campos = array("Cedula", "Nombre", "Apellido", "Fecha_nac", "Correo", "Tlf", "Cargo", "Condicion_l", "Area", "Rol", "Nombre_usuario", "Contraseña");
		$this->tabla = "usuario";
	}

	public function CreateUser($data,$key,$Vkey){
			
		$con = $this->conex->prepare("SELECT * FROM $this->tabla WHERE $key=?");
		$con->execute([$Vkey]);
		$valid = $con->fetch();
		
		if (!$valid) {
			$sql = "INSERT INTO $this->tabla() VALUES(";

			$datos = array();
			foreach ($this->campos as $dato => $value) {
				$datos[] = $data[$value];
				$sql = $sql.'?';
				if ($value!=end($this->campos)) {
					$sql = $sql.', ';
				}
			}

			$sql = $sql.')';

			$registro = $this->conex->prepare($sql);
			if ($registro->execute($datos)) {
				return array("success" => "Usuario registrado con exito");
			} else {
				return array("danger" => "Ha ocurrido un error inesperado");
			}
			
		} else {
			return array("danger" => "Error: Usuario ya registrado");
		}
		
	}
}

?>