<?php $font = 'font-family: Roboto,sans-serif;'; ?>
<style>
	#tabla-services{
		font-size:  14px;
	}
</style>
<link rel="shortcut icon" type="image/png" href="https://transferholbox.com/img/favicon/favicon-32x32.png"/>
<!-- <br> <br>
<table cellpadding="4">
	<tr>
		<td width="150">
			<img src="https://<?=$_SERVER['SERVER_NAME']?>/images/logo-holbox-pdf.png" style="width: 110px;" />
		</td>
		<td width="200" style="margin-top: 10px; text-align: center;">
			<h3><b>TRANSFER HOLBOX S.A DE C.V</b></h3> <br />
			Calle Damero, Centro, 77310 Q.R <br />
			<?=$date?> <br>
		</td>
		<td width="100"></td>
	</tr>
</table>
<hr border="4" style="margin-bottom: 5px;"> -->
<table>
	<tbody>
		<tr>
			<td></td>
		</tr>
	</tbody>
</table>
<table cellpadding="2" id="tabla-services" style="margin-top: 10px;">
	<thead>
		<tr style="text-align: center;">
			<th width="80"><b>Operador</b></th>
			<th width="50"><b>Pick Up</b></th>
			<th><b>Origen</b></th>
			<th><b>Destino</b></th>
			<th width="130"><b>Agencia</b></th>
			<th width="100"><b>Nombres</b></th>
			<th width="40"><b>Pax</b></th>
			<!-- <th><b>Viaje</b></th> -->
			<th width="160"><b>Observaciones</b></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($row as $k => $r):
			$numV = '';
			$numV2 = ''; 
			if ($r["id_arrivals_to"] == 1) {
				$numV = $r["numeroVueloLlegada"];
			} else if ($r["id_arrivals_from"] == 1) {
				$numV2 = $r["numeroVuelo"];
			}
			?>
			<tr nobr="true" style="border:1px black solid; text-align: center;">
				<td border="1" width="80"> 
					<?=$r["operador"]?> 
					<?=!empty($r["operador"]) ? '<br>' : ''?> 
				 	<?= !empty($r["referencia"]) ? '<span style="color: maroon !important;">'.$r["referencia"].'</span>' : '' ?>
				</td>		
				<td border="1" width="50">
					<?=$r["pickup"]?>
					<br>
					<?= !empty($r["pista"]) && $r["pista"] == 1 && !empty($r["pickup"]) ? ' <span style="color: maroon !important;">Pista</span>' : '' ?>		
				</td>
				<td border="1">
					<?php 
					if ($r["idExperiencia"] == 79 && empty($r["id_arrivals_to"]) && empty($r["id_arrivals_from"])) {
						// $r["origen"] = utf8_decode($r["origen"]);
					}
					echo $r["origen"];
					?>
					<br />
				 <?= !empty($r["numeroVueloLlegada"]) ? ''.$r["numeroVueloLlegada"] : '' ?>
				 <?= !empty($r["aerolineaLlegada"]) ? '<br>'.$r["aerolineaLlegada"] : '' ?>
				 <?= !empty($r["hotelLlegada"]) ? '<br>'.$r["hotelLlegada"] : '' ?>
				 <?= empty($r["pickup"]) && !empty($r["pista"]) && $r["pista"] == 1 ? '<br> <span style="color: maroon !important;">Pista</span>' : ''?>
				</td>
				<td border="1">
					<?php
						echo $r["destino"]
					?> 
					<br /> 
				<?= !empty($r["numeroVuelo"]) ? ''.$r["numeroVuelo"] : '' ?>
				<?= !empty($r["aerolinea"]) ? '<br>'.$r["aerolinea"] : ''?>
				<?= !empty($r["hotelSalida"]) ? '<br>'.$r["hotelSalida"] : '' ?>
				</td>
				<td border="1" width="130" style="white-space: nowrap; text-align: left;"><?=$r['agencia']?></td>
				<td border="1" width="100" style="text-align: left;"><?=$r["nombre"]?></td>
				<td border="1" width="40" style="text-align: right;"><?=$r["paxes"]?></td>
				<td border="1" width="160"><?=$r["observaciones"]?></td>
				<!-- <td border="1"><?=$r["tipo"]?></td> -->
				<!-- <td border="1"><?=date("d/m/Y",strtotime($r["date"]))?></td> -->
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<!-- <table width="100%" border="0" style="<?php echo $font; ?>">
	<tr>
		<td align="center" width="32%" height="100">
			<img src="<?php echo $logo; ?>" alt="<?php echo $logo; ?>" width="130" />
		</td>
		<td>
			<table width="100%" cellspacing="0" cellpadding="0" style="font-size: 16px; text-align: center;">
				<tr>
					<td><b>TRANSFER HOLBOX S.A DE C.V</b></td>
				</tr>
				<tr>
					<td style="font-size: 12px;">Calle 5Q Num. 417 por 30 y 32 Juan Pablo II C.P. 97246 </td>
				</tr>
				<tr>
					<td style="font-size: 12px;">TEL. 9993-010-157</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table> -->