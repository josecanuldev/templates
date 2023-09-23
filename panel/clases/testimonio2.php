<?php

include_once('conexion.php');
include_once('archivo.php');
include_once('herramientas.php');

class testimonio2 extends Archivo {
	
	var $idTestimonio;
	var $imgPortada;
	// var $imgMovil;
	var $nombre;
	var $ubicacion;
	var $texto;
	var $idioma;
	var $status;
	var $orden;
	var $textoEn;
	var $idDestino;
	
	var $directorio = "../img/imgTestimonio2/";
	var $registrosPorPagina;
	var $totalRegistros;
	var $herramientas;
	
	function __construct($idTestimonio = 0, $nombre = '', $ubicacion = '', $texto = '', $idioma = 'en', $imgPortada = '', $_tmp = '', $textoEn = '', $idDestino = 0) {
		$this -> idTestimonio       = $idTestimonio;
		$this -> nombre             = htmlentities($nombre, ENT_QUOTES);
		$this -> ubicacion          = htmlentities($ubicacion, ENT_QUOTES);
		$this -> texto              = htmlentities($texto, ENT_QUOTES);
		$this -> textoEn              = htmlentities($textoEn, ENT_QUOTES);
		$this -> idioma             = $idioma;
		$this -> idDestino       = $idDestino;
		
		$this -> imgPortada         = ($imgPortada !== '') ? $this -> obtenerExtensionArchivo($imgPortada) : '';
		$this -> ruta_final         = $this -> directorio;
		$this -> ruta_temporal      = $_tmp;
		$this -> herramientas       = new herramientas();
		
		$this -> registrosPorPagina = 20;
	}

	/**
	 * [agregarTestimonio description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function agregarTestimonio() {
		$success = 0;

		if ($this -> subir_archivo_imagen($this -> imgPortada)) {

			$con = new conexion();
			$sql = "INSERT testimonio2 SET imgPortada = '{$this -> imgPortada}', nombre = '{$this -> nombre}', ubicacion = '{$this -> ubicacion}', texto = '{$this -> texto}', idioma = '{$this -> idioma}', textoEn = '{$this -> textoEn}', idDestino = '{$this -> idDestino}'";
			
			$this -> idTestimonio = $con -> ejecutar_sentencia($sql);

			if ($this -> idTestimonio > 0) {
				$sql2 = "UPDATE testimonio2 SET orden = {$this -> idTestimonio} WHERE idTestimonio = {$this -> idTestimonio}";
				$con -> ejecutar_sentencia($sql2);
				
				$success = 1;
			}
		}

		return $success;
	}

	/**
	 * [editarTestimonio description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function editarTestimonio() {
		$success = 0;
		$con     = new conexion();		
		
		if ($this -> imgPortada !== '') {
			$this -> obtenerPortada();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> directorio;
			if ($this -> subir_archivo_imagen($this -> imgPortada)) {
				$img = "UPDATE testimonio2 SET imgPortada = '{$this -> imgPortada}' WHERE idTestimonio = {$this -> idTestimonio}";
				$con -> ejecutar_sentencia($img);
			}
		}

		$sql = "
			UPDATE testimonio2 
			SET 
				nombre = '{$this -> nombre}', 
				ubicacion = '{$this -> ubicacion}', 
				texto = '{$this -> texto}', 
				textoEn = '{$this -> textoEn}', 
				idioma = '{$this -> idioma}' 
			WHERE idTestimonio = {$this -> idTestimonio}";		

		if ($con -> ejecutar_sentencia($sql))
			$success = 2;

		return $success;
	}

	// function updateImgMovil($_ruta = '', $_tmp = '') {
	// 	if ($_ruta != '') {
	// 		$this -> getImgMovil();
	// 		$this -> borrar_archivo();

	// 		$this -> ruta_final = $this -> directorio;
	// 		$this -> ruta_temporal = $_tmp;
	// 		$_ruta = $this -> obtenerExtensionArchivo($_ruta);
	// 		$this -> subir_archivo_imagen($_ruta);
	// 		$_MYSQL = new MYSQL();
	// 		$_SQL = "UPDATE testimonio2 SET imgMovil = ? WHERE idTestimonio = ?";
	// 		$_CONECTADO = $_MYSQL -> Connect();
	// 		if (!$_CONECTADO) {
	// 			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
	// 			exit();
	// 		}
	// 		$_MYSQL -> Execute($_SQL, array($_ruta, $this -> idTestimonio));
	// 	}
	// }

	/**
	 * [borrarTestimonio description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function borrarTestimonio() {
		$this -> obtenerPortada();
		$this -> borrar_archivo();
		// $this -> getImgMovil();
		// $this -> borrar_archivo();
		 
		$success = 0; 
		$con     = new conexion();
		$sql     = "DELETE FROM testimonio2 WHERE idTestimonio = {$this -> idTestimonio}";
		
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
		$sql  = "SELECT imgPortada FROM testimonio2 WHERE idTestimonio = {$this -> idTestimonio}";
		$con  = new conexion();
		$temp = $con -> ejecutar_sentencia($sql);
		$obj  = mysqli_fetch_object($temp);
		
		$this -> ruta_final = $this -> directorio.$obj -> imgPortada;
	}

	// function getImgMovil() {
	// 	$_MYSQL = new MYSQL();
	// 	$_SQL = "SELECT imgMovil FROM testimonio2 WHERE idTestimonio = ?";
	// 	$_CONECTADO = $_MYSQL -> Connect();
	// 	if (!$_CONECTADO) {
	// 		echo 'Ocurrio un error, Por favor intentalo mas tarde.';
	// 		exit();
	// 	}
	// 	$_MYSQL -> Execute($_SQL, array($this -> idTestimonio));
	// 	$obj = $_MYSQL -> fetchobject();
	// 	$this -> ruta_final = $this -> directorio.$obj -> imgMovil;
	// }

	/**
	 * [cambiarStatusTestimonio description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $status  [description]
	 * @return  [type]            [description]
	 */
	function cambiarStatusTestimonio($status = 0) {
		$con = new conexion();
		$sql = "UPDATE testimonio2 SET status = {$status} WHERE idTestimonio = {$this -> idTestimonio}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [editarOrdenTestimonio description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $orden  [description]
	 * @return  [type]           [description]
	 */
	function editarOrdenTestimonio($orden = 0) {
		$con = new conexion();
		$sql = "UPDATE testimonio2 SET orden = {$orden} WHERE idTestimonio = {$this -> idTestimonio}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [obtenerTestimonio description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function obtenerTestimonio() {
		$con      = new conexion();
		$sql      = "SELECT * FROM testimonio2 WHERE idTestimonio = {$this -> idTestimonio}";
		$temporal = $con -> ejecutar_sentencia($sql);
		$obj      = mysqli_fetch_object($temporal);
		
		$this -> idTestimonio = $obj -> idTestimonio;
		$this -> imgPortada   = $obj -> imgPortada;
		// $this -> imgMovil  = $obj -> imgMovil;
		$this -> nombre       = htmlspecialchars_decode($obj -> nombre);
		$this -> ubicacion    = htmlspecialchars_decode($obj -> ubicacion);
		$this -> texto        = htmlspecialchars_decode($obj -> texto);
		$this -> textoEn        = htmlspecialchars_decode($obj -> textoEn);
		$this -> idioma       = $obj -> idioma;
	}

	/**
	 * [listaTestimonio description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $pagina              [description]
	 * @param   boolean  $paginador           [description]
	 * @param   string   $status              [description]
	 * @param   string   $idioma              [description]
	 * @param   string   $busqueda            [description]
	 * @param   integer  $registrosPorPagina  [description]
	 * @return  [type]                        [description]
	 */
	function listaTestimonio($pagina = 1, $paginador = true, $status = '', $idDestino = 0, $idioma = 'en', $busqueda = '', $registrosPorPagina = 20) {
		$stat   = ($status != '') ? "AND status = ".$status : '';
		$bus    = ($busqueda != '') ? "AND (nombre LIKE '%".$busqueda."%')" : '';

		$sql = "SELECT * FROM testimonio2 WHERE idDestino='".$idDestino."' ".$stat.$bus." ORDER BY orden ASC";
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
			$registro['idTestimonio'] = $row['idTestimonio'];
			$registro['imgPortada']   = $row['imgPortada'];
			$registro['nombre']       = htmlspecialchars_decode($row['nombre']);
			$registro['nombres']      = htmlspecialchars_decode($row['nombre']);
			$registro['ubicacion']    = htmlspecialchars_decode($row['ubicacion']);
			$registro['texto']        = htmlspecialchars_decode($row['texto']);
			$registro['textoEn']        = htmlspecialchars_decode($row['textoEn']);
			$registro['idioma']       = $row['idioma'];
			$registro['status']       = $row['status'];
			$registro['orden']        = $row['orden'];
			
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

	/**
	 * [listaTestimonioAleatorios description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   string   $idioma     [description]
	 * @param   integer  $registros  [description]
	 * @return  [type]               [description]
	 */
	public function listaTestimonioAleatorios($idioma = 'en', $registros = 5) {
		$con    = new conexion();
		$sql1   = "SELECT `idTestimonio` FROM `testimonio2` WHERE `status` = 1 AND `idioma` = '{$idioma}'";
		$todos  = $con -> ejecutar_sentencia($sql1);

		$ids    = array();
		while ($row = mysqli_fetch_array($todos)) {
			$ids[$row['idTestimonio']] = $row['idTestimonio'];
		}
		
		$max    = (count($ids) > $registros) ? $registros : count($ids);
		$random = array_rand($ids, $max);
		$in     = implode(',', $random);
		
		$sql2   = "SELECT * FROM testimonio2 WHERE status = 1 AND idioma LIKE '{$idioma}' AND idTestimonio IN({$in}) LIMIT {$registros}";
		$temp   = $con -> ejecutar_sentencia($sql2);
		$resultados = array();
		while ($row = mysqli_fetch_array($temp)) {
			$registro['idTestimonio'] = $row['idTestimonio'];
			$registro['imgPortada']   = $row['imgPortada'];
			$registro['nombre']       = htmlspecialchars_decode($row['nombre']);
			$registro['nombres']      = $this -> herramientas -> seraparNombre($row['nombre']);
			$registro['ubicacion']    = htmlspecialchars_decode($row['ubicacion']);
			$registro['texto']        = htmlspecialchars_decode($row['texto']);
			$registro['textoEn']        = htmlspecialchars_decode($row['textoEn']);
			$registro['idioma']       = $row['idioma'];
			$registro['status']       = $row['status'];
			$registro['orden']        = $row['orden'];

			array_push($resultados, $registro);
		}

		return $resultados;
	}
}
?>