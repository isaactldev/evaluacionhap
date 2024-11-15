<?php
$k = 0;
$b = 0;
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
          <h1>EVALUACIÓN DEL DESEMPEÑO <?php echo $date = date("Y"); ?> - PERSONAL OPERATIVO</h1>
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
                  <!-- INFO -->
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
                  </div>
                  <div class="col-4">
                    <div class="col-12 mb-3">
                      <label for="formGroupExampleInput" class="form-label">Puesto</label>
                      <?php $puesto = Utils::userPuesto($usuario->idpuesto); ?>
                      <input type="text" class="form-control" id="formGroupExampleInput" name="puesto" value="<?= $puesto->nombrepuesto ?>">
                    </div>
                    <div class="col-12 mb-3">
                      <label for="formGroupExampleInput" class="form-label">Departamento</label>
                      <?php $departamento = Utils::userDepartamento($usuario->iddepartamento); ?>
                      <input type="text" class="form-control" id="formGroupExampleInput" name="dep" value="<?= $departamento->depnombre ?>">
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
                <!-- END INFO USER -->
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
                    <h1 style="color: #000;"><strong>Instrucciones: </strong> ¡Recuerda tienes un tiempo limite aproximado de 1Hr para contestar la Evaluacion!</h1>
                  </blockquote>
                </div>
              </center>
              <h1 class="text-center mb-3"> EVALUACIÓN </h1>
              <h1 class="text-center mb-3"> COMPETENCIAS GENERICAS </h1>
              <table id="examen" class="table table-hover text-center mb-6" style="width:100%">

                <?php
                $numeroPreguntaGen = 1;
                $bloquesCompetencias = Utils::showBloqueCompetencia();
                while ($competencia = $bloquesCompetencias->fetch_object()) : ?><!-- WHILE DE COMPETENCIAS -->
                  <thead class="table-primary">
                    <tr>
                      <th colspan="5" class="text-left">
                        <center>
                          <h4><?= $competencia->bloquecompetencia ?></h4>
                        </center>
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
                    <?php $cuestionarioUsuario = Utils::showPreguntasdelBloque($competencia->idbloque); ?>

                    <?php while ($pregunta = $cuestionarioUsuario->fetch_object()) : ?><!-- WHILE DE PREGUNTAS -->
                      <!-- PREGUNTAS -->
                      <tr>
                        <?php $countt++; ?><!-- contador de preguntas -->
                        <td>
                          <input type="hidden" id="idp<?= $k ?>" value="<?= $pregunta->idcuestionariog ?>">
                          <input type="hidden" name="bloque" id="bloqueNo<?= $b ?>" value="<?= $competencia->idbloque ?>">
                          <p><strong><?= $numeroPreguntaGen ?> - </strong><small><?= $pregunta->pregunta ?></small></p>
                        </td>
                        <?php
                        $ponderaciones = Utils::getAllPonderaciones();
                        $countPonderacion = Utils::countPonderacines();
                        $count = $countPonderacion->idponderacion;
                        $i = 0;
                        ?>
                        <?php while ($poderacion = $ponderaciones->fetch_object()) : ?>
                          <td id="<?= $pregunta->idcuestionariog ?>">
                            <input class="form-check-input fs-4" type="radio" name="pregunta<?= $pregunta->idcuestionariog ?>" id="<?= $i ?>" value="<?= $poderacion->puntos; ?>">
                            <?php $i++; ?>
                          </td>
                        <?php endwhile; ?>
                        <?php $k++; ?>
                        <?php $b++; ?>
                        <?php $numeroPreguntaGen++; ?>
                      </tr>

                    <?php endwhile; ?><!-- WHILE DE PREGUNTAS -->
                  </tbody><!-- END BLOQUE DE PREGUNTAS DEL CUESTIONARIO -->
                <?php endwhile; ?><!-- WHILE DE COMPETENCIAS -->
                <h4>TOTAL DE PREGUNTAS: <?= $k ?></h4>
                <input type="hidden" id="totalPreguntas" value="<?= $k ?>">
              </table>
              <?php
              $departamentoAnec = Utils::userDepartamento($usuario->iddepartamento);
              ?>

              <?php if ($usuario->anecdotario == 'SI') : ?>
                <hr>
                <?php $calificacionAnec = Utils::getCalificacionAnecdotario($usuario->noempleado); ?>
                <div class="row text-center">
                  <h3>COMPETENCIAS TECNICAS </h3>
                  <table id="examen" class="table table-hover text-center mb-6" style="width:100%">
                    <thead class="table-primary">
                      <tr>
                        <th scope="col">
                          <h4>EVALUACION ENFERMERIA:</h4>
                        </th>
                        <th>
                          <?php if (isset($calificacionAnec->Save) && $calificacionAnec->Save == 2) : ?>
                            <input type="number" class="form-control col-5 text-center" id="califAnecdotario" value="<?= $calificacionAnec->calif ?>" disabled>
                          <?php else : ?>
                            <h5 id="sinCalifAnecdotario"><?= $calificacionAnec->mensaje ?></h5>
                          <?php endif; ?>
                        </th>
                      </tr>
                    </thead>
                  </table>
                </div>
              <?php else : ?>
                <hr>
                <div class="row text-center">
                  <table id="examen" class="table table-hover text-center mb-6" style="width:100%">
                    <?php $bloquesCompetencias = Utils::showBloqueCompetencia(); ?>
                    <thead class="table-primary">
                      <tr>
                        <!-- NOMBRE DEL BLOQUE DE LA COMPETENCI A EVALUAR -->
                        <th colspan="5" class="text-left">
                          <center>
                            <h4>Competencias Tecnicas</h4>
                          </center>
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
                            <input type="hidden" id="competenciatec<?= $j ?>" value="<?= $competenciaTec->competencia ?>">
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
                              <!-- RADIO BUUTON DE LA PONDERACION  -->
                              <input class="form-check-input fs-4" type="radio" name="preguntaTec<?= $competenciaTec->idcopentenciatecnica ?>" id="<?= $i ?>" value="<?= $poderacion->puntos; ?>">
                              <?php $i++; ?>
                            </td>
                          <?php endwhile; ?>
                          <?php $j++; ?>
                          <!-- VALIDAMOS LA RESPUESTA -->
                        </tr>
                      <?php endwhile; ?>
                      <!-- END BLOQUE DE PREGUNTAS DEL CUESTIONARIO -->
                    </tbody>
                    <!-- <h4>TOTAL DE PREGUNTAS: <?= $j ?></h4> -->
                    <input type="hidden" id="totalPreguntasTec" value="<?= $j ?>">
                  </table>
                </div>
              <?php endif; ?>
              <hr>

              <form action="<?= baseUrl ?>?controller=evausuario&action=activarPeriodo" method="post">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-center mt-3">COMPROMISOS</h4>
                    <div class="col-12 mb-3">
                      <label for="exampleFormControlTextarea1" class="form-label">Escribe los compromisos de mejorar</label>
                      <textarea class="form-control" id="compromisos" rows="2"></textarea>
                    </div>
                  </div>
                  <div class="col-6">
                    <h4 class="text-center mt-3">REQUIERE CAPACITACION</h4>
                    <div class="col-12 mb-3">
                      <label for="exampleFormControlTextarea1" class="form-label">Menciona si requieres de una o más capacitaciones para mejorar</label>
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
                  <label for="formGroupExampleInput">Competencias Genericas: </label><input id="califGenerales" type="number" class="ml-2 col-1 text-center" value="" disabled><br>
                  <label for="formGroupExampleInput">Competencias Tecnicas: </label><input id="califTecR" type="number" class="ml-2 col-1 text-center" value="" disabled><br>
                  <label for="formGroupExampleInput">Plataforma de Capacitacion: </label><input id="califCapacit" type="number" class="ml-2 col-1 text-center" value="" disabled><br>
                  <hr>
                  <label for="formGroupExampleInput">Total: </label><input type="text" class=" ml-2 col-1 text-center" id="totalPuntos2" name="puntaje" value="" disabled><br>
                </div>
                <div class="d-grid gap-2 d-md-flex mt-3 mb-2 justify-content-md-end">
                  <button class="btn btn-primary me-md-2" type="button" onclick="countPuntos();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16">
                      <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                    </svg>
                    Ver Calificacion
                  </button>
                  <?php if ($calificacionAnec->noSave == 1) : ?>
                    <button class="btn btn-primary me-md-2" type="button" onclick="alertcalificacion();"><i class="fa fa-fw fa-plus-square"></i> Guardar Evaluacion</button>
                  <?php else : ?>
                    <button id="readysaveEvaluacion" class="btn btn-primary me-md-2" type="button" onclick="guardarRespuestas();" disabled>
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-floppy-fill" viewBox="0 0 16 16">
                        <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z" />
                        <path d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z" />
                      </svg>
                      Guardar Evaluacion
                    </button>
                  <?php endif; ?>
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
<script src="<?= baseUrl ?>assets/js/js_cuestionario.js"></script>