/*var track_load = 1; //total loaded record group(s)
var loading  = false; //to prevents multipal ajax loads
var total = 0;
var elementos = 8;
var proyectos = [];

$.ajax({
  	type: "POST",
  	url: ""+PATH+"controller/controller.php",
  	data: {'value':'listaProyecto','idCategoria':idCategoria,'idioma':idioma,'orderBy':orderBy},
  	success: function(data){
  		proyectos = JSON.parse(data);
  	}
})
.done(function(){
	total = Math.round(proyectos.length/8);
	cargaProyectos();
	if(proyectos.length < 1)
	{
		$(".btn-cargarmas").hide();
	}
});

function cargaProyectos(){
	var html = "";
	var inicio = (track_load - 1) * elementos;
    var ultimo = proyectos.length;
	loading = false;
	//console.log(inicio+" < "+ultimo);
	if(inicio < ultimo){
	    for (var i = 0; i < elementos; i++) {
			html += '<div class="col-lg-3 col-md-3 col-sm-3">'+
                    	'<div class="item">'+
                        	'<div class="img">'+
                            	'<div><a href="'+PATH+''+idioma+'/producto-detallado/'+proyectos[inicio].urlAmigable+'-'+proyectos[inicio].idProducto+'"><img src="'+PATH+'img/producto/galeria/'+proyectos[inicio].imgPortada+'" alt="producto"/></a></div>'+
                            '</div>'+
                            '<h1>'+proyectos[inicio].titulo+'</h1>'+
                            '<div class="p">'+proyectos[inicio].descripcion+'</div>'+
                            '<a href="'+PATH+''+idioma+'/producto-detallado/'+proyectos[inicio].urlAmigable+'-'+proyectos[inicio].idProducto+'" class="enlace">Ver producto</a><br />'+
                            '<h5>$0.00 MXN</h5>'+
                        '</div>'+
                    '</div>';

			/*html +='<a href="'+PATH+''+idioma+'/proyecto-detallado/'+proyectos[inicio].url_amigable+'-'+proyectos[inicio].id_proyecto+'"><div class="col-lg-4 col-md-4 col-sm-12 contiene-item">'+
                            	'<div class="item" style="cursor:pointer; background:url('+PATH+'img/imgProyectos/'+proyectos[inicio].img_principal+'); background-repeat: no-repeat; background-position: center; background-size: cover;-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover"></div>'+
                                '<div class="info">'+
                                    '<h3>'+tituloRes+'</h3>'+
                                    '<h4>'+subtituloRes+'</h4>'+
                                    '<span>'+proyectos[inicio].anio_terminacion+'</span>'+
                                '</div>'+
                            '</div></a>';
			if((inicio+1) == ultimo){
				i = elementos;
				$(".btn-cargarmas").hide();
			}
			inicio++;
	    };

		$(".listaProyectos").append(html);
		$(".proyecto").fadeIn(800).addClass("efecto");
	   	track_load++;
	}
}

$(".btn-cargarmas").click(function(){
	if(track_load <= total+1 && loading==false){
		loading = true; //prevent further ajax loading
		$('.animation_image').show(); //show loading image
		setTimeout(function(){
		//hide loading image
		$('.animation_image').hide(); //hide loading image once data is received
			cargaProyectos();
		}, 800);
		//console.log(track_load);
		//console.log(total);
		if(track_load == total+1)
			$(this).hide();
	}
});

/*
$(window).scroll(function() { //detect page scroll
	if($(window).width() > 100){
		if($(window).scrollTop() + $(window).height() == $(document).height()){
			//console.log(track_load+" <= "+total);
			if(track_load <= total+1 && loading==false){
				loading = true; //prevent further ajax loading
				$('.animation_image').show(); //show loading image
				setTimeout(function(){
					//hide loading image
					$('.animation_image').hide(); //hide loading image once data is received
					cargaProyectos();
				}, 800);
			}
		}
	}
});
*/


function filtrarProductos(){
	var track_load = 1; //total loaded record group(s)
	var loading  = false; //to prevents multipal ajax loads
	var total = 0;
	var elementos = 8;
	var proyectos = [];
	$(".listaProyectos").empty();
	$(".btn-cargarmas").show();
	$.ajax({
		type: "POST",
		url: ""+PATH+"controller/controller.php",
		data: {'operaciones':'listaReceta','idioma':idioma,'orden':orden},
		success: function(data){
			proyectos = JSON.parse(data);
		}
	})
	.done(function(){
		total = Math.round(proyectos.length/8);
		cargaProyectos();
		if(proyectos.length < 1)
		{
			$(".btn-cargarmas").hide();
		}
	});

	function cargaProyectos(){
	var html = "";
	var inicio = (track_load - 1) * elementos;
    var ultimo = proyectos.length;
	loading = false;
	//console.log(inicio+" < "+ultimo);
		if(inicio < ultimo){
			var contador=0;
			for (var i = 0; i < elementos; i++) {
				contador++;
				var video=proyectos[inicio].texto;
				if(idioma=='es'){
					var resTitulo=proyectos[inicio].nombre;
				}else{
					var resTitulo=proyectos[inicio].ubicacion;
				}
				if(video == ""){
					var href=''+PATH2+'img/imgTestimonio3/'+proyectos[inicio].imgPortada+'';
					var oculto='oculto';
				}else{
					var href=proyectos[inicio].texto;
					var oculto='';
				}
				/*html += '<div class="col-lg-4 col-md-4 col-sm-4">'+
                    	'<a href="'+PATH+''+idioma+'/receta-detallada/'+proyectos[inicio].idBlog+'-'+proyectos[inicio].urlAmigable+'"><div class="item" style="background:url('+PATH+'img/imgBlog/'+proyectos[inicio].portada+'); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover" >'+
                        	'<div class="info">'+
                                '<h1>'+proyectos[inicio].titulo+'</h1>'+
                                '<div class="p">'+proyectos[inicio].descripcion+'</div>'+
                                '<img src="'+PATH+'img/receta-sombra.png" class="w100Hauto sombra" />'+
                                '<img src="'+PATH+'img/receta-sombra-active.png" class="w100Hauto sombra-active" />'+
                            '</div>'+
                        '</div></a>'+
                    '</div>';*/
				if(contador==1){
					html +='<div class="col-lg-4 col-md-4 col-sm-4">'+
						'<a data-fancybox="gallery" data-width="1920" href="'+href+'">'+
							'<div class="item" style="background:url('+PATH2+'img/imgTestimonio3/'+proyectos[inicio].imgPortada+'); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">'+
								'<div class="info">'+
									'<h5 class="centrado">'+resTitulo+'</h5>'+
								'</div>'+
								'<img src="'+PATH+'img/play-video.svg" alt="Transfer Holbox Blog" class="centrado play-video '+oculto+'">'+
							'</div>'+
						'</a>'+
					'</div>';
				}

				if(contador==2){
					html +='<div class="col-lg-4 col-md-4 col-sm-4">'+
						'<a data-fancybox="gallery" data-width="1920" href="'+href+'">'+
							'<div class="item" style="background:url('+PATH2+'img/imgTestimonio3/'+proyectos[inicio].imgPortada+'); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">'+
								'<div class="info">'+
									'<h5 class="centrado">'+resTitulo+'</h5>'+
								'</div>'+
								'<img src="'+PATH+'img/play-video.svg" alt="Transfer Holbox Blog" class="centrado play-video '+oculto+'">'+
							'</div>'+
						'</a>'+
					'</div>';
				}

				if(contador==3){
					html +='<div class="col-lg-4 col-md-4 col-sm-4">'+
						'<a data-fancybox="gallery" data-width="1920" href="'+href+'">'+
							'<div class="item" style="background:url('+PATH2+'img/imgTestimonio3/'+proyectos[inicio].imgPortada+'); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">'+
								'<div class="info">'+
									'<h5 class="centrado">'+resTitulo+'</h5>'+
								'</div>'+
								'<img src="'+PATH+'img/play-video.svg" alt="Transfer Holbox Blog" class="centrado play-video '+oculto+'">'+
							'</div>'+
						'</a>'+
					'</div>';
				}

				if(contador==4){
					html +='<div class="col-lg-12 col-md-12 col-sm-12">'+
						'<a data-fancybox="gallery" data-width="1920" href="'+href+'">'+
							'<div class="item" style="background:url('+PATH2+'img/imgTestimonio3/'+proyectos[inicio].imgPortada+'); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">'+
								'<div class="info">'+
									'<h5 class="centrado">'+resTitulo+'</h5>'+
								'</div>'+
								'<img src="'+PATH+'img/play-video.svg" alt="Transfer Holbox Blog" class="centrado play-video '+oculto+'">'+
							'</div>'+
						'</a>'+
					'</div>';
					contador=0;
				}

				/*html +='<div class="col-lg-12 col-md-12 col-sm-12">'+
					'<a data-fancybox="gallery" data-width="1920" href="'+href+'">'+
						'<div class="item" style="background:url('+PATH2+'img/imgTestimonio3/'+proyectos[inicio].imgPortada+'); background-repeat: no-repeat; background-position: center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover">'+
							'<div class="info">'+
								'<h5 class="centrado">'+resTitulo+'</h5>'+
							'</div>'+
							'<img src="'+PATH+'img/play-video.svg" alt="Transfer Holbox Blog" class="centrado play-video '+oculto+'">'+
						'</div>'+
					'</a>'+
				'</div>';*/



				/*html += '<div class="col-lg-3 col-md-3 col-sm-3">'+
							'<div class="item">'+
								'<div class="img">'+
									'<div><a href="'+PATH+''+idioma+'/producto-detallado/'+proyectos[inicio].idProducto+'-'+proyectos[inicio].urlAmigable+'"><img src="'+PATH+'img/producto/galeria/'+proyectos[inicio].imgPortada+'" alt="producto"/></a></div>'+
								'</div>'+
								'<h1>'+proyectos[inicio].titulo+'</h1>'+
								'<div class="p">'+proyectos[inicio].descripcion+'</div>'+
								'<a href="'+PATH+''+idioma+'/producto-detallado/'+proyectos[inicio].idProducto+'-'+proyectos[inicio].urlAmigable+'" class="enlace">Ver producto</a><br />'+
								'<h5>$'+proyectos[inicio].precio+' MXN</h5>'+
							'</div>'+
						'</div>';*/

				/*html +='<a href="'+PATH+''+idioma+'/proyecto-detallado/'+proyectos[inicio].url_amigable+'-'+proyectos[inicio].id_proyecto+'"><div class="col-lg-4 col-md-4 col-sm-12 contiene-item">'+
									'<div class="item" style="cursor:pointer; background:url('+PATH+'img/imgProyectos/'+proyectos[inicio].img_principal+'); background-repeat: no-repeat; background-position: center; background-size: cover;-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover"></div>'+
									'<div class="info">'+
										'<h3>'+tituloRes+'</h3>'+
										'<h4>'+subtituloRes+'</h4>'+
										'<span>'+proyectos[inicio].anio_terminacion+'</span>'+
									'</div>'+
								'</div></a>';*/
				if((inicio+1) == ultimo){
					i = elementos;
					$(".btn-cargarmas").hide();
				}
				inicio++;
			};

			$(".listaProyectos").append(html);
			track_load++;
		}
	}

	$(".btn-cargarmas").click(function(){
		if(track_load <= total+1 && loading==false){
			loading = true; //prevent further ajax loading
			//$('.animation_image').show(); //show loading image
			setTimeout(function(){
			//hide loading image
			//$('.animation_image').hide(); //hide loading image once data is received
				cargaProyectos();
			}, 800);
			//console.log(track_load);
			//console.log(total);
			if(track_load == total+1)
				$(this).hide();
		}
	});
}
