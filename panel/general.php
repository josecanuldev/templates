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

// $temporal      = new experiencia();
// $listaTemporal = $temporal -> listaExperiencia(1, true, '', 'ServicioPremium');
// print_r($listaTemporal);
// exit;

$clave  = 'p_add_precios';
$clave2 = 'p_del_precios';
$clave3 = 'p_acdc_precios';
$clave4 = 'p_sort_precios';
$clave5 = 'p_mod_precios';
$sort   = "precios";
$handle = "";

if ($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave4)==0) {
	$handle  = "";
	$permiso = "<input type='hidden' id='valorpermiso' name='permiso' value='0'>";
} else {
	$handle  = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>';
	$permiso = "<input type='hidden' id='valorpermiso' name='permiso' value='1'>";
}
$permisoAcDc = ($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) ? 0 : 1;
//variable global para el paginador;
$opera_list = 'listarExperiencia';
// $_lastPage  = count($listaTemporal)-1;
// $_de        = $listaTemporal[$_lastPage]['orden'];

/** emex vars */
$config = new general();
$config->getPassengersLimit();
// echo ''.print_r($config);
// $config['passengersLimit'] = 16;
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Configuración general</title>
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
	                        <p class="titulo">Configuración general</p>
	                    </div>
	                    <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                    	<form action="formularioServicioPremium.php" method="post">
	                    		<button type="submit" <?php if ($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="buttonagregar">Agregar Nuevo</button>
	                        </form>
	                    </div> -->
	                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                    	<hr class="hrmenu">
	                    </div>
	                    <div class="clearfix"></div>

                      <div class="container-fluid pt-3">
											<br>
                        <button class="btn btn-info btn-block mt-5" data-toggle="collapse" data-target="#collapse-content">
                          Límite de pasajeros
                        </button>

                        <div class="collapse well" id="collapse-content">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="panel panel-default">
                                <div class="panel-heading">
                                  <h3 class="panel-title">Límite de pasajeros</h3>
                                </div>
                                <div class="panel-body">
                                  <div class="row">
                                    <div class="col-md-12 col-12">
                                      <form method="post"  action="operaciones.php">
                                        <div class="form-group">
                                          <div class="input-group">
                                          <span class="input-group-addon">Límite</span>
                                          <input type="text" name="passengers" data-validate="false" class="form-control" placeholder="Límite de pasajeros" value="<?=$config->passengersLimit?>">
                                          </div>
                                        </div>
                                        <div class="form-group text-right">
                                          <button type="submit" class="btn btn-success" name="operaciones" value="setPassengersLimit">
                                            Actualizar
                                          </button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
            		</div>
            	</div>
	        </div>
	    </div>
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
		<!-- <script src="js/functionsExperiencia.js"></script> -->
	</footer>
</html>
