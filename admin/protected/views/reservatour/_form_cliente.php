<div class="row text-secondary">
	<div class="col-md-3">
		<input type="hidden" class="form-control" id="datepicker" value="<?=date('d/m/Y')?>">
		<div class="mb-3">
			<label for="reference-input" class="form-label">Referencia</label>
			<input type="text" placeholder="Referencia" class="form-control" v-model="model.referencia">
		</div>
	</div>
	<div class="col-md-3">
		<div class="mb-3">
			<label for="adults-input" class="form-label">Adultos *</label>
			<input type="number" placeholder="0" min="0" step="1" class="form-control" value="2" v-model="reservatourdesglose.adultos" @change="changeAdults()">
		</div>
	</div>
	<div class="col-md-3">
		<div class="mb-3">
			<label for="minors-input" class="form-label">Menores *</label>
			<input type="number" placeholder="0" min="0" step="1" class="form-control" value="0" v-model="reservatourdesglose.menores" @change="changeAdults()">
		</div>
	</div>
	<div class="col-md-3 text-right">
		<div class="form-group">
			<label for="estatusReserva">Estatus</label>
			<select class="form-control" id="Reserva_estatus" v-model="model.estatus">
				<option value="A">Áctivo</option>
				<option value="P">Pendiente</option>
				<option value="PA">Pagado</option>
				<option value="C">Cancelado</option>
			</select>
		</div>
	</div>
</div>
<div class="row text-secondary">
	<div class="col-md-3">
		<div class="mb-3">
			<label for="agency-name-input" class="form-label">Agencia *</label>
			<div class="input-group">
				<select class="custom-select" id="inputGroupSelectAgency" v-model="model.id_agencia" @change="buscarAgencia">
					<option v-for="(agency, i) in agenciesAll" :key="i" :value="agency.id">{{agency.name}}</option>
				</select>
				<div class="input-group-append">
					<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#agencies"><i class="fa fa-plus"></i></button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="mb-3">
			<label for="name-input" class="form-label">Nombre(s) Cliente *</label>
			<input type="text" placeholder="Nombre(s)" required="required" autocomplete="off" aria-required="true" class="form-control" v-model="model.nombre">
		</div>
	</div>
	<div class="col-md-3">
		<div class="mb-3">
			<label for="name-input" class="form-label">Apellido(s) Cliente *</label>
			<input type="text" placeholder="Apellido(s)" required="required" autocomplete="off" aria-required="true" class="form-control" v-model="model.apellido">
		</div>
	</div>
	<div class="col-md-3">
		<div class="mb-3">
			<label for="client-phone-input" class="form-label">Celular cliente </label>
			<input type="text" placeholder="Celular cliente" autocomplete="off" class="form-control" v-model="model.telefono">
		</div>
	</div>
</div>
<div class="row text-secondary">
	<div class="col-md-3">
		<div class="mb-3">
			<label for="client-email-input" class="form-label">Email cliente </label>
			<input type="email" placeholder="Email cliente" autocomplete="off" class="form-control" v-model="model.correo">
		</div>
	</div>
	<div class="col-md-3">
		<div class="mb-3">
			<label for="name-input" class="form-label">País Cliente </label>
			<input type="text" placeholder="País Cliente" required="required" autocomplete="off" aria-required="true" class="form-control" v-model="model.pais">
		</div>
	</div>
	<div class="col-md-2">
		<div class="mb-3">
			<label for="client-phone-input" class="form-label">Ciudad Cliente </label>
			<input type="text" placeholder="Ciudad Cliente" autocomplete="off" class="form-control" v-model="model.ciudad">
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<label for="idiomaReserva">Idioma</label>
			<select class="form-control" id="Reserva_idioma" v-model="model.idioma">
				<option value="es">Español</option>
				<option value="en">Ingles</option>
			</select>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<label for="tipoReserva">Tipo</label>
			<select class="form-control" id="Reserva_tipoPrivadoEstandar" v-model="model.tipoPrivadoEstandar">
				<option value="colectivo">Colectivo</option>
				<option value="estandar">Estandar</option>
				<option value="premium">Premium</option>
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<?php if (!isset($_GET["type"]) && !isset($_GET["id"])): ?>
			<button type="button" class="btn mt-4 btn-secondary" @click="agregarRuta">  
				<i class="fa fa-plus"></i> Agregar Ruta 
			</button>
		 <?php endif ?> 
	</div>
	<div class="col-md-6 text-right">
		<button type="button" class="btn mt-4 btn-secondary" @click="enviaMail" :disabled="is_loading_mail"> 
			<span v-show="is_loading_mail" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
			Enviar email 
		</button>
	</div>
</div>
