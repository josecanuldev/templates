<div>
	<div class="simple-form-container">
		<div class="row" v-show="(ruta.id_arrivals_to != 1 && ruta.tipoViaje == 'Sencillo') || ruta.tipoViaje == 'Redondo'">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<label for="arrival_date" class="form-label">Fecha de llegada</label>
						<!-- <div class="date input-group">
							<input type="text" class="form-control" id="fechaLLegada" value="<?=date('d/m/Y')?>">
							<div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-calendar"></i></span></div>
						</div> -->
						<div>
							<!-- la libreria esta mal, e immprime alreves el  formato dd/MM/yyyy -> moment mm/dd/yyyy  -->
							<vuejs-datepicker :name="'fechaLLegada_' + i" :id="'fechaLLegada_' + i" :format="'dd/MM/yyyy'" :language="es" :bootstrap-styling="true" :value="ruta.fechaLLegada"></vuejs-datepicker>
						</div>
					</div>
					<div class="col-md-6">
						<label for="arrival_hour">Hora de llegada</label>
						<div class="form-group">
							<div class="input-group date" :id="'datetimepickerHoraLlegada_' + i" data-target-input="nearest" v-html="assignHoraLlegadaID(i)">
								<!-- <input type="text" class="form-control datetimepicker-input" :name="'Reservatour[horarioLLegada_' + i + ']'" id="reservatour__horarioLLegada" data-target="#datetimepickerHoraLlegada" data-toggle="datetimepicker"/>
								<div class="input-group-append" data-target="#datetimepickerHoraLlegada" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fas fa-clock"></i></div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-3 mb-3 d-none" v-show="ruta.id_arrivals_from != 1 && ruta.tipoViaje == 'Sencillo' && ruta.id_arrivals_to == 1">
			<div class="col-md-6">
				<?php $this->renderPartial('_hora_pick_up', array('n' => 1)); ?>
			</div>
		</div> 
		<div class="row mt-3 mb-3" v-show="ruta.id_arrivals_from == 1">
			<div class="col-md-6">
				<label for="aerolinea-vueloLlegada">Aerolínea</label>
				<input type="text" autocomplete="off" class="form-control" v-model="ruta.aerolineaLlegada">
			</div>
			<div class="col-md-6">
				<label for="num-vueloLlegada">Vuelo</label>
				<input type="text" autocomplete="off" class="form-control" v-model="ruta.vueloLlegada">
			</div>
		</div>
		<!-- lugar de origen -->
		<!-- <div class="row g-3 mt-3 mb-3" v-if="ruta.tipoPrivadoEstandar == 'premium'"> -->
		<div class="row g-3 mt-3 mb-3" v-show="ruta.id_arrivals_from != 1">
			<div class="col-md-3">
				<label for="from-option" class="col-form-label">Hotel / Sitio:</label>
			</div>
			<div class="col-md-5">
				<select class="custom-select" v-model="ruta.hotel">
					<option value="">Selecciona Hotel/Sitio</option>
					<option v-for="(sitio, s) in sitiosFilterFrom[i]" :key="s" :value="sitio.sitio">{{sitio.sitio}}</option>
				</select>
				<!-- <input type="text" autocomplete="off" class="form-control" v-model="ruta.hotel"> -->
			</div>
			<div class="col-md-4">
				<button type="button" class="btn btn-block mb-3 btn-secondary" data-toggle="modal" data-target="#sitioModal"> Agregar hotel/sitio </button>
			</div>
		</div>
	</div>
</div>