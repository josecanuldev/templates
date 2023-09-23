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

$texto = "Portada";

$temporal = new portada();
$form = $temporal -> getPortada();
$clave = 'p_add_home';
$clave2 = 'p_del_home';
$clave3 = 'p_acdc_home';
$clave4 = 'p_sort_home';
$clave5 = 'p_mod_home';
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
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<hr class="hrmenu">
					</div>
					<div class="clearfix"></div>
					<!--Sección para realizar cambios Nota: el div con la clase styled-large es la que se visualiza con lg y md-->
					<form id="form-cards" action="operaciones.php" method="post" enctype="multipart/form-data">
						<input type="hidden" id="permisoAcDc" value="<?=$permisoAcDc?>">
						<div class="clearfix"></div>
						<!--Seccion de la tabla-->

						<input type="hidden" id="id" name="id" value="<?=$form["id"]?>">
						<input type="hidden" id="operaciones" name="operaciones" value="updatePortada">
						<div class="row">
							<div class="col-md-6">
								<center class="espacios">
									IMAGEN TAMAÑO DESKTOP
									<div id="preview-slide_web" class="espacios">
										<?php if ($form["imgPortada"] != '' && $form["imgPortada"] != null) { ?>
											<img src="../img/imgPortada/<?=$form["imgPortada"]?>" alt="" class="img-responsive">
										<?php } else { ?>
											<div style="background-color: #ddd; display: block; min-height: 180px; width: 100%;"></div>
										<?php } ?>
									</div>
									<input type="file" onchange="showMyImageWH('preview-slide_web', this, '', 1, 930, 370)" name="imgPortada" id="imgPortada" class="filestyle" data-input="false" data-buttonText="Imagen Principal" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Principal">
									<p class="help-block">Solo se aceptan imágenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 8 MB. <br> La resolución óptima para esta imagen es de 930x370 </p>
								</center>
							</div>
							<div class="col-md-6">
								<center class="espacios">
									IMAGEN TAMAÑO MÓVIL
									<div id="preview-slide_movil" class="espacios">
										<?php if ($form["imgPortadaMobile"] != '' && $form["imgPortadaMobile"] != null) { ?>
											<img src="../img/imgPortada/<?=$form["imgPortadaMobile"]?>" alt="" style="height: 250px;" class="img-responsive">
										<?php } else { ?>
											<div style="background-color: #ddd; display: block; min-height: 180px; width: 100%;"></div>
										<?php } ?>
									</div>
									<input type="file" onchange="showMyImageWH('preview-slide_movil', this, '', 1, 305, 520)" name="imgPortadaMobile" id="imgPortadaMobile" class="filestyle" data-input="false" data-buttonText="Imagen Principal" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Principal">
									<p class="help-block">Solo se aceptan imágenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 8 MB. <br> La resolución óptima para esta imagen es de 305x520 </p>
								</center>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-lg-8" style="float: none; margin-left: auto; margin-right: auto;">
								<div class="input-group espacios">
									<span class="input-group-addon">Título</span>
									<input type="text" id="titulo" name="titulo" data-validate="false" class="form-control" placeholder="Ingresa el título..." value="<?=$form["titulo"]?>">
								</div>
								<div class="input-group espacios">
									<span class="input-group-addon">Título ENG</span>
									<input type="text" id="tituloEn" name="tituloEn" data-validate="false" class="form-control" placeholder="Ingresa el título en inglés..." value="<?=$form["tituloEn"]?>">
								</div>
								<div class="input-group espacios">
									<span class="input-group-addon">Texto (Párrafo)</span>
									<textarea type="text" id="subtitulo" name="subtitulo" data-summer="true" data-validate="true" class="form-control" placeholder="Ingresa una descripción..." rows="8"><?=$form["subtitulo"]?></textarea>
								</div>
								<div class="input-group espacios">
									<span class="input-group-addon">Texto (Párrafo) ENG</span>
									<textarea type="text" id="subtituloEn" name="subtituloEn" data-summer="true" data-validate="true" class="form-control" placeholder="Ingresa una descripción en inglés..." rows="8"><?=$form["subtituloEn"]?></textarea>
								</div>
								<!-- <div class="input-group espacios">
									<span class="input-group-addon">Estatus</span>
									<select name="estatus" id="estatus" data-validate="false" class="form-control" value="<?=$form["estatus"]?>">
										<option value="1">Áctivo</option>
										<option value="0">Ináctivo</option>
									</select>
								</div> -->
								<div class="modal-footer">
									<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave5)==0) echo ' disabled ';?> class="buttonguardar btn-save" value="updatePortada">Guardar y Publicar</button>
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
	<!-- <script src="js/functionsBanners.js"></script> -->
</footer>
</html>
