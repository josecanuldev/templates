<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      idorden		</th>
 		<th width="80px">
		      idreserva		</th>
 		<th width="80px">
		      subtotal		</th>
 		<th width="80px">
		      total		</th>
 		<th width="80px">
		      status		</th>
 		<th width="80px">
		      tipo		</th>
 		<th width="80px">
		      descuento		</th>
 		<th width="80px">
		      idCodigoPromo		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->idorden; ?>
		</td>
       		<td>
			<?php echo $row->idreserva; ?>
		</td>
       		<td>
			<?php echo $row->subtotal; ?>
		</td>
       		<td>
			<?php echo $row->total; ?>
		</td>
       		<td>
			<?php echo $row->status; ?>
		</td>
       		<td>
			<?php echo $row->tipo; ?>
		</td>
       		<td>
			<?php echo $row->descuento; ?>
		</td>
       		<td>
			<?php echo $row->idCodigoPromo; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
