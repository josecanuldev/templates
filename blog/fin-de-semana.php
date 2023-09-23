  <?php
  include("include/header.php");
  include_once("../panel/clases/blog.php");
  $blogCategoria=new blog();
  $listaBlogCategoria=$blogCategoria->listBlogCategoria($_LANG,$idioma,2);
  $totalBlog=count($listaBlogCategoria);
  ?>
  <div class="portada">
    <span class="pointer back" onclick="Javascript:location.href='<?=PATH?><?=$idioma?>'"><img src="<?=PATH?>img/icon-back.svg" alt="<?=NAME?> Blog" /> <?=v27?></span>
    <h1><img src="<?=PATH?>img/icon-fin-semana.svg" alt="<?=NAME?> Blog" /> <?=v36?></h1>
  </div>
  <div class="inicio-3 otros-blogs">
    <div class="row row-con-margen">
      <div class="col-lg-1 col-md-1 col-sm-12">

      </div>
      <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="row row-con-margen listas-blog">
          <?php
          if($totalBlog > 0){
          foreach($listaBlogCategoria as $elementoCategoria){
            if($elementoCategoria['registros'] > 0){
          ?>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="item-2 img" onclick="Javascript:location.href='<?=PATH?><?=$idioma?>/detalle-noticia/<?=$elementoCategoria['idBlog']?>-<?=$elementoCategoria['urlAmigable']?>'">
              <div class="img" style="background:url(<?= PATH2;?>img/imgBlog/<?=$elementoCategoria['portada']?>); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
                <span class="palabra-clave"><?=$elementoCategoria['titulo']?></span>
              </div>
              <h5>
                <img src="<?=PATH?>img/icon-visitas.svg" alt="<?=NAME?> Blog" /> <?=$elementoCategoria['visitas']?> <?=v37?>
              </h5>
            </div>
          </div>
          <?php } } } ?>
          <!--<div class="col-lg-3 col-md-3 col-sm-12">
            <div class="item-2">
              <div class="img" style="background:url(<?= PATH;?>img/fin-2.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
                <span class="palabra-clave">Con amigos</span>
              </div>
              <h5>
                <img src="<?=PATH?>img/icon-visitas.svg" alt="<?=NAME?> Blog" /> 195 Vistas
              </h5>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="item-2">
              <div class="img" style="background:url(<?= PATH;?>img/fin-3.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
                <span class="palabra-clave">En familia</span>
              </div>
              <h5>
                <img src="<?=PATH?>img/icon-visitas.svg" alt="<?=NAME?> Blog" /> 195 Vistas
              </h5>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="item-2">
              <div class="img" style="background:url(<?= PATH;?>img/fin-4.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
                <span class="palabra-clave">Solitario</span>
              </div>
              <h5>
                <img src="<?=PATH?>img/icon-visitas.svg" alt="<?=NAME?> Blog" /> 195 Vistas
              </h5>
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
  </body>
</html>
