<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      idreserva		</th>
 		<th width="80px">
		      idExperiencia		</th>
 		<th width="80px">
		      pasajeros		</th>
 		<th width="80px">
		      tipoViaje		</th>
 		<th width="80px">
		      fechaLLegada		</th>
 		<th width="80px">
		      horarioLLegada		</th>
 		<th width="80px">
		      fechaSalida		</th>
 		<th width="80px">
		      horarioSalida		</th>
 		<th width="80px">
		      desde		</th>
 		<th width="80px">
		      nombre		</th>
 		<th width="80px">
		      apellido		</th>
 		<th width="80px">
		      correo		</th>
 		<th width="80px">
		      telefono		</th>
 		<th width="80px">
		      pais		</th>
 		<th width="80px">
		      ciudad		</th>
 		<th width="80px">
		      idioma		</th>
 		<th width="80px">
		      fechaReservacion		</th>
 		<th width="80px">
		      concepto		</th>
 		<th width="80px">
		      conceptoEn		</th>
 		<th width="80px">
		      aerolinea		</th>
 		<th width="80px">
		      numeroVuelo		</th>
 		<th width="80px">
		      datePrivada		</th>
 		<th width="80px">
		      horaPrivada		</th>
 		<th width="80px">
		      abordaje		</th>
 		<th width="80px">
		      tipoVuelo		</th>
 		<th width="80px">
		      tipoPrivadoEstandar		</th>
 		<th width="80px">
		      hotel		</th>
 		<th width="80px">
		      hotelSalida		</th>
 		<th width="80px">
		      inverso		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->idreserva; ?>
		</td>
       		<td>
			<?php echo $row->idExperiencia; ?>
		</td>
       		<td>
			<?php echo $row->pasajeros; ?>
		</td>
       		<td>
			<?php echo $row->tipoViaje; ?>
		</td>
       		<td>
			<?php echo $row->fechaLLegada; ?>
		</td>
       		<td>
			<?php echo $row->horarioLLegada; ?>
		</td>
       		<td>
			<?php echo $row->fechaSalida; ?>
		</td>
       		<td>
			<?php echo $row->horarioSalida; ?>
		</td>
       		<td>
			<?php echo $row->desde; ?>
		</td>
       		<td>
			<?php echo $row->nombre; ?>
		</td>
       		<td>
			<?php echo $row->apellido; ?>
		</td>
       		<td>
			<?php echo $row->correo; ?>
		</td>
       		<td>
			<?php echo $row->telefono; ?>
		</td>
       		<td>
			<?php echo $row->pais; ?>
		</td>
       		<td>
			<?php echo $row->ciudad; ?>
		</td>
       		<td>
			<?php echo $row->idioma; ?>
		</td>
       		<td>
			<?php echo $row->fechaReservacion; ?>
		</td>
       		<td>
			<?php echo $row->concepto; ?>
		</td>
       		<td>
			<?php echo $row->conceptoEn; ?>
		</td>
       		<td>
			<?php echo $row->aerolinea; ?>
		</td>
       		<td>
			<?php echo $row->numeroVuelo; ?>
		</td>
       		<td>
			<?php echo $row->datePrivada; ?>
		</td>
       		<td>
			<?php echo $row->horaPrivada; ?>
		</td>
       		<td>
			<?php echo $row->abordaje; ?>
		</td>
       		<td>
			<?php echo $row->tipoVuelo; ?>
		</td>
       		<td>
			<?php echo $row->tipoPrivadoEstandar; ?>
		</td>
       		<td>
			<?php echo $row->hotel; ?>
		</td>
       		<td>
			<?php echo $row->hotelSalida; ?>
		</td>
       		<td>
			<?php echo $row->inverso; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
