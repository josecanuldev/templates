<?php 
$font = 'font-family: Roboto,sans-serif;'; 
// $border = 'border="1"';
$border = '';
?>
<?php if ($agencia != null): ?>
	<table cellpadding="2" id="tabla-services" style="margin-bottom: 20px; font-size: 12px;">
		<thead>
			<tr>
				<th width="80"><b>Agencia: </b></th>
				<th><b><?=$agencia?></b></th>
			</tr>
			<tr>
				<th width="80"><b>Total: </b></th>
				<th>$ <?=number_format($costo, 2)?></th>
			</tr>
		</thead>
	</table>
	<br> <br>
<?php endif ?>
<table cellpadding="2" id="tabla-services" style="margin-top: 20px;">
	<thead>
		<tr>
			<th width="80"><b>Fecha</b></th>
			<th><b>Nombre</b></th>
			<th width="30"><b>Pax</b></th>
			<th width="160" style="text-align: center;"><b>Origen</b></th>
			<th width="40"><b>Hora</b></th>
			<th width="160" style="text-align: center;"><b>Destino</b></th>
			<th width="80"><b>Operador</b></th>
			<th><b>Referencia</b></th>
			<th width="80"><b>Costo (MXN)</b></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($row as $k => $r):?>
			<tr nobr="true" style="border:1px black solid;">
				<td <?=$border?> width="80"><?=$r["fechaString"]?></td>
				<td <?=$border?>><?=$r["nombre"]?> <?=$r["apellido"]?> </td>
				<td <?=$border?> width="30"><?=$r["pasajeros"]?></td>
				<td <?=$border?> width="160" style="text-align: center;">
					<?=$r["origen"]?>
				 	<?= !empty($r["aerolineaLlegada"]) ? '<br>'.$r["aerolineaLlegada"] : '' ?>
					<?= !empty($r["vueloLlegada"]) ? '<br>'.$r["vueloLlegada"] : '' ?>
				 	<?= !empty($r["hotel"]) ? '<br>'.$r["hotel"] : '' ?>
				</td>
				<td <?=$border?> width="40"><?=$r["hora"]?></td>
				<td <?=$border?> width="160" style="text-align: center;">
					<?=$r["destino"]?>
					<?= !empty($r["aerolinea"]) ? '<br>'.$r["aerolinea"] : '' ?>
					<?= !empty($r["numeroVuelo"]) ? '<br>'.$r["numeroVuelo"] : '' ?>
				 	<?= !empty($r["hotelSalida"]) ? '<br>'.$r["hotelSalida"] : '' ?>
				</td>
				<td <?=$border?> width="80"><?=$r["operador"]?></td>
				<td <?=$border?>><?=$r["referencia"]?></td>
				<td <?=$border?> width="80">$ <?=number_format($r["total"], 2)?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>