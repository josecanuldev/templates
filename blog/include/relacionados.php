<?php
$random=new blog();
$listaRandom=$random->listBlogRand($_LANG,$idioma);
?>
<div class="relacionados">
  <h2><?=v23?></h2>
  <div class="container">
    <div class="row">
      <?php foreach($listaRandom as $elementoRandom){ ?>
      <div class="col-lg-3 col-md-3 col-sm-3 item">
        <h3><?=$elementoRandom['titulo']?></h3>
        <div class="img" style="background:url(<?= PATH2;?>img/imgBlog/<?=$elementoRandom['portada']?>); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
          <span class="centrado"><?=$elementoRandom['descripcion']?></span>
        </div>
        <h4><?=$elementoRandom['subtituloBlog']?></h4>
        <div class="text-center">
          <button type="button" name="button" onclick="Javascript:location.href='<?=PATH?><?=$idioma?>/detalle-noticia/<?=$elementoRandom['idBlog']?>-<?=$elementoRandom['urlAmigable']?>'"><?=v26?></button>
        </div>
      </div>
      <?php } ?>
      <!--<div class="col-lg-3 col-md-3 col-sm-3 item">
        <h3>Actividades</h3>
        <div class="img" style="background:url(<?= PATH;?>img/blog-5.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
          <span class="centrado">Pesca</span>
        </div>
        <h4>Lorem ipsum dolor sit amet</h4>
        <div class="text-center">
          <button type="button" name="button" onclick="Javascript:location.href='<?=PATH?>detalle-blog/1-urlamigable'">Leer más</button>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 item">
        <h3>Playa mágica</h3>
        <div class="img" style="background:url(<?= PATH;?>img/blog-6.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
          <span class="centrado">Magia</span>
        </div>
        <h4>Lorem ipsum dolor sit amet</h4>
        <div class="text-center">
          <button type="button" name="button" onclick="Javascript:location.href='<?=PATH?>detalle-blog/1-urlamigable'">Leer más</button>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 item">
        <h3>Playa mágica</h3>
        <div class="img" style="background:url(<?= PATH;?>img/blog-6.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
          <span class="centrado">Magia</span>
        </div>
        <h4>Lorem ipsum dolor sit amet</h4>
        <div class="text-center">
          <button type="button" name="button" onclick="Javascript:location.href='<?=PATH?>detalle-blog/1-urlamigable'">Leer más</button>
        </div>
      </div>-->
    </div>
  </div>
</div>
