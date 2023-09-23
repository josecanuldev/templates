<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id_ruta		</th>
 		<th width="80px">
		      id_origen		</th>
 		<th width="80px">
		      id_destino		</th>
 		<th width="80px">
		      menor_paga		</th>
 		<th width="80px">
		      edad_menor_paga		</th>
 		<th width="80px">
		      last_updated		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id_ruta; ?>
		</td>
       		<td>
			<?php echo $row->id_origen; ?>
		</td>
       		<td>
			<?php echo $row->id_destino; ?>
		</td>
       		<td>
			<?php echo $row->menor_paga; ?>
		</td>
       		<td>
			<?php echo $row->edad_menor_paga; ?>
		</td>
       		<td>
			<?php echo $row->last_updated; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
