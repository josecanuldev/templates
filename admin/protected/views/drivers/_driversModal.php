<div class="modal fade" id="driversModal" tabindex="-1" aria-labelledby="driversLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content text-dark">
			<div class="modal-header">
				<h5 class="modal-title" id="driversLabel">Registrar Operador</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" id="form_drivers">
					<div class="row">
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputNamedrivers">Nombre *</label>
								<input type="text" class="form-control" id="drivers_name" name="drivers[name]" v-model="drivers.name">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputTelefono">Teléfono </label>
								<input type="text" class="form-control" id="drivers_tel" name="drivers[telefono]" v-model="drivers.telefono">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputWhatsApp">WhatsApp </label>
								<input type="text" class="form-control" id="drivers_whatsapp" name="drivers[whatsapp]" v-model="drivers.whatsapp">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputCorreo">Correo </label>
								<input type="text" class="form-control" id="drivers_correo" name="drivers[correo]" v-model="drivers.correo">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputContact">Licencia *</label>
								<input type="text" class="form-control" id="drivers_license" name="drivers[license]" v-model="drivers.license">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputCamioneta">Camioneta</label>
								<select class="custom-select" v-model="drivers.id_van">
									<option value="">Asignar camioneta</option>
									<option v-for="(van, i) in vansItems" :key="i" :value="van.id">{{van.brand + ' ' + van.model}}</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="customSwitch1" v-model="drivers.status">
								<label class="custom-control-label" for="customSwitch1">{{ drivers.status == 1 ? 'Áctivo' : 'Ináctivo'}}</label>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" @click="saveDrive()">{{ drivers.id > 0 ? 'Actualizar' :  'Guardar'}}</button>
			</div>
		</div>
	</div>
</div>