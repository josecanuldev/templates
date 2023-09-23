<div class="modal fade" id="<?=$idModal?>" tabindex="-1" aria-labelledby="agenciesLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content text-dark">
			<div class="modal-header">
				<h5 class="modal-title" id="agenciesLabel">Registrar Agencia</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" id="form_agency">
					<div class="row">
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputNameAgency">Nombre de Agencia *</label>
								<input type="text" class="form-control" id="agencies_name" name="Agencies[name]" v-model="agencies.name">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputContact">Nombre de Contacto *</label>
								<input type="text" class="form-control" id="agencies_contacto" name="Agencies[contacto]" v-model="agencies.attendant">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputEmail">Correo *</label>
								<input type="text" class="form-control" id="agencies_email" name="Agencies[email]" v-model="agencies.email">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputEmail">Correo 2 *</label>
								<input type="text" class="form-control" id="agencies_email_two" name="Agencies[email_two]" v-model="agencies.email_two">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputTel">WhatsApp </label>
								<input type="text" class="form-control" id="agencies_phone" name="Agencies[telefono_2]" v-model="agencies.cellphone_2">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputTel">Teléfono </label>
								<input type="text" class="form-control" id="agencies_phone" name="Agencies[telefono]" v-model="agencies.cellphone">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="customSwitch1" v-model="agencies.status">
								<label class="custom-control-label" for="customSwitch1">{{ agencies.status == 1 ? 'Áctivo' : 'Ináctivo'}}</label>
							</div>
						</div>
						<div class="col-md-12 mt-2">
							<label for="textareaDescripcion">Descripción</label>
							<textarea class="form-control" id="agencies_description" rows="3" name="Agencies[description]" v-model="agencies.description"></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<!-- <button type="button" class="btn btn-primary" @click="saveItem()">{{ agencies.id != null ? 'Actualizar' :  'Guardar'}}</button> -->
				<button type="button" class="btn btn-primary" @click="saveItem" :disabled="is_loading_agencies">
					<span v-show="is_loading_agencies" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
					{{ agencies.id != null ? 'Actualizar' :  'Guardar'}}
				</button>
			</div>
		</div>
	</div>
</div>