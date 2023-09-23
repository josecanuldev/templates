<label for="arrival_hour">Hora de Pick up</label>
<div class="form-group">
	<div class="input-group date" :id="'datetimepickerHoraPickup_' + i + '_<?=$n?>'" data-target-input="nearest" v-html="assignHoraPickUpID(i,<?=$n?>)">
	<!-- <div class="input-group date" id="datetimepickerHoraPickup_<?=$n?>" data-target-input="nearest"> -->
		<!-- <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerHoraPickup_<?=$n?>" data-toggle="datetimepicker" id="reservatour__horarioPickup_<?=$n?>"/>
		<div class="input-group-append" data-target="#datetimepickerHoraPickup_<?=$n?>" data-toggle="datetimepicker">
			<div class="input-group-text"><i class="fas fa-clock"></i></div>
		</div> -->
	</div>
	<span><input type="checkbox" name="check_pickup" v-model="ruta.check_pickup" @change="onChangePickUp(i, <?=$n?>)"> Habilitar pick-up automático</span> <br>
	<span v-if="ruta.check_pickup" class="text-dark"><b>* Hora recomendable para pick-up</b></span>
</div>