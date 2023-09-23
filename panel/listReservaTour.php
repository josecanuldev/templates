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

$clave2='ElimResT';

// Listado de reservaciones paginada.
// número de registros por página.
$num_rows_per_page = isset($_GET['rows']) ? $_GET['rows'] : 10;
// obtener resarvaciones paginadas.
$reservation = new reservatour();
$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$total_rows = $reservation -> getReservationsCount();
$total_pages = ceil($total_rows / $num_rows_per_page);
$reservations = $reservation -> getReservationsPaged($page, $num_rows_per_page);

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<?php include 'path.php';?>
		<title>Lista | Reservaciones</title>
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
	                        <p class="titulo">Reservaciones <?= NAMEWEB ?></p>
	                    </div>
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                    	<form action="formularioUbicacionInicio.php" method="post">

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

		                        	</div>
		                        </div>
		                        <div class="col-md-6 col-xs-12 col-md-pull-6">
		                            <ul class="ulfiltros">
		                                <li class="lifiltros">
		                                    <div class="styled-select">
		                                        <select name="operador">
		                                            <option value="Eliminar" class="styled" <?php if ($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2)==0) echo ' disabled ';?>>Eliminar</option>
		                                       </select>
		                                    </div>
		                                </li>
		                                <li class="lifiltros">
		                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operareservatour">Aplicar</button>
		                                </li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="clearfix"></div>
		                    <!--Seccion de la tabla-->
		                    <div class="col-md-12 col-xs-12">
		                        <div class="table-responsive">
			                        <table id="table-short" class="table table-hover table-striped tablesorter">
                                        <thead class="styled-thead">
                                          <tr>
                                            <th width="50">
                                                <input type="checkbox" id="marcar" name="marcar" onclick="marcartodos(this);" value="marcar">
                                                <label for="marcar"><span></span></label>
                                            </th>
                                            <th>Folio <i class="fa fa-sort"></i></th>
                                            <th>Nombre <i class="fa fa-sort"></i></th>
                                            <th class="text-center visible-lg visible-md">Fecha <i class="fa fa-sort"></i></th>
                                            <th class="text-center visible-lg visible-md">Concepto <i class="fa fa-sort"></i></th>
                                            <th class="text-center visible-lg visible-md">Status</th>
                                          </tr>
                                        </thead>
                                        <tbody class="styled-tbody" id="sortable">
                            <?php
                                foreach ($reservations as $elemento) {
                                  if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0){
                                                if($elemento['status']!=0){
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
                                                if($elemento['status']!=0){
                                                    $img='img/visible.png';
                                                    $funcion='Desactivar('.$elemento['idreservaTransporte'].')';
                                                    $class = 'nover';
                                                }
                                                else{
                                                    $img='img/invisible.png';
                                                    $funcion='Activar('.$elemento['idreservaTransporte'].')';
                                                    $class = 'ver';
                                               }
                                            }

											 $con= new conexion;
											 $status=0;
											 $sql = "select * from ordenreserva where idreserva='".$elemento['idreserva']."'";
											 $resultados = $con -> ejecutar_sentencia($sql);
											 while ($fila = mysqli_fetch_array($resultados)) {
                       $folioOrden=$fila['idorden'];
											 $status=$fila['status'];
                       $tipoOrden=$fila['tipo'];
											 }

											if($status == 0){
											  $label = '<span class="label label-default">Incompleto</span>';
											}
											if($status == 1){
											  $label = '<span class="label label-danger">Cancelado</span>';
											}
											if($status == 2){
											  $label = '<span class="label label-warning">Pendiente</span>';
											}
											if($status == 3){
											  $label = '<span class="label label-success">Pagado</span>';
											}

                      $tipoPrivado="";
                      if($tipoOrden==2){
                        $experiencia=new experiencia($elemento['idExperiencia']);
                        $experiencia->obtenerExperiencia();
                        if($experiencia->seccion=="ServicioPremium"){
                          $tipoPrivado='(Servicio Premium)';
                          $prefix="Privpre";
                        }
                        else{
                          $tipoPrivado='(Servicio Estándar)';
                          $prefix="Privstan";
                        }

                      }
                      else{
                        $prefix="Shut";
                      }

                      $folio=sprintf('%04d',$folioOrden);

                      if($elemento['inverso']=="true"){
                        $salidaText="de salida";
                      }else{
                        $salidaText="";
                      }

                                    echo  '<tr>
                                            <td>
                                              <input type="hidden" name="idreserva" class="idorden" value="'.$elemento['idreserva'].'">
                                                <input type="checkbox" id="'.$elemento['idreserva'].'" name="id[]" value="'.$elemento['idreserva'].'">
                                                <label for="'.$elemento['idreserva'].'"><span></span></label>
                                            </td>
                                            <td><a href="formReservaTour.php?idreserva='.$elemento['idreserva'].'">'.$prefix.'-'.$folio.'</a></td>
                                            <td><a href="formReservaTour.php?idreserva='.$elemento['idreserva'].'">'.$elemento['nombre'].' '.$elemento['apellido'].'</a></td>
                                            <td class="text-center visible-lg visible-md">'.date('d/m/Y', strtotime($elemento['fechaReservacion'])).'</td>
                                            <td class="text-center visible-lg visible-md">'.$elemento['concepto'].' '.$tipoPrivado.' '.$salidaText.'</td>
                                            <td class="text-center visible-lg visible-md">'.$label.'</td>
                                          </tr>';
                                }
                            ?>
                                        </form>
                                        </tbody>
                                        <tfoot class="styled-tfoot">
                                          <tr>
                                            <th>
                                                <input type="checkbox" id="marcar2" name="marcar2" onclick="marcartodos(this);" value="marcar2">
                                                <label for="marcar2"><span></span></label>
                                            </th>
                                            <th>Folio <i class="fa fa-sort"></i></th>
                                            <th>Nombre <i class="fa fa-sort"></i></th>
                                            <th class="text-center visible-lg visible-md">Fecha <i class="fa fa-sort"></i></th>
                                            <th class="text-center visible-lg visible-md">Concepto <i class="fa fa-sort"></i></th>
                                            <th class="text-center visible-lg visible-md">Status</th>
                                          </tr>
                                        </tfoot>
                                      </table>
			                       	<!-- pager -->
		                            <?php if ($total_pages > 0): ?>
			                            <div class="pagination-details">
			                            	<?php
												$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
			                            		echo 'Total de reservaciónes: '. $total_rows .'.';
			                            		echo '<br> Total de páginas: '. $total_pages .'.';
			                            		echo '<br> Página actual: '. $page .'.';
			                            	?>
			                            </div>
																	<ul class="pagination-transfe6">
																		<?php if ($page == 1): ?>
																			<li class="prev">
																				<a class="disabled" href="listReservaTour.php?page=<?php echo $page-1 ?>">
																					Ant
																				</a>
																			</li>
																		<?php endif; ?>

																		<?php if ($page != 1): ?>
																			<li class="prev">
																				<a href="listReservaTour.php?page=<?php echo $page-1 ?>">
																					Ant
																				</a>
																			</li>
																		<?php endif; ?>

																		<?php if ($page > 3): ?>
																			<li class="start">
																				<a href="listReservaTour.php?page=1">1</a>
																			</li>
																			<li class="dots">...</li>
																		<?php endif; ?>

																		<?php if ($page-2 > 0): ?>
																			<li class="page">
																				<a href="listReservaTour.php?page=<?php echo $page-2 ?>">
																					<?php echo $page-2 ?>
																				</a>
																			</li>
																		<?php endif; ?>
																		<?php if ($page-1 > 0): ?>
																			<li class="page">
																				<a href="listReservaTour.php?page=<?php echo $page-1 ?>">
																					<?php echo $page-1 ?>
																				</a>
																			</li>
																		<?php endif; ?>

																		<li class="currentpage">
																			<a href="listReservaTour.php?page=<?php echo $page ?>">
																				<?php echo $page; ?>
																			</a>
																		</li>

																		<?php if ($page+1 < $total_pages+1): ?>
																			<li class="page">
																				<a href="listReservaTour.php?page=<?php echo $page+1 ?>">
																					<?php echo $page+1 ?>
																				</a>
																			</li>
																		<?php endif; ?>
																		<?php if ($page+2 < $total_pages+1): ?>
																			<li class="page">
																				<a href="listReservaTour.php?page=<?php echo $page+2 ?>">
																					<?php echo $page+2 ?>
																				</a>
																			</li>
																		<?php endif; ?>

																		<?php if ($page < $total_pages-2): ?>
																			<li class="dots">...</li>
																			<li class="end">
																				<a href="listReservaTour.php?page=<?php echo $total_pages ?>">
																					<?php echo $total_pages ?>
																				</a>
																			</li>
																		<?php endif; ?>

																		<?php if ($page < $total_pages): ?>
																			<li class="next">
																				<a href="listReservaTour.php?page=<?php echo $page+1 ?>">
																					Sig
																				</a>
																			</li>
																		<?php endif; ?>

																		<span class="paginationtextfield"> Número de registros:</span>&nbsp;
																		<select onchange="setRowsPerPage(this)" id="num_rows" name="num_rows">
																				<?php
																				$numrows_arr = array("10","25","50","100","250");
																				foreach($numrows_arr as $nrow){
																						if(isset($_GET['rows']) && $_GET['rows'] == $nrow){
																								echo '<option value="'.$nrow.'" selected="selected">'.$nrow.'</option>';
																						}else{
																								echo '<option value="'.$nrow.'">'.$nrow.'</option>';
																						}
																				}
																				?>
																		</select>
																	</ul>
																<?php endif; ?>
			                    </div>
		                	</div><!--Div de cierre de la clase table-responsive-->
                    	</form>
            		</div>
            	</div>
	        </div>
	    </div>
			<script>
				function setRowsPerPage(select) {
					let tempUrl = window.location.href;
					let url = "";
					const rows = select.options[select.selectedIndex].value;
					if (tempUrl.indexOf('&') === -1) {
						url = tempUrl + '&rows=' + rows;
					} else {
						url = tempUrl.substring(0, tempUrl.length - 2) + rows;
					}
					location.replace(url);
				}
			</script>
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
	</footer>
</html>
