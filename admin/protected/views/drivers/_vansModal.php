<div class="modal fade" id="vansModal" tabindex="-1" aria-labelledby="vansLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content text-dark">
			<div class="modal-header">
				<h5 class="modal-title" id="vansLabel">Registrar Camioneta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" id="form_vans">
					<div class="row">
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputNamevans">Modelo *</label>
								<input type="text" class="form-control" id="vans_model" name="vans[model]" v-model="vans.model">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputPlates">Placas *</label>
								<input type="text" class="form-control" id="vans_plates" name="vans[plates]" v-model="vans.plates">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputpassenger">Max. Pasajeros *</label>
								<input type="number" class="form-control" id="vans_max_passenger" name="vans[max_passenger]" v-model="vans.max_passenger">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputBrand">Marca</label>
								<input type="text" class="form-control" id="vans_brand" name="vans[brand]" v-model="vans.brand">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputCodeVer">Código de verificación</label>
								<input type="text" class="form-control" id="vans_codigo_verificacion" name="vans[codigo_verificacion]" v-model="vans.codigo_verificacion">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputFechaAlta">Fecha de alta</label>
								<input type="text" class="form-control" id="vans_fecha_alta" name="vans[fecha_alta]">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputFechaVen">Fecha de vento. de verificación</label>
								<input type="text" class="form-control" id="vans_fecha_vencimiento" name="vans[fecha_vencimiento]" placeholder="vencimiento de c. verificación">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputFechaSeg">Fecha de vento. de seguro</label>
								<input type="text" class="form-control" id="vans_fecha_seguro" name="vans[fecha_seguro]" placeholder="vencimiento de seguro">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">							
							<div class="form-group">
								<label for="inputFechaMan">Fecha de prox. mantenimiento</label>
								<input type="text" class="form-control" id="vans_fecha_mantenimiento" name="vans[fecha_mantenimiento]" placeholder="próximo mantenimiento">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" @click="saveVan" :disabled="is_loading_vans">
					<span v-show="is_loading_vans" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
					{{ vans.id > 0 ? 'Actualizar' :  'Guardar'}}
				</button>
			</div>
		</div>
	</div>
</div>