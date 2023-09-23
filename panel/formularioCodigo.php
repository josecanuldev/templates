<?php
function __autoload($ClassName) {
    include('clases/'.$ClassName.".php");
}

$herramientas = new herramientas();
$seguridad    = new seguridad();
$seguridad -> candado();
if(isset($_REQUEST['idCodigo'])){
	$id=$_REQUEST['idCodigo'];
	$operacion='modificarcodigo';
	$palabra='Editar Código Descuento';
	$temporal = new codigo($id);
	$temporal -> obtenercodigo();
	$fechatemporal=$temporal->fechaInicio;
	$fechatemporal2=$temporal->fechaTermino;
	$valorTemporal=$temporal->codigoUsuario;
}
else{
	$id=0;
	$operacion='agregarcodigo';
	$palabra='Nuevo Código';
	$img='';
	$temporal = new codigo($id);
	$fechatemporal=date("Y-m-d");
	$fechatemporal2=date("Y-m-d");
	$valorTemporal=1;
}
$clave = 'ModCodigo';

if (isset($_REQUEST['success'])) {
	$success = $_REQUEST['success'];
	$alert   = $herramientas -> mensajesAlerta($success);
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Formulario Del Código de Descuento</title>
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
	                        <p class="titulo">Código de Descuento</p>
	                    </div>
	                    <form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post" enctype="multipart/form-data">
                    		<input type="hidden" name="idCodigo" value="<?=$temporal->idCodigo?>"/>        
                    		<input type="hidden" name="status" value="<?=$temporal->status?>"/>
                            <input type="hidden" name="operaciones" value="<?=$operacion?>">
                    		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    			<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?>  class="buttonguardar">Guardar</button>
                   			</div>
		                    <div class="clearfix"></div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<div class='notifications top-right'></div>
		                    </div>
		                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                                <div id="divCodigo" class="input-group espacios">
                                    <span class="input-group-addon es">Código</span>
                                    <input type="text"  name="codigo" class="form-control" id="codigo" placeholder="Ingrese el conjunto de caracteres para el código aquí..." value="<?=$temporal->codigo?>" data-validate="true">
                                </div>
                                <div id="divInicio" class="input-group espacios" >
                                    <span class="input-group-addon es">Fecha de Inicio</span>
                                    <input  type="text" placeholder="Click para seleccionar fecha" class="form-control" id="example1" name="fechaInicio" value="<?=date('d/m/Y', strtotime($fechatemporal))?>">
                                </div>
                                <div id="divTermino" class="input-group espacios" >
                                    <span class="input-group-addon es">Fecha de Término</span>
                                    <input  type="text" placeholder="Click para seleccionar fecha" class="form-control" id="example2" name="fechaTermino" value="<?=date('d/m/Y', strtotime($fechatemporal2))?>">
                                </div>
                                <div id="divCodigoUsuario" class="input-group espacios">
                                    <span class="input-group-addon es">Código por Usuario</span>
                                    <input type="number"  name="codigoUsuario" class="form-control" id="codigoUsuario" placeholder="Ingrese las veces que un mismo usuario puede usar el código..." value="<?=$valorTemporal?>">
                                </div>
                                <div id="divTipoDescuento" class="input-group espacios">
                                    <span class="input-group-addon es">Seleccione el tipo de descuento</span>
                                    <select name="tipoDescuento" id="tipoDescuento" class="form-control">
                                    <?php
                                             $porcentaje = '';
                                             $cantidad = '';
                                            
                                             if($temporal->tipoDescuento == 1)
                                                $porcentaje = ' selected';
                                             if ($temporal->tipoDescuento == 2)
                                                $cantidad = ' selected';
                                             
                                            ?>
                                    
                                    <option value="">---</option>
                                    <option value="1" <?=$porcentaje?>>Porcentaje</option>
                                    <option value="2" <?=$cantidad?>>Cantidad</option>
                                    </select>
                                </div>
                                <div id="divValor" class="input-group espacios">
                                    <span class="input-group-addon es">Valor del descuento</span>
                                    <input type="text"  name="valor" class="form-control" id="valor" placeholder="Ingrese el valor del descuento..." onkeyup="NumAndTwoDecimals();" value="<?=$temporal->valor?>" data-validate="true">
                                </div>
                                <div id="divTipoCodigo" class="input-group espacios" style="display:none">
                                    <span class="input-group-addon es">Este código es aplicable a</span>
                                    <select name="tipoCodigo" id="tipoCodigo" class="form-control">
                                    <?php
                                             $uno = '';
                                             $dos = '';
                                             $tres = '';
                                             $cuatro = '';
                                             $cinco = '';
                                             $seis = '';
                                             $siete = '';
                                             $ocho = '';
                                             $nueve = '';
                                             $diez = '';
                                            
                                            
                                             if($temporal->tipoCodigo == 1)
                                                $uno = ' selected';
                                             if($temporal->tipoCodigo == 2)
                                                $dos = ' selected';
                                             if($temporal->tipoCodigo == 3)
                                                $tres = ' selected';
                                             if($temporal->tipoCodigo == 4)
                                                $cuatro = ' selected';
                                             if($temporal->tipoCodigo == 5)
                                                $cinco = ' selected';
                                             if($temporal->tipoCodigo == 6)
                                                $seis = ' selected';
                                             if($temporal->tipoCodigo == 7)
                                                $siete = ' selected';
                                             if($temporal->tipoCodigo == 8)
                                                $ocho = ' selected';
                                             if($temporal->tipoCodigo == 9)
                                                $nueve = ' selected';
                                             if($temporal->tipoCodigo == 10)
                                                $diez = ' selected';			
                                             
                                             
                                            ?>
                                    
                                    <option value="1">---</option>
                                    <option value="1" <?=$uno?>>Venta Online (Tours)</option>
                                    <option value="9" <?=$nueve?>>Venta Online (Sport Fishing)</option>
                                    
                                    </select>
                                </div>
                                <div id="divLimite" class="input-group espacios">
                                    <span class="input-group-addon es">Límite de uso del código</span>
                                    <input type="number"  name="limite" class="form-control" id="limite" placeholder="Ingrese el máximo de veces que se puede usar el código..." value="<?=$temporal->limite?>">
                                </div>
                                <span class="textHelper">Ingrese la descripción del código de descuento aquí:</span>
                                <div>
                                <textarea name="descripcionEn" id="summernote" data-summer="true"><?=$temporal->descripcionEn?></textarea>
                                </div>
                                <br>             
                            </div>

		                    <div class="clearfix"></div>
		                    <!--Este div contiene la barra inferior-->
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<hr class="hrmenu">
		                    </div>
		                    <div class="clearfix"></div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?=$operacion?>" class="buttonguardar">Guardar</button>
		                    </div>
                    	</form>
	            		
            		</div>

            	</div>
	        </div>
    	</div>
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
        <link rel="stylesheet" href="css/calendario.css" />
		<script src="js/calendario.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                $('#example1').datepicker({
                    format: "dd/mm/yyyy",
                    language: 'es'
                });  
            
            });
            $(document).ready(function () {
                $('#example2').datepicker({
                    format: "dd/mm/yyyy",
                    language: 'es'
                });  
            
            });
			function NumAndTwoDecimals() {
				var val = $("#valor").val();
				var re = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;
				var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
				if (re.test(val)) {
					//console.log(val);
		
				} else {
					val = re1.exec(val);
					if (val) {
						$("#valor").val(val[0]);
					} else {
					   //$('#precio').after( "<span class='c_error' id='c_error_name'>Formato de precio no válido.</span>" );
					   $("#valor").focus();
					   $("#valor").val("");
					}
				}
			   }
        </script>
		
	</footer>
</html>	