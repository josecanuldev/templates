<?php
function __autoload($nombre_clase) {
    include 'clases/'.$nombre_clase .'.php';
}
$seguridad = new seguridad();
$seguridad->candado();

$alert = '';

if(isset($_REQUEST['success'])) {
    $success = $_REQUEST['success'];
    $herramientas = new herramientas();
    $alert = $herramientas -> mensajesAlerta($success);
}

$operacion = 'updatePaginaInfo';
$palabra = 'Información de página';
$model = new pageInfo(1);
$temporal = $model->getPage();

$img = $temporal -> logo;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'head.php';?>
    <title>Formulario | Información de Página</title>
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
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p class="titulo"><?php echo $palabra;?></p>
                    </div>
                    <form id="form-validation" action="operaciones.php" method="post" name="form1" enctype="multipart/form-data">
                        <input type="hidden" name="operaciones" value="<?=$operacion?>">
                        <input type="hidden" name="id" value="<?=$temporal->id?>">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr class="hrmenu">
                        </div>                  
                        <div class="clearfix"></div>                
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class='notifications top-right'></div>
                            <div class='notifications bottom-right'></div>
                        </div>
                        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                            <!-- <p class="titulo">Información de página</p> -->
                            <div class="clearfix"></div> 
                            <div id="piNombre" class="input-group espacios">
                                <span class="input-group-addon es">Nombre *</span>
                                <input type="text"  name="nombre" class="form-control" placeholder="Ingrese el nombre de la página" value="<?=$temporal->nombre?>">
                            </div>
                            <div id="pUrl" class="input-group espacios">
                                <span class="input-group-addon es">URL *</span>
                                <input type="text"  name="url" class="form-control" placeholder="Ingrese la url de la página" value="<?=$temporal->url?>">
                            </div>
                            <div id="piWhatsapp1" class="input-group espacios">
                                <span class="input-group-addon es">WhatsApp *</span>
                                <input type="text"  name="whatsapp1" class="form-control" placeholder="Ingrese número de WhatsApp" value="<?=$temporal->whatsapp1?>">
                            </div>
                            <!-- <div id="piWhatsapp2" class="input-group espacios">
                                <span class="input-group-addon es">WhatsApp 2 (opcional)</span>
                                <input type="text"  name="whatsapp2" class="form-control" placeholder="Ingrese segundo número de WhatsApp" value="<?=$temporal->whatsapp1?>">
                            </div> -->
                            <div id="piCorreo1" class="input-group espacios">
                                <span class="input-group-addon es">Correo *</span>
                                <input type="text"  name="correo1" class="form-control" placeholder="Ingrese correo" value="<?=$temporal->correo1?>">
                            </div>
                            <div id="piCorreo2" class="input-group espacios">
                                <span class="input-group-addon es">Correo 2 (Opcional)</span>
                                <input type="text"  name="correo2" class="form-control" placeholder="Ingrese segundo correo" value="<?=$temporal->correo2?>">
                            </div>
                            <div id="piTelefono1" class="input-group espacios">
                                <span class="input-group-addon es">Teléfono *</span>
                                <input type="text"  name="telefono1" class="form-control" placeholder="Ingrese núm. de teléfono" value="<?=$temporal->telefono1?>">
                            </div>
                            <div id="piTelefono2" class="input-group espacios">
                                <span class="input-group-addon es">Teléfono 2 (Opcional)</span>
                                <input type="text"  name="telefono2" class="form-control" placeholder="Ingrese segundo núm. de teléfono" value="<?=$temporal->telefono2?>">
                            </div>
                            <div id="piFacebook" class="input-group espacios">
                                <span class="input-group-addon es">Facebook *</span>
                                <input type="text"  name="facebook" class="form-control" placeholder="Ingrese url de facebook" value="<?=$temporal->facebook?>">
                            </div>
                            <div id="piInstagram" class="hidden input-group espacios">
                                <span class="input-group-addon es">Instagram *</span>
                                <input type="hidden"  name="instagram" class="form-control" placeholder="Ingrese url de instagram" value="<?=$temporal->instagram?>">
                            </div>


                            <p class="titulo">Logo</p>
                            <div class="clearfix"></div> 
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mx-auto">
                                    <center>
                                        <span class="textHelper">Previsualizar Logo:</span>
                                        <br>
                                        <div id="ogPageLogo">
                                            <?php if($img != ''){ ?>
                                                <img width="100%" src="../img/imgPageInfo/<?=$img?>"/>
                                            <?php } ?>
                                        </div>
                                        <br>
                                        <center>                               
                                            <input id="filesLogoPage" onchange="showMyImage('ogPageLogo',this)" name="archivoLogoPage" type="file" class="upload"/>
                                        </center>
                                        <br>
                                        <div class="text-center textHelper">
                                            <p class="help-block">Solo se aceptan imágenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 8 MB. <br> La resolución óptima para esta imagen es de 220x205</p>
                                        </div>
                                        <br>
                                    </center>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xs-12">
                                    <button type="submit" class="buttonguardar btn-save" value="updatePortada">Guardar y Publicar</button>
                                </div>
                            </div>
                        </div>
                    </form>     
                </div>
            </div>
        </div>
    </div>
</body>
<footer id="footer">
    <?php include 'footer.php';?>
    <script type="text/javascript" src="js/tags/jquery.tagsinput.js"></script>
    <script src="js/functionsSEO.js"></script>
</footer>
</html>