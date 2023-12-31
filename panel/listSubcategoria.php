<?php
	function __autoload($nombre_clase) {
	    include 'clases/'.$nombre_clase .'.php';
	}
	/**
	 * [$seguridad: instancia - Clase para los candados y seguridad del panel]
	 * @var seguridad
	 */
	$seguridad = new seguridad();
	$seguridad -> candado();
	$alert = '';
	/**
	 * Para mostrar los mensajes de alerta
	 */
	if(isset($_REQUEST['success'])){
		$success = $_REQUEST['success'];
	  	$herramientas = new herramientas();
	  	$alert = $herramientas -> mensajesAlerta($success);
	}
	/**
	 * [$temporal: instancia - Clase del subcategoria]
	 * @var subcategoria
	 */
	$temporal = new subcategoria();
	$listaTemporal = $temporal -> listSubcategoria();
	/**
	 * Variables para los permisos
	 * @var string
	 */
	$clave = 'p_add_subcategoria';
	$clave2 = 'p_del_subcategoria';
	$clave3 = 'p_acdc_subcategoria';
	$clave4 = 'p_sort_subcategoria';
	$sort = "subcategoria";
	$handle = "";
	/**
	 * Validacion de permisos
	 * Sortable & Activar y Desactivar
	 */
	if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave4)==0){
	  $handle = "";
	  $permiso = "<input type='hidden' id='valorpermiso' name='permiso' value='0'>";
	}else{
	  $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>';
	  $permiso = "<input type='hidden' id='valorpermiso' name='permiso' value='1'>";
	}
	($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) ? $permisoAcDc = 0 : $permisoAcDc = 1;

	//variable global para el paginador;
	$opera_list = 'listarSubcategoria';
	$_lastPage = count($listaTemporal)-1;
	$_de = $listaTemporal[$_lastPage]['orden'];
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Lista | Subcategoria</title>
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
	                        <p class="titulo">Subcategoria</p>
	                    </div>
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                    	<form action="formSubcategoria.php" method="post">
	                    		<button <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="buttonagregar">Agregar Nuevo</button>
	                        </form>
	                    </div>
	                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                    	<hr class="hrmenu">
	                    </div>
	                    <div class="clearfix"></div>
	                    <!--Sección para realizar cambios Nota: el div con la clase styled-large es la que se visualiza con lg y md-->
                    	<form method="post" action="operaciones.php">
                    		<input type="hidden" id="permisoAcDc" value="<?=$permisoAcDc?>">
                    		<div class="styled-large">
		                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                            <ul class="ulfiltros">
		                                <li class="lifiltros">
		                                    <div class="styled-select">
		                                        <select name="operador">
		                                          <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2)==0) echo ' disabled ';?>>Eliminar</option>
		                                          <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>Mostrar</option>
		                                          <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>No Mostrar</option>
		                                       </select>
		                                    </div>
		                                </li>
		                                <li class="lifiltros">
		                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operasubcategoria">Aplicar</button>
		                                </li>
		                            </ul>
		                            <div class="busqueda espacios"><input type="text" onkeyup="buscar(this.value)" class="form-control search" placeholder="Buscar..."></div>
		                        </div>
		                    </div><!--Cierra el div class styled-large-->
		                    <div class="clearfix"></div>
		                    <!--Esta sección es para la version movil-->
		                    <div class="styled-small">
		                    	<div class="col-sm-12 col-xs-12">
		                        	<div class="busqueda"><input type="text" onkeyup="buscar(this.value)" class="form-control search" placeholder="Buscar..."></div>
		                        </div>
		                    	<div class="col-sm-12 col-xs-12">
		                            <ul class="ulfiltros">
		                                <li class="lifiltros">
		                                    <div class="styled-select">
		                                        <select>
		                                          <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2)==0) echo ' disabled ';?>>Eliminar</option>
		                                          <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>Mostrar</option>
		                                          <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>No Mostrar</option>
		                                       </select>
		                                    </div>
		                                </li>
		                                <li class="lifiltros">
		                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operasubcategoria">Aplicar</button>
		                                </li>
		                            </ul>
		                        </div>
		                    </div><!--Cierra el div class styled-small-->
		                    <div class="clearfix"></div>
		                    <!--Seccion de la tabla-->
		                    <div class="col-lg-12">
		                        <?php echo $permiso;?>
		                        <div class="table-responsive">
			                        <table id="tableSubcategoria" class="table table-hover table-striped tablesorter">
			                            <thead class="styled-thead">
			                              <tr>
			                              	<th width="50">
			                                	<input type="checkbox" id="marcar" name="marcar" onclick="marcartodos(this);" value="marcar">
												<label for="marcar"><span></span></label>
			                                </th>
			                                <th width="200px">Imagen</th>
			                                <th>Nombre</th>
			                                <th class="text-center">Mostrar</th>
			                              </tr>
			                            </thead>
			                            <tbody class="styled-tbody" id="sortable">
			                    <?php
									foreach($listaTemporal as $elementoTemporal){
										if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3) == 0){
											if($elementoTemporal['status'] != 0){
												$img='img/visible.png';
												$funcion='';
												$class = 'nover';
											}
											else{
										  		$img='img/invisible.png';
												$funcion='';
												$class = 'ver';
										   }
										}
										else{
											if($elementoTemporal['status'] != 0){
												$img='img/visible.png';
												$funcion='changeStatus('.$elementoTemporal['idSubcategoria'].',0,\'changeStatusSubcategoria\')';
												$class = 'nover';
											}
											else{
										  		$img='img/invisible.png';
												$funcion='changeStatus('.$elementoTemporal['idSubcategoria'].',1,\'changeStatusSubcategoria\')';
												$class = 'ver';
										   }
										}
									?>
											<tr>
				                              	<td>
				                                 	<input type="hidden" name="idorden" class="idorden" value="<?=$elementoTemporal['idSubcategoria']?>">
				                                	<input type="checkbox" id="<?=$elementoTemporal['idSubcategoria']?>" name="idSubcategoria[]" value="<?=$elementoTemporal['idSubcategoria']?>">
													<label for="<?=$elementoTemporal['idSubcategoria']?>"><span></span></label>
				                                </td>
				                                <td>
				                                	<a href="formSubcategoria.php?idSubcategoria=<?=$elementoTemporal['idSubcategoria']?>">
				                                	 	<img class="width100x" src="../img/imgSubcategoria/<?=$elementoTemporal['ruta']?>">
				                                	</a>
				                                </td>
				                                <td><?=$elementoTemporal['nombre']?></td>
				                                <td class="text-center">
				                                	<?=$handle?>
				                                	<img class="manita <?=$class?>" onclick="<?=$funcion?>" id="temp<?=$elementoTemporal['idSubcategoria']?>" src="<?=$img?>">
				                                </td>
				                            </tr>
			                    <?php
									}
			                    ?>
			                            </tbody>
			                            <tfoot class="styled-tfoot">
			                              	<tr>
			                              		<th>
			                                		<input type="checkbox" id="marcar2" name="marcar2" onclick="marcartodos(this);" value="marcar2">
													<label for="marcar2"><span></span></label>
			                                	</th>
			                               	 	<th>Imagen</th>
			                               	 	<th>Nombre</th>
			                                	<th class="text-center">Mostrar</th>
			                              	</tr>
			                            </tfoot>
			                        </table>
			                       	<!-- pager -->
			                        <div id="paginador">
			                            <center>
			                            	<input type="hidden" id="initfor" value="<?=$_de?>">
			                              	<img src="img/first.png" class="first off"/>
			                              	<img src="img/prev.png" class="prev off"/>
			                              	<?php
			                              		if(!empty($listaTemporal)){
				                                	for ($i=1; $i <= 4; $i++) {
				                                  		if($listaTemporal[0]['pagina'] == $i){
				                                    		echo '<span class="pages actual" data-actual="'.$i.'" onclick="listar('.$i.')"> '.$i.' </span>';
				                                  		}else if($listaTemporal[0]['ultimapagina'] >= $i){
				                                    		echo '<span class="pages" onclick="listar('.$i.')"> '.$i.' </span>';
				                                  		}
				                                	}

				                                	if($listaTemporal[0]['ultimapagina'] == $listaTemporal[0]['pagina']){
				                                  		echo '<img src="img/next.png" class="next off"/>';
				                                  		echo '<img src="img/last.png" class="last off" data-last="'.$listaTemporal[0]['ultimapagina'].'"/>';
				                                	}else{
				                                  		echo '<img src="img/next.png" class="next" onclick="listar('.$listaTemporal[0]['paginasiguiente'].')"/>';
				                                  		echo '<img src="img/last.png" class="last" data-last="'.$listaTemporal[0]['ultimapagina'].'" onclick="listar('.$listaTemporal[0]['ultimapagina'].')"/>';
				                                	}
			                                	}
			                              ?>
			                            </center>
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
	</footer>
</html>
