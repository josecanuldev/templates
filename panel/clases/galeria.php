<?php

include_once('conexion.php');
include_once('archivo.php');
include_once('herramientas.php');

class galeria extends Archivo {
	
	var $idGaleria;
	var $idSeccion;
	var $ruta;
	var $titulo;
	var $subtitulo;
	var $texto;
	var $inicial;
	var $seccion;
	var $idioma;
	var $status;
	var $orden;
	
	var $directorio = "../img/__SECCION__/galeria/";
	var $registrosPorPagina;
	var $totalRegistros;
	var $herramientas;
	
	function __construct($idGaleria = 0, $idSeccion = 0, $titulo = '', $subtitulo = '', $texto = '', $inicial = '', $seccion = '', $idioma = 'en', $ruta = '', $temp = '') {
		$this -> idGaleria          = $idGaleria;
		$this -> idSeccion          = $idSeccion;
		$this -> titulo             = htmlentities($titulo, ENT_QUOTES);
		$this -> subtitulo          = htmlentities($subtitulo, ENT_QUOTES);
		$this -> texto              = htmlentities($texto, ENT_QUOTES);
		$this -> inicial            = htmlentities($inicial, ENT_QUOTES);
		$this -> seccion            = htmlentities($seccion, ENT_QUOTES);
		$this -> idioma             = $idioma;
		
		$this -> ruta               = ($ruta !== '') ? $this -> obtenerExtensionArchivo($ruta) : '';
		$this -> ruta_final         = str_replace('__SECCION__', 'img'. $seccion, $this -> directorio);
		$this -> ruta_temporal      = $temp;
		$this -> herramientas       = new herramientas();
		
		$this -> registrosPorPagina = 20;
	}

	/**
	 * [agregarGaleria description]
	 * Actualizado 2016-11-16
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function agregarGaleria() {
		$success = 0;

		if ($this -> subir_archivo_imagen($this -> ruta)) {

			$con = new conexion();
			$sql = "INSERT galeria SET idSeccion = {$this -> idSeccion}, ruta = '{$this -> ruta}', titulo = '{$this -> titulo}', subtitulo = '{$this -> subtitulo}', texto = '{$this -> texto}', inicial = '{$this -> inicial}', idioma = '{$this -> idioma}', seccion = '{$this -> seccion}'";
			
			$this -> idGaleria = $con -> ejecutar_sentencia($sql);

			if ($this -> idGaleria > 0) {
				$sql2 = "UPDATE galeria SET orden = {$this -> idGaleria} WHERE idGaleria = {$this -> idGaleria}";
				$con -> ejecutar_sentencia($sql2);
				
				$success = 1;
			}
		}

		return $success;
	}

	/**
	 * [editarGaleria description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function editarGaleria() {
		$success = 0;
		$con     = new conexion();		
		
		if ($this -> ruta !== '') {
			$this -> obtenerPortada();
			$this -> borrar_archivo();

			$this -> ruta_final = str_replace('__SECCION__', 'img'. $this -> seccion, $this -> directorio);
			if ($this -> subir_archivo_imagen($this -> ruta)) {
				$img = "UPDATE galeria SET ruta = '{$this -> ruta}' WHERE idGaleria = {$this -> idGaleria}";
				$con -> ejecutar_sentencia($img);
			}
		}

		$sql = "
			UPDATE galeria 
			SET idSeccion = {$this -> idSeccion}, titulo = '{$this -> titulo}', subtitulo = '{$this -> subtitulo}', texto = '{$this -> texto}', inicial = '{$this -> inicial}' 
			WHERE idGaleria = {$this -> idGaleria}";		

		if ($con -> ejecutar_sentencia($sql))
			$success = 2;

		return $success;
	}

	// function updateImgMovil($_ruta = '', $temp = '') {
	// 	if ($_ruta != '') {
	// 		$this -> getImgMovil();
	// 		$this -> borrar_archivo();

	// 		$this -> ruta_final = $this -> directorio;
	// 		$this -> ruta_temporal = $temp;
	// 		$_ruta = $this -> obtenerExtensionArchivo($_ruta);
	// 		$this -> subir_archivo_imagen($_ruta);
	// 		$_MYSQL = new MYSQL();
	// 		$_SQL = "UPDATE galeria SET ruta = ? WHERE idGaleria = ?";
	// 		$_CONECTADO = $_MYSQL -> Connect();
	// 		if (!$_CONECTADO) {
	// 			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
	// 			exit();
	// 		}
	// 		$_MYSQL -> Execute($_SQL, array($_ruta, $this -> idGaleria));
	// 	}
	// }

	/**
	 * [borrarGaleria description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function borrarGaleria() {
		$this -> obtenerPortada();
		$this -> borrar_archivo();
		// $this -> getImgMovil();
		// $this -> borrar_archivo();
		 
		$success = 0; 
		$con     = new conexion();
		$sql     = "DELETE FROM galeria WHERE idGaleria = {$this -> idGaleria}";
		
		if ($con -> ejecutar_sentencia($sql))
			$success = 3;

		return $success;
	}

	/**
	 * [obtenerPortada description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function obtenerPortada() {
		$sql  = "SELECT ruta, seccion FROM galeria WHERE idGaleria = {$this -> idGaleria}";
		$con  = new conexion();
		$temp = $con -> ejecutar_sentencia($sql);
		$obj  = mysqli_fetch_object($temp);
		
		$this -> ruta_final = str_replace('__SECCION__', 'img'. $obj -> seccion, $this -> directorio) . $obj -> ruta;
	}

	// function getImgMovil() {
	// 	$_MYSQL = new MYSQL();
	// 	$_SQL = "SELECT ruta FROM galeria WHERE idGaleria = ?";
	// 	$_CONECTADO = $_MYSQL -> Connect();
	// 	if (!$_CONECTADO) {
	// 		echo 'Ocurrio un error, Por favor intentalo mas tarde.';
	// 		exit();
	// 	}
	// 	$_MYSQL -> Execute($_SQL, array($this -> idGaleria));
	// 	$obj = $_MYSQL -> fetchobject();
	// 	$this -> ruta_final = $this -> directorio.$obj -> ruta;
	// }

	/**
	 * [cambiarStatusGaleria description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $status  [description]
	 * @return  [type]            [description]
	 */
	function cambiarStatusGaleria($status = 0) {
		$con = new conexion();
		$sql = "UPDATE galeria SET status = {$status} WHERE idGaleria = {$this -> idGaleria}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [editarOrdenGaleria description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $orden  [description]
	 * @return  [type]           [description]
	 */
	function editarOrdenGaleria($orden = 0) {
		$con = new conexion();
		$sql = "UPDATE galeria SET orden = {$orden} WHERE idGaleria = {$this -> idGaleria}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [obtenerGaleria description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function obtenerGaleria() {
		$con      = new conexion();
		$sql      = "SELECT * FROM galeria WHERE idGaleria = {$this -> idGaleria}";
		$temporal = $con -> ejecutar_sentencia($sql);
		$obj      = mysqli_fetch_object($temporal);
		
		$this -> idGaleria = $obj -> idGaleria;
		$this -> idSeccion = $obj -> idSeccion;
		$this -> ruta      = $obj -> ruta;
		$this -> titulo    = htmlspecialchars_decode($obj -> titulo);
		$this -> subtitulo = htmlspecialchars_decode($obj -> subtitulo);
		$this -> inicial   = htmlspecialchars_decode($obj -> inicial);
		$this -> seccion   = htmlspecialchars_decode($obj -> seccion);
		$this -> botonLink = htmlspecialchars_decode($obj -> botonLink);
		$this -> idioma    = $obj -> idioma;
		$this -> status    = $obj -> status;
		$this -> orden     = $obj -> orden;
	}

	/**
	 * [listaGaleria description]
	 * Actualizado 2016-11-16
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $pagina              [description]
	 * @param   boolean  $paginador           [description]
	 * @param   string   $idioma              [description]
	 * @param   string   $seccion             [description]
	 * @param   string   $idioma              [description]
	 * @param   string   $busqueda            [description]
	 * @param   integer  $registrosPorPagina  [description]
	 * @return  [type]                        [description]
	 */
	function listaGaleria($pagina = 1, $paginador = true, $idioma = 'en', $desde = 0, $seccion = '', $busqueda = '', $registrosPorPagina = 20) {
		$dsd    = ($desde > 0) ? " AND idSeccion = {$desde} " : '';
		$bus    = ($busqueda != '') ? " AND (titulo LIKE '%".$busqueda."%') " : '';
		$secc   = ($seccion != '') ? " AND seccion LIKE '{$seccion}' " : '';

		$sql = "SELECT * FROM galeria WHERE 1 = 1 AND idioma LIKE '{$idioma}'{$dsd}{$secc}{$bus} ORDER BY orden ASC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		
		if ($paginador) {
			$this -> totalRegistros = mysqli_num_rows($temporal);
			$ultimaPagina = ceil($this -> totalRegistros / $this -> registrosPorPagina);	
			$paginaActual = $pagina;				
				
			$sql .= ' LIMIT '.($pagina - 1) * $this -> registrosPorPagina.', '.$this -> registrosPorPagina;
			$temporal2 = $con -> ejecutar_sentencia($sql);
			$final     = $temporal2;
		} else {
			$final = $temporal;
		}

		$resultados = array();
		while ($row = mysqli_fetch_array($final)) {
			$registro['idGaleria'] = $row['idGaleria'];
			$registro['idSeccion'] = $row['idSeccion'];
			$registro['ruta']      = $row['ruta'];
			$registro['titulo']    = htmlspecialchars_decode($row['titulo']);
			$registro['subtitulo'] = htmlspecialchars_decode($row['subtitulo']);
			$registro['texto']     = htmlspecialchars_decode($row['texto']);
			$registro['inicial']   = htmlspecialchars_decode($row['inicial']);
			$registro['idioma']    = htmlspecialchars_decode($row['idioma']);
			$registro['seccion']   = htmlspecialchars_decode($row['seccion']);
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