<?php
	include_once('clases/contacto.php');
	include_once('clases/seguridad.php');
	$seguridad = new seguridad();
	$seguridad->candado();
	
	$operacion = 'modificarotraconfiguracion';
	$palabra = 'Editar Configuración del sitio';
	$temporal = new contacto();
	$temporal->obtenerConfiguracion();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include 'head.php';?>
        <title>Formulario | Otras Configuraciones</title>
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
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <p class="titulo"><?php echo $palabra;?></p>
                        </div>
                        <form id="form-validation" action="operaciones.php" method="post" name="form1" onsubmit="return validar_campos()">
                            <input type="hidden" name="operaciones" value="<?=$operacion?>">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">                            
                                <input type="hidden" name="idcontacto" value="<?php echo $temporal->idcontacto ?>"/>
                                <button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?>  class="buttonguardar">Guardar y Publicar</button>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <hr class="hrmenu">
                                <div class='notifications top-right'></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 espacios">
                                <div class="input-group espacios">
		                        	<span class="input-group-addon es">Seleccione el modo del sitio</span>
		                        	<select name="modoSitio" id="modoSitio" class="form-control">
                                    	<?php
									    $m1 = '';
									    $m2 = '';
										
										   if($temporal->modoSitio == 0)
											 $m1 = ' selected';
										   if ($temporal->modoSitio == 1)
											 $m2 = ' selected';
	                        			?>
                                        <option value="0" <?=$m1?>>Modo Catálogo</option>
                                        <option value="1" <?=$m2?>>Modo Tienda en Línea</option>                
		                            </select>
		                        </div>
                            </div><!--Div de cierre col-lg-7-->
                                            
                            <div class="clearfix"></div>                    
                            <!--Este div contiene la barra inferior-->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <hr class="hrmenu">
                            </div>
                            <!--Este div contiene al boton inferior-->
                            <div class="clearfix"></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?php echo $operacion; ?>" class="buttonguardar">Guardar y Publicar</button>                                
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
        </div>
    </body>
     <footer id="footer">
        <?php include 'footer.php';?>
        <script src="js/functionsConfEmail.js"></script>
    </footer>
</html>