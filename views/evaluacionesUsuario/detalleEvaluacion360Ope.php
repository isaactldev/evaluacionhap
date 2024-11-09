<?php
$k = 0;
$j = 0;
$countt = 0;
if (isset($_SESSION['saveCompromiso']) && $_SESSION['saveCompromiso'] == 'saveCompromiso') {
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d', 
          title: 'Compromiso Modificado!', 
          text: 'EL COMPROMISO DE GUARDO CORRECTAMENTE!',})
        </script>";
}
if (isset($_SESSION['saveCompromiso']) && $_SESSION['saveCompromiso'] == 'error_saveCompromiso') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d',
          title: 'Error al Modificar Compromiso!', 
          text: 'NO SE GUARDARON LOS CAMBIOS CORRECTAMENTE!',})
        </script>";
}
if (isset($_SESSION['saveCompromiso']) && $_SESSION['saveCompromiso'] == 'saveNewCompromiso') {
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d', 
          title: 'GUARDADO CON EXITO!', 
          text: 'EL COMPROMISO DE GUARDO CORRECTAMENTE!',})
        </script>";
}
if (isset($_SESSION['saveCompromiso']) && $_SESSION['saveCompromiso'] == 'error_saveNewCompromiso') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d',
          title: 'Error al Guardar el Compromiso!', 
          text: 'NO SE GUARDO CORRECTAMENTE!',})
        </script>";
}
if (isset($_SESSION['saveeditCapacitacion']) && $_SESSION['saveeditCapacitacion'] == 'saveeditCapacitacion') {
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d', 
          title: 'Capacitacion Modificada!', 
          text: 'LA MODIFICACION SE GUARDO CORRECTAMENTE!',})
        </script>";
}
if (isset($_SESSION['saveeditCapacitacion']) && $_SESSION['saveeditCapacitacion'] == 'error_saveeditCapacitacion') {
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d',
          title: 'Error al Guardar la Capacitacion!', 
          text: 'NO SE MODIFICO CORRECTAMENTE!',})
        </script>";
}
if (isset($_SESSION['saveCapacitacion']) && $_SESSION['saveCapacitacion'] == 'saveCapacitacion') {
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d', 
          title: 'Capacitacion Guardada!', 
          text: 'LA CAPACITACION SE GUARDO CORRECTAMENTE!',})
        </script>";
}
if (isset($_SESSION['saveCapacitacion']) && $_SESSION['saveCapacitacion'] == 'error_saveCapacitacion') {
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d',
          title: 'Error al Guardar la Capacitacion!', 
          text: 'NO SE GUARDO CORRECTAMENTE!',})
        </script>";
}
Utils::deleteSession('saveCompromiso');
Utils::deleteSession('saveCapacitacion');
Utils::deleteSession('saveeditCapacitacion');
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
          <h1>DETALLE DE EVALUACIÓN DE DESEMPEÑO <?php echo $date = date("Y"); ?> - PERSONAL 360° OPERATIVO</h1>
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
                      <input type="text" class="form-control" id="noEmpleado" name="noEmpleado" value="<?= $usuarioInfo->noempleado ?>">
                    </div>
                    <div class="col-12 mb-3">
                      <label for="formGroupExampleInput" class="form-label">Personal Evaluad@</label>
                      <input type="text" class="form-control" id="formGroupExampleInput" name="user" value="<?= $usuarioInfo->nombreuser . ' ' . $usuarioInfo->appaterno . ' ' . $usuarioInfo->apmaterno ?>">
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
                    <div class="col-12 mb-3">
                      <label for="calificaconCapF" class="form-label">Plataforma de Capacitacion Calif.</label>
                      <?php $calificaconCapF = ($califCap == "400") ? "SIN CALIFICACION EXISTENTE!" :  $califCap ?>
                      <input type="text" class="form-control text-center" id="calificaconCapF" name="calificaconCapF" value="<?= $calificaconCapF ?>" disabled>
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
                      <input type="text" class="form-control" id="idperiodo" name="periodo" value="<?= $califPeriodo->idperiodo; ?>">
                    </div>
                    <div class="col-12 mb-3">
                      <label for="formGroupExampleInput" class="form-label">Calificación</label>
                      <input type="text" class="form-control text-center" id="totalPuntos" name="puntaje" value="<?= $califPeriodo->calificacionperiodo ?>" disabled>
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
                    <?php $competenciaTecnicas = Utils::getPreguntaTecEvaluacionesByIduser360($usuario->idusuario, $idperiodo, $fechaperiodo); ?>
                    <?php while ($competenciaTec = $competenciaTecnicas->fetch_object()) : ?>
                      <tr>
                        <?php $countt++; ?><!-- contador de preguntas -->

                        <!-- PREGUNTA -->
                        <td>
                          <input type="hidden" id="idptec<?= $j ?>" value="<?= $competenciaTec->idcopentenciatecnica ?>">
                          <?php $userResp = Utils::getPreguntaRespTecEvaluacionesByIduser360($usuario->idusuario, $competenciaTec->idcopentenciatecnica, $idperiodo, $fechaperiodo) // OPTENCION DE LA RESPUESTA ACORDE A LA PREGUNTA
                          ?>
                          <input type="hidden" id="competenciatec360" value="<?= $userResp->competencia ?>">
                          <p><?= $userResp->competencia ?></p>
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

            </div>
            <hr>
            <?php if ($_SESSION['identity']->rol == 'admin') : ?>
              <div class="row">
                <div class="col-6 mt-3 mb-2 justify-content-md-end">
                </div>
                <div class="col-6 mt-3 mb-2 text-md-right justify-content-md-end">
                  <label for="formGroupExampleInput">Competencias Tecnicas: </label><input id="califTecR" type="number" class="ml-2 me-1 col-1 text-center" value="" disabled><br>
                  <label for="formGroupExampleInput">Plataforma de Capacitacion: </label><input id="califCapacit" type="number" class="ml-2 me-1 col-1 text-center" value="" disabled><br>
                  <hr>
                  <label for="formGroupExampleInput">Total: </label><input type="text" class="ml-2 me-1 col-1 text-center" id="totalPuntos2" name="puntaje" value="" disabled><br>
                </div>
                <div class="d-grid gap-2 d-md-flex mt-3 mb-2 justify-content-md-end">
                  <button class="btn btn-primary me-md-2" type="button" onclick="countPuntos();"><i class="fas fa-spell-check"></i> Ver Calificacion </button>
                  <button id="readysaveEvaluacion360Directivo" class="btn btn-primary me-md-2" type="button" onclick="guardarRespuestas();"><i class="fa fa-fw fa-plus-square"></i> Guardar Modificacion </button>

                </div>
              </div>
            <?php endif; ?>
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

<!-- MODAL ADD COMPROMISO -->
<div class="modal" id="AddCompromisoUser">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Agregar Compromisos</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <!-- EDIT -->
        <form action="<?= baseUrl ?>?controller=capcompromiso&action=saveCompromisos" method="POST">
          <input type="hidden" class="form-control" id="iduserCompromiso" name="iduserCompromiso" value="<?= $iduser ?>">
          <input type="hidden" class="form-control" id="idperiodo" name="idperiodo" value="<?= $idperiodo; ?>">
          <input type="hidden" class="form-control" id="fechaperiodo" name="fechaperiodoCompromiso" value="<?= $fechaperiodo; ?>">
          <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Escribe un compromiso para mejorar</label>
            <textarea class="form-control" id="compromisoedit" name="addcompromiso" rows="2"></textarea>
          </div>
          <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4"><i class="fas fa-plus-square"></i> Guardar</button>

      </div>
      </form>
      <!-- EDIT -->
    </div>
    <!-- Modal body -->
  </div>
</div>

<!-- MODAL ADD CAPACITACION -->
<div class="modal" id="AddCapacitacion">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Agregar Capacitacion </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <!-- EDIT -->
        <form action="<?= baseUrl ?>?controller=capcompromiso&action=saveCapacitacion" method="POST">
          <input type="hidden" class="form-control" id="iduserCapacitacion" name="iduserCapacitacion" value="<?= $iduser ?>">
          <input type="hidden" class="form-control" id="idperiodoCapacitacion" name="idperiodoCapacitacion" value="<?= $idperiodo; ?>">
          <input type="hidden" class="form-control" id="fechaperiodoCap" name="fechaperiodoCap" value="<?= $fechaperiodo; ?>">
          <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Escribe la Capacitacion para mejorar</label>
            <textarea class="form-control" id="capacitacionsave" name="capacitacionsave" rows="2"></textarea>
          </div>
          <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4"><i class="fas fa-plus-square"></i> Guardar</button>

      </div>
      </form>
      <!-- EDIT -->
    </div>
    <!-- Modal body -->
  </div>
</div>

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



  function countPuntos() {
    let countPuntosTec = 0; /* CONTADOR DE PUNTOS  */
    let arregloTec = [];
    let totalPreguntasTec = $('#totalPreguntasTec').val();
    let calif360user = $('#calif360user').val();
    var preguntasFaltantes360 = false;
    var califCap = parseFloat($("#calificaconCapF").val());
    let maxPuntosTec = totalPreguntasTec * 4;


    for (let i = 0; i < totalPreguntasTec; i++) {
      let idPreguntaTec = $('#idptec' + i).val();
      let valorRTec = $('input:radio[name=preguntaTec' + idPreguntaTec + ']:checked').val();
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
    console.log('totalPuntosTec: ', totalPuntosTec);

    let calf1 = (totalPuntosTec * 0.5) / maxPuntosTec;
    calf1 = Math.floor(calf1 * 1000) / 1000;
    calf1 = parseFloat(calf1);

    /* calidicacion de la 360 */
    let calf2 = (calif360user * 0.4);
    calf2 = Math.floor(calf2 * 1000) / 1000;
    calf2 = parseFloat(calf2);

    let califpreliminarTec = calf1 * 10;
    let calificacion = (califpreliminarTec + calf2);

    if (calificacion > 10) {
      calificacion = 10;
    } else {
      calificacion = calificacion;
    }

    calificacion = Math.trunc(calificacion * 100) / 100;

    if (isNaN(calificacion)) {
      $("#totalPuntos2").val(0);
      preguntasFaltantes360 = true;
    } else {

      calificacion = calificacion + califCap;
      calificacion = Math.trunc(calificacion * 100) / 100;

      /* CALIFICACION TECNICA 360 */
      var showcalf1 = calf1 * 10;
      showcalf1 = showcalf1.toFixed(2);

      $("#califTecR").val(showcalf1);
      $("#califCapacit").val(califCap);
      $("#totalPuntos2").val(calificacion);
      console.log("CALIFICACION FINAL:", calificacion);

      if (preguntasFaltantes360 == false && !isNaN(calificacion)) {
        $("#totalPuntos2").val(calificacion);
        $("#readysaveEvaluacion360").prop("disabled", false);
      }
    }
  }

  function guardarRespuestas() {
    let countPuntosTec = 0;
    let arreglo = []; /* arreglo de respuestas */
    let arregloTec = []; /* arreglo de repuestas Tecnicas */
    let totalPreguntasTec = $('#totalPreguntasTec').val();
    let periodo = $('#idperiodo').val();
    var califCap = parseFloat($("#calificaconCapF").val());

    /* OBTENEMOS LAS RESPUESTAS DE BLOQUE DE COMPETENCIAS TECNICAS */
    for (let i = 0; i < totalPreguntasTec; i++) {
      let idPreguntaTec = $('#idptec' + i).val();

      let valorRTec = $('input:radio[name=preguntaTec' + idPreguntaTec + ']:checked').val();
      countPuntosTec = parseFloat(valorRTec) + parseFloat(countPuntosTec);
      let objtec = {
        idPreguntaTecr: idPreguntaTec,

        respTec: valorRTec
      };
      arregloTec.push(objtec);
    }
    /* console.log(countPuntos); */
    /* TOTAL DE PUNTOS */
    let idUsuario = $('#idEmpleado').val();
    let evalua360 = $('#evalua360').val();
    let tipoevaluacion = $('#tipoevaluacion').val();
    let autoevalua = $('#autoevalua').val();
    let calif360user = $('#calif360user').val();
    let totalPuntosTec = countPuntosTec;
    let totalrespTec = arregloTec.length;

    /* objeto que se envia */
    let objtUser = {
      idusuario: idUsuario,
      calif360user: calif360user,
      tipoevaluacion: tipoevaluacion,
      totalPuntosTec: totalPuntosTec,
      totalrespTec: totalrespTec,
      respuestasTec: arregloTec,
      evalua360: evalua360,
      periodo: periodo,
      califCap: califCap

    };


    var url = location.origin;
    var path = window.location.pathname;
    console.log(objtUser); /* RESPUESTAS DEL PERSONAL OPERATIVO 360°  */
    $.post("config/helpers/actualizaEvaluacionUsuario360Ope.php", {
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
          window.location.href = url + path + "?controller=evausuario&action=index";
        }, 2250);
        $("#respuesta").html(mensaje);
      });

  }

  function ajusteCalifCapacitacion(califEva) {
    var califEva = parseFloat(califEva);
    var califCap = parseFloat($("#calificaconCapF").val());

    var califEvaPeriodoFinal = califEva - 1;
    califEvaPeriodoFinal = califEvaPeriodoFinal + califCap;

    return califEvaPeriodoFinal.toFixed(2);
  }
</script>