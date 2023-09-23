<?php
function __autoload($ClassName) {
    include('clases/'.$ClassName.".php");
}

$herramientas = new herramientas();
$seguridad    = new seguridad();
$seguridad -> candado();
// $_MOD         = '';
$sort         = 'galeria';
$handle       = 'handle sortimg';
$operacion    = 'modificarexperiencia';
$_MOD         = '1';
$clave        = 'p_mod_yachting';
$clave2       = 'p_sort_gallery_yatching';
$alert        = '';

if (isset($_REQUEST['id'])) {
	$id        = $_REQUEST['id'];
	$palabra   = 'Editar Tour dentro de Holbox';
	$temporal  = new experiencia($id);
	$temporal -> obtenerExperiencia();
} else {
	$id        = 0;
	$operacion = 'agregarexperiencia';
	$palabra   = 'Nuevo Tour dentro de Holbox';
	$_MOD      = '0';
	$clave     = 'p_add_yachting';
	$img       = '';
	$temporal  = new experiencia($id);
}
// $temporal -> obtenerExperienciaDatos('en');
// $temporal -> obtenerRango('en', 'Yachting');
// print_r($temporal);
// $precios = $temporal -> listaPrecios($temporal -> rango -> idRango, 'en');
// print_r($precios);
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
		<title>Formulario | Tours <?=$texto?></title>
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
	                        <p class="titulo"><?=$palabra?> <?=$texto?></p>
	                    </div>
	                    <form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post" enctype="multipart/form-data">
                    		<input type="hidden" name="operaciones" value="<?=$operacion?>">
                    		<input type="hidden" name="seccion" value="ToursDentroHolbox">
                    		<input type="hidden" name="id" value="<?=$id?>">
                    		<input type="hidden" name="titulo" value="">
                    		<input type="hidden" name="duracion" value="">
                    		<input type="hidden" name="capacidad1" value="0">
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
		                    			<?php if ($id > 0) { ?>
		                    			<li role="presentation">
		                    				<a href="#galeria" aria-controls="galeria" role="tab" data-toggle="tab">Galer&iacute;a</a>
		                    			</li>
		                    			<li role="presentation">
		                    				<a href="#caracteristicas" aria-controls="caracteristicas" role="tab" data-toggle="tab">Características</a>
		                    			</li>
		                    			<!--<li role="presentation">
		                    				<a href="#tarifas" aria-controls="tarifas" role="tab" data-toggle="tab">Itinerario</a>
		                    			</li>-->
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
																	<?php if ($temporal -> imgPortada !== '') { ?>
																	<img src="../img/imgToursDentroHolbox/<?=$temporal -> imgPortada?>" alt="" class="img-responsive">
																	<?php } else { ?>
																	<div style="background-color: #ddd; display: block; min-height: 180px; width: 100%;"></div>
																	<?php } ?>
																</div>
																<input type="file" onChange="showMyImage('preview-portada', this)" name="portada" id="portada" class="filestyle" data-input="false" data-buttonText="Imagen Principal" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Principal">
																<p class="help-block"><small>Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 2 MB. <br> La resolución óptima para esta imagen es de 1000px x 1000px </small></p>
															</center>
														</div>
													</div> <!-- /panel -->
							                    </div>

							                    <div class="col-lg-8 col-md-6 col-xs-12">
							                    	<div class="panel panel-default">
							                    		<div class="panel-heading">
						                    				<h3 class="panel-title">Contenido</h3>
						                    			</div>
							                    		<div class="panel-body">
							                    			<?php $temporal -> obtenerExperienciaDatos('en'); ?>
							                    			<div class="row">
							                    				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							                    					<div class="input-group espacios">
											                        	<span class="input-group-addon">Nombre</span>
											                        	<input type="text" name="nombre" data-validate="true" class="form-control" placeholder="Ingresa el nombre" value="<?=$temporal -> datos -> nombre?>">
											                        </div>
							                    				</div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							                    					<div class="input-group espacios">
											                        	<span class="input-group-addon">Nombre Inglés</span>
											                        	<input type="text" name="nombreEn" data-validate="false" class="form-control" placeholder="Ingresa el nombre en inglés" value="<?=$temporal -> datos -> nombreEn?>">
											                        </div>
							                    				</div>
							                    				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display:none">
							                    					<div class="input-group espacios">
											                        	<span class="input-group-addon">Ubicación</span>
											                        	<input type="text" name="subnombre" data-validate="false" class="form-control" placeholder="Ingresa la ubicación" value="<?=$temporal -> datos -> subnombre?>">
											                        </div>
							                    				</div>
							                    				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="display:none">
							                    					<div class="form-group espacios">
							                    						<?php
							                    						$ubicacion = new ubicacion();
							                    						$ubicaciones = $ubicacion -> listaUbicacion(1, false, 1, 'en');
							                    						?>
							                    						<select name="idUbicacion" id="ubicacion" class="selectpicker" data-title="Ubicación" data-width="100%" data-validate="false">
							                    							<?php foreach ($ubicaciones as $i => $u) { ?>
							                    							<option <?=($temporal -> idUbicacion == $u['idUbicacion']) ? 'selected' : ''?> value="<?=$u['idUbicacion']?>"><?=$u['nombre']?></option>
							                    							<?php } ?>
							                    						</select>
							                    					</div>
							                    				</div>
							                    				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											                        <div class="input-group espacios">
											                        	<span class="input-group-addon">Subtítulo</span>
											                        	<input type="text" name="concepto_inicial" data-validate="false" class="form-control" placeholder="Ingresa el subtítulo" value="<?=$temporal -> datos -> concepto?>">
											                        </div>
                                              <div class="input-group espacios">
											                        	<span class="input-group-addon">Subtítulo en inglés</span>
											                        	<input type="text" name="capacidad1" data-validate="false" class="form-control" placeholder="Ingresa el subtítulo en inglés" value="<?=$temporal -> datos -> capacidad1?>">
											                        </div>
											                    </div>
											                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="display:none">

											                    </div>
											                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											                        <div class="input-group espacios">
											                        	<span class="input-group-addon">Descripci&oacute;n</span>
											                        	<textarea name="descripcion" id="descripcion" rows="8" class="form-control" placeholder="Ingresa la descripción" data-summer="true" data-validate="true"><?=$temporal -> datos -> descripcion?></textarea>
											                        </div>
                                                                     <div class="input-group espacios">
											                        	<span class="input-group-addon">Descripci&oacute;n en inglés</span>
											                        	<textarea name="descripcionEn" id="descripcionEn" rows="8" class="form-control" placeholder="Ingresa la descripción en inglés" data-summer="true" data-validate="false"><?=$temporal -> datos -> descripcionEn?></textarea>
											                        </div>
                                              <div class="input-group espacios">
											                        	<span class="input-group-addon">Texto corto slider</span>
											                        	<input type="text" name="inicial" data-validate="false" class="form-control" placeholder="Ingresa el texto para el slider" value="<?=$temporal -> datos -> inicial?>">
											                        </div>
                                              <div class="input-group espacios">
											                        	<span class="input-group-addon">Texto corto slider en inglés</span>
											                        	<input type="text" name="capacidad2" data-validate="false" class="form-control" placeholder="Ingresa el texto para el slider en inglés" value="<?=$temporal -> datos -> capacidad2?>">
											                        </div>
											                    </div>
											                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											                        <div class="input-group espacios">
											                        	<span class="input-group-addon">Notas</span>
											                        	<textarea name="politicas" id="politicas" rows="8" class="form-control" placeholder="Ingresa la nota al pie" data-summer="true" data-validate="false"><?=$temporal -> datos -> politicas?></textarea>
											                        </div>
                                                                    <div class="input-group espacios">
											                        	<span class="input-group-addon">Notas en inglés</span>
											                        	<textarea name="politicasEn" id="politicasEn" rows="8" class="form-control" placeholder="Ingresa la nota al pie en inglés" data-summer="true" data-validate="false"><?=$temporal -> datos -> politicasEn?></textarea>
											                        </div>
											                    </div>
							                    			</div>
							                    		</div>
							                    	</div> <!-- /.panel -->
							                    </div>
		                    				</div>
		                    			</div> <!-- /#general -->
		                    			<?php if ($id > 0) { ?>
		                    			<div role="tabpanel" class="tab-pane" id="galeria">
		                    				<div class="row">
		                    					<div class="col-lg-12 col-md-4 col-xs-12">
		                    						<br>
		                    						<div id="preview-slide" class="row">
														<!-- imagenes -->
													</div>
												</div>
												<div class="clearfix"></div>
												<div class="col-lg-12 col-md-4 col-xs-12">
													<center class="espacios">
														<input type="file" onChange="showMyImage('preview-slide', this, true)" name="slider[]" id="slide" class="filestyle" multiple data-input="false" data-buttonText="Galeria" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Galeria">
		                    							<p class="help-block text-center"><small>Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 1000px X 1000px </small></p>
		                    							<br>
													</center>
												</div>
		                    				</div>
		                    				<div class="row" id="sortableImg">
							                    <?php
							                    $galeria = $temporal -> listaGaleria('en', 'ToursDentroHolbox');
							                    // print_r($galeria);exit;
							                    if (count($galeria) > 0) {
							                    	foreach ($galeria as $sk => $slide) {
							                    ?>
							                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" id="galeria-<?=$slide['idGaleria']?>">
							                    	<div class="panel panel-default">
							                    		<div class="panel-heading">
							                    			<div class="btn-group pull-right">
							                    				<a href="javascript:;" class="btn btn-default btn-xs <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2) != 0){ echo $handle; }?>" data-id="<?=$galeria['idGaleria']?>">
											    					<i class="fa fa-arrows"></i>
											    				</a>
							                    				<button type="button" class="btn btn-default btn-xs btn-del-slide" data-id="<?=$slide['idGaleria']?>">
								                    				<i class="fa fa-trash"></i>
								                    			</button>
							                    			</div>
							                    			<!-- <button type="button" class="btn btn-default btn-xs pull-right btn-del-slide" data-id="<?=$slide['idGaleria']?>">
							                    				<i class="fa fa-trash"></i>
							                    			</button> -->
						                    				<h3 class="panel-title">Slide</h3>
						                    			</div>
							                    		<div class="panel-body">
							                    			<input name="idorden[]" type="hidden" value="<?=$slide['idGaleria']?>" class="idorden">
							                    			<input type="hidden" name="galeria[id][]" value="<?=$slide['idGaleria']?>">
							                    			<center class="espacios">
																<div id="preview-slide-<?=$slide['idGaleria']?>" class="espacios">
																	<img src="../img/imgToursDentroHolbox/galeria/<?=$slide['ruta']?>" alt="" class="img-responsive">
																</div>
																<input type="file" onChange="showMyImage('preview-slide-<?=$slide['idGaleria']?>', this)" name="galeria[]" id="slide-<?=$slide['idGaleria']?>" class="filestyle" data-input="false" data-buttonText="Imagen" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen">
															</center>

							                    		</div>
							                    	</div>
							                    </div>
							                    <?php } } ?>
		                    				</div> <!-- /.row -->
		                    			</div> <!-- /#galeria -->

		                    			<div role="tabpanel" class="tab-pane" id="caracteristicas">
		                    				<br>
		                    				<div class="row" id="preview-resenias">
		                    					<?php
		                    					$resenias = $temporal -> listaResenia('en', 'ToursDentroHolbox');
		                    					if (count($resenias) > 0) {
							                    	foreach ($resenias as $rk => $resenia) {
		                    					?>
		                    					<div class="col-md-6" id="resenia-<?=$resenia['idResenia']?>">
		                    						<div class="panel panel-default" data-id="<?=$resenia['idResenia']?>">
		                    							<div class="panel-heading">
		                    								<button type="button" class="btn btn-default btn-xs pull-right btn-del-resenia" data-id="<?=$resenia['idResenia']?>"><i class="fa fa-trash"></i></button>
		                    								<h3 class="panel-title">Característica</h3>
		                    							</div>
		                    							<div class="panel-body">
		                    								<div class="row">
		                    									<div class="col-md-12">
		                    										<input type="hidden" name="resenia[id][]" id="" value="<?=$resenia['idResenia']?>">
		                    										<div class="input-group espacios">
											                        	<span class="input-group-addon">Título</span>
											                        	<input type="text" name="resenia[nombre][]" data-validate="false" class="form-control" placeholder="Ingresa el título" value="<?=$resenia['nombre']?>">
											                        </div>
		                    									</div>
		                    									<div class="col-md-12">
		                    										<div class="input-group espacios">
											                        	<span class="input-group-addon">Título en inglés</span>
											                        	<input type="text" class="form-control" placeholder="Ingresa el título en inglés" name="resenia[fecha][]" value="<?=$resenia['fecha']?>">
											                        </div>
		                    									</div>
		                    									<div class="col-md-12">
		                    										<div class="input-group espacios">
											                        	<span class="input-group-addon">Descripci&oacute;n</span>
											                        	<textarea name="resenia[texto][]" id="" rows="3" class="form-control" placeholder="Ingresa la descripci&oacute;n"><?=$resenia['texto']?></textarea>
											                        </div>
		                    									</div>
                                                                <div class="col-md-12">
		                    										<div class="input-group espacios">
											                        	<span class="input-group-addon">Descripci&oacute;n inglés</span>
											                        	<textarea name="resenia[textoEn][]" id="" rows="3" class="form-control" placeholder="Ingresa la descripci&oacute;n en inglés"><?=$resenia['textoEn']?></textarea>
											                        </div>
		                    									</div>
		                    								</div>
		                    							</div>
		                    						</div>
		                    					</div>
		                    					<?php } } ?>
		                    				</div>
		                    				<div class="row">
		                    					<div class="col-md-12">
		                    						<br>
		                    						<center>
		                    							<button id="btn-resenia" type="button" class="btn btn-default">Agregar</button>
		                    						</center>
		                    						<br>
		                    					</div>
		                    				</div>
		                    			</div> <!-- /#resenia -->

		                    			<div role="tabpanel" class="tab-pane" id="info">
		                    				<br>
		                    				<?php $temporal -> obtenerTarifa('en', 'ToursDentroHolbox'); ?>
		                    				<div class="row">
		                    					<div class="col-md-6 col-sm-12">
			                    					<div class="panel panel-default">
							                    		<div class="panel-heading">
						                    				<h3 class="panel-title">Incluye</h3>
						                    				<input type="hidden" name="tarifa[id]" value="<?=$temporal -> tarifa -> idTarifa?>">
						                    			</div>
							                    		<div class="panel-body">
							                    			<div class="form-group">
									                        	<!-- <span class="input-group-addon">Incluye</span> -->
									                        	<textarea name="tarifa[incluye]" id="incluye" rows="20" class="form-control" placeholder="¿Qu&eacute; incluye?" data-politix="true" data-validate="true"><?=$temporal -> tarifa -> incluye?></textarea>
									                        </div>
							                    		</div>
							                    	</div> <!-- /.panel -->
							                    </div>

							                    <div class="col-md-6 col-sm-12">
							                    	<div class="panel panel-default">
							                    		<div class="panel-heading">
							                    			<h3 class="panel-title">No incluye</h3>
							                    		</div>
							                    		<div class="panel-body">
							                    			<div class="form-group">
									                        	<!-- <span class="input-group-addon">No incluye</span> -->
									                        	<textarea name="tarifa[noincluye]" id="noincluye" rows="20" class="form-control" placeholder="¿Qu&eacute; no incluye?" data-politix="true" data-validate="false"><?=$temporal -> tarifa -> noIncluye?></textarea>
									                        </div>
							                    		</div>
							                    	</div>
							                    </div>
		                    				</div>
		                    			</div> <!-- /#info -->

		                    			<div role="tabpanel" class="tab-pane" id="tarifas">
		                    				<br>
		                    				<div class="row" id="preview-range">
		                    					<?php
		                    					if ($temporal -> tarifa -> idTarifa) {
			                    					$precios = $temporal -> listaPrecios($temporal -> tarifa -> idTarifa, 'en');
			                    					if (count($precios) > 0) {
			                    						foreach ($precios as $i => $precio) {
		                    					?>
		                    					<div class="col-md-6 col-sm-12" id="tarifa-<?=$precio['idTarifaDatos']?>">
				                    				<div class="panel panel-default">
				                    					<div class="panel-heading">
				                    						<button type="button" class="btn btn-default btn-xs pull-right btn-del-tarifa" data-id="<?=$precio['idTarifaDatos']?>"><i class="fa fa-trash"></i></button>
				                    						<h3 class="panel-title">Actividad</h3>
				                    					</div>
				                    					<div class="panel-body">
				                    						<div class="row">
						                    					<div class="col-md-12 col-sm-12">
						                    						<div class="form-group">
							                    						<div class="input-group">
							                    							<span class="input-group-addon">Hora</span>
							                    							<input type="text" name="precios[periodo1][]" data-validate="false" class="form-control" placeholder="Hora" value="<?=$precio['precio1']?>">
												                        </div>
												                    </div>
						                    					</div>
                                                                <div class="col-md-12 col-sm-12">
						                    						<div class="form-group">
							                    						<div class="input-group">
							                    							<span class="input-group-addon">Hora inglés</span>
							                    							<input type="text" name="precios[horaEn][]" data-validate="false" class="form-control" placeholder="Hora inglés" value="<?=$precio['horaEn']?>">
												                        </div>
												                    </div>
						                    					</div>
																<div class="col-md-12 col-sm-12">
						                    						<input type="hidden" name="precios[id][]" id="" value="<?=$precio['idTarifaDatos']?>">
						                    						<div class="form-group">
					            										<div class="input-group">
												                        	<span class="input-group-addon">Actividad</span>
												                        	<textarea data-summer="true" name="precios[concepto][]" data-validate="false" class="form-control" placeholder="Actividad" id="precios-concepto-<?=$precio['idTarifaDatos']?>"><?=$precio['concepto']?></textarea>
												                        </div>
												                    </div>
						                    					</div>
                                                                <div class="col-md-12 col-sm-12">
						                    						<div class="form-group">
					            										<div class="input-group">
												                        	<span class="input-group-addon">Actividad inglés</span>
												                        	<textarea data-summer="true" name="precios[conceptoEn][]" data-validate="false" class="form-control" placeholder="Actividad inglés" id="precios-concepto-ingles-<?=$precio['idTarifaDatos']?>"><?=$precio['conceptoEn']?></textarea>
												                        </div>
												                    </div>
						                    					</div>
						                    					<!-- <div class="col-md-6 col-sm-12">
						                    						<div class="form-group">
							                    						<div class="input-group">
							                    							<span class="input-group-addon">Periodo 2</span>
							                    							<input type="text" name="precios[periodo2][]" data-validate="false" class="form-control" placeholder="Precio" value="<?=$precio['precio2']?>">
												                        	<span class="input-group-addon">USD</span>
												                        </div>
												                    </div>
						                    					</div> -->
					                    					</div>
				                    					</div>
				                    				</div>
				                    			</div> <!-- /tarifa -->
				                    			<?php } } } ?>
		                    				</div>
		                    				<div class="row">
		                    					<div class="col-md-12">
		                    						<br>
		                    						<center>
			                    						<div class="input-group espacios">
			                    							<button type="button" class="btn btn-default" id="btn-range">Agregar</button>
			                    						</div>
	                    							</center>
	                    						</div>
	                    					</div>
		                    			</div> <!-- /#tarifas -->
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
		<script src="js/functionsExperiencia.js"></script>
	</footer>
</html>
