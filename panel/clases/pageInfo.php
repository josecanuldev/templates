<?php
require_once('MYSQL.php');
require_once('archivo.php');
require_once('herramientas.php');

class pageInfo extends Archivo{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_id;
	var $_nombre;
	var $_logo;
	var $_url;
	var $_whatsapp1;
	var $_whatsapp2;
	var $_correo1;
	var $_correo2;
	var $_telefono1;
	var $_telefono2;
	var $_facebook;
	var $_instagram;
	var $_tmp;
	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_status;
	var $_orden;
	var $_directorio = "../img/imgPageInfo/";
	var $_registrosPorPagina;
	var $_totalRegistros;
	var $_herramientas;

	function __construct($_id = 0, $_nombre = '', $_imglogo = '', $_url = '', $_whatsapp1 = '', $_whatsapp2 = '', $_correo1 = '', $_correo2 = '', $_telefono1 = '', $_telefono2 = '', $_facebook = '', $_instagram = '', $_tmp = '') {
		$this -> _id = $_id;
		$this -> _nombre = $_nombre;
		$this -> _logo = $_imglogo;
		$this -> _url = $_url;
		$this -> _whatsapp1 = $_whatsapp1;
		$this -> _whatsapp2 = $_whatsapp2;
		$this -> _correo1 = $_correo1;
		$this -> _correo2 = $_correo2;
		$this -> _telefono1 = $_telefono1;
		$this -> _telefono2 = $_telefono2;
		$this -> _facebook = $_facebook;
		$this -> _instagram = $_instagram;

		$this-> _tmp = $_tmp;

		$this -> ruta_final = $this -> _directorio;
		$this -> _herramientas = new herramientas();
	}

	function updatePage() {
		$_MYSQL = new MYSQL();
		$this->updateImg();

		$_SQL = "UPDATE page SET nombre = ?, url = ?,  whatsapp1 = ?,  whatsapp2 = ?,  correo1 = ?, correo2 = ?, telefono1 = ?, telefono2 = ?, facebook = ?, instagram = ? WHERE id = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO) {
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _nombre, $this -> _url, $this -> _whatsapp1, $this -> _whatsapp2, $this -> _correo1, $this -> _correo2, $this-> _telefono1, $this-> _telefono2, $this-> _facebook, $this-> _instagram, $this-> _id))) {
			$_success = 2;
		} else {
			$_success = 0;
		}
		return $_success;
	}

	function updateImg() {
		if($this-> _logo != '') {
			$this -> getImg();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			$this -> ruta_temporal = $this-> _tmp;
			$this-> _logo = $this -> obtenerExtensionArchivo($this-> _logo);
			$this -> subir_archivo_imagen($this-> _logo);
			$_MYSQL = new MYSQL();
			$_SQL = "UPDATE page SET logo = ? WHERE id = ?";
			$_CONECTADO = $_MYSQL -> Connect();
			if(!$_CONECTADO) {
				echo 'Ocurrio un error, Por favor intentalo mas tarde.';
				exit();
			}
			$_MYSQL -> Execute($_SQL, array($this-> _logo, $this -> _id));
		}
	}

	function getImg() {
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT logo FROM page WHERE id = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _id));
		$obj = $_MYSQL -> fetchobject();
		$this -> ruta_final = $this -> _directorio. $obj -> _logo;
	}

	function getPage() {
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM page WHERE id = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _id));
		$obj = $_MYSQL -> fetchobject();
		return $obj;
	}
}
?>