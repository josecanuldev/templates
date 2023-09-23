var pickerOptsGeneral = {
	locale:  "es",
	format: 'LL',
	useCurrent: true
};

$('.apply-dateInicio').datetimepicker(pickerOptsGeneral);
$('.apply-dateExpiracion').datetimepicker(pickerOptsGeneral);

$('.apply-dateInicio').on('dp.change', function(e){
	var formatted = moment(e.date, 'LL').format('YYYY-MM-DD');
	$('#fechaFinalInicio').val(formatted);
})

$('.apply-dateExpiracion').on('dp.change', function(e){
	var formatted = moment(e.date, 'LL').format('YYYY-MM-DD');
	$('#fechaFinalExp').val(formatted);
})

/*$('#idCategoria').on('change', function(){
	var _value = $(this).val();
	getProductosPerCategoria(_value);
})

function getProductosPerCategoria(_idCategoria){
	$.post('operaciones.php', {operaciones :  'getProductoxCategoria', idCategoria : _idCategoria}, function(data){
		console.log(data);
		var _response = JSON.parse(data);
		$('#select-producto').empty();
		for(var _i in _response){
			$('#select-producto').append('<option value="'+_response[_i].idProducto+'" >'+_response[_i].titulo+'</option>')
		}
		$('#select-producto').multiSelect('refresh');
	})
}*/

