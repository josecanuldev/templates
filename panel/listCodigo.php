<?php
function __autoload($nombre_clase) {
    include 'clases/'.$nombre_clase .'.php';
}
$seguridad = new seguridad();
$seguridad->candado();
if(isset($_REQUEST['success'])){
	$success = $_REQUEST['success'];
	switch($success){
		case '0':
			$alert = '<div class="alert alert-danger alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡UPS!</strong> No selecciono ningún elemento.
					  </div>';
		break;
		case '1':
			$alert = '<div class="alert alert-success alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡MUY BIEN!</strong> Se ha creado correctamente este código.
					  </div>';
		break;
		case '2':
			$alert = '<div class="alert alert-success alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡MUY BIEN!</strong> Se ha modificado correctamente este código.
					  </div>';
		break;
		case '3':
			$alert = '<div class="alert alert-info alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡MUY BIEN!</strong> Se ha eliminado correctamente este(os) código(s).
					  </div>';
		break;
		case '4':
			$alert = '<div class="alert alert-info alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡MUY BIEN!</strong> Se ha activado correctamente este(os) código(s).
					  </div>';
		break;
		case '5':
			$alert = '<div class="alert alert-warning alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡MUY BIEN!</strong> Se ha desactivado correctamente este(os) código(s), cuando desactivan elementos, éstos no se muestran en la parte principal de la página.
					  </div>';
		break;
	}
}
else{
	$success = '';
	$alert = '';
}
$temporal = new codigo();
$listaTemporal = $temporal -> listarcodigo();
$clave='AgrCodigo';
$clave2='ElimCodigo';
$clave3='AcDcCodigo';
?>
<?php
include('head.html');//Contiene los estilos y los metas.
?>
	<title>Listado de los códigos de descuento</title>
<?php
include('header.html');//contiene las barras de arriba y los menus.
include('menu.php');
?>


        <!-- Page content Sección del contenido de la pagina-->
        <div id="page-content-wrapper">

            <!-- Keep all page content within the page-content inset div! -->
            <div class="page-content inset">
                <div class="row rowedit">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                		<?=$alert?>
                	</div>
                  <div class='notifications bottom-right'></div>
                	<!--Seccion del titulo y el boton de agregar-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <p class="titulo">Códigos de descuento</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    	<form action="formCodigo.php" method="post">
                    		<button <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="buttonagregar">Agregar Nuevo</button>
                        </form>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<hr class="hrmenu">
                    </div>
                    <div class="clearfix"></div>
                    <!--Sección para realizar cambios Nota: el div con la clase styled-large es la que se visualiza con lg y md-->
                    <form method="post" action="operaciones.php">
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
                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operacodigo">Aplicar</button>
                                </li>
                            </ul>
                            <div class="busqueda espacios"><input type="search" data-column="all" class="form-control searchSlide" placeholder="Buscar..." id="searchSlide"/></div>
                        </div>
                    </div><!--Cierra el div class styled-large-->
     				<div class="clearfix"></div>
                    <!--Esta sección es para la version movil-->
                    <div class="styled-small">
                    	<div class="col-sm-12 col-xs-12">
                        	<div class="busqueda"><input type="search" data-column="all" class="form-control search" placeholder="Buscar..."/></div>
                        </div>
                    	<div class="col-sm-12 col-xs-12">
                            <ul class="ulfiltros">
                                <li class="lifiltros">
                                    <div class="styled-select">
                                        <select>
                                          <option class="styled" >Eliminar</option>
                                          <option class="styled" >Mostrar</option>
                                          <option class="styled" >No Mostrar</option>
                                       </select>
                                    </div>
                                </li>
                                <li class="lifiltros">
                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operacodigo">Aplicar</button>
                                </li>
                            </ul>
                        </div>
                    </div><!--Cierra el div class styled-small-->
                    <div class="clearfix"></div>
                    <!--Seccion de la tabla-->
                    <div class="col-lg-12">
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
                                <th>Código Aplicable</th>
                                <th class="text-center visible-lg visible-md">Mostrar</th>
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
                                <td><a href="formCodigo.php?idCodigo='.$elementoTemporal['idCodigo'].'">'.$elementoTemporal['codigo'].'</a></td>
                                <td>'.date('d/m/Y', strtotime($elementoTemporal['fechaInicio'])).'</td>
                                <td>'.date('d/m/Y', strtotime($elementoTemporal['fechaTermino'])).'</td>
								<td>'.$tipoDescuento.'</td>
								<td>'.$tipoCodigo.'</td>
                                <td class="text-center visible-lg visible-md">'.$handle.'<img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idCodigo'].'" src="'.$img.'"></td>
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
                                <th>Código<i class="fa fa-sort"></i></th>
                                <th>Fecha de inicio</th>
                                <th>Fecha de término</th>
                                <th>Tipo Descuento</th>
                                <th>Código Aplicable</th>
                                <th class="text-center visible-lg visible-md">Mostrar</th>
                              </tr>
                            </tfoot>
                          </table>
                          <div>
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
                    </div><!--Div de cierre que contiene las tablas-->
                    <!--Sección del pie de pagina-->
                </div><!--Div de cierre del row-->
            </div><!--Div de cierre de page-content inset-->
        </div><!--Div de cierre de page-content-wrapper-->
    </div><!--Div de cierre de id Wrapper-->
<footer id="footer">
  <?php include 'footer.php';?>
  <script src="js/functionsSlide.js"></script>
</footer>
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
<script>
$(function() {
    $('.ver').tooltip(
	{
		placement: "top",
        title: "Mostrar"
	});
	$('.nover').tooltip(
	{
		placement: "top",
        title: "Ocultar"
	});
});
</script>
</body>
</html>
