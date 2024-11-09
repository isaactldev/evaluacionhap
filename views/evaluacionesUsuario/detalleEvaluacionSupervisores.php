<?php
$k = 0;
$j = 0;
$b = 0;
$countt = 0;
$periodo = Utils::getPeriodoActivo();
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
          <h1>DETALLE DE LA EVALUACIÓN DEL DESEMPEÑO <?php echo $date = date("Y"); ?> - PERSONAL SUPERVISORES OPERATIVO</h1>
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
                      <input type="hidden" class="form-control" id="idEmpleado" name="idEmpleado" value="<?= $usuarioInfo->idusuario ?>">
                      <input type="hidden" class="form-control" id="idjerarquia" name="idjerarquia" value="<?= $usuarioInfo->idjerarquia ?>">
                      <input type="hidden" class="form-control" id="tipoevaluacion" name="tipoevaluacion" value="<?= $usuarioInfo->tipoevaluacion ?>">
                      <input type="hidden" class="form-control" id="autoevalua" name="autoevalua" value="<?= $usuarioInfo->autoevalua ?>">
                      <input type="hidden" class="form-control" id="evalua360" name="evalua360" value="<?= $usuarioInfo->evalua360 ?>">
                      <input type="text" class="form-control" id="noEmpleado" name="noEmpleado" value="<?= $usuarioInfo->noempleado ?>">
                    </div>
                    <div class="col-12 mb-3">
                      <label for="formGroupExampleInput" class="form-label">Personal Evaluad@</label>
                      <input type="text" class="form-control" id="formGroupExampleInput" name="user" value="<?= $usuarioInfo->nombreuser . ' ' . $usuarioInfo->appaterno . ' ' . $usuarioInfo->apmaterno ?>">
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
                      <label for="formGroupExampleInput" class="form-label">Periodo Evaluado</label>
                      <input type="text" class="form-control" id="idperiodo" name="periodo" value="<?= $idperiodo ?>">
                    </div>
                    <div class="col-12 mb-3">
                      <label for="formGroupExampleInput" class="form-label">Calificación</label>
                      <input type="text" class="form-control text-center" id="totalPuntos" name="puntaje" value="<?= $usuario->calificacion ?>" disabled>
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
              <h1 class="text-center mb-3"> EVALUACIÓN</h1>
              <table id="examen" class="table table-hover text-center mb-6" style="width:100%">


                <?php
                $bloquesCompetencias = Utils::showBloqueCompetencia();
                while ($competencia = $bloquesCompetencias->fetch_object()) : ?><!-- cuestionario  -->

                  <thead class="table-primary">


                    <tr>
                      <!-- NOMBRE DEL BLOQUE DE LA COMPETENCI A EVALUAR -->
                      <th colspan="5" class="text-left">
                        <h5><?= $competencia->bloquecompetencia ?></h5>
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
                    <?php while ($pregunta = $cuestionarioUsuario->fetch_object()) : ?>
                      <tr>
                        <?php $countt++; ?><!-- contador de preguntas -->
                        <!-- PREGUNTA -->
                        <td>
                          <input type="hidden" id="idp<?= $k ?>" value="<?= $pregunta->idcuestionariog ?>">
                          <input type="hidden" name="bloque" id="bloqueNo<?= $b ?>" value="<?= $competencia->idbloque ?>">
                          <?php $userResp = Utils::getRespuestaByPreguntaByIdUser($usuario->idusuario, $pregunta->idcuestionariog, $idperiodo) // OPTENCION DE LA RESPUESTA ACORDE A LA PREGUNTA
                          ?>
                          <p><?= $pregunta->pregunta ?> </p>
                        </td>
                        <!-- /PREGUNTA -->
                        <?php
                        $ponderaciones = Utils::getAllPonderaciones();
                        $countPonderacion = Utils::countPonderacines();
                        $count = $countPonderacion->idponderacion;
                        $i = 0;
                        ?>
                        <!-- VALIDAMOS LA RESPUESTA cuestionario normal -->
                        <?php while ($poderacion = $ponderaciones->fetch_object()) : ?>
                          <td id="<?= $pregunta->idcuestionariog ?>">
                            <?php $result = ($userResp->idponderacion == $poderacion->puntos) ? 'checked'  : ''; ?><!-- RESUESTA DEL USUARIO  -->
                            <input class="form-check-input fs-4" type="radio" name="pregunta<?= $pregunta->idcuestionariog ?>" id="<?= $i ?>" value="<?= $poderacion->puntos; ?>" <?= $result ?>><!-- RADIO BUUTON DE LA PONDERACION  -->
                            <?php $i++; ?>
                          </td>
                        <?php endwhile; ?>
                        <?php $k++; ?>
                        <?php $b++; ?>
                        <!-- VALIDAMOS LA RESPUESTA -->
                      </tr>
                    <?php endwhile; ?>
                    <!-- END BLOQUE DE PREGUNTAS DEL CUESTIONARIO -->
                  </tbody>


                <?php endwhile; ?><!-- /cuestionario  -->



                <h4>TOTAL DE PREGUNTAS: <?= $k ?></h4>
                <input type="hidden" id="totalPreguntas" value="<?= $k ?>">
              </table>
              <hr>
              <?php
              $departamentoAnec = Utils::userDepartamento($usuario->iddepartamento);
              ?>

              <?php if ($usuario->anecdotario == 'SI') : ?>
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
                      <?php $competenciaTecnicas = Utils::getPreguntaTecEvaluacionesByIduser360($usuarioInfo->idusuario, $idperiodo, $fechaperiodo); ?>
                      <?php while ($competenciaTec = $competenciaTecnicas->fetch_object()) : ?>
                        <tr>
                          <?php $countt++; ?><!-- contador de preguntas -->
                          <!-- PREGUNTA -->
                          <td>
                            <input type="hidden" id="idptec<?= $j ?>" value="<?= $competenciaTec->idcopentenciatecnica ?>">
                            <?php $userResp = Utils::getPreguntaRespTecEvaluacionesByIduser360($usuarioInfo->idusuario, $competenciaTec->idcopentenciatecnica, $idperiodo, $fechaperiodo) // OPTENCION DE LA RESPUESTA ACORDE A LA PREGUNTA
                            ?>
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
                              <?php $result = ($userResp->idponderacion == $poderacion->puntos) ? 'checked'  : ''; ?><!-- RESUESTA DEL USUARIO  -->
                              <input class="form-check-input fs-4" type="radio" name="preguntaTec<?= $competenciaTec->idcopentenciatecnica ?>" id="<?= $i ?>" value="<?= $poderacion->puntos; ?>" <?= $result ?>><!-- RADIO BUUTON DE LA PONDERACION  -->
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
              <?php endif; ?>
              <hr>
              <div class="row">

                <div class="col-6">
                  <h4 class="text-center mt-3">COMPROMISOS <span> <button class="btn btn-primary btn-sm me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#AddCompromisoUser" data-toggle="tooltip" title="Agregar Compromisos">Agregar <i class="fa-solid fa-plus fa-lg"></i></button> </span></h4>
                  <div class="col-12 mb-3">
                    <table class="table table-hover">
                      <thead>
                        <tr>

                          <th scope="col">Compromisos</th>
                          <th scope="col">
                            <center>Accion</center>
                          </th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($compromisoByUser = $compromisosByUser->fetch_object()) : ?>
                          <tr>

                            <td><?= $compromisoByUser->compromiso ?></td>
                            <td>
                              <center>
                                <a id="editmodal" class="btn btn-outline-secondary btn-sm btn-flat" data-bs-toggle="modal" data-bs-target="#editCompromisoUser<?= $compromisoByUser->idcompromiso ?>" data-toggle="tooltip" title="Editar"><i class="fas fa-user-edit"></i></a>
                              </center>
                            </td>
                          </tr>

                          <div class="modal" id="editCompromisoUser<?= $compromisoByUser->idcompromiso ?>">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Modifica el Compromiso</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                  <!-- EDIT -->
                                  <form action="<?= baseUrl ?>?controller=capcompromiso&action=editCompromiso" method="POST">
                                    <input type="hidden" class="form-control" id="ideditidCompromiso" name="ideditidCompromiso" value="<?= $compromisoByUser->idcompromiso ?>">
                                    <input type="hidden" class="form-control" id="idusereditidCompromiso" name="idusereditidCompromiso" value="<?= $compromisoByUser->idusuario ?>">
                                    <input type="hidden" class="form-control" id="idperiodo" name="periodo" value="<?= $idperiodo; ?>">
                                    <input type="hidden" class="form-control" id="fechaperiodo" name="fechaperiodoCompromiso" value="<?= $fechaperiodo; ?>">
                                    <div class="mb-3">
                                      <label for="formGroupExampleInput" class="form-label">Escribe un compromiso para mejorar</label>
                                      <textarea class="form-control" id="compromisoedit" name="compromisoedit" rows="2"><?= $compromisoByUser->compromiso ?></textarea>
                                    </div>
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4"><i class="fas fa-plus-square"></i> Editar</button>

                                </div>
                                </form>
                                <!-- EDIT -->
                              </div>
                              <!-- Modal body -->
                            </div>
                          </div>
                        <?php endwhile; ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col-6">
                  <h4 class="text-center mt-3">REQUIERE CAPACITACION <span> <button class="btn btn-primary btn-sm me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#AddCapacitacion" data-toggle="tooltip" title="Agregar Capacitacion">Agregar <i class="fa-solid fa-plus fa-lg"></i></button> </span></h4>
                  <div class="col-12 mb-3">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Capacitaciones</th>
                          <th scope="col">
                            <center>Accion</center>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($capacitacion = $capacitaciones->fetch_object()) : ?>
                          <tr>
                            <td><?= $capacitacion->nececitacapacitacion ?></td>
                            <td>
                              <center>
                                <a id="editmodal" class="btn btn-outline-secondary btn-sm btn-flat" data-bs-toggle="modal" data-bs-target="#editCapacitacionUser<?= $capacitacion->idcapacitacion ?>" data-toggle="tooltip" title="Editar"><i class="fas fa-user-edit"></i></a>
                              </center>
                            </td>
                          </tr>
                          <div class="modal" id="editCapacitacionUser<?= $capacitacion->idcapacitacion ?>">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Modificar Capacitacion</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                  <!-- EDIT -->
                                  <form action="<?= baseUrl ?>?controller=capcompromiso&action=aditCapacitacion" method="POST">
                                    <input type="hidden" class="form-control" id="ideditidCapacitaciones" name="ideditidCapacitaciones" value="<?= $capacitacion->idcapacitacion ?>">
                                    <input type="hidden" class="form-control" id="idusereditidCapacitacion" name="idusereditidCapacitacion" value="<?= $capacitacion->idusuario ?>">
                                    <input type="hidden" class="form-control" id="idperiodo" name="periodo" value="<?= $idperiodo; ?>">
                                    <input type="hidden" class="form-control" id="fechaperiodoCapacitacion" name="fechaperiodoCapacitacion" value="<?= $fechaperiodo; ?>">
                                    <div class="mb-3">
                                      <label for="formGroupExampleInput" class="form-label">Escribe un capacitacion para mejorar</label>
                                      <textarea class="form-control" id="capacitacionedit" name="capacitacionedit" rows="2"><?= $capacitacion->nececitacapacitacion ?></textarea>
                                    </div>
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4"><i class="fas fa-plus-square"></i> Editar</button>
                                </div>
                                </form>
                                <!-- EDIT -->
                              </div>
                              <!-- Modal body -->
                            </div>
                          </div>
                        <?php endwhile; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <hr>
              <?php if ($_SESSION['identity']->rol == 'admin') : ?>
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
                    <button class="btn btn-primary me-md-2" type="button" onclick="countPuntos();"><i class="fas fa-spell-check"></i> Ver Calificacion </button>
                    <button id="readysaveEvaluacionAuto" class="btn btn-primary me-md-2" type="button" onclick="guardarRespuestas();"><i class="fa fa-fw fa-plus-square"></i> Guardar Modificacion </button>
                  </div>
                </div>
              <?php endif; ?>
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

  /* VISTA PREVIA DE LA CALIFICACION  */
  function countPuntos() {
    let countPuntos = 0; /* CONTADOR DE PUNTOS  */
    let countPuntosTec = 0;
    let arregloTec = [];
    let totalPreguntas = $('#totalPreguntas').val();
    let totalPreguntasTec = $('#totalPreguntasTec').val();
    var califCap = parseFloat($("#calificaconCapF").val());

    let maxPuntosTec = totalPreguntasTec * 4;

    for (let i = 0; i < totalPreguntas; i++) {

      let idPregunta = $('#idp' + i).val(); /* console.log("idPregunta"+idPregunta); */
      let valorR = $('input:radio[name=pregunta' + idPregunta + ']:checked').val();

      if (isNaN(valorR)) {
        Swal.fire({
          icon: 'warning',
          confirmButtonColor: '#213c6d',
          title: 'DEBES RESPONDER TODAS LAS PREGUNTAS!',
          text: 'Una de las Preguntas no las has seleccionado porfavor verificalo!',
        })
        setTimeout(function() {

        }, 1150);
      }
      countPuntos = parseFloat(valorR) + parseFloat(countPuntos);

    }
    let totalPuntos = countPuntos;
    let maxPuntosG = totalPreguntas * 4;

    /* CALCULO DE CALIFICACION ENFERMERAS */
    let calf1 = (totalPuntos * 0.4) / maxPuntosG;
    calf1 = Math.floor(calf1 * 1000) / 1000;
    calf1 = parseFloat(calf1);
    /* SI EXISTE CALIFICACION DEL ANECDOTARIO */
    if ($("#califAnecdotario").length) {
      let califTec = parseFloat($('#califAnecdotario').val());

      let calf1 = ((totalPuntos * 0.4) / maxPuntosG);
      calf1 = Math.floor(calf1 * 1000) / 1000;
      calf1 = parseFloat(calf1);

      let calf2 = califTec;

      let calificacion = (calf1 + calf2) * 10;
      calificacion = Math.floor(calificacion * 100) / 100;


      if (calificacion > 10) {
        calificacion = 10;
      } else {
        calificacion = calificacion;
      }

      calificacion = Math.trunc(calificacion * 100) / 100;

      if (isNaN(calificacion)) {
        $("#totalPuntos2").val(0);
      } else {
        calificacion = calificacion + califCap;
        calificacion = Math.trunc(calificacion * 100) / 100;

        /* base 10 Calificacion Generica */
        var showcalf1 = calf1 * 10;
        showcalf1 = showcalf1.toFixed(2);

        /* base 10 calificacion tecnica */
        var showcalf2 = calf2 * 10;
        showcalf2 = showcalf2.toFixed(2);
        $("#califGenerales").val(showcalf1);
        $("#califTecR").val(showcalf2);
        $("#califCapacit").val(califCap);
        $("#totalPuntos2").val(calificacion);
        console.log("CALIFICACION FINAL:", calificacion);
      }


    } else {
      for (let i = 0; i < totalPreguntasTec; i++) {
        let idPreguntaTec = $('#idptec' + i).val();
        let valorRTec = $('input:radio[name=preguntaTec' + idPreguntaTec + ']:checked').val();

        console.log('idPreguntaTec- ', idPreguntaTec, 'RESPUESTA - ', valorRTec);

        if (isNaN(valorRTec)) {
          Swal.fire({
            icon: 'warning',
            confirmButtonColor: '#213c6d',
            title: 'DEBES RESPONDER TODAS LAS PREGUNTAS!',
            text: 'Una de las Preguntas no las has seleccionado porfavor verificalo!',
          })
          setTimeout(function() {

          }, 1150);
        }
        countPuntosTec = parseFloat(valorRTec) + parseFloat(countPuntosTec);
        let objtec = {
          idPreguntaTecr: idPreguntaTec,
          respTec: valorRTec
        };
        arregloTec.push(objtec);
      }

      let totalPuntosTec = countPuntosTec;
      let calf2 = (countPuntosTec * 0.5) / maxPuntosTec;
      calf2 = Math.floor(calf2 * 1000) / 1000;
      calf2 = parseFloat(calf2);



      let calificacion = (calf1 + calf2) * 10;
      calificacion = Math.floor(calificacion * 100) / 100;
      if (calificacion > 10) {
        calificacion = 10;
      } else {
        calificacion = calificacion;
      }
      calificacion = Math.trunc(calificacion * 100) / 100;


      if (isNaN(calificacion)) {
        $("#totalPuntos2").val(0);
      } else {
        calificacion = calificacion + califCap;
        calificacion = Math.trunc(calificacion * 100) / 100;

        /* base 10 Calificacion Generica */
        var showcalf1 = calf1 * 10;
        showcalf1 = showcalf1.toFixed(2);

        /* base 10 calificacion tecnica */
        var showcalf2 = calf2 * 10;
        showcalf2 = showcalf2.toFixed(2);

        $("#califGenerales").val(showcalf1);
        $("#califTecR").val(showcalf2);
        $("#califCapacit").val(califCap);
        $("#totalPuntos2").val(calificacion);

        /* VALIDACION PARA GUARDAR CALIFICACION */
        if (preguntasFaltantesAuto == false && !isNaN(calificacion)) {
          $("#totalPuntos2").val(calificacion);
          $("#readysaveEvaluacionAuto").prop("disabled", false);
        }
      }
    }
  }

  function alertcalificacion() {
    var url = location.origin;
    var path = window.location.pathname;
    Swal.fire({
      icon: 'error',
      confirmButtonColor: '#213c6d',
      title: 'FALTA LA CALIFICACION DEL ANECDOTARIO!',
      text: 'Necesitas evaluar primero en el anecdotario!',
    })
    setTimeout(function() {
      window.location.href = url + path + "?controller=evausuario&action=index";
    }, 2250);
  }

  function guardarRespuestas() {
    let countPuntos = 0; /* CONTADOR DE PUNTOS  */
    let countPuntosTec = 0;
    let arreglo = []; /* arreglo de respuestas */
    let arregloTec = []; /* arreglo de repuestas Tecnicas */
    let anecdotatio = []; /* arreglo del Anecdotario  */
    let califAnecdotario1;
    let existAnecdotario1;
    let statusresG;
    let statusresTec;
    let evalua360 = $('#evalua360').val();
    let totalPreguntas = $('#totalPreguntas').val();
    let totalPreguntasTec = $('#totalPreguntasTec').val();
    let periodo = $('#idperiodo').val();


    /* OBTENEMOS LAS RESPUESTAS DEL CUESTIONARIO GENERAL */
    for (let i = 0; i < totalPreguntas; i++) {
      let idBloque = $('#bloqueNo' + i).val();
      let idPregunta = $('#idp' + i).val(); /* console.log("idPregunta"+idPregunta); */
      let valorR = $('input:radio[name=pregunta' + idPregunta + ']:checked').val();

      if (isNaN(valorR)) {
        Swal.fire({
          icon: 'warning',
          confirmButtonColor: '#213c6d',
          title: 'DEBES RESPONDER TODAS LAS PREGUNTAS!',
          text: 'Una de las Preguntas no las has seleccionado porfavor verificalo!',
        })
        setTimeout(function() {}, 1150);
        statusresG = true;
      }
      countPuntos = parseFloat(valorR) + parseFloat(countPuntos);
      let objt = {
        idPreguntra: idPregunta,
        respuesta: valorR,
        idbloque: idBloque
      };
      arreglo.push(objt); /* console.log(valorR); */
    }

    let statusresTec2;
    if ($("#califAnecdotario").length) {
      /* GENERAMOS LA CALIFICACION DEL ANECDOTARIO */
      let califTec = parseFloat($('#califAnecdotario').val());
      let calf2 = califTec;
      calf2 = calf2.toFixed(2);
      let califAnecdotario = calf2;
      let existAnecdotario = 1;

      califAnecdotario1 = califAnecdotario;
      existAnecdotario1 = existAnecdotario;

    } else {
      for (let i = 0; i < totalPreguntasTec; i++) {
        let idPreguntaTec = $('#idptec' + i).val();

        let valorRTec = $('input:radio[name=preguntaTec' + idPreguntaTec + ']:checked').val();

        if (isNaN(valorRTec)) {
          Swal.fire({
            icon: 'warning',
            confirmButtonColor: '#213c6d',
            title: 'DEBES RESPONDER TODAS LAS PREGUNTAS TECNICAS!',
            text: 'Una de las Preguntas Tecnicas no las has seleccionado porfavor verificalo!',
          })
          setTimeout(function() {}, 1150);
          statusresTec = true;
        }
        countPuntosTec = parseFloat(valorRTec) + parseFloat(countPuntosTec);
        let objtec = {
          idPreguntaTecr: idPreguntaTec,

          respTec: valorRTec
        };
        arregloTec.push(objtec);
      }
      statusresTec2 = statusresTec;
    }

    /* OBTENEMOS LAS RESPUESTAS DE BLOQUE DE COMPETENCIAS TECNICAS */

    /* console.log(countPuntos); */
    /* TOTAL DE PUNTOS */
    let idUsuario = $('#idEmpleado').val();
    let tipoevaluacion = $('#tipoevaluacion').val();
    let autoevalua = $('#autoevalua').val();
    let totalPuntosG = countPuntos;
    let totalPuntosTec = countPuntosTec;


    /* objeto que se envia */
    let objtUser = {
      idusuario: idUsuario,
      evalua360: evalua360,
      tipoevaluacion: tipoevaluacion,
      autoevalua: autoevalua,
      totalPuntosG: totalPuntosG,
      totalPuntosTec: totalPuntosTec,
      respuestas: arreglo,
      respuestasTec: arregloTec,
      califAnecdotario: califAnecdotario1,
      existAnecdotario: existAnecdotario1,
      periodo: periodo

    };

    if (statusresTec2 == true && statusresG == true) {
      Swal.fire({
        icon: 'warning',
        confirmButtonColor: '#213c6d',
        title: 'DEBES RESPONDER TODAS LAS PREGUNTAS!',
        text: 'Una de las Preguntas no las has seleccionado porfavor verificalo!',
      })
      setTimeout(function() {}, 1150);
      console.log(statusresTec2);
      console.log("FALTAN PREGUNTAS POR CONTESTAR");
    } else {
      var url = location.origin;
      var path = window.location.pathname;

      console.log(objtUser); /* RESPUESTAS DEL USUARIO  */

      $.post("config/helpers/actualizaEvaluacionUsuario.php", {
          objtUseR: objtUser
        },
        function(mensaje) {
          Swal.fire({
            icon: 'success',
            confirmButtonColor: '#213c6d',
            title: 'Evaluacion Guardada!',
            text: 'La evaluacion se ha guardado CORRECTAMENTE!',
          })
          setTimeout(function() {
            window.location.href = url + path + "?controller=evaluacion&action=allUsuarioStatusEvaluacion";
          }, 2250);
        });
    }


  }
</script>