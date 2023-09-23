<label for="Tarifas_id_ruta" class="required">Ruta <span class="required">*</span></label>
<select class="form-control" name="Tarifas[id_ruta]" id="Tarifas_id_ruta">
	<!-- <option value="">Seleccionar viaje</option> -->
	<?php foreach ($rutas as $key => $row) { ?>
		<option value="<?=$row->id_ruta?>" <?=$id_ruta == $row->id_ruta ? 'selected' : ''?>>
			<?=$row->Origen->name?> - <?=$row->Destino->name?>
		</option>
	<?php } ?>
</select>