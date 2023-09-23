<?php
$this->breadcrumbs=array(
  'Transfer Holbox',
);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/custom.css');
?>
<style type="text/css">
  table, th, td {
    border: 1.5px solid white;
    border-collapse: collapse;
  }
  table {
    width: 100%;
    text-align: center;
  }
  .menu__1 th, .menu__1 td {
    padding-top: 25px;
    padding-bottom: 25px;
    padding-left: 33px;
    padding-right: 33px;
  }

  .menu__container{
    padding: 0px;
  }

  .icon__font{
    font-size: 25px;
  }

  .img__logo{
    height: 20rem;
  }

  @media (max-width: 768px) { 
    .img__logo{
      height: initial;
    }
  }
</style>
<div id="app" class="font-weight-bold">
  <div class="container pb-5">
    <div class="row">
      <div class="col-md-12 align-items-center"><h1 class="text-light"> <?=Yii::app()->params["appTitle"]?> </h1>
      </div>
      <div class="col-md-12 align-items-center bg-light img__logo">
        <img src="<?=Yii::app()->baseUrl;?>/images/<?=Yii::app()->params["logo"]?>" alt="<?=Yii::app()->params["appTitle"]?>">
      </div>
    </div>
    <div class="row d-none d-sm-block">
      <!-- Menu para pcs o pantallas grandes -->
      <div class="col-md-12 menu__container">
        <vue-scroll :ops="ops">
          <table id="menu_1" class="menu__1" border="1">
            <tr>
              <td><a href="<?=Yii::app()->createUrl('drivers')?>" class="text-light"> Camionetas </a></td>
              <td><a href="<?=Yii::app()->createUrl('agencies')?>" class="text-light"> Agencias </a></td>
              <td><a href="<?=Yii::app()->createUrl('orders/chiquila')?>" class="text-light"> Orden Chiquilá </a></td>
              <td></td>
              <td><a href="#" class="text-light"> Ver taxis salidas </a></td>
              <td><a href="<?=Yii::app()->createUrl('reservatour')?>" class="text-light"> Orden THB </a></td>
              <td><a href="#" class="text-light"> Tickets de Taxis (salidas) </a></td>
              <td><a href="<?=Yii::app()->createUrl('orders/vip',array('type'=>'salidas'))?>" class="text-light"> Orden Vip (Salidas) </a></td>
            </tr>
            <tr>
              <td><a href="<?=Yii::app()->createUrl('reservatour')?>?type=edit" class="text-light"> Editar Reserva </a></td>
              <td><a href="<?=Yii::app()->createUrl('tarifas')?>" class="text-light"> Tarifas </a></td>
              <td><a href="<?=Yii::app()->createUrl('orders/holbox')?>" class="text-light"> Orden Holbox </a></td>
              <td></td>
              <td><a href="#" class="text-light"> Facturación </a></td>
              <td><a href="<?=Yii::app()->createUrl('orders')?>" class="text-light"> Orden de Servicios </a></td>
              <td><a href="<?=Yii::app()->createUrl('orders')?>?type=letreros" class="text-light"> Letrero llegadas </a></td>
              <td><a href="<?=Yii::app()->createUrl('orders/vip',array('type'=>'entradas'))?>" class="text-light"> Orden Vip (Entradas) </a></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <!-- <i class="fas fa-taxi icon__font"></i> -->
              <td data-toggle="tooltip" data-placement="top" title="Operadores"><a href="<?=Yii::app()->createUrl('drivers/agrupados')?>" class="text-light"> Asignación de operadores </a></td>
              <!-- <i class="far fa-address-book icon__font"></i> -->
              <td data-toggle="tooltip" data-placement="top" title="Agencias"><a href="<?=Yii::app()->createUrl('agencies/agrupados')?>" class="text-light"> Servicios por agencias </a></td>
              <!-- <i class="fas fa-hotel"></i> -->
              <td data-toggle="tooltip" data-placement="top" title="Destinos y Sitios"><a href="<?=Yii::app()->createUrl('sitios')?>" class="text-light"> Destinos y Hoteles/Sitios </a></td>
              <td data-toggle="tooltip" data-placement="top" title="Radar de Vuelos"><a href="<?=Yii::app()->createUrl('arrivals/radar')?>" class="text-light"> <i class="fa fa-plane-departure icon__font"></i> </a></td>
              <td><a href="#" class="text-light"> <i class="fas fa-sticky-note icon__font"></i> </a></td>
            </tr>
          </table>
        </vue-scroll>
      </div>
      <div class="col-md-12 text-right">
        <span><a href="<?=Yii::app()->createUrl('user/logout')?>" class="text-warning">Cerrar Sesión</a></span>
      </div>
    </div>
    <!-- Menu para tabletas y mobiles -->
    <div class="d-block d-sm-none">
      <div class="row">
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="<?=Yii::app()->createUrl('drivers')?>" class="text-light">Camionetas</a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="<?=Yii::app()->createUrl('agencies')?>" class="text-light">Agencias</a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="<?=Yii::app()->createUrl('orders/chiquila')?>" class="text-light">Orden Chiquilá</a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="<?=Yii::app()->createUrl('reservatour')?>?type=edit" class="text-light">Editar Reserva</a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="<?=Yii::app()->createUrl('tarifas')?>" class="text-light">Tarifas</a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="<?=Yii::app()->createUrl('orders/holbox')?>" class="text-light">Orden Holbox</a></div>
      </div>
      <div class="row">
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="#" class="text-light">Ver taxis salidas</a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="<?=Yii::app()->createUrl('reservatour')?>" class="text-light">Orden THB</a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="#" class="text-light">Tickets de Taxis (salidas)</a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="<?=Yii::app()->createUrl('orders/vip',array('type'=>'entradas'))?>" class="text-light">Orden Vip (Salidas)</a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="#" class="text-light">Facturación</a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="<?=Yii::app()->createUrl('orders')?>" class="text-light">Orden de Servicios</a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="<?=Yii::app()->createUrl('orders')?>?type=letreros" class="text-light">Letrero llegadas</a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="<?=Yii::app()->createUrl('orders/vip',array('type'=>'salidas'))?>" class="text-light">Orden Vip (Entradas)</a></div>
      </div>
      <div class="row">
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center" data-toggle="tooltip" data-placement="top" title="Operadores"><a href="<?=Yii::app()->createUrl('drivers/agrupados')?>" class="text-light"><i class="fas fa-taxi icon__font"></i></a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center" data-toggle="tooltip" data-placement="top" title="Agencias"><a href="<?=Yii::app()->createUrl('agencies/agrupados')?>" class="text-light"><i class="far fa-address-book icon__font"></i></a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center" data-toggle="tooltip" data-placement="top" title="Destinos y Sitios"><a href="<?=Yii::app()->createUrl('sitios')?>" class="text-light"><i class="fas fa-hotel"></i></a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center" data-toggle="tooltip" data-placement="top" title="Radar de Vuelos"><a href="<?=Yii::app()->createUrl('arrivals/radar')?>" class="text-light"><i class="fa fa-plane-departure icon__font"></i></a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="#" class="text-light"><i class="fas fa-sticky-note icon__font"></i></a></div>
        <div class="col-6 col-sm-6 col-xs-6 border border-light p-4 text-center"><a href="<?=Yii::app()->createUrl('user/logout')?>" class="text-warning">Cerrar Sesión</a></div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuescroll@4.14.4/dist/vuescroll.min.js"></script>
<?php Yii::app()->clientScript->registerScript('init', "
  $(function () {
    $('[data-toggle=\"tooltip\"]').tooltip()
  })
  const vuescroll = window.vuescroll;
  Vue.use(vuescroll);
  let app = new Vue({
  el: '#app',
  data: {
    ops: {
        rail: {
          opacity: '0.2',
          size: '15px'
        },
        bar: {
          background: '#666666',
          keepShow: true,
          size: '10px',
          minSize: 0.2
        },
        scrollPanel: {
          easing: 'easeInQuad',
          speed: 800
        },
        vuescroll: {
          wheelScrollDuration: 0,
          wheelDirectionReverse: false
        }
      }
    }
  });
", CClientScript::POS_END); ?>
<script></script>