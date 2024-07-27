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
        <div class="col-sm-12 text-center">
          <h1>EVALUACIÓN DEL DESEMPEÑO 360° <?php echo $date = date("Y"); ?> - PERSONAL OPERATIVO </h1>
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
                      <label for="formGroupExampleInput" class="form-label">No°Empleado Evaluador</label>
                      <input type="hidden" class="form-control" id="periodoActivo" name="periodoActivo" value="<?= $periodoActivo->idperiodo ?>">
                      <input type="text" step=".01" class="form-control form-control-border" id="noEmpleadoEvaluador" name="noEmpleadoEvaluador" value="<?= $userEvaluador360->noempleado ?>">
                    </div>


                    <div class="col-12 mb-3">
                      <label for="formGroupExampleInput" class="form-label">No°Empleado Evaluado</label>
                      <input type="text" step=".01" class="form-control form-control-border" id="noEmpleadoEvaluado" name="noEmpleadoEvaluado" value="<?= $userEvaluado360->noempleado ?>">
                    </div>

                  </div>

                  <div class="col-4">

                    <div class="col-12 mb-3">
                      <label for="formGroupExampleInput" class="form-label">Nombre del Evaluador</label>
                      <input type="text" step=".01" class="form-control form-control-border" id="userEvaluador" name="userEvaluador" value="<?= $userEvaluador360->nombreuser . ' ' . $userEvaluador360->appaterno . ' ' . $userEvaluador360->apmaterno ?>">
                    </div>

                    <div class="col-12 mb-3">
                      <label for="formGroupExampleInput" class="form-label">Nombre del Evaluado 360°</label>
                      <input type="text" step=".01" class="form-control form-control-border" id="userEvaluado" name="userEvaluado" value="<?= $userEvaluado360->nombreuser . ' ' . $userEvaluado360->appaterno . ' ' . $userEvaluado360->apmaterno ?>">
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="col-12 mb-3">
                      <?php $puestoEvaluador = Utils::userPuesto($userEvaluador360->idpuesto); ?>
                      <label for="formGroupExampleInput" class="form-label">Puesto de Evaluador</label>
                      <input type="text" step=".01" class="form-control form-control-border" id="idpuesto" name="puestoEvaluador" value="<?= $puestoEvaluador->nombrepuesto ?>">
                    </div>
                    <div class="col-12 mb-3">
                      <?php $puestoEvaluado360 = Utils::userPuesto($userEvaluado360->idpuesto); ?>
                      <label for="formGroupExampleInput" class="form-label">Puesto del Evaluado 360°</label>
                      <input type="text" step=".01" class="form-control form-control-border" id="idpuesto" name="puestoEvaluador" value="<?= $puestoEvaluado360->nombrepuesto ?>">
                    </div>
                  </div>
                </div>
              </div>


              <center>
                <div class="col-md-12 fs-2 mt-5 mb-5">
                  <blockquote style="border-left: 5px solid #0080c0; margin-top: -15px;" class="heartbeat-button">
                    <h1 style="color: #000;"><strong>Instrucciones: </strong> ¡Recuerda tienes un tiempo limite aproximado de 20min para contestar la Evaluacion!</h1>
                  </blockquote>
                </div>
              </center>



              <h1 class="text-center mb-3"> HOSPITAL ARANDA DE LA PARRA EVALUACIÓN 360° <a href="#" class="btn btn-primary me-md-3" onclick="guiaPDF360();"><i class="fas fa-file-pdf fa-3x"></i> <samp style="font-size: 20px ;"> Guia de Evaluacion</samp></a> </h1>
              <script type="text/javascript">
                function guiaPDF360() {
                  var url = location.origin;
                  var path = window.location.pathname;

                  var URL = url + path + "/PDF/Guíaparámetrosevaluación360.pdf";
                  window.open(URL, "Guia de Evaluacion 360", "width=830,height=500,scrollbars=YES,location=no, menubar=no, scrollbars=YES, status=no, toolbar=no, resizable=no");

                }
              </script>

              <hr>



              <div class="row text-center">
                <?php
                $periodo =  Utils::getPeriodoActivo();
                $fecha = date('Y'); ?>
                <h3><span class=""> <?= $periodo->idperiodo ?>do. Periodo <?= $fecha ?></span></h3>



                <table id="examen" class="table table-hover table-bordered  align-middle mb-6" style="width:100%">
                  <thead>
                    <tr>
                      <th colspan="6" class="bg-warning p-2 text-dark bg-opacity-50"><?= $userEvaluado360->nombreuser . ' ' . $userEvaluado360->appaterno . ' ' . $userEvaluado360->apmaterno ?></th>
                    </tr>



                    <tr>
                      <th scope="col">Bloque</th>
                      <th scope="col">Competencia</th>
                      <th scope="col">Ponderación</th>
                    </tr>

                  </thead>
                  <tbody>

                    <?php while ($bloque360 = $bloques360->fetch_object()) : ?>
                      <tr class="border border-dark border-bottom-2">
                        <?php
                        $rowspantotal = Utils::getcountPreguntaXbloque($bloque360->idbloqueCompeGen360);
                        $rowspan = $rowspantotal->totalPreguntasBloque + 1;
                        ?>
                        <td rowspan="<?= $rowspan ?>" class="align-middle border border-dark border-bottom-2" style="background-color: #E7E6E6; "><strong><?= $bloque360->namebloque360 ?></strong></td>
                      </tr>

                      <?php
                      $allpreguntas =  Utils::getAllPreguntasEncuesta360ByBloque($bloque360->idbloqueCompeGen360);
                      $i = 0;
                      ?>

                      <?php while ($pregunta = $allpreguntas->fetch_object()) : ?>



                        <?php
                        $countt++;

                        ?>
                        <tr>
                          <td><?= $pregunta->idcuestionarioeva360 ?> - <?= $pregunta->pregunta360 ?></td>
                          <td>
                            <div>
                              <input type="hidden" id="idpregunta<?= $k ?>" value="<?= $pregunta->idcuestionarioeva360 ?>">
                              <input type="hidden" name="bloque" id="bloqueNo<?= $b ?>" value="<?= $bloque360->idbloqueCompeGen360 ?>">
                              <input type="number" class="form-control text-center" name="respuesta<?= $pregunta->idcuestionarioeva360 ?>" id="respuesta<?= $pregunta->idcuestionarioeva360 ?>" min="1" max="10" step="1" pattern="[0-9]" onpaste="return false;" onDrop="return false;" autocomplete="off">
                              <?php $i++; ?>
                            </div>
                          </td>
                        </tr>
                        <?php $k++; ?>
                        <?php $b++; ?>

                        <script type="text/javascript">
                          $('#respuesta<?= $pregunta->idcuestionarioeva360 ?>').numeric(",");
                        </script>
                      <?php endwhile; ?>




                    <?php endwhile; ?>
                  </tbody>
                  <input type="hidden" id="totalPreguntas" value="<?= $k ?>">
                </table>
              </div>


              <hr>

              <div class="row">
                <div class="d-grid gap-2 d-md-flex mt-3 mb-2 justify-content-md-end">
                  <strong>Puntuacion: </strong> <input type="text" class="form-control col-1 text-center" id="totalPuntos2" name="puntaje" value="0">
                  <button class="btn btn-primary me-md-2" type="button" onclick="countPuntos();"><i class="fas fa-spell-check"></i> Ver Calificacion </button>
                  <button class="btn btn-primary me-md-2" type="button" onclick="guardarRespuestas();"><i class="fa fa-fw fa-plus-square"></i> Guardar Evaluacion </button>
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
  function countPuntos() {

    let countPuntosTec = 0; /* CONTADOR DE PUNTOS  */
    let arregloTec = [];
    let totalPreguntas = $('#totalPreguntas').val();
    let periodoActivo = $('#periodoActivo').val();
    let noEvaluador = $('#noEmpleadoEvaluador').val();
    let noEvaluado = $('#noEmpleadoEvaluado').val();



    for (let i = 0; i < totalPreguntas; i++) {
      let idBloque = $('#bloqueNo' + i).val();
      let idPregunta = $('#idpregunta' + i).val();
      let valorRespuesta = $('#respuesta' + idPregunta).val();



      /* VALIDACION PARA CAMPOS EN 0 BNMEXML */
      if (isNaN(valorRespuesta) || valorRespuesta == 0 || valorRespuesta <= 0) {
        Swal.fire({
          icon: 'warning',
          confirmButtonColor: '#213c6d',
          title: 'DEBES RESPONDER TODAS LAS PREGUNTAS!',
          text: 'La Pregunta ' + idPregunta + ' no las has Respondido porfavor verificalo!',
        })
        setTimeout(function() {}, 1150);
      }


      /* VALIDACION PARA CAMPOS CON UN VALOR MAYOR A 10 */
      if (valorRespuesta > 10) {
        Swal.fire({
          icon: 'warning',
          confirmButtonColor: '#213c6d',
          title: 'Revisa la Pregunta ' + idPregunta + '!',
          text: 'La pregunta ' + idPregunta + ' cuenta con un valor mayor a 10!',
        })
        setTimeout(function() {}, 1150);
      }

      countPuntosTec = parseFloat(valorRespuesta) + parseFloat(countPuntosTec);

      let objtec = {
        idBloque: idBloque,
        idPregunta: idPregunta,
        valorRespuesta: valorRespuesta
      };
      arregloTec.push(objtec);
    }

    let totalPuntos = countPuntosTec;
    let promedioFinal = totalPuntos / totalPreguntas;
    let promedioFinal360 = promedioFinal.toFixed(2);

    console.log('objtec: ', arregloTec);
    console.log('totalPreguntas: ', totalPreguntas);
    console.log('totalPuntos: ', totalPuntos);
    console.log('promedioFinal: ', promedioFinal);
    console.log('promedioFinal: ', promedioFinal360);


    if (isNaN(promedioFinal)) {
      Swal.fire({
        icon: 'warning',
        confirmButtonColor: '#213c6d',
        title: 'Sin valores para Capturar!',
        text: 'Algunas preguntas no tienen Respuesta!',
      })
      setTimeout(function() {}, 1150);
      $("#totalPuntos2").val(0);
    }
    $("#totalPuntos2").val(promedioFinal.toFixed(2));

    let objtUser = {
      respuestas360: arregloTec,
      periodoActivo: periodoActivo,
      noEvaluador: noEvaluador,
      noEvaluado: noEvaluado,
      promedioFinal360: promedioFinal360
    };
    console.log(objtUser);

  }


  function guardarRespuestas() {
    let countPuntosTec = 0; /* CONTADOR DE PUNTOS  */
    let arregloTec = [];
    let totalPreguntas = $('#totalPreguntas').val();
    let periodoActivo = $('#periodoActivo').val();
    let noEvaluador = $('#noEmpleadoEvaluador').val();
    let noEvaluado = $('#noEmpleadoEvaluado').val();

    let save = true;

    for (let i = 0; i < totalPreguntas; i++) {
      let idBloque = $('#bloqueNo' + i).val();
      let idPregunta = $('#idpregunta' + i).val();
      let valorRespuesta = $('#respuesta' + idPregunta).val();



      /* VALIDACION PARA CAMPOS EN 0  */
      if (isNaN(valorRespuesta) || valorRespuesta == 0 || valorRespuesta <= 0) {
        Swal.fire({
          icon: 'warning',
          confirmButtonColor: '#213c6d',
          title: 'DEBES RESPONDER TODAS LAS PREGUNTAS!',
          text: 'La Pregunta ' + idPregunta + ' no las has Respondido porfavor verificalo!',
        })
        setTimeout(function() {}, 1150);
        save = false;
      }

      /* VALIDACION PARA CAMPOS CON UN VALOR MAYOR A 10 */
      if (valorRespuesta > 10) {
        Swal.fire({
          icon: 'warning',
          confirmButtonColor: '#213c6d',
          title: 'Revisa la Pregunta ' + idPregunta + '!',
          text: 'La pregunta ' + idPregunta + ' cuenta con un valor mayor a 10!',
        })
        setTimeout(function() {}, 1150);
        save = false;
      }

      countPuntosTec = parseFloat(valorRespuesta) + parseFloat(countPuntosTec);

      let objtec = {
        idBloque: idBloque,
        idPregunta: idPregunta,
        valorRespuesta: valorRespuesta
      };
      arregloTec.push(objtec);
    }

    let totalPuntos = countPuntosTec;
    let promedioFinal = totalPuntos / totalPreguntas;

    let promedioFinal360 = promedioFinal.toFixed(2);

    /* console.log('objtec: ', arregloTec);
    console.log('totalPreguntas: ',totalPreguntas);
    console.log('totalPuntos: ', totalPuntos);
    console.log('promedioFinal: ',promedioFinal);
    console.log('promedioFinal: ',promedioFinal.toFixed(2)); */


    if (isNaN(promedioFinal)) {
      Swal.fire({
        icon: 'warning',
        confirmButtonColor: '#213c6d',
        title: 'Sin valores para Capturar!',
        text: 'Algunas preguntas no tienen Respuesta!',
      })
      setTimeout(function() {}, 1150);
      $("#totalPuntos2").val(0);
      save = false;
    }
    $("#totalPuntos2").val(promedioFinal.toFixed(2));


    /* objeto que se envia */
    let objtUser = {
      respuestas360: arregloTec,
      periodoActivo: periodoActivo,
      noEvaluador: noEvaluador,
      noEvaluado: noEvaluado,
      totalPreguntas: totalPreguntas,
      promedioFinal360: promedioFinal360
    };

    var url = location.origin;
    var path = window.location.pathname;

    if (save == false) {

      Swal.fire({
        icon: 'warning',
        confirmButtonColor: '#213c6d',
        title: 'VERIFICA LA LAS PONDERACIONES ANTES DE GUARDAR!',
        text: 'Una de las preguntas no se ha contestado Correctamente!',
      })
      setTimeout(function() {}, 1150);
      console.log(statusresTec2);
      console.log("FALTAN PREGUNTAS POR CONTESTAR");

    } else {

      console.log(objtUser);
      $.post("config/helpers/guardarEva360oficial.php", {
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
        });
    }



  }
</script>