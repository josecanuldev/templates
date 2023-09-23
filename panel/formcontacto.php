<?php
include_once('clases/contacto.php');
include_once('clases/seguridad.php');
$seguridad = new seguridad();
$seguridad->candado();

$operacion = 'modificarcontacto';
$palabra = 'Editar Contacto';
$temporal = new contacto();
$temporal->obtener_contacto();
$clave='ModCo';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'head.php';?>
	<title>Formulario Contacto | Aviso Privacidad</title>
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
							<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?>  class="buttonguardar">Guardar y Publicar</button>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<hr class="hrmenu">
							<div class='notifications top-right'></div>
						</div>
						<div class="clearfix"></div>
						<!-- <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 espacios">
							<span class="textHelper">Ingrese el correo para contacto aquí:</span>
							<br />
							<div id="correo" class="form-group">
								<input name="correo" type="text" data-validate="true" class="form-control" placeholder="Ej. contacto@ejemplo.com" value="<?php echo $temporal->correo ?>">
							</div>
							<br>
						</div> --><!--Div de cierre col-lg-7-->
						<!-- <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 espacios">
							<span class="textHelper">Ingrese el correo remitente de contacto aquí:</span>
							<br />
							<div id="emisor" class="form-group">
								<input name="emisor" type="text" class="form-control" placeholder="Ej. noreply@ejemplo.com" value="<?php echo $temporal->emisor ?>">
							</div>
						</div> -->
						<div class="clearfix"></div>
						<div class="col-xs-12">
							<p class="titulo">Aviso de privacidad</p>
						</div>
						<div class="clearfix"></div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="input-group espacios">
								<span class="input-group-addon">Título</span>
								<input type="text" name="tituloAvisoPrivacidad" class="form-control" placeholder="Ingresa el título" value="<?=$temporal -> tituloAvisoPrivacidad?>">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="input-group espacios">
								<span class="input-group-addon">Título Inglés</span>
								<input type="text" name="tituloAvisoPrivacidadEn" class="form-control" placeholder="Ingresa el título en inglés" value="<?=$temporal -> tituloAvisoPrivacidadEn?>">
							</div>
						</div>
						<div class="clearfix">

						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="input-group espacios">
								<span class="input-group-addon">Descripci&oacute;n</span>
								<textarea name="descripcionAvisoPrivacidad" id="descripcionAvisoPrivacidad" rows="8" class="form-control" placeholder="Ingresa la descripción" data-summer="true" ><?=$temporal -> descripcionAvisoPrivacidad?></textarea>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="input-group espacios">
								<span class="input-group-addon">Descripci&oacute;n Inglés</span>
								<textarea name="descripcionAvisoPrivacidadEn" id="descripcionAvisoPrivacidadEn" rows="8" class="form-control" placeholder="Ingresa la descripción en inglés" data-summer="true"><?=$temporal -> descripcionAvisoPrivacidadEn?></textarea>
							</div>
						</div>

						<div class="col-xs-12">
							<br><br>
							<p class="titulo">Mensaje Blog</p>
						</div>
						<div class="clearfix"></div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="input-group espacios">
								<span class="input-group-addon">Título del mensaje</span>
								<input type="text" name="tituloMensajeBlog" class="form-control" placeholder="Ingresa el título" value="<?=$temporal -> tituloMensajeBlog?>">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="input-group espacios">
								<span class="input-group-addon">Título del mensaje en Inglés</span>
								<input type="text" name="tituloMensajeBlogEn" class="form-control" placeholder="Ingresa el título en inglés" value="<?=$temporal -> tituloMensajeBlogEn?>">
							</div>
						</div>
						<div class="clearfix">

						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="input-group espacios">
								<span class="input-group-addon">Descripci&oacute;n o párrafo</span>
								<textarea name="descripcionMensajeBlog" id="descripcionMensajeBlog" rows="8" class="form-control" placeholder="Ingresa la descripción" data-summer="true" ><?=$temporal -> descripcionMensajeBlog?></textarea>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="input-group espacios">
								<span class="input-group-addon">Descripci&oacute;n o párrafo Inglés</span>
								<textarea name="descripcionMensajeBlogEn" id="descripcionMensajeBlogEn" rows="8" class="form-control" placeholder="Ingresa la descripción en inglés" data-summer="true"><?=$temporal -> descripcionMensajeBlogEn?></textarea>
							</div>
						</div>

						<div class="col-xs-12">
							<br><br>
							<p class="titulo">Faqs</p>
						</div>
						<div class="clearfix"></div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="input-group espacios">
								<span class="input-group-addon">Título</span>
								<input type="text" name="tituloFaqs" class="form-control" placeholder="Ingresa el título" value="<?=$temporal -> tituloFaqs?>">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="input-group espacios">
								<span class="input-group-addon">Título Inglés</span>
								<input type="text" name="tituloFaqsEn" class="form-control" placeholder="Ingresa el título en inglés" value="<?=$temporal -> tituloFaqsEn?>">
							</div>
						</div>
						<div class="clearfix">

						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="input-group espacios">
								<span class="input-group-addon">Descripci&oacute;n</span>
								<textarea name="descripcionFaqs" id="descripcionFaqs" rows="8" class="form-control" placeholder="Ingresa la descripción" data-summer="true" ><?=$temporal -> descripcionFaqs?></textarea>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="input-group espacios">
								<span class="input-group-addon">Descripci&oacute;n Inglés</span>
								<textarea name="descripcionFaqsEn" id="descripcionFaqsEn" rows="8" class="form-control" placeholder="Ingresa la descripción en inglés" data-summer="true"><?=$temporal -> descripcionFaqsEn?></textarea>
							</div>
						</div>

						<!-- <div class="col-xs-12">
							<br><br>
							<p class="titulo">Convertidor de precios</p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<center>
								<iframe height="360" scrolling="no" src="https://es.dailyforex.com/forex-widget/widget/28318" style="width: 230px; height:360px; display: block;border:0px;overflow:hidden;" width="230"></iframe>
							</center>
						</div> -->
						<!-- <div class="col-lg-6 col-md-6 col-sm-6">
							<div class="input-group espacios">
								<span class="input-group-addon">Ingresa el valor</span>
								<input type="number" name="precioBase" class="form-control" placeholder="Ingresa el valor del dólar">
							</div>
						</div> -->
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
