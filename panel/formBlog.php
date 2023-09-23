<?php
function __autoload($ClassName){
    include('clases/'.$ClassName.".php");
}
$seguridad = new seguridad();
$seguridad->candado();
$_MOD = '';
$sort = '';

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
$clave = 'p_mod_journal';
$clave2 ='p_sort_galeria_journal';
$sort = 'galeriaBlog';
$handle = 'handle sortimg';

$categoria = new categoria();
$categorias = $categoria  -> listCategoria(1, false, 1, '', 20, 2, false);
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
									<li role="presentation" class="active">
										<a href="#blog-es" aria-controls="blog-es" role="tab" data-toggle="tab">DATOS BLOG</a>
									</li>
									<!--<li role="presentation">
										<a href="#blog-en" aria-controls="blog-en" role="tab" data-toggle="tab">BLOG EN</a>
									</li>-->
									<li role="presentation">
										<a href="#galeria" aria-controls="galeria" role="tab" data-toggle="tab">GALERIA</a>
									</li>
								</ul>
							
								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane espacios active" id="blog-es">
										<div class="col-lg-8 col-lg-offset-2 col-md-6 col-sm-12 col-xs-12">
											<center>
												PREVISUALIZAR IMAGEN PORTADA
												<div id="preview-img-blog" class="espacios">
													<?=($temporal -> _portada != '') ?  '<img width="auto" height="250px" src="../img/blog/'.$temporal -> _portada.'">' : '';?>														
												</div>
												<input type="file" data-validate="true" data-type-file="imagen" data-text="portada" onchange="showMyImageWH('preview-img-blog', this, '', 1, 370, 260)" name="archivo" class="filestyle" data-input="false" data-buttonText="Imagen Portada" data-iconName="fa fa-picture-o" data-badge="false">
												<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 370x260</p>
											</center>
											<p class="help-block">Selecciona una categoría para este Blog</p>
											<select name="idCategoria" data-validate="true" data-text="Categoria" class="selectpicker" title="Elegir Categoría">
										<?php
											foreach($categorias as $_cat){
										?>
												<option <?=($_cat['idCategoria'] == $temporal -> _idCategoria) ? 'selected' : '';?> value="<?=$_cat['idCategoria']?>"><?=$_cat['tituloEs']?></option>
										<?php		
											}
											$temporal -> obtenerDatosBlog('ES');
										?>
										    </select>
										    <div class="input-group espacios">
										    	<input type="hidden" name="lang[]" value="ES">
					                        	<span class="input-group-addon">Titulo</span>
					                        	<input type="text" name="titulo[]" data-validate="true" class="form-control" placeholder="Ingresa el titulo del blog..." value="<?=$temporal -> _datosBlog -> _titulo?>">
					                        </div>
					                        <div class="input-group espacios">
					                        	<span class="input-group-addon">Subtitulo</span>
					                        	<input type="text" name="subtitulo[]" data-validate="true" class="form-control" placeholder="Ingresa el subtitulo del blog..." value="<?=$temporal -> _datosBlog -> _subtitulo?>">
					                        </div>		                        
					                        <div class="input-group espacios">
					                        	<span class="input-group-addon">Descripción</span>
					                        	<textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion[]" id="descripcion"><?=$temporal -> _datosBlog -> _descripcion?></textarea>
					                        </div>
					                        <div class="input-group espacios">
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
					                    	<div class="row">
					                    		<div class="col-md-6 col-xs-12">
					                    			<center>										
														<input type="file" multiple onchange="showMyImageWH('preview-galeria-1', this, '', 2, 770, 541)" onchange="showMyImage('preview-galeria-1', this, true)" name="galeriaBlog[]" class="filestyle" data-input="false" data-buttonText="Galeria" data-iconName="fa fa-picture-o" data-badge="true">
														<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 770 x 541</p>
													</center>
					                    		</div>
					                    		<div class="col-md-6 col-xs-12">
					                    			<center>
					                    				<button class="btn btn-default addVideo" type="button"><i class="fa fa-video-camera"></i> Videos</button>
					                    				<p class="help-block">Solo se aceptan links de youtube y vimeo</p>
					                    			</center>
					                    		</div>
					                    	</div>
					                    </div>
					                    <div class="row">
					                    	<div class="col-md-12 col-xs-12" id="tituloSecundarias"></div>
							                <div class="col-md-12 col-xs-12 espacios" id="preview-galeria-1"></div>
											<div id="sortableImg" class="espacios">
									    <?php

									    	if(count($temporal -> _galeriaBlog) > 0){    
									    	$c = 0;
									        foreach ($temporal -> _galeriaBlog as $galeria) { 
									        	$c++;
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
									    			<div class="panel panel-default">
									    				<div class="panel-heading">
									    					IMAGEN <div class="close" onclick="deleteElement(<?=$galeria['idGaleriaBlog']?>, 'deleteVideoMod', 'deleteGaleriaBlog', 'true')"><i class="fa fa-times"></i></div>
									    				</div>
									    				<div class="panel-body">
									    					<center class="relative">
									                            <div class="espacios <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2) != 0){ echo $handle; }?>" id="preview-videoMod-<?=$galeria['idGaleriaBlog']?>">
																	<center>
													                    <img width="auto" height="100px" src="../img/blog/galeria/<?=$galeria['ruta']?>"/>
													                </center>
									                            </div>	
									                            <input type="hidden" name="<?=$_idnameInput?>" value="<?=$galeria['idGaleriaBlog']?>">	
									                            <input type="hidden" class="idorden" name="idorden[]" value="<?=$galeria['idGaleriaBlog']?>"/>		
									                            <input type="file" onchange="showMyImageWH('preview-videoMod-<?=$galeria['idGaleriaBlog']?>', this, '', 1, 770, 541)" onchange="showMyImage('preview-videoMod-<?=$galeria['idGaleriaBlog']?>', this)" name="<?=$_nameInput?>" class="filestyle" data-input="false" data-buttonText="<?=$_palabra?>" data-iconName="fa fa-picture-o" data-badge="false">
									                            <p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 770 x 541</p>
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
									    			</div>
							                    </div>  
							                <?php
							                	if($c == 3){
							                		echo '<div class="clearfix"></div>';
							                		$c = 0;
							                	}
							                ?> 
									    <?php
									        }
									    	}
									    ?>
									        </div>
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
	</footer>
</html>	