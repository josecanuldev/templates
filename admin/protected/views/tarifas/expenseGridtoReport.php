<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id_tarifa		</th>
 		<th width="80px">
		      id_ruta		</th>
 		<th width="80px">
		      id_tipo_tarifa		</th>
 		<th width="80px">
		      nombre_tarifa		</th>
 		<th width="80px">
		      codigo		</th>
 		<th width="80px">
		      fecha_inicio		</th>
 		<th width="80px">
		      fecha_final		</th>
 		<th width="80px">
		      moneda		</th>
 		<th width="80px">
		      tipo_cambio		</th>
 		<th width="80px">
		      estatus		</th>
 		<th width="80px">
		      no_reembosable		</th>
 		<th width="80px">
		      restricciones		</th>
 		<th width="80px">
		      terminoscondiciones		</th>
 		<th width="80px">
		      politicas_cancelacion		</th>
 		<th width="80px">
		      id_tipoviaje		</th>
 		<th width="80px">
		      last_updated		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id_tarifa; ?>
		</td>
       		<td>
			<?php echo $row->id_ruta; ?>
		</td>
       		<td>
			<?php echo $row->id_tipo_tarifa; ?>
		</td>
       		<td>
			<?php echo $row->nombre_tarifa; ?>
		</td>
       		<td>
			<?php echo $row->codigo; ?>
		</td>
       		<td>
			<?php echo $row->fecha_inicio; ?>
		</td>
       		<td>
			<?php echo $row->fecha_final; ?>
		</td>
       		<td>
			<?php echo $row->moneda; ?>
		</td>
       		<td>
			<?php echo $row->tipo_cambio; ?>
		</td>
       		<td>
			<?php echo $row->estatus; ?>
		</td>
       		<td>
			<?php echo $row->no_reembosable; ?>
		</td>
       		<td>
			<?php echo $row->restricciones; ?>
		</td>
       		<td>
			<?php echo $row->terminoscondiciones; ?>
		</td>
       		<td>
			<?php echo $row->politicas_cancelacion; ?>
		</td>
       		<td>
			<?php echo $row->id_tipoviaje; ?>
		</td>
       		<td>
			<?php echo $row->last_updated; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
