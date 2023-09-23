<?php
function __autoload($nombre_clase) {
    include 'clases/'.$nombre_clase .'.php';
}

$herramientas = new herramientas();
$seguridad    = new seguridad();
$seguridad->candado();
$alert        = '';

if (isset($_REQUEST['success'])) {
	$success = $_REQUEST['success'];
	$alert   = $herramientas -> mensajesAlerta($success);
}

$temporal      = new testimonio();
// $aleatorios    = $temporal -> listaTestimonioAleatorios();
$listaTemporal = $temporal -> listaTestimonio(1, true, '', $_REQUEST['idDestino']);
// print_r($listaTemporal);
// exit;

$clave  = 'p_add_testimonio';
$clave2 = 'p_del_testimonio';
$clave3 = 'p_acdc_testimonio';
$clave4 = 'p_sort_testimonio';
$clave5 = 'p_mod_testimonio';
$sort   = "testimonio";
$handle = "";

if ($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave4)==0) {
	$handle  = "";
	$permiso = "<input type='hidden' id='valorpermiso' name='permiso' value='0'>";
} else {
	$handle  = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>';
	$permiso = "<input type='hidden' id='valorpermiso' name='permiso' value='1'>";
}
$permisoAcDc = ($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) ? 0 : 1;
//variable global para el paginador;
$opera_list = 'listarTestimonio';
$_lastPage  = count($listaTemporal)-1;
$_de        = $listaTemporal[$_lastPage]['orden'];
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Lista | Características</title>
        <style>
		.buttonagregar2{
			background-color: #00afef;
			-webkit-border-top-left-radius: 5px;
			-moz-border-radius-topleft: 5px;
			border-top-left-radius: 5px;
			-webkit-border-top-right-radius: 5px;
			-moz-border-radius-topright: 5px;
			border-top-right-radius: 5px;
			-webkit-border-bottom-right-radius: 5px;
			-moz-border-radius-bottomright: 5px;
			border-bottom-right-radius: 5px;
			-webkit-border-bottom-left-radius: 5px;
			-moz-border-radius-bottomleft: 5px;
			border-bottom-left-radius: 5px;
			text-indent: 0px;
			display: inline-block;
			color: #ffffff;
			font-family: 'Roboto', sans-serif;
			font-size: 14px;
			font-weight: 700;
			font-style: normal;
			height: 36px;
			line-height: 36px;
			width: 126px;
			text-decoration: none;
			text-align: center;
			border: none;
			float: right;
			margin: 0 0 25px 0;
		}
		</style>
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
            			<!--Seccion ALERTAS-->
            			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                		<?=$alert?>
	                		<div class='notifications bottom-right'></div>
	                	</div>
	                	<!--Seccion del titulo y el boton de agregar-->
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                        <p class="titulo">Características</p>
	                    </div>
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                    	<form action="formularioTestimonioInicio.php" method="post">
	                    		<button type="button" <?php if ($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="buttonagregar">Agregar Nuevo</button>
                                <a href="formularioDestino.php?id=<?=$_REQUEST['idDestino']?>"><button type="button" class="buttonagregar2" style="margin-right:15px">Regresar</button></a>
	                        </form>   
	                    </div>
	                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                    	<hr class="hrmenu">
	                    </div>
	                    <div class="clearfix"></div>
	                    <!--Sección para realizar cambios Nota: el div con la clase styled-large es la que se visualiza con lg y md-->
                    	<form method="post" action="operaciones.php">
                    		<input type="hidden" id="permisoAcDc" value="<?=$permisoAcDc?>">
                            <input type="hidden" name="idDestino" value="<?=$_REQUEST['idDestino']?>">
                    		<!-- <input type="hidden" id="filtroTipo" name="tipo" value="inicio"> -->
                    		<div class="">
                    			<div class="col-md-6 col-md-push-6 col-xs-12">
		                        	<div class="busqueda espacios" style="display:none">
		                        		<!-- <input type="search" data-column="all" class="form-control" placeholder="Buscar" /> -->
		                        		<input type="text" onkeyup="buscar(this.value)" class="form-control" placeholder="Buscar..." />
		                        	</div>
		                        </div>
		                        <div class="col-md-6 col-xs-12 col-md-pull-6">
		                            <ul class="ulfiltros">
		                                <li class="lifiltros">
		                                    <div class="styled-select">
		                                        <select name="operador">
		                                            <option value="Activar" class="styled" <?php if ($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>Activar</option>
		                                            <option value="Desactivar" class="styled" <?php if ($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>Desactivar</option>
		                                            <option value="Eliminar" class="styled" <?php if ($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2)==0) echo ' disabled ';?>>Eliminar</option>
		                                       </select>
		                                    </div>
		                                </li>
		                                <li class="lifiltros">    
		                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operatestimonio">Aplicar</button>
		                                </li>	                                
		                            </ul>                     
		                        </div>
		                    </div>
		                    <div class="clearfix"></div>
		                    <!--Seccion de la tabla-->
		                    <div class="col-md-12 col-xs-12">
		                        <?php echo $permiso;?>
		                        <div class="table-responsive">
			                        <table id="table-short" class="table table-hover table-striped tablesorter">
			                            <thead class="styled-thead">
			                              <tr>
			                              	<th width="50">
			                                	<input type="checkbox" id="marcar" name="marcar" onclick="marcartodos(this);" value="marcar">
												<label for="marcar"><span></span></label>
			                                </th>
			                                <th width="150px">Imagen</th>  
			                                <th>Título</th>   
			                                <th class="text-center">Mostrar</th>
			                              </tr>
			                            </thead>
			                            <tbody class="styled-tbody" id="sortable">
					                    <?php
											foreach ($listaTemporal as $elementoTemporal) {
												if ($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) {
													if ($elementoTemporal['status']!=0) {
														$img     = 'img/visible.png';
														$funcion = '';
														$class   = 'nover';
													}
													else{
														$img     ='img/invisible.png';
														$funcion ='';
														$class   = 'ver';
												   }	
												} else {
													if ($elementoTemporal['status']!=0) {
														$img='img/visible.png';
														$funcion='changeStatus('.$elementoTemporal['idTestimonio'].',0,\'changeStatusTestimonio\')';
														$class = 'nover';
													} else {
												  		$img='img/invisible.png';
														$funcion='changeStatus('.$elementoTemporal['idTestimonio'].',1,\'changeStatusTestimonio\')';
														$class = 'ver';
												   }
												}
											?>	
											<tr>
				                              	<td>
				                                 	<input type="hidden" name="idorden" class="idorden" value="<?=$elementoTemporal['idTestimonio']?>">
				                                	<input type="checkbox" id="<?=$elementoTemporal['idTestimonio']?>" name="idTestimonio[]" value="<?=$elementoTemporal['idTestimonio']?>">
													<label for="<?=$elementoTemporal['idTestimonio']?>"><span></span></label>
				                                </td>
				                               	<td>
				                                	<a href="javascript:;" class="edit" data-id="<?=$elementoTemporal['idTestimonio']?>" data-nombre="<?=$elementoTemporal['nombre']?>" data-ubicacion="<?=$elementoTemporal['ubicacion']?>" data-comentario="<?=$elementoTemporal['texto']?>" data-texto="<?=$elementoTemporal['textoEn']?>" data-portada="<?=$elementoTemporal['imgPortada']?>">
				                                		<img src="../img/imgTestimonio/<?=$elementoTemporal['imgPortada']?>" class="img-responsive">
				                                	</a>
				                                </td>     
				                                <td>
				                                	<a href="javascript:;" class="edit" data-id="<?=$elementoTemporal['idTestimonio']?>" data-nombre="<?=$elementoTemporal['nombre']?>" data-ubicacion="<?=$elementoTemporal['ubicacion']?>" data-comentario="<?=$elementoTemporal['texto']?>" data-texto="<?=$elementoTemporal['textoEn']?>" data-portada="<?=$elementoTemporal['imgPortada']?>">
				                                		<?=$elementoTemporal['nombre']?>
				                                	</a>
				                                </td>                
				                                <td class="text-center">
				                                	<?=$handle?>				                                	
				                                	<img class="manita <?=$class?>" onclick="<?=$funcion?>" id="temp<?=$elementoTemporal['idTestimonio']?>" src="<?=$img?>">
				                                </td>
				                            </tr>    
					                    <?php } ?>
			                            </tbody>
			                            <tfoot class="styled-tfoot">
			                              	<tr>
			                              		<th>
			                                		<input type="checkbox" id="marcar2" name="marcar2" onclick="marcartodos(this);" value="marcar2">
													<label for="marcar2"><span></span></label>
			                                	</th>
				                                <th width="150px">Imagen</th>  
				                                <th>Nombre</th>   
				                                <th class="text-center">Mostrar</th>
			                              	</tr>
			                            </tfoot>
			                        </table>
			                       	<!-- pager -->
		                            <div id="pager" class="pager">
		                               	<form>
			                                <img src="img/first.png" class="first"/>
			                                <img src="img/prev.png" class="prev"/>
			                                <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
			                                <img src="img/next.png" class="next"/>
			                                <img src="img/last.png" class="last"/>
			                                <select class="pagesize">
			                                  	<option value="10">10</option>
			                                  	<option value="40">40</option>
			                                  	<option value="50">50</option>
			                                  	<option value="100">100</option>
			                                </select>
			                            </form>
		                            </div>
			                    </div>
		                	</div><!--Div de cierre de la clase table-responsive-->
                    	</form>
            		</div>
            	</div>
	        </div>
	    </div>

		<div class="modal fade" id="modal-edit-testimonio">
	    	<div class="modal-dialog" role="document">
	    		<form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post" enctype="multipart/form-data">
	    			<input type="hidden" id="id" name="id" value="">
                   	<input type="hidden" id="operaciones" name="operaciones" value="">
                   	<input type="hidden" id="MOD" value="">
                    <input type="hidden" name="idDestino" value="<?=$_REQUEST['idDestino']?>">
		    		<div class="modal-content">
		    			<div class="modal-header">
		    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    					<span aria-hidden="true">&times;</span>
		    					<span class="sr-only">Close</span>
		    				</button>
		    				<h4 class="modal-title"></h4>
		    			</div>
		    			<div class="modal-body">
		    				<center class="espacios">
								PREVISUALIZAR ÍCONO
								<div id="preview-testimonio" class="espacios">		
								</div>
								<input type="file" onchange="showMyImage('preview-testimonio', this)" name="imagen" id="imagen" class="filestyle" data-input="false" data-buttonText="Imagen Ícono" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Ícono">
								<p class="help-block"><small>Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 50 x 50px </small></p>
							</center>
							<!-- <center class="espacios">
								PREVISUALIZAR IMAGEN MOVIL
								<div id="preview-testimonio-movil" class="espacios">		
								</div>
								<input type="file" onchange="showMyImageWH('preview-testimonio-movil', this, '', 1, 800, 800)" name="imgMovil" id="" class="filestyle" data-input="false" data-buttonText="Imagen Movil" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Movil">
								<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 800 x 800px </p>
							</center> -->
		    				<div class="input-group espacios">
			                    <span class="input-group-addon">Título</span>
			                    <input type="text" id="nombre" name="nombre" data-validate="false" class="form-control" placeholder="Ingresa el título..." value="">
			                </div>
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Título inglés</span>
			                    <input type="text" id="ubicacion" name="ubicacion" data-validate="false" class="form-control" placeholder="Ingresa el título en inglés..." value="">
			                </div>
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Descripción</span>
			                    <textarea name="comentario" id="comentario" rows="6" class="form-control" placeholder="Ingresa el texto..." data-validate="false"></textarea>
			                </div>
                            <div class="input-group espacios">
			                    <span class="input-group-addon">Descripción inglés</span>
			                    <textarea name="comentarioEn" id="textoEn" rows="6" class="form-control" placeholder="Ingresa el texto en inglés..." data-validate="false"></textarea>
			                </div>
		    			</div>
		    			<div class="modal-footer">
		    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		    				<button type="button" <?php if ($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave5)==0) echo ' disabled ';?> class="buttonguardar btn-save">Guardar y Publicar</button>
		    			</div>
		    		</div><!-- /.modal-content -->
	    		</form>	
	    	</div><!-- /.modal-dialog -->
	    </div><!-- /.modal -->	    
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
		<script src="js/functionsTestimonio.js"></script>
	</footer>
</html>