<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id_sitio		</th>
 		<th width="80px">
		      sitio		</th>
 		<th width="80px">
		      estatus		</th>
 		<th width="80px">
		      log		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id_sitio; ?>
		</td>
       		<td>
			<?php echo $row->sitio; ?>
		</td>
       		<td>
			<?php echo $row->estatus; ?>
		</td>
       		<td>
			<?php echo $row->log; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
