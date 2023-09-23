var app = new Vue({
	el: "#app",
	data: {
		adultos: 0,
		menores: 0
	},
	methods: {

	}
})

if (typeof is_order != 'undefined') {
	$( function(){

		$('#fechaSalida').datepicker({ format: "dd/mm/yyyy" });
		$('#fechaLlegada').datepicker({ format: "dd/mm/yyyy" });
	})
}