<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      uuid		</th>
 		<th width="80px">
		      name		</th>
 		<th width="80px">
		      license		</th>
 		<th width="80px">
		      id_van		</th>
 		<th width="80px">
		      status		</th>
 		<th width="80px">
		      created_at		</th>
 		<th width="80px">
		      updated_at		</th>
 		<th width="80px">
		      deleted_at		</th>
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
			<?php echo $row->name; ?>
		</td>
       		<td>
			<?php echo $row->license; ?>
		</td>
       		<td>
			<?php echo $row->id_van; ?>
		</td>
       		<td>
			<?php echo $row->status; ?>
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
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
