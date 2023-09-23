<hr>
<div v-if="rutas.length > 1" class="row mb-2">
	<div class="col-md-6">
		<h4 class="text-dark"><b>Viaje {{i+1}}</b></h4>
	</div>
	<div class="col-md-6 text-right">
		<button type="button" class="btn btn-danger" @click="eliminarRuta(i)"> <i class="fas fa-times"></i> </button>
	</div>
</div>
<div class="row text-secondary">
	<div class="col-md-6 mb-3 text-left">
		<fieldset class="form-group">
			<legend tabindex="-1" class="bv-no-focus-ring col-form-label pt-0">Tipo de viaje</legend>
			<div>
				<div class="form-check form-check-inline">
					<input type="radio" class="form-check-input" v-model="ruta.tipoViaje" value="Sencillo">
					<!-- <input type="radio" class="form-check-input" name="tipoViaje" v-model="ruta.tipoViaje" value="Sencillo"> -->
					<label class="form-control-label" for="inlineRadio1Sencillo">Sencillo</label>
				</div>
				<div class="form-check form-check-inline">
					<input type="radio" class="form-check-input" v-model="ruta.tipoViaje" value="Redondo">
					<!-- <input type="radio" class="form-check-input" name="tipoViaje" v-model="ruta.tipoViaje" value="Redondo"> -->
					<label class="form-control-label" for="inlineRadio1Redondo">Redondo</label>
				</div>
			</div>
		</fieldset>
	</div>
	<div class="col-md-6 mb-3 text-left">
		<fieldset class="form-group">
			<legend tabindex="-1" class="bv-no-focus-ring col-form-label pt-0">Tipo de vuelo</legend>
			<div>
				<div class="form-check form-check-inline">
					<!-- <input type="radio" class="form-check-input" name="tipoVuelo" v-model="ruta.tipoVuelo" value="Vuelo Nacional"> -->
					<input type="radio" class="form-check-input" v-model="ruta.tipoVuelo" value="Vuelo Nacional">
					<label class="form-check-label" for="inlineRadio1">Nacional</label>
				</div>
				<div class="form-check form-check-inline">
					<!-- <input type="radio" class="form-check-input" name="tipoVuelo" v-model="ruta.tipoVuelo" value="Vuelo Internacional"> -->
					<input type="radio" class="form-check-input" v-model="ruta.tipoVuelo" value="Vuelo Internacional">
					<label class="form-check-label" for="inlineRadio2">Internacional</label>
				</div>
			</div>
		</fieldset>
	</div>
</div>
<div class="row text-secondary">
	<div class="col-md-12 mb-3 text-left">
		<fieldset class="form-group">
			<legend tabindex="-1" class="bv-no-focus-ring col-form-label pt-0">Complementos</legend>
			<div>
				<div v-for="(cats, c) in otrascategorias" :key="c" class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="inlineCheckbox1" :value="cats.id" v-model="ruta.Otrascategoriasreservas">
					<label class="form-check-label" for="inlineCheckbox1">{{ cats.name }}</label>
				</div>
			</div>
		</fieldset>
	</div>
</div>
<div class="row text-secondary bd-top-black">
	<div class="col-md-6 bd-right-black">
		<div class="row">
			<div class="col-md-12 mt-3">
				<h6><b>DESDE:</b></h6>
			</div>
			<div class="col-md-8 mt-3 mb-3">
				<div class="row g-3">
					<div class="col-md-4 col-12">
						<label for="from-option" class="col-form-label">Lugar / Zona:</label>
					</div>
					<list-arrivals :ruta="ruta" :arrivals="arrivals" :type="0" @handleInput="getArrivalSitios($event)" :index="i" />
					<!-- <div class="col-auto">
						<select class="custom-select" v-model="ruta.id_arrivals_from">
							<option v-for="(arrival, i) in arrivals" :key="i" :value="arrival.id">{{arrival.name}}</option>
						</select>
					</div> -->
				</div>
			</div>
			<div class="col-md-4">
				<button type="button" class="btn btn-block mt-3 mb-3 btn-secondary" data-toggle="modal" data-target="#zonaModal"> Agregar zona </button>
			</div>
		</div>
		<div class="row bd-top-black">
			<div class="col-md-12 mb-3 mt-3">
				<label>Información del Origen</label>
			</div>
		</div>
		<?php $this->renderPartial('_form_llegada'); ?>
	</div>
	<div class="col-md-6 mb-3">
		<div class="row">
			<div class="col-md-12 mt-3">
				<h6><b>HASTA:</b></h6>
			</div>
			<div class="col-md-12 mt-3 mb-3">
				<div class="row g-3">
					<div class="col-auto">
						<label for="to-optiion" class="col-form-label">Lugar / Zona:</label>
					</div>
					<list-arrivals :ruta="ruta" :arrivals="arrivals" :type="1" @handleInput="getArrivalSitios($event)" :index="i" />
					<!-- <div class="col-auto">
						<select class="custom-select" v-model="ruta.id_arrivals_to">
							<option v-for="(arrival, i) in arrivals" :key="i" :value="arrival.id">{{arrival.name}}</option>
						</select>
					</div> -->
				</div>
			</div>
		</div>
		<div class="row bd-top-black">
			<div class="col-md-12 mb-3 mt-3">
				<label>Información del {{ is_circuito ? 'Retorno' : 'Destino'}}</label>
			</div>
		</div>
		<?php $this->renderPartial('_form_salida'); ?>
		<!-- <input type="hidden" name="reservatour__horarioPickup" :id="'reservatour__horarioPickup_' + i"> -->
		<input type="hidden" :name="'reservatour__horarioPickup__' + i" :id="'reservatour__horarioPickup__' + i">
	</div>
</div>
<div class="row text-secondary bd-top-black">
	<div class="col-md-12 mt-3 mb-3">
		<label for="observations-textarea" class="form-label"> Observaciones </label>
		<textarea rows="5" wrap="soft" class="form-control" v-model="ruta.observaciones"></textarea>
	</div>
</div>
