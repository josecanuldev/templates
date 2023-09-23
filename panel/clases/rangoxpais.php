<?php
require_once 'MYSQL.php';

class rangoxpais{
	var $_idTransporte;
	var $_idRangoTransporte;
	var $_idPais;
	var $_precio;
	var $_rangos;
	var $_paises;

	function __construct($_idTransporte = 0, $_idRangoTransporte = 0, $_idPais = 0, $_precio = 0){
		$this -> _idTransporte = $_idTransporte;
		$this -> _idRangoTransporte = $_idRangoTransporte;
		$this -> _idPais = $_idPais;
		$this -> _precio = $_precio;
		$this -> _rangos = array();
		$this -> _paises = array();
	}

	function addRangoxPais(){
		$_SQL = "INSERT INTO rangoxpais (idTransporte, idRangoTransporte, idPais, precio) VALUES(?,?,?,?)";
		//echo '<pre>INSERT INTO rangoxpais (idTransporte, idRangoTransporte, idPais, precio) VALUES('.$this -> _idTransporte.', '.$this -> _idRangoTransporte.', '.$this -> _idPais.', '.$this -> _precio.')</pre>';
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idTransporte, $this -> _idRangoTransporte, $this -> _idPais, $this -> _precio));
	}

	function existRangoxPais(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT idPais FROM rangoxpais WHERE idTransporte = ? AND idRangoTransporte = ? AND idPais = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idTransporte, $this -> _idRangoTransporte, $this -> _idPais));
		if($_MYSQL -> numrows() > 0) return true; else return false;
	}

	function removePaisxRango(){
		$_SQL = "DELETE FROM rangoxpais WHERE idPais = ?";
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idPais));
	}

	function removeRangoxPais(){
		$_SQL = "DELETE FROM rangoxpais WHERE idRangoTransporte = ?";
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idRangoTransporte));
	}

	function removeRangoxTransporte(){
		$_SQL = "DELETE FROM rangoxpais WHERE idTransporte = ?";
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idTransporte));
	}

	function listRangoxPais(){
		$_SQL = "SELECT idRangoTransporte, precio FROM rangoxpais WHERE idPais = ?";
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idPais));
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idRangoTransporte'] = $_row['idRangoTransporte'];
			$_registro['precio'] = $_row['precio'];
			array_push($this -> _productos, $_registro);
		}
	}

	function listPaisxRango(){
		$_SQL = "SELECT idPais, precio FROM rangoxpais WHERE idRangoTransporte = ? AND idTransporte = ?";
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idRangoTransporte, $this -> _idTransporte));
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idPais'] = $_row['idPais'];
			$_registro['precio'] = $_row['precio'];
			array_push($this -> _categorias, $_registro);
		}
	}

	function listNombrePaisxRango(){
		$_SQL = "SELECT pais.idPais, pais.nombre, rangoxpais.precio FROM rangoxpais, pais WHERE rangoxpais.idPais = pais.idPais AND pais.status = ? AND rangoxpais.idRangoTransporte = ? AND rangoxpais.idTransporte = ?";
		//echo '<pre>SELECT pais.idPais, pais.nombre, rangoxpais.precio FROM rangoxpais, pais WHERE rangoxpais.idPais = pais.idPais AND pais.status = 1 AND rangoxpais.idRangoTransporte = '. $this -> _idRangoTransporte.' AND rangoxpais.idTransporte = '.$this -> _idTransporte.'</pre>';
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array(1, $this -> _idRangoTransporte, $this -> _idTransporte));
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idPais'] = $_row['idPais'];
			$_registro['nombre'] = $_row['nombre'];
			$_registro['precio'] = $_row['precio'];
			array_push($this -> _paises, $_registro);
		}
	}

	function getPrecioRango(){
		$_SQL = "SELECT precio FROM rangoxpais WHERE idRangoTransporte = ? AND idTransporte = ? AND idPais = ?";
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idRangoTransporte, $this -> _idTransporte, $this -> _idPais));
		$_obj = $_MYSQL -> fetchobject();
		return $_obj;
	}

	function listPreciosxPais($_pesoMin = 0, $_pesoMax = 0, $_idPais = 0){
        $_MYSQL = new MYSQL();
        $_SQLPROD = "SELECT transporte.idTransporte, transporte.nombre, transporte.tiempoTransito, transporte.ruta, transporte.gratis, transporte.cantidadGratis, rangoxpais.precio FROM transporte, rangoTransporte, rangoxpais, transportexproducto WHERE transporte.idTransporte = rangoTransporte.idTransporte AND rangoTransporte.idRangoTransporte = rangoxpais.idRangoTransporte AND rangoxpais.idTransporte = transportexproducto.idTransporte AND rangoTransporte.pesoMinimo <= ? AND rangoTransporte.pesoMaximo >= ? AND rangoxpais.idPais = ? AND transporte.status = ? AND rangoTransporte.status = ? ";
        $_CONECTADO = $_MYSQL -> Connect();
        if(!$_CONECTADO){
            echo 'Ocurrio un error, Por favor intentalo mas tarde.';
            exit();
        }
        $_response = array();
        $_MYSQL -> Execute($_SQLPROD, array($_pesoMin, $_pesoMax, $_idPais, 1, 1));
         while($_row = $_MYSQL -> fetchrow()){
            $_registro['idTransporte'] = $_row['idTransporte'];
            $_registro['nombre'] = $_row['nombre'];
            $_registro['tiempoTransito'] = $_row['tiempoTransito'];
            $_registro['ruta'] = $_row['ruta'];
            $_registro['gratis'] = $_row['gratis'];
            $_registro['cantidadGratis'] = $_row['cantidadGratis'];
            $_registro['precio'] = $_row['precio'];
            array_push($_response, $_registro);
        }

        $_SQL = "SELECT transporte.idTransporte, transporte.nombre, transporte.tiempoTransito, transporte.ruta, transporte.gratis, transporte.cantidadGratis, rangoxpais.precio FROM transporte, rangoTransporte, rangoxpais WHERE transporte.idTransporte = rangoTransporte.idTransporte AND rangoTransporte.idRangoTransporte = rangoxpais.idRangoTransporte AND rangoTransporte.pesoMinimo <= ? AND rangoTransporte.pesoMaximo >= ? AND rangoxpais.idPais = ? AND transporte.status = ? AND rangoTransporte.status = ? ";

        $_MYSQL -> Execute($_SQL, array($_pesoMin, $_pesoMax, $_idPais, 1, 1));
        while($_row = $_MYSQL -> fetchrow()){
            $_registro['idTransporte'] = $_row['idTransporte'];
            $_registro['nombre'] = $_row['nombre'];
            $_registro['tiempoTransito'] = $_row['tiempoTransito'];
            $_registro['ruta'] = $_row['ruta'];
            $_registro['gratis'] = $_row['gratis'];
            $_registro['cantidadGratis'] = $_row['cantidadGratis'];
            $_registro['precio'] = $_row['precio'];
            if(!$this -> in_array_r($_row['idTransporte'], $_response)){
				 array_push($_response, $_registro);
			}

        }

        echo json_encode($_response);
    }

    function in_array_r($needle, $haystack, $strict = false) {
	    foreach ($haystack as $item) {
	        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this -> in_array_r($needle, $item, $strict))) {
	            return true;
	        }
	    }

	    return false;
	}
	/*function listNombreRangoxPais(){
		$_SQL = "SELECT datosRango.idRangoTransporte, datosRango.titulo FROM rangoxpais, datosRango, producto WHERE rangoxpais.idRangoTransporte = datosRango.idRangoTransporte AND rangoxpais.idRangoTransporte = producto.idRangoTransporte AND producto.status = ? AND idPais = ? AND datosRango.lang = ?";
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array(1, $this -> _idPais, 'ES'));
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idRangoTransporte'] = $_row['idRangoTransporte'];
			$_registro['titulo'] = $_row['titulo'];
			array_push($this -> _productos, $_registro);
		}
	}

	function countParticipantesxImagen($idRangoTransporte){
		$sql = "SELECT count(idPais) AS total FROM rangoxpais WHERE idRangoTransporte = ".$idRangoTransporte;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		return $obj -> total;
	}*/

}
?>
