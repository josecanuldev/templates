<?php
function __autoload($ClassName) {
    include('clases/'.$ClassName.".php");
}

$herramientas = new herramientas();
$seguridad    = new seguridad();
$seguridad -> candado();
$_MOD         = '';
$sort         = '';

$operacion    = 'modificarservicio';
$_MOD         = '1';
$clave        = 'p_mod_servicio';
$alert        = '';

if (isset($_REQUEST['id'])) {
	$id        = $_REQUEST['id'];
	$palabra   = 'Editar Servicio';
	$temporal  = new servicio($id);
	$temporal -> obtenerServicio();
} else {
	$id        = 0;
	$operacion = 'agregarservicio';
	$palabra   = 'Nuevo Servicio';
	$_MOD      = '0';
	$clave     = 'p_add_servicio';
	$img       = '';
	$temporal  = new servicio($id);
}
// print_r($temporal);
// exit;

if (isset($_REQUEST['success'])) {
	$success = $_REQUEST['success'];
	$alert   = $herramientas -> mensajesAlerta($success);
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Formulario | Servicio</title>
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
            			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                		<?=$alert?>
	                		<div class='notifications bottom-right'></div>
	                	</div>
            			<!--Seccion del titulo -->
            			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	                        <p class="titulo">Servicio</p>
	                    </div>
	                    <form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post" enctype="multipart/form-data">
                    		<input type="hidden" name="operaciones" value="<?=$operacion?>">
                    		<input type="hidden" name="id" value="<?=$id?>">
                    		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    			<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?>  class="buttonguardar">Guardar</button>
                   			</div>
		                    <div class="clearfix"></div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<div class='notifications top-right'></div>
		                    </div>
		                    <div class="clearfix"></div>
		                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		                    	<div role="tabpanel">
		                    		<!-- Nav tabs -->
		                    		<ul class="nav nav-tabs" role="tablist">
		                    			<li role="presentation" class="active">
		                    				<a href="#generales" aria-controls="generales" role="tab" data-toggle="tab">Generales</a>
		                    			</li>
		                    			<li role="presentation">
		                    				<a href="#datos" aria-controls="datos" role="tab" data-toggle="tab">Datos</a>
		                    			</li>
                                        <li role="presentation">
		                    				<a href="#datosEn" aria-controls="datosEn" role="tab" data-toggle="tab">Datos Inglés</a>
		                    			</li>
		                    			<?php if ($id > 0) { ?>
		                    			<li role="presentation">
		                    				<a href="#galeria" aria-controls="galeria" role="tab" data-toggle="tab">Galer&iacute;a</a>
		                    			</li>
		                    			<?php } ?>
		                    		</ul>
		                    	
		                    		<!-- Tab panes -->
		                    		<div class="tab-content">
		                    			<div role="tabpanel" class="tab-pane active" id="generales">
		                    				<br>
		                    				<div class="row">
		                    					<div class="col-lg-4 col-md-6 col-xs-12">
							                    	<div class="panel panel-default">
														<div class="panel-heading">
															<h3 class="panel-title">Portada</h3>
														</div>
														<div class="panel-body">
															<center class="espacios">
																Previsualizar imagen
																<div id="preview-portada" class="espacios">
																	<?php if ($temporal -> imgPortada != '') { ?>
																	<img src="../img/imgServicio/<?=$temporal -> imgPortada?>" alt="" class="img-responsive">
																	<?php } else { ?>
																	<div style="background-color: #ddd; display: block; min-height: 180px; width: 100%;"></div>
																	<?php } ?>
																</div>
																<input type="file" onchange="showMyImage('preview-portada', this)" name="portada" id="portada" class="filestyle" data-input="false" data-buttonText="Imagen Principal" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Principal">
																<p class="help-block"><small>Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 2 MB. <br> La resolución óptima para esta imagen es de 1600 X 634 </small></p>
															</center>
														</div>
													</div> <!-- /panel -->
							                    </div>

							                    <div class="col-lg-4 col-md-6 col-xs-12">
							                    	<div class="panel panel-default">
														<div class="panel-heading">
															<h3 class="panel-title">Imagen contenido</h3>
														</div>
														<div class="panel-body">
															<center class="espacios">
																Previsualizar imagen
																<div id="preview-imagen" class="espacios" >
																	<?php if ($temporal -> imgContenido != '') { ?>
																	<img src="../img/imgServicio/<?=$temporal -> imgContenido?>" alt="" class="img-responsive">
																	<?php } else { ?>
																	<div style="background-color: #ddd; display: block; min-height: 180px; width: 100%;"></div>
																	<?php } ?>
																</div>
																<input type="file" onchange="showMyImage('preview-imagen', this)" name="imagen" id="imagen" class="filestyle" data-input="false" data-buttonText="Imagen contenido" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen contenido">
																<p class="help-block"><small>Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 2 MB. <br> La resolución óptima para esta imagen es de 487 X 404 </small></p>
															</center>
														</div>
													</div> <!-- /panel -->
							                    </div>

							                    <div class="col-lg-4 col-md-6 col-xs-12" style="display:none !important">
							                    	<div class="panel panel-default">
							                    		<div class="panel-heading">
															<h3 class="panel-title">Mapa</h3>
														</div>
							                    		<div class="panel-body">
							                    			<div class="input-group espacios">
									                        	<span class="input-group-addon">Latitud</span>
									                        	<input type="text" name="latitud" data-validate="false" class="form-control" placeholder="Ingresa la latitud" value="<?=$temporal -> mapLatitud?>">
									                        </div>
									                        <div class="input-group espacios">
									                        	<span class="input-group-addon">Longitud</span>
									                        	<input type="text" name="longitud" data-validate="false" class="form-control" placeholder="Ingresa la longitud" value="<?=$temporal -> mapLongitud?>">
									                        </div>
							                    		</div>
							                    	</div>
							                    </div>
		                    				</div>
		                    			</div> <!-- /#generales -->

		                    			<div role="tabpanel" class="tab-pane" id="datos">
		                    				<br>
		                    				<div class="row">
		                    					<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-xs-12">
							                    	<div class="panel panel-default">
							                    		<div class="panel-heading">
						                    				<h3 class="panel-title">Contenido</h3>
						                    			</div>
							                    		<div class="panel-body">
							                    			<?php $temporal -> obtenerServicioDatos('es'); ?>
							                    			<div class="input-group espacios">
									                        	<span class="input-group-addon">T&iacute;tulo</span>
									                        	<input type="text" name="titulo[es]" data-validate="true" class="form-control" placeholder="Ingresa el t&iacute;tulo" value="<?=$temporal -> datos -> titulo?>">
									                        </div>
                                                            <div class="input-group espacios">
									                        	<span class="input-group-addon">Descripci&oacute;n</span>
									                        	<textarea name="descripcion[es]" id="descripcion" rows="20" class="form-control" placeholder="Ingresa la descripci&oacute;n" data-summer="true" data-validate="true"><?=$temporal -> datos -> descripcion?></textarea>
									                        </div>
									                        <div class="input-group espacios">
									                        	<span class="input-group-addon">Título 2</span>
									                        	<input type="text" name="ubicacion[es]" data-validate="true" class="form-control" placeholder="Ingresa el título" value="<?=$temporal -> datos -> ubicacion?>">
									                        </div>
									                        <div class="input-group espacios">
									                        	<span class="input-group-addon">Descripcion 2</span>
									                        	<textarea name="actividades[es]" id="actividades" rows="10" class="form-control" placeholder="Ingresa la descripción" data-summer-li="true" data-validate="true"><?=$temporal -> datos -> actividades?></textarea>
									                        </div>
							                    		</div>
							                    	</div>
							                    </div>
		                    				</div>
		                    			</div> <!-- /#datos -->
                                        
                                        <div role="tabpanel" class="tab-pane" id="datosEn">
		                    				<br>
		                    				<div class="row">
		                    					<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-xs-12">
							                    	<div class="panel panel-default">
							                    		<div class="panel-heading">
						                    				<h3 class="panel-title">Contenido Inglés</h3>
						                    			</div>
							                    		<div class="panel-body">
							                    			<?php $temporal -> obtenerServicioDatos('en'); ?>
							                    			<div class="input-group espacios">
									                        	<span class="input-group-addon">T&iacute;tulo</span>
									                        	<input type="text" name="titulo[en]" data-validate="true" class="form-control" placeholder="Ingresa el t&iacute;tulo" value="<?=$temporal -> datos -> titulo?>">
									                        </div>
                                                            <div class="input-group espacios">
									                        	<span class="input-group-addon">Descripci&oacute;n</span>
									                        	<textarea name="descripcion[en]" id="descripcionEn" rows="20" class="form-control" placeholder="Ingresa la descripci&oacute;n" data-summer="true" data-validate="true"><?=$temporal -> datos -> descripcion?></textarea>
									                        </div>
									                        <div class="input-group espacios">
									                        	<span class="input-group-addon">Título 2</span>
									                        	<input type="text" name="ubicacion[en]" data-validate="true" class="form-control" placeholder="Ingresa el título" value="<?=$temporal -> datos -> ubicacion?>">
									                        </div>
									                        <div class="input-group espacios">
									                        	<span class="input-group-addon">Descripcion 2</span>
									                        	<textarea name="actividades[en]" id="actividadesEn" rows="10" class="form-control" placeholder="Ingresa la descripción" data-summer-li="true" data-validate="true"><?=$temporal -> datos -> actividades?></textarea>
									                        </div>
							                    		</div>
							                    	</div>
							                    </div>
		                    				</div>
		                    			</div> <!-- /#datos -->

		                    			<?php if ($id > 0) { ?>
		                    			<div role="tabpanel" class="tab-pane" id="galeria">
		                    				<br>
		                    				<p class="help-block text-center"><small>Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 1140 X 600 </small></p>
		                    				<br>
		                    				<div class="row">
		                    					<div class="col-lg-4 col-md-4 col-xs-12">
							                    	<div class="panel panel-info">
							                    		<div class="panel-heading">
						                    				<h3 class="panel-title">Nuevo slide</h3>
						                    			</div>
							                    		<div class="panel-body">
							                    			<input type="hidden" name="slider[id][en][]" value="0">
							                    			<center class="espacios">
																Previsualizar imagen
																<div id="preview-slide" class="espacios">
																	<div style="background-color: #ddd; display: block; min-height: 110px; width: 100%;"></div>
																</div>
																<input type="file" onchange="showMyImage('preview-slide', this)" name="slider" id="slide" class="filestyle" data-input="false" data-buttonText="Imagen" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen">
															</center>
							                    			<div class="input-group espacios">
									                        	<span class="input-group-addon">T&iacute;tulo</span>
									                        	<input type="text" name="slider[titulo][en][]" data-validate="false" class="form-control" placeholder="Ingresa el t&iacute;tulo" value="">
									                        </div>
									                        <div class="input-group espacios">
									                        	<span class="input-group-addon">Título Inglés</span>
									                        	<input type="text" name="slider[subtitulo][en][]" data-validate="false" class="form-control" placeholder="Ingresa el título en inglés" value="">
									                        </div>
									                        <div class="input-group espacios" style="display:none">
									                        	<span class="input-group-addon">Descripci&oacute;n</span>
									                        	<textarea name="slider[texto][en][]" id="" rows="2" class="form-control" placeholder="Ingresa una breve descripci&oacute;n"></textarea>
									                        	<!-- <input type="text" name="slider[texto][en][]" data-validate="false" class="form-control" placeholder="Ingresa una breve descripci&oacute;n " value=""> -->
									                        </div>
							                    		</div>
							                    	</div>
							                    </div>

							                    <?php 
							                    $galeria = $temporal -> listaGaleria();
							                    // print_r($galeria);exit;
							                    if (count($galeria) > 0) { 
							                    	foreach ($galeria as $sk => $slide) {
							                    ?>
							                    <div class="col-lg-4 col-md-4 col-xs-12" id="galeria-<?=$slide['idGaleria']?>">
							                    	<div class="panel panel-default">
							                    		<div class="panel-heading">
							                    			<button type="button" class="btn btn-default btn-xs pull-right" data-id="<?=$slide['idGaleria']?>">
							                    				<i class="fa fa-trash"></i>
							                    			</button>
						                    				<h3 class="panel-title">Slide</h3>
						                    			</div>
							                    		<div class="panel-body">
							                    			<input type="hidden" name="galeria[id][en][]" value="<?=$slide['idGaleria']?>">
							                    			<center class="espacios">
																Previsualizar imagen
																<div id="preview-slide-<?=$slide['idGaleria']?>" class="espacios">
																	<img src="../img/imgServicio/galeria/<?=$slide['ruta']?>" alt="" class="img-responsive">
																</div>
																<input type="file" onchange="showMyImage('preview-slide-<?=$slide['idGaleria']?>', this)" name="galeria[en][]" id="slide-<?=$slide['idGaleria']?>" class="filestyle" data-input="false" data-buttonText="Imagen" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen">
															</center>
							                    			<div class="input-group espacios">
									                        	<span class="input-group-addon">T&iacute;tulo</span>
									                        	<input type="text" name="galeria[titulo][en][]" data-validate="false" class="form-control" placeholder="Ingresa el t&iacute;tulo" value="<?=$slide['titulo']?>">
									                        </div>
									                        <div class="input-group espacios" >
									                        	<span class="input-group-addon">Título Inglés</span>
									                        	<input type="text" name="galeria[subtitulo][en][]" data-validate="false" class="form-control" placeholder="Ingresa el título en inglés" value="<?=$slide['subtitulo']?>">
									                        </div>
									                        <div class="input-group espacios" style="display:none">
									                        	<span class="input-group-addon">Descripci&oacute;n</span>
									                        	<textarea name="galeria[texto][en][]" id="" rows="2" class="form-control" placeholder="Ingresa una breve descripci&oacute;n"><?=$slide['texto']?></textarea>
									                        	<!-- <input type="text" name="galeria[texto][en][]" data-validate="false" class="form-control" placeholder="Ingresa una breve descripci&oacute;n " value="<?=$slide['texto']?>"> -->
									                        </div>
							                    		</div>
							                    	</div>
							                    </div>
							                    <?php if ((($sk + 1) % 3) == 0) { ?> 
							                    <div class="clearfix visible-sm"></div>
							                    <?php } ?>
							                    <?php } } ?>
		                    				</div> <!-- /.row -->
		                    			</div> <!-- /#galeria -->
		                    			<?php } ?>
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
		                    	<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?=$operacion?>" class="buttonguardar">Guardar</button>
		                    </div>
                    	</form>
	            		
            		</div>

            	</div>
	        </div>
    	</div>
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
		<script src="js/functionsServicio.js"></script>
	</footer>
</html>	