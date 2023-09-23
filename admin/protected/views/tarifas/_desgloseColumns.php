<?php 
$min_pax = -1;
$max_pax = -1;
$precio_publico = 0;
$limite = 11;
if ($catg != null) {
	$min_pax = $catg->min_pax;
	$max_pax = $catg->max_pax;
	$precio_publico = $catg->precio_publico;
}
if (isset($pasajeros)) {
	$limite = $pasajeros;
}
?>
<tr>
	<td id="col0_<?=$row->id_categoria?>">
		<select name="TarifasDesglose_<?=$row->id_categoria?>[min_pax][]" id="TarifasDesglose_<?=$row->id_categoria?>_min_pax">
			<?php for ($i=1; $i <= $limite; $i++) { ?>
				<option value="<?=$i?>" <?=(int) $min_pax == $i ? 'selected' : '' ?>>
					<?=$i?>
				</option>
			<?php } ?>
		</select>
	</td> 
	<td id="col1_<?=$row->id_categoria?>">
		<select name="TarifasDesglose_<?=$row->id_categoria?>[max_pax][]" id="TarifasDesglose_<?=$row->id_categoria?>_max_pax">
			<?php for ($i=1; $i <= $limite; $i++) { ?>
				<option value="<?=$i?>" <?=(int) $max_pax == $i ? 'selected' : '' ?>>
					<?=$i?>
				</option>
			<?php } ?>
		</select>
	</td>
	<td id="col2_<?=$row->id_categoria?>">
		<input type="text" name="TarifasDesglose_<?=$row->id_categoria?>[precio_publico][]" value="<?=$precio_publico?>" id="TarifasDesglose_<?=$row->id_categoria?>_precio_publico" autocomplete="off"/>
	</td>
	<td id="col3_<?=$row->id_categoria?>">
		<button type="button" id="btn_desglose_<?=$key?>_<?=$row->id_categoria?>" data-id="<?=$row->id_categoria?>" data-key="<?=$key?>" class="btn btn-danger btn-xs quitar-precio" onclick="deleteDesglose(<?=$row->id_categoria?>, <?=$key?>)">
			<i class="fa fa-times"></i>
		</button>
	</td>
</tr>