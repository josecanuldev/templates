<?php
include_once('conexion.php');

class requisito{
	var $idRequisito;
	var $idEmpleo;
	var $titulo;
	var $status;

	function __construct($idRequisito = 0, $idEmpleo = '', $titulo = ''){
		$this -> idRequisito = $idRequisito;
		$this -> idEmpleo = $idEmpleo;
		$this -> titulo = $titulo;
	}

	function addRequisito(){
		$sql = "INSERT INTO requisito(idEmpleo, titulo, status) VALUES (".$this -> idEmpleo.", '".htmlspecialchars($this -> titulo, ENT_QUOTES)."', 1)";
		$conexion = new conexion();
		$this -> idRequisito = $conexion -> ejecutar_sentencia($sql);
	}

	function updateRequisito(){
		$sql = "UPDATE requisito SET titulo = '".htmlspecialchars($this -> titulo, ENT_QUOTES)."' WHERE idRequisito = ".$this -> idRequisito;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deleteRequisito($todo = false){
		($todo) ? $sql = "DELETE FROM requisito WHERE idEmpleo = ".$this -> idEmpleo : $sql = "DELETE FROM requisito WHERE idRequisito = ".$this -> idRequisito;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateStatusRequisito($status){
		$sql = "UPDATE requisito SET status = ".$status." WHERE idRequisito = ".$this -> idRequisito;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function getRequisito(){
		$sql = "SELECT * FROM requisito WHERE idRequisito = ".$this -> idRequisito;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idRequisito = $obj -> idRequisito;
		$this -> idEmpleo = htmlspecialchars_decode($obj -> idEmpleo);
		$this -> titulo = htmlspecialchars_decode($obj -> titulo);
	}

	function listRequisito($frontEnd = false){
		($fronEnd) ? $status = ' AND status = 1 ' : $status = '';

		$sql = "SELECT * FROM requisito WHERE idEmpleo = ".$this -> idEmpleo." ".$status;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);

		$resultados = array();
		while($row = mysqli_fetch_array($temporal)){
			$registro['idRequisito'] = $row['idRequisito'];
			$registro['idEmpleo'] = $row['idEmpleo'];
			$registro['titulo'] = htmlspecialchars_decode($row['titulo']);
			$registro['status'] = $row['status'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

}
?>
