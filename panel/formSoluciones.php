<?php
function __autoload($ClassName){
    include('clases/'.$ClassName.".php");
}
$seguridad = new seguridad();
$seguridad->candado();
$_MOD = '';
$sort = '';
$tipo = 2;

if(isset($_REQUEST['idBlog'])){
	$id = $_REQUEST['idBlog'];
	$operacion = 'modificarblog';
	$palabra = 'Editar Blog';
	$_MOD = '1';
	$temporal = new blog($id);
	$temporal -> getBlog();
}
else{
	$id = 0;
	$operacion = 'agregarblog';
	$palabra = 'Nuevo Blog';
	$_MOD = '0';
	$img = '';
	$temporal = new blog($id);
}
$clave = 'p_mod_solucion';
$clave2 ='p_sort_galeria_solucion';
$sort = 'contenidoBlog';
$handle = 'handle sortimg';

$productos = new producto();
$listaProductos = $productos -> listProducto(1,false,1,"","","","","datosProducto.titulo ASC");
$categoria = new categoria();
$categorias = $categoria  -> listCategoria(1, false, 1, "", "", $tipo);
$productoxsolucion = new productoxsolucion();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Formulario | Blog</title>
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
                    		<input type="hidden" name="idBlog" value="<?=$id?>">
                    		<input type="hidden" id="permisoAcDc" value="<?=$tipo?>">
                    		<input type="hidden" name="operaciones" value="<?=$operacion?>">
                    		<input type="hidden" id="idSubcategoriaSelected" value="<?=$temporal -> _idSubcategoria?>">
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
									<li role="presentation" class="active">
										<a href="#blog-es" aria-controls="blog-es" role="tab" data-toggle="tab">GENERAL</a>
									</li>
                <?php if ($id > 0) { ?>
								<li role="presentation">
										<a href="#galeria" aria-controls="galeria" role="tab" data-toggle="tab">CONTENIDO</a>
									</li>
                </li>
                <li role="presentation">
                  <a href="listaTestimonio2.php?idDestino=<?=$id?>">SLIDER</a>
                </li>
                <?php } ?>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane espacios active" id="blog-es">
										<div class="col-lg-8 col-lg-offset-2 col-md-6 col-sm-12 col-xs-12">
											<center>
												PREVISUALIZAR IMAGEN PORTADA
												<div id="preview-img-blog" class="espacios">
													<?=($temporal -> _portada != '') ?  '<img width="auto" height="250px" src="../img/imgBlog/'.$temporal -> _portada.'">' : '';?>
												</div>
												<input type="file" data-validate="true" data-type-file="imagen" data-text="portada" onchange="showMyImageWH('preview-img-blog', this, '', 1, 1600, 1400)" name="archivo" class="filestyle" data-input="false" data-buttonText="Imagen Portada" data-iconName="fa fa-picture-o" data-badge="false">
												<p class="help-block">Solo se aceptan imágenes con formato .JPG, .JPEG. <br> La imagen debe ser menor a 3 MB. La resolucíon óptima es de 1600 x 1400px</p>
											</center>

										<?php
											$temporal -> obtenerDatosBlog('ES');
										?>

                                        	<p class="help-block">Selecciona la categoría</p>
                                            <select name="idCategoria" id="idCategoria" data-validate="true" data-text="Categoria" class="selectpicker" title="Elegir Categoría">
                                                <?php
                                                    foreach($categorias as $_cat){
                                                ?>
                                                        <option <?=($_cat['idCategoria'] == $temporal -> _idCategoria) ? 'selected' : '';?> value="<?=$_cat['idCategoria']?>"><?=$_cat['tituloEs']?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <br><br>

                                            	<p class="help-block">Seleccione el idioma destino</p>
                                                <select name="idioma" id="idioma" class="selectpicker" title="Elegir Idioma">
                                                    <?php
                                                    $i1 = '';
                                                    $i2 = '';

                                                       if($temporal->idioma == 0)
                                                         $i1 = ' selected';
                                                       if ($temporal->idioma == 1)
                                                         $i2 = ' selected';
                                                    ?>
                                                    <option value="0" <?=$i1?>>Español</option>
                                                    <option value="1" <?=$i2?>>Inglés</option>
                                                </select>


          										    <div class="input-group espacios">
          										    	<input type="hidden" name="lang[]" value="ES">
					                        	<span class="input-group-addon">Título</span>
					                        	<input type="text" name="titulo[]" data-validate="true" class="form-control" placeholder="Ingresa el título..." value="<?=$temporal -> _datosBlog -> _titulo?>">
					                        </div>

                                  <div class="input-group espacios">
					                        	<span class="input-group-addon">Subtítulo</span>
					                        	<input type="text" name="subtitulo" data-validate="true" class="form-control" placeholder="Ingresa el subtítulo..." value="<?=$temporal -> subtitulo?>">
					                        </div>

                                            <div class="input-group espacios">
					                        	<span class="input-group-addon">Descripción Corta</span>
					                        	<textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcionCorta" id="descripcionCorta"><?=$temporal -> descripcionCorta?></textarea>
					                        </div>

					                        <div class="input-group espacios">
					                        	<span class="input-group-addon">Palabra clave</span>
                                    <input type="text" name="descripcion[]" data-validate="false" class="form-control" placeholder="Ingresa la palabra clave..." value="<?=$temporal -> _datosBlog -> _descripcion?>">
					                        </div>
					                        <div class="input-group espacios" style="display:none">
					                        	<span class="input-group-addon">Tags</span>
					                        	<input type="text" class="apply-tags" name="tags[]" value="<?=$temporal -> _datosBlog -> _tags?>">
					                        </div>
										</div>
									</div>
									<!--<div role="tabpanel" class="tab-pane espacios" id="blog-en">
								<?php
									unset($temporal -> _datosBlog);
									$temporal -> obtenerDatosBlog('EN');
								?>
										<div class="col-lg-8 col-lg-offset-2 col-md-6 col-sm-12 col-xs-12">
											 <div class="input-group espacios">
										    	<input type="hidden" name="lang[]" value="EN">
					                        	<span class="input-group-addon">Titulo</span>
					                        	<input type="text" name="titulo[]" data-validate="true" class="form-control" placeholder="Ingresa el titulo del blog..." value="<?=$temporal -> _datosBlog -> _titulo?>">
					                        </div>
					                        <div class="input-group espacios">
					                        	<span class="input-group-addon">Subtitulo</span>
					                        	<input type="text" name="subtitulo[]" data-validate="true" class="form-control" placeholder="Ingresa el subtitulo del blog..." value="<?=$temporal -> _datosBlog -> _subtitulo?>">
					                        </div>
					                        <div class="input-group espacios">
					                        	<span class="input-group-addon">Descripción</span>
					                        	<textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion[]" id="descripcion-en"><?=$temporal -> _datosBlog -> _descripcion?></textarea>
					                        </div>
					                        <div class="input-group espacios">
					                        	<span class="input-group-addon">Tags</span>
					                        	<input type="text" class="apply-tags" name="tags[]" value="<?=$temporal -> _datosBlog -> _tags?>">
					                        </div>
										</div>
									</div>-->
									<div role="tabpanel" class="tab-pane espacios" id="galeria">
										<div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
											<div class="content-buttons-add">
												<div class="content-button" style="text-align: center;">
													<div class="btn btn-panel" id="add-texto">Agregar Texto</div>
													<div class="btn btn-panel" id="add-imagen">Agregar Imagen</div>
													<div class="btn btn-panel" id="add-video">Agregar Video</div>
													<div class="btn btn-panel" id="add-galeria">Agregar Galería</div>
												</div>
											</div>
										</div>	<br><br><br>
										<div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 mar-top-100x">
					                    	<div class="row" id="content-element-blog">
					                <?php
					                	if(isset($temporal -> _contenidoBlog)){
					                		foreach ($temporal -> _contenidoBlog as $_content) {
												if($_content['tipo'] == 1){
									?>
												<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-mod-<?=$_content['idContenidoBlog']?>">
					                    			<div class="close" onclick="deleteElement(<?=$_content['idContenidoBlog']?>,'contenido-blog-mod-', 'deleteContenidoBlog', 'true')"> <i class="fa fa-times"></i> </div>
					                    			<i class="fa fa-arrows order-right <?=$handle?>"></i>
					                    			<input type="hidden" class="idorden" name="temporal-id-mod[]" value="<?=$_content['idContenidoBlog']?>">
					                    			<input type="hidden" name="tipo-contenido-mod[]" value="1">
					                    			<div class="input-group espacios">
							                        	<span class="input-group-addon">Descripción</span>
							                        	<textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion-contenido-mod-<?=$_content['idContenidoBlog']?>" id="desc-cont-mod-<?=$_content['idContenidoBlog']?>"><?=$_content['descripcion']?></textarea>
							                        </div>
							                        <hr class="divisor-seccion">
					                    		</div>
									<?php
												}else if($_content['tipo'] == 2){
									?>
												<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-mod-<?=$_content['idContenidoBlog']?>">
					                    			<div class="close" onclick="deleteElement(<?=$_content['idContenidoBlog']?>,'contenido-blog-mod-', 'deleteContenidoBlog', 'true')"> <i class="fa fa-times"></i> </div>
					                    			<i class="fa fa-arrows order-right <?=$handle?>"></i>
					                    			<input type="hidden" class="idorden" name="temporal-id-mod[]" value="<?=$_content['idContenidoBlog']?>">
					                    			<input type="hidden" name="tipo-contenido-mod[]" value="2">
					                    			<center>
					                    				<div id="preview-img-contenido-mod-<?=$_content['idContenidoBlog']?>" class="espacios">
					                    					<img width="100%" class="img-responsive" height="250px" src="../img/imgBlog/contenido/<?=$_content['imagen']?>" />
					                    				</div>
														<input type="file" onchange="showMyImageWH('preview-img-contenido-mod-<?=$_content['idContenidoBlog']?>', this, '', 1, 800, 600)" name="img-contenido-mod-<?=$_content['idContenidoBlog']?>" class="filestyle" data-input="false" data-buttonText="Imagen" data-iconName="fa fa-picture-o" data-badge="true">
														<p class="help-block">Solo se aceptan imágenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
													</center>
													<hr class="divisor-seccion">
					                    		</div>
									<?php
												}else if($_content['tipo'] == 3){
									?>
												<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-mod-<?=$_content['idContenidoBlog']?>">
					                    			<div class="close" onclick="deleteElement(<?=$_content['idContenidoBlog']?>,'contenido-blog-mod-', 'deleteContenidoBlog', 'true')"> <i class="fa fa-times"></i> </div>
					                    			<i class="fa fa-arrows order-right <?=$handle?>"></i>
					                    			<input type="hidden" class="idorden" name="temporal-id-mod[]" value="<?=$_content['idContenidoBlog']?>">
					                    			<input type="hidden" name="tipo-contenido-mod[]" value="3">
					                    			<center>
					                    				<div id="preview-video-contenido-mod-<?=$_content['idContenidoBlog']?>" class="espacios">
					                    					<img width="100%" class="img-responsive" height="250px" src="../img/imgBlog/contenido/<?=$_content['imagen']?>" />
					                    				</div>
														<input type="file" onchange="showMyImageWH('preview-video-contenido-mod-<?=$_content['idContenidoBlog']?>', this, '', 1, 800, 600)" name="video-contenido-mod-<?=$_content['idContenidoBlog']?>" class="filestyle" data-input="false" data-buttonText="Imagen Video" data-iconName="fa fa-picture-o" data-badge="true">
														<div class="input-group espacios">
								                        	<span class="input-group-addon">Url</span>
								                        	<input type="text" name="url-contenido-mod-<?=$_content['idContenidoBlog']?>" data-validate="true" class="form-control" placeholder="Ingresa la url del video.." value="<?=$_content['url']?>">
								                        </div>
														<p class="help-block">Solo se aceptan imágenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
													</center>
													<hr class="divisor-seccion">
					                    		</div>
									<?php
												}else if($_content['tipo'] == 4){
									?>
												<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-mod-<?=$_content['idContenidoBlog']?>">
					                    			<div class="close" onclick="deleteElement(<?=$_content['idContenidoBlog']?>,'contenido-blog-mod-', 'deleteContenidoBlog', 'true')"> <i class="fa fa-times"></i> </div>
					                    			<i class="fa fa-arrows order-right <?=$handle?>"></i>
					                    			<input type="hidden" class="idorden" name="temporal-id-mod[]" value="<?=$_content['idContenidoBlog']?>">
					                    			<input type="hidden" name="tipo-contenido-mod[]" value="4">
					                    			<center>
														<input type="file" multiple onchange="showMyImageWH('preview-galeria-contenido-mod-<?=$_content['idContenidoBlog']?>', this, '', 2, 800, 600)" name="galeria-contenido-mod-<?=$_content['idContenidoBlog']?>[]" class="filestyle" data-input="false" data-buttonText="Galeria" data-iconName="fa fa-picture-o" data-badge="true">
														<p class="help-block">Solo se aceptan imágenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
													</center>
													<div class="col-md-12 col-xs-12">
														<div class="row" id="preview-galeria-contenido-mod-<?=$_content['idContenidoBlog']?>"></div>
														<div class="row">
											<?php
												if(isset($_content['galeria'])){
													foreach ($_content['galeria'] as $_galeria) {
											?>
															<div class="col-md-4 col-xs-12" id="content-galeria-<?=$_galeria['idGaleriaContenido']?>">
																<div class="close" onclick="deleteElement(<?=$_galeria['idGaleriaContenido']?>,'content-galeria-', 'deleteGaleriaContenido', 'true')"> <i class="fa fa-times"></i> </div>
																<center>
								                    				<div id="preview-img-contenido-galeria-<?=$_galeria['idGaleriaContenido']?>" class="espacios">
								                    					<img width="100%" class="img-responsive" height="250px" src="../img/imgBlog/contenido/galeria/<?=$_galeria['ruta']?>" />
								                    				</div>
								                    				<input type="hidden" name="idGaleriaContenido-<?=$_content['idContenidoBlog']?>[]" value="<?=$_galeria['idGaleriaContenido']?>">
																	<input type="file" onchange="showMyImageWH('preview-img-contenido-galeria-<?=$_galeria['idGaleriaContenido']?>', this, '', 1, 800, 600)" name="img-galeria-mod-<?=$_content['idContenidoBlog']?>[]" class="filestyle" data-input="false" data-buttonText="Imagen" data-iconName="fa fa-picture-o" data-badge="true">
																	<p class="help-block">Solo se aceptan imágenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
																</center>

															</div>
											<?php
													}
												}
											?>
														</div>
													</div>
													<hr class="divisor-seccion">
					                    		</div>
									<?php
												}
					                		}
					                	}
					                ?>
					                    	</div>
					                    </div>
					                    <!--<div class="row">
					                    	<div class="col-md-12 col-xs-12" id="tituloSecundarias"></div>
							                <div class="col-md-12 col-xs-12" id="preview-galeria-1"></div>
											<div id="sortableImg">
									    <?php

									    	/*if(count($temporal -> _galeriaBlog) > 0){
									        foreach ($temporal -> _galeriaBlog as $galeria) {
									        	if($galeria['tipo'] == 'video'){
									        		$_palabra = 'Imagen Video';
									        		$_nameInput = 'galeriaVideoMod[]';
									        		$_idnameInput = 'idGaleriaBlogVideo[]';
									        	}else{
									        		$_palabra = 'Imagen';
									        		$_nameInput = 'galeriaBlogMod[]';
									        		$_idnameInput = 'idGaleriaBlog[]';

									        	}
									    ?>
									    		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="deleteVideoMod<?=$galeria['idGaleriaBlog']?>">
							                        <center class="relative">
							                        	<div class="close" onclick="deleteElement(<?=$galeria['idGaleriaBlog']?>, 'deleteVideoMod', 'deleteGaleriaBlog', 'true')"><i class="fa fa-times"></i></div>
							                            <div class="espacios <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2) != 0){ echo $handle; }?>" id="preview-videoMod-<?=$galeria['idGaleriaBlog']?>">
															<center>
											                    <img width="auto" height="100px" src="../img/blog/galeria/<?=$galeria['ruta']?>"/>
											                </center>
							                            </div>
							                            <input type="hidden" name="<?=$_idnameInput?>" value="<?=$galeria['idGaleriaBlog']?>">
							                            <input type="hidden" class="idorden" name="idorden[]" value="<?=$galeria['idGaleriaBlog']?>"/>
							                            <input type="file" onchange="showMyImage('preview-videoMod-<?=$galeria['idGaleriaBlog']?>', this)" name="<?=$_nameInput?>" class="filestyle" data-input="false" data-buttonText="<?=$_palabra?>" data-iconName="fa fa-picture-o" data-badge="false">
							                            <p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
							                        <?php
							                        if($galeria['tipo'] == 'video'){
							                        ?>
							                            <div class="input-group espacios <?=$_inputUrl?>">
													       	<span class="input-group-addon">URL</span>
													       	<input type="text" name="urlVideoMod[]" data-validate="true" class="form-control" placeholder="Ingresa la url" value="<?=$galeria['url']?>">
													    </div>
													<?php
														}
													?>
							                        </center>
							                    </div>
									    <?php
									        }
									    	}*/
									    ?>
									        </div>
							            </div>-->
									</div>
									<div role="tabpanel" class="tab-pane espacios" id="relacion">
										<div class="col-lg-8 col-lg-offset-2 col-md-6 col-sm-12 col-xs-12">
											<center>
												<div class="alert alert-info espacios">
												        <i class="fa fa-info-circle"></i> Seleccione los Productos para esta Receta.
												</div>

												<select name="idproductos[]" id="multiselect2" data-validate="false" data-text="Productos" class="form-control select-picker" multiple="multiple">
													<?php
														foreach ($listaProductos as $listar) {
													?>
															<option <?=($productoxsolucion -> existe_productoxsolucion($id,$listar['idProducto'])) ? 'selected' : '';?> value="<?=$listar['idProducto']?>"><?=$listar['titulo']?></option>
													<?php
														}
													?>
												</select>


											</center>
										</div>
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
		<script src="js/functionsBlog.js"></script>
	</footer>
</html>
