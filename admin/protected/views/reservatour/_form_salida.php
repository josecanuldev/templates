<div>
	<div class="simple-form-container">
		<div class="row" v-show="ruta.tipoViaje == 'Redondo' || (ruta.tipoViaje == 'Sencillo' && ruta.id_arrivals_to == 1)">
			<div class="col-md-6">
				<label for="arrival_date" class="form-label">Fecha de {{ is_circuito ? 'Retorno' : 'Salida'}}</label>
				<!-- <div class="date input-group">
					<input type="text" class="form-control" id="fechaSalida" value="<?=date('d/m/Y')?>">
					<div class="input-group-append">
						<span class="input-group-text px-4"><i class="fa fa-calendar"></i></span>
					</div>
				</div> -->
				<div>
					<vuejs-datepicker :name="'fechaSalida_' + i" :id="'fechaSalida_' + i" :format="'dd/MM/yyyy'" :language="es" :bootstrap-styling="true" :value="ruta.fechaSalida"></vuejs-datepicker>
				</div>
			</div>
			<div class="col-md-6">
				<label for="arrival_hour">Hora de {{ is_circuito ? 'Retorno' : 'Salida'}}</label>
				<div class="form-group">
					<div class="input-group date" :id="'datetimepickerHoraSalida_' + i" data-target-input="nearest" v-html="assignHoraSalidaID(i)">
						<!-- <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerHoraSalida" id="reservatour__horarioSalida" data-toggle="datetimepicker"/>
						<div class="input-group-append" data-target="#datetimepickerHoraSalida" data-toggle="datetimepicker">
							<div class="input-group-text"><i class="fas fa-clock"></i></div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- <div class="col-md-4" v-show="model.tipoPrivadoEstandar == 'premium' && (ruta.id_arrivals_from == 1 || ruta.id_arrivals_to == 1)"> -->
			<!-- <div class="col-md-6" v-show="ruta.tipoViaje == 'Redondo' && ruta.id_arrivals_to != 1"> -->
			
			<div class="col-md-6" v-show="ruta.id_arrivals_to == 1 || (ruta.tipoViaje == 'Redondo' && ruta.id_arrivals_from == 1)">
			<!-- jccd 02-08-2022 -->
			<!-- <div class="col-md-6" v-show="ruta.id_arrivals_to == 1"> -->
				<?php $this->renderPartial('_hora_pick_up', array('n' => 2)); ?>
			</div>
			<!-- <div class="col-md-4" v-if="model.tipoPrivadoEstandar == 'premium' && (ruta.id_arrivals_from == 1 || ruta.id_arrivals_to == 1)"> -->
			<div class="col-md-6" v-show="ruta.id_arrivals_to == 1 || (ruta.tipoViaje == 'Redondo' && ruta.id_arrivals_from == 1)">
				<label for="aerolinea-vuelo">Aerolínea</label>
				<input type="text" autocomplete="off" class="form-control" v-model="ruta.aerolinea">
			</div>
			<!-- <div class="col-md-4" v-if="model.tipoPrivadoEstandar == 'premium' && (ruta.id_arrivals_from == 1 || ruta.id_arrivals_to == 1)"> -->
			<div class="col-md-6" v-show="ruta.id_arrivals_to == 1 || (ruta.tipoViaje == 'Redondo' && ruta.id_arrivals_from == 1)">
				<label for="num-vuelo">Vuelo</label>
				<input type="text" autocomplete="off" class="form-control" v-model="ruta.numeroVuelo">
			</div>
		</div>
	</div>
	<div class="simple-form-container" v-show="ruta.id_arrivals_to != 1">
		<!-- <div class="row g-3 mt-3 mb-3" v-if="model.tipoPrivadoEstandar == 'premium'"> -->
		<div class="row g-3 mt-3 mb-3">
			<div class="col-md-3">
				<label for="from-option" class="col-form-label">Hotel / Sitio:</label>
			</div>
			<div class="col-md-5">
				<select class="custom-select" v-model="ruta.hotelSalida">
					<option value="">Selecciona Hotel/Sitio</option>
					<option v-for="(sitio, s) in sitiosFilter[i]" :key="s" :value="sitio.sitio">{{sitio.sitio}}</option>
					<!-- <option v-for="(sitio, s) in sitiosFilter[i]" :key="s" :value="sitio.sitio">{{sitio.sitio}}</option> -->
				</select>
				<!-- <input type="text" autocomplete="off" class="form-control" v-model="ruta.hotelSalida"> -->
			</div>
			<div class="col-md-4">
				<button type="button" class="btn btn-block mb-3 btn-secondary" data-toggle="modal" data-target="#sitioModal"> Agregar hotel/sitio </button>
			</div>
		</div>
	</div>

</div>