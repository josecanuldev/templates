  <?php
  include("include/header.php");
  include_once("../panel/clases/blog.php");
  include_once("../panel/clases/contacto.php");
  $recientes=new blog();
  $listaRecientes=$recientes->listRecentBlog($_LANG,$idioma);
  $populares=new blog();
  $listaPopulares=$populares->listPopularBlog($_LANG,$idioma);
  $mensajeBlog=new contacto();
  $mensajeBlog->obtener_contacto();
  if($idioma=='en'){
    $tituloMensaje=$mensajeBlog->tituloMensajeBlogEn;
    $descripcionMensaje=$mensajeBlog->descripcionMensajeBlogEn;
  }else{
    $tituloMensaje=$mensajeBlog->tituloMensajeBlog;
    $descripcionMensaje=$mensajeBlog->descripcionMensajeBlog;
  }
  ?>
  <div class="inicio-1">
    <div class="master-slider ms-skin-default" id="masterslider">
      <div class="ms-slide">
          <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/slider-1.jpg" alt="<?=NAME?> Blog"/>
          <div class="info-1 centrado info">
            <img src="<?=PATH?>img/Cancun-isla-logo-2.jpg" alt="<?=NAME?> Blog" class="slider-logo-1"><br />
            <p><?=v43?></p>
          </div>
      </div>
      <div class="ms-slide">
          <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/slider-2.jpg" alt="<?=NAME?> Blog"/>
          <div class="info-2 centrado info">
            <h1><?=v44?></h1>
            <p><?=v45?></p>
            <button type="button" name="button" data-toggle="modal" data-target="#modalSuscribirse"><?=v46?></button>
          </div>
      </div>
      <div class="ms-slide">
          <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/slider-3.jpg" alt="<?=NAME?> Blog"/>
          <div class="info-3 centrado info">
            <h2><?=v47?></h2>
            <p><?=v48?></p>
            <a href="<?=PATH?><?=$idioma?>/viajando-por"><button type="button" name="button"><?=v49?></button></a>
          </div>
      </div>
      <div class="ms-slide">
          <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/slider-4.jpg" alt="<?=NAME?> Blog"/>
          <div class="info-3 centrado info">
            <h2><?=v50?></h2>
            <p><?=v51?></p>
            <a href="<?=PATH?><?=$idioma?>/fin-de-semana"><button type="button" name="button"><?=v49?></button></a>
          </div>
      </div>
      <div class="ms-slide">
          <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/slider-5.jpg" alt="<?=NAME?> Blog"/>
          <div class="info-3 centrado info">
            <h2><?=v52?></h2>
            <p><?=v53?></p>
            <a href="<?=PATH?><?=$idioma?>/rutas-expediciones"><button type="button" name="button"><?=v49?></button></a>
          </div>
      </div>
    </div>
    <a href="#lo-mas-nuevo" class="scroller"><img src="<?=PATH?>img/icon-down.svg" alt="<?=NAME?> Blog" class="down" /></a>
  </div>
  <div class="inicio-2" id="lo-mas-nuevo">
    <h1><?=v54?></h1>
  </div>
  <div class="inicio-3">
    <div class="row row-con-margen">
      <div class="col-lg-1 col-md-1 col-sm-12">

      </div>
      <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="row row-con-margen listas-blog">
          <?php
          foreach($listaRecientes as $elementoReciente){
            $visitasActuales=new blog();
            $visitasActuales->getVisitas($elementoReciente['idBlog']);
            $rating=new blog();
            $rating->getRating($elementoReciente['idBlog']);
            $calificacion=$rating->calificacionFinal;
          ?>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="item">
              <h1>
                <?php
                if($elementoReciente['idCategoria']==1){
                ?>
                 <img src="<?=PATH?>img/icon-viajando.svg" alt="<?=NAME?> Blog" />
                <?php } else if($elementoReciente['idCategoria']==2){ ?>
                 <img src="<?=PATH?>img/icon-fin-semana.svg" alt="<?=NAME?> Blog" />
                <?php } else if($elementoReciente['idCategoria']==3){ ?>
                 <img src="<?=PATH?>img/icon-rutas.svg" alt="<?=NAME?> Blog" />
                <?php } else if($elementoReciente['idCategoria']==4){ ?>
                 <img src="<?=PATH?>img/icon-viajes-carretera.svg" alt="<?=NAME?> Blog" />
                <?php } ?>
                <?=$elementoReciente['titulo']?>
              </h1>
              <div class="img" style="background:url(<?= PATH2;?>img/imgBlog/<?=$elementoReciente['portada']?>); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
                <span class="palabra-clave"><?=$elementoReciente['descripcion']?></span>
              </div>
              <h3><?=$elementoReciente['subtituloBlog']?></h3>
              <h4>
                <span class="fecha"><?=$elementoReciente['fechaCreacionFormato']?></span>
                <span class="rate">
                  Rate&nbsp;
                  <?php
                  if($calificacion == 1){
                  ?>
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <?php } ?>

                  <?php
                  if($calificacion == 2){
                  ?>
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <?php } ?>

                  <?php
                  if($calificacion == 3){
                  ?>
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <?php } ?>

                  <?php
                  if($calificacion == 4){
                  ?>
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <?php } ?>

                  <?php
                  if($calificacion == 5){
                  ?>
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <?php } ?>
                </span>
              </h4>
              <h5>
                <img src="<?=PATH?>img/icon-visitas.svg" alt="<?=NAME?> Blog" /> <?=$visitasActuales->visitas?> Vistas
              </h5>
              <div class="text-center">
                <a href="<?=PATH?><?=$idioma?>/detalle-noticia/<?=$elementoReciente['idBlog']?>-<?=$elementoReciente['urlAmigable']?>">
                  <button type="button" name="button" class="leer-mas"><?=v26?></button>
                </a>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="text-center mas-articulos visible-xs">
          <a href="<?=PATH?><?=$idioma?>/nuevos"><button type="button"><?=v55?> <img src="<?=PATH?>img/arrow-right.svg" alt="<?=NAME?> Blog" /></button></a>
        </div>
        <br class="visible-xs" /><br class="visible-xs" />
      </div>
      <div class="col-lg-1 col-md-1 col-sm-12">

      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 p-r30">
        <?php include("include/siderbar.php"); ?>
      </div>
    </div>
  </div>
  <div class="text-center mas-articulos hidden-xs">
    <a href="<?=PATH?><?=$idioma?>/nuevos"><button type="button"><?=v55?> <img src="<?=PATH?>img/arrow-right.svg" alt="<?=NAME?> Blog" /></button></a>
  </div>
  <div class="inicio-2">
    <h1><?=v56?></h1>
  </div>
  <div class="inicio-4">
    <?php
      foreach($listaPopulares as $elementoPopular){
        $rating=new blog();
        $rating->getRating($elementoPopular['idBlog']);
        $calificacion=$rating->calificacionFinal;
    ?>
    <div class="row row-con-margen item">
      <div class="col-lg-1 col-md-1 col-sm-12 cols">
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12 cols img" style="background:url(<?= PATH2;?>img/imgBlog/<?=$elementoPopular['portada']?>); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
        <span class="centrado"><?=$elementoPopular['descripcion']?></span>
      </div>
      <div class="col-lg-5 col-md-5 col-sm-12 cols info">
        <div class="contenido">
          <h1><?=$elementoPopular['titulo']?>
            <img src="<?=PATH?>img/icon-line-azul.svg" alt="<?=NAME?> Blog" class="line" />
            <span class="fecha"><?=$elementoPopular['fechaCreacionFormato']?></span>
            <span class="visitas"><img src="<?=PATH?>img/icon-visitas.svg" alt="<?=NAME?> Blog" /> <?=$elementoPopular['visitas']?> <?=v37?></span>
          </h1>
          <p>
            <?=strip_tags($elementoPopular['descripcionCorta']);?>...
          </p>
          <div class="row row-con-margen">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <span class="rate">
                Rate&nbsp;
                <?php
                if($calificacion == 1){
                ?>
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <?php } ?>

                <?php
                if($calificacion == 2){
                ?>
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <?php } ?>

                <?php
                if($calificacion == 3){
                ?>
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <?php } ?>

                <?php
                if($calificacion == 4){
                ?>
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <?php } ?>

                <?php
                if($calificacion == 5){
                ?>
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <?php } ?>
              </span>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 text-right">
              <a href="<?=PATH?><?=$idioma?>/detalle-noticia/<?=$elementoPopular['idBlog']?>-<?=$elementoPopular['urlAmigable']?>"><button type="button" class="leer-mas"><?=v26?></button></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php } ?>

    <div class="text-center mas-articulos">
      <a href="<?=PATH?><?=$idioma?>/populares"><button type="button"><?=v57?> <img src="<?=PATH?>img/arrow-right.svg" alt="<?=NAME?> Blog" /></button></a>
    </div>
  </div>
  <div class="inicio-5">
    <h1><span class="comilla">"</span><?=strip_tags($tituloMensaje);?></h1>
    <h2><?=strip_tags($descripcionMensaje);?><span class="comilla">"</span></h2>
    <!--<h3>
      <span class="visitas"><img src="<?=PATH?>img/icon-visitas.svg" alt="<?=NAME?> Blog" /> 195 Vistas</span>
    </h3>--><br /><br />
    <h4>
      <a href="#top"><img src="<?=PATH?>img/icon-up.svg" alt="<?=NAME?> Blog" /></a>
    </h4>
  </div>
  <?php include("include/footer.php"); ?>
  <?php include 'include/scripts.php';?>
    <link rel="stylesheet" href="<?=PATH?>js/masterslider/style/masterslider.css" />
		<link href="<?=PATH?>js/masterslider/skins/default/style.css" rel='stylesheet' type='text/css'>
		<link href='<?=PATH?>js/masterslider/ms-fullscreen.css' rel='stylesheet' type='text/css'>
		<script src="<?=PATH?>js/masterslider/jquery.easing.min.js"></script>
		<script src="<?=PATH?>js/masterslider/masterslider.min.js"></script>
    <script type="text/javascript">

      $(window).load(function(){

        if($(window).width() < 768){
          var autoh=false;
          var lay='autofill';
        }else{
          var autoh=true;
          var lay='fillwidth';
        }

        var slider = new MasterSlider();

  			slider.control('arrows' , {autohide:false} ,{insertTo:'#masterslider'});
        //slider.control('bullets' , {autohide:false  , dir:"h", align:"bottom"});
  			slider.setup('masterslider' , {
  				width:1600,
  				height:610,
  				space:0,
  				view:'basic',
          autoplay: false,
  				layout:lay,
          autoHeight:autoh,
          loop:true,
  				fullscreenMargin:0,
  				speed:20
  			});
      });
      //$("#modalGracias").modal("show");
		</script>
  </body>
</html>
