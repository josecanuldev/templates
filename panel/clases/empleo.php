<?php
require_once 'conexion.php';
require_once 'requisito.php';
require_once 'herramientas.php';

class empleo{
	var $idEmpleo;
	var $titulo;
	var $descripcion;
	var $lugar;
	var $salario;
	var $jornada;
	var $tipoContrato;
	var $requisitos;

	var $orden;
	var $status;

	var $herramientas;

	var $totalRegistros;
	var $registrosPorPagina;

	function __construct($idEmpleo = 0, $titulo = '', $descripcion = '', $lugar = '', $salario = '', $jornada = '', $tipoContrato = ''){
		$this -> idEmpleo = $idEmpleo;
		$this -> titulo = $titulo;
		$this -> descripcion = $descripcion;
		$this -> lugar = $lugar;
		$this -> salario = $salario;
		$this -> jornada = $jornada;
		$this -> tipoContrato = $tipoContrato;

		$this -> herramientas = new herramientas();

		$this -> requisitos = array();
		$this -> totalRegistros = 0;
		$this -> registrosPorPagina = 20;

	}

	function addEmpleo(){
		$sql = "INSERT INTO empleo(titulo, descripcion, lugar, salario, jornada, tipoContrato, status) VALUES ('".htmlspecialchars($this -> titulo, ENT_QUOTES)."', '".htmlspecialchars($this -> descripcion, ENT_QUOTES)."', '".htmlspecialchars($this -> lugar, ENT_QUOTES)."', '".htmlspecialchars($this -> salario, ENT_QUOTES)."', '".htmlspecialchars($this -> jornada, ENT_QUOTES)."', '".htmlspecialchars($this -> tipoContrato, ENT_QUOTES)."', 1)";
		$conexion = new conexion();
		$this -> idEmpleo = $conexion -> ejecutar_sentencia($sql);
		$sqlOrden = "UPDATE empleo SET orden = ".$this -> idEmpleo." WHERE idEmpleo = ".$this -> idEmpleo;
		$conexion -> ejecutar_sentencia($sqlOrden);
	}

	function updateEmpleo(){
		$sql = "UPDATE empleo SET titulo = '".htmlspecialchars($this -> titulo, ENT_QUOTES)."', descripcion = '".htmlspecialchars($this -> descripcion, ENT_QUOTES)."', lugar = '".htmlspecialchars($this -> lugar, ENT_QUOTES)."', salario = '".htmlspecialchars($this -> salario, ENT_QUOTES)."', jornada = '".htmlspecialchars($this -> jornada, ENT_QUOTES)."', tipoContrato =  '".htmlspecialchars($this -> tipoContrato, ENT_QUOTES)."' WHERE idEmpleo = ".$this -> idEmpleo;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deleteEmpleo(){
		$sql = "DELETE FROM empleo WHERE idEmpleo = ".$this -> idEmpleo;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateOrdenEmpleo($orden){
		$sql = "UPDATE empleo SET orden = ".$orden." WHERE idEmpleo = ".$this -> idEmpleo;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateStatusEmpleo($status){
		$sql = "UPDATE empleo SET status = ".$status." WHERE idEmpleo = ".$this -> idEmpleo;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function getEmpleo(){
		$sql = "SELECT * FROM empleo WHERE idEmpleo = ".$this -> idEmpleo;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idEmpleo = $obj -> idEmpleo;
		$this -> titulo = htmlspecialchars_decode($obj -> titulo);
		$this -> descripcion = htmlspecialchars_decode($obj -> descripcion);
		$this -> lugar = htmlspecialchars_decode($obj -> lugar);
		$this -> salario = htmlspecialchars_decode($obj -> salario);
		$this -> jornada = htmlspecialchars_decode($obj -> jornada);
		$this -> tipoContrato = htmlspecialchars_decode($obj -> tipoContrato);

		$this -> listarRequisito();
	}

	function listEmpleo($pagina = 1, $busqueda = "", $frontEnd = false){
		($busqueda != '') ? $palabra = " AND titulo LIKE '%".$busqueda."%' " : $palabra = '';
		($fronEnd) ? $status = ' AND status = 1 ' : $status = '';

		$sql = "SELECT * FROM empleo WHERE 1 = 1".$palabra.$status.' ORDER BY orden desc';
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);

		if(!$frontEnd){
			$this -> totalRegistros = mysqli_num_rows($temporal);
			$ultimaPagina = ceil($this -> totalRegistros / $this -> registrosPorPagina);
			$paginaActual = $pagina;

			$sql .= ' LIMIT '.($pagina - 1) * $this -> registrosPorPagina.', '.$this -> registrosPorPagina;
			$temporal2 = $conexion -> ejecutar_sentencia($sql);
			$final = $temporal2;
		}
		else{
			$final = $temporal;
		}

		$resultados = array();
		while($row = mysqli_fetch_array($final)){
			$registro['idEmpleo'] = $row['idEmpleo'];
			$registro['titulo'] = htmlspecialchars_decode($row['titulo']);
			$registro['descripcion'] = htmlspecialchars_decode($row['descripcion']);
			$registro['descripcionCorta'] = $this -> herramientas -> cortarTexto($row['descripcion'], 100);
			$registro['lugar'] = htmlspecialchars_decode($row['lugar']);
			$registro['salario'] = htmlspecialchars_decode($row['salario']);
			$registro['jornada'] = htmlspecialchars_decode($row['jornada']);
			$registro['tipoContrato'] = htmlspecialchars_decode($row['tipoContrato']);
			$registro['status'] = $row['status'];
			$registro['orden'] = $row['orden'];
			if(!$frontEnd){
				$registro['ultimapagina']=$ultimaPagina;
				$registro['paginaanterior']=$pagina-1;
				$registro['paginasiguiente']=$pagina+1;
				$registro['pagina']=$pagina;
			}
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function insertarRequisito($titulo){
		$requisito = new requisito(0, $this -> idEmpleo, $titulo);
		$requisito -> addRequisito();
	}

	function modificarRequisito($idRequisito, $titulo){
		$requisito = new requisito($idRequisito, $this -> idEmpleo, $titulo);
		$requisito -> updateRequisito();
	}

	function eliminarRequisito($idRequisito){
		$requisito = new requisito($idRequisito);
		$requisito -> deleteRequisito();
	}

	function eliminarRequisitoxEmpleo(){
		$requisito = new requisito(0, $this -> idEmpleo);
		$requisito -> deleteRequisito(true);
	}

	function listarRequisito(){
		$requisito = new requisito(0, $this -> idEmpleo);
		$this -> requisitos = $requisito -> listRequisito();
	}

}
?>
