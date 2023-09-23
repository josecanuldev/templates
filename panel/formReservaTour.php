<?php
function __autoload($ClassName) {
    include('clases/'.$ClassName.".php");
}

$herramientas = new herramientas();
$seguridad    = new seguridad();
$seguridad -> candado();

$id=$_REQUEST['idreserva'];
$palabra='Reservaciones';
$temporal = new reservatour($id);
$temporal -> obtenerReservaTour();
$orden=new ordenreserva(0,$id);
$orden->obtenerOrdenReserva();

if($temporal->idioma=='en'){
  $moneda='USD';
}
else{
  $moneda='MXN';
}

if($temporal->tipoPrivadoEstandar=="estandar"){
  $tipoPrivadoEstandar="Chiquilá";
  $prefix="Privstan";
}elseif($temporal->tipoPrivadoEstandar=="premium"){
  $tipoPrivadoEstandar="Isla Holbox";
  $prefix="Privpre";
}else{
  $prefix="Shut";
}

if($orden->idCodigoPromo != 0){
  $codigoPromo=new codigo($orden->idCodigoPromo);
  $codigoPromo->obtenercodigo();
  $numeroCodigo=$codigoPromo->codigo;
  $partCodigo='(Código de promoción:'.$numeroCodigo.')';
}


?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Formulario | Reservaciones</title>
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
            			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                		<?=$alert?>
	                		<div class='notifications bottom-right'></div>
	                	</div>
            			<!--Seccion del titulo -->
            			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	                        <p class="titulo"><?=$palabra?></p>
	                    </div>
	                    <form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post">
                    		<input type="hidden" name="operaciones" value="<?=$operacion?>">
                    		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                   			</div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<hr class="hrmenu">
		                    </div>
		                    <div class="clearfix"></div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<div class='notifications top-right'></div>
		                    </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <div class="input-group espacios" >
                                    <span class="input-group-addon es">Folio</span>
                                    <input  type="text"  class="form-control" id="folio" name="folio" value="<?=$prefix?>-<?=sprintf('%04d',$orden->idorden);?>" readonly>
                                </div>
                            	<div class="input-group espacios" >
                                    <span class="input-group-addon es">Fecha de Reservación</span>
                                    <input  type="text"  class="form-control" id="fechares" name="fechares" value="<?=date('d/m/Y', strtotime($temporal->fechaReservacion))?>" readonly>
                                </div>
                                 <div class="input-group espacios" >
                                    <span class="input-group-addon es">Nombre</span>
                                    <input  type="text" class="form-control" id="nombre" name="nombre" value="<?=$temporal->nombre?> <?=$temporal->apellido?>" readonly>
                                </div>
                                <div class="input-group espacios" >
                                   <span class="input-group-addon es">Correo</span>
                                   <input  type="text" class="form-control" id="email" name="email" value="<?=$temporal->correo?>" readonly>
                               </div>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">Teléfono</span>
                                    <input  type="text" class="form-control" id="telefono" name="telefono" value="<?=$temporal->telefono?>" readonly>
                               </div>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">País</span>
                                    <input  type="text" class="form-control" id="pais" name="pais" value="<?=$temporal->pais?>" readonly>
                               </div>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">Ciudad</span>
                                    <input  type="text" class="form-control" id="ciudad" name="ciudad" value="<?=$temporal->ciudad?>" readonly>
                               </div>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">Pasajeros</span>
                                    <input  type="text" class="form-control" id="pasajeros" name="pasajeros" value="<?=$temporal->pasajeros?>" readonly>
                               </div>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">Tipo de viaje</span>
                                    <input  type="text" class="form-control" id="tipoViaje" name="tipoViaje" value="<?=$temporal->tipoViaje?>" readonly>
                               </div>
                               <?php
                               if($temporal->fechaLLegada != ""){
                               ?>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">Fecha de llegada</span>
                                    <input  type="text" class="form-control" id="fechaLLegada" name="fechaLLegada" value="<?=date('d/m/Y', strtotime($temporal->fechaLLegada))?>" readonly>
                               </div>
                               <?php } ?>
                               <?php
                               if($temporal->horarioLLegada != ""){
                               ?>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">Horario de llegada</span>
                                    <input  type="text" class="form-control" id="horarioLLegada" name="horarioLLegada" value="<?=$temporal->horarioLLegada?>" readonly>
                               </div>
                               <?php } ?>
                               <?php
                               if($temporal->fechaSalida != ""){
                               ?>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">Fecha de Salida</span>
                                    <input  type="text" class="form-control" id="fechaSalida" name="fechaSalida" value="<?=date('d/m/Y', strtotime($temporal->fechaSalida))?>" readonly>
                               </div>
                               <?php } ?>
                               <?php
                               if($temporal->horarioSalida != ""){
                               ?>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">Horario de Salida</span>
                                    <input  type="text" class="form-control" id="horarioSalida" name="horarioSalida" value="<?=$temporal->horarioSalida?>" readonly>
                               </div>
                               <?php } ?>

                               <?php
                               if($temporal->aerolinea != ""){
                               ?>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">Aerolínea</span>
                                    <input  type="text" class="form-control" id="aerolinea" name="aerolinea" value="<?=$temporal->aerolinea?>" readonly>
                               </div>
                               <?php } ?>
                               <?php
                               if($temporal->numeroVuelo != ""){
                               ?>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">Número de vuelo</span>
                                    <input  type="text" class="form-control" id="numeroVuelo" name="numeroVuelo" value="<?=$temporal->numeroVuelo?>" readonly>
                               </div>
                               <?php } ?>
                               <?php
                               if($temporal->datePrivada != ""){
                               ?>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">Fecha</span>
                                    <input  type="text" class="form-control" id="datePrivada" name="datePrivada" value="<?=$temporal->datePrivada?>" readonly>
                               </div>
                               <?php } ?>
                               <?php
                               if($temporal->horaPrivada != ""){
                               ?>
                               <div class="input-group espacios" >
                                 <?php
                                 if($temporal->idExperiencia==91 && $temporal->tipoViaje=='Redondo'){
                                 ?>
                                   <span class="input-group-addon es">Hora de salida del vuelo</span>
                                 <?php } elseif($temporal->idExperiencia==102 && $temporal->tipoViaje=='Redondo'){ ?>
                                   <span class="input-group-addon es">Hora de salida del vuelo</span>
                                 <?php } elseif($temporal->idExperiencia==91 && $temporal->inverso=="true"){?>
                                   <span class="input-group-addon es">Hora de salida del vuelo</span>
                                 <?php } elseif($temporal->idExperiencia==102 && $temporal->inverso=="true"){ ?>
                                   <span class="input-group-addon es">Hora de salida del vuelo</span>
                                 <?php } else{ ?>
                                   <span class="input-group-addon es">Hora de llegada del vuelo</span>
                                 <?php } ?>

                                    <input  type="text" class="form-control" id="horaPrivada" name="horaPrivada" value="<?=$temporal->horaPrivada?>" readonly>
                               </div>
                               <?php } ?>
                               <?php
                               if($temporal->abordaje != ""){
                               ?>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">Lugar del abordaje del traslado</span>
                                    <input  type="text" class="form-control" id="abordaje" name="abordaje" value="<?=$temporal->abordaje?>" readonly>
                               </div>
                               <?php } ?>
                               <?php
                               if($temporal->tipoVuelo != ""){
                               ?>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">Tipo de vuelo</span>
                                    <input  type="text" class="form-control" id="tipoVuelo" name="tipoVuelo" value="<?=$temporal->tipoVuelo?>" readonly>
                               </div>
                               <?php } ?>
                               <?php
                               if($temporal->hotel != ""){
                               ?>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">Hotel de llegada</span>
                                    <input  type="text" class="form-control" id="hotel" name="hotel" value="<?=$temporal->hotel?>" readonly>
                               </div>
                               <?php } ?>
                               <?php
                               if($temporal->hotelSalida != ""){
                               ?>
                               <div class="input-group espacios" >
                                    <span class="input-group-addon es">Hotel de salida</span>
                                    <input  type="text" class="form-control" id="hotelS" name="hotelS" value="<?=$temporal->hotelSalida?>" readonly>
                               </div>
                               <?php } ?>

                            </div><!--Div de cierre col-lg-6-->
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <?php
                              $tipoPrivado="";
                              if($orden->tipo==2){
                                $experiencia=new experiencia($temporal->idExperiencia);
                                $experiencia->obtenerExperiencia();
                                if($experiencia->seccion=="ServicioPremium"){
                                  $tipoPrivado='(Servicio Premium)';
                                }
                                else{
                                  $tipoPrivado='(Servicio Estándar)';
                                }

                                if($temporal->inverso=="true"){
                                  $desdeHasta=$tipoPrivadoEstandar.' - '.$temporal->desde.' - Salida';
                                }else{
                                  $desdeHasta=$temporal->desde.' - '.$tipoPrivadoEstandar;
                                }



                              }
                              else{
                                if($temporal->desde=="Aeropuerto Cancún"){
                                  $desdeHasta="Aeropuerto Cancún - Chiquilá";
                                }
                                else{
                                  $desdeHasta="Chiquilá - Aeropuerto Cancún";
                                }
                              }
                              ?>
                            <br />
                             <span class="textHelper"><b>DETALLE DE LA RESERVA:</b> </span>
                             <br />
                                <div id="msgTipoVehiculo" class="input-group espacios" >
                                    <?=htmlspecialchars_decode($temporal->concepto)?> <?=$tipoPrivado?> <b><?=$desdeHasta?></b>
                                </div>
                                <div id="msgTipoVehiculo" class="input-group espacios" >
                                    <span class="input-group-addon es">Subtotal $</span>
                                    <input  type="text" class="form-control" id="subtotal" name="subtotal" value="<?=number_format($orden->subtotal, 2, '.', ',')?>" readonly>
                                </div>
                                <div id="msgTipoVehiculo" class="input-group espacios" >
                                    <span class="input-group-addon es">- Descuento $</span>
                                    <input  type="text" class="form-control" id="discount" name="discount" value="<?=number_format($orden->descuento, 2, '.', ',')?> <?=$partCodigo?>" readonly>
                                </div>
                                <!--<div id="msgTipoVehiculo" class="input-group espacios" >
                                    <span class="input-group-addon es">Cargo de Paypal</span>
                                    <input  type="text" class="form-control" id="paypal" name="paypal" value="4%" readonly>
                                </div>-->

                                <div id="msgTipoVehiculo" class="input-group espacios" >
                                    <span class="input-group-addon es">Total $</span>
                                    <input  type="text" class="form-control" id="total" name="total" value="<?=number_format($orden->total, 2, '.', ',')?> <?=$moneda?>" readonly>
                                </div>


                                    <span class="textHelper"><b>Status:</b> </span>
                                    <?php

                                        if($orden->status == 0)
                                          $label = '<span class="label label-danger">Incompleto</span></br>';

                                        if($orden->status == 1)
                                          $label = '<span class="label label-danger">Cancelado</span></br>';

                                        if($orden->status == 2)
                                          $label = '<span class="label label-warning">Pendiente</span></br>';

                                        if($orden->status == 3)
                                          $label = '<span class="label label-success">Pagado</span></br>';
                                ?>
                                <?php echo $label; ?>
                                </div>

		                    <div class="clearfix"></div>
		                    <!--Este div contiene la barra inferior-->
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<hr class="hrmenu">
		                    </div>
		                    <div class="clearfix"></div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

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
