<?php
include_once('conexion.php');
require_once ('archivo.php');
class datosuserend extends Archivo
{	
	var $iduserend;
	var $tipo;
//	SECCION DE NOMBRES	
	var $nombre;
//	SECCION DE LA DIRECCION	
	var $pais;
	var $estado;
	var $url;
	var $ruta;
	var $featured;
	var $directorio = '../imgartistas/';
	
	function datosuserend($iduserend = 0, $rut='', $nombre = '', $pais = '', $url = '', $estado = '',  $tipo = '', $temporal = ''){
		if ($rut != '') {
			$this -> ruta = $this -> obtenerExtensionArchivo($rut);
		} else {
			$this -> ruta = '';
		}
		$this->iduserend=$iduserend;
		$this->nombre = $nombre;
		$this->pais = $pais;
		$this->estado = $estado;
		$this->url = $url;
		$this->ruta = $rut;
		$this->descripcion = $descripcion;
		$this->tipo = $tipo;
		$this->featured = $featured;
		
		$this -> ruta_final = $this -> directorio;
		$this -> ruta_temporal = $temporal;
	}
	
	function insertarDatosUserend(){
		$con = new conexion();
		$sql = "INSERT INTO datosuserend (iduserend, nombre, apellido, company, direccion, ciudad, postal, telefono, tipo) VALUES (".$this->iduserend.", '".htmlspecialchars($this->nombre, ENT_QUOTES)."', '".htmlspecialchars($this->apellido, ENT_QUOTES)."', '".htmlspecialchars($this->company, ENT_QUOTES)."', '".htmlspecialchars($this->direccion, ENT_QUOTES)."', '".htmlspecialchars($this->ciudad, ENT_QUOTES)."', '".htmlspecialchars($this->postal, ENT_QUOTES)."', '".htmlspecialchars($this->telefono, ENT_QUOTES)."', '".htmlspecialchars($this->tipo, ENT_QUOTES)."')";
		$con -> ejecutar_sentencia($sql);
	}

	function modificarDatosUserend(){
		$con = new conexion();
		if ($this -> ruta != '') {
			$titulo_temporal = $this -> nombre;
			$ruta_temporal = $this -> ruta;
			$this -> recuperadatosuserend();
			$this -> borrar_archivo();
			$this -> nombre = $titulo_temporal;
			$this -> ruta = $ruta_temporal;
			$this->ruta_final=$this->directorio;
			$ruta=$this -> subir_archivo($this->ruta);
			$sql=' ruta=\''.$ruta.'\',';
		} else {
			$sql = '';
		}
		$sql2 = "UPDATE datosuserend SET 
		".$sql." 
		nombre = '".htmlspecialchars($this->nombre, ENT_QUOTES)."', 
		pais = '".htmlspecialchars($this->pais, ENT_QUOTES)."',
		estado = '".htmlspecialchars($this->estado, ENT_QUOTES)."',  
		url = '".htmlspecialchars($this->url, ENT_QUOTES)."'
		where iduserend = ".$this->iduserend;
		$con -> ejecutar_sentencia($sql2);
		
	}
	
	function modificapassword($password)
	{
		$conexion= new conexion();
		$pedazo="";
		if ($password!='')   
			$pedazo="password=MD5('".$password."')";
		$sql="update userend set ".$pedazo."  where iduserend=".$this->iduserend;
		$conexion->ejecutar_sentencia($sql);
	}
	
	function eliminarDatosUserend(){
		$con = new conexion();
		$sql = "DELETE FROM datosuserend WHERE iduserend = '".$this->iduserend."';";
		$con -> ejecutar_sentencia($sql);
	}
	
	function obtenerDatosUserend(){
		$con = new conexion();
		$sql = "SELECT * FROM datosuserend WHERE iduserend = '".$this->iduserend."';";
		$registro = $con -> ejecutar_sentencia($sql);
		while($fila = mysqli_fetch_array($registro)){
			$this -> iduserend = $fila['iduserend'];
			$this -> nombre = $fila['nombre'];	
			$this -> pais = $fila['pais'];
			$this -> estado = $fila['estado'];		
			$this -> url = $fila['url'];
			$this -> creditos = $fila['creditos'];
			$this -> descripcion = $fila['descripcion'];
			$this -> facebook = $fila['facebook'];
			$this -> twitter = $fila['twitter'];
			$this -> instagram = $fila['instagram'];
			$this -> pinterest = $fila['pinterest'];
			$this -> ruta = $fila['ruta'];
			$this -> tipo = $fila['tipo'];	
			$this -> featured = $fila['featured'];			
		}
		mysqli_free_result($registro);
	}
	
	function obtener_datos_userend_token($token){
		$con = new conexion();
		$sql="SELECT * FROM datosuserend WHERE token='".$token."';";
		$registro=$con->ejecutar_sentencia($sql);
		while($fila = mysqli_fetch_array($registro)){
			$this->iduserend=$fila['iduserend'];
			$this->nombre=$fila['nombre'];				
			$this->email=$fila['email'];
			$this->telefono=$fila['telefono'];			
		}
		mysqli_free_result($registro);
		$this->activarUserendToken();
	}
	
	function activarUserendToken(){
		$con = new conexion();
		$sql = "UPDATE userend SET status = 1 WHERE iduserend = ".$this->iduserend."";
		$con->ejecutar_sentencia($sql);
	}
	
	function recuperadatosuserend() {
		$sql = "select * from datosuserend where iduserend =" . $this -> iduserend . ";";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> iduserend = $fila['iduserend'];
			$this -> ruta = $fila['ruta'];
			$this -> nombre = $fila['nombre'];
			$this -> ruta_final = $this -> directorio . $fila['ruta'];
		}
	}	
	/**********************************************FEATURED*****************************************************/
	function featuredartist($id,$tipo,$pass,$nombre,$email,$pais,$estado,$url) {	
		$con = new conexion();
		if ($this -> ruta != '') {
			$titulo_temporal = $this -> nombre;
			$ruta_temporal = $this -> ruta;
			$this -> recuperadatosuserend();
			$this -> borrar_archivo();
			$this -> nombre = $titulo_temporal;
			$this -> ruta = $ruta_temporal;
			$this -> ruta_final = $this -> directorio . $ruta_temporal;
			$sql = ' ruta=\'' . $this -> ruta . '\',';
		} else {
			$sql = '';
		}
		
		if($tipo=="")
		{
			$tipo=1;
		}
		
		$sql1 = "UPDATE userend SET 
		correo = '".$email."'
		where iduserend = ".$id;
		$con -> ejecutar_sentencia($sql1);
		
		$sql2 = "UPDATE datosuserend SET 
		nombre = '".$nombre."',
		pais = '".$pais."',
		estado = '".$estado."',
		url = '".$url."',
		tipo = '".$tipo."'
		where iduserend = ".$id;
		$con -> ejecutar_sentencia($sql2);
		if($pass!="0"){
			$sql3 = "UPDATE userend SET 
			password = MD5('".$pass."')
			where iduserend = ".$id;
			$con -> ejecutar_sentencia($sql3);
		}
	}
	/******************************************PERFIL POR URL*****************************************************/
	function obtenerDatosUserendArtista($id){
		$con = new conexion();
		$sql = "SELECT * FROM datosuserend as M 
		INNER JOIN userend AS Q ON Q.iduserend = M.iduserend AND Q.status=1 
		WHERE M.url = '".htmlspecialchars($id)."' AND M.url!='';";
		$registro = $con -> ejecutar_sentencia($sql);
		while($fila = mysqli_fetch_array($registro)){
			$this -> iduserend = $fila['iduserend'];
			$this -> nombre = $fila['nombre'];	
			$this -> pais = $fila['pais'];		
			$this -> url = $fila['url'];
			$this -> creditos = $fila['creditos'];
			$this -> descripcion = $fila['descripcion'];
			$this -> facebook = $fila['facebook'];
			$this -> twitter = $fila['twitter'];
			$this -> instagram = $fila['instagram'];
			$this -> pinterest = $fila['pinterest'];
			$this -> ruta = $fila['ruta'];
			$this -> tipo = $fila['tipo'];	
			$this -> featured = $fila['featured'];			
		}
		mysqli_free_result($registro);
	}
	/******************************CHECAR DISPONIBILIDAD DE URL******************************************************/
	function checkdispurl($url,$id){
		$con = new conexion();
		$resultados = array();
		$sql="SELECT * FROM datosuserend WHERE iduserend!=".$id." AND url='".$url."' AND url!=''";
		$temporal = $con -> ejecutar_sentencia($sql);
		$fila = mysqli_fetch_array($temporal);
		$i = count($fila['iduserend']);
		$registro = array();
		$registro['numero'] = $i;
		array_push($resultados, $registro);
		echo json_encode($resultados);
	}
	function checkdispurlnew($url){
		$con = new conexion();
		$resultados = array();
		$sql="SELECT * FROM datosuserend WHERE url='".$url."' AND url!=''";
		$temporal = $con -> ejecutar_sentencia($sql);
		$fila = mysqli_fetch_array($temporal);
		$i = count($fila['iduserend']);
		$registro = array();
		$registro['numero'] = $i;
		array_push($resultados, $registro);
		echo json_encode($resultados);
	}
}
?>