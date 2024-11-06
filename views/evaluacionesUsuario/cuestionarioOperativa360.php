<?php
$k = 0;
$j = 0;
$countt = 0;
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <!-- container fluit-->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col text-center">
        </div>
        <div class="col-6 col-sm-6 text-center">
          <h1>EVALUACIÓN DEL DESEMPEÑO 360 <?php echo $date = date("Y"); ?> - PERSONAL OPERATIVO-360°</h1>
        </div>
        <div class="col col-sm-6 col-lg-3 text-center">
          <?php if ($_SESSION['identity']->rol == 'user') : ?>
            <a href="<?= baseUrl ?>?controller=evausuario&action=index" class="btn btn-primary btn-lg mt-3" role="button"><i class="fa-solid fa-arrow-left"></i> VOLVER </a>
          <?php else : ?>
            <a href="<?= baseUrl ?>?controller=evaluacion&action=allUsuarioStatusEvaluacion" class="btn btn-primary btn-lg mt-3" role="button"><i class="fa-solid fa-arrow-left"></i> VOLVER </a>
          <?php endif; ?>
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
              <h3 class="card-title">Cuestionario de Evaluación</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-4">
                    <div class="col-12 mb-3">
                      <label for="formGroupExampleInput" class="form-label">No° Empleado</label>
                      <input type="hidden" class="form-control" id="idEmpleado" name="idEmpleado" value="<?= $usuario->idusuario ?>">
                      <input type="hidden" class="form-control" id="idjerarquia" name="idjerarquia" value="<?= $usuario->idjerarquia ?>">
                      <input type="hidden" class="form-control" id="tipoevaluacion" name="tipoevaluacion" value="<?= $usuario->tipoevaluacion ?>">
                      <input type="hidden" class="form-control" id="autoevalua" name="autoevalua" value="<?= $usuario->autoevalua ?>">
                      <input type="hidden" class="form-control" id="evalua360" name="evalua360" value="<?= $usuario->evalua360 ?>">
                      <input type="text" class="form-control" id="noEmpleado" name="noEmpleado" value="<?= $usuario->noempleado ?>">
                    </div>
                    <div class="col-12 mb-3">
                      <label for="formGroupExampleInput" class="form-label">Personal Evaluad@</label>
                      <input type="text" class="form-control" id="formGroupExampleInput" name="user" value="<?= $usuario->nombreuser . ' ' . $usuario->appaterno . ' ' . $usuario->apmaterno ?>">
                    </div>
                    <div class="col-12 mb-3">
                      <label for="formGroupExampleInput" class="form-label">Calificacion 360°</label>
                      <?php $calif = ($calif360user->calificacion != 0) ? $calif360user->calificacion  : $calif360user->calificacion; ?>
                      <input type="number" class="form-control" id="calif360user" name="calif360user" value="<?= $calif ?>" disabled>
                      <?php if ($calif360user->calificacion == 0) : ?>
                        <p><small><strong>Tu calificación sera capturada por desarrollo de Personal</strong></small></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="col-12 mb-3">
                      <label for="formGroupExampleInput" class="form-label">Puesto</label>
                      <?php $puesto = Utils::userPuesto($usuario->idpuesto); ?>
                      <input type="text" class="form-control" id="formGroupExampleInput" name="puesto" value="<?= $puesto->nombrepuesto ?>">
                    </div>
                    <div class="col-12 mb-3">
                      <label for="formGroupExampleInput" class="form-label">Departamento</label>
                      <?php $puesto = Utils::userDepartamento($usuario->iddepartamento); ?>
                      <input type="text" class="form-control" id="formGroupExampleInput" name="dep" value="<?= $puesto->depnombre ?>">
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="col-12 mb-3">
                      <label for="formGroupExampleInput" class="form-label">Fecha</label>
                      <input type="text" class="form-control" id="formGroupExampleInput" name="date" value="<?= $date = date("Y-m-d"); ?>">
                    </div>
                    <div class="col-12 mb-3">
                      <?php $periodo = Utils::getPeriodoActivo(); ?>
                      <label for="formGroupExampleInput" class="form-label">Periodo a Evaluar</label>
                      <input type="text" class="form-control" id="idperiodo" name="periodo" value="<?= $periodo->idperiodo; ?>">
                    </div>
                    <div class="col-12 mb-3">
                      <label for="calificaconCapF" class="form-label">Plataforma de Capacitacion Calif.</label>
                      <?php $calificaconCapF = ($califCap == "400") ? "SIN CALIFICACION EXISTENTE!" : $califCap ?>
                      <input type="text" class="form-control text-center" id="calificaconCapF" name="calificaconCapF" value="<?= $calificaconCapF ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-grid gap-2 d-md-flex mb-2 justify-content-md-end">
                <table id="examen" class="table table-hover text-center mb-6" style="width:50%">
                  <thead class="table-primary">
                    <tr>
                      <th scope="col">Criterios de Evaluación</th>
                      <?php
                      $ponderaciones = Utils::getPonderaciones();
                      while ($ponderacion = $ponderaciones->fetch_object()) : ?>
                        <th><?= $ponderacion->descripcion ?></th>
                      <?php endwhile; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>Puntos</th>
                      <?php
                      $ponderaciones = Utils::getPonderaciones();
                      while ($ponderacion = $ponderaciones->fetch_object()) : ?>
                        <td><?= $ponderacion->puntos ?></td>
                      <?php endwhile; ?>
                    </tr>
                  </tbody>
                </table>
              </div>

              <center>
                <div class="col-md-12 fs-2 mt-5 mb-5">
                  <blockquote style="border-left: 5px solid #0080c0; margin-top: -15px;" class="heartbeat-button">
                    <h1 style="color: #000;"><strong>Instrucciones: </strong> ¡Recuerda tienes un tiempo limite aproximado de 20min para contestar la Evaluacion!</h1>
                  </blockquote>
                </div>
              </center>

              <h1 class="text-center mb-3"> EVALUACIÓN 360°</h1>
              <hr>
              <div class="row text-center">
                <h3>COMPETENCIAS TECNICAS </h3>
                <table id="examen" class="table table-hover text-center mb-6" style="width:100%">
                  <?php $bloquesCompetencias = Utils::showBloqueCompetencia(); ?>

                  <thead class="table-primary">
                    <tr>
                      <!-- NOMBRE DEL BLOQUE DE LA COMPETENCI A EVALUAR -->
                      <th colspan="5" class="text-left">
                        <h5>Competencias Tecnicas</h5>
                      </th>
                    </tr>
                  </thead>
                  <thead>
                    <tr>
                      <th scope="col">Pregunta</th>
                      <?php $ponderaciones = Utils::getAllPonderaciones(); ?>
                      <?php while ($poderacion = $ponderaciones->fetch_object()) : ?>
                        <th>R<?= $poderacion->idponderacion ?></th>
                      <?php endwhile; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- BLOQUE DE PREGUNTAS DEL CUESTIONARIO -->
                    <?php $competenciaTecnicas = Utils::showPreguntasCompetenciasTecnicas($usuario->idpuesto); ?>
                    <?php while ($competenciaTec = $competenciaTecnicas->fetch_object()) : ?>
                      <tr>
                        <?php $countt++; ?><!-- contador de preguntas -->
                        <!-- PREGUNTA -->
                        <td>
                          <input type="hidden" id="idptec<?= $j ?>" value="<?= $competenciaTec->idcopentenciatecnica ?>">
                          <input type="hidden" id="competenciatec360<?= $j ?>" value="<?= $competenciaTec->competencia ?>">
                          <p><?= $competenciaTec->competencia ?></p>
                        </td>
                        <!-- /PREGUNTA -->
                        <?php
                        $ponderaciones = Utils::getAllPonderaciones();
                        $countPonderacion = Utils::countPonderacines();
                        $count = $countPonderacion->idponderacion;
                        $i = 0;
                        ?>

                        <!-- VALIDAMOS LA RESPUESTA -->
                        <?php while ($poderacion = $ponderaciones->fetch_object()) : ?>
                          <td id="<?= $competenciaTec->idcopentenciatecnica ?>">
                            <input class="form-check-input fs-4" type="radio" name="preguntaTec<?= $competenciaTec->idcopentenciatecnica ?>" id="<?= $i ?>" value="<?= $poderacion->puntos; ?>"><!-- RADIO BUUTON DE LA PONDERACION  -->
                            <?php $i++; ?>
                          </td>
                        <?php endwhile; ?>
                        <?php $j++; ?>
                        <!-- VALIDAMOS LA RESPUESTA -->
                      </tr>
                    <?php endwhile; ?>
                    <!-- END BLOQUE DE PREGUNTAS DEL CUESTIONARIO -->
                  </tbody>
                  <h4>TOTAL DE PREGUNTAS: <?= $j ?></h4>
                  <input type="hidden" id="totalPreguntasTec" value="<?= $j ?>">
                </table>
              </div>
              <hr>

              <form action="<?= baseUrl ?>?controller=evausuario&action=activarPeriodo" method="post">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-center mt-3">COMPROMISOS</h4>
                    <div class="col-12 mb-3">
                      <label for="exampleFormControlTextarea1" class="form-label">Escribe un compromiso para mejorar</label>
                      <textarea class="form-control" id="compromisos" rows="2"></textarea>
                    </div>
                  </div>
                  <div class="col-6">
                    <h4 class="text-center mt-3">REQUIERE CAPACITACION</h4>
                    <div class="col-12 mb-3">
                      <label for="exampleFormControlTextarea1" class="form-label">Menciona si requieres de una capacitacion para mejorar</label>
                      <textarea class="form-control" id="capacitacion" rows="2"></textarea>
                    </div>
                  </div>
                </div>
              </form>
              <hr>

              <div class="row">
                <div class="col-6 mt-3 mb-2 justify-content-md-end">
                </div>
                <div class="col-6 mt-3 mb-2 text-md-right justify-content-md-end">
                  <label for="formGroupExampleInput">Competencias Tecnicas: </label><input id="califTecR" type="number" class="ml-2 col-1 text-center" value="" disabled><br>
                  <label for="formGroupExampleInput">Plataforma de Capacitacion: </label><input id="califCapacit" type="number" class="ml-2 col-1 text-center" value="" disabled><br>
                  <hr>
                  <label for="formGroupExampleInput">Total: </label><input type="text" class=" ml-2 col-1 text-center" id="totalPuntos2" name="puntaje" value="" disabled><br>
                </div>
                <div class="d-grid gap-2 d-md-flex mt-3 mb-2 justify-content-md-end">
                  <button class="btn btn-primary me-md-2" type="button" onclick="countPuntos();"><i class="fas fa-spell-check"></i> Ver Calificacion </button>
                  <button id="readysaveEvaluacion360" class="btn btn-primary me-md-2" type="button" onclick="guardarRespuestas();" disabled><i class="fa fa-fw fa-plus-square"></i> Guardar Evaluacion </button>
                </div>
                <div id="alertCapacitaciones" class="d-grid gap-2 d-md-flex mt-3 mb-2 justify-content-md-end" style="display: none !important;">
                  <div class="col-4">
                    <blockquote style="border-left: 5px solid #0080c0; margin-top: 5px;" class="heartbeat-button">
                      <h1 style="color: #000;"><strong>#NOTA: </strong> ¡Recuerda que esta es una calificacion preliminar, falta por considerar el rubro de CAPACITACIONES!</h1>
                    </blockquote>
                  </div>
                </div>
              </div>
              <!-- <div id="respuesta"class="alert alert-primary" role="alert"> </div>-->
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
<script src="<?= baseUrl ?>assets/js/js_operativo360.js"></script>