<?php
$self = $_SERVER['PHP_SELF'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include 'include/metas.php';?>
        <title><?=NAME?> Blog</title>
    </head>

	<body>
        <!-- Navegadores des-actualizados -->
        <div id="outdated">
            <h6>Tu Navegador esta desactualizado, para que el sitio</h6>
            <h6>funcione correctamente porfavor:</h6>
            <p> <a id="btnUpdateBrowser" href="http://www.updateyourbrowser.net/es">Actualiza tu navegador</a></p>
            <p class="last"><a href="#" id="btnCloseUpdateBrowser" title="Close">&times;</a></p>
        </div>
        <header>
          <div class="row row-con-margen">
            <div class="col-lg-2 col-md-2 col-sm-12">
              <a href="<?=PATH?><?=$idioma?>"><img src="<?=PATH?>img/Cancun-isla-blog.jpg" alt="<?=NAME?> Blog" class="logo" /></a>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12">
              <ul>
                <li>
                  <a href="<?=PATH?><?=$idioma?>/viajando-por"><img src="<?=PATH?>img/icon-viajando.svg" alt="<?=NAME?> Blog" /> <?=v17?></a>
                </li>
                <li>
                  <a href="<?=PATH?><?=$idioma?>/fin-de-semana"><img src="<?=PATH?>img/icon-fin-semana.svg" alt="<?=NAME?> Blog" /> <?=v18?></a>
                </li>
                <li>
                  <a href="<?=PATH?><?=$idioma?>/rutas-expediciones"><img src="<?=PATH?>img/icon-rutas.svg" alt="<?=NAME?> Blog" /> <?=v19?></a>
                </li>
                <li>
                  <a href="<?=PATH?><?=$idioma?>/viajes-por-carretera"><img src="<?=PATH?>img/icon-viajes-carretera.svg" alt="<?=NAME?> Blog" /> <?=v20?></a>
                </li>
                <li>
                  <a href="<?=PATH?><?=$idioma?>/galeria"><img src="<?=PATH?>img/icon-galeria.svg" alt="<?=NAME?> Blog" /> <?=v21?></a> <img src="<?=PATH?>img/line.svg" alt="<?=NAME?> Blog" class="line">
                  <a href="<?=PATH?>es" class="<?=($_LANG == 'ES') ? ' active' : ''?>">
                    <span>Español</span>
                  </a>
                  <a href="<?=PATH?>en" class="<?=($_LANG == 'EN') ? ' active' : ''?> ingles">
                    <span>English</span>
                  </a>
                </li>
                <li>
                  <button type="button" name="button" class="suscribirse"><?=v22?></button>
                </li>
              </ul>
            </div>
          </div>
          <ion-icon name="menu" class="desplega-menu visible-xs visible-sm"></ion-icon>
        </header>
        <div class="flotante">
          <span>
            <a href="<?=PATH?>es" class="<?=($_LANG == 'ES') ? ' active' : ''?>">
              Español
            </a>
            <img src="<?=PATH?>img/line.svg" alt="<?=NAME?> Blog" class="line">
            <a href="<?=PATH?>en" class="<?=($_LANG == 'EN') ? ' active' : ''?> ingles">
              English
            </a>
          </span>
          <div class="redes">
            <a href="https://www.facebook.com/profile.php?id=100063657215964">
          		<img src="<?=PATH?>img/icon-facebook.svg" alt="Facebook" class="red">
          	</a>
          	<a href="https://wa.me/5215649607188/?text=">
          		<img src="<?=PATH?>img/icon-whatsapp.svg" alt="Whatsapp" class="red">
          	</a>
          	<a href="https://www.tripadvisor.com.mx/Attraction_Review-g616319-d14958213-Reviews-Transfer_Holbox-Holbox_Island_Yucatan_Peninsula.html?m=19905">
          		<img src="<?=PATH?>img/icon-trips-advisor.svg" alt="Trips Advisor" class="red">
          	</a>
          	<a href="tel:+5215649607188">
          		<img src="<?=PATH?>img/icon-telefono.svg" alt="Tel" class="red">
          	</a>
          </div>
        </div>
