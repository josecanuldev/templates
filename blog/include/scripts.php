<!--Importando materialize o bootstrap, también van aquí todo los javascript que necesitara nuesta pagina-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<script type="text/javascript" src="<?= PATH;?>js/bootstrap.min.js"></script>

<script type='text/javascript' src="<?=PATH?>js/bootstrap-slider.js"></script>

<script src="<?=PATH?>js/scrollReveal.min.js"></script>

<script src="<?=PATH?>js/modernizr.js"></script>

<script src="<?=PATH?>js/royalslider/jquery.royalslider.min.js"></script>

<script type="text/javascript" src="<?=PATH?>js/rate/jquery.rateyo.js"></script>

<script>
	var PATH='<?=PATH?>';
	var PATH2='<?=PATH2?>';
</script>

<!-- archivo javascript que incluye nuestras funciones de la pagina -->

<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>

<script type="text/javascript" src="<?= PATH;?>js/funciones.js"></script>

<script src="<?=PATH?>js/jquery.matchHeight.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>

<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

<script src="https://unpkg.com/ionicons@4.2.4/dist/ionicons.js"></script>

<script type="text/javascript" src="<?=PATH?>js/slick/slick.min.js"></script>

<!-- Navegadores des-actualizados -->
<script src="<?= PATH;?>js/outdatedBrowser.min.js"></script>
    <script>
	    function addLoadEvent(func) {
		    var oldonload = window.onload;
		    if (typeof window.onload != 'function') {
		        window.onload = func;
		    } else {
		        window.onload = function() {
		            oldonload();
		            func();
		        }
		    }
		}
		//call plugin function after DOM ready
		addLoadEvent(
		    outdatedBrowser({
		        bgColor: '#f25648',
		        color: '#ffffff',
		        lowerThan: 'transform'
		    })
		);

		//USING jQuery
		$( document ).ready(function() {
		    outdatedBrowser({
		        bgColor: '#f25648',
		        color: '#ffffff',
		        lowerThan: 'transform'
		    })
		})

		//$("#modalStars").modal("show");

		function enviarMensaje(){

      //$("#btn-sends").attr("disabled", true);

      $("#c-nombre,#c-pais,#c-ciudad,#c-correo").removeClass("error-borde");
      $('#c-pasajeros').parent().find(".btn-default").removeClass("error-borde");

      var filter=/^[A-Za-z0-9_.]*@[A-Za-z0-9_]+.[A-Za-z0-9_.]+[A-za-z]$/;
      var email = $('#c-correo').val();
      var nombre = $('#c-nombre').val();
      var pais = $('#c-pais').val();
      var ciudad = $('#c-ciudad').val();
      //var captcha =$('#g-recaptcha-response').val();

      if (filter.test(email)){
      sendMail = "true";
      } else{
      $('#c-correo').addClass("error-borde");
       //aplicamos color de borde si el se encontro algun error en el envio
      sendMail = "false";
      }
      if (nombre.length == 0 ){
      $('#c-nombre').addClass("error-borde");
      var sendMail = "false";
      }
      if (pais.length == 0 ){
      $('#c-pais').addClass("error-borde");
      var sendMail = "false";
      }
      if (ciudad.length == 0 ){
      $('#c-ciudad').addClass("error-borde");
      var sendMail = "false";
      }

			if(!$("#temas-1").prop("checked")){
				var tema1="";
			}
			else{
				var tema1=$("#temas-1").val();
			}

			if(!$("#temas-2").prop("checked")){
				var tema2="";
			}
			else{
				var tema2=$("#temas-2").val();
			}

			if(!$("#temas-3").prop("checked")){
				var tema3="";
			}
			else{
				var tema3=$("#temas-3").val();
			}

			if(!$("#temas-4").prop("checked")){
				var tema4="";
			}
			else{
				var tema4=$("#temas-4").val();
			}

			if(!$("#temas-5").prop("checked")){
				var tema5="";
			}
			else{
				var tema5=$("#temas-5").val();
			}

			if(!$("#temas-6").prop("checked")){
				var tema6="";
			}
			else{
				var tema1=$("#temas-6").val();
			}


      //console.log($('input:radio[name=local]:checked').val());

      if(sendMail == "true"){

       var datos = {

				 "operaciones" : "agregarNewsletterBlog",

           "nombre" : $('#c-nombre').val(),

             "correo" : $('#c-correo').val(),

             "pais" : $('#c-pais').val(),

             "ciudad" : $('#c-ciudad').val(),

             "genero" : $('input:radio[name=genero]:checked').val(),

						 "tema1" : tema1,

						 "tema2" : tema2,

						 "tema3" : tema3,

						 "tema4" : tema4,

						 "tema5" : tema5,

						 "tema6" : tema6

       };

       $.ajax({

           data:  datos,
           // hacemos referencia al archivo contacto.php
           url:   ''+PATH+'controller/controller.php',

           type:  'POST',

           beforeSend: function () {
           },

           success:  function (response) {
              if(response){
								$("#modalSuscribirse .pantalla").hide();
								$("#modalSuscribirse .pantalla-2").show();
              }



           }

       });

      } else{
      //$("#btn-sends").removeAttr("disabled");
      }

    }

</script>
<?php
if(strpos($self,"index")){
	echo '<script>
		$(".flotante").addClass("uno");
	</script>';
}
if(strpos($self,"detalle-blog")){
	echo '<script>
		$(".flotante").addClass("tres");
	</script>';
}
?>
