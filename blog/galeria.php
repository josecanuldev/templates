  <?php
  include("include/header.php");
  ?>
  <div class="portada">
    <span class="pointer back" onclick="Javascript:location.href='<?=PATH?><?=$idioma?>'"><img src="<?=PATH?>img/icon-back.svg" alt="<?=NAME?> Blog" /> <?=v27?></span>
    <h1><img src="<?=PATH?>img/icon-galeria-big.svg" alt="<?=NAME?> Blog" /> <?=v21?></h1>
  </div>
  <div class="inicio-3 otros-blogs galeria">
    <div class="row row-con-margen">
      <div class="col-lg-1 col-md-1 col-sm-12">

      </div>
      <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="contiene-select">
          <select name="ordenar" id="ordenar">
            <option value=""><?=v39?></option>
            <option value="1"><?=v40?></option>
            <option value="2"><?=v41?></option>
          </select>
          <span class="caret"></span>
        </div>
        <div class="row row-con-margen listado listaProyectos">
          <div class="col-lg-4 col-md-4 col-sm-4">
            <a data-fancybox="gallery" href="<?= PATH;?>img/galeria/58@2x.jpg">
              <div class="item" style="background:url(<?= PATH;?>img/galeria/58@2x.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
                <div class="info">
                  <h5 class="centrado">Viaje en Kayak Holbox</h5>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="item" style="background:url(<?= PATH;?>img/galeria/atardecer_isla_holbox@2x.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
              <div class="info">
                <h5 class="centrado">Viaje en Kayak Holbox</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="item" style="background:url(<?= PATH;?>img/galeria/holbox@2x.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
              <div class="info">
                <h5 class="centrado">Viaje en Kayak Holbox</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <a data-fancybox="gallery" data-width="1920" data-height="1080" href="https://www.youtube.com/watch?v=cRJVePHJnP8&t=2s">
              <div class="item" style="background:url(<?= PATH;?>img/galeria/las-nubes-de-holbox@2x.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
                <div class="info">
                  <h5 class="centrado">Viaje en Kayak Holbox</h5>
                </div>
                <img src="<?=PATH?>img/play-video.svg" alt="<?=NAME?> Blog" class="centrado play-video">
              </div>
            </a>
          </div>
        </div>
        <div class="text-center mas-articulos">
          <a href="#"><button type="button" class="btn-cargarmas"><?=v42?> <img src="<?=PATH?>img/arrow-right.svg" alt="<?=NAME?> Blog" /></button></a>
        </div>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-12">

      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 p-r30">
        <?php include("include/siderbar.php"); ?>
      </div>
    </div>
  </div>
  <?php include("include/footer.php"); ?>
  <?php include 'include/scripts.php';?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
  <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
  <script type="text/javascript" src="<?= PATH;?>js/funcionesReceta.js"></script>
  <script type="text/javascript">
  var orden=$("#ordenar").val();
  var idioma='<?=$idioma?>';
  $(window).load(function(e) {
    filtrarProductos();
  });
  $("#ordenar").change(function(e) {
    orden=$("#ordenar").val();
    filtrarProductos();
  });
  </script>
  </body>
</html>
