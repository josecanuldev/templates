<?php

include_once('conexion.php');
// include_once('herramientas.php');

class experienciaAnexo {
	
	var $idAnexo;
	var $idExperiencia;
	var $titulo;
	var $periodo;
	var $descripcion;
	var $tipo;
	var $idioma;
	var $status;
	var $orden;
	
	var $registrosPorPagina;
	var $totalRegistros;
	var $herramientas;
	
	function __construct($idAnexo = 0, $idExperiencia = 0, $titulo = '', $periodo = '', $descripcion = '', $tipo = '', $idioma = 'en') {
		$this -> idAnexo            = $idAnexo;
		$this -> idExperiencia      = $idExperiencia;
		$this -> titulo             = htmlentities($titulo, ENT_QUOTES);
		$this -> periodo            = htmlentities($periodo, ENT_QUOTES);
		$this -> descripcion        = htmlentities($descripcion, ENT_QUOTES);
		$this -> tipo               = htmlentities($tipo, ENT_QUOTES);
		$this -> idioma             = $idioma;
		
		// $this -> herramientas       = new herramientas();
		$this -> registrosPorPagina = 20;
	}

	/**
	 * [agregarExperienciaAnexo description]
	 * Actualizado 2016-12-02
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function agregarExperienciaAnexo() {
		$success = 0;

		$con = new conexion();
		$sql = "INSERT experiencia_anexo SET idExperiencia = {$this -> idExperiencia}, titulo = '{$this -> titulo}', periodo = '{$this -> periodo}', descripcion = '{$this -> descripcion}', tipo = '{$this -> tipo}', idioma = '{$this -> idioma}'";
		
		$this -> idAnexo = $con -> ejecutar_sentencia($sql);
			
		if ($this -> idAnexo > 0) {
			$sql2 = "UPDATE experiencia_anexo SET orden = {$this -> idAnexo} WHERE idAnexo = {$this -> idAnexo}";
			$con -> ejecutar_sentencia($sql2);
			
			$success = 1;
		}

		return $success;
	}

	/**
	 * [editarExperienciaAnexo description]
	 * Actualizado 2016-12-02
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function editarExperienciaAnexo() {
		$success = 0;
		$con     = new conexion();
		$sql     = "UPDATE experiencia_anexo SET idExperiencia = {$this -> idExperiencia}, titulo = '{$this -> titulo}', periodo = '{$this -> periodo}', descripcion = '{$this -> descripcion}', tipo = '{$this -> tipo}', idioma = '{$this -> idioma}' WHERE idAnexo = {$this -> idAnexo} AND idioma LIKE '{$this -> idioma}'";
		
		if ($con -> ejecutar_sentencia($sql))
			$success = 2;

		return $success;
	}

	/**
	 * [borrarExperienciaAnexo description]
	 * Actualizado 2016-12-02
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function borrarExperienciaAnexo() {
		$success = 0; 
		$con     = new conexion();
		$sql     = "DELETE FROM experiencia_anexo WHERE idAnexo = {$this -> idAnexo}";
		
		if ($con -> ejecutar_sentencia($sql))
			$success = 3;

		return $success;
	}

	/**
	 * [obtenerExperienciaAnexo description]
	 * Actualizado 2016-12-02
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function obtenerExperienciaAnexo($idioma = 'en') {
		$con  = new conexion();
		$sql  = "SELECT * FROM experiencia_anexo WHERE idExperiencia = {$this -> idExperiencia} AND idioma LIKE '{$idioma}'";
		$temp = $con -> ejecutar_sentencia($sql);
		$obj  = mysqli_fetch_object($temp);
		
		$this -> idAnexo       = $obj -> idAnexo;
		$this -> idExperiencia = $obj -> idExperiencia;
		$this -> titulo        = htmlspecialchars_decode($obj -> titulo);
		$this -> periodo       = htmlspecialchars_decode($obj -> periodo);
		$this -> descripcion   = htmlspecialchars_decode($obj -> descripcion);
		$this -> tipo          = htmlspecialchars_decode($obj -> tipo);
		$this -> idioma        = $obj -> idioma;
		$this -> status        = $obj -> status;
		$this -> orden         = $obj -> orden;
	}

	function listaExperienciaAnexo($pagina = 1, $paginador = true, $status = '', $tipo = '', $idioma = 'en', $busqueda = '', $registrosPorPagina = 20) {
		$tip = ($tipo !== '') ? "AND A.tipo LIKE '{$tipo}'" : '';
		$stat = ($status != '') ? "AND A.status = ".$status : '';
		$bus  = ($busqueda != '') ? "AND (A.titulo LIKE '%". $busqueda."%')" : '';

		$sql  = "SELECT A.* FROM experiencia_anexo A WHERE 1 = 1 AND idExperiencia = {$this -> idExperiencia} AND A.idioma LIKE '{$idioma}' {$tip}{$stat}{$bus} ORDER BY A.orden ASC";
		$con  = new conexion();
		$temp = $con -> ejecutar_sentencia($sql);
		
		if ($paginador) {
			$this -> totalRegistros = mysqli_num_rows($temp);
			$ultimaPagina = ceil($this -> totalRegistros / $this -> registrosPorPagina);	
			$paginaActual = $pagina;				
				
			$sql   .= ' LIMIT '.($pagina - 1) * $this -> registrosPorPagina.', '.$this -> registrosPorPagina;
			$temp2 = $con -> ejecutar_sentencia($sql);
			$final = $temp2;
		} else {
			$final = $temp;
		}

		$resultados = array();
		while ($row = mysqli_fetch_array($final)) {
			$registro['idAnexo']       = $row['idAnexo'];
			$registro['idExperiencia'] = $row['idExperiencia'];
			$registro['titulo']        = $row['titulo'];
			$registro['periodo']       = $row['periodo'];
			$registro['descripcion']   = $row['descripcion'];
			$registro['tipo']          = $row['tipo'];
			$registro['idioma']        = $row['idioma'];
			$registro['status']        = $row['status'];
			$registro['orden']         = $row['orden'];
			
			if ($paginador) {
				$registro['ultimapagina']    = $ultimaPagina;
				$registro['paginaanterior']  = $pagina - 1;
				$registro['paginasiguiente'] = $pagina + 1;
				$registro['pagina']          = $pagina;
			}

			array_push($resultados, $registro);
		}

		return $resultados;
	}
}
?>