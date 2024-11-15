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
          <h1>EVALUACIÓN DEL DESEMPEÑO <?php echo $date = date("Y"); ?> - PERSONAL OPERATIVO </h1>
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
                      <input type="hidden" class="form-control" id="evalua360" name="idjerarquia" value="<?= $usuario->idjerarquia ?>">
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
              <h1 class="text-center mb-3"> EVALUACIÓN </h1>
              <table id="examen" class="table table-hover text-center mb-6" style="width:100%">

                <?php
                $bloquesCompetencias = Utils::showBloqueCompetencia();
                while ($competencia = $bloquesCompetencias->fetch_object()) : ?><!-- WHILE DE COMPETENCIAS -->
                  <thead class="table-primary">
                    <tr>
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

                    <?php while ($pregunta = $cuestionarioUsuario->fetch_object()) : ?><!-- WHILE DE PREGUNTAS -->
                      <tr>
                        <?php $countt++; ?><!-- contador de preguntas -->
                        <td>
                          <input type="hidden" id="idp<?= $k ?>" value="<?= $pregunta->idcuestionariog ?>">
                          <?= $pregunta->pregunta ?>
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
                      </tr>

                    <?php endwhile; ?><!-- WHILE DE PREGUNTAS -->
                  </tbody><!-- END BLOQUE DE PREGUNTAS DEL CUESTIONARIO -->
                <?php endwhile; ?><!-- WHILE DE COMPETENCIAS -->
                <h4>TOTAL DE PREGUNTAS: <?= $k ?></h4>
                <input type="hidden" id="totalPreguntas" value="<?= $k ?>">
              </table>

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
                          <?php //$userResp = Utils::getRespuestaByPreguntaByIdUser($usuario->idusuario,$pregunta->idcuestionariog, $periodo->idperiodo) // OPTENCION DE LA RESPUESTA ACORDE A LA PREGUNTA
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
                <div class="d-grid gap-2 d-md-flex mt-3 mb-2 justify-content-md-end">
                  Puntuacion: <input type="text" class="form-control col-1" id="totalPuntos2" name="puntaje" value="">
                  <button class="btn btn-primary me-md-2" type="button" onclick="countPuntos();"><i class="fas fa-spell-check"></i> Ver Calificacion </button>
                  <button class="btn btn-primary me-md-2" type="button" onclick="guardarRespuestas();"><i class="fa fa-fw fa-plus-square"></i> Guardar Evaluacion </button>
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

    let calf1 = (totalPuntosTec * 0.4) / maxPuntosTec;
    let calf2 = (calif360user * 0.6); /* calidicacion de la 360 */

    let califpreliminarTec = calf1 * 10;
    let calificacion = (califpreliminarTec + calf2);

    console.log('calificacion 1: ', calificacion);
    if (calificacion > 10) {
      calificacion = 10;
    } else {
      calificacion = calificacion.toFixed(2);
    }

    if (isNaN(calificacion)) {
      $("#totalPuntos2").val(0);
    } else {
      $("#totalPuntos2").val(calificacion);
      var x = document.getElementById("alertCapacitaciones");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }



    console.log('totalPreguntasTec: ', totalPreguntasTec);
    console.log('calf1: ', calf1);
    console.log('calf2: ', calf2);
    console.log('calif360user: ', calif360user);
    console.log('calificacion: ', calificacion);
    console.log('califpreliminarTec: ', califpreliminarTec);
  }

  function guardarRespuestas() {
    let countPuntos = 0; /* CONTADOR DE PUNTOS  */
    let countPuntosTec = 0;
    let arreglo = []; /* arreglo de respuestas */
    let arregloTec = []; /* arreglo de repuestas Tecnicas */
    let totalPreguntas = $('#totalPreguntas').val();
    let totalPreguntasTec = $('#totalPreguntasTec').val();
    let compromisos = $("#compromisos").val();
    let capacitacion = $('#capacitacion').val();
    let periodo = $('#idperiodo').val();


    /* OBTENEMOS LAS RESPUESTAS DEL CUESTIONARIO GENERAL */
    for (let i = 0; i < totalPreguntas; i++) {

      let idPregunta = $('#idp' + i).val(); /* console.log("idPregunta"+idPregunta); */
      let valorR = $('input:radio[name=pregunta' + idPregunta + ']:checked').val();
      countPuntos = parseFloat(valorR) + parseFloat(countPuntos);
      let objt = {
        idPreguntra: idPregunta,
        respuesta: valorR
      };
      arreglo.push(objt); /* console.log(valorR); */
    }

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
    let totalPuntos = countPuntos;

    /* objeto que se envia */
    let objtUser = {
      idusuario: idUsuario,

      totalpuntos: totalPuntos,
      respuestas: arreglo,
      respuestasTec: arregloTec,
      compromisos: compromisos,
      capacitacion: compromisos,
      periodo: periodo

    };
    var url = location.origin;
    var path = window.location.pathname;
    console.log(objtUser); /* RESPUESTAS DEL USUARIO  */
    $.post("config/helpers/guardarEvaluacionUsuario.php", {
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
        /* $("#respuesta").html(mensaje);*/
      });

  }
</script>