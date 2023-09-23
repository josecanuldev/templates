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

$temporal      = new experiencia();
$listaTemporal = $temporal -> listaExperiencia(1, true, '', 'ServicioPremium');
// print_r($listaTemporal);
// exit;

$clave  = 'p_add_precios';
$clave2 = 'p_del_precios';
$clave3 = 'p_acdc_precios';
$clave4 = 'p_sort_precios';
$clave5 = 'p_mod_precios';
$sort   = "precios";
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
$opera_list = 'listarExperiencia';
$_lastPage  = count($listaTemporal)-1;
$_de        = $listaTemporal[$_lastPage]['orden'];
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Lista | servicio premium puerta puerta hasta Isla Holbox</title>
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
	                        <p class="titulo">Precios servicio premium puerta puerta hasta Isla Holbox</p>
	                    </div>
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                    	<form action="formularioServicioPremium.php" method="post">
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
                    		<input type="hidden" id="filtroTipo" name="tipo" value="ServicioPremium">
                    		<div class="">
                    			<div class="col-md-6 col-md-push-6 col-xs-12">
		                        	<div class="busqueda espacios">
		                        		<!-- <input type="search" data-column="all" class="form-control" placeholder="Buscar" /> -->
		                        		<input type="text" onKeyUp="buscar(this.value)" class="form-control" placeholder="Buscar..." />
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
		                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operaexperiencia">Aplicar</button>
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
			                                	<input type="checkbox" id="marcar" name="marcar" onClick="marcartodos(this);" value="marcar">
												<label for="marcar"><span></span></label>
			                                </th>
			                                <th>Nombre</th>
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
														$funcion='changeStatus('.$elementoTemporal['idExperiencia'].',0,\'changeStatusExperiencia\')';
														$class = 'nover';
													} else {
												  		$img='img/invisible.png';
														$funcion='changeStatus('.$elementoTemporal['idExperiencia'].',1,\'changeStatusExperiencia\')';
														$class = 'ver';
												   }
												}
											?>
											<tr>
				                              	<td>
				                                 	<input type="hidden" name="idorden" class="idorden" value="<?=$elementoTemporal['idExperiencia']?>">
				                                	<input type="checkbox" id="<?=$elementoTemporal['idExperiencia']?>" name="idExperiencia[]" value="<?=$elementoTemporal['idExperiencia']?>">
													<label for="<?=$elementoTemporal['idExperiencia']?>"><span></span></label>
				                                </td>
				                                <td>
				                                	<a href="formularioServicioPremium.php?id=<?=$elementoTemporal['idExperiencia']?>">
				                                		<?=$elementoTemporal['nombre']?>
				                                	</a>
				                                </td>
				                                <td class="text-center">
				                                	<?=$handle?>
				                                	<img class="manita <?=$class?>" onClick="<?=$funcion?>" id="temp<?=$elementoTemporal['idExperiencia']?>" src="<?=$img?>">
				                                </td>
				                            </tr>
					                    <?php } ?>
			                            </tbody>
			                            <tfoot class="styled-tfoot">
			                              	<tr>
			                              		<th>
			                                		<input type="checkbox" id="marcar2" name="marcar2" onClick="marcartodos(this);" value="marcar2">
													<label for="marcar2"><span></span></label>
			                                	</th>
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
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
		<!-- <script src="js/functionsExperiencia.js"></script> -->
	</footer>
</html>
