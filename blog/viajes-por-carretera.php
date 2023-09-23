  <?php
  include("include/header.php");
  include_once("../panel/clases/blog.php");
  $blogCategoria=new blog();
  $listaBlogCategoria=$blogCategoria->listBlogCategoria($_LANG,$idioma,4);
  $totalBlog=count($listaBlogCategoria);
  ?>
  <div class="portada">
    <span class="pointer back" onclick="Javascript:location.href='<?=PATH?><?=$idioma?>'"><img src="<?=PATH?>img/icon-back.svg" alt="<?=NAME?> Blog" /> <?=v27?></span>
    <h1><img src="<?=PATH?>img/icon-viajes-carretera.svg" alt="<?=NAME?> Blog" /> <?=v60?></h1>
  </div>
  <div class="inicio-3">
    <div class="row row-con-margen">
      <div class="col-lg-1 col-md-1 col-sm-12">

      </div>
      <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="row row-con-margen listas-blog">
          <?php
          if($totalBlog > 0){
          foreach($listaBlogCategoria as $elementoCategoria){
            if($elementoCategoria['registros'] > 0){
              $rating=new blog();
              $rating->getRating($elementoCategoria['idBlog']);
              $calificacion=$rating->calificacionFinal;
          ?>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="item">
              <h1><img src="<?=PATH?>img/icon-rutas.svg" alt="<?=NAME?> Blog" /> <?=$elementoCategoria['titulo']?></h1>
              <div class="img" style="background:url(<?= PATH2;?>img/imgBlog/<?=$elementoCategoria['portada']?>); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
                <span class="palabra-clave"><?=$elementoCategoria['descripcion']?></span>
              </div>
              <h3><?=$elementoCategoria['subtituloBlog']?></h3>
              <h4>
                <span class="fecha"><?=$elementoCategoria['fechaCreacionFormato']?></span>
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
                <img src="<?=PATH?>img/icon-visitas.svg" alt="<?=NAME?> Blog" /> <?=$elementoCategoria['visitas']?> <?=v37?>
              </h5>
              <div class="text-center">
                <a href="<?=PATH?><?=$idioma?>/detalle-noticia/<?=$elementoCategoria['idBlog']?>-<?=$elementoCategoria['urlAmigable']?>">
                  <button type="button" name="button" class="leer-mas"><?=v26?></button>
                </a>
              </div>
            </div>
          </div>
          <?php } } } ?>
          <!--<div class="col-lg-4 col-md-4 col-sm-12">
            <div class="item">
              <h1><img src="<?=PATH?>img/icon-fin-semana.svg" alt="<?=NAME?> Blog" /> Tips para un fin.</h1>
              <div class="img" style="background:url(<?= PATH;?>img/blog-2.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
                <span class="palabra-clave">Solitario</span>
              </div>
              <h3>Consejos para un viaje inolvidable</h3>
              <h4>
                <span class="fecha">Marzo 05 2019</span>
                <span class="rate">
                  Rate&nbsp;
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                </span>
              </h4>
              <h5>
                <img src="<?=PATH?>img/icon-visitas.svg" alt="<?=NAME?> Blog" /> 195 Vistas
              </h5>
              <div class="text-center">
                <a href="<?=PATH?>detalle-noticia/1-urlamigable">
                  <button type="button" name="button" class="leer-mas">Leer más</button>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="item">
              <h1><img src="<?=PATH?>img/icon-viajando.svg" alt="<?=NAME?> Blog" /> Viajando por Holbox</h1>
              <div class="img" style="background:url(<?= PATH;?>img/blog-1.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
                <span class="palabra-clave">Bicicletas</span>
              </div>
              <h3>Historia de Holbox por bicicleta.</h3>
              <h4>
                <span class="fecha">Marzo 05 2019</span>
                <span class="rate">
                  Rate&nbsp;
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                  <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                </span>
              </h4>
              <h5>
                <img src="<?=PATH?>img/icon-visitas.svg" alt="<?=NAME?> Blog" /> 195 Vistas
              </h5>
              <div class="text-center">
                <a href="<?=PATH?>detalle-noticia/1-urlamigable">
                  <button type="button" name="button" class="leer-mas">Leer más</button>
                </a>
              </div>
            </div>
          </div>-->
        </div>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-12">

      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 p-r30">
        <?php include("include/siderbar.php"); ?>
      </div>
    </div>
  </div>
  <div class="articulos-proximos">
    <h1><?=v38?></h1>
  </div>
  <?php include("include/relacionados.php"); ?>
  <?php include("include/footer.php"); ?>
  <?php include 'include/scripts.php';?>
    <link rel="stylesheet" href="<?=PATH?>js/masterslider/style/masterslider.css" />
		<link href="<?=PATH?>js/masterslider/skins/default/style.css" rel='stylesheet' type='text/css'>
		<link href='<?=PATH?>js/masterslider/ms-fullscreen.css' rel='stylesheet' type='text/css'>
		<script src="<?=PATH?>js/masterslider/jquery.easing.min.js"></script>
		<script src="<?=PATH?>js/masterslider/masterslider.min.js"></script>
    <script type="text/javascript">

      $(window).load(function(){
        var slider = new MasterSlider();

  			slider.control('arrows' , {autohide:false} ,{insertTo:'#masterslider'});
        //slider.control('bullets' , {autohide:false  , dir:"h", align:"bottom"});
  			slider.setup('masterslider' , {
  				width:1600,
  				height:610,
  				space:0,
  				view:'basic',
          autoplay: true,
  				layout:'fillwidth',
          autoHeight:true,
          loop:true,
  				fullscreenMargin:0,
  				speed:20
  			});
      });

		</script>
  </body>
</html>
