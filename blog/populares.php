  <?php
  include("include/header.php");
  include_once("../panel/clases/blog.php");
  $populares=new blog();
  $listaPopulares=$populares->listPopularBlogPopulares($_LANG,$idioma);
  ?>
  <div class="portada">
    <span class="pointer back" onclick="Javascript:location.href='<?=PATH?><?=$idioma?>'"><img src="<?=PATH?>img/icon-back.svg" alt="<?=NAME?> Blog" /> <?=v27?></span>
    <h1> <?=v56?></h1>
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
      <div class="col-lg-1 col-md-1 col-sm-12">

      </div>
      <div class="col-lg-2 col-md-2 col-sm-2">
        <?php include("include/siderbar.php"); ?>
      </div>
    </div>

    <?php } ?>

    <!--<div class="row row-con-margen item">
      <div class="col-lg-1 col-md-1 col-sm-12 cols">
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12 cols img" style="background:url(<?= PATH;?>img/blog-5.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
        <span class="centrado">Holbox</span>
      </div>
      <div class="col-lg-5 col-md-5 col-sm-12 cols info">
        <div class="contenido">
          <h1>Actividades
            <img src="<?=PATH?>img/icon-line-azul.svg" alt="<?=NAME?> Blog" class="line" />
            <span class="fecha">Marzo 05 2019</span>
            <span class="visitas"><img src="<?=PATH?>img/icon-visitas.svg" alt="<?=NAME?> Blog" /> 195 Vistas</span>
          </h1>
          <p>
            A quien no le gusta irse de pesca. Sentir el agua corriendo debajo de ti y el tirón del cordel sabiendo que algo espera ser sacado al enrollar el carrusel...
          </p>
          <div class="row row-con-margen">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <span class="rate">
                Rate&nbsp;
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
              </span>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 text-right">
              <a href="#"><button type="button" class="leer-mas">Leer más</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row row-con-margen item">
      <div class="col-lg-1 col-md-1 col-sm-12 cols">
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12 cols img" style="background:url(<?= PATH;?>img/blog-6.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
        <span class="centrado">Holbox</span>
      </div>
      <div class="col-lg-5 col-md-5 col-sm-12 cols info">
        <div class="contenido">
          <h1>Playa mágica
            <img src="<?=PATH?>img/icon-line-azul.svg" alt="<?=NAME?> Blog" class="line" />
            <span class="fecha">Marzo 05 2019</span>
            <span class="visitas"><img src="<?=PATH?>img/icon-visitas.svg" alt="<?=NAME?> Blog" /> 195 Vistas</span>
          </h1>
          <p>
            Quien haya dicho que la magia no existe, claramente no ha visitado las playas luminiscentes de Holbox.
          </p>
          <div class="row row-con-margen">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <span class="rate">
                Rate&nbsp;
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
                <img src="<?=PATH?>img/icon-star.svg" alt="<?=NAME?> Blog" />
              </span>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 text-right">
              <a href="#"><button type="button" class="leer-mas">Leer más</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>-->

  </div>
  <div class="articulos-proximos">
    <h1><?=v38?></h1>
  </div>
  <?php include("include/footer.php"); ?>
  <?php include 'include/scripts.php';?>
  </body>
</html>
