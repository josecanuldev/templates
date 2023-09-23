  <?php
  function __autoload($nombre_clase) {
      include '../panel/clases/'.$nombre_clase .'.php';
  }
  $idBlog=$_REQUEST["idBlog"];
  $receta = new blog($idBlog);
  $receta -> getBlog();
  $receta -> obtenerDatosBlog('ES');
  include("include/header.php");
  $hoy = date("Y-m-d");
  $ip=$_SERVER['REMOTE_ADDR'];
  $contadorBlog=new blog();
  $listaExistente=$contadorBlog->listaVisitaExistente($idBlog,$hoy,$ip);
  $totalExistente=count($listaExistente);
  if($totalExistente == 0){
    $nuevaVisita=new blog();
    $nuevaVisita->addVisita($idBlog,$hoy,$ip);
  }

  if($idioma=='en'){
  	$fechaNot=$receta -> _fechaCreacionI;
  }
  else{
  	$fechaNot=$receta -> _fechaCreacionI;
  }

  $sliderBlog      = new testimonio2();
  $listaSliderBlog = $sliderBlog -> listaTestimonio(1, false, 1, $idBlog);

  //obtener visitas actuales
  $visitasActuales=new blog();
  $visitasActuales->getVisitas($idBlog);

  //obtener rating
  $rating=new blog();
  $rating->getRating($idBlog);
  if($rating->calificacionFinal > 0){
    $ratingCount=$rating->calificacionFinal;
  }else{
    $ratingCount=1;
  }


  //anterior y siguiente
  $prev = $receta -> listBlogPrev($_LANG,$idioma,$idBlog,$receta->_idCategoria);
  $next = $receta -> listBlogNext($_LANG,$idioma,$idBlog,$receta->_idCategoria);

  //banner
  $banner=new banner();
  $listaBanner=$banner->listBannerRand(1, false, 1, '', '', '', 1);
  ?>
  <div class="portada">
    <?php
    if(count($prev)>0){
      foreach ($prev as $p) {
    ?>
    <span class="pointer back" onclick="Javascript:location.href='<?=PATH?><?=$idioma?>/detalle-noticia/<?=$p['idBlog']?>-<?=$p['urlAmigable']?>'"><img src="<?=PATH?>img/icon-back.svg" alt="<?=NAME?> Blog" /> <?=v27?></span>
    <?php } } ?>
    <h1>
      <?php
      if($receta->_idCategoria==1){
      ?>
       <img src="<?=PATH?>img/icon-viajando.svg" alt="<?=NAME?> Blog" />
      <?php } else if($receta->_idCategoria==2){ ?>
       <img src="<?=PATH?>img/icon-fin-semana.svg" alt="<?=NAME?> Blog" />
      <?php } else if($receta->_idCategoria==3){ ?>
       <img src="<?=PATH?>img/icon-rutas.svg" alt="<?=NAME?> Blog" />
      <?php } else if($receta->_idCategoria==4){ ?>
       <img src="<?=PATH?>img/icon-viajes-carretera.svg" alt="<?=NAME?> Blog" />
      <?php } ?>

      <?=$receta -> _datosBlog -> _titulo?></b>
    </h1>

    <?php
    if(count($next)>0){
      foreach ($next as $n) {
    ?>
    <span class="pointer back next" onclick="Javascript:location.href='<?=PATH?><?=$idioma?>/detalle-noticia/<?=$n['idBlog']?>-<?=$n['urlAmigable']?>'"><img src="<?=PATH?>img/icon-next.svg" alt="<?=NAME?> Blog" /> <?=v28?></span>
    <?php } } ?>

  </div>
  <div class="inicio-1 b">
    <div class="master-slider ms-skin-default" id="masterslider">
      <?php
      foreach($listaSliderBlog as $elementoSlider){
      ?>
      <div class="ms-slide">
          <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH2?>img/imgTestimonio2/<?=$elementoSlider['imgPortada']?>" alt="<?=NAME?> Blog"/>
          <div class="titulo">
            <?=$elementoSlider['nombre']?>
          </div>
          <div class="frase">
            <?=$elementoSlider['ubicacion']?>
          </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <div class="inicio-3 detalle-blog">
    <div class="row row-con-margen">
      <div class="col-lg-1 col-md-1 col-sm-1">

      </div>
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="row row-con-margen">
          <div class="col-lg-8 col-md-8 col-sm-6">
            <h1><?=$receta -> subtitulo?><br /> <span><?=$fechaNot?></span></h1>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="derecha">
              <img src="<?=PATH?>img/icon-visitas.svg" alt="<?=NAME?> Blog" /> <?=$visitasActuales->visitas?> Vistas
              <div class="addthis_inline_share_toolbox_7eeo"></div>
            </div>
          </div>
        </div>
        <div class="divisor">
        </div>
        <?php
          if(isset($receta -> _contenidoBlog)){
            foreach ($receta -> _contenidoBlog as $_content) {
              if($_content['tipo'] == 1){
          ?>
          <div class="p"><?=$_content['descripcion']?></div>
          <?php
          }else if($_content['tipo'] == 2){
          ?>
          <img src="<?=PATH2?>img/imgBlog/contenido/<?=$_content['imagen']?>" class="w100Hauto img margin-30">
          <?php
          }else if($_content['tipo'] == 3){
          ?>
          <div class="margin-30">
              <div class="master-slider ms-skin-default slider-video" id="Onlyvideo-">
                  <div class="ms-slide">
                      <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH2?>img/imgBlog/contenido/<?=$_content['imagen']?>" alt="<?=$blog -> _datos_blog -> _titulo?>"/>
                      <a href="<?=$_content['iframe']?>" data-type="video">Noticia</a>
                  </div>
              </div>
          </div>
          <?php
          }else if($_content['tipo'] == 4){
          ?>
          <div class="row row-con-margen galeria">
            <?php foreach ($_content['galeria'] as $imagen) { ?>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <a data-fancybox="gallery" href="<?=PATH2?>img/imgBlog/contenido/galeria/<?=$imagen['ruta']?>">
                <img src="<?=PATH2?>img/imgBlog/contenido/galeria/<?=$imagen['ruta']?>" alt="<?=$receta -> _datosBlog -> _titulo?>" class="w100Hauto">
              </a>
            </div>
            <?php } ?>
          </div>
          <?php
          }
          }
          }
          ?>
        <!--Contenido dinámico-->
        <!--<div class="p">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lectus nunc, laoreet eu lorem id, cursus tincidunt arcu. Nullam commodo eleifend sapien vitae auctor. Aliquam nec pellentesque metus, sit amet aliquet sapien. Quisque ligula lectus, commodo nec gravida in, semper eget velit. Maecenas aliquet
        </div>
        <div class="titulo">
          Restaurantes
        </div>
        <div class="p">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lectus nunc, laoreet eu lorem id, cursus tincidunt arcu. Nullam commodo eleifend sapien vitae auctor. Aliquam nec pellentesque metus, sit amet aliquet sapien. Quisque ligula lectus, commodo nec gravida in, semper eget velit. Maecenas aliquet
        </div>
        <div class="row row-con-margen galeria">
          <div class="col-lg-4 col-md-4 col-sm-4">
            <img src="<?=PATH?>img/carrusel-1.jpg" alt="Galería" class="w100Hauto">
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <img src="<?=PATH?>img/carrusel-2.jpg" alt="Galería" class="w100Hauto">
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <img src="<?=PATH?>img/carrusel-3.jpg" alt="Galería" class="w100Hauto">
          </div>
        </div>
        <div class="titulo">
          Tips
        </div>
        <div class="p">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lectus nunc, laoreet eu lorem id, cursus tincidunt arcu. Nullam commodo eleifend sapien vitae auctor. Aliquam nec pellentesque metus, sit amet aliquet sapien. Quisque ligula lectus, commodo nec gravida in, semper eget velit. Maecenas aliquet vehicula felis eu lobortis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas non ex non justo cursus tempor ut at lorem. Mauris rhoncus id leo non congue. Phasellus id tellus neque. Ut nec tortor tempor, placerat enim sit amet, tempor est. Curabitur et ullamcorper turpis. Praesent quis diam at ligula iaculis gravida a molestie mauris. Nullam luctus lorem turpis, sed pulvinar nisl bibendum id. Morbi
        </div>-->
        <!--fin de contenido dinámico-->
        <div class="text-center rate">
          Rate <div class="rateyo" id="rateyo"></div>
          <div class="respuesta">

          </div>
        </div>
        <div class="divisor-punteado">
        </div>
        <?php
        foreach($listaBanner as $elementoBanner){
        ?>
        <a href="<?=$elementoBanner["link"]?>" target="_blank"><img src="<?=PATH2?>img/imgBanner/<?=$elementoBanner["imgPortada"]?>" class="w100Hauto" alt="Reservar" /></a>
        <?php } ?>
        <div class="divisor-punteado dos">
        </div>
        <div class="titulo-comentarios">
          <?php
          $comentarios=new blog();
          $listaComentarios=$comentarios->listaComentarios($idBlog);
          $totalComentarios=count($listaComentarios);
          ?>
          <span id="contadorComentarios"><?=$totalComentarios?></span> <?=v29?>
        </div>
        <div class="listaComentarios">
          <?php
          foreach($listaComentarios as $elementoComentario){
            //$fechaFormato=date_format($elementoComentario["fecha"], 'd/m/Y H:i:s');
          ?>
          <div class="comentario">
            <div class="circulo">
            </div>
            <span><?=$elementoComentario["nombre"]?></span>
            <div class="fecha">
              <?=$elementoComentario["fecha"]?>
            </div>
            <div class="texto">
              <?=$elementoComentario["mensaje"]?>
            </div>
          </div>
          <?php
          }
          ?>
          <!--<div class="comentario">
            <div class="circulo">
            </div>
            <span>Arold</span>
            <div class="fecha">
              Marzo 05 2019 a las 10:5 am
            </div>
            <div class="texto">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lectus nunc, laoreet eu lorem id, cursus tincidunt arcu. Nullam commodo eleifend sapien vitae auctor. Aliquam nec pellentesque metus, sit amet aliquet sapien. Quisque ligula lectus, commodo nec gravida in, semper eget velit.
            </div>
          </div>
          <div class="comentario">
            <div class="circulo">
            </div>
            <span>Arold</span>
            <div class="fecha">
              Marzo 05 2019 a las 10:5 am
            </div>
            <div class="texto">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lectus nunc, laoreet eu lorem id, cursus tincidunt arcu. Nullam commodo eleifend sapien vitae auctor. Aliquam nec pellentesque metus, sit amet aliquet sapien. Quisque ligula lectus, commodo nec gravida in, semper eget velit.
            </div>
          </div>-->
        </div>

        <div class="text-center mas-articulos" style="display:none">
          <button type="button"><?=v30?> <img src="<?=PATH?>img/arrow-right.svg" alt="<?=NAME?> Blog" /></button>
        </div>
        <div class="comenta">
          <b><?=v31?></b>
          <?=v32?>
        </div>
        <form class="comentar" method="post" id="form-comentario">
          <textarea name="name" id="comentario-mensaje"></textarea>
          <div class="row row-con-margen">
            <div class="col-lg-4 col-md-4 col-sm-4">
              <span class="helper"><?=v33?> *</span>
              <input type="text" name="" value="" id="comentario-nombre">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <span class="helper"><?=v34?> *</span>
              <input type="email" name="" value="" id="comentario-email">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 text-right">
              <span class="helper opacity-0">Email *</span>
              <button type="button" name="button" onclick="enviarComentario();"><?=v35?></button>
            </div>
          </div>
        </form>
        <div class="divisor-punteado tres">
        </div>

      </div>
      <div class="col-lg-1 col-md-1 col-sm-1">

      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 p-r30">
        <?php include("include/siderbar.php"); ?>
      </div>
    </div>
  </div>
  <?php include("include/relacionados.php"); ?>
  <?php include("include/footer.php"); ?>
  <?php include 'include/scripts.php';?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
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
      //$("#modalGracias").modal("show");
      $("#rateyo").rateYo({
     	rating: <?=$ratingCount?>,
    	fullStar: true,
    	ratedFill: "#ffec00",
        onSet: function (rating, rateYoInstance) {
     	  console.log(rating);
        var idBlog=<?=$idBlog?>;
        var ip='<?=$ip?>';
        var dataString2 = 'idBlog='+idBlog+'&ip='+ip+'&valor='+rating+'&operaciones=rating';
        $.ajax({
          type: "POST",
          url: "<?=PATH?>controller/controller.php",
          data: dataString2,
          success: function(data) {
            console.log(data);
            if(data==0){
              console.log("ya has calificado anteriormente");
              $(".respuesta").html("<b>Ya has calificado anteriormente.</b>");
            }else{
              console.log("gracias por calificar");
              $(".respuesta").html("<b>¡Gracias por calificar!</b>");
            }
          }
        });
          //alert("Rating is set to: " + rating);
        }
      });

      window.onload = function() {
         $('.slider-video').masterslider({
             width: 880,
             height: 520,
             space:5,
             view:'fade',
             layout:'fillwidth',
             autoHeight:true,
         });

         $('.slider-img').masterslider({
             width: 800,
             height: 500,
             space:1,
             loop: true,
             start: 1,
             preload: 5,
             view:'fade',
             layout:'fillwidth',
             autoHeight:true,
             controls : {
                 arrows : {autohide:false},
             }
         });

         $('.p span[style*="font-weight: bold;"]').addClass("titulo");

     }

     function enviarComentario(){

       //$("#btn-sends").attr("disabled", true);

       $("#comentario-nombre,#comentario-email,#comentario-mensaje").removeClass("error-borde");

       var filter=/^[A-Za-z0-9_.]*@[A-Za-z0-9_]+.[A-Za-z0-9_.]+[A-za-z]$/;
       var email = $('#comentario-email').val();
       var nombre = $('#comentario-nombre').val();
       var mensaje = $('#comentario-mensaje').val();
       //var captcha =$('#g-recaptcha-response').val();

       if (filter.test(email)){
       sendMail = "true";
       } else{
       $('#comentario-email').addClass("error-borde");
        //aplicamos color de borde si el se encontro algun error en el envio
       sendMail = "false";
       }
       if (nombre.length == 0 ){
       $('#comentario-nombre').addClass("error-borde");
       var sendMail = "false";
       }
       if (mensaje.length == 0 ){
       $('#comentario-mensaje').addClass("error-borde");
       var sendMail = "false";
       }


       //console.log($('input:radio[name=local]:checked').val());

       if(sendMail == "true"){

        var datos = {

         "operaciones" : "agregarComentarioBlog",

            "nombre" : $('#comentario-nombre').val(),

              "correo" : $('#comentario-email').val(),

              "mensaje" : $('#comentario-mensaje').val(),

              "idBlog" : <?=$idBlog?>

        };

        $.ajax({

            data:  datos,
            // hacemos referencia al archivo contacto.php
            url:   ''+PATH+'controller/controller.php',

            type:  'POST',

            beforeSend: function () {
            },

            success:  function (response) {
              console.log(response);
               if(response){
                var contadorComentarios=$("#contadorComentarios").text();
                var nuevoNumero=parseFloat(contadorComentarios) + 1;
                $("#contadorComentarios").text(nuevoNumero);
                $(".listaComentarios").append('<div class="comentario"><div class="circulo"></div><span>'+nombre+'</span><div class="fecha">'+response+'</div><div class="texto">'+mensaje+'</div></div>');
                $("#form-comentario")[0].reset();
               }



            }

        });

       } else{
       //$("#btn-sends").removeAttr("disabled");
       }

     }
		</script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5888fcb9c9c730fe"></script>
  </body>
</html>
