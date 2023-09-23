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
  	$alert = $herramientas -> mensajesAlerta($success);
}

$temporal      = new codigo();
$listaTemporal = $temporal -> listarcodigo();
// print_r($listaTemporal);
// exit;

$clave  = 'AgrCodigo';
$clave2 = 'ElimCodigo';
$clave3 = 'AcDcCodigo';

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Listado de los códigos de descuento</title>
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
	                        <p class="titulo">Códigos de descuento</p>
	                    </div>
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                    	<form action="formularioCodigo.php" method="post">
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
                    		<input type="hidden" id="filtroTipo" name="tipo" value="inicio">
                    		<div class="">
                    			<div class="col-md-6 col-md-push-6 col-xs-12">
		                        	<div class="busqueda espacios">
		                        		<!-- <input type="search" data-column="all" class="form-control" placeholder="Buscar" /> -->
		                        		<input type="search" data-column="all" class="form-control search" placeholder="Buscar..."/>
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
		                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operacodigo">Aplicar</button>
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
			                                <th>Código<i class="fa fa-sort"></i></th>
                                            <th>Fecha de inicio</th>
                                            <th>Fecha de término</th>
                                            <th>Tipo Descuento</th>
			                                <th class="text-center">Mostrar</th>
			                              </tr>
			                            </thead>
			                            <tbody class="styled-tbody" id="sortable">
					                    <?php
											foreach($listaTemporal as $elementoTemporal)
											{
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
														$funcion='Desactivar('.$elementoTemporal['idCodigo'].')';
														$class = 'nover';
													}
													else{
														$img='img/invisible.png';
														$funcion='Activar('.$elementoTemporal['idCodigo'].')';
														$class = 'ver';
												   }
												}
												if($elementoTemporal['tipoDescuento']==1)
												{
													$tipoDescuento='Porcentaje';
												}
												elseif($elementoTemporal['tipoDescuento']==2)
												{
													$tipoDescuento='Cantidad';
												}

												if($elementoTemporal['tipoCodigo']==1)
												{
													$tipoCodigo='Venta Online (Tours)';
												}
												elseif($elementoTemporal['tipoCodigo']==2)
												{
													$tipoCodigo='Concierge Services (Transportation)';
												}
												elseif($elementoTemporal['tipoCodigo']==3)
												{
													$tipoCodigo='Concierge Services (Restaurant reservation)';
												}
												elseif($elementoTemporal['tipoCodigo']==4)
												{
													$tipoCodigo='Concierge Services (Teetime reservation)';
												}
												elseif($elementoTemporal['tipoCodigo']==5)
												{
													$tipoCodigo='Concierge Services (Catering & Event Planning)';
												}
												elseif($elementoTemporal['tipoCodigo']==6)
												{
													$tipoCodigo='Concierge Services (Reserve a Nightclub table)';
												}
												elseif($elementoTemporal['tipoCodigo']==7)
												{
													$tipoCodigo='Concierge Services (Babysitting Service)';
												}
												elseif($elementoTemporal['tipoCodigo']==8)
												{
													$tipoCodigo='Yatch Rental';
												}
												elseif($elementoTemporal['tipoCodigo']==9)
												{
													$tipoCodigo='Venta Online (Sport Fishing)';
												}
												elseif($elementoTemporal['tipoCodigo']==10)
												{
													$tipoCodigo='Luxury Accomodations';
												}

											 echo'<tr>
													<td>
													  <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idCodigo'].'">
														<input type="checkbox" id="'.$elementoTemporal['idCodigo'].'" name="idCodigo[]" value="'.$elementoTemporal['idCodigo'].'">
														<label for="'.$elementoTemporal['idCodigo'].'"><span></span></label>
													</td>
													<td><a href="formularioCodigo.php?idCodigo='.$elementoTemporal['idCodigo'].'">'.$elementoTemporal['codigo'].'</a></td>
													<td>'.date('d/m/Y', strtotime($elementoTemporal['fechaInicio'])).'</td>
													<td>'.date('d/m/Y', strtotime($elementoTemporal['fechaTermino'])).'</td>
													<td>'.$tipoDescuento.'</td>
													<td class="text-center visible-lg visible-md">'.$handle.'<img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idCodigo'].'" src="'.$img.'"></td>
												  </tr>';
											}
											?>
			                            </tbody>
			                            <tfoot class="styled-tfoot">
			                              	<tr>
			                              		<th>
			                                		<input type="checkbox" id="marcar2" name="marcar2" onclick="marcartodos(this);" value="marcar2">
													<label for="marcar2"><span></span></label>
			                                	</th>
				                                <th>Código<i class="fa fa-sort"></i></th>
                                                <th>Fecha de inicio</th>
                                                <th>Fecha de término</th>
                                                <th>Tipo Descuento</th>
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
                                          <option value="5">5</option>
                                          <option value="10">10</option>
                                          <option value="20">20</option>
                                          <option value="50">50</option>
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
		<div class="modal fade" id="modal-edit-table">
	    	<div class="modal-dialog" role="document">
	    		<form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post" enctype="multipart/form-data">
	    			<input type="hidden" id="id" name="id" value="">
                   	<input type="hidden" id="operaciones" name="operaciones" value="">
                   	<input type="hidden" id="MOD" value="">
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
								PREVISUALIZAR IMAGEN PRINCIPAL
								<div id="preview-slider" class="espacios">
								</div>
								<input type="file" onchange="showMyImageWH('preview-slider', this, '', 1, 1600, 1275)" name="imagen" id="" class="filestyle" data-input="false" data-buttonText="Imagen Principal" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Principal">
								<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 1600 x 1275px </p>
							</center>
							<center class="espacios">
								PREVISUALIZAR IMAGEN MOVIL
								<div id="preview-slider-movil" class="espacios">
								</div>
								<input type="file" onchange="showMyImageWH('preview-slider-movil', this, '', 1, 800, 800)" name="imgMovil" id="" class="filestyle" data-input="false" data-buttonText="Imagen Movil" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Movil">
								<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 800 x 800px </p>
							</center>
		    				<div class="input-group espacios">
			                    <span class="input-group-addon">Titulo</span>
			                    <input type="text" id="titulo" name="titulo" data-validate="false" class="form-control" placeholder="Ingresa el titulo..." value="">
			                </div>
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Link</span>
			                    <input type="text" id="link" name="link" data-validate="false" class="form-control" placeholder="Ingresa el link..." value="">
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
        <script>
			function Activar(id){
				$.ajaxSetup({ cache: false });
				$.ajax({
					async:true,
					type: "POST",
					dataType: "html",
					contentType: "application/x-www-form-urlencoded",
					url:"operaciones.php",
					data:"id="+id+"&operaciones=activacodigo",
					success:function(data){
							$("#temp"+id).attr("src", "img/visible.png");
							$("#temp"+id).attr("onclick", "Desactivar("+id+")");
							$("#temp"+id).tooltip('hide');
							$("#temp"+id).data('bs.tooltip').options.title = 'Ocultar';
							$("#temp"+id).tooltip('show');
					},
					cache:false
				});
			}

			function Desactivar(id){
				$.ajaxSetup({ cache: false });
				$.ajax({
					async:true,
					type: "POST",
					dataType: "html",
					contentType: "application/x-www-form-urlencoded",
					url:"operaciones.php",
					data:"id="+id+"&operaciones=desactivacodigo",
					success:function(data){
						$("#temp"+id).attr("src", "img/invisible.png");
						$("#temp"+id).attr("onclick", "Activar("+id+")");
						$("#temp"+id).tooltip('hide');
						$("#temp"+id).data('bs.tooltip').options.title = 'Mostrar';
						$("#temp"+id).tooltip('show');
					},
					cache:false
				});
			}
		</script>
	</footer>
</html>
