<?php
function __autoload($nombre_clase) {
    //$nombre_clase = strtolower($nombre_clase);
    include 'clases/'.$nombre_clase .'.php';
}
	$seguridad = new seguridad();
	$seguridad->candado();
	
	$operacion = 'modificarsettingsEmail';
	$palabra = 'Configurar Email';
	$temporal = new settingsEmail();
	$temporal -> obtener_settingsEmail();
	$clave = 'ModSE';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
         <?php include 'head.php';?>
        <title>Formulario | Email</title>
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
                        <!--Seccion del titulo y el boton de agregar-->
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <p class="titulo"><?php echo $palabra;?></p>
                        </div>
                        <form id="form-validation" action="operaciones.php" method="post" name="form1" onsubmit="">
                            <input type="hidden" name="operaciones" value="<?=$operacion?>">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">                               
                                <button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?>  class="buttonguardar">Guardar y Publicar</button>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <hr class="hrmenu">
                                <div class='notifications top-right'></div>
                                <div class='notifications bottom-right'></div>
                            </div>
                            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                                <!-- <div id="msghost" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-server"></i>Host</span>
                                    <input type="text"  name="host" class="form-control" placeholder="Ingrese el host aquí" value="<?=$temporal->host?>">
                                </div> -->
                                <div id="msgnoReply" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-server"></i>Correo Emisor</span>
                                    <input type="text"  name="noReply" class="form-control" placeholder="Ingrese el correo aquí" value="<?=$temporal->noReply?>">
                                </div>
                                <div id="msgfromname" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-server"></i>Nombre Emisor</span>
                                    <input type="text"  name="fromname" class="form-control" placeholder="Ingrese el nombre aquí, ej: Empresa " value="<?=$temporal->fromname?>">
                                </div>
                                <div id="msgport" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-server"></i>Port</span>
                                    <input type="text"  name="port" class="form-control" placeholder="Ingrese el puerto aquí" value="<?=$temporal->port?>">
                                </div>                        
                                <!-- <div id="msgusername" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-server"></i>Usuario</span>
                                    <input type="text"  name="username" class="form-control" placeholder="Ingrese el usuario aquí" value="<?=$temporal->username?>">
                                </div> -->
                                <div id="msgpassword" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-server"></i>Contraseña</span>
                                    <input type="password"  name="password" class="form-control" placeholder="Ingrese el password aquí" value="<?=$temporal->password?>">
                                </div>
                                <div id="msgaddCC"  class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-server"></i>Copia a</span> 
                                    <input type="text" name="addCC" id="tags"  placeholder="Ingrese los correos aquí, separe con una ','" value="<?=$temporal->addCC?>">                           
                                </div>
                               
                                <!-- <center>
                                    <div  data-toggle="modal" data-target="#myModal" class="btn btn-warning">Test Correo</div>
                                </center> -->
                                <!-- </br> -->
                            </div>
                            <div class="clearfix"></div>                    
                            <!--Este div contiene la barra inferior-->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <hr class="hrmenu">
                            </div>
                            <!--Este div contiene al boton inferior-->
                            <div class="clearfix"></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                               <button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?>  class="buttonguardar">Guardar y Publicar</button>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">PRUEBA CORREOS</h4>
              </div>
              <div class="modal-body">
                <div id="msgCorreoPrueba" class="input-group espacios">
                    <span class="input-group-addon es"><i class="fa fa-server"></i>Correo Prueba</span>
                    <input type="email" id="correoPrueba"  name="correoPrueba" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="sendCorreo">Enviar</button>
              </div>
            </div>
          </div>
        </div>        
    </body>
    <footer id="footer">
        <?php include 'footer.php';?>
        <script type="text/javascript" src="js/tags/jquery.tagsinput.js"></script>
        <script src="js/functionsConfEmail.js"></script>
    </footer>
</html>