<?php
session_start();
date_default_timezone_set("America/Mexico_City");
include('../include/path.php');
function __autoload($nombre_clase) {
    include '../../panel/clases/'.$nombre_clase .'.php';
}
$_operaciones = $_POST['operaciones'];

	switch ($_operaciones) {
    case 'rating':
    $idBlog=$_REQUEST['idBlog'];
    $ip=$_REQUEST['ip'];
    $valor=$_REQUEST['valor'];
    $ratingBlog=new blog();
    $listaExistente=$ratingBlog->listaRatingExistente($idBlog,$ip,$valor);
    $totalExistente=count($listaExistente);
    if($totalExistente == 0){
      $nuevoRating=new blog();
      $nuevoRating->addRating($idBlog,$ip,$valor);
      echo 1;
    }else{
      echo 0;
    }
    break;
    case 'listaReceta':
			$galeria = new testimonio3();
			$listado = $galeria->listaTestimonio(1,false,1,"","ES","",20,$_REQUEST["orden"]);
			echo json_encode($listado);
			break;
    case 'agregarNewsletterBlog':
      $tema=$_REQUEST["tema1"].' '.$_REQUEST["tema2"].' '.$_REQUEST["tema3"].' '.$_REQUEST["tema4"].' '.$_REQUEST["tema5"].' '.$_REQUEST["tema6"];
  		$newsletter=new newsletterblog(0,$_REQUEST["correo"],"",$_REQUEST["nombre"],$_REQUEST["pais"],$_REQUEST["ciudad"],$_REQUEST["genero"],$tema);
      $newsletter->addNewsletter();
      echo "success";
		break;
    case 'agregarComentarioBlog':
      $fecha=date("Y-m-d H:i:s");
      //$fechaFormato=date_format($fecha, 'd/m/Y H:i:s');
  		$comentario=new blog();
      $comentario->addComentarioBlog($_REQUEST["idBlog"],$_REQUEST["nombre"],$_REQUEST["correo"],$_REQUEST["mensaje"],$fecha);
      echo $fecha;
		break;
		default:
			# code...
			break;
	}
?>
