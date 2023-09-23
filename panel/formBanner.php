<?php
	function __autoload($ClassName){
	    include('clases/'.$ClassName.".php");
	}
	/**
	 * [$seguridad: instancia - Clase para los candados y seguridad del panel]
	 * @var seguridad
	 */
	$seguridad = new seguridad();
	$seguridad -> candado();
	$_MOD = '';
	$sort = '';
	/**
	 * If que indentifica si se esta agregando o modificando el slide.
	 */
	if(isset($_REQUEST['idSlide'])){
		$id = $_REQUEST['idSlide'];
		$operacion = 'modificarbanner';
		$palabra = 'Editar Banner';
		$_MOD = '1';
		$temporal = new slide($id);
		$temporal -> getSlide();
	}
	else{
		$id = 0;
		$operacion = 'agregarbanner';
		$palabra = 'Nuevo Banner';
		$_MOD = '0';
		$img = '';
		$temporal = new slide($id);
	}
	/**
	 * Variables para los permisos
	 * @var string
	 */
	$clave = 'p_mod_banner';
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Formulario | Banner</title>
	</head>
	<body>
		<header>
			<?php include 'header.php';?>
		</header>
		<!--wrapper es el que contiene a toda la pagina-->
    	<div id="wrapper" class="wrapper-movil">
    		<?php include 'menu.php';?>
    		<!-- Page content Sección del contenido de la pagina-->
	        <div id="page-content-wrapper">
	        	<!-- Keep all page content within the page-content inset div! -->
            	<div class="page-content inset">
            		<div class="row rowedit">
            			<!--Seccion del titulo -->
            			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	                        <p class="titulo"><?=$palabra?></p>
	                    </div>
	                    <form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post" enctype="multipart/form-data">
                    		<input type="hidden" name="idSlide" value="<?=$id?>">
                    		<input type="hidden" name="operaciones" value="<?=$operacion?>">
                    		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    			<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?>  class="buttonguardar">Guardar y Publicar</button>
                   			</div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<hr class="hrmenu">
		                    </div>
		                    <div class="clearfix"></div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<div class='notifications top-right'></div>
		                    </div>
		                    <div class="col-md-8 col-md-offset-2  col-xs-12">
		                    	<center>
                                    <span class="textHelper">Previsualizar Slide:</span>
                                    <br>
                                    <div id="miniatura-slide">
                                        <?php if($temporal -> ruta != ''){ ?>
                                            <img width="auto" height="250px" src="../img/imgSlide/<?=$temporal -> ruta?>"/>
                                        <?php } ?>
                                    </div>
                                    <br>
                                    <center>
                                        <input id="files" data-validate="true" data-type-file="imagen" data-text="Imagen Banner" onchange="showMyImage('miniatura-slide',this)" name="archivo" type="file" class="upload"/>
                                    </center>
                                    <br>
                                    <div class="text-center textHelper">
                                        Tipo de archivos permitidos: .png, .jpg y .jpeg <br> El archivo no deber ser mayor de 3Mb
                                    </div>
                                    <br>
                                </center>
		                    	<div id="msgUrl" class="input-group espacios">
		                        	<span class="input-group-addon">Url</span>
		                        	<input type="text" name="url" data-validate="false" class="form-control" placeholder="Ingresa la url del slide..." value="<?=$temporal -> url?>">
		                        </div>
		                    </div>
		                    <div class="clearfix"></div>
		                    <!--Este div contiene la barra inferior-->
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<hr class="hrmenu">
		                    </div>
		                    <div class="clearfix"></div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?=$operacion?>" class="buttonguardar">Guardar y Publicar</button>
		                    </div>
                    	</form>
            		</div>
            	</div>
	        </div>
    	</div>
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
	</footer>
</html>
