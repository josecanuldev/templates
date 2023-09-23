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

$temporal      = new servicio();
// $aleatorios    = $temporal -> listaServicioAleatorios();
$listaTemporal = $temporal -> listaServicio(1, true, '');
// print_r($listaTemporal);
// exit;

$clave  = 'p_add_servicio';
$clave2 = 'p_del_servicio';
$clave3 = 'p_acdc_servicio';
$clave4 = 'p_sort_servicio';
$clave5 = 'p_mod_servicio';
$sort   = "servicio";
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
$opera_list = 'listarServicio';
$_lastPage  = count($listaTemporal)-1;
$_de        = $listaTemporal[$_lastPage]['orden'];
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Lista | Servicio</title>
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
	                        <p class="titulo">Servicio</p>
	                    </div>
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                    	<form action="formularioServicio.php" method="post">
	                    		<button type="submit" <?php if ($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="buttonagregar">Agregar Nuevo</button>
	                        </form>   
	                    </div>
	                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                    	<hr class="hrmenu">
	                    </div>
	                    <div class="clearfix"></div>
	                    <!--Sección para realizar cambios Nota: el div con la clase styled-large es la que se visualiza con lg y md-->
                    	<form method="post" action="operaciones.php">
                    		<input type="hidden" id="permisoAcDc" value="<?=$permisoAcDc?>">
                    		<!-- <input type="hidden" id="filtroTipo" name="tipo" value="inicio"> -->
                    		<div class="">
                    			<div class="col-md-6 col-md-push-6 col-xs-12">
		                        	<div class="busqueda espacios">
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
		                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operaservicio">Aplicar</button>
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
			                                <th>T&iacute;tulo</th>   
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
														$funcion='changeStatus('.$elementoTemporal['idServicio'].',0,\'changeStatusServicio\')';
														$class = 'nover';
													} else {
												  		$img='img/invisible.png';
														$funcion='changeStatus('.$elementoTemporal['idServicio'].',1,\'changeStatusServicio\')';
														$class = 'ver';
												   }
												}

												if ($elementoTemporal['destacado'] > 0) {
													$_fa      = 'fa-toggle-on';
													$_funcion = 'changeDestacado('.$elementoTemporal['idServicio'].',0,\'changeDestacadoServicio\')';
												} else {
													$_fa      = 'fa-toggle-off';
													$_funcion = 'changeDestacado('.$elementoTemporal['idServicio'].',1,\'changeDestacadoServicio\')';
												}
											?>	
											<tr>
				                              	<td>
				                                 	<input type="hidden" name="idorden" class="idorden" value="<?=$elementoTemporal['idServicio']?>">
				                                	<input type="checkbox" id="<?=$elementoTemporal['idServicio']?>" name="idServicio[]" value="<?=$elementoTemporal['idServicio']?>">
													<label for="<?=$elementoTemporal['idServicio']?>"><span></span></label>
				                                </td>
				                               	<td>
				                                	<a href="formularioServicio.php?id=<?=$elementoTemporal['idServicio']?>">
				                                		<img src="../img/imgServicio/<?=$elementoTemporal['imgPortada']?>" class="img-responsive">
				                                	</a>
				                                </td>     
				                                <td>
				                                	<a href="formularioServicio.php?id=<?=$elementoTemporal['idServicio']?>">
				                                		<?=$elementoTemporal['titulo']?>
				                                	</a>
				                                </td>  
				                                <td class="text-center">
				                                	<?=$handle?>				                                	
				                                	<img class="manita <?=$class?>" onclick="<?=$funcion?>" id="temp<?=$elementoTemporal['idServicio']?>" src="<?=$img?>">
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
				                                <th>T&iacute;tulo</th>   
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
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
		<!-- <script src="js/functionsServicio.js"></script> -->
	</footer>
</html>