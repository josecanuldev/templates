<style>
	#tabla-services{
		font-size:  14px;
	}
</style>
<link rel="shortcut icon" type="image/png" href="https://transferholbox.com/img/favicon/favicon-32x32.png"/>
<table>
	<tbody>
		<tr>
			<td></td>
		</tr>
	</tbody>
</table>
<?php
if ($grupo) {
	foreach ($agencias as $key => $val) {
		if ($key > 0) echo '<div pagebreak="true"></div>';
		$this->renderPartial('_agrupadosPDF', array('row' => $val['row'], 'agencia' => $val['agencia']->name, 'costo' => $val['costo']));
	}
} else {
	$this->renderPartial('_agrupadosPDF', array('row' => $row, 'agencia' => null, 'costo' => 0));
}
?>
