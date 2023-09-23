<?php
$fecha_inicio = date("Y-01-01");
$fecha_final = date("Y-12-31");
if (!$model->isNewRecord) {
	$fecha_inicio = date("Y-m-d", strtotime($model->fecha_inicio));
	$fecha_final = date("Y-m-d", strtotime($model->fecha_final));
}
$pasajeros = 11;
$Limite = General::model()->find('idgeneral=1');
if (!empty($Limite)) {
	$pasajeros = $Limite->passengersLimit;
}
?>
<div class="row">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'tarifas-form',
		'enableAjaxValidation'=>false,
		'method'=>'post',
		'action'=>$model->isNewRecord ? Yii::app()->controller->createUrl('index', array('id'=> -1)) : Yii::app()->controller->createUrl('index', array('id'=> $model->id_tarifa)),
		'type'=>'',
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data'
		)
	)); ?>
	<fieldset>
		<div class="col-12">
			<legend>

				<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

			</legend>
		</div>

		<?php echo $form->errorSummary($model,'Opps!!!', null,array('class'=>'alert alert-error mt-2 mb-2')); ?>

		<div class="col-12 mt-2">
			<div class="row">
				<div class="col-6 col-md-3 col-lg-3">
					<?php echo $form->textFieldRow($model,'nombre_tarifa',array('class'=>'form-control','maxlength'=>255,'required'=>true)); ?>
				</div>
				<div class="col-6 col-md-3 col-lg-3">
					<?php echo $form->textFieldRow($model,'codigo',array('class'=>'form-control','maxlength'=>255)); ?>
				</div>
				<div class="col-12 col-md-6 col-lg-6">
					<div id="selectRutas"></div>
				</div>
			</div>
		</div>

		<div class="col-12 mt-2">
			<div class="row">
				<div class="d-none">
					<?php echo $form->textFieldRow($model,'id_tipo_tarifa',array('class'=>'form-control')); ?>
				</div>
				<div class="col-lg-3 col-12">
					<?php echo $form->labelEx($model,'id_tipoviaje'); ?>
					<?php
					echo $form->DropDownList($model,'id_tipoviaje',Chtml::listData(Tipoviaje::model()->findAll(),'id_tipoviaje','viaje'),array('empty'=>'Seleccionar viaje','class'=>'form-control','required'=>true)); 
					?>
				</div>
				<div class="col-lg-3 col-6">
					<?php echo $form->labelEx($model,'fecha_inicio'); ?>
					<?php echo $form->textField($model,'fecha_inicio',array('class'=>'form-control', 'data-date-format'=>'yyyy-mm-dd', 'value' => $fecha_inicio, 'data-date-autoclose'=>'true', 'required'=>'required')); ?>
				</div>
				<div class="col-lg-3 col-6">
					<?php echo $form->labelEx($model,'fecha_final'); ?>
					<?php echo $form->textField($model,'fecha_final',array('class'=>'form-control', 'data-date-format'=>'yyyy-mm-dd', 'value' => $fecha_final, 'data-date-autoclose'=>'true', 'required'=>'required')); ?>
				</div>
				<div class="col-lg-3 col-12">
					<?php echo $form->labelEx($model,'id_agencia'); ?>
					<?php echo $form->dropDownList($model,'id_agencia', CHtml::listData(Agencies::model()->findAll(), 'id', 'name'), array('empty'=>'Seleccionar Agencia', 'class' => 'form-control select__2')); ?>
				</div>
			</div>
		</div>

		<div class="col-12 mt-2">
			<div class="row">
				<div class="col-lg-3 col-6">
					<?php echo $form->labelEx($model,'moneda'); ?>
					<?php
					echo $form->DropDownList($model,'moneda',array('MXN'=>'MXN','USD'=>'USD'),array('class'=>'form-control'))
					?>
				</div>
				<div class="col-lg-3 col-6">
					<?php echo $form->textFieldRow($model,'tipo_cambio',array('class'=>'form-control')); ?>
				</div>
				<div class="col-lg-3 col-6">
					<?php echo $form->labelEx($model,'estatus'); ?>
					<?php
					echo $form->DropDownList($model,'estatus',array(0=>'Ináctivo',1=>'Activo'),array('class'=>'form-control'))
					?>
				</div>
				<div class="col-lg-3 col-6">
					<?php echo $form->labelEx($model,'no_reembosable'); ?>
					<?php
					echo $form->DropDownList($model,'no_reembosable',array(0=>'No',1=>'Sí'),array('class'=>'form-control'))
					?>
				</div>
			</div>
		</div>

		<div class="col-12 mt-2">
			<div class="row">
				<div class="col-12 col-lg-6 col-md-6">
					<?php echo $form->textAreaRow($model,'restricciones',array('rows'=>12, 'cols'=>50, 'class'=>'form-control')); ?>
				</div>
				<div class="col-12 col-lg-6 col-md-6">
					<?php echo $form->textAreaRow($model,'politicas_cancelacion',array('rows'=>12, 'cols'=>50, 'class'=>'form-control')); ?>
				</div>
			</div>
		</div>

		<div class="col-12 mt-2">
			<?php echo $form->textAreaRow($model,'observaciones',array('rows'=>12, 'cols'=>50, 'class'=>'form-control')); ?>
		</div>

		<?php if ($model->id_tarifa > 0): ?>
			<div class="col-12 mt-3">
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#GaleriaTarifas">
				  Subir Fotos
				</button>
			</div>
		<?php endif ?>

		<div id="categorias" class="col-12 mb-4 mt-4">
			<h4 class="mt-4 mb-4">Categorías</h4>
			<hr>
			<div class="row">
				<div class="col-12">
					<ul id="userTab" class="nav nav-tabs">
						<?php foreach ($categorias as $key => $row) { ?>
							<li class="nav-item" role="presentation">
								<a id="id_categorias_<?=$row->id_categoria?>" class="nav-link <?=!$model->isNewRecord && $key == 0 ? 'active' : ''?>" href="#categoria_<?=$row->id_categoria?>" data-toggle="tab">
									<?=$row->tipo?>
								</a>
							</li>
						<?php } ?>
					</ul>
					<div id="userTabContent" class="tab-content p b-a no-b-t bg-white m-b-md">
						<?php foreach ($categorias as $key => $row) {
							$catModel = [];
							if (!$model->isNewRecord) {
								$catModel = TarifasDesglose::model()->findAll('id_tarifa='.$model->id_tarifa.' AND id_categoria='.$row->id_categoria);
								// echo '<textarea>'.CJSON::encode($catModel).'</textarea>';
							}
						?>
							<div id="categoria_<?=$row->id_categoria?>" class="tab-pane animated fadeIn categoria mt-4 <?=!$model->isNewRecord && $key == 0 ? 'active' : ''?>" role="tabpanel">
								<div class="mb-1">
									<span>Paxs</span>
								</div>
								<table id="catgtbl_<?=$row->id_categoria?>" class="table-bordered table-condensed md-whiteframe-z1 catgtbl">
									<tr>
										<th>Pax mín.</th>
										<th>Pax máx.</th>
										<th>Precio público</th>
										<th>
											<button type="button" id="btn_add_<?=$row->id_categoria?>" data-id="<?=$row->id_categoria?>" data-tipo="add" class="btn btn-primary btn-xs agrega-pax" onclick="addRows(<?=$row->id_categoria?>)">
												<i class="fa fa-plus"></i>
											</button>
											<button type="button" id="btn_delete_<?=$row->id_categoria?>" data-id="<?=$row->id_categoria?>" data-tipo="delete" class="btn btn-primary btn-xs quitar-pax" onclick="deleteRows(<?=$row->id_categoria?>)">
												<i class="fa fa-minus"></i>
											</button>
										</th>
									</tr>
									<?php if (count($catModel) > 0): ?>
										<?php foreach ($catModel as $key => $catg): 
											$index_catg = $key;
										?>
											<?php echo $this->renderPartial('_desgloseColumns', array(
												'row'=>$row,
												'catg' => $catg,
												'contCatg' => count($catModel),
												'key' => $index_catg,
												'pasajeros' => $pasajeros));
											?>
										<?php endforeach ?>
									<?php else: ?>
										<?php echo $this->renderPartial('_desgloseColumns', array('row'=>$row, 'catg' => null, 'contCatg' => 3, 'key' => $index_catg, 'pasajeros' => $pasajeros)); ?>
									<?php endif ?>
								</table>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>

		<?php echo $form->hiddenField($model,'id_tarifa',array()); ?>

		<?php echo $form->hiddenField($model,'terminoscondiciones',array()); ?>

		<?php echo $form->hiddenField($model,'last_updated',array()); ?>

		<div class="col-12 mt-4">
			<div class="form-actions">

				<?php $this->widget('bootstrap.widgets.TbButton', array(

					'buttonType'=>'submit',

					'type'=>'primary',

					'icon'=>'ok white',  

					'label'=>$model->isNewRecord ? 'Crear Tarifa' : 'Actualizar',

				)); ?>
				<?php $this->widget('bootstrap.widgets.TbButton', array(

					'buttonType'=>'reset',

					'icon'=>'remove',  

					'label'=>'Limpiar',

					'htmlOptions'=>array('class'=>'btn-dark float-right guardar_T'),

				)); ?>
			</div>
		</div>


	</fieldset>



	<?php $this->endWidget(); ?>
	
</div>

<?php
Yii::app()->clientScript->registerScript('tarifas', "
	$(document).ready(function() {
		$('#Tarifas_fecha_inicio').datepicker({ format: 'yyyy-mm-dd', locale: 'es-es', language: 'es', autoclose: true, orientation: 'bottom' });
		$('#Tarifas_fecha_final').datepicker({ format: 'yyyy-mm-dd', locale: 'es-es', language: 'es', autoclose: true });
		formSelectRutas()
		// $('#Tarifas_fecha_inicio').datepicker();
		// $('#Tarifas_fecha_final').datepicker();
		});
		", CClientScript::POS_END);
		?>
<script>
	function addRows(id) {
		var table = document.getElementById('catgtbl_' + id);
		var rowCount = table.rows.length;
		var cellCount = table.rows[0].cells.length; 
		var row = table.insertRow(rowCount);
		// console.log(row)
		for(var i = 0; i < cellCount; i++) {
			// if (i >= 3) continue
			var cell = 'cell' + i;
			cell = row.insertCell(i);
			var copycel = document.getElementById('col' + i + '_' + id);
			cell.innerHTML=copycel.innerHTML;
			if (i == 0 || i == 1) {
				var select = cell.getElementsByTagName('select')
				for (var s = 0; s < select.length; s++) {
					if (select[s].type == 'select-one') select[s].selectedIndex = 0
				}
			}
			if (i == 2) {
				var input = cell.getElementsByTagName('input')
				// console.log(input)
				for (var n = 0; n < input.length; n++) {
					if (input[n].type == 'text') input[n].value = 0
				}
			}
			if (i == 3) {
				var btn = cell.getElementsByTagName('button')
				for (var b = 0; b < btn.length; b++) {
					if (btn[b].type == 'button') {
						var key = rowCount - 1
						btn[b].id = 'btn_desglose_' + key +'_' + id
						btn[b].dataset.id = id
						btn[b].dataset.key = key
						btn[b].setAttribute('onclick', 'deleteDesglose(' + id + ',' + key + ')')
					}
				}
				// console.log(cell.getElementsByTagName('button'))
			}
		}
	}
	function deleteRows(id){
		var table = document.getElementById('catgtbl_' + id);
		var rowCount = table.rows.length;
		if(rowCount > '2') {
			var row = table.deleteRow(rowCount-1);
			rowCount--;
		} else {
			alert('No es posible eliminar todas las columnas');
		}
	}
	function deleteDesglose(id, key) {
		var table = document.getElementById('catgtbl_' + id);
		var rowCount = table.rows.length;
		var btn = $('#btn_desglose_' + key + '_' + id)
		if (confirm("¿Desea eliminar el precio seleccionado?. Click en actualizar para confirmar la eliminación")) {
			console.log(table, btn)
			if (rowCount > '2') {
				if (btn != null) {
					var getKey = btn.data('key')
					var row = table.deleteRow(parseInt(getKey)+1)
				}
			} else {
				alert('No es posible eliminar todas las columnas. Si desea no tener tarifas en esta categoría, cambie los pax en 1 y los precios en 0.00.');
			}
		}
	}
	function formSelectRutas() {
		$("#selectRutas").html("<div align='center'><img width='15px' src='<?=Yii::app()->request->baseUrl?>/images/loader.gif'></div>");
		$.ajax({
			url: '<?=$baseUrl?>/tarifas/formRutas',
			type: 'POST',
			data: {id_ruta: <?=$model->isNewRecord ? -1 : $model->id_ruta?>}
		})
		.done(function(response) {
			console.log("success");
			$("#selectRutas").html(response)
		})
		.fail(function(error) {
			console.log("error", error);
		})
		.always(function() {
			console.log("complete");
		});
		
	}
</script>