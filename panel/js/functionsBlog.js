
var _temporalID = 0;

function addContenido(_tipo){
	var _html = '',
		_content = $('#content-element-blog');
	switch(_tipo){
		case '1':
			_html = '<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-'+_temporalID+'">'+
					    '<div class="close" onclick="deleteElement('+_temporalID+', \'contenido-blog-\', \'\', \'false\')"> <i class="fa fa-times"></i> </div>'+
					    '<input type="hidden" name="temporal-id[]" value="'+_temporalID+'">'+
					    '<input type="hidden" name="tipo-contenido[]" value="'+_tipo+'">'+
					    '<div class="input-group espacios">'+
							'<span class="input-group-addon">Descripción</span>'+
							'<textarea rows="5" class="form-control" data-validate="false" name="descripcion-contenido-'+_temporalID+'" id="desc-cont-'+_temporalID+'"></textarea>'+
						'</div>'+
						'<hr class="divisor-seccion">'+
					'</div>';
			_content.append(_html);
			setTimeout(function(){
				initSummernoteBlog(_temporalID);
				window.location.hash = '#contenido-blog-'+_temporalID;
				_temporalID ++;
			},100);
		break;
		case '2':
			_html = '<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-'+_temporalID+'">'+
					    '<div class="close" onclick="deleteElement('+_temporalID+', \'contenido-blog-\', \'\', \'false\')"> <i class="fa fa-times"></i> </div>'+
					    '<input type="hidden" name="temporal-id[]" value="'+_temporalID+'">'+
					    '<input type="hidden" name="tipo-contenido[]" value="'+_tipo+'">'+
					    '<center>'+
					        '<div id="preview-img-contenido-'+_temporalID+'" class="espacios"><div class="preview-example"></div></div>'+
							'<input type="file" data-validate="true" data-type-file="imagen" id="img-contenido-'+_temporalID+'" onchange="showMyImageWH(\'preview-img-contenido-'+_temporalID+'\', this, \'\', 1, 800, 600)" name="img-contenido-'+_temporalID+'" class="filestyle">'+
							'<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>'+
						'</center>'+
						'<hr class="divisor-seccion">'+
					'</div>';
			_content.append(_html);
			setTimeout(function(){
				initFileStyleImagenBlog(_temporalID);
				window.location.hash = '#contenido-blog-'+_temporalID;
				_temporalID ++;
			},100);
		break;
		case '3':
			_html = '<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-'+_temporalID+'">'+
					    '<div class="close" onclick="deleteElement('+_temporalID+', \'contenido-blog-\', \'\', \'false\')"> <i class="fa fa-times"></i> </div>'+
					    '<input type="hidden" name="temporal-id[]" value="'+_temporalID+'">'+
					    '<input type="hidden" name="tipo-contenido[]" value="'+_tipo+'">'+
					    '<center>'+
					        '<div id="preview-video-contenido-'+_temporalID+'" class="espacios"><div class="preview-example"></div></div>'+
							'<input type="file" data-validate="true" data-type-file="imagen" id="video-contenido-'+_temporalID+'" onchange="showMyImageWH(\'preview-video-contenido-'+_temporalID+'\', this, \'\', 1, 800, 600)" name="video-contenido-'+_temporalID+'" class="filestyle">'+
							'<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>'+
						'</center>'+
						'<div class="input-group espacios">'+
							'<span class="input-group-addon">Url</span>'+
							'<input type="text" name="url-contenido-'+_temporalID+'" data-validate="true" class="form-control" placeholder="Ingresa la url del video.." value="">'+
						'</div>'+
						'<hr class="divisor-seccion">'+
					'</div>';
			_content.append(_html);
			setTimeout(function(){
				initFileStyleVideoBlog(_temporalID);
				window.location.hash = '#contenido-blog-'+_temporalID;
				_temporalID ++;
			},100);
		break;
		case '4':
			_html = '<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-'+_temporalID+'">'+
					    '<div class="close" onclick="deleteElement('+_temporalID+', \'contenido-blog-\', \'\', \'false\')"> <i class="fa fa-times"></i> </div>'+
					    '<input type="hidden" name="temporal-id[]" value="'+_temporalID+'">'+
					    '<input type="hidden" name="tipo-contenido[]" value="'+_tipo+'">'+
					    '<center>'+
							'<input type="file" multiple id="galeria-contenido-'+_temporalID+'" onchange="showMyImageWH(\'preview-galeria-contenido-'+_temporalID+'\', this, \'\', 2, 800, 600)" name="galeria-contenido-'+_temporalID+'[]" class="filestyle">'+
							'<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>'+
						'</center>'+
						'<div class="col-md-12 col-xs-12">'+
							'<div class="row" id="preview-galeria-contenido-'+_temporalID+'"></div>'+
						'</div>'+
						'<hr class="divisor-seccion">'+
					'</div>';
			_content.append(_html);
			setTimeout(function(){
				initFileStyleGaleriaBlog(_temporalID);
				window.location.hash = '#contenido-blog-'+_temporalID;
				_temporalID ++;
			},100);
		break;
	}

}

$('#add-texto').on('click', function(){
	addContenido('1');
})
$('#add-imagen').on('click', function(){
	addContenido('2');
})
$('#add-video').on('click', function(){
	addContenido('3');
})
$('#add-galeria').on('click', function(){
	addContenido('4');
})


function initSummernoteBlog(id){
	$("#desc-cont-"+id).summernote({
		height: 150,
		focus: false,
		toolbar: [
    		//[groupname, [button list]]
    		['style', ['bold', 'italic', 'underline', 'clear']],
  		],
  		onpaste: function(e) {
            var thisNote = $(this);
            var updatePastedText = function(someNote){
            	var original = someNote.code();
                var cleaned = CleanPastedHTML(original); //this is where to call whatever clean function you want. I have mine in a different file, called CleanPastedHTML.
                someNote.code('').html(cleaned); //this sets the displayed content editor to the cleaned pasted code.
            };
            setTimeout(function () {
                updatePastedText(thisNote);
            }, 10);
        }
	});
}

function initFileStyleImagenBlog(_id){
	 $('#img-contenido-'+_id).filestyle({
	 	input: false,
	   	buttonText: "Imagen",
	   	iconName: "fa fa-picture-o",
	 });
}

function initFileStyleVideoBlog(_id){
	 $('#video-contenido-'+_id).filestyle({
	 	input: false,
	   	buttonText: "Portada Video",
	   	iconName: "fa fa-picture-o",
	 });
}

function initFileStyleGaleriaBlog(_id){
	 $('#galeria-contenido-'+_id).filestyle({
	 	input: false,
	   	buttonText: "Subir Imagenes",
	   	iconName: "fa fa-picture-o",
	 });
}

$( "#content-element-blog" ).sortable({
	cursor: "move",
	delay: 150,
	distance: 5,
	forceHelperSize: true,
	handle: ".handle",
	opacity: 0.5,
	revert: true,
	update : function(e, ui) {
		guardarOrdenMovil(_SORT);
	}
});
function guardarOrdenMovil(desde){
	var orden = new Array;
	$(".idorden").each(function(){
		orden.push($(this).val());
	});
	var _initFor = $('#initfor').val();
	if(typeof _initFor != 'undefined'){
		_initFor = _initFor
	}else{
		_initFor = 0;
	}

	$.ajax({
		async:true,
		type: "POST",
		dataType: "html",
		contentType: "application/x-www-form-urlencoded",
		url:"operaciones.php",
		data:{"idorden":orden,"operaciones":"ordenar","desde":desde, "initfor" : _initFor},
		success:function(data){
			console.log(data);
			$('.bottom-right').notify({
				message: { text: 'Orden guardado correctamente' },
				type:'blackgloss',
				fadeOut: { enabled: true, delay: 2000 }
			}).show();
		},
		cache:false
	});
}


/* ========================================================
 * Función que obtiene las subcategorias relacionadas
 * con la categoria seleccionada
 * ======================================================== */
function getSubcategorias(){
	var selectCategoria = $('#idCategoria').val();
	var selectSubcategoria = $('#idSubcategoria');
	var subcategoriaSelected = $('#idSubcategoriaSelected').val();
	$.post('operaciones.php', {operaciones : 'getSubcategorias', idCategoria : selectCategoria}, function(data){
		//console.error(data);
		if(data != '[]'){
			var resultado = JSON.parse(data);
			selectSubcategoria.empty();
			for(var i in resultado){
				selectSubcategoria.append('<option value="'+resultado[i].idSubcategoria+'">'+resultado[i].nombre+'</option>');
			}
			selectSubcategoria.prop('disabled', false);
			selectSubcategoria.selectpicker('refresh');
			if(subcategoriaSelected != 0){
				console.error('entre');
				selectSubcategoria.selectpicker('val', subcategoriaSelected);
			}else{
				console.error('no entre');
			}
		}else{
			selectSubcategoria.empty();
			selectSubcategoria.append('<option selected value="0">Sin subcategorias disponibles</option>');
			selectSubcategoria.prop('disabled', true);
			selectSubcategoria.selectpicker('refresh');
		}
	})
}

$('#idCategoria').change(function() {
	getSubcategorias();
});
$(document).ready(function(){
	if($('#multiselect').length > 0)
		$('#multiselect').multiSelect();
 	setTimeout(function(){
 		getSubcategorias()
 	},10)
 	$('.selectpicker-general').selectpicker();
})

$(document).ready(function(){
    if($('#multiselect').length > 0)
        $('#multiselect').multiSelect();
    setTimeout(function(){
        //getSubcategorias()
    },10)
    $('.selectpicker-general').selectpicker();
})

$(window).load(function(){
	if($('#multiselect2').length > 0)
		$('#multiselect2').multiSelect();

})
