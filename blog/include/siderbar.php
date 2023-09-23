<div class="siderbar">
  <div class="img" style="background:url(<?= PATH;?>img/banner-derecha.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">
    <img src="<?= PATH;?>img/blog-derecha.png" alt="<?=NAME?> Blog" class="circulo">
  </div>
  <div class="informacion">
    <h5><?=v24?></h5>
    <div class="p">
      <?=v25?>
    </div>
    <a data-toggle="modal" data-target="#modalNosotros"><button type="button"><?=v26?></button></a>
  </div>
</div>
<?php
//banner
$banner2=new banner();
$listaBanner2=$banner2->listBannerRand(1, false, 1, '', '', '', 2);
?>
<?php
foreach($listaBanner2 as $elementoBanner2){
?>
<br /><br />
<a href="<?=$elementoBanner2["link"]?>" target="_blank"><img src="<?=PATH2?>img/imgBanner/<?=$elementoBanner2["imgPortada"]?>" class="w100Hauto" alt="Reservar" /></a>
<?php } ?>
<br /><br />
