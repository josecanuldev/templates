<footer>
	<a href="https://cancuntoislamujeres.com/" class="uno">CancunTo<b>IslaMujeres.com</b></a>
	<a href="https://www.facebook.com/profile.php?id=100063657215964">
		<img src="<?=PATH?>img/icon-facebook.svg" alt="Facebook" class="red">
	</a>
	<a href="https://wa.me/5215649607188/?text=" target="_blank">
		<img src="<?=PATH?>img/icon-whatsapp.svg" alt="Whatsapp" class="red">
	</a>
	<a href="https://www.tripadvisor.com.mx/Attraction_Review-g616319-d14958213-Reviews-Transfer_Holbox-Holbox_Island_Yucatan_Peninsula.html?m=19905">
		<img src="<?=PATH?>img/icon-trips-advisor.svg" alt="Trips Advisor" class="red">
	</a>
	<a href="tel:+5215649607188">
		<img src="<?=PATH?>img/icon-telefono.svg" alt="Tel" class="red">
	</a>
	<!-- <img src="<?=PATH?>img/line.svg" alt="<?=NAME?> Blog" class="line"> -->
	<!-- <a href="http://disenomerida.com/" class="dos" target="_blank"><b>Diseño</b> Mérida / <b>Diseño</b> Mid <img src="<?=PATH?>img/logo-dm.svg" alt="Diseño Mérida" class="dm"></a> -->
</footer>
<div class="modal fade modal-estilo" id="modalSuscribirse" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
			<form id="formContact">
				<div class="contenido pantalla pantalla-1">
	      	<div class="formulario">
	      		<h1><?=v1?></h1>
						<div class="input">
							<span class="helper"><?=v2?></span>
							<input type="text" name="" value="" placeholder="" id="c-nombre">
						</div>
						<div class="row row-con-margen">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="input">
									<span class="helper"><?=v3?></span>
									<input type="text" name="" value="" placeholder="" id="c-pais">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="input">
									<span class="helper"><?=v4?></span>
									<input type="text" name="" value="" placeholder="" id="c-ciudad">
								</div>
							</div>
						</div>
						<div class="input">
							<span class="helper"><?=v5?></span>
							<input type="email" name="" value="" placeholder="" id="c-correo">
						</div>
						<div class="input">
							<input type="radio" name="genero" value="mujer" id="mujer" class="genero" checked>
							<label for="mujer"><span></span></label>
							<span class="helper"><?=v6?></span>&nbsp;&nbsp;<br class="visible-xs" />

							<input type="radio" name="genero" value="hombre" id="hombre" class="genero">
							<label for="hombre"><span></span></label>
							<span class="helper"><?=v7?></span>&nbsp;&nbsp;<br class="visible-xs" />

							<input type="radio" name="genero" value="sin especificar" id="sinespecificar" class="genero">
							<label for="sinespecificar"><span></span></label>
							<span class="helper"><?=v8?></span><br class="visible-xs" />
						</div>
						<div class="input">
							<span class="helper dos"><?=v9?></span><br />
							<input type="checkbox" name="temas" value="tours" id="temas-1" value="Tours" class="temas">
							<label for="temas-1"><span></span></label>
							<span class="helper tres">Tours</span><br class="visible-xs" />

							<input type="checkbox" name="temas" value="solitario" id="temas-2" value="Solitario" class="temas">
							<label for="temas-2"><span></span></label>
							<span class="helper tres"><?=v10?></span><br class="visible-xs" />

							<input type="checkbox" name="temas" value="pareja" id="temas-3" value="Pareja" class="temas">
							<label for="temas-3"><span></span></label>
							<span class="helper tres"><?=v11?></span><br class="visible-xs" />

							<br class="hidden-xs" /><br class="hidden-xs" />

							<input type="checkbox" name="temas" value="holbox" id="temas-4" value="Holbox" class="temas">
							<label for="temas-4"><span></span></label>
							<span class="helper tres">Holbox</span><br class="visible-xs" />

							<input type="checkbox" name="temas" value="consejos" id="temas-5" value="Consejos" class="temas">
							<label for="temas-5"><span></span></label>
							<span class="helper tres"><?=v12?></span><br class="visible-xs" />

							<input type="checkbox" name="temas" value="nuevo contenido" id="temas-6" value="Nuevo contenido" class="temas">
							<label for="temas-6"><span></span></label>
							<span class="helper tres"><?=v13?></span>
						</div>
	      	</div>
					<button type="button" name="button" class="suscribir" id="sendMail" onclick="enviarMensaje();"><?=v14?></button>
					<img src="<?=PATH?>img/palmera-1.png" alt="<?=NAME?> Blog" class="palmera">
					<ion-icon name="close" data-dismiss="modal" class="cerrar"></ion-icon>
	      </div>
				<div class="contenido pantalla pantalla-2 dos" style="display:none">
					<div class="info">
						<h2>Thanks</h2>
						<h3><?=v15?></h3>
						<button type="button" name="button" data-dismiss="modal" data-dismiss="modal"><?=v16?></button>
					</div>
					<img src="<?=PATH?>img/palmera-2.png" alt="<?=NAME?> Blog" class="palmera-2">
					<ion-icon name="close" data-dismiss="modal" class="cerrar"></ion-icon>
	      </div>
			</form>
    </div>
  </div>
</div>

<div class="modal fade modal-estilo" id="modalNosotros" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
				<div class="contenido">
					<div class="info">
						<h5><b><?=NAME?></b></h5>
						<div class="linea">
						</div>
						<p>
							<?=v61?>
						</p>
						<div class="boton-amarillo">
							<a href="https://cancuntoislamujeres.com" target="_blank"><button type="button"><?=v62?></button></a>
						</div>
						<img src="<?=PATH?>img/nosotros-blog.png" alt="<?=NAME?> Blog" class="nosotros-blog">
					</div>
					<ion-icon name="close" data-dismiss="modal" class="cerrar"></ion-icon>
	      </div>
    </div>
  </div>
</div>
