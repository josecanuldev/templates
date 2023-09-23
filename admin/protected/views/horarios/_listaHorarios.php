<?php 
  $tHeads = ["Horario", "Tipo", "Estatus", "Acción"];
  // echo '<textarea>'.CJSON::encode($horarios).'</textarea>';
?>
<style>
  .table-scroll {
    height: 250px;
    overflow: auto;
  }
  .table-scroll th {
    text-align: center;
  }
</style>
<div class="table-responsive mt-1">
  <ul class="nav nav-tabs" id="tabsListaHorarios" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="llegada-tab" data-toggle="tab" data-target="#tipollegada" type="button" role="tab" aria-controls="llegada" aria-selected="true">Llegadas</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="salida-tab" data-toggle="tab" data-target="#tiposalida" type="button" role="tab" aria-controls="salida" aria-selected="false">Salidas</button>
    </li>
  </ul>
  <div class="tab-content mt-4" id="tabsListaContent">
    <div class="tab-pane fade show active" id="tipollegada" role="tabpanel" aria-labelledby="llegada-tab">
      <div class="table-scroll">
        <table class="table">
          <thead>
              <tr>
              <?php foreach ($tHeads as $k => $head): ?>
                  <th scope="col"><?=$head?></th>
              <?php endforeach ?>
              </tr>
          </thead>
          <tbody style="height: 200px; overflow-y: auto; width: 100%;">
            <?php
              $contLlegada = 0;
              foreach ($horarios as $key => $row): ?>
                <?php if ($row->tipo == 0): 
                  $contLlegada++;
                ?>
                  <tr>
                    <th scope="row"><?=$row->horario?></th>
                    <td><?=$row->tipo == 1 ? 'Salida' : 'Llegada'?></td>
                    <td><?=$row->estatus == 1 ? 'Áctivo' : 'Ináctivo'?></td>
                    <td class="text-center">
                      <button type="button" class="btn btn-danger btn-sm" onclick="eliminarHorario(<?=$row->id?>,<?=$row->tipo?>,'<?=$row->horario?>')">
                        <i class="fa fa-times"></i>
                      </button>
                    </td>
                  </tr>
                <?php endif ?>
            <?php endforeach ?>
            <?php if ($contLlegada == 0) { ?>
              <tr>
                <td colspan="4" class="text-center">Sin horarios definidos</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane fade" id="tiposalida" role="tabpanel" aria-labelledby="salida-tab">
      <div class="table-scroll">
        <table class="table">
          <thead>
            <tr>
              <?php foreach ($tHeads as $k => $head): ?>
                  <th scope="col"><?=$head?></th>
              <?php endforeach ?>
            </tr>
          </thead>
          <tbody style="height: 200px; overflow-y: auto; width: 100%;">
            <?php
              $contSalida = 0;
              foreach ($horarios as $key => $row): ?>
                <?php if ($row->tipo == 1): 
                  $contSalida++;
                ?>
                  <tr>
                    <th scope="row"><?=$row->horario?></th>
                    <td><?=$row->tipo == 1 ? 'Salida' : 'Llegada'?></td>
                    <td><?=$row->estatus == 1 ? 'Áctivo' : 'Ináctivo'?></td>
                    <td class="text-center">
                      <button type="button" class="btn btn-danger btn-sm" onclick="eliminarHorario(<?=$row->id?>,<?=$row->tipo?>,'<?=$row->horario?>')">
                        <i class="fa fa-times"></i>
                      </button>
                    </td>
                  </tr>
                <?php endif ?>
            <?php endforeach ?>
            <?php if ($contSalida == 0) { ?>
              <tr>
                <td colspan="4" class="text-center">Sin horarios definidos</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  function eliminarHorario(id, tipo, hora) {
    if (!confirm("¿Desea eliminar el horario de " + hora + " de " + (tipo == 0 ? 'llegada' : 'salida') + "?")) return
    $.ajax({
      url: '<?=$baseUrl?>/horarios/eliminarHorario?id=' + id,
      type: 'POST'
    })
    .done(function(response) {
      var result = JSON.parse(response)
      if (result.response == 0) {
        toastr.error("¡Error!. Ocurrió un error en el servidor, intente más tarde.")
      }
      if (result.response == 1) {
        toastr.success("¡Exito!. El horario se ha eliminado con éxito.")
        // $("#success_ruta").removeClass('d-none')
      }
      console.log("success", result);
    })
    .fail(function(error) {
      toastr.error("¡Error!. Ocurrió un error en el servidor, intente más tarde.")
      // $("#error_ruta").removeClass('d-none')
      console.log("error", error);
    })
    .always(function() {
      console.log("complete");
      loadHorarios()
    });
  }
</script>