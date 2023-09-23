Vue.http.options.emulateJSON = true;
var drivers = new Vue({
	el: "#drivers",
	data: {
		drivers: {
			id: 0,
			uuid: null,
			name: '',
			license: '',
			telefono: '',
			whatsapp: '',
			correo: '',
			id_van: '',
			status: 1
		},
		vans: {
			id: 0,
			uuid: null,
			model: '',
			plates: '',
			max_passenger: 0,
			brand: '',
			seats_remove: 0,
			codigo_verificacion: '',
			fecha_alta: '',
			fecha_vencimiento: '',
			fecha_seguro: '',
			fecha_mantenimiento: ''
		},
		vansItems: [],
		is_loading_vans: false
	},
	mounted(){
		this.getVans()
	},
	methods: {
		openModal(type){
			this.reset();
			$('#'+type).modal('show');
		},
		saveDrive(){
			var action = 'create'
			var mensaje = 'El operador se registro correctamente.'
			if (this.drivers.id > 0) {
				mensaje = 'Datos del operador actualizados correctamente.'
				action = 'update/id/' + this.drivers.id
			}
			if (!this.validation()) {
				this.$http.post(baseUrl + '/drivers/' + action,
					{ Drivers: this.drivers }).then(
					(response) => {
						var response = response.body;
						if (!response.error) {
							toastr.success(mensaje)
							$('#driversModal').modal('hide')
							this.reset();
							$("#grid").data("kendoGrid").dataSource.read();
						} else {
							toastr.error('Ocurrió un error inesperado, intente mas tarde.')						
						}
					}, 
					(error) => {
						console.log(error)
					}
				);
			} else {
				toastr.error('Complete los datos requeridos.')
			}
		},
		saveVan(){
			this.is_loading_vans = true
			var action = 'create'
			var mensaje = 'La unidad se registro correctamente.'
			if (this.vans.id > 0) {
				mensaje = 'Datos de la unidad actualizados correctamente.'
				action = 'update/id/' + this.vans.id
			}
			if (!this.validationVans()) {
				this.vans.fecha_alta = $("#vans_fecha_alta").val()
				this.vans.fecha_vencimiento = $("#vans_fecha_vencimiento").val()
				this.vans.fecha_seguro = $("#vans_fecha_seguro").val()
				this.vans.fecha_mantenimiento = $("#vans_fecha_mantenimiento").val()

				this.$http.post(baseUrl + '/vans/' + action,
					{ Vans: this.vans }).then(
					(response) => {
						this.is_loading_vans = false
						var response = response.body;
						if (!response.error) {
							toastr.success(mensaje)
							$('#vansModal').modal('hide')
							this.getVans();
							this.reset();
							$("#gridV").data("kendoGrid").dataSource.read();
						} else {
							toastr.error('Ocurrió un error inesperado, intente mas tarde.')						
						}
					}, 
					(error) => {
						this.is_loading_vans = false
						console.log(error)
					}
				);
			} else {
				this.is_loading_vans = false
				toastr.error('Complete los datos requeridos.')
			}
		},
		getVans(){
			this.$http.get(baseUrl + '/vans/getVans').then(
				(response) => {
					var response = response.body;
					this.vansItems = response;
				}, 
				(error) => {
					Swal.fire('Ocurrió un problema en el proceso. Intente mas tarde.', '', 'info')
				}
			);
		},
		deleteItem(item, type){
			var id = item.id;
			var action = ""
			var grid = ""
			if (type == "vans") {
				action = "vans"
				grid = "gridV"
			} else {
				action = "drivers"
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
		validation(){
			if (this.drivers.name == "" || this.drivers.license == "") {
				return true;
			}
			return false
		},
		validationVans(){
			if (this.vans.model == "" || this.vans.plates == "" || this.vans.max_passenger == "") {
				return true;
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
		fillModalItemsDrivers(item){
			this.reset()
			this.drivers.id = item.id;
			this.drivers.uuid = item.uuid;
			this.drivers.name = item.name;
			this.drivers.license = item.license;
			this.drivers.telefono = item.telefono;
			this.drivers.whatsapp = item.whatsapp;
			this.drivers.correo = item.correo;
			this.drivers.id_van = item.id_van;
			this.drivers.status = item.status == "Áctivo" ? 1 : 0;
			$('#driversModal').modal('show');
		},
		fillModalItemsVans(item){
			this.reset()

			this.vans.id = item.id;
			this.vans.uuid = item.uuid;
			this.vans.model = item.model;
			this.vans.plates = item.plates;
			this.vans.max_passenger = item.max_passenger;
			this.vans.brand = item.brand;
			this.vans.seats_remove = item.seats_remove;
			this.vans.codigo_verificacion = item.codigo_verificacion;
			this.vans.fecha_alta = item.fecha_alta;
			this.vans.fecha_vencimiento = item.fecha_vencimiento;
			this.vans.fecha_seguro = item.fecha_seguro;
			this.vans.fecha_mantenimiento = item.fecha_mantenimiento;
			if (this.vans.fecha_alta == null || this.vans.fecha_alta == '') $('#vans_fecha_alta').val('')
			else $('#vans_fecha_alta').val(moment(this.vans.fecha_alta).format("DD/MM/YYYY"))

			if (this.vans.fecha_vencimiento == null || this.vans.fecha_vencimiento == '') $('#vans_fecha_vencimiento').val('')
			else $('#vans_fecha_vencimiento').val(moment(this.vans.fecha_vencimiento).format("DD/MM/YYYY"))

			if (this.vans.fecha_seguro == null || this.vans.fecha_seguro == '') $('#vans_fecha_seguro').val('')
			else $('#vans_fecha_seguro').val(moment(this.vans.fecha_seguro).format("DD/MM/YYYY"))

			if (this.vans.fecha_mantenimiento == null || this.vans.fecha_mantenimiento == '') $('#vans_fecha_mantenimiento').val('')
			else $('#vans_fecha_mantenimiento').val(moment(this.vans.fecha_mantenimiento).format("DD/MM/YYYY"))
				
			$('#vansModal').modal('show');
		},
		reset(){
			this.drivers = {
				id: 0,
				uuid: null,
				name: '',
				license: '',
				telefono: '',
				whatsapp: '',
				correo: '',
				id_van: '',
				status: 1
			}
			this.vans = {
				id: 0,
				uuid: null,
				model: '',
				plates: '',
				max_passenger: 0,
				brand: '',
				seats_remove: 0,
				codigo_verificacion: '',
				fecha_alta: '',
				fecha_vencimiento: '',
				fecha_seguro: '',
				fecha_mantenimiento: ''
			}

			$('#vans_fecha_alta').val('')
			$('#vans_fecha_vencimiento').val('')
			$('#vans_fecha_seguro').val('')
			$('#vans_fecha_mantenimiento').val('')
		}
	}
})

$(document).ready(function() {
	$('#vans_fecha_alta').datepicker({ format: "dd/mm/yyyy", locale: 'es-es', language: 'es', autoclose: true, orientation: "top auto" });
	$('#vans_fecha_vencimiento').datepicker({ format: "dd/mm/yyyy", locale: 'es-es', language: 'es', autoclose: true,  orientation: "top auto" });
	$('#vans_fecha_seguro').datepicker({ format: "dd/mm/yyyy", locale: 'es-es', language: 'es', autoclose: true,  orientation: "top auto" });
	$('#vans_fecha_mantenimiento').datepicker({ format: "dd/mm/yyyy", locale: 'es-es', language: 'es', autoclose: true,  orientation: "top auto" });
});


function editDrive(e){
	e.preventDefault();
	var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
	drivers.fillModalItemsDrivers(dataItem);
}

function deleteDrive(e){
	e.preventDefault();
	var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
	drivers.deleteItem(dataItem,"drivers");
}

function editVan(e){
	e.preventDefault();
	var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
	drivers.fillModalItemsVans(dataItem);
}

function deleteVan(e){
	e.preventDefault();
	var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
	drivers.deleteItem(dataItem,"vans");
}
