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
		refreshTable() {
			$("#grid").data("kendoGrid").dataSource.read();
		},
		next() {
			var rango = $("#tipo_rango").val()
			switch(rango) {
				case '0':
				this.Semanal(true)
				break;
				case '1':
				this.Quincenal(true)
				break;
				case '2':
				this.Mensual(true)
				break;
			}
		},
		back() {
			var rango = $("#tipo_rango").val()
			switch(rango) {
				case '0':
				this.Semanal(false)
				break;
				case '1':
				this.Quincenal(false)
				break;
				case '2':
				this.Mensual(false)
				break;
			}
		},
		Quincenal(next) {
			var self = this
			if (next) {
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
			} else {
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
			}
			setTimeout(function(){
				self.refreshTable()
			}, 50);
		},
		Semanal(next) {
			var self = this
			if (next) {
				var aumentar1 = moment(self.hoy, "DD-MM-YYYY").add(1, 'week').format("DD/MM/YYYY")
				self.hoyMenos15Dias = moment(aumentar1, "DD-MM-YYYY").startOf('week').format("DD/MM/YYYY")
				self.hoy = moment(aumentar1, "DD-MM-YYYY").endOf('week').format("DD/MM/YYYY")
			} else {
				var aumentar1 = moment(self.hoy, "DD-MM-YYYY").subtract(1, 'week').format("DD/MM/YYYY")
				self.hoyMenos15Dias = moment(aumentar1, "DD-MM-YYYY").startOf('week').format("DD/MM/YYYY")
				self.hoy = moment(aumentar1, "DD-MM-YYYY").endOf('week').format("DD/MM/YYYY")
			}
			setTimeout(function(){
				self.refreshTable()
			}, 50);
		},
		Mensual(next) {
			var self = this
			if (next) {
				var aumentar1 = moment(self.hoy, "DD-MM-YYYY").add(1, 'month').format("DD/MM/YYYY")
				self.hoyMenos15Dias = moment(aumentar1, "DD-MM-YYYY").startOf('month').format("DD/MM/YYYY")
				self.hoy = moment(aumentar1, "DD-MM-YYYY").endOf('month').format("DD/MM/YYYY")
			} else {
				var aumentar1 = moment(self.hoy, "DD-MM-YYYY").subtract(1, 'month').format("DD/MM/YYYY")
				self.hoyMenos15Dias = moment(aumentar1, "DD-MM-YYYY").startOf('month').format("DD/MM/YYYY")
				self.hoy = moment(aumentar1, "DD-MM-YYYY").endOf('month').format("DD/MM/YYYY")
			}
			setTimeout(function(){
				self.refreshTable()
			}, 50);
		},
		changeAgency() {
			this.refreshTable()
		},
		changeRangeDate(ev) {
			console.log(ev, 'ev')
			var rango = ev.target.value
			var self = this
			var hoy = ''
			var hoyMenos15Dias = ''
			var checkDate
			switch(rango) {
				case '0':
				checkDate = moment(self.hoy, "DD-MM-YYYY").format("DD/MM/YYYY")
				hoyMenos15Dias = moment(checkDate, "DD-MM-YYYY").startOf('week').format("DD/MM/YYYY")
				hoy = moment(checkDate, "DD-MM-YYYY").endOf('week').format("DD/MM/YYYY")
				break;
				case '1':
				checkDate = moment(self.hoy, "DD-MM-YYYY").format("DD/MM/YYYY")
				var dia = +moment(checkDate, "DD-MM-YYYY").format("DD")
				if (dia <= 15) {
					hoyMenos15Dias = moment(checkDate, "DD-MM-YYYY").startOf('month').format("DD/MM/YYYY")
					hoy = moment(checkDate, "DD-MM-YYYY").format("15/MM/YYYY")
				} else {
					hoyMenos15Dias = moment(checkDate, "DD-MM-YYYY").format("16/MM/YYYY")
					hoy = moment(checkDate, "DD-MM-YYYY").endOf('month').format("DD/MM/YYYY")
				}
				break;
				case '2':
				checkDate = moment(self.hoy, "DD-MM-YYYY").format("DD/MM/YYYY")
				hoyMenos15Dias = moment(checkDate, "DD-MM-YYYY").startOf('month').format("DD/MM/YYYY")
				hoy = moment(checkDate, "DD-MM-YYYY").endOf('month').format("DD/MM/YYYY")
				break;
			}

			if (hoy != '') {
				self.hoy = hoy
				$("#hoy").val(hoy)
			}
			if (hoyMenos15Dias != '') {
				self.hoyMenos15Dias = hoyMenos15Dias
				$("#hoyMenos15Dias").val(hoyMenos15Dias)
			}
			console.log(hoy, hoyMenos15Dias);
			setTimeout(function(){
				self.refreshTable()
			}, 100);
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
	// type=all&fecha_de=16%2F10%2F2022&fecha_hasta=16%2F10%2F2022&tipoFecha=all&id_agencia=0&PDF=TRUE
	var fecha_de = $("#hoyMenos15Dias").val();
	var fecha_hasta = $("#hoy").val();

	$("#fecha_de").val(fecha_de);
	$("#fecha_hasta").val(fecha_hasta);

	$("#form_pdf").submit();
});