<?php
include_once('conexion.php');
include_once('datosuserend.php');
include_once('userenddireccion.php');

class userend
{
	var $iduserend;
	var $correo;
	var $password;
	var $status;
	var $token;
	var $datosuserend;
	var $direcciones;
	var $userendDireccion;

	var $totalRegistros;		
	var $registrosPorPagina;

	function userend($a = 0, $b = '', $c = '', $stat = 0)
	{
		$this -> iduserend = $a;
		$this -> correo = $b;
		$this -> password = $c;
		$this -> status = $stat;
		$this -> datosuserend = new datosuserend($a);
		$this -> direcciones = array();
		$this -> totalRegistros = 0;		
		$this -> registrosPorPagina = 3;
	}
	
	function inserta_userend($email,$pass,$nombre,$pais,$estado,$url,$tipo)
	{
		$conexion = new conexion();
		$sql = "insert into userend (correo,password,status,token) values('".$email."',MD5('".$pass."'),1,MD5('".$email."'))";
		$this -> iduserend = $conexion -> ejecutar_sentencia($sql);
		$sql3 ="insert into datosuserend(iduserend,nombre,pais,estado, url, tipo) values('".$this->iduserend."','".$nombre."','".$pais."','".$estado."','".$url."','".$tipo."')";
		$conexion -> ejecutar_sentencia($sql3);
		
		$dir = "../imgproducto/temporales/".$this -> iduserend;
		$makedir= mkdir($dir,0777);
	}

	function inserta_userendfb($fuid)
	{
		$conexion = new conexion();
		$sql = "insert into userend (fuid) values('".$fuid."')";
		$this -> iduserend = $conexion -> ejecutar_sentencia($sql);
	}
	
	function nuevo_userend($email,$pass,$nombre,$pais,$estado,$url)
	{
		$resultados = array();
		$conexion = new conexion();
		$sql = "insert into userend (correo,password,status,token) values('".$email."',MD5('".$pass."'),0,MD5('".$email."'))";
		$this -> iduserend = $conexion -> ejecutar_sentencia($sql);
		$sql2 ="SELECT * FROM userend WHERE correo='".$email."'";
		$result=$conexion -> ejecutar_sentencia($sql2);
		$row=mysqli_fetch_array($result);
		$sql3 ="insert into datosuserend(iduserend,nombre,pais,estado, url, tipo) values('".$row['iduserend']."','".$nombre."','".$pais."','".$estado."','".$url."',1)";
		$conexion -> ejecutar_sentencia($sql3);
		$sql4 ="SELECT * FROM userend WHERE correo='".$email."'";
		$temporal = $conexion -> ejecutar_sentencia($sql4);
		while ($fila = mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['token']=$row['token'];
			array_push($resultados,$registro);
		}
		echo json_encode($resultados);
		
		
		$dir = "../imgproducto/temporales/".$row['iduserend'];
		$makedir= mkdir($dir,0777);
	}
	
	function checar_userend($email){
		$resultados = array();
		$conexion = new conexion();
		$sql ="SELECT * FROM userend WHERE correo=".$email."";
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$i=0;
		while ($fila = mysqli_fetch_array($temporal))
		{
			$i++;
		}
		echo json_encode($i);
	}
	function checar_userend2($email){
		$resultados = array();
		$conexion = new conexion();
		$sql ="SELECT * FROM userend WHERE correo=".$email."";
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$i=0;
		$registro = array();
		while ($fila = mysqli_fetch_array($temporal))
		{
			$i++;
			$registro['token']=$fila['token'];
		}
		$registro['num']=$i;
		echo json_encode($registro);
	}
	
	function alta_artista($token)
	{
		$conexion = new conexion();
		$sql ="SELECT * FROM userend WHERE token='".$token."'";
		$result=$conexion -> ejecutar_sentencia($sql);
		$row=mysqli_fetch_array($result);
		if($row['token']!=""){
			$sql2 = "UPDATE userend SET status=1 WHERE token='".$token."'";
			$conexion -> ejecutar_sentencia($sql2);
			
		}
	}
	
	function modifica_userend()
	{
		$conexion= new conexion();
		$pedazo="";
		$pedazo2='';
		if($this->correo != '')
			$pedazo2="correo='".$this->correo."',";
		if ($this->password!='')   
			$pedazo="password=MD5('".$this->password."')";
		$sql="update userend set ".$pedazo2." ".$pedazo."  where iduserend=".$this->iduserend;
		$conexion->ejecutar_sentencia($sql);
	}
	function modifica_userend_pass()
	{
		$conexion= new conexion();
		$sql="update userend set password=MD5('".$this->password."') where iduserend=".$this->iduserend;
		$conexion->ejecutar_sentencia($sql);
	}
	function elimina_userend()
	{
		$conexion=new conexion();
		$sql="delete from userend where iduserend=".$this->iduserend;
		$conexion->ejecutar_sentencia($sql);
		$sql2 = "DELETE FROM wishlist WHERE idartista =" . $this->iduserend . ";";
	    $conexion -> ejecutar_sentencia($sql2);
		$sql3 = "DELETE FROM datosuserend WHERE iduserend=".$this->iduserend;
	    $conexion -> ejecutar_sentencia($sql3);
		
		$sql5="select * from productos where idusuario =" . $this->iduserend . ";";
		$temporal = $conexion -> ejecutar_sentencia($sql5);
		while ($fila = mysqli_fetch_array($temporal)) {
			$sql6 = "DELETE FROM imgproducto WHERE idproducto =" . $fila['idproducto'] . ";";
			$conexion -> ejecutar_sentencia($sql6);
		}
		
		$sql4 = "DELETE FROM productos WHERE idusuario=".$this->iduserend;
	    $conexion -> ejecutar_sentencia($sql4);
		
	}
	
	function Desactivauserend()
	{
		$con=new conexion();
		$sql="update userend set status=0 where iduserend=".$this->iduserend;
		$con->ejecutar_sentencia($sql);	
		$sql="update productouser set status=0 where iduserend=".$this->iduserend;
		$con->ejecutar_sentencia($sql);	
	}
	
	function Activauserend()
	{
		$con=new conexion();
		$sql="update userend set status=1 where iduserend=".$this->iduserend;
		$con->ejecutar_sentencia($sql);	
		$sql="update productouser set status=1 where iduserend=".$this->iduserend;
		$con->ejecutar_sentencia($sql);
	}

	function ActivaUserendToken($token)
	{
		$con=new conexion();
		$sql="update userend set status=1 where token='".$token."' ";
		$con->ejecutar_sentencia($sql);	
	}
	
	function listauserendActivas()
	{
		$conexion=new conexion();
		$sql="select * from userend where status=1 order by iduserend desc";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['iduserend']=$row['iduserend'];
			$registro['correo']=$row['correo'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['token']=$row['token'];
			array_push($resultados,$registro);
		}
		mysqli_free_result($result);
		return $resultados;
	}
	
	function listauserendUser()
	{
		$conexion=new conexion();
		$sql="select * from userend, datosuserend where userend.iduserend=datosuserend.iduserend and userend.status=1 and datosuserend.tipo=1";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['iduserend']=$row['iduserend'];
			$registro['correo']=$row['correo'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['token']=$row['token'];
			array_push($resultados,$registro);
		}
		mysqli_free_result($result);
		return $resultados;
	}
	
	function listauserendProv()
	{
		$conexion=new conexion();
		$sql="select * from userend, datosuserend where userend.iduserend=datosuserend.iduserend and userend.status=1 and datosuserend.tipo=2";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['iduserend']=$row['iduserend'];
			$registro['correo']=$row['correo'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['token']=$row['token'];
			array_push($resultados,$registro);
		}
		mysqli_free_result($result);
		return $resultados;
	}
	
	function listauserendDesactivadas()
	{
		$conexion=new conexion();
		$sql="select iduserend,correo,password,status,tipouserend from userend where status=0";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['iduserend']=$row['iduserend'];
			$registro['correo']=$row['correo'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['tipouserend']=$row['tipouserend'];
			array_push($resultados,$registro);
		}
		mysqli_free_result($result);
		return $resultados;
	}
	
	function listauserendBusqueda($pedazo)
	{
		$conexion=new conexion();
		$sql="select iduserend,correo,password,status,tipouserend from userend where correo like '%".$pedazo."%' order by status";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['iduserend']=$row['iduserend'];
			$registro['correo']=$row['correo'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['tipouserend']=$row['tipouserend'];
			array_push($resultados,$registro);
		}
		echo json_encode($resultados);
	}
	function lista_userend_Ajax()
	{
		$conexion=new conexion();
		$sql="select iduserend,correo,password,status,tipouserend from userend";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['iduserend']=$row['iduserend'];
			$registro['correo']=$row['correo'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['tipouserend']=$row['tipouserend'];
			array_push($resultados,$registro);
		}
		echo json_encode($resultados);
	}
	
	function lista_userend_panel($pagina,$registrosPorPagina){
		$resultados=array();
		$con = new conexion();
		//$sql = "select * from productouser where status = 1 order by idproductouser DESC";
		$sql="select * from userend order by iduserend desc";
		$temporal = $con -> ejecutar_sentencia($sql);
		
		$pagina_actual = $pagina;	
		
		$this -> totalRegistros = mysqli_num_rows($temporal);
		$ultimaPagina = ceil($this -> totalRegistros / $registrosPorPagina);			
			
		$sql .= ' LIMIT '.($pagina - 1) * $registrosPorPagina.','.$registrosPorPagina;		
							
		$temporal2 = $con -> ejecutar_sentencia($sql);
		
		while ($row = mysqli_fetch_array($temporal2)) {
			$registro=array();
			$registro['iduserend']=$row['iduserend'];
			$registro['correo']=$row['correo'];
			$registro['status']=$row['status'];
			$datosuserend = new datosuserend($registro['iduserend']);
			$datosuserend -> obtenerDatosUserend();
			$registro['nombre'] = $datosuserend->nombre;
			
			$registro['ultimapagina']=$ultimaPagina;
			$registro['paginaanterior']=$pagina-1;
			$registro['paginasiguiente']=$pagina+1;
			$registro['pagina']=$pagina;
			
			array_push($resultados, $registro);						
		}
		mysqli_free_result($temporal2);
		return $resultados;
	}
	function buscar_userend_panel($cadena){
		$resultados=array();
		$con = new conexion();
		//$sql = "select * from productouser where status = 1 order by idproductouser DESC";
		$sql="select datosuserend.iduserend, correo, status, nombre 
			from userend, datosuserend
			where userend.iduserend = datosuserend.iduserend";
		
		if($cadena != ''){
			$sql .= " and (correo like '%".$cadena."%' or nombre like '%".$cadena."%') group by datosuserend.iduserend order by userend.iduserend desc ";
			$temporal = $con -> ejecutar_sentencia($sql);
		}else{
			$sql .=" order by userend.iduserend desc";
			$temporal = $con -> ejecutar_sentencia($sql);
		}
		
		while ($row = mysqli_fetch_array($temporal)) {
			$registro=array();
			$registro['iduserend']=$row['iduserend'];
			$registro['correo']=$row['correo'];
			$registro['status']=$row['status'];
			$registro['nombre'] = $row['nombre'];
			
			array_push($resultados, $registro);						
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function obten_userend()
	{
		$conexion=new conexion();
		$sql="select * from userend where iduserend='".$this->iduserend."'";
		$result=$conexion->ejecutar_sentencia($sql);
		while($row=mysqli_fetch_array($result))
		{
			$this->iduserend=$row['iduserend'];
			$this->correo=$row['correo'];
			$this->password=$row['password'];
			$this->status=$row['status'];
			$this->token=$row['token'];
		}
		mysqli_free_result($result);
	}
	
	function modificarcreditos($iduserend,$creditos){
		$con = new conexion();
		$sql = "update datosuserend set creditos = creditos + '".$creditos."' where iduserend =".$iduserend;
		$con -> ejecutar_sentencia($sql);
	}
	
	function disponibilidadCorreo($correo)
	{
		$conexion=new conexion();
		$sql="SELECT correo FROM userend where correo='".$correo."'";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados = mysqli_num_rows($result);
		if ($resultados > 0){
			return false;
		}
		else{
			return true;
		}
	}

	function disponibilidadFuid($fuid)
	{
		$conexion=new conexion();
		$sql="SELECT fuid FROM userend where fuid='".$fuid."'";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados = mysqli_num_rows($result);
		if ($resultados > 0){
			return false;
		}
		else{
			return true;
		}
	}

	function rescueCorreo($correo){
		$con = new conexion();
		$sql = "SELECT iduserend FROM userend WHERE correo='".$correo."' and status=1 ";
		$result = $con->ejecutar_sentencia($sql);
		while($fila = mysqli_fetch_array($result)){
			$this->iduserend = $fila['iduserend'];
		}
	}
	function buscaremail()
	{
		$conexion=new conexion();
		$sql="SELECT iduserend FROM userend where correo='".$this->correo."'";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysql_fetch_array($result))
		{
			$registro=array();
			$registro['iduserend']=$row['iduserend'];
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}
	function errorLogin(){
		$conexion=new conexion();
		$sql="select * from userend where correo='".$this->correo."'";
		$result=$conexion->ejecutar_sentencia($sql);
		while($fila =mysqli_fetch_array($result))
		{
			$this->iduserend=$fila['iduserend'];
			$this->password = $fila['password'];
			$this->status = $fila['status'];
			$this->correo = $fila['correo'];
		}	
	}
	function disponibilidadToken($token){
		$conexion=new conexion();
		$sql="SELECT iduserend FROM userend where token='".$token."' and status = 0";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados = mysqli_num_rows($result);
		if ($resultados > 0){
			return true;
		}
		else{
			return false;
		}
	}
	function disponibilidadTokenRepass($token){
		$conexion=new conexion();
		$sql="SELECT iduserend FROM userend where token='".$token."' and status = 1";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados = mysqli_num_rows($result);
		if ($resultados > 0){
			while($row = mysqli_fetch_array($result)){
				$this->iduserend = $row['iduserend'];	
			}
			return true;
		}
		else{
			$this->iduserend = 0;
			return false;
		}
	}
	
	function obtenerUserToken()
	{
		$con = new conexion();
		$sql = "SELECT iduserend FROM userend WHERE token='".$this->token."'";
		$registro = $con -> ejecutar_sentencia($sql);
		while($fila = mysqli_fetch_array($registro))
		{
			$this -> iduserend = $fila['iduserend'];
		}
		mysqli_free_result($registro);
	}

	function login()
	{
		$conexion=new conexion();
		$sql="select * from userend where correo='".$this->correo."'and password = MD5('".$this->password."') and status=1";
		$temporal = $conexion->ejecutar_sentencia($sql);
		while($fila =mysqli_fetch_array($temporal))
		{
			$sql2="select * from datosuserend where iduserend=".$fila['iduserend']."";
			$temporal2 = $conexion->ejecutar_sentencia($sql2);	
			$fila2 =mysqli_fetch_array($temporal2);
			$this->iduserend = $fila['iduserend'];
			$this->correo = $fila['correo'];
			$this->nombre = $fila2['nombre'];
		}
	}

/*========================================================================
		SECCION DE LAS OPERACIONES PARA INSERTAR EN DATOSUSEREND.PHP
========================================================================*/
	function insertaDatosUserend($nombre, $apellido, $company, $direccion, $ciudad, $postal, $telefono, $tipo){
		$this -> datosuserend = new datosuserend($this -> iduserend, $nombre, $apellido, $company, $direccion, $ciudad, $postal, $telefono, $tipo);		
		$this -> datosuserend -> insertarDatosUserend();
	}
		
	function modificaDatosUserend($nombre, $apellido, $company, $direccion, $ciudad, $postal, $telefono, $tipo){
		$this -> datosuserend = new datosuserend($this -> iduserend, $nombre, $apellido, $company, $direccion, $ciudad, $postal, $telefono, $tipo);	
		$this -> datosuserend -> modificarDatosUserend();
	}
		
	function eliminaDatosUserend(){
		$this -> datosuserend -> eliminarDatosUserend();
	}
		
	function obteneDatosUserend(){
		$this -> datosuserend -> obtenerDatosUserend();
	}
/*========================================================================
		SECCION DE LAS OPERACIONES PARA INSERTAR EN USERENDDIRECCION.PHP
========================================================================*/
	function insertarDireccion($nombreDireccion,$nombre, $apellido, $telefono, $correo, $direccion, $city, $zip, $status, $pais, $estado){
		$direccionTemporal = new userenddireccion(0,$this->iduserend,$nombreDireccion,$nombre, $apellido, $telefono, $correo, $direccion, $city, $zip, $status, $pais, $estado);
		$direccionTemporal -> agregarDireccion();
	}
	function modificarDireccion($iddireccion, $nombreDireccion,$nombre, $apellido, $telefono, $correo, $direccion, $city, $zip, $status, $pais, $estado){
		$direccionTemporal = new userenddireccion($iddireccion, 0,$nombreDireccion,$nombre, $apellido, $telefono, $correo, $direccion, $city, $zip, $status, $pais, $estado);
		$direccionTemporal -> modificarDireccion();
	}
	function modificarDefault($iddireccion){
		$direccionTemporal = new userenddireccion($iddirecion);
		$direccionTemporal -> defaultDireccion();
	}
	function eliminarDireccion($iddireccion){
		$direccionTemporal = new userenddireccion($iddireccion);
		$direccionTemporal->eliminarDireccion();
	}
	function listarDireccion(){
		$direccionTemporal = new userenddireccion(0,$this->iduserend);
		$this->direcciones = $direccionTemporal->listarDirecciones();
	}
	function obtenerDireccion($iddireccion){
		$this->userendDireccion = new userenddireccion($iddireccion);
		$this->userendDireccion->obtenerDireccion();
	}
	/*************************************************CORREO BIENVENIDA******************************************/
	function getMailBienvenida($token){
		$conexion=new conexion();
		$sql="select * from userend where token='".$token."' or Fuid='".$token."'";
		$result=$conexion->ejecutar_sentencia($sql);
		$row=mysqli_fetch_array($result);
		$registro=array();
		$registro['correo']=$row['correo'];
		echo json_encode($registro);
	}
}
?>