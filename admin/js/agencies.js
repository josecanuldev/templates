Vue.http.options.emulateJSON = true;
var agencies = new Vue({
	el: "#agencies",
	data: {
		agencies: {
			id: null,
			uuid: null,
			name: "",
			description: "",
			email: "",
			attendant: "",
			cellphone: "",
			cellphone_2: "",
			status: 1,
			deleted_at: null,
			email_two: null
		},
		agenciesModal: agenciesModal,
		is_loading_agencies: false
	},
	methods: {
		openModal(){
			this.reset();
			$('#'+this.agenciesModal).modal('show');
		},
		saveItem(){
			var action = 'save'
			var mensaje = 'La agencia se registro correctamente.'
			if (this.agencies.id != null) {
				mensaje = 'Datos de la agencia actualizados correctamente.'
				action = 'update/id/' + this.agencies.id
			}
			if (!this.validation()) {
				this.is_loading_agencies = true
				this.$http.post(baseUrl + '/agencies/' + action,
				{ Agencies: this.agencies }).then(
					(response) => {
						var response = response.body;
						if (!response.error) {
							toastr.success(mensaje)
							$('#'+this.agenciesModal).modal('hide')
							this.reset();
							if (this.agenciesModal == 'agenciesModal') {
								$("#grid").data("kendoGrid").dataSource.read();
							} else if(this.agenciesModal == 'agencies') {
								app.getAgencies();
							}
						} else {
							toastr.error('Ocurrió un error inesperado, intente mas tarde.')						
						}
						this.is_loading_agencies = false
					}, 
					(error) => {
						this.is_loading_agencies = false
						console.log(error)
					}
				);
			} else {
				toastr.error('Complete los datos requeridos.')
			}
		},
		deleteItem(item){
			var id = item.id;
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
			  	this.$http.get(baseUrl + '/agencies/delete/id/' + id).then(
					(response) => {
						var response = response.body;
						if (!response.error) {
							this.reset();
							$("#grid").data("kendoGrid").dataSource.read();
			    			Swal.fire('Exito!', 'Los datos se han eliminado.', 'success')
						} else {
							Swal.fire('No se generó ninguna acción', '', 'info')						
						}
					}, 
					(error) => {
						Swal.fire('Ocurrió un problema en el proceso. Intente mas tarde.', '', 'info')						
						// console.log(error)
					}
				);
			  }
			})
		},
		validation(){
			if (this.agencies.name == "" || this.agencies.name == null) {
				return true;
			}
			if (this.agencies.email == "" || this.agencies.email == null) {
				return true
			}
			if (this.agencies.attendant == "" || this.agencies.attendant == null) {
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
			  /* Read more about isConfirmed, isDenied below */
			  if (result.isConfirmed) {
			    Swal.fire('Exito!', '', 'success')
			  } else if (result.isDenied) {
			    Swal.fire('No se generó ninguna acción', '', 'info')
			  }
			})
		},
		fillModalItems(item){
			this.reset()
			this.agencies.attendant = item.attendant
			this.agencies.cellphone = item.cellphone
			this.agencies.cellphone_2 = item.cellphone_2
			this.agencies.description = item.description
			this.agencies.email = item.email
			this.agencies.email_two = item.email_two
			this.agencies.name = item.name
			this.agencies.status = item.status == "Áctivo" ? 1 : 0
			this.agencies.uuid = item.uuid
			this.agencies.id = item.id
			$('#'+this.agenciesModal).modal('show');
		},
		reset(){
			this.agencies = {
				id: null,
				uuid: null,
				name: "",
				description: "",
				email: "",
				attendant: "",
				cellphone: "",
				cellphone_2: "",
				status: 1,
				deleted_at: null,
				email_two: null
			}
		}
	}
})


function editRow(e){
	e.preventDefault();
  	var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
  	agencies.fillModalItems(dataItem);
  	console.log(dataItem)
}

function deleteRow(e){
	e.preventDefault();
  	var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
  	agencies.deleteItem(dataItem);
}
