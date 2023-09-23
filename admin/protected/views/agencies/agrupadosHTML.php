<style>
	table {
		width: 50%;
		font-family:verdana !important;
	}
	div.table-title { display: block; margin: auto; max-width: 600px; padding:5px; width: 100%; }
	.table-title h3 { color: #fafafa; /*font-size: 30px;*/ font-weight: 400; font-style:normal; font-family: verdana; text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1); text-transform:uppercase; }
	/*** Table Styles **/
	.table-fill { background: white; border-collapse: collapse; margin: auto; max-width: 600px; padding:5px; width: 100%;  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1); animation: float 5s infinite; }
	th { 
		padding:10px; 
		text-align:center; 
		text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); 
		vertical-align:middle; }
	tr { color:#000000; /*font-size:16px;*/ font-weight:normal; text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1); }
	tr:first-child { border-top:none; }
	tr:last-child { border-bottom:none; }
	td { background:#FFFFFF; padding:10px; text-align:left; vertical-align:middle; font-weight:300; /*font-size:12px;*/   text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1); border-right: 1px solid #C1C3D1; }
	th.text-left { text-align: left; }
	th.text-center { text-align: center; }
	th.text-right { text-align: right; } 
	td.text-left { text-align: left; }
	td.text-center { text-align: center; }
	td.text-right { text-align: right; }

	td, th {
		border: 1px solid #ddd;
	}

	th {
		padding-top: 12px;
		padding-bottom: 12px;
	}

	.th-color{
		background-color: #4CAF50 !important;
		color: white;
	}

	tr.noBorder td {
		border: 0;
	}

	tr.noBorder th {
		border: 0;
	}
</style>

<div style='font-family:verdana; width: 100%;'>
	<div style='padding:18px;'>
		<div align="center">
			<img src="https://<?=$_SERVER['SERVER_NAME']?>/images/logo_tranfer.png" style="width: 20%;">
		</div>
		<?php if ($grupo): ?>
			<p>Estimado: <b>Enrique</b></p>
			<p>Nos complace enviarle los siguientes estados de cuenta con la finalidad de darle a conocer las ventas realizadas por las agencias en el periodo de <?=ucfirst(strtolower($agencias[0]['date']))?>.</p>
		<?php else: ?>
			<p>Estimado: <b><?=$agencia->name?></b></p>
			<p>Nos complace enviarle el siguiente estado de cuenta con la finalidad de darle a conocer las ventas realizadas en el periodo de <?=ucfirst(strtolower($date))?>.</p>
			<div style="width: 100%;">
				<br>
				<span>Atentamente,</span><br>
				<span>Transfer Holbox.</span>
			</div>
		<?php endif ?>
	</div>
</div>