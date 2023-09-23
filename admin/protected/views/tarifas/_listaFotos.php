<?php 
$ruta = str_replace("admin.", "", $_SERVER['SERVER_NAME']);
?>
<div class="row">
	<?php if (count($fotos) > 0): ?>
		<?php foreach ($fotos as $key => $foto): ?>
			<div class="col-6 col-lg-3 col-md-3 wrapper__foto">
				<img src="https://<?=$ruta.$foto->path?>" alt="title: <?=$foto->titulo?>" style="width: 100%;">
				<span style="font-size: 12px;"><?=date('d/m/Y H:i:s', strtotime($foto->log))?></span>
				<button type="button" id="eliminarFoto_<?=$foto->id_galeria?>" data-id="<?=$foto->id_galeria?>" class="btn btn-link ml-2" onclick="eliminarFoto(<?=$foto->id_galeria?>)"><i class="fa fa-trash text-danger" aria-hidden="true" style="font-size: 14px !important;"></i></button>
			</div>
		<?php endforeach ?>
	<?php endif ?>
</div>