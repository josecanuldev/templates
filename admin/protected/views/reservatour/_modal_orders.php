<div class="modal fade" id="writePrice" data-backdrop="static" tabindex="-1" aria-labelledby="writePriceLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content text-dark">
			<div class="modal-header">
				<h5 class="modal-title" id="writePriceLabel">{{ordenreserva.idorden > 0 ? 'Actualizar' : 'Crear'}} Orden</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" id="form_agency">
					<div class="row">
						<!-- <div class="col-6">
							<div class="form-group">
								<label for="inputOrdenReservaSubtotal">Subtotal *</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">$</div>
									</div>
									<input type="text" class="form-control text-right" id="ordenreserva_subtotal" v-model="ordenreserva.subtotal">
								</div>
							</div>
						</div> -->
						<!-- <div class="col-6">
							<div class="form-group">
								<label for="inputOrdenReservaDescuento">Descuento *</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">$</div>
									</div>
									<input type="text" class="form-control text-right" id="ordenreserva_descuento" v-model="ordenreserva.descuento">
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="inputOrdenReservaCodigoPromo">Codigo Promoción *</label>
								<input type="text" class="form-control text-right" id="ordenreserva_idCodigoPromo" v-model="ordenreserva.idCodigoPromo">
							</div>
						</div> -->
						<div class="col-4">							
							<div class="form-group">
								<label for="inputOrdenReservaTotal">Total *</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">$</div>
									</div>
									<input type="text" class="form-control text-right" id="ordenreserva_total" v-model="ordenreserva.total">
								</div>
							</div>
						</div>
						<div class="col-4">							
							<div class="form-group">
								<label for="inputOrdenReservaMoneda">Moneda *</label>
								<select class="form-control" v-model="ordenreserva.moneda" name="ordenreserva.moneda" id="ordenreserva_moneda">
									<option value="MXN">MXN</option>
									<option value="USD">USD</option>
								</select>
							</div>
						</div>
						<div class="col-4">							
							<div class="form-group">
								<label for="inputOrdenReservaTipoCambio">Tipo Cambio</label>
								<input type="text" class="form-control text-right" id="ordenreserva_tipo_cambio" v-model="ordenreserva.tipo_cambio">
							</div>
						</div>
						<?php if ($_GET['dev'] == 1): ?>
							<div class="col-4">							
								<div class="form-group">
									<label for="inputOrdenReservaEstatus">Estatus</label>
									<select class="form-control" v-model="ordenreserva.status" name="ordenreserva.status" id="ordenreserva_status">
										<option value="0">Incompleto</option>
										<option value="1">Cancelado</option>
										<option value="2">Pendiente</option>
										<option value="3">Pagado</option>
									</select>
								</div>
							</div>
						<?php endif ?>
						<div class="col-12">
							<label for="observations-textarea-orders" class="form-label"> Observaciones </label>
							<textarea id="observations-textarea-orders" name="observations-textarea-orders" rows="4" wrap="soft" class="form-control" v-model="ordenreserva.observaciones"></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" @click="cerrarModal">Cerrar</button>
				<a href="<?=Yii::app()->createUrl('reservatour')?>" class="btn btn-success"> Nueva reserva</a>
				<button type="button" class="btn btn-primary" @click="saveOrders" :disabled="is_loading_orders">
				<span v-show="is_loading_orders" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
				Guardar
				</button>
			</div>
		</div>
	</div>
</div>