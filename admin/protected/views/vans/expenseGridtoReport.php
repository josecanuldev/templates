<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      uuid		</th>
 		<th width="80px">
		      model		</th>
 		<th width="80px">
		      plates		</th>
 		<th width="80px">
		      max_passenger		</th>
 		<th width="80px">
		      created_at		</th>
 		<th width="80px">
		      updated_at		</th>
 		<th width="80px">
		      deleted_at		</th>
 		<th width="80px">
		      brand		</th>
 		<th width="80px">
		      seats_remove		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->uuid; ?>
		</td>
       		<td>
			<?php echo $row->model; ?>
		</td>
       		<td>
			<?php echo $row->plates; ?>
		</td>
       		<td>
			<?php echo $row->max_passenger; ?>
		</td>
       		<td>
			<?php echo $row->created_at; ?>
		</td>
       		<td>
			<?php echo $row->updated_at; ?>
		</td>
       		<td>
			<?php echo $row->deleted_at; ?>
		</td>
       		<td>
			<?php echo $row->brand; ?>
		</td>
       		<td>
			<?php echo $row->seats_remove; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
