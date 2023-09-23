<div class="modal fade" id="showOrders" data-backdrop="static" tabindex="-1" aria-labelledby="driversLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content text-dark">
			<div class="modal-header">
				<h5 class="modal-title" id="driversLabel">Ordenes de pago - Reserva {{ selectedOrder != 0 ? selectedOrder : '' }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<input type="hidden" name="idordenreserva" id="idordenreserva" value="0">
					<div class="col-xs-12 col-md-12 col-lg-12">
						<div id="gridOrders"></div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>