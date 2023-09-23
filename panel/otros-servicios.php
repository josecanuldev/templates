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

$texto = "Banners";

$temporal = new banners();
$listaTemporal = $temporal -> listSlide(1, false, '', '', '', '', 0);

// echo "<textarea>".json_encode($listaTemporal)."</textarea>";

// $temporal = new slide();
// $listaTemporal = $temporal -> listSlide(1, false, '', '', '', '', $tipo);
$clave = 'p_add_home';
$clave2 = 'p_del_home';
$clave3 = 'p_acdc_home';
$clave4 = 'p_sort_home';
$clave5 = 'p_mod_home';
$sort = "slide";
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
$opera_list = 'listarBanner';
$_lastPage = count($listaTemporal)-1;
$_de = $listaTemporal[$_lastPage]['orden'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'head.php';?>
	<title>Lista | <?=$texto?></title>
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
						<p class="titulo"><?=$texto?></p>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<form action="formBanners.php" method="post">
							<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="buttonagregar">Agregar Nuevo</button>
						</form>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<hr class="hrmenu">
					</div>
					<div class="clearfix"></div>
					<!--Sección para realizar cambios Nota: el div con la clase styled-large es la que se visualiza con lg y md-->
					<form method="post" action="operaciones.php" id="form-cards">
						<input type="hidden" id="permisoAcDc" value="<?=$permisoAcDc?>">
						<input type="hidden" name="idBanner" id="idBanner" value="">
						<input type="hidden" name="operaciones" value="">
						<div class="clearfix"></div>
						<!--Seccion de la tabla-->
						<?php 
						foreach($listaTemporal as $elementoTemporal){ ?>
							<div class="col-lg-3 col-md-3 col-sm-6 mb-4" data-aos="fade-up" style="height: 550px; margin-bottom: 6rem;">
								<div class="item">
									<h2 id="slide-title__1"><?=$elementoTemporal["titulo"]?></h2>
									<img src="https://cancuntoislamujeres.com/img/<?=$elementoTemporal['imgPortada']?>" alt="" style="width: 100%;">
									<div class="info" style="margin-top: 10px;">
										<div class="p">
											<?=$elementoTemporal["descripcion"]?>
										</div>
									</div>
									<div class="row" style="margin-top: 10px;">
										<div class="col-md-3 col-xs-2">
											<div class="edit manita" data-id="<?=$elementoTemporal['idBanner']?>" data-titulo="<?=$elementoTemporal['titulo']?>" data-tituloEn="<?=$elementoTemporal['tituloEn']?>" data-ruta="<?=$elementoTemporal['imgPortada']?>" data-link="<?=$elementoTemporal['link']?>" data-linkVideo="<?=$elementoTemporal['linkVideo']?>" data-descripcion="<?=$elementoTemporal['descripcion']?>" data-descripcionEn="<?=$elementoTemporal['descripcionEn']?>" data-textoBoton="<?=$elementoTemporal['textoBoton']?>" data-textoBotonEn="<?=$elementoTemporal['textoBotonEn']?>" data-rutaMovil="<?=$elementoTemporal['imgMovil']?>">
												<button type="button" class="buttonaplicar"><i class="fa fa-edit" style="font-size: 20px;"></i></button>
											</div>
										</div>
										<div class="col-md-3 col-xs-2">
											<div class="delete manita">
												<button type="button" data-id="<?=$elementoTemporal['idBanner']?>" class="buttondelete" name="operaciones" value="deleteBanner"><i class="fa fa-trash" style="font-size: 20px;"></i></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
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
				<input type="hidden" id="tipo" name="tipo" value="<?=$tipo?>">
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
							<div id="preview-slide" class="espacios">
							</div>
							<input type="file" onchange="showMyImageWH('preview-slide', this, '', 1, 655, 600)" name="imagen" id="" class="filestyle" data-input="false" data-buttonText="Imagen Principal" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Principal">
							<p class="help-block">Solo se aceptan imágenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 8 MB. <br> La resolución óptima para esta imagen es de 655x600 </p>
						</center>
						<!-- <center class="espacios" style="display:none">
							PREVISUALIZAR IMAGEN MÓVIL
							<div id="preview-slide-movil" class="espacios">
							</div>
							<input type="file" onchange="showMyImageWH('preview-slide-movil', this, '', 1, 800, 800)" name="imgMovil" id="" class="filestyle" data-input="false" data-buttonText="Imagen Movil" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="false" data-text="Imagen Movil">
							<p class="help-block">Solo se aceptan imágenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 800x800 </p>
						</center> -->
						<div class="input-group espacios">
							<span class="input-group-addon">Título</span>
							<input type="text" id="titulo" name="titulo" data-validate="false" class="form-control" placeholder="Ingresa el título..." value="">
						</div>
						<div class="input-group espacios">
							<span class="input-group-addon">Título ENG</span>
							<input type="text" id="tituloEn" name="tituloEn" data-validate="false" class="form-control" placeholder="Ingresa el título en inglés..." value="">
						</div>
						<div class="input-group espacios">
							<span class="input-group-addon">Texto (Párrafo)</span>
							<textarea type="text" id="descripcion" name="descripcion" data-validate="false" class="form-control" placeholder="Ingresa el texto..." value=""></textarea>
						</div>
						<div class="input-group espacios">
							<span class="input-group-addon">Texto (Párrafo) ENG</span>
							<textarea type="text" id="descripcionEn" name="descripcionEn" data-validate="false" class="form-control" placeholder="Ingresa el texto en inglés..." value=""></textarea>
						</div>
						<div class="input-group espacios">
							<span class="input-group-addon">Link: https://cancuntoislamujeres.com/{idioma}/</span>
							<input type="text" id="link" name="link" data-validate="false" class="form-control" placeholder="Ingresa el link..." value="">
						</div>
						<div class="input-group espacios">
							<span class="input-group-addon">Estatus</span>
							<select name="estatus" id="estatus" data-validate="false" class="form-control">
								<option value="1">Áctivo</option>
								<option value="0">Ináctivo</option>
							</select>
						</div>
						<div class="input-group espacios" style="display:none">
							<span class="input-group-addon">Texto Botón</span>
							<input type="text" id="textoBoton" name="textoBoton" data-validate="false" class="form-control" placeholder="Ingresa el texto del botón..." value="">
						</div>
						<div class="input-group espacios" style="display:none">
							<span class="input-group-addon">Texto Botón ENG</span>
							<input type="text" id="textoBotonEn" name="textoBotonEn" data-validate="false" class="form-control" placeholder="Ingresa el texto del botón en inglés..." value="">
						</div>
						<div class="input-group espacios" style="display:none">
							<span class="input-group-addon">Url Video</span>
							<input type="text" id="linkVideo" name="linkVideo" data-validate="false" class="form-control" placeholder="Ingresa la url del video..." value="">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave5)==0) echo ' disabled ';?> class="buttonguardar btn-save">Guardar y Publicar</button>
					</div>
				</div><!-- /.modal-content -->
			</form>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</body>
<footer id="footer">
	<?php include 'footer.php';?>
	<script src="js/functionsBanners.js"></script>
	<script>
		$(".buttondelete").click(function(){
			var id = $(this).attr('data-id');
			$("#idBanner").val(id);
			$("input[name=operaciones]").val("deleteBanners")
			$("#form-cards").submit();
		});
	</script>
</footer>
</html>
