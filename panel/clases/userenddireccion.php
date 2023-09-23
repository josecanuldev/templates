<?php
	include_once('conexion.php');
	class userenddireccion{

		var $iddireccion;
		var $nombreDireccion;
		var $nombre;
		var $apellido;
		var $telefono;
		var $correo;
		var $direccion;
		var $pais;
		var $estado;
		var $ciudad;
		var $zip;
		var $iduserend;
		var $status;

		function userenddireccion($iddireccion = 0, $iduserend = 0,$nombreDireccion = '', $nombre = '', $apellido = '', $telefono = '', $correo = '', $direccion = '', $ciudad = '', $zip = '', $status = 0, $pais = '', $estado = "" ){
			$this->iddireccion = $iddireccion;
			$this->nombreDireccion = $nombreDireccion;
			$this->nombre = $nombre;
			$this->apellido = $apellido;
			$this->telefono = $telefono;
			$this->correo = $correo;
			$this->direccion = $direccion;
			$this->ciudad = $ciudad;
			$this->zip = $zip;
			$this->iduserend = $iduserend;
			$this->status = $status;
			$this->pais = $pais;
			$this->estado = $estado;	
		}

		function agregarDireccion(){
			$con = new conexion();
			if($this->status != 0){
				$sql1 = "UPDATE direcciones set status = 0 where iduserend = ".$this->iduserend."";
				$con->ejecutar_sentencia($sql1);
			}
			$sql = "INSERT INTO direcciones (iduserend,nombreDireccion, nombre, apellido, telefono, correo, direccion, ciudad, zip, status, pais, estado) VALUES (".$this->iduserend.",'".htmlspecialchars($this->nombreDireccion, ENT_QUOTES)."', '".htmlspecialchars($this->nombre, ENT_QUOTES)."', '".htmlspecialchars($this->apellido, ENT_QUOTES)."', '".htmlspecialchars($this->telefono, ENT_QUOTES)."', '".htmlspecialchars($this->correo)."', '".htmlspecialchars($this->direccion, ENT_QUOTES)."', '".htmlspecialchars($this->ciudad, ENT_QUOTES)."', '".htmlspecialchars($this->zip, ENT_QUOTES)."', ".$this->status.", '".htmlspecialchars($this->pais, ENT_QUOTES)."', '".htmlspecialchars($this->estado. ENT_QUOTES)."')";
			$con->ejecutar_sentencia($sql);
		}
		function modificarDireccion(){
			$con = new conexion();
			$sql1 = "UPDATE direcciones set status = 0";
			$con->ejecutar_sentencia($sql1);
			$sql = "UPDATE direcciones SET 
			nombreDireccion = '".htmlspecialchars($this->nombreDireccion, ENT_QUOTES)."',
			nombre = '".htmlspecialchars($this->nombre, ENT_QUOTES)."',
			apellido = '".htmlspecialchars($this->apellido, ENT_QUOTES)."',
			telefono = '".htmlspecialchars($this->telefono, ENT_QUOTES)."',
			correo = '".htmlspecialchars($this->correo, ENT_QUOTES)."',
			direccion = '".htmlspecialchars($this->direccion, ENT_QUOTES)."',
			ciudad = '".htmlspecialchars($this->ciudad, ENT_QUOTES)."',
			zip = '".htmlspecialchars($this->zip, ENT_QUOTES)."',
			status = ".$this->status.",
			pais = '".htmlspecialchars($this->pais)."',
			estado = '".htmlspecialchars($this->estado)."' 
			WHERE iddireccion = ".$this->iddireccion." ";
			$con->ejecutar_sentencia($sql);
		}
		function defaultDireccion(){
			$con = new conexion();
			$sql1 = "UPDATE direcciones set status = 0";
			$con->ejecutar_sentencia($sql1);
			$sql = "UPDATE direcciones set status = 1 WHERE iddireccion = ".$this->iddireccion."";
			$con->ejecutar_sentencia($sql);
		}
		function eliminarDireccion(){
			$con = new conexion();
			$sql = "DELETE FROM direcciones WHERE iddireccion = ".$this->iddireccion."";
			$con->ejecutar_sentencia($sql);
		}
		function listarDirecciones(){
			$resultados = array();
			$con = new conexion();
			$sql = "SELECT * FROM direcciones where iduserend = ".$this->iduserend."";
			$temporal = $con->ejecutar_sentencia($sql);
			while($row = mysqli_fetch_array($temporal)){
				$result = array();
				$result['iddireccion'] = $row['iddireccion'];
				$result['nombreDireccion'] = $row['nombreDireccion'];
				$result['nombre'] = $row['nombre'];
				$result['apellido'] = $row['apellido'];
				$result['telefono'] = $row['telefono'];
				$result['correo'] = $row['correo'];
				$result['direccion'] = $row['direccion'];
				$result['ciudad'] = $row['ciudad'];
				$result['zip'] = $row['zip'];
				$result['iduserend'] = $row['idusrend'];
				$result['status'] = $row['status'];
				$result['pais'] = $row['pais'];
				$result['estado'] = $row['estado'];
				array_push($resultados, $result);
			}
			//mysqli_free_result($resultados);
			return $resultados;
		}
		function obtenerDireccion(){
			$con = new conexion();
			$sql = "select * from direccion where iddireccion=".$this->iddireccion."";
			$result = $con->ejecutar_sentencia($sql);
			while($row = mysqli_fetch_array($result)){
				$this->iddireccion = $row['iddireccion'];
				$this->nombreDireccion = $row['nombre'];
				$this->nombre= $row['nombre'];
				$this->apellido = $row['apellido'];
				$this->telefono = $row['telefono'];
				$this->correo = $row['email'];
				$this->direccion= $row['direccion'];
				$this->referencia= $row['referencias'];
				$this->zip = $row['codigopostal'];
				$this->ciudad = $row['ciudad'];
				$this->pais = $row['pais'];
				$this->estado = $row['estado'];
			}
		}
	}
?>