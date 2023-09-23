
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title><?=$cupon->idioma == 'es' ? 'Orden' : 'Order'?> <?=$id?> <?=$cupon->idioma == 'es' ? 'Confirmado' : 'Confirmed'?></title>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,300" rel="stylesheet" type="text/css" />


    <title><?=$cupon->idioma == 'es' ? 'Orden' : 'Order'?> <?=$id?> <?=$cupon->idioma == 'es' ? 'Confirmado' : 'Confirmed'?></title>

    <style>
        @media screen {
            @import url(https://fonts.googleapis.com/css?family=Lato:400,700,300);
        }

        body {
            font-family: "Lato", Arial;
            color: #2c3d4f;
            background: #fff;
            font-weight: 400;
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }

        #background_table {
            margin: 0;
            padding: 0;
            width: 100%!important;
            line-height: 100%!important;
        }

        h1,
        h2,
        h3,
        h4 {
            font-weight: 300;
            margin: 0;
            line-height: 1.2;
        }

        h1 {
            line-height: 1;
        }

        h2 strong,
        h3 strong {
            font-weight: 700;
        }

        small {
            font-size: 10px;
            font-weight: 400;
        }

        strong {
            font-weight: 700;
        }

        img {
            outline: none;
            text-decoration: none;
            border: none;
            -ms-interpolation-mode: bicubic;
            /*max-width: 100%;*/
            max-width: 40%;
            height: auto;
            /*display: block;*/
        }

        table td {
            border-collapse: collapse;
            font-size: 13px;
            line-height: 1.4;
            color: #2c3d4f;
            text-align: center;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        table td[class="column"],
        table td[class="column-info"] {
            height: 320px;
            width: 320px;
        }

        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        table[class="gift_table"],
        table[class="header_table"],
        table[class="subheader_table"],
        table[class="table"] {
            width: 640px;
        }

        table[class="table"] td {
            padding: 0 15px;
            border-color: #fff;
        }

        table[class="table"] td p {
            margin: 5px 0;
        }

        table[class="header_table"] td {
            /*padding: 15px 30px; */
            border-color: #fff;
        }

        table[class="subheader_table"] {
            border-collapse: separate;
        }

        table[class="table"] td {
            padding: 5px 0px;
        }

        @media only screen and (max-width: 600px) {
            table[class="gift_table"] {
                width: 320px!important;
            }
            table td[class="column"] {
                width: 100%!important;
                display: block!important;
            }
            table td[class="column-info"] {
                width: 100%!important;
                display: block!important;
                height: auto;
            }
        }


        @media print {
            @import url(https://fonts.googleapis.com/css?family=Lato:400,700,300);
            body {
                background-color: #fff !important;
                margin: 0;
            }
            .hidden-print {
                display: none !important;
            }
            #background_table {
                background-color: #fff !important;
            }
            table[class="header_table"],
            table[class="subheader_table"],
            table[class="table"],
            table[class="footer_table"] {
                width: 100%;
                margin-bottom: 20px;
            }
            table[class="header_table"] tr,
            table[class="subheader_table"] tr,
            table[class="table"] tr {
                position: relative;
            }

            table[class="subheader_table order_summary"] {
               border-collapse: separate !important;
               border-spacing: 10px !important;
               width: calc(100% + 20px) !important;
               margin-left: -10px;
           }
           table td[class="items-overview"] {
            background: white !important;
            color: black !important;
        }

        table > tbody > tr > td > a > img {
            page-break-inside: avoid !important;
        }

        h1,h2,h3,h4,h5,h6,p,a,small,td {
            color: #000000 !important;
        }

        small {
            color: gray !important;
        }

        table {
            border-collapse: collapse !important;
            border:none !important;
            height: auto !important;
            background-color: #ffffff !important;
            color: #000000 !important;
            width: 100% !important;
        }

        table > tbody > tr > td {
            padding: 2px 0 !important;
        }

        p {
           margin-bottom: 5px !important;
       }
   }

   @media print and (orientation:portrait) {
    table[class="gift_table"] {
        width: 320px!important;
    }
    table td[class="column"] {
        width: 100%!important;
        display: block!important;
    }
    table td[class="column-info"] {
        width: 100%!important;
        display: block!important;
        height: auto;
    }
}

</style>

</head>
<body style="margin: 0; background-color: #ecf0f1;" margin="0">
    <!-- <div style="display: none; max-height: 0px; overflow: hidden;">
        3 x APT - HBX - From Cancun Aeropuerto to Holbox
        // Depart: Tuesday, February 22, 2022 5:15 PM
        3 x HBX - APT - From Holbox to Cancun Aeropuerto
        // Depart: Thursday, March 3, 2022 2:00 PM
    </div> -->
    <div style="display: none; max-height: 0px; overflow: hidden;">
        <?=$cupon->idioma == 'es' ? 'Servicio' : 'Transfer'?>
        <?php  
        $tipoViaje = '';
        if ($cupon->idioma == 'es') {
            $tipoViaje = $data["tipoViaje"];
            echo $tipoViaje;
        } else {
            if ($cupon->tipoViaje == 'Redondo') {
                $tipoViaje = 'Round'; 
                echo $tipoViaje;
            } else if ($cupon->tipoViaje == 'Sencillo') {
                $tipoViaje = 'Single';
                echo $tipoViaje;
            }
        }
        ?>
    </div>
    <div style="display: none; max-height: 0px; overflow: hidden;">
        &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
        &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
        &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
        &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
        &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
        &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
        &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
        &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
        &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
        &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
        &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
        &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
    </div>

    <table width="100%" bgcolor="#ecf0f1" cellpadding="0" cellspacing="0" border="0" id="background_table">
        <tbody>
            <tr>
                <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; padding-top: 0px;">


                     <table width="640" cellpadding="0" cellspacing="0" border="0" align="center" class="header_table hidden-print">
                        <tbody>
                            <tr>
                                <td style="text-align: right; vertical-align: middle; border-bottom: 1px solid #ecf0f1; padding: 5px 0; font-size:11px;">
                                    <!-- <a href="https://<?=$_SERVER['SERVER_NAME']?>/formatos/cupon?id=<?=$id?>" style="color: #000;" onclick="printpage()">
                                    <?=$cupon->idioma == 'es' ? 'Imprimir Confirmación' : 'Print Confirmation' ?>
                                    </a> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>



                    <table width="640" bgcolor="#ffffff" height="120" cellpadding="0" cellspacing="0" border="0" align="center" class="header_table">
                        <tbody>
                            <tr>
                                <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; padding:15px 30px; width: 50%; text-align: center; padding-bottom: 0px;">
                                    <img src="https://<?=$_SERVER['SERVER_NAME']?>/images/Cancun_Isla_simple-03.jpg" style="margin:10px 0; /*max-width:120px; width:120px;*/ height: auto;">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; font-size:16px; font-weight:400; padding-top: 0px;">
                                    <!-- Av. Damero Mz 11 Predio 01  -->
                                    <!-- <br> RFC: TCH-210203MD2  -->
                                    <br>Cancun To Isla Mujeres
                                    <!-- <br>Michelle Ramirez -->
                                    <!-- <br>Louis Ramirez. Cel: <a href='tel:9841697279'>9841697279</a> -->
                                    <!-- <br>Tel: <a href='tel:9848752104'>(984) 8752104</a> & <a href='tel:9848752342'>(984) 8752342</a> -->
                                    <br>Tel: <a href='tel:+5215649607188'>(1 56) 4960 7188</a>
                                    <br>WPP: <img src='https://admin.cancuntoislamujeres.com/images/WhatsApp.svg.png' width='20' /> <a href='https://wa.me/5215649607188?text=Hola%20me%20podría%20ayudar'>+52 1 56 4960 7188</a>
                                    <!-- <br>Cel: <a href='tel:9841369340'>9841369340</a> -->
                                    <br>EMAIL: admon@cancuntoislamujeres.com
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="640" bgcolor="#ffffff" height="0" cellpadding="0" cellspacing="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; padding:15px 30px; width: 100%; text-align: right; vertical-align: top; font-size: 16px;">
                                    <?=$date?>
                                    <br> 
                                    <a href="#" style="background-color: yellow; font-weight: bolder;">Folio: <?=$id?></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; width: 100%; text-align: center; vertical-align: top;">
                                    <h2> 
                                        <strong> 
                                            <?php 
                                            if ($cupon->idioma == 'es') {
                                                echo 'Servicios de Transportación';
                                            } else {
                                                echo 'TRANSPORTATION SERVICES';
                                            }
                                            ?>
                                        </strong> 
                                    </h2>
                                </td>
                            </tr>
                        </tbody>
                    </table>   

                    <?php
	                    if ($cupon->idioma == 'es') {
	                        $fecha = 'Fecha';
	                        $nombre = 'Nombre';
	                        $pax = 'Pax';
	                        $service = 'Servicios';
	                        $horaServicio = 'Hora de servicio';
	                        $observaciones = 'Observaciones';
                            $descuento = 'Descuento';
                            $telefono = 'Telefono';
                            $tipovuelo = 'Tipo de Vuelo';
                            $ciudad = 'Ciudad';
	                    } else {
	                        $fecha = 'Date';
	                        $nombre = 'Name';
	                        $pax = 'Passengers';
	                        $service = 'Services';
	                        $horaServicio = 'Hour of service';
	                        $observaciones = 'Observations';
                            $descuento = 'Discount';
                            $telefono = 'Phone';
                            $tipovuelo = 'Type of flight';
                            $ciudad = 'City';
	                    }  
	                ?>    

                    <table width="640" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" align="center" class="header_table">
                        <tbody>
                            <tr>
                                <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; padding:15px 30px; width: 100%; text-align: left; vertical-align: top; font-size: 14px;">
                                    <h3 style="padding: 10px 0"><strong>** <?= $cupon->idioma == 'es' ? 'Servicio' : 'Service' ?> <?=$tipoViaje?></strong></h3>

                                    <?php if ($cupon->id_arrivals_to == 1): ?>
                                        <h3 style="padding: 10px 0"><strong>* <?=$cupon->idioma == 'es' ? 'SALIDA' : 'DEPARTURE' ?></strong></h3>
                                    <?php else: ?>
                                        <?php if (in_array($cupon->id_arrivals_to, [2, 3])): ?>
                                            <h3 style="padding: 10px 0"><strong>* <?= $cupon->idioma == 'es' ? 'LLEGADA' : 'ARRIVAL' ?> </strong></h3>
                                        <?php elseif(in_array($cupon->id_arrivals_from, [2, 3])): ?>
                                            <h3 style="padding: 10px 0"><strong>* <?= $cupon->idioma == 'es' ? 'SALIDA' : 'DEPARTURE' ?> </strong></h3>
                                        <?php else: ?>
                                            <h3 style="padding: 10px 0"><strong>* <?= $cupon->idioma == 'es' ? 'LLEGADA' : 'ARRIVAL' ?> </strong></h3>
                                        <?php endif ?>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <tr>
                                <?php if (!empty($cupon->fechaLLegada) || $cupon->fechaLLegada != null): ?>
                                	<td style="font-family: 'Lato', Helvetica, Arial, sans-serif; padding:15px 30px; width: 100%; text-align: left; vertical-align: top; font-size: 14px;">
	                                    <!-- <h3><strong>Fecha:</strong> 21-Junio-2022 </h3>  -->
	                                    <?php if ($data["llegada"]["Fecha"]): ?>
	                                        <h3><strong><?=$fecha?>:</strong> <?=date('d-m-Y',strtotime($data["llegada"]["Fecha"]))?> </h3> 
	                                    <?php endif ?>
	                                    <h3><strong><?=$nombre?>:</strong> <?=$data["llegada"]["Nombre"]?></h3>
                                        <h3><strong><?=$telefono?>:</strong> <?=$data["llegada"]["Telefono"]?></h3>
                                        <h3><strong>Email:</strong> <?=$data["llegada"]["Correo"]?></h3>
                                        <h3><strong><?=$ciudad?>:</strong> <?=$data["llegada"]["Pais"]?></h3>
	                                    <h3><strong><?=$pax?>:</strong> <?=$data["llegada"]["Pax"]?></h3>
	                                    <!-- <h3><strong>Servicios:</strong> Aeropuerto CANCUN (Y4640) - Isla Holbox (Soho Boutique) </h3>  -->
	                                    <h3><strong><?=$service?>:</strong> <?=$data["llegada"]["Servicios"]?></h3>
                                        <h3><strong><?=$tipovuelo?>:</strong> <?=$data["llegada"]["TipoVuelo"]?></h3>
	                                    <?php if ($data["llegada"]["Hora"]): ?>
	                                        <h3><span style="background-color: yellow; color: blue;">
	                                            <strong><?=$horaServicio?>: </strong> <?=$data["llegada"]["Hora"]?> Hrs.
	                                            </span>
	                                        </h3>
	                                     <?php endif ?> 

	                                </td>
                                <?php endif ?>
                            </tr>
                            <tr>
                                <?php if (!empty($cupon->fechaSalida) || $cupon->fechaSalida != null): ?>
                                	<td style="font-family: 'Lato', Helvetica, Arial, sans-serif; padding:15px 30px; width: 100%; text-align: left; vertical-align: top; font-size: 14px;">
	                                    <?php if ($cupon->id_arrivals_to != 1): ?>
	                                        <h3 style="padding: 10px 0">
	                                            <strong>* <?= $cupon->idioma == 'es' ? 'SALIDA' : 'RETURN' ?></strong>
	                                        </h3>
	                                    <?php endif ?>

	                                    <?php if ($data["salida"]["Fecha"]): ?>
	                                        <h3>
	                                            <strong><?=$fecha?>:</strong> <?=date('d-m-Y',strtotime($data["salida"]["Fecha"]))?> 
	                                        </h3> 
	                                    <?php endif ?>
                                        <h3><strong><?=$nombre?>:</strong> <?=$data["salida"]["Nombre"]?></h3>
                                        <h3><strong><?=$telefono?>:</strong> <?=$data["salida"]["Telefono"]?></h3>
                                        <h3><strong>Email:</strong> <?=$data["salida"]["Correo"]?></h3>
	                                    <h3><strong><?=$ciudad?>:</strong> <?=$data["salida"]["Pais"]?></h3>
                                        <h3><strong><?=$pax?>:</strong> <?=$data["salida"]["Pax"]?></h3>
	                                    <h3><strong><?=$service?>:</strong> <?=$data["salida"]["Servicios"]?></h3>
	                                    <h3><strong><?=$tipovuelo?>:</strong> <?=$data["salida"]["TipoVuelo"]?></h3>
	                                        <!--  -->
	                                        <!-- <strong>Servicios:</strong> Isla Holbox (Y4640) - Playa del Carmen (H. Tukan Beach)  -->
	                                    <?php if ($data["salida"]["Pickup"]): ?>
	                                        <h3>
	                                            <span style="background-color: yellow; color: blue;">
	                                                <strong><?=$horaServicio?>: </strong> <?=$data["salida"]["Pickup"]?> Hrs.
	                                            </span>
	                                        </h3>
	                                    <?php endif ?>
	                                    <?php if ($data["salida"]["Hora"]): ?>
	                                        <h3>
	                                            <strong><?= $cupon->idioma == 'es' ? 'Hora de Vuelo' : 'Flight time' ?>: </strong> <?=$data["salida"]["Hora"]?> Hrs.
	                                        </h3>
	                                     <?php endif ?> 
	                                </td>
                                <?php endif ?>
                            </tr>
                            <tr>
                                <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; padding:15px 30px; width: 100%; text-align: left; vertical-align: top; font-size: 14px;">
                                    <h3><span><strong>Subtotal</strong> $ <?=number_format($orden->subtotal, 2)?></span></h3>
                                    <h3><span><strong>- <?=$descuento?></strong> $ <?=number_format($orden->descuento, 2)?></span></h3>
                                    <h3><span><strong>Total</strong> $ <?=number_format($orden->total, 2)?></span></h3>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; padding:15px 30px; width: 100%; text-align: left; vertical-align: top; font-size: 14px;">
                                    <h3>
                                        <span>
                                            <strong><?=$observaciones?>:</strong> <?=$data["observaciones"]?>
                                        </span> 
                                    </h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- <table width="640" bgcolor="#ffffff" cellpadding="0" cellspacing="0" height="100" border="0" align="center" class="header_table">
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </table> -->

                    <table width="640" bgcolor="#ffffff" height="160" cellpadding="0" cellspacing="0" border="0" align="center" class="header_table">
                        <tbody>
                            <tr>
                                <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; width: 100%; text-align: center; vertical-align: top; font-size: 14px;">
                                    <h3> 
                                        <strong> **  
                                        <?php if ($cupon->idioma == 'es'): ?>
                                            SERVICIOS EN TRANSPORTACIÓN TERRESTRE PRIVADA
                                        <?php elseif($cupon->idioma == 'en'): ?>
                                            PRIVATE GROUND TRANSPORTATION SERVICES 
                                        <?php endif ?>
                                        </strong> 
                                    </h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- <table width="640" bgcolor="#ffffff" height="160" cellpadding="0" cellspacing="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table> -->
                </td>
            </tr>
        </tbody>
    </table>
    <table width="100%" bgcolor="#ecf0f1" cellpadding="0" cellspacing="0" border="0" id="background_table">
        <tbody>
            <tr>
                <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; padding-top: 20px;">

                    <table width="640" bgcolor="#ffffff" height="20" cellpadding="0" cellspacing="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="640" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" align="center" class="header_table" style="border-collapse: separate; padding-top: 10px;">
                        <tbody>
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <tr style="text-align: center;">
                                <td style="width: 5%;"></td>
                                <?php if ($cupon->idioma == 'es'): ?>
                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; padding-left:10px; padding-right:0; width: 90%; border: #0300ff black solid; border-radius: 20px; background-color: #0300ff;">
                                        <table align="center">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px; color: yellow; font-size: 20px; padding: 0px !important;">
                                                        <h1>
                                                            <strong>Políticas de reserva de traslados.</strong>
                                                        </h1>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 0px; color: yellow; font-size: 14px;">
                                                        <h3><strong>TRASLADOS PRIVADOS Y PUERTA A PUERTA</strong></h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px; color: yellow; padding: 0px !important; font-weight: bolder;">
                                                        El chofer te recogerá en la terminal de la llegada de tu vuelo con un banner con tu nombre. Tener encuenta de salir por la puerta de servicios precontrados, donde se encuentra la zona de los andenes, la zona de camionetas de transportadoras.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 0px; color: yellow; font-size: 14px;">
                                                        <h3><strong>PUNTOS DE SALIDA EN CHIQUILÁ</strong></h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px; color: yellow; padding: 0px !important; font-weight: bolder;">
                                                        El chofer te recogerá en el ferry con un banner con tu nombre y te asistirá al vehículo.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 0px; color: yellow; font-size: 14px;">
                                                        <h3><strong>EN EL CASO DE UNA CANCELACIÓN O CAMBIOS A TU RESERVA</strong></h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px; color: yellow; padding: 0px !important; font-weight: bolder;">
                                                        Las cancelaciones se deben realizar directamente por correo electrónico: admon@cancuntoislamujeres.com o al +52 1 56 4960 7188, lee los términos y condiciones de tu reserva abajo.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 0px; color: yellow;">
                                                        <h3><strong>Póliza de cancelaciones</strong></h3>
                                                        <span style="font-weight: bolder;">
                                                            En caso de retraso de su vuelo: El traslado esperará al grupo sin costo.
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px; color: yellow; padding: 0px !important; font-weight: bolder;">
                                                        En caso de cancelación de su vuelo: Para que el traslado no se considera no-show deberá presentar pruebas de la aerolínea de la cancelación de vuelo.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px; color: yellow; padding: 0px !important; font-weight: bolder;">
                                                        En caso de perdida de vuelo: El traslado se considera no-show y se puede reprogramar un segundo traslado con el 50% del precio original.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px; color: yellow; padding: 0px !important; font-weight: bolder;">
                                                        En caso de cambio de vuelo: El traslado esperara siempre y cuando se pida una constancia con la aerolínea sobre el retraso.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px;">
                                                        <table align="center" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 20%;"></td>
                                                                    <td style="width: 60%; border: 1px yellow solid; background-color: yellow; color: #0300ff; font-weight: bolder;">
                                                                        <h3><strong>Políticas de CANCELACION:</strong></h3>
                                                                        Hasta 72 horas antes: Reembolso completo. <br>
                                                                        72-48 horas antes: 50% reembolsado <br>
                                                                        48-0 horas antes: no reembolsable <br>
                                                                        <small style="text-decoration: underline;">*Cualquier cambio previsto antes de 24 hrs, quedara sujeto a disponibilidad*</small>
                                                                    </td>
                                                                    <td style="width: 20%;"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 0px 30px 15px; color: yellow;">
                                                        <h3><strong>TERMINOS Y CONDICIONES</strong></h3>
                                                        <span style="font-weight: bolder;">
                                                            Por favor tener en mente de que por disposición de autoridares Federales cada traslado tiene que declarar cuantos pasajeros recogerá. Solo la cantidad de personas declaradas en su reserva serán permitidas abordar. Por favor acerciorarse de que la cantidad de pasajeros es correcta. bajo ningúna circunstancia se permitirán abordar a pasajeros adicionales. La multa federal es de $2000 USD. Por ninguna razon acceda a pagar nuevamente el servicio.
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>     
                                 <?php endif ?> 
                                 <?php if ($cupon->idioma == 'en'): ?>
                                     <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; padding-left:10px; padding-right:0; width: 90%; border: #0300ff black solid; border-radius: 20px; background-color: #0300ff;">
                                        <table align="center">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px; color: yellow; font-size: 20px; padding: 0px !important;">
                                                        <h1>
                                                            <strong>Transfer reservation policies.</strong>
                                                        </h1>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 0px; color: yellow; font-size: 14px;">
                                                        <h3><strong>PRIVATE TRANSFERS AND DOOR TO DOOR</strong></h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px; color: yellow; padding: 0px !important; font-weight: bolder;">
                                                        The driver will pick you up at the arrival terminal of your flight with a banner with your name. Keep in mind to go out through the door of pre-contracted services, where the area of the platforms, the truck area of transporters.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 0px; color: yellow; font-size: 14px;">
                                                        <h3><strong>DEPARTURE POINTS IN CHIQUILÁ</strong></h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px; color: yellow; padding: 0px !important; font-weight: bolder;">
                                                        The driver will pick you up at the ferry with a banner with your name on it and will assist you to the vehicle.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 0px; color: yellow; font-size: 14px;">
                                                        <h3><strong>IN THE EVENT OF A CANCELLATION OR CHANGES TO YOUR RESERVATION</strong></h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px; color: yellow; padding: 0px !important; font-weight: bolder;">
                                                       Cancellations must be made directly by email: admon@cancuntoislamujeres.com or at +52 1 56 4960 7188, read the terms and conditions of your reservation below.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 0px; color: yellow;">
                                                        <h3><strong>Cancellation Policy</strong></h3>
                                                        <span style="font-weight: bolder;">
                                                            In case of flight delay: The transfer will wait for the group at no cost.
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px; color: yellow; padding: 0px !important; font-weight: bolder;">
                                                        In case of cancellation of your flight: In order for the transfer not to be considered a no-show, you must present evidence from the airline of the flight cancellation.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px; color: yellow; padding: 0px !important; font-weight: bolder;">
                                                        In case of missed flight: The transfer is considered a no-show and a second can be rescheduled transfer with 50% of the original price.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px; color: yellow; padding: 0px !important; font-weight: bolder;">
                                                        In case of flight change: The transfer will wait as long as a certificate is requested with the airline about the delay.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 30px 30px 15px;">
                                                        <table align="center" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 20%;"></td>
                                                                    <td style="width: 60%; border: 1px yellow solid; background-color: yellow; color: #0300ff; font-weight: bolder;">
                                                                        <h3><strong>CANCELLATION POLICIES:</strong></h3>
                                                                        Up to 72 hours before: Full refund. <br>
                                                                        72-48 hours before: 50% refund. <br>
                                                                        48-0 hours before: non-refundable. <br>
                                                                        <small style="text-decoration: underline;">*Any change planned before 24 hours, will be subject to availability*</small>
                                                                    </td>
                                                                    <td style="width: 20%;"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Lato', Helvetica, Arial, sans-serif; text-align: center; padding: 0px 30px 15px; color: yellow;">
                                                        <h3><strong>TERMS AND CONDITIONS</strong></h3>
                                                        <span style="font-weight: bolder;">
                                                           Please keep in mind that by provision of Federal authorities each transfer has to declare how many passengers pick up. Only the number of people declared in your reservation will be allowed to board. Please make sure the quantity of passengers is correct. under no circumstances will additional passengers be allowed to board. The federal fine is $2,000. USD. For no reason agree to pay for the service again.
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                 <?php endif ?>
                                
                                <td style="width: 5%;"></td>
                            </tr>
                        </tbody>
                    </table>   
                    <table width="640" bgcolor="#ffffff" height="20" cellpadding="0" cellspacing="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>     
                </td>
            </tr>
        </tbody>
    </table>


</body>

<!-- <script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"bam-cell.nr-data.net","licenseKey":"fac5ff6a9a","applicationID":"3719020","transactionName":"bwQBMRRWX0UCVBFYXlZOIgYSXl5YTHUKXlpRDwQmCVlFRAxbCVRDFxERDAhD","queueTime":0,"applicationTime":263,"atts":"Q0MCR1xMTEs=","errorBeacon":"bam-cell.nr-data.net","agent":""}</script> -->

</html>		
<script type="text/javascript">
   window.onload = printpage;

    function printpage() {
      window.print()
    }
</script>