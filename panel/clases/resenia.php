<?php

include_once('conexion.php');
// include_once('archivo.php');
include_once('herramientas.php');

class resenia {
	
	var $idResenia;
	var $idSeccion;
	var $nombre;
	var $texto;
	var $idioma;
	var $fecha;
	var $seccion;
	var $status;
	var $orden;
	var $textoEn;
	
	var $registrosPorPagina;
	var $totalRegistros;
	var $herramientas;
	
	function __construct($idResenia = 0, $idSeccion = 0, $nombre = '', $texto = '', $idioma = 'en', $fecha = '', $seccion = '', $textoEn = '') {
		$this -> idResenia    = $idResenia;
		$this -> idSeccion    = $idSeccion;
		$this -> nombre       = htmlentities($nombre, ENT_QUOTES);
		$this -> texto        = htmlentities($texto, ENT_QUOTES);
		$this -> idioma       = $idioma;
		$this -> fecha        = $fecha;
		$this -> seccion      = $seccion;
		$this -> textoEn        = htmlentities($textoEn, ENT_QUOTES);
		
		$this -> herramientas = new herramientas();
		$this -> registrosPorPagina = 20;
	}

	/**
	 * [agregarResenia description]
	 * Actualizado 2016-11-18
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function agregarResenia() {
		$success = 0;	

		$con = new conexion();
		$sql = "INSERT resenia SET idSeccion = '{$this -> idSeccion}', nombre = '{$this -> nombre}', texto = '{$this -> texto}', idioma = '{$this -> idioma}', fecha = '{$this -> fecha}', seccion = '{$this -> seccion}', textoEn = '{$this -> textoEn}'";
		
		$this -> idResenia = $con -> ejecutar_sentencia($sql);

		if ($this -> idResenia > 0) {
			$sql2 = "UPDATE resenia SET orden = {$this -> idResenia} WHERE idResenia = {$this -> idResenia}";
			$con -> ejecutar_sentencia($sql2);
			
			$success = 1;
		}

		return $success;
	}

	/**
	 * [editarResenia description]
	 * Actualizado 2016-11-18
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function editarResenia() {
		$success = 0;
		$con     = new conexion();
		$sql     = "
			UPDATE resenia 
			SET 
				nombre = '{$this -> nombre}', 
				texto = '{$this -> texto}', 
				textoEn = '{$this -> textoEn}', 
				idioma = '{$this -> idioma}', 
				fecha = '{$this -> fecha}'   
			WHERE idResenia = {$this -> idResenia}";		

		if ($con -> ejecutar_sentencia($sql))
			$success = 2;

		return $success;
	}

	/**
	 * [borrarResenia description]
	 * Actualizado 2016-11-18
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function borrarResenia() {
		$success = 0; 
		$con     = new conexion();
		$sql     = "DELETE FROM resenia WHERE idResenia = {$this -> idResenia}";
		
		if ($con -> ejecutar_sentencia($sql))
			$success = 3;

		return $success;
	}

	/**
	 * [cambiarStatusResenia description]
	 * Actualizado 2016-11-18
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $status  [description]
	 * @return  [type]            [description]
	 */
	function cambiarStatusResenia($status = 0) {
		$con = new conexion();
		$sql = "UPDATE resenia SET status = {$status} WHERE idResenia = {$this -> idResenia}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [editarOrdenResenia description]
	 * Actualizado 2016-11-18
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $orden  [description]
	 * @return  [type]           [description]
	 */
	function editarOrdenResenia($orden = 0) {
		$con = new conexion();
		$sql = "UPDATE resenia SET orden = {$orden} WHERE idResenia = {$this -> idResenia}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [obtenerResenia description]
	 * Actualizado 2016-11-18
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function obtenerResenia() {
		$con      = new conexion();
		$sql      = "SELECT * FROM resenia WHERE idResenia = {$this -> idResenia}";
		$temporal = $con -> ejecutar_sentencia($sql);
		$obj      = mysqli_fetch_object($temporal);
		
		$this -> idResenia = $obj -> idResenia;
		$this -> idSeccion = $obj -> idSeccion;
		$this -> nombre    = htmlspecialchars_decode($obj -> nombre);
		$this -> texto     = htmlspecialchars_decode($obj -> texto);
		$this -> idioma    = $obj -> idioma;
		$this -> fecha     = $obj -> fecha;
		$this -> seccion   = $obj -> seccion;
		$this -> status    = $obj -> status;
		$this -> orden     = $obj -> orden;
		$this -> textoEn     = htmlspecialchars_decode($obj -> textoEn);
	}

	/**
	 * [listaResenia description]
	 * Actualizado 2016-11-18
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $pagina              [description]
	 * @param   boolean  $paginador           [description]
	 * @param   string   $status              [description]
	 * @param   string   $idioma              [description]
	 * @param   string   $busqueda            [description]
	 * @param   integer  $registrosPorPagina  [description]
	 * @return  [type]                        [description]
	 */
	function listaResenia($pagina = 1, $paginador = true, $status = '', $idioma = 'en', $desde = 0, $seccion = '', $busqueda = '', $registrosPorPagina = 20) {
		$dsd  = ($desde > 0) ? " AND idSeccion = {$desde} " : '';
		$secc = ($seccion != '') ? " AND seccion LIKE '{$seccion}' " : '';
		$stat = ($status != '') ? " AND status = ".$status : '';
		$bus  = ($busqueda != '') ? " AND (nombre LIKE '%".$busqueda."%')" : '';

		$sql  = "SELECT * FROM resenia WHERE 1 = 1 AND idioma LIKE '{$idioma}' {$dsd}{$secc}{$stat}{$bus} ORDER BY orden ASC";
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
			$registro['idResenia'] = $row['idResenia'];
			$registro['idSeccion'] = $row['idSeccion'];
			$registro['nombre']    = htmlspecialchars_decode($row['nombre']);
			$registro['texto']     = htmlspecialchars_decode($row['texto']);
			$registro['textoEn']     = htmlspecialchars_decode($row['textoEn']);
			$registro['idioma']    = $row['idioma'];
			$registro['fecha']     = $row['fecha'];
			$registro['seccion']   = $row['seccion'];
			$registro['status']    = $row['status'];
			$registro['orden']     = $row['orden'];
			
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