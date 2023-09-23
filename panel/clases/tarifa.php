<?php

include_once('conexion.php');
include_once('tarifaDatos.php');
include_once('herramientas.php');

class tarifa {
	
	var $idTarifa;
	var $idSeccion;
	var $periodo1;
	var $periodo2;
	var $incluye;
	var $noIncluye;
	var $notas;
	var $idioma;
	var $seccion;
	var $status;
	var $orden;
	
	var $registrosPorPagina;
	var $totalRegistros;
	var $herramientas;
	
	function __construct($idTarifa = 0, $idSeccion = 0, $periodo1 = '', $periodo2 ='', $incluye = '', $noIncluye = '', $notas = '', $idioma = '', $seccion = '') {
		$this -> idTarifa            = $idTarifa;
		$this -> idSeccion          = $idSeccion;
		$this -> periodo1           = htmlentities($periodo1, ENT_QUOTES);
		$this -> periodo2           = htmlentities($periodo2, ENT_QUOTES);
		$this -> incluye            = htmlentities($incluye, ENT_QUOTES);
		$this -> noIncluye          = htmlentities($noIncluye, ENT_QUOTES);
		$this -> notas              = htmlentities($notas, ENT_QUOTES);
		$this -> idioma             = $idioma; 
		$this -> seccion            = $seccion;
		
		$this -> herramientas       = new herramientas();
		$this -> registrosPorPagina = 20;
	}

	/**
	 * [agregarTarifa description]
	 * Actualizado 2016-11-22
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function agregarTarifa() {
		$success = 0;	

		$con = new conexion();
		$sql = "INSERT tarifa SET idSeccion = {$this -> idSeccion}, periodo1 = '{$this -> periodo1}', periodo2 = '{$this -> periodo2}', incluye = '{$this -> incluye}', noIncluye = '{$this -> noIncluye}', notas = '{$this -> notas}', idioma = '{$this -> idioma}', seccion = '{$this -> seccion}'";
		
		$this -> idTarifa = $con -> ejecutar_sentencia($sql);

		if ($this -> idTarifa > 0) {
			$sql2 = "UPDATE tarifa SET orden = {$this -> idTarifa} WHERE idTarifa = {$this -> idTarifa}";
			$con -> ejecutar_sentencia($sql2);
			
			$success = 1;
		}

		return $success;
	}

	/**
	 * [editarTarifa description]
	 * Actualizado 2016-11-22
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function editarTarifa() {
		$success = 0;
		$con     = new conexion();
		$sql     = "
			UPDATE tarifa 
			SET 
				periodo1  = '{$this -> periodo1}', 
				periodo2  = '{$this -> periodo2}',
				incluye   = '{$this -> incluye}', 
				noIncluye = '{$this -> noIncluye}', 
				notas     = '{$this -> notas}', 
				idioma    = '{$this -> idioma}',   
				seccion   = '{$this -> seccion}' 
			WHERE idTarifa = {$this -> idTarifa}";		

		if ($con -> ejecutar_sentencia($sql))
			$success = 2;

		return $success;
	}

	/**
	 * [borrarTarifa description]
	 * Actualizado 2016-11-22
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function borrarTarifa() {
		$success = 0; 
		$con     = new conexion();
		$sql     = "DELETE FROM tarifa WHERE idTarifa = {$this -> idTarifa}";
		
		if ($con -> ejecutar_sentencia($sql))
			$success = 3;

		return $success;
	}

	/**
	 * [cambiarStatusTarifa description]
	 * Actualizado 2016-11-22
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $status  [description]
	 * @return  [type]            [description]
	 */
	function cambiarStatusTarifa($status = 0) {
		$con = new conexion();
		$sql = "UPDATE tarifa SET status = {$status} WHERE idTarifa = {$this -> idTarifa}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [editarOrdenTarifa description]
	 * Actualizado 2016-11-22
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $orden  [description]
	 * @return  [type]           [description]
	 */
	function editarOrdenTarifa($orden = 0) {
		$con = new conexion();
		$sql = "UPDATE tarifa SET orden = {$orden} WHERE idTarifa = {$this -> idTarifa}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [obtenerTarifa description]
	 * Actualizado 2016-11-22
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function obtenerTarifa() {
		$con      = new conexion();
		$sql      = "SELECT * FROM tarifa WHERE idSeccion = {$this -> idSeccion} AND seccion LIKE '{$this -> seccion}' AND idioma LIKE '{$this -> idioma}'";
		$temporal = $con -> ejecutar_sentencia($sql);
		$obj      = mysqli_fetch_object($temporal);
		
		$this -> idTarifa  = $obj -> idTarifa;
		$this -> idSeccion = $obj -> idSeccion;
		$this -> periodo1  = htmlspecialchars_decode($obj -> periodo1);
		$this -> periodo2  = htmlspecialchars_decode($obj -> periodo2);
		$this -> incluye   = htmlspecialchars_decode($obj -> incluye);
		$this -> noIncluye = htmlspecialchars_decode($obj -> noIncluye);
		$this -> notas     = htmlspecialchars_decode($obj -> notas);
		$this -> idioma    = $obj -> idioma;
		$this -> seccion   = $obj -> seccion;
		$this -> status    = $obj -> status;
		$this -> orden     = $obj -> orden;
	}

	/**
	 * [listaTarifa description]
	 * Actualizado 2016-11-22
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $pagina              [description]
	 * @param   boolean  $paginador           [description]
	 * @param   string   $status              [description]
	 * @param   string   $idioma              [description]
	 * @param   string   $busqueda            [description]
	 * @param   integer  $registrosPorPagina  [description]
	 * @return  [type]                        [description]
	 */
	function listaTarifa($pagina = 1, $paginador = true, $status = '', $idioma = 'en', $desde = 0, $seccion = '', $busqueda = '', $registrosPorPagina = 20) {
		$dsd  = ($desde > 0) ? " AND idSeccion = {$desde} " : '';
		$secc = ($seccion != '') ? " AND seccion LIKE '{$seccion}' " : '';
		$stat = ($status != '') ? " AND status = ".$status : '';
		$bus  = '';

		$sql  = "SELECT * FROM tarifa WHERE 1 = 1 AND idioma LIKE '{$idioma}' {$dsd}{$secc}{$stat}{$bus} ORDER BY orden ASC";
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
			$registro['idTarifa']  = $row['idTarifa'];
			$registro['idSeccion'] = $row['idSeccion'];
			$registro['periodo1']  = htmlspecialchars_decode($row['periodo1']);
			$registro['periodo2']  = htmlspecialchars_decode($row['periodo2']);
			$registro['incluye']   = htmlspecialchars_decode($row['incluye']);
			$registro['noIncluye'] = htmlspecialchars_decode($row['noIncluye']);
			$registro['notas']     = htmlspecialchars_decode($row['notas']);
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

	/* Datos
	   ========================================================================== */
	function agregarTarifaDatos($concepto = '', $precio1 = 0, $precio2 = 0, $moneda = 'USD', $idioma = 'en', $conceptoEn = '', $horaEn = '') {
		$tarifaDatos = new tarifaDatos(0, $this -> idTarifa, $concepto, $precio1, $precio2, $moneda, $idioma, $conceptoEn, $horaEn);
		$tarifaDatos -> agregarTarifaDatos();
	}

	function editarTarifaDatos($idTarifaDatos = 0, $concepto = '', $precio1 = 0, $precio2 = 0, $moneda = 'USD', $idioma = 'en', $conceptoEn = '', $horaEn = '') {
		$tarifaDatos = new tarifaDatos($idTarifaDatos, $this -> idTarifa, $concepto, $precio1, $precio2, $moneda, $idioma, $conceptoEn, $horaEn);
		$tarifaDatos -> editarTarifaDatos();
	}

	function borrarTodosTarifaDatos() {
		$tarifaDatos = new tarifaDatos(0, $this -> idTarifa);
		$tarifaDatos -> borrarTodosTarifaDatos();
	}

	function listarTarifaDatos($idTarifa = 0, $idioma = 'en') {
		$tarifaDatos = new tarifaDatos(0, $idTarifa);

		return $tarifaDatos -> listaTarifaDatos(1, false, '', $idioma, $idTarifa);
	}
}
?>