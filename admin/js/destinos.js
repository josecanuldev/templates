Vue.http.options.emulateJSON = true;
var arrivals = new Vue({
	el: "#arrivals",
	data: {
		model_arrivals: {
			id: 0,
			uuid: "",
			name: "",
			description: "",
			codigo: "",
			estatus: 1
		},
		model_sitios: {
			id_sitio: 0,
			sitio: "",
			id_arrivals: 1,
			descripcion: "",
			estatus: 1
		},
		is_loading_arrivals: false,
		is_loading_sitios: false,
		arrivals: [],
	},
	mounted(){
		this.getArrivals()
	},
	methods: {
		openModal(type){
			this.reset();
			$('#'+type).modal('show');
		},
		saveArrivals(){
			this.is_loading_arrivals = true
			var action = 'create'
			var mensaje = 'El destino se registro correctamente.'
			if (this.model_arrivals.id > 0) {
				mensaje = 'Datos del destino actualizados correctamente.'
				action = 'update/id/' + this.model_arrivals.id
			}
			if (!this.validationArrivals()) {
				this.$http.post(baseUrl + '/arrivals/' + action,
					{ Arrivals: this.model_arrivals }).then(
					(response) => {
						this.is_loading_arrivals = false
						var response = response.body;
						this.getArrivals()
						if (!response.error) {
							toastr.success(mensaje)
							$('#zonaModal').modal('hide')
							this.reset();
							$("#grid").data("kendoGrid").dataSource.read();
						} else {
							toastr.error('Ocurrió un error inesperado, intente mas tarde.')						
						}
					}, 
					(error) => {
						this.is_loading_arrivals = false
						console.log(error)
					}
				);
			} else {
				this.is_loading_arrivals = false
				toastr.error('Complete los datos requeridos.')
			}
		},
		saveSitios(){
			this.is_loading_sitios = true
			var action = 'create'
			var mensaje = 'El hotel/sitio se registro correctamente.'
			if (this.model_sitios.id_sitio > 0) {
				mensaje = 'Datos del hotel/sitio actualizados correctamente.'
				action = 'update/id/' + this.model_sitios.id_sitio
			}
			if (!this.validationHotelSitio()) {
				this.$http.post(baseUrl + '/sitios/' + action,
					{ Sitios: this.model_sitios }).then(
					(response) => {
						this.is_loading_sitios = false
						var response = response.body;
						this.getArrivals()
						if (!response.error) {
							toastr.success(mensaje)
							$('#sitioModal').modal('hide')
							this.reset();
							$("#gridH").data("kendoGrid").dataSource.read();
						} else {
							toastr.error('Ocurrió un error inesperado, intente mas tarde.')						
						}
					}, 
					(error) => {
						this.is_loading_sitios = false
						console.log(error)
					}
				);
			} else {
				this.is_loading_sitios = false
				toastr.error('Complete los datos requeridos.')
			}
		},
		deleteItem(item, type){
			console.log(item, type)
			var id = 0;
			var action = type
			var grid = ""
			if (type == "sitios") {
				id = item.id_sitio
				grid = "gridH"
			} else {
				id = item.id
				grid = "grid"
			}
			Swal.fire({
				title: "¿Desea eliminar este registro?",
				text: "Este dato se eliminará de la base de datos.",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Aceptar'
			}).then((result) => {
				if (result.isConfirmed) {
					this.$http.get(baseUrl + '/'+action+'/delete/id/' + id).then(
						(response) => {
							var response = response.body;
							if (!response.error) {
								this.reset();
								$("#"+grid).data("kendoGrid").dataSource.read();
								Swal.fire('Exito!', 'Los datos se han eliminado.', 'success')
							} else {
								Swal.fire('No se generó ninguna acción', '', 'info')						
							}
						}, 
						(error) => {
							Swal.fire('Ocurrió un problema en el proceso. Intente mas tarde.', '', 'info')
						}
					);
				}
			})
		},
		validationArrivals(){
			if (this.model_arrivals.name == "") {
				return true
			}
			return false
		},
		validationHotelSitio(){
			if (this.model_sitios.sitio == "") {
				return true
			}
			return false
		},
		dialogConfirm(mensaje){
			Swal.fire({
				title: mensaje,
				showDenyButton: true,
				showCancelButton: true,
				confirmButtonText: 'Aceptar',
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire('Exito!', '', 'success')
				} else if (result.isDenied) {
					Swal.fire('No se generó ninguna acción', '', 'info')
				}
			})
		},
		fillModalItemsArrivals(item){
			this.reset()
			this.model_arrivals.id = item.id;
			this.model_arrivals.uuid = item.uuid;
			this.model_arrivals.name = item.name;
			this.model_arrivals.description = item.description;
			this.model_arrivals.estatus = item.estatus;
			this.model_arrivals.codigo = item.codigo;
			// this.model_arrivals.estatus = item.estatus == "Áctivo" ? 1 : 0;
			$('#zonaModal').modal('show');
		},
		fillModalItemsSitios(item){
			this.reset()

			this.model_sitios.id_sitio = item.id_sitio;
			this.model_sitios.sitio = item.sitio;
			this.model_sitios.id_arrivals = item.id_arrivals;
			this.model_sitios.descripcion = item.descripcion;
			this.model_sitios.estatus = item.estatus;
			$('#sitioModal').modal('show');
		},
		reset(){
			this.model_arrivals = {
				id: 0,
				uuid: "",
				name: "",
				description: "",
				estatus: 1,
				codigo: ""
			}
			this.model_sitios = {
				id_sitio: 0,
				sitio: "",
				id_arrivals: 1,
				descripcion: "",
				estatus: 1
			}
		},
		getArrivals(){
			this.$http.get(baseUrl + '/arrivals/getArrivals').then(
				(response) => {
					this.arrivals = response.body
				}, 
				(error) => {						
					// console.log(error)
				}
			);
		}
	}
})


function editArrival(e){
	e.preventDefault();
	var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
	arrivals.fillModalItemsArrivals(dataItem);
}

function deleteArrival(e){
	e.preventDefault();
	var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
	arrivals.deleteItem(dataItem, "arrivals");
}

function editSitio(e){
	e.preventDefault();
	var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
	arrivals.fillModalItemsSitios(dataItem);
}

function deleteSitio(e){
	e.preventDefault();
	var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
	arrivals.deleteItem(dataItem, "sitios");
}
