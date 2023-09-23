<?php
	include_once("include/path.php");
	include_once("../panel/clases/seo.php");
	include_once("../panel/clases/banner.php");
	include_once("include/idioma.php");
	if($idioma=='es')
	{
		$parametroIdioma='ES';
		$_LANG = 'ES';
	}
	elseif($idioma=='en'){
		$parametroIdioma='EN';
		$_LANG = 'EN';
	}
	$self = $_SERVER['PHP_SELF'];
	$seo = new seo(1);
	$seo -> obtener_seo();
  $img = $seo -> listarImgSeo();
?>
<!-- Sección de los metas por default -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta name="description" content="<?= $seo->metaDescription;?>" />
<meta name="keywords" content="<?= $seo->metaKeywords;?>" />
<meta name="author" content="<?= $seo->metaAuthor?>" />
<meta property="og:type" content="<?= $seo->metaOgType;?>" />
<meta property="og:locale" content="<?= $seo->metaOgLocale;?>" />
<meta property="og:site_name" content="<?= $seo->metaOgTitle?>" />

<?php
	if(strpos($self,"detalle-blog")){?>
	<meta property="og:title" content="<?=$receta -> _datosBlog -> _titulo?>" />
	<meta property="og:url" content="<?=PATH?><?=$idioma?>/detalle-blog/<?=$idBlog?>-<?=$receta -> _datosBlog -> _urlAmigable?>" />
	<meta property="og:description" content="<?=strip_tags(htmlspecialchars_decode($receta -> descripcionCorta))?>" />
	<meta property="og:image" content="<?= PATH2;?>img/imgBlog/<?=$receta -> _portada?>" />
<?php }else{ ?>
	<meta property="og:title" content="<?= $seo->metaOgTitle;?>" />
	<meta property="og:url" content="<?= $seo->metaOgUrl;?>" />
	<meta property="og:description" content="<?= $seo->metaOgDescription;?>" />
	<meta property="og:image" content="<?= PATH2.'img/imgSeo/'.$img[2]['ruta'];?>" />
<?php } ?>

<link rel='shortcut icon' href='<?=PATH2?>img/imgSeo/<?=$img[0]['ruta']?>'>
<link rel="apple-touch-icon" sizes="180x180" href="<?=PATH2?>img/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?=PATH2?>img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=PATH2?>img/favicon/favicon-16x16.png">
<link rel="manifest" href="<?=PATH2?>img/favicon/site.webmanifest">
<link rel="mask-icon" href="<?=PATH2?>img/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<!--Let browser know website is optimized for mobile-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--Importando bootstrap, también van aquí todo los estilos que necesitara nuesta pagina-->
<link type="text/css" rel="stylesheet" href="<?= PATH?>css/bootstrap.min.css" />

<!-- archivo que incluye nuestras funciones de la pagina -->
<link type="text/css" rel="stylesheet" type="text/css" href="<?= PATH?>css/style.css">

<!-- Plugins -->

<link rel="stylesheet" type="text/css" href="<?= PATH?>css/outdatedBrowser.min.css" />

<link href="<?=PATH?>js/royalslider/royalslider.css" rel="stylesheet">

<link href="<?=PATH?>js/royalslider/skins/default/rs-default.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">

<link rel="stylesheet" type="text/css" href="<?= PATH?>js/slick/slick.css"/>

<link rel="stylesheet" type="text/css" href="<?= PATH?>js/slick/slick-theme.css"/>

<link rel="stylesheet" href="<?= PATH?>js/rate/jquery.rateyo.min.css"/>

<link href="<?= PATH?>css/bootstrap-slider.css" rel="stylesheet">
