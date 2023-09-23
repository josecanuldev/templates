<?php
function __autoload($ClassName){
    include('clases/'.$ClassName.".php");
}
$seguridad = new seguridad();
$seguridad->candado();
$_MOD = '';
$sort = '';

if(isset($_REQUEST['idProducto'])){
	$id = $_REQUEST['idProducto'];
	$operacion = 'modificarproducto';
	$palabra = 'Editar Producto';
	$_MOD = '1';
	$temporal = new producto($id);
	$temporal -> getProducto();
	$addP = " active";
	$iniT = '';
}
else{
	$id = 0;
	$operacion = 'agregarproducto';
	$palabra = 'Nuevo Producto';
	$_MOD = '0';
	$img = '';
	$temporal = new producto($id);
	$addP = " hide";
	$iniT = ' active';
}
$clave = 'p_mod_producto';
$clave2 ='p_sort_galeria_producto';
$sort = 'galeriaProducto';
$handle = 'handle sortimg';

$categoria = new categoria();
$categorias = $categoria  -> listCategoria(1, false, 1, '', 20, 1, false);

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Formulario | Producto</title>
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
            			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	                        <p class="titulo"><?=$palabra?></p>
	                    </div>
	                    <form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post" enctype="multipart/form-data">                    		
                    		<input type="hidden" name="idProducto" id="idProducto" value="<?=$id?>">
                    		<input type="hidden" id="idSubcategoriaSelected" value="<?=$temporal -> _idSubcategoria?>">
                    		<input type="hidden" name="operaciones" value="<?=$operacion?>">
                    		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    			<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?>  class="buttonguardar">Guardar y Publicar</button>
                   			</div>
		                    
		                    <div class="clearfix"></div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<div class='notifications top-right'></div>
		                    	<div class='notifications bottom-right'></div>
		                    </div>
							
							<div role="tabpanel" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="<?=$iniT?>">
										<a href="#producto-es" aria-controls="producto-es" role="tab" data-toggle="tab">DATOS GENERALES</a>
									</li>
									<li role="presentation">
										<a href="#producto-en" aria-controls="producto-en" role="tab" data-toggle="tab">DATOS GENERALES INGLÉS</a>
									</li>
									<li role="presentation">
										<a href="#galeria" aria-controls="galeria" role="tab" data-toggle="tab">GALERÍA</a>
									</li>
								</ul>
							
								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane espacios <?=$iniT?>" id="producto-es">
										<div class="col-lg-8 col-lg-offset-2 col-md-6 col-sm-12 col-xs-12">
											<center>
												PREVISUALIZAR IMAGEN PORTADA
												<div id="preview-img-producto" class="espacios">
													<?=($temporal -> _imgPortada != '') ?  '<img width="auto" height="250px" src="../img/producto/galeria/'.$temporal -> _imgPortada.'">' : '';?>														
												</div>
												<input type="hidden" name="idPortada" value="<?=$temporal -> _idPortada?>">
												<input type="file" data-validate="true" data-type-file="imagen" data-text="portada" onchange="showMyImageWH('preview-img-producto', this, '', 1, 800, 800)" name="archivo" class="filestyle" data-input="false" data-buttonText="Imagen Portada" data-iconName="fa fa-picture-o" data-badge="false">
												<p class="help-block">Solo se aceptan imágenes con formato .JPG, .JPEG, La imagen debe ser menor a 3 MB y la resolución óptima para esta imagen es de 800x800  </p>
											</center>
                                            <br><br>
                                            <center>
												PREVISUALIZAR IMAGEN FONDO
												<div id="preview-img-producto-2" class="espacios">
													<?=($temporal -> _imgFondo != '') ?  '<img width="auto" height="250px" src="../img/producto/galeria/'.$temporal -> _imgFondo.'">' : '';?>														
												</div>
												<input type="hidden" name="idFondo" value="<?=$temporal -> _idFondo?>">
												<input type="file" data-validate="true" data-type-file="imagen" data-text="fondo" onchange="showMyImageWH('preview-img-producto-2', this, '', 1, 1920, 1080)" name="archivo2" class="filestyle" data-input="false" data-buttonText="Imagen Fondo" data-iconName="fa fa-picture-o" data-badge="false">
												<p class="help-block">Solo se aceptan imágenes con formato .JPG, .JPEG, La imagen debe ser menor a 3 MB y la resolución óptima para esta imagen es de 1920x1080  </p>
											</center>
                                            <br><br>
											<p class="help-block">Selecciona una categoría para este Producto</p>
											<select name="idCategoria" id="idCategoria" data-validate="true" data-text="Categoria" class="selectpicker-general" title="Elegir Categoría">
										<?php
											foreach($categorias as $_cat){
										?>
												<option <?=($_cat['idCategoria'] == $temporal -> _idCategoria) ? 'selected' : '';?> value="<?=$_cat['idCategoria']?>"><?=$_cat['tituloEs']?></option>
										<?php		
											}
										?>
										    </select>
										    <div class="clearfix"></div>
                                            <?php		
												$temporal -> obtenerDatosProducto('ES');
											?>
										    <div class="input-group espacios">
										    	<input type="hidden" name="lang[]" value="ES">
					                        	<span class="input-group-addon">Título</span>
					                        	<input type="text" name="titulo[]" data-validate="true" class="form-control" placeholder="Ingresa el título del producto..." value="<?=$temporal -> _datosProducto -> _titulo?>">
					                        </div>	                        
					                        <div class="input-group espacios">
					                        	<span class="input-group-addon">Descripción</span>
					                        	<textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion[]" id="descripcion-es"><?=$temporal -> _datosProducto -> _descripcion?></textarea>
					                        </div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane espacios" id="producto-en">
								<?php
									unset($temporal -> _datosProducto);
									$temporal -> obtenerDatosProducto('EN');
								?>		
										<div class="col-lg-8 col-lg-offset-2 col-md-6 col-sm-12 col-xs-12">
											 <div class="input-group espacios">
										    	<input type="hidden" name="lang[]" value="EN">
					                        	<span class="input-group-addon">Título</span>
					                        	<input type="text" name="titulo[]" data-validate="true" class="form-control" placeholder="Ingresa el título del producto..." value="<?=$temporal -> _datosProducto -> _titulo?>">
					                        </div>                 
					                        <div class="input-group espacios">
					                        	<span class="input-group-addon">Descripción</span>
					                        	<textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion[]" id="descripcion-en"><?=$temporal -> _datosProducto -> _descripcion?></textarea>
					                        </div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane espacios" id="galeria">
										<div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
					                    	<center>
													GALERIA<br>
													<input type="file" multiple name="galeria[]" id="" class="filestyle" data-input="false" data-buttonText="Agregar Galeria" data-iconName="fa fa-picture-o" data-badge="true">
													<div data-toggle="modal" data-target="#myModal" class="btn btn-default inline-block"> <i class="fa fa-edit"></i> Editar Imagen </div>
													<p class="help-block">Solo se aceptan imágenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 470 x 500. Usar preferentemente productos sin fondo en PNG</p>
											</center>
											<div id="carousel-id" class="carousel slide" data-ride="carousel">
							                    <ol class="carousel-indicators">
							            <?php
							                $_totalGal = count($temporal -> _galeria);
							                $_g = 0;
							                for($i = 0; $i < count($temporal -> _galeria); $i++){
							                    ($i == 0) ? $_classGal = ' active' : $_classGal = '';
							            ?>		
							                        <li data-target="#carousel-id" data-slide-to="<?=$i?>" class="<?=$_classGal?>"></li>
							            <?php
							                }
							            ?>
							                    </ol>
							                    <div class="carousel-inner">
							            <?php
							                foreach ($temporal -> _galeria as $galeria) {
							                    ($_g == 0) ? $_classGalImg = ' active' : $_classGalImg = '';
							            ?>
							                        <div class="item <?=$_classGalImg?>">
							                            <center>
							                                <img data-src="../img/producto/galeria/<?=$galeria['ruta']?>" width="auto" height="200px" alt="First slide" src="../img/producto/galeria/<?=$galeria['ruta']?>">
							                            </center>
							                        </div>
							            <?php 
							                    $_g++;
							            	}
							            	?>		
							                   	</div>
							                </div>
							                <div class="espacios">&nbsp;</div>
					                    </div>
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
	<script src="js/functionsProducto.js"></script>
</html>	