<?php
if (isset($_SESSION['evaluacion']) && $_SESSION['evaluacion'] == 'evaluacionSave') {
?>
  <script>
    Swal.fire({
      icon: 'success',
      confirmButtonColor: '#213c6d',
      title: 'Evaluacion Guardada!',
      text: 'La evaluacion se ha guardado CORRECTAMENTE!',
    })
  </script>
<?php
}
if (isset($_SESSION['evaluacion']) && $_SESSION['evaluacion'] == 'evaluacionError') {
?>
  <script>
    Swal.fire({
      icon: 'error',
      confirmButtonColor: '#213c6d',
      title: 'Registro Fallido!',
      text: 'NO SE A GUARDADO LA EVALUACION CORRECTAMENTE!',
    })
  </script>
<?php
}
if (isset($_SESSION['actualizaPeriodo']) && $_SESSION['actualizaPeriodo'] == 'actualizaPeriodo') {
?>
  <script>
    Swal.fire({
      icon: 'success',
      confirmButtonColor: '#213c6d',
      title: 'SE HA ACTUALIZADO EL PERIODO A EVULUAR!',
      text: 'AHORA LAS EVALUACIONES QUE REALICES SE REGISTRARAN CON EL PERIODO ACTIVADO',
    })
  </script>
<?php
}

Utils::deleteSession('evaluacion');
Utils::deleteSession('actualizaPeriodo');

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <!-- container fluit-->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>RESULTADOS DE EVALUACIONES 360 <?= $usuario->nombreuser . ' ' . $usuario->appaterno ?></h1>
          <input id="idevaluado360" type="hidden" name="idevaluado360" value="<?= $usuario->idusuario ?>">
          <input id="idperiodoActivo" type="hidden" name="idperiodoActivo" value="<?= $periodoActivo->idperiodo ?>">
          <input id="fecha" type="hidden" name="fecha" value="<?= $fecha ?>">

        </div>
      </div>
    </div>
    <!-- /.container -->
  </section>
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 mb-3">
          <!-- Default box -->
          <div class="card card-primary">
            <div class="card-header ">
              <h3 class="card-title">Evaluacione de Evaluadores de <?= $usuario->nombreuser . ' ' . $usuario->appaterno ?></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <?php if ($statusCaptura360 == false) : ?>
                <div class="d-grid gap-2 d-md-flex mb-2 justify-content-md-end">
                  <button class="btn btn-primary me-md-2 fs-5" type="button" onclick="CapturarCalif360();"> <i class="fas fa-save fa-xl"> </i> GUARDAR CALIFICACION</button>
                </div>
              <?php endif; ?>

              <table id="crud" class="table table-hover text-center" style="width:100%">
                <thead>
                  <tr>
                    <th>N° Empleado</th>
                    <th>Evaluador</th>
                    <th>Puesto</th>
                    <th>Evaluado</th>
                    <th>Calificación del Periodo 2</th>
                    <th>Relacion</th>

                  </tr>
                </thead>
                <tbody>
                  <?php while ($personalAEvaluador = $allpersonalAEvaluador->fetch_object()) : ?>
                    <tr>
                      <td><?= $personalAEvaluador->idevaluador ?></td>
                      <td>
                        <?php $usuarioinfoEvaluador = Utils::UserByNoEmpleado($personalAEvaluador->idevaluador); ?>
                        <?= $usuarioinfoEvaluador->appaterno . ' ' . $usuarioinfoEvaluador->apmaterno . ' ' . $usuarioinfoEvaluador->nombreuser ?>
                      </td>

                      <td>
                        <?php $puesto = Utils::userPuesto($usuarioinfoEvaluador->idpuesto); ?>
                        <?= $puesto->nombrepuesto ?>
                      </td>
                      <td>
                        <?php $usuarioinfoEvaluador = Utils::UserByNoEmpleado($idusuarioEvaluador); ?>
                        <?= $usuarioinfoEvaluador->appaterno . ' ' . $usuarioinfoEvaluador->apmaterno . ' ' . $usuarioinfoEvaluador->nombreuser ?>
                      </td>


                      <td>
                        <?php if ($personalAEvaluador->statuseva360 == 2) : ?>
                          <a href="<?= baseUrl ?>?controller=evaluacionpersonal360&action=iniciaEvaluacionA360&noEvaluador=<?= $personalAEvaluador->idevaluador ?>&noEvaluado=<?= $usuario->noempleado ?>"><span class="badge bg-warning text-dark"><i class="fas fa-file-edit"></i> Pendiente de evaluar</span></a>
                        <?php else : ?>

                          <a href="#"><span class="badge bg-light text-dark"><?= $personalAEvaluador->promFinalCalif360 ?></span></a>
                        <?php endif; ?>
                      </td>


                      <td>
                        <?= $personalAEvaluador->tipoevaluador ?>
                      </td>

                      <td>
                        <?php if ($personalAEvaluador->statuseva360 == 2) : ?>
                          <a href="#" id="editmodal" type="button" class="btn btn-outline-secondary btn-block btn-flat" onclick="pendiente();">
                            <i class="fas fa-street-view fa-xl"></i>
                          </a>
                          <script>
                            function pendiente() {
                              Swal.fire({
                                icon: 'info',
                                showConfirmButton: false,
                                title: 'Evaluacion Pendiente!',
                                text: 'Para visualizar el Reporte debes evaluar al Colavorador 360°!',
                              })
                            }
                          </script>
                        <?php else : ?>
                          <!--  <a href="<?= baseUrl ?>" id="editmodal" type="button" class="btn btn-outline-secondary btn-block btn-flat">
                                    <i class="fas fa-file-invoice fa-xl"></i>
                                </a> -->
                        <?php endif; ?>
                      </td>

                    </tr>
                  <?php endwhile; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>N° Empleado</th>
                    <th>Evaluador</th>
                    <th>Puesto</th>
                    <th>Evaluado</th>
                    <th>Calificación del Periodo 2</th>
                    <th>Relacion</th>

                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <?php echo $date = date("Y-m-d"); ?>
            </div>
            <!-- /.card-footer-->
          </div>
        </div>
        <!-- /.card -->


      </div>
    </div>


  </section>



  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 mb-3">
          <!-- Default box -->
          <div class="card card-primary text-center">

            <div class="card-header fs-5">
              RESULTADOS GENERALES DE LAS EVALUACIONES A <?= $usuario->nombreuser . ' ' . $usuario->appaterno ?>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>


            <div class="card-body table-responsive">
              <table class="table table-bordered table-hover table-striped" style="width:100%">
                <thead>
                  <tr>

                    <th class="fs-6 align-middle">Nombre</th>
                    <th class="fs-6 align-middle">Tipo de Relacion</th>
                    <?php while ($pregunta = $allPreguntas->fetch_object()) : ?>

                      <th class="fs-6 align-middle"><?= $pregunta->pregunta360 ?></th>

                    <?php endwhile; ?>
                    <th class="fs-6 align-middle">Promedio Final</th>
                  </tr>
                </thead>
                <tbody class="fs-6 align-middle">



                  <?php while ($personalAEvaluadorRes = $allpersonalAEvaluadorRes->fetch_object()) : ?>


                    <tr>

                      <td class="align-middle">
                        <?php $usuarioinfoEvaluadorRes = Utils::UserByNoEmpleado($personalAEvaluadorRes->idevaluador); ?>
                        <?= $usuarioinfoEvaluadorRes->appaterno . ' ' . $usuarioinfoEvaluadorRes->apmaterno . ' ' . $usuarioinfoEvaluadorRes->nombreuser ?>
                      </td>

                      <td class="align-middle">
                        <?= $personalAEvaluadorRes->tipoevaluador ?>
                      </td>

                      <?php $califxEvaluador360 = 0; ?>
                      <?php for ($i = 1; $i <= 27; $i++) : ?>
                        <td class="align-middle bg-primary p-2 text-dark bg-opacity-25">
                          <?php $respuesta = Utils::getAllRespuestasByNoEvaluadorxPregunta($i, $personalAEvaluadorRes->idevaluador, $personalAEvaluadorRes->idevaluado, $periodoActivo->idperiodo, $fecha);
                          $califxEvaluador360 = ($califxEvaluador360 + $respuesta->ponderacion);
                          ?>
                          <?= $respuesta->ponderacion ?>
                        </td>
                      <?php endfor; ?>



                      <td>
                        <?php
                        $califxEvaluador360Oficcial = ($califxEvaluador360 / 27);
                        $califxEvaluador360OficcialFinal = round($califxEvaluador360Oficcial, 2);
                        ?>
                        <strong><?= $califxEvaluador360OficcialFinal ?></strong>
                      </td>

                    </tr>

                  <?php endwhile; ?>

                  <tr>
                    <td colspan="2" class="align-middle bg-primary p-2 text-dark bg-opacity-25"><strong>TOTAL :</strong> </td>
                    <?php $califFinalPromedio = 0; ?>
                    <?php for ($i = 1; $i <= 27; $i++) : ?>
                      <td class="align-middle bg-warning p-2 text-dark bg-opacity-25">
                        <?php
                        $promediosxPregunta = Utils::getPromedioxPreguntaxEvaluador($usuario->noempleado, $i, $periodoActivo->idperiodo, $fecha);

                        if ($promediosxPregunta->sumPuntos == 0 || $promediosxPregunta->countPuntos == 0) {
                          $promedioPorPregunta = "AUN SIN EVALUACIONES COMPLETAS!";
                        } else {
                          $promedioPorPregunta = ($promediosxPregunta->sumPuntos / $promediosxPregunta->countPuntos);
                          $califFinalPromedio = $califFinalPromedio + $promedioPorPregunta;
                          $promedioPorPregunta = round($promedioPorPregunta, 2);
                        }
                        ?>
                        <strong><?= $promedioPorPregunta ?></strong>
                      </td>
                    <?php endfor; ?>
                    <td class="align-middle bg-success p-2 text-dark bg-opacity-25">
                      <?php
                      $calificacion360Oficial = ($califFinalPromedio / 27);
                      $calificacion360Oficial = round($calificacion360Oficial, 2);
                      ?>
                      <input id="calif360" type="hidden" name="calif360" value="<?= $calificacion360Oficial ?>">
                      <strong><?= $calificacion360Oficial ?></strong>
                    </td>

                  </tr>






                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <?php echo $date = date("Y-m-d"); ?>
            </div>
            <!-- /.card-footer-->
          </div>
        </div>
        <!-- /.card -->


      </div>
    </div>


  </section>
</div>
<!-- /.content-wrapper -->

<script>
  function CapturarCalif360() {

    var url = location.origin;
    var path = window.location.pathname;

    let idusuario = parseInt($('#idevaluado360').val());
    let calificacion360 = parseFloat($('#calif360').val());
    let idperiodoActivo = parseInt($('#idperiodoActivo').val());
    let fecha = parseInt($('#fecha').val());

    let objtUser = {
      idusuario: idusuario,
      calificacion360: calificacion360,
      idperiodoActivo: idperiodoActivo,
      fecha: fecha
    };

    Swal.fire({
      title: 'Deseas Capturar la Calificacion? ' + ' <p><strong> ' + calificacion360 + ' </strong></p> ',
      showDenyButton: true,
      confirmButtonText: `GUARDAR`,
      confirmButtonColor: '#213c6d',
      denyButtonText: `NO GUARDAR`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        console.log(objtUser);
        $.post("config/helpers/guardarCalificacion360.php", {
            objtUseR: objtUser
          },
          function(mensaje) {
            Swal.fire({
              icon: 'success',
              showConfirmButton: false,
              title: 'Calificacion Guardada Correctamente!',
              text: 'Hemos guardado la calificacion Correctamente!',
            })
            setTimeout(function() {
              window.location.href = url + path + "?controller=calif360user&action=index";
            }, 2250);
          });

      } else if (result.isDenied) {
        Swal.fire('NO SE GUARDO LA CALIFICACION!', '', 'info')
      }
    })





  }
</script>