Vue.http.options.emulateJSON = true;
var app = new Vue({
	el: "#app",
	data: {
		is_loading_orders: false,
		rows: 0,
		hoy: moment(hoy).format("DD/MM/YYYY"),
		hoyMenos15Dias: moment(hoyMenos15Dias).format("DD/MM/YYYY"),
		is_loading_send: false
	},
	mounted(){
	},
	methods: {
		getTableRows(response) {
			this.rows = response.row.length
		},
		refreshTable(){
			$("#grid").data("kendoGrid").dataSource.read();
		},
		next(){
			var self = this
			var ifFebrauryNext = moment(self.hoy, "DD-MM-YYYY").format("MM")
			var addDaysNext = ifFebrauryNext == '02' ? 13 : 15
			var aumentar1 = moment(self.hoy, "DD-MM-YYYY").add(addDaysNext, 'days').format("DD/MM/YYYY")
			var dia = +moment(aumentar1, "DD-MM-YYYY").format("DD")
			console.log(addDaysNext, ifFebrauryNext, aumentar1, 'dia')
			if (dia <= 15) {
				self.hoyMenos15Dias = moment(aumentar1, "DD-MM-YYYY").startOf('month').format("DD/MM/YYYY")
				self.hoy = moment(aumentar1, "DD-MM-YYYY").format("15/MM/YYYY")
			} else {
				self.hoyMenos15Dias = moment(aumentar1, "DD-MM-YYYY").format("16/MM/YYYY")
				self.hoy = moment(aumentar1, "DD-MM-YYYY").endOf('month').format("DD/MM/YYYY")
			}
			setTimeout(function(){
				self.refreshTable()
			}, 50);
		},
		back(){
			var self = this
			var addDaysBack = 16
			var aumentar1 = moment(self.hoy, "DD-MM-YYYY").subtract(addDaysBack, 'days').format("DD/MM/YYYY")
			var dia = +moment(aumentar1, "DD-MM-YYYY").format("DD")
			console.log(dia, addDaysBack, aumentar1, 'dia')
			if (dia <= 15) {
				self.hoyMenos15Dias = moment(aumentar1, "DD-MM-YYYY").startOf('month').format("DD/MM/YYYY")
				self.hoy = moment(aumentar1, "DD-MM-YYYY").format("15/MM/YYYY")
			} else {
				self.hoyMenos15Dias = moment(aumentar1, "DD-MM-YYYY").format("16/MM/YYYY")
				self.hoy = moment(aumentar1, "DD-MM-YYYY").endOf('month').format("DD/MM/YYYY")
			}

			setTimeout(function(){
				self.refreshTable()
			}, 50);			
		},
		changeAgency(){
			this.refreshTable()
		},
		sendEstadoCuentas() {
			this.is_loading_send = true
			var self = this
			var fecha_start = $("#hoyMenos15Dias").val();
			var fecha_end = $("#hoy").val();
			var id_agencia = $("#id_agencia").val();

			// var dataString = $('#form_fechas').serialize();

			$.ajax({
				url: baseUrl + '/agencies/enviarEstadoCuenta?hoy=' + fecha_start + '&hoyMenos15Dias=' + fecha_end + '&id_agencia=' + id_agencia,
				type: 'GET'
			})
			.done(function(response) {
				self.is_loading_send = false
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				self.is_loading_send = false
			});
		}
	}
})


$("#btn_pdf").click(function(e) {
	var fecha_start = $("#hoyMenos15Dias").val();
	var fecha_end = $("#hoy").val();
	var id_agencia = $("#id_agencia").val();

	$("#fecha_start").val(fecha_start);
	$("#fecha_end").val(fecha_end);
	$("#id_agencia_pdf").val(id_agencia);

	$("#form_pdf").submit();
});