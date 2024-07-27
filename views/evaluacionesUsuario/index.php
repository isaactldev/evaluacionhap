<?php if (isset($_SESSION['existAlertEva360']) && $_SESSION['existAlertEva360'] == 'existAlertEva360') {
?>
  <script>
    Swal.fire({
      icon: 'success',
      confirmButtonColor: '#213c6d',
      title: 'TIENES EVALUACIONES 360° PENDIENTES!',
      text: 'Termina las Evaluaciones 360°!',
    })
  </script>
<?php
}
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

Utils::deleteSession('existAlertEva360');
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
          <h1>PERSONAL A EVALUAR DEL DEPARTAMENTO <?= $dep->depnombre ?></h1>
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
              <h3 class="card-title">Evaluaciones del Personal a cargo</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="crud" class="table table-hover text-center" style="width:100%">
                <thead>
                  <tr>
                    <th>N° Empleado</th>
                    <th>Nombre Completo</th>
                    <th>Puesto</th>
                    <th>Evaluado</th>
                    <th>Calificación Periodo 1</th>
                    <th>Calificación Periodo 2</th>
                    <th>Promedio</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($personaAcargo = $personalAcargo->fetch_object()) : ?>
                    <tr>
                      <td><?= $personaAcargo->noempleado ?></td>
                      <td><?= $personaAcargo->appaterno . ' ' . $personaAcargo->apmaterno . ' ' . $personaAcargo->nombreuser ?></td>
                      <td>
                        <?php $puesto = Utils::userPuesto($personaAcargo->idpuesto); ?>
                        <?= $puesto->nombrepuesto ?>
                      </td>

                      <td>
                        <?php if ($personaAcargo->statusevaluado == 1) : ?>
                          <span class="badge bg-green">Evaluado</span>
                        <?php elseif ($personaAcargo->statusevaluado == 2) : ?>
                          <span class="badge bg-yellow">Pendiente</span>
                        <?php endif; ?>
                      </td>


                      <?php
                      $fechaAct = date('Y');
                      $califPeriodo1 =  Utils::getCalifPorPeriodo($personaAcargo->idusuario, $periodo1, $fechaAct);
                      //$califtblp1 =  Utils::getcalificacionCapacitacionbyUserPeriodo($personaAcargo->noempleado, $periodo1, $fechaAct, $califPeriodo1->calificacionperiodo);


                      if (is_null($califPeriodo1->calificacionperiodo) || $califPeriodo1->calificacionperiodo == 0) {
                        $calif_Periodo1 = '<a href="' . baseUrl . '?controller=evausuario&action=iniciaEvaluaciones&iduser=' . $personaAcargo->idusuario . '"><span class="badge bg-yellow text-dark">SIN EVALUAR</span></a>';
                      } else {
                        $calif_Periodo1 = '<a href="' . baseUrl . '?controller=evausuario&action=verEvaluacionByUserEvaluado&iduser=' . $personaAcargo->idusuario . '&idperiodo=1&fecha=' . $fechaAct . '"><span class="badge bg-light text-dark">' . $califPeriodo1->calificacionperiodo . '</span></a>';
                      }

                      ?>
                      <td>
                        <?= $calif_Periodo1 ?>
                      </td>

                      <?php
                      $fechaAct = date('Y');
                      $califPeriodo2 =  Utils::getCalifPorPeriodo($personaAcargo->idusuario, $periodo2, $fechaAct);
                      //$califtblp2 =  Utils::getcalificacionCapacitacionbyUserPeriodo($personaAcargo->noempleado, $periodo2, $fechaAct, $califPeriodo1->calificacionperiodo);
                      if (is_null($califPeriodo2->calificacionperiodo) || $califPeriodo2->calificacionperiodo == 0) {
                        $calif_Periodo2 = '<a href="' . baseUrl . '?controller=evausuario&action=iniciaEvaluaciones&iduser=' . $personaAcargo->idusuario . '"><span class="badge bg-yellow text-dark">SIN EVALUAR</span></td></a>';
                      } else {
                        $calif_Periodo2 = '<a href="' . baseUrl . '?controller=evausuario&action=verEvaluacionByUserEvaluado&iduser=' . $personaAcargo->idusuario . '&idperiodo=2&fecha=' . $fechaAct . '"><span class="badge bg-light text-dark">' . $califPeriodo2->calificacionperiodo . '</span></a>';
                      }
                      ?>
                      <td>
                        <?= $calif_Periodo2 ?>
                      </td>
                      <td><!-- PROMEDIO DEL AÑO EN CURSO-->
                        <?php

                        if (!isset($califPeriodo1) && isset($califPeriodo2)) {
                          $promedio  = $califPeriodo2->calificacionperiodo;
                          $promedio = bcdiv($promedio, '1', 2);
                          //$promedio = Utils::getcalificacionCapacitacionbyUserPeriodo($personaAcargo->noempleado, $periodo2, $fechaAct, $promedio);
                          //echo "ENTRA 1";
                        }

                        if (isset($califPeriodo1) && !isset($califPeriodo2)) {
                          $promedio  = $califPeriodo1->calificacionperiodo;
                          $promedio = bcdiv($promedio, '1', 2);
                          //$promedio = Utils::getcalificacionCapacitacionbyUserPeriodo($personaAcargo->noempleado, $periodo1, $fechaAct, $promedio);
                          //echo "ENTRA 2";
                        }

                        if (!isset($califPeriodo1) && !isset($califPeriodo2)) {
                          $promedio  = 0;
                          //echo "ENTRA 7";
                        }

                        if (isset($califPeriodo1) && isset($califPeriodo2)) {

                          if ($califPeriodo1->calificacionperiodo == 0 && $califPeriodo2->calificacionperiodo != 0) {
                            $promedio  = $califPeriodo2->calificacionperiodo;
                            $promedio = bcdiv($promedio, '1', 2);
                            //$promedio = Utils::getcalificacionCapacitacionbyUserPeriodo($personaAcargo->noempleado, $periodo1, $fechaAct, $promedio);
                            //echo "ENTRA 3";
                          } else {
                            $promedio  = ($califPeriodo1->calificacionperiodo + $califPeriodo2->calificacionperiodo) / 2;
                            $promedio = bcdiv($promedio, '1', 2);
                            //$promedio = Utils::getcalificacionCapacitacionbyUserPeriodo($personaAcargo->noempleado, $periodo1, $fechaAct, $promedio);
                            //echo "ENTRA 4";
                          }

                          if ($califPeriodo2->calificacionperiodo != 0 && $califPeriodo1->calificacionperiodo == 0) {
                            $promedio  = $califPeriodo2->calificacionperiodo;
                            $promedio = bcdiv($promedio, '1', 2);
                            //$promedio = Utils::getcalificacionCapacitacionbyUserPeriodo($personaAcargo->noempleado, $periodo2, $fechaAct, $promedio);
                            //echo "ENTRA 5";
                          } else {
                            $promedio  = ($califPeriodo1->calificacionperiodo + $califPeriodo2->calificacionperiodo) / 2;
                            $promedio = bcdiv($promedio, '1', 2);
                            //$promedio = Utils::getcalificacionCapacitacionbyUserPeriodo($personaAcargo->noempleado, $periodo2, $fechaAct, $promedio);
                            //echo "ENTRA 6";
                          }
                        }
                        //FUNCION PARA MOSTRAR VALORES SIN REDONDEO PHP
                        $promf = bcdiv($promedio, '1', 2);
                        ?>
                        <span class="badge bg-light text-dark"><?= $promf ?> </span>
                      </td>
                      <td>
                        <center>
                          <?php if ($personaAcargo->statusevaluado == 1 && !empty($personaAcargo->calificacion)) : ?>
                            <a id="editmodal" class="btn btn-outline-secondary" data-toggle="tooltip" title="Ver Reporte" href="<?= baseUrl ?>?controller=evaluacion&action=getReporteEvaluacionByUser&user=<?= $personaAcargo->idusuario ?>"><svg xmlns="http://www.w3.org/2000/svg" width="15px" viewBox="0 0 384 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                                <path d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm76.45 211.36l-96.42 95.7c-6.65 6.61-17.39 6.61-24.04 0l-96.42-95.7C73.42 337.29 80.54 320 94.82 320H160v-80c0-8.84 7.16-16 16-16h32c8.84 0 16 7.16 16 16v80h65.18c14.28 0 21.4 17.29 11.27 27.36zM377 105L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9z" />
                              </svg></a>
                          <?php elseif ($personaAcargo->statusevaluado == 2) : ?>
                            <a class="btn btn-outline-secondary" href="<?= baseUrl ?>?controller=evausuario&action=iniciaEvaluaciones&iduser=<?= $personaAcargo->idusuario ?>" title="Evaluar"><svg xmlns="http://www.w3.org/2000/svg" width="18px" viewBox="0 0 512 512">
                                <path d="M152.1 38.16C161.9 47.03 162.7 62.2 153.8 72.06L81.84 152.1C77.43 156.9 71.21 159.8 64.63 159.1C58.05 160.2 51.69 157.6 47.03 152.1L7.029 112.1C-2.343 103.6-2.343 88.4 7.029 79.03C16.4 69.66 31.6 69.66 40.97 79.03L63.08 101.1L118.2 39.94C127 30.09 142.2 29.29 152.1 38.16V38.16zM152.1 198.2C161.9 207 162.7 222.2 153.8 232.1L81.84 312.1C77.43 316.9 71.21 319.8 64.63 319.1C58.05 320.2 51.69 317.6 47.03 312.1L7.029 272.1C-2.343 263.6-2.343 248.4 7.029 239C16.4 229.7 31.6 229.7 40.97 239L63.08 261.1L118.2 199.9C127 190.1 142.2 189.3 152.1 198.2V198.2zM224 96C224 78.33 238.3 64 256 64H480C497.7 64 512 78.33 512 96C512 113.7 497.7 128 480 128H256C238.3 128 224 113.7 224 96V96zM224 256C224 238.3 238.3 224 256 224H480C497.7 224 512 238.3 512 256C512 273.7 497.7 288 480 288H256C238.3 288 224 273.7 224 256zM160 416C160 398.3 174.3 384 192 384H480C497.7 384 512 398.3 512 416C512 433.7 497.7 448 480 448H192C174.3 448 160 433.7 160 416zM0 416C0 389.5 21.49 368 48 368C74.51 368 96 389.5 96 416C96 442.5 74.51 464 48 464C21.49 464 0 442.5 0 416z" />
                              </svg></a>
                          <?php endif; ?>
                        </center>
                      </td>

                    </tr>
                  <?php endwhile; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>N° Empleado</th>
                    <th>Nombre Completo</th>
                    <th>Puesto</th>
                    <th>Evaluado</th>
                    <th>Calificación Periodo 1</th>
                    <th>Calificación Periodo 2</th>
                    <th>Promedio</th>
                    <th>Opciones</th>
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
</div>
<!-- /.content-wrapper -->

<script>
  $('.editbtn').on('click', function() {

    $tr = $(this).closest('tr');
    var datos = $tr.children('td').map(function() {
      return $(this).text();
    });
    $('#editid').val(datos[0]);
    $('#nameid').val(datos[1]);
    $('#idestatus').val(datos[2]);
  });
</script>