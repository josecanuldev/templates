<style>
  .table-scroll {
    height: 250px;
    overflow: auto;
  }
  .table-scroll th {
    text-align: center;
  }
</style>

<div class="table-responsive table-scroll mt-2">
  <table class="table table-bordered table-condensed table-rutas">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Origen</th>
        <th scope="col">Destino</th>
        <th scope="col">Acción</th>
        <!-- <th scope="col">Menor paga</th> -->
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rutas as $key => $row): ?>
        <tr>
          <th scope="row"><?=$row->id_ruta?></th>
          <td><?=$row->Origen->name?></td>
          <td><?=$row->Destino->name?></td>
          <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm" onclick="eliminarRuta(<?=$row->id_ruta?>)">
              <i class="fa fa-times"></i>
            </button>
          </td>
          <!-- <td><?=$row->menor_paga == 1 ? 'Sí' : 'No'?></td> -->
        </tr>
      <?php endforeach ?>
      <?php if (count($rutas) === 0) { ?>
        <tr>
          <td colspan="4" class="text-center">Sin rutas registrados</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script>
  function eliminarRuta(id) {
    if (!confirm("¿Desea eliminar la ruta con el Id: " + id + "?")) return
    $.ajax({
      url: '<?=$baseUrl?>/rutas/eliminarRuta?id=' + id,
      type: 'POST'
    })
    .done(function(response) {
      var result = JSON.parse(response)
      if (result.response == 0) {
        toastr.error("¡Error!. Ocurrió un error en el servidor, intente más tarde.")
      }
      if (result.response == 1) {
        toastr.success("¡Exito!. La ruta se ha eliminado con exito.")
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
      loadRutas()
    });
  }
</script>