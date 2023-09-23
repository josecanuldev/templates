<?php

$this->breadcrumbs=array(

	'Reserva Transfer Holbox',

);

Yii::app()->clientScript->registerCssFile('https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css');

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/styles.scss');

?>

<link rel="stylesheet" type="text/css" href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css">

<link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl;?>/css/styles.scss">



<div id="app" class="font-weight-bold">

	<section class="bg-light text-left">

		<div class="container pb-5">

			<div class="row">

				<div class="col-md-3 align-items-center bg-light"><img src="<?=Yii::app()->baseUrl;?>/images/logo-holbox.svg" alt="TransferHolbox">

				</div>

				<div class="col-md-9 align-items-center"><h1 class="text-dark"> Reserva Transfer Holbox</h1>

				</div>

			</div>

			<div class="row">

				<div class="col-md-12">

					<hr class="text-dark">

				</div>

			</div>

			<?php $this->renderPartial('_form_cliente'); ?>

			<hr>

			<div class="row text-secondary">

				<div class="col-md-12 mb-3 text-left">

					<fieldset class="form-group" id="__BVID__64">

						<legend tabindex="-1" class="bv-no-focus-ring col-form-label pt-0" id="__BVID__64__BV_label_">Tipo de viaje</legend>

						<div>

							<div id="travel-type-radios" role="radiogroup" tabindex="-1" class="bv-no-focus-ring">

								<div class="custom-control custom-control-inline custom-radio">

									<input type="radio" name="travel-type-radios" class="custom-control-input" value="single-trip" id="__BVID__66">

									<label class="custom-control-label" for="__BVID__66">Sencillo</label>

								</div>

								<div class="custom-control custom-control-inline custom-radio">

									<input type="radio" name="travel-type-radios" class="custom-control-input" value="round-trip" id="__BVID__67">

									<label class="custom-control-label" for="__BVID__67">Viaje redondo</label>

								</div>

							</div>

						</div>

					</fieldset>

				</div>

			</div>

			<div class="row text-secondary bd-top-black">

				<div class="col-md-6 bd-right-black">

					<div class="row">

						<div class="col-md-8 mt-3 mb-3">

							<div class="row g-3">

								<div class="col-auto">

									<label for="from-option" class="col-form-label">Lugar / Zona:</label>

								</div>

								<div id="from-header" class="col-auto">

									<select class="custom-select" id="__BVID__68">

										<option disabled="disabled" value="">Selecciona una opción</option>

										<option value="d1358ec9-f56c-454a-9f67-cb61c087f354">Aeropuerto Cancún</option>

										<option value="6fc93049-8615-47cd-825a-dec7f0949b62">Chiquilá</option>

										<option value="2fcee9fe-c5bd-11eb-84f6-008cfae72000">Holbox</option>

										<option value="71774325-e871-40e3-bc19-82994873790c">Cancún</option>

										<option value="2f9198e4-2088-4b13-a230-b37f44515670">Riviera Maya</option>

										<option value="324f3ef3-44a2-4d15-b308-30b16160c884">Valladolid</option>

										<option value="4f3cbc21-3626-4ba2-8f42-d0d0afa847c0">Mérida</option>

										<option value="302495fa-6f8c-4dad-89d8-9a4b816ff160">Chichen itzá</option>

									</select>

								</div>

							</div>

						</div>

						<div class="col-md-4">

							<button type="button" class="btn btn-block mt-3 mb-3 btn-secondary"> Agregar zona </button>

						</div>

					</div>

					<div class="row bd-top-black">

						<div class="col-md-12 mb-3 mt-3">

							<label>Información del Origen</label>

						</div>

					</div>

					<div id="from-form-container">

						<div class="simple-form-container">

							<div class="row">

								<div class="col-md-12 mb-3">

									<div class="row">

										<div class="col-md-6">

											<label for="arrival_date" class="form-label">Fecha de llegada</label>

											<div role="group" class="input-group">

												<input type="text" placeholder="YYYY-MM-DD" autocomplete="off" class="form-control" id="__BVID__57">

												<div class="input-group-append">

													<div class="b-form-btn-label-control dropdown b-form-datepicker btn-group" id="__BVID__58__outer_" lang="es-MX" aria-labelledby="__BVID__58__value_">

														<button type="button" aria-haspopup="dialog" aria-expanded="false" class="btn btn-secondary dropdown-toggle dropdown-toggle-no-caret" id="__BVID__58">

															<svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" aria-label="calendar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-calendar b-icon bi">

																<g>

																	<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path>

																</g>

															</svg>

														</button>

														<div role="dialog" tabindex="-1" aria-modal="false" class="dropdown-menu dropdown-menu-right" id="__BVID__58__dialog_" aria-labelledby="__BVID__58__value_" style="">

														</div>

														<label class="sr-only" id="__BVID__58__value_" for="__BVID__58">No date selected</label>

													</div>

												</div>

											</div>

										</div>

										<div class="col-md-6">

											<label for="arrival_hour">Hora de llegada</label>

											<div role="group" dir="ltr" class="b-form-btn-label-control dropdown b-form-timepicker form-control" id="__BVID__61__outer_" lang="en" aria-labelledby="__BVID__61__value_">

												<button type="button" aria-haspopup="dialog" aria-expanded="false" class="btn h-auto" id="__BVID__61">

													<svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" aria-label="clock" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-clock b-icon bi">

														<g>

															<path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>

															<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>

														</g>

													</svg>

												</button>

												<div role="dialog" tabindex="-1" aria-modal="false" class="dropdown-menu" id="__BVID__61__dialog_" aria-labelledby="__BVID__61__value_" style="">

												</div>

												<label class="form-control" id="__BVID__61__value_" for="__BVID__61">8:33 PM</label>

											</div>

										</div>

									</div>

								</div>

							</div>

							<div class="row">

								<div class="col-md-6">

									<div class="mb-3">

										<label for="single-arrival-select-hotel">Hotel / Sitio</label>

										<select class="custom-select" id="__BVID__236"></select>

									</div>

								</div>

								<div class="col-md-6">

									<button type="button" class="btn btn-block mb-2 btn-secondary" style="margin-top: 32px !important;"> Agregar Sitio </button>

								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="col-md-6 mb-3">

					<div class="row">

						<div class="col-md-12 mt-3 mb-3">

							<div class="row g-3">

								<div class="col-auto">

									<label for="to-optiion" class="col-form-label">Lugar / Zona:</label>

								</div>

								<div id="to-header" class="col-auto">

									<select class="custom-select" id="__BVID__73">

										<option disabled="disabled" value="">Selecciona una opción</option>

										<option value="d1358ec9-f56c-454a-9f67-cb61c087f354">Aeropuerto Cancún</option>

										<option value="6fc93049-8615-47cd-825a-dec7f0949b62">Chiquilá</option>

										<option value="2fcee9fe-c5bd-11eb-84f6-008cfae72000">Holbox</option>

										<option value="71774325-e871-40e3-bc19-82994873790c">Cancún</option>

										<option value="2f9198e4-2088-4b13-a230-b37f44515670">Riviera Maya</option>

										<option value="324f3ef3-44a2-4d15-b308-30b16160c884">Valladolid</option>

										<option value="4f3cbc21-3626-4ba2-8f42-d0d0afa847c0">Mérida</option>

										<option value="302495fa-6f8c-4dad-89d8-9a4b816ff160">Chichen itzá</option>

									</select>

								</div>

							</div>

						</div>

					</div>

					<div class="row bd-top-black">

						<div class="col-md-12 mb-3 mt-3">

							<label>Información del Destino</label>

						</div>

					</div>

					<div id="to-form-container">

						<div class="simple-form-container">

							<div class="row">

								<div class="col-md-4">

									<label for="arrival_hour">Hora de llegada</label>

									<div role="group" dir="ltr" class="b-form-btn-label-control dropdown b-form-timepicker form-control" id="__BVID__61__outer_" lang="en" aria-labelledby="__BVID__61__value_">

										<button type="button" aria-haspopup="dialog" aria-expanded="false" class="btn h-auto" id="__BVID__61">

											<svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" aria-label="clock" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-clock b-icon bi">

												<g>

													<path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>

													<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>

												</g>

											</svg>

										</button>

										<div role="dialog" tabindex="-1" aria-modal="false" class="dropdown-menu" id="__BVID__61__dialog_" aria-labelledby="__BVID__61__value_" style="">

										</div>

										<label class="form-control" id="__BVID__61__value_" for="__BVID__61">8:33 PM</label>

									</div>

								</div>

								<div class="col-md-4">

									<label for="aerolinea-vuelo">Aerolínea</label>

									<input type="text" autocomplete="off" class="form-control" id="__BVID__54">

								</div>

								<div class="col-md-4">

									<label for="num-vuelo">Vuelo</label>

									<input type="text" autocomplete="off" class="form-control" id="__BVID__54">

								</div>

							</div>

							<div class="row g-3 mt-3 mb-3">

								<div class="col-md-3">

									<label for="from-option" class="col-form-label">Lugar / Zona:</label>

								</div>

								<div class="col-md-9">

									<input type="text" autocomplete="off" class="form-control" id="__BVID__54">

								</div>

							</div>

							<div class="row g-3 mt-3 mb-3">

								<div class="col-md-3">

									<button type="button" class="btn btn-block mb-2 btn-secondary"> Flight stat </button>

								</div>

								<div class="col-md-9">

									<input type="text" autocomplete="off" class="form-control" id="__BVID__54">

								</div>

							</div>

							<div class="row g-3 mt-3 mb-3">

								<div class="col-md-3">

									<input type="text" autocomplete="off" class="form-control" id="__BVID__54">

								</div>

								<div class="col-md-9">

									<input type="text" autocomplete="off" class="form-control" id="__BVID__54">

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

			<div class="row text-secondary bd-top-black">

				<div class="col-md-12 mt-3 mb-3">

					<label for="observations-textarea" class="form-label"> Observaciones </label>

					<textarea id="observations-textarea" name="observations-textarea" rows="5" wrap="soft" class="form-control"></textarea>

				</div>

			</div>

			<div class="row">

				<div class="col-md-3">

				</div>

				<div class="col-md-6">

					<button type="button" class="btn btn-block btn-primary"> Guardar Reservación </button>

				</div>

				<div class="col-md-3">

				</div>

			</div>

		</div>

	</section>

</div>



<?php 

Yii::app()->clientScript->registerScriptFile('https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/assets/vue/reservaTraslados.js', CClientScript::POS_END); 



?>

