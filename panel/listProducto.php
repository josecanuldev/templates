<?php
function __autoload($nombre_clase) {
    include 'clases/'.$nombre_clase .'.php';

}
$seguridad = new seguridad();
$seguridad->candado();
$alert = '';

if(isset($_REQUEST['success'])){
	$success = $_REQUEST['success'];
  	$herramientas = new herramientas();
  	$alert = $herramientas -> mensajesAlerta($success);
}
$temporal = new producto();
$listaTemporal = $temporal -> listProducto();
$clave = 'p_add_producto';
$clave2 = 'p_del_producto';
$clave3 = 'p_acdc_producto';
$clave4 = 'p_sort_producto';
$sort = "producto";
$handle = "";
if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave4)==0){
  $handle = "";
  $permiso = "<input type='hidden' id='valorpermiso' name='permiso' value='0'>";
}else{
  $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>';
  $permiso = "<input type='hidden' id='valorpermiso' name='permiso' value='1'>";
} 
($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) ? $permisoAcDc = 0 : $permisoAcDc = 1;
//variable global para el paginador;
$opera_list = 'listarProducto';
$_lastPage = count($listaTemporal)-1;
$_de = $listaTemporal[$_lastPage]['orden'];
$tituloPagina = new tituloPagina(1);
$tituloPagina -> getTituloPagina();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Lista | Producto</title>
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
	                        <p class="titulo">Producto</p>
	                    </div>
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                    	<form action="formProducto.php" method="post">
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
                    		<div class="">
                    			<div class="col-md-6 col-md-push-6 col-xs-12">
		                        	<div class="busqueda"><input type="text" onkeyup="buscar(this.value)" class="form-control search" placeholder="Buscar..."></div> 
		                        </div>
		                        <div class="col-md-6 col-xs-12 col-md-pull-6">
		                            <ul class="ulfiltros">
		                                <li class="lifiltros">
		                                    <div class="styled-select">
		                                        <select name="operador">
		                                            <option value="Activar" class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>Activar</option>
		                                            <option value="Desactivar" class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>Desactivar</option>
		                                            <option value="Eliminar" class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2)==0) echo ' disabled ';?>>Eliminar</option>
		                                       </select>
		                                    </div>
		                                </li>
		                                <li class="lifiltros">
		                                    <div class="styled-select">
		                                        <select id="registrosPorPagina" onchange="regPP(this.value)">
		                                            <option selected value="-1">Cantidad de registros</option>
		                                            <option value="50">50</option>
		                                            <option value="100">100</option>
		                                            <option value="250">250</option>
		                                            <option value="500">500</option>
		                                       </select>
		                                    </div>
		                                </li>
		                                <li class="lifiltros">    
		                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operaproducto">Aplicar</button>
		                                </li>
		                                <!--<li class="lifiltros">    
		                                    <p class="pad-top-7x"><b>TITULO SECCION:</b></p>
		                                </li>
		                                <li class="lifiltros">    
		                                    <p class="trigger-edit" data-id="<?=$tituloPagina -> _idTituloPagina?>" data-tituloEs="<?=$tituloPagina -> _tituloEs?>" data-tituloEn="<?=$tituloPagina -> _tituloEn?>" ><?=$tituloPagina -> _tituloEs?></p>
		                                </li>-->	                                
		                            </ul>                     
		                        </div>
		                    </div>
		                    <div class="clearfix"></div>
		                    <!--Seccion de la tabla-->
		                    <div class="col-lg-12">
		                        <?php echo $permiso;?>
		                        <div class="table-responsive">
			                        <table id="table-long" class="table table-hover table-striped tablesorter">
			                            <thead class="styled-thead">
			                              <tr>
			                              	<th width="50">
			                                	<input type="checkbox" id="marcar" name="marcar" onclick="marcartodos(this);" value="marcar">
												<label for="marcar"><span></span></label>
			                                </th>
			                                <th width="100"></th>
			                                <th>Título</th>
			                                <th>Categoría</th>
			                                <th class="text-center">Mostrar</th>
			                              </tr>
			                            </thead>
			                            <tbody class="styled-tbody" id="sortable">
			                    <?php
									foreach($listaTemporal as $elementoTemporal){
										if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0){
											if($elementoTemporal['status']!=0){
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
											if($elementoTemporal['status']!=0){
												$img='img/visible.png';
												$funcion='changeStatus('.$elementoTemporal['idProducto'].',0,\'changeStatusProducto\')';
												$class = 'nover';
											}
											else{
										  		$img='img/invisible.png';
												$funcion='changeStatus('.$elementoTemporal['idProducto'].',1,\'changeStatusProducto\')';
												$class = 'ver';
										   }
										}
										if($elementoTemporal['destacado'] != 0){
											$_fa = 'fa-toggle-on';
											$_funcion = 'changeDestacado('.$elementoTemporal['idProducto'].',0,\'changeDestacadoProducto\')';
										}else{
											$_fa = 'fa-toggle-off';
											$_funcion = 'changeDestacado('.$elementoTemporal['idProducto'].',1,\'changeDestacadoProducto\')';
										}
									?>	
											<tr>
				                              	<td>
				                                 	<input type="hidden" name="idorden" class="idorden" value="<?=$elementoTemporal['idProducto']?>">
				                                	<input type="checkbox" id="<?=$elementoTemporal['idProducto']?>" name="idProducto[]" value="<?=$elementoTemporal['idProducto']?>">
													<label for="<?=$elementoTemporal['idProducto']?>"><span></span></label>
				                                </td>
				                                <td>
				                                	<a href="formProducto.php?idProducto=<?=$elementoTemporal['idProducto']?>"><img class="img-responsive" src="../img/producto/galeria/<?=$elementoTemporal['imgPortada']?>"></a>
				                                </td>
				                                <td>
				                                	<a href="formProducto.php?idProducto=<?=$elementoTemporal['idProducto']?>">
				                                		<?=$elementoTemporal['titulo']?>
				                                	</a>
				                                </td>		 
				                                <td><?=$elementoTemporal['nombreCat']?></td>                               
				                                <td class="text-center">
				                                	<?=$handle?>				                                	
				                                	<img class="manita <?=$class?>" onclick="<?=$funcion?>" id="temp<?=$elementoTemporal['idProducto']?>" src="<?=$img?>">
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
			                               	 	<th></th>
				                                <th>Título</th> 
				                                <th>Categoría</th>                                
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
	    <div class="modal fade" id="modal-edit-table">
	    	<div class="modal-dialog" role="document">
	    		<form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post">
	    			<input type="hidden" id="id" name="id" value="">
                   	<input type="hidden" id="operaciones" name="operaciones" value="">
		    		<div class="modal-content">
		    			<div class="modal-header">
		    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    					<span aria-hidden="true">&times;</span>
		    					<span class="sr-only">Close</span>
		    				</button>
		    				<h4 class="modal-title"></h4>
		    			</div>
		    			<div class="modal-body">
		    				<div class="input-group espacios">
			                    <span class="input-group-addon">Titulo ES</span>
			                    <input type="text" id="tituloEs" name="tituloEs" data-validate="true" class="form-control" placeholder="Ingresa el titulo de la seccion..." value="">
			                </div>
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Titulo EN</span>
			                    <input type="text" id="tituloEn" name="tituloEn" data-validate="true" class="form-control" placeholder="Ingresa el titulo de la seccion..." value="">
			                </div>
		    			</div>
		    			<div class="modal-footer">
		    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		    				<button type="button" class="buttonguardar btn-save">Guardar y Publicar</button>
		    			</div>
		    		</div><!-- /.modal-content -->
	    		</form>	
	    	</div><!-- /.modal-dialog -->
	    </div><!-- /.modal -->
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
		<script src="js/functionsProducto.js"></script>
	</footer>
</html>