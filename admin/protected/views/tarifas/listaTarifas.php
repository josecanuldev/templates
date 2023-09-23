<style>
	.scrollable {
		height: 800px;
    	overflow: auto;
	}
</style>
<div class="row scrollable">
	<?php if (count($tarifas) === 0) { ?>
		<span>No tiene tarifas registrados</span>
	<?php } ?>
	<?php foreach ($tarifas as $key => $tarifa) {
		$ruta = Rutas::model()->findByPk($tarifa->id_ruta);
		$classActive = '';
		$bgWhite = '';
		if($id == $tarifa->id_tarifa) {
			$classActive = ' active ';
			$bgWhite = ' bg-info text-white ';
		}
	?>
		<div class="col-12 border-bottom <?php echo $classActive.$bgWhite; ?> p-3"  style="font-size: 14px;">
			<div class="row" onclick="irTarifa(<?=$tarifa->id_tarifa?>)" style="cursor:pointer;">
				<div class="col-6">
					<!-- $tarifa->id_tarifa - -->
					<b><span><?=$tarifa->codigo?> - <?=$tarifa->nombre_tarifa?></span></b> <br>
				</div>
				<div class="col-6 text-right">
					<span class="pull-right" id="estatus_<?=$tarifa->id_tarifa?>">
			        <?php if($tarifa->estatus == 1) {
			            if(date('Y-m-d') > $tarifa->fecha_final) { ?>
			            <span class="text-warning"><i class="fa fa-circle"></i></span>
			            <?php } else { ?>
			            <span class="text-success"><i class="fa fa-circle"></i></span>
			            <?php } ?>
			        <?php } else { ?>
			            <span class="text-danger"><i class="fa fa-circle"></i></span>
			        <?php } ?>
			        </span>
				</div>
				<div class="col-12">
					<span><?=$tarifa->idRuta->Origen->name?> - <?=$tarifa->idRuta->Destino->name?></span> / <span><?=$tarifa->idTipoViaje->viaje?></span>
				</div>
			</div>
			<div class="row">
				<div class="col-10 mt-1">
					<span><?=date('d/m/Y', strtotime($tarifa->fecha_inicio))?> - <?=date('d/m/Y', strtotime($tarifa->fecha_final))?></span> <br>
					<span>Actualizado: <?=date('d/m/Y H:i:s', strtotime($tarifa->last_updated))?></span>
				</div>
				<div class="col-2 text-right">
					<button type="button" id="eliminarTarifa_<?=$tarifa->id_tarifa?>" class="btn btn-link ml-2 p-0" onclick="eliminarTarifa(<?=$tarifa->id_tarifa?>)">
						<i class="fa fa-trash text-danger" aria-hidden="true" style="font-size: 14px !important;"></i>
					</button>
				</div>
			</div>
		</div>
	<?php } ?>
</div>