<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id_reservacion		</th>
 		<th width="80px">
		      codigo		</th>
 		<th width="80px">
		      folio		</th>
 		<th width="80px">
		      id_agencia		</th>
 		<th width="80px">
		      id_usuario		</th>
 		<th width="80px">
		      fecha_llegada		</th>
 		<th width="80px">
		      hora_llegada		</th>
 		<th width="80px">
		      aerolinea_llegada		</th>
 		<th width="80px">
		      num_vuelo_llegada		</th>
 		<th width="80px">
		      fecha_salida		</th>
 		<th width="80px">
		      hora_pick_up		</th>
 		<th width="80px">
		      hora_vuelo_salida		</th>
 		<th width="80px">
		      aerolinea_salida		</th>
 		<th width="80px">
		      num_vuelo_salida		</th>
 		<th width="80px">
		      tipo_viaje		</th>
 		<th width="80px">
		      pasajeros		</th>
 		<th width="80px">
		      fecha_limite		</th>
 		<th width="80px">
		      observaciones		</th>
 		<th width="80px">
		      estatus		</th>
 		<th width="80px">
		      log		</th>
 		<th width="80px">
		      total		</th>
 		<th width="80px">
		      saldo		</th>
 		<th width="80px">
		      tarifa_agencia		</th>
 		<th width="80px">
		      moneda		</th>
 		<th width="80px">
		      manual		</th>
 		<th width="80px">
		      motivo_cancelacion		</th>
 		<th width="80px">
		      politicas_cancelacion		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id_reservacion; ?>
		</td>
       		<td>
			<?php echo $row->codigo; ?>
		</td>
       		<td>
			<?php echo $row->folio; ?>
		</td>
       		<td>
			<?php echo $row->id_agencia; ?>
		</td>
       		<td>
			<?php echo $row->id_usuario; ?>
		</td>
       		<td>
			<?php echo $row->fecha_llegada; ?>
		</td>
       		<td>
			<?php echo $row->hora_llegada; ?>
		</td>
       		<td>
			<?php echo $row->aerolinea_llegada; ?>
		</td>
       		<td>
			<?php echo $row->num_vuelo_llegada; ?>
		</td>
       		<td>
			<?php echo $row->fecha_salida; ?>
		</td>
       		<td>
			<?php echo $row->hora_pick_up; ?>
		</td>
       		<td>
			<?php echo $row->hora_vuelo_salida; ?>
		</td>
       		<td>
			<?php echo $row->aerolinea_salida; ?>
		</td>
       		<td>
			<?php echo $row->num_vuelo_salida; ?>
		</td>
       		<td>
			<?php echo $row->tipo_viaje; ?>
		</td>
       		<td>
			<?php echo $row->pasajeros; ?>
		</td>
       		<td>
			<?php echo $row->fecha_limite; ?>
		</td>
       		<td>
			<?php echo $row->observaciones; ?>
		</td>
       		<td>
			<?php echo $row->estatus; ?>
		</td>
       		<td>
			<?php echo $row->log; ?>
		</td>
       		<td>
			<?php echo $row->total; ?>
		</td>
       		<td>
			<?php echo $row->saldo; ?>
		</td>
       		<td>
			<?php echo $row->tarifa_agencia; ?>
		</td>
       		<td>
			<?php echo $row->moneda; ?>
		</td>
       		<td>
			<?php echo $row->manual; ?>
		</td>
       		<td>
			<?php echo $row->motivo_cancelacion; ?>
		</td>
       		<td>
			<?php echo $row->politicas_cancelacion; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
