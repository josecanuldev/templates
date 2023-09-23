Vue.http.options.emulateJSON = true;
var app = new Vue({
	el: "#app",
	data: {
		adultos: 0,
		menores: 0,
		holbox: {
			adultos: 0,
			menores: 0
		},
		chiquila: {
			adultos: 0,
			menores: 0
		},
		ordenreserva: {
			idorden: 0,
			idreserva: 0,
			subtotal: 0,
			total: 0,
			status: 3,
			tipo: 1,
			descuento: 0,
			idCodigoPromo: 0,
			observaciones: "",
			moneda: 'MXN',
			tipo_cambio: 1
		},
		driversItems: [],
		driver: {
			idreserva: 0,
			id_driver: 0
		},
		selectedOrder: 0,
		is_loading_orders: false,
		rows: 0,
		is_loading_sendPdf: false
	},
	mounted(){
		this.getDrivers()
	},
	methods: {
		getDesglose(response){
			this.holbox = response.desglose.holbox;
			this.chiquila = response.desglose.chiquila
			this.rows = response.row.length
		},
		openModal(item){
			this.driver.idreserva = item.idreserva
			if (item.id_driver != null) {
				this.driver.id_driver = item.id_driver
			}
			$("#driversModal").modal("show");
		},
		openModalOrders(item){
			var self = this
			this.clear()
			$("#writePrice").modal("show")
			self.ordenreserva.idreserva = item.idreserva
		},
		clear(){
			this.ordenreserva = {
				idorden: 0,
				subtotal: 0,
				total: 0,
				status: 3,
				tipo: 1,
				descuento: 0,
				idCodigoPromo: 0,
				observaciones: "",
				moneda: 'MXN',
				tipo_cambio: 1
			}
		},
		clearDriver(){
			this.driver = {
				idreserva: 0,
				id_driver: 0
			}
		},
		changeTipoFecha(){
			this.refreshTable()
		},
		changeAgency(){
			this.refreshTable()
		},
		changeTipoViaje(){
			this.refreshTable()
		},
		refreshTable(){
			$("#grid").data("kendoGrid").dataSource.read();
		},
		saveOrders(){
			if (!this.validationOrder()) {
				this.is_loading_orders = true
				var url = "";
				var mensaje = ""
				var self = this
				if (this.ordenreserva.idorden > 0) {
					url = baseUrl + '/orders/update/id/' + this.ordenreserva.idorden;
					mensaje = "Orden actualizada correctamente"
				} else {
					url = baseUrl + '/orders/create';
					mensaje = "Orden creada correctamente"
				}
				this.$http.post(url, { Ordenreserva: this.ordenreserva }).then(
					(response) => {
						var response = response.body;
						if (!response.error) {
							toastr.success(mensaje);
							$('#writePrice').modal('hide')
							$("#gridOrders").data("kendoGrid").dataSource.read();
							self.refreshTable()
						} else {
							toastr.error('Ocurrió un error inesperado, intente mas tarde.')						
						}
						this.is_loading_orders = false
					}, 
					(error) => {
						this.is_loading_orders = false
						toastr.error('Ocurrió un error inesperado, intente mas tarde.')						
					}
				);
			} else {
				toastr.error('Complete los datos requeridos.')
			}
		},
		addOperador(){
			if (this.driver.id_driver != "") {
				var mensaje = ""
				var url = baseUrl + '/drivers/addOperador/id/' + this.driver.idreserva;
				mensaje = "Operador agregado correctamente"
				var self = this
				this.$http.post(url, { Driver: this.driver }).then(
					(response) => {
						var response = response.body;
						if (!response.error) {
							toastr.success(mensaje);
							this.clearDriver()
							self.refreshTable()
							$('#driversModal').modal('hide')
						} else {
							toastr.error('Ocurrió un error inesperado, intente mas tarde.')						
						}
					}, 
					(error) => {
						toastr.error('Ocurrió un error inesperado, intente mas tarde.')						
						console.log(error)
				});
			} else {
				toastr.error('Complete los datos requeridos.')
			}
		},
		validationOrder(){
			var empty = 0;
			for (var i in this.ordenreserva) {
				if (this.ordenreserva[i] === "" && i != "observaciones") {
					empty++;
				}
			}
			if (empty > 0) {
				return true;
			}
			return false
		},
		getDrivers(){
			this.$http.get(baseUrl + '/drivers/getDrivers').then(
				(response) => {
					var response = response.body;
					this.driversItems = response;
				}, 
				(error) => {
					Swal.fire('Ocurrió un problema en el proceso. Intente mas tarde.', '', 'info')
				});
		},
		openShowOrders(item){
			$("#idordenreserva").val(item.id);
			this.selectedOrder = item.id
			$("#showOrders").modal("show");
			$("#gridOrders").data("kendoGrid").dataSource.read();
		},
		openActionOrder(items = null){
			this.ordenreserva = {
				idorden: 0,
				idreserva: 0,
				subtotal: 0,
				total: 0,
				status: 3,
				tipo: 1,
				descuento: 0,
				idCodigoPromo: 0,
				observaciones: "",
				moneda: 'MXN',
				tipo_cambio: 1
			}
			if (items != null) {
				var self = this
				items.forEach(function callback(val,i){
					self.ordenreserva[i] = val
				})
			}
			this.ordenreserva.idreserva = items.idreserva
			this.ordenreserva.subtotal = 0

			// jccd 01/10/2022
			switch(items.status) {
				case 'Incompleto':
					this.ordenreserva.status = 0
				break;
				case 'Cancelado':
					this.ordenreserva.status = 1
				break;
				case 'Pendiente':
					this.ordenreserva.status = 2
				break;
				case 'Pagado':
					this.ordenreserva.status = 3
				break;
			}
			// jccd end
			$("#writePrice").modal("show")
		},
		next(){
   			var get_salida = $("#fechaSalida").val()
   			var aumentar2 = moment(get_salida, "DD-MM-YYYY").add(1, 'days').format("DD/MM/YYYY")
			$('#fechaSalida').datepicker('setDate', aumentar2)
   		},
   		back(){
   			var get_entrada = $("#fechaLlegada").val()
   			var aumentar1 = moment(get_entrada, "DD-MM-YYYY").subtract(1, 'days').format("DD/MM/YYYY")
   			$('#fechaLlegada').datepicker('setDate', aumentar1)
   		},
   		cerrarModal(){},
   		deleteOrder(item){
   			if (confirm('¿Estas seguro de eliminar la reserva ' + item.idreserva + '?')) {
   				console.log(item, 'delete')
   				this.$http.post(baseUrl + '/orders/delete/id/' + item.idreserva).then(
				(response) => {
						Swal.fire('Reserva eliminada correctamente.', '', 'success')
						this.refreshTable()
				}, 
				(error) => {
						Swal.fire('Ocurrió un problema en el proceso. Intente mas tarde.', '', 'info')
					});
   			}
   		},
   		sendPdfOperadores() {
			this.is_loading_sendPdf = true
			var self = this
			var fecha_start = $("#fechaLlegada").val();
			var fecha_end = $("#fechaSalida").val();
			var tipoFecha = $("#tipoFecha").val();
			var id_agencia = $("#id_agencia").val();

			$("#typePdf").val(type);
			$("#fecha_de").val(fecha_start);
			$("#fecha_hasta").val(fecha_end);
			$("#tipoFechaPdf").val(tipoFecha);
			$("#id_agencia_pdf").val(id_agencia);

			var dataString = $('#form_fechas').serialize();
			console.log(dataString);

			$.ajax({
				url: baseUrl + '/orders/getOrders?' + dataString + '&sendPDF=true',
				type: 'GET'
			})
			.done(function(response) {
				self.is_loading_sendPdf = false
				toastr.success("Correos enviados.")
				// var res = JSON.parse(response)
				console.log("success", response);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				self.is_loading_sendPdf = false
			});

		}
	}
})

if (typeof is_order != 'undefined') {
	$( function(){

		$('#fechaSalida').datepicker({ format: "dd/mm/yyyy", locale: 'es-es', language: 'es', autoclose: true });
		$('#fechaLlegada').datepicker({ format: "dd/mm/yyyy", locale: 'es-es', language: 'es', autoclose: true });
	})
}

$('#fechaLlegada').on('changeDate', function(e){
    app.refreshTable()
})

$('#fechaSalida').on('changeDate', function(e){ 
    app.refreshTable()
})