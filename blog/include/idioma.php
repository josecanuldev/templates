<?php 

	if (isset($_GET['idioma']) && $_GET['idioma']!=''){

		$idioma=strtolower($_GET['idioma']);

		if($idioma == "es"){

			$marcaidioma = ".espanol";

		}else{

			$marcaidioma = ".ingles";	

		}	

	}else{

		$idioma='es';

		$marcaidioma = ".espanol";

	}
 

	include_once ("lang/{$idioma}.php");

?>