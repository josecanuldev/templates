<?php
include_once('conexion.php');

class contacto
{
	  var $idcontacto;
	  var $correo;
	  var $emisor;
		var $tituloAvisoPrivacidad;
		var $descripcionAvisoPrivacidad;
		var $tituloAvisoPrivacidadEn;
		var $descripcionAvisoPrivacidadEn;
		var $tituloFaqs;
		var $descripcionFaqs;
		var $tituloFaqsEn;
		var $descripcionFaqsEn;
		var $tituloMensajeBlog;
		var $descripcionMensajeBlog;
		var $tituloMensajeBlogEn;
		var $descripcionMensajeBlogEn;

	  function __construct($idc=1,$correo='',$emisor='',$tituloAvisoPrivacidad='',$descripcionAvisoPrivacidad='',$tituloAvisoPrivacidadEn='',$descripcionAvisoPrivacidadEn='',$tituloFaqs='',$descripcionFaqs='',$tituloFaqsEn='',$descripcionFaqsEn='',$tituloMensajeBlog='',$descripcionMensajeBlog='',$tituloMensajeBlogEn='',$descripcionMensajeBlogEn='')
	  {
		  $this->idcontacto=$idc;
		  $this->correo=$correo;
		  $this->emisor=$emisor;
			$this->tituloAvisoPrivacidad=htmlentities($tituloAvisoPrivacidad, ENT_QUOTES);
			$this->descripcionAvisoPrivacidad=htmlentities($descripcionAvisoPrivacidad, ENT_QUOTES);
			$this->tituloAvisoPrivacidadEn=htmlentities($tituloAvisoPrivacidadEn, ENT_QUOTES);
			$this->descripcionAvisoPrivacidadEn=htmlentities($descripcionAvisoPrivacidadEn, ENT_QUOTES);
			$this->tituloFaqs=htmlentities($tituloFaqs, ENT_QUOTES);
			$this->descripcionFaqs=htmlentities($descripcionFaqs, ENT_QUOTES);
			$this->tituloFaqsEn=htmlentities($tituloFaqsEn, ENT_QUOTES);
			$this->descripcionFaqsEn=htmlentities($descripcionFaqsEn, ENT_QUOTES);

			$this->tituloMensajeBlog=htmlentities($tituloMensajeBlog, ENT_QUOTES);
			$this->descripcionMensajeBlog=htmlentities($descripcionMensajeBlog, ENT_QUOTES);
			$this->tituloMensajeBlogEn=htmlentities($tituloMensajeBlogEn, ENT_QUOTES);
			$this->descripcionMensajeBlogEn=htmlentities($descripcionMensajeBlogEn, ENT_QUOTES);
	  }

	  function insertar_contacto()
	  {
		  $sql="insert into contacto(correo,emisor) values ('".$this->correo."','".$this->emisor."');";
		  $con=new conexion();
		  $con->ejecutar_sentencia($sql);
		  //echo $sql;
	  }

	  function modificar_contacto()
	  {
		  $sql="update contacto set correo='".$this->correo."',emisor='".$this->emisor."',tituloAvisoPrivacidad='".$this->tituloAvisoPrivacidad."',descripcionAvisoPrivacidad='".$this->descripcionAvisoPrivacidad."',tituloAvisoPrivacidadEn='".$this->tituloAvisoPrivacidadEn."',descripcionAvisoPrivacidadEn='".$this->descripcionAvisoPrivacidadEn."',tituloFaqs='".$this->tituloFaqs."',descripcionFaqs='".$this->descripcionFaqs."',tituloFaqsEn='".$this->tituloFaqsEn."',descripcionFaqsEn='".$this->descripcionFaqsEn."',tituloMensajeBlog='".$this->tituloMensajeBlog."',descripcionMensajeBlog='".$this->descripcionMensajeBlog."',tituloMensajeBlogEn='".$this->tituloMensajeBlogEn."',descripcionMensajeBlogEn='".$this->descripcionMensajeBlogEn."' where idcontacto=".$this->idcontacto.";";
		  $con=new conexion();
		  $con->ejecutar_sentencia($sql);
	  }

	  function modificarConfiguracion($modoSitio)
	  {
		  $sql="update contacto set modoSitio='".$modoSitio."' where idcontacto=".$this->idcontacto.";";
		  $con=new conexion();
		  $con->ejecutar_sentencia($sql);
	  }

	function obtener_contacto()
	{
	  $sql="select * from contacto where idcontacto=".$this->idcontacto.";";
	  $con=new conexion();
	  $resultados=$con->ejecutar_sentencia($sql);
	  while ($fila=mysqli_fetch_array($resultados))
	  {
		$this->idcontacto=$fila['idcontacto'];
		$this->correo=$fila['correo'];
		$this->emisor=$fila['emisor'];
		$this->tituloAvisoPrivacidad=htmlspecialchars_decode($fila['tituloAvisoPrivacidad']);
		$this->descripcionAvisoPrivacidad=htmlspecialchars_decode($fila['descripcionAvisoPrivacidad']);
		$this->tituloAvisoPrivacidadEn=htmlspecialchars_decode($fila['tituloAvisoPrivacidadEn']);
		$this->descripcionAvisoPrivacidadEn=htmlspecialchars_decode($fila['descripcionAvisoPrivacidadEn']);
		$this->tituloFaqs=htmlspecialchars_decode($fila['tituloFaqs']);
		$this->descripcionFaqs=htmlspecialchars_decode($fila['descripcionFaqs']);
		$this->tituloFaqsEn=htmlspecialchars_decode($fila['tituloFaqsEn']);
		$this->descripcionFaqsEn=htmlspecialchars_decode($fila['descripcionFaqsEn']);
		$this->tituloMensajeBlog=htmlspecialchars_decode($fila['tituloMensajeBlog']);
		$this->descripcionMensajeBlog=htmlspecialchars_decode($fila['descripcionMensajeBlog']);
		$this->tituloMensajeBlogEn=htmlspecialchars_decode($fila['tituloMensajeBlogEn']);
		$this->descripcionMensajeBlogEn=htmlspecialchars_decode($fila['descripcionMensajeBlogEn']);
	  }
	  mysqli_free_result($resultados);
	}

	function obtenerConfiguracion()
	{
	  $sql="select modoSitio from contacto where idcontacto=".$this->idcontacto.";";
	  $con=new conexion();
	  $resultados=$con->ejecutar_sentencia($sql);
	  while ($fila=mysqli_fetch_array($resultados))
	  {
		$this->idcontacto=$fila['idcontacto'];
		$this->modoSitio=$fila['modoSitio'];
	  }
	  mysqli_free_result($resultados);
	}

}
?>
