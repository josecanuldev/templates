<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      horario		</th>
 		<th width="80px">
		      tipo		</th>
 		<th width="80px">
		      estatus		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->horario; ?>
		</td>
       		<td>
			<?php echo $row->tipo; ?>
		</td>
       		<td>
			<?php echo $row->estatus; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
