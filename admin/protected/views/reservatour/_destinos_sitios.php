<!-- Modal agregar zona -->
<div class="modal fade" id="zonaModal" tabindex="-1" aria-labelledby="zonaModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content text-dark">
			<div class="modal-header">
				<h5 class="modal-title" id="zonaModalLabel">Registrar Zona</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" id="form_agency">
					<div class="row">
						<div class="col-md-6 col-12">							
							<div class="form-group">
								<label for="inputNameZona">Zona *</label>
								<input type="text" class="form-control" id="arrivals_name" v-model="model_arrivals.name">
							</div>
						</div>
						<div class="col-md-6 col-12">							
							<div class="form-group">
								<label for="inputNameZona">Código *</label>
								<input type="text" class="form-control" id="arrivals_codigo" v-model="model_arrivals.codigo">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="inputNameZona">Descripción </label>
								<textarea id="description-textarea" name="description-textarea" rows="5" wrap="soft" class="form-control" v-model="model_arrivals.description"></textarea>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="estatusZona">Estatus</label>
								<select class="form-control" id="arrivals_estatus" v-model="model_arrivals.estatus">
									<option value="1">Áctivo</option>
									<option value="0">Ináctivo</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" @click="saveArrivals" :disabled="is_loading_arrivals">
					<span v-show="is_loading_arrivals" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
					{{ model_arrivals.id > 0 ? 'Actualizar' :  'Guardar'}}
				</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal agregar sitio -->
<div class="modal fade" id="sitioModal" tabindex="-1" aria-labelledby="sitioModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content text-dark">
			<div class="modal-header">
				<h5 class="modal-title" id="sitioModalLabel">Registrar Hotel/Sitio</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" id="form_agency">
					<div class="row">
						<div class="col-12">							
							<div class="form-group">
								<label for="inputsitioSitio">Sitio *</label>
								<input type="text" class="form-control" id="sitios_sitio" v-model="model_sitios.sitio">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="inputIDArivalsZona">Zona *</label>
								<select class="custom-select" v-model="model_sitios.id_arrivals">
									<option v-for="(arrival, i) in arrivals" :key="i" :value="arrival.id">{{arrival.name}}</option>
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="inputsitioDescripcion">Descripción </label>
								<textarea id="description-textarea-sitio" name="description-textarea-sitio" rows="5" wrap="soft" class="form-control" v-model="model_sitios.descripcion"></textarea>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="estatusReservaSitio">Estatus</label>
								<select class="form-control" id="sitios_estatus" v-model="model_sitios.estatus">
									<option value="1">Áctivo</option>
									<option value="0">Ináctivo</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" @click="saveSitios" :disabled="is_loading_sitios">
					<span v-show="is_loading_sitios" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
					{{ model_sitios.id_sitio > 0 ? 'Actualizar' :  'Guardar'}}
				</button>
			</div>
		</div>
	</div>
</div>