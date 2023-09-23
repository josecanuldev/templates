 var _cont = 0;
function addSeccion(_tipo){
	if(_tipo == 1){
		var _html = '<div class="seccion-'+_cont+'" id="seccion-'+_cont+'">'+
			            '<input type="hidden" name="seccion[]" value="'+_cont+'">'+
			            '<input type="hidden" name="seccion-tipo[]" value="1">'+
			            '<div class="col-md-8 col-md-offset-2 col-xs-12">'+
			            	'<div onclick="deleteElement('+_cont+', \'seccion-\', \'\', \'false\')" rel="tooltip" data-title="Eliminar" class="close manita"> <i class="fa fa-trash"></i> </div>'+
				            '<center>'+
								'PREVISUALIZAR IMAGEN'+
								'<div id="preview-img-contenido-'+_cont+'" class="espacios">'+
									'<div class="preview-example"></div>'+
								'</div>'+				
								'<input type="file" data-validate="true" data-type-file="imagen" data-text="Imagen" onchange="showMyImage(\'preview-img-contenido-'+_cont+'\', this)" name="archivo-contenido-'+_cont+'[]" class="filestyle" data-input="false" data-buttonText="Imagen" data-iconName="fa fa-picture-o" data-badge="false">'+
								'<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, La imagen debe ser menor a 3 MB.</p>'+
							'</center>'+
			            '</div>'+
			        '</div>'+
			        '<div class="clearfix"></div>';
	}else{
		var _html = '<div class="seccion-2" id="seccion-'+_cont+'">'+
		                '<input type="hidden" name="seccion[]" value="'+_cont+'">'+
		                '<input type="hidden" name="seccion-tipo[]" value="2">'+
		                '<div class="col-md-4 col-md-offset-2 col-xs-12">'+
			                '<center>'+
								'PREVISUALIZAR IMAGEN'+
								'<div id="preview-img-contenido-'+_cont+'-1" class="espacios">'+
									'<div class="preview-example"></div>'+
								'</div>'+
								'<input type="file" data-validate="true" data-type-file="imagen" data-text="Imagen" onchange="showMyImage(\'preview-img-contenido-'+_cont+'-1\', this)" name="archivo-contenido-'+_cont+'[]" class="filestyle" data-input="false" data-buttonText="Imagen" data-iconName="fa fa-picture-o" data-badge="false">'+									'<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, La imagen debe ser menor a 3 MB.</p>'+
							'</center>'+
		                '</div>'+
		                '<div class="col-md-4 col-xs-12">'+
		                	'<div onclick="deleteElement('+_cont+', \'seccion-\', \'\', \'false\')" rel="tooltip" data-title="Eliminar" class="close manita"> <i class="fa fa-trash"></i> </div>'+
			                '<center>'+
								'PREVISUALIZAR IMAGEN'+
								'<div id="preview-img-contenido-'+_cont+'-2" class="espacios">'+
									'<div class="preview-example"></div>'+
								'</div>'+
								'<input type="file" data-validate="true" data-type-file="imagen" data-text="Imagen" onchange="showMyImage(\'preview-img-contenido-'+_cont+'-2\', this)" name="archivo-contenido-'+_cont+'[]" class="filestyle" data-input="false" data-buttonText="Imagen" data-iconName="fa fa-picture-o" data-badge="false">'+
								'<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, La imagen debe ser menor a 3 MB.</p>'+
							'</center>'+
		                '</div>'+
		            '</div>';
		            '<div class="clearfix"></div>';
	}
	$('#content-galeria').append(_html);
	setTimeout(function(){
		initPlugins();
	},100)
	window.location.hash = '#seccion-'+_cont;
	_cont ++;
}

function initPlugins(){
	$('.filestyle').filestyle({input: false, buttonText: "Imagen", iconName: "fa fa-picture-o"});
	$('[rel="tooltip"]').tooltip();
}

$( "#content-galeria" ).sortable({
	    cursor: "move",
	    delay: 150,
	    distance: 5,
	    forceHelperSize: true,
	    handle: ".handle",
	    opacity: 0.5,
	    revert: true,
	    update : function(e, ui) {
	    	guardarOrden(_SORT);
	    }
	});

