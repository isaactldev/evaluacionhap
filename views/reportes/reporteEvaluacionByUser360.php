<?php
$noBloques = 0;
$calificacionBloque = 0;


/* VALIDACION  PARA SABER SI EL USUARIO ES 360° */
if ($usuario->evalua360 == 'SI') {

  /* RECOGEMOS LA CALIFICACION DEL USUARIO EN CASO DE QUE SEA 360° */
  $userCalif360 = new calificacion360();
  /* CALIFICACION DEL PERIODO1 */
  $calif360userPeriodo1 = $userCalif360->getCalifByUser($id, $periodo1, $fecha);
  /* CALIFICACION DEL PERIODO2 */
  $calif360userPeriodo2 = $userCalif360->getCalifByUser($id, $periodo2, $fecha);
}

if (isset($calif360userPeriodo1) && $calif360userPeriodo1->idstatus == 1) {
  # code...
  $lookimprimirP1 = 0;
} else {
  $lookimprimirP1 = 2;
  $mensajeperiodo = "<center><span class='badge bg-yellow'><i class='fas fa-exclamation-triangle'></i> NO APLICO PARA EVALUAR EN EL PERIODO!</span></center>";
}
if (isset($calif360userPeriodo2) && $calif360userPeriodo2->idstatus == 1) {
  # code...
  $lookimprimirP2 = 0;
} else {
  $lookimprimirP2 = 2;
  $mensajeperiodo = "<center><span class='badge bg-yellow'><i class='fas fa-exclamation-triangle'></i> NO APLICO PARA EVALUAR EN EL PERIODO!</span></center>";
}

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col text-center">
        </div>
        <div class="col-6 col-sm-6 text-center">
          <h1 class="text-center">REPORTE DE LA EVALUACION DE COMPETENCIAS LABORALES <?= $date = date('Y'); ?> 360°</h1>
        </div>
        <div class="col col-sm-6 col-lg-3 text-center">
          <?php if ($_SESSION['identity']->rol == 'user') : ?>
            <a href="<?= baseUrl ?>?controller=evausuario&action=index" class="btn btn-primary btn-lg mt-3" role="button">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
              </svg>
              VOLVER
            </a>
          <?php else : ?>
            <a href="<?= baseUrl ?>?controller=evaluacion&action=allUsuarioStatusEvaluacion" class="btn btn-primary btn-lg mt-3" role="button">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
              </svg>
              VOLVER
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="conten">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">REPORTE DE RESULTADOS DEL COLABORADOR : <strong><?= $usuario->nombreuser . ' ' . $usuario->appaterno . ' ' . $usuario->apmaterno ?></strong></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <!-- CONTENIDO GUIA DEL EVALUADOR -->
              <div class="container-fluid">
                <div id="printReprt" class="row" width="775px">
                  <style type="text/css">
                    * {
                      font-family: calibri !important;
                      @colPrim: #003970;
                      @colAC: #679fd3;
                      @colSec: #ddd;
                      @colVerde : #03b739;
                      @colTer: #494949;
                    }

                    table {
                      border: 0px solid #ddd;
                    }

                    .pintartitulo {
                      border-top: 1px solid #e9ebee;
                      border-right: 1px solid #e9ebee;
                      border-left: 1px solid #e9ebee;
                      background-color: #e9ebee;
                      -webkit-print-color-adjust: exact;
                      font-size: 14px !important
                    }

                    .tableHap {
                      background-color: #CEDEDD !important;
                      color: #213c6d !important;
                      padding: 5px !important;
                      margin: 5px !important;
                      -webkit-print-color-adjust: exact;
                    }

                    .tblbloques {
                      background-color: #CEDEDD !important;
                      color: #213c6d !important;
                      font-size: 12px !important;
                    }

                    .tblbloquesperiodo {
                      background-color: #CEDEDD !important;
                      color: #213c6d !important;
                      font-size: 15px !important;
                      border: 2px solid #000;

                    }

                    th {
                      padding: 5px !important;
                      margin: 2px !important;

                    }

                    td {
                      border: 1px solid #ddd;
                      padding: 2px !important;
                      margin: 2px !important;
                    }

                    .txt {
                      font-size: 14px;
                    }

                    .txt2 {
                      font-size: 14px;
                      padding-left: 10px;
                      color: #213c6d;
                      padding-top: 15px;
                      display: block;
                    }

                    .line {
                      border-bottom: 1px solid #213c6d;
                    }

                    .titulo {
                      font-family: calibri;
                      font-size: 14px;
                      padding: 10px;
                      text-align: right;
                    }

                    .resaltar {
                      color: #003970;
                      font-weight: bolder;
                    }

                    .mitabla thead tr td {
                      padding: 10px;
                      /* color: #fff; */
                    }

                    .txtBlack {
                      color: #000
                    }

                    .pagebreak {
                      clear: both;
                      page-break-after: always;
                    }

                    .clear {
                      clear: both;
                    }

                    .separartabla {
                      margin-top: 50px;
                    }

                    .bt {
                      border-top: 1px solid #ddd;
                    }

                    .bb {
                      border-bottom: 1px solid #ddd;
                    }

                    .br {
                      border-right: 1px solid #ddd;
                    }

                    .bl {
                      border-left: 1px solid #ddd;
                    }

                    @media print {

                      body {
                        -webkit-print-color-adjust: exact;
                      }

                      div.saltopagina {
                        display: block;
                        page-break-before: always;
                      }

                    }
                  </style>

                  <!-- ENCABEZADO -->
                  <table width="775px" cellpadding="0" cellspacing="0" class="mitabla">
                    <thead>
                      <tr>
                        <th width="150px">
                          <img src="<?= baseUrl ?>assets/img/HAPR.png" width="120px">
                          </td>
                        <th width="400px" class="titulo" style="border-right:1px solid #003970;">
                          <span class="txtBlack">Administración del</span> <span class="resaltar">Hospital Aranda de la Parra</span><br>
                          <span class="resaltar">Hidalgo N°329 Tel. 719-71-00 León, Gto.</span><br>
                          <span class="resaltar"><small> CSL-FOR-003 | VERSION:003 | Revisión: 22/01/2024</small></span>
                        </th>
                        <th width="200px" class="titulo">
                          <b class="resaltar"><small><strong>Reporte de Evaluación al Personal</strong></small></b><br>
                          <?php
                          setlocale(LC_TIME, "spanish");
                          $fecha = strftime("%A, %d de %B de %Y");
                          ?>
                          <span class="resaltar"><?= utf8_encode($fecha) ?></span>
                        </th>
                      </tr>
                      <tr>
                        <th width="775px" colspan="4" style="border-top:1px solid #003970;">
                          <?php $year = date('Y'); ?>
                          <center> <span class="resaltar tituloformato"> REPORTE DE LA EVALUACION DE COMPETENCIAS LABORALES <?= $year ?></span> </center>
                        </th>
                      </tr>
                    </thead>
                  </table>
                  <!-- ENCABEZADOEND -->



                  <!-- CONTENIDO DEL REPORTE -->
                  <table width="775px" cellpadding="0" cellspacing="0" class="mitabla" style="margin-top: 5px;">

                    <thead id="tableHap" class="table-hap">
                      <tr class="tableHap">
                        <th id="noEmpleado" class="text-center"><strong>Cod</strong> : <?= $usuario->noempleado ?></th>
                        <th id="nombre" value="<?= $usuario->nombreuser . ' ' . $usuario->appaterno . ' ' . $usuario->apmaterno ?>"><?= $usuario->nombreuser . ' ' . $usuario->appaterno . ' ' . $usuario->apmaterno ?></th>
                        <?php $puesto = Utils::userPuesto($usuario->idpuesto); ?>
                        <th id="puesto" value="<?= $puesto->nombrepuesto ?>">PUESTO: <?= $puesto->nombrepuesto ?></th>
                        <?php $departamento = Utils::userDepartamento($usuario->iddepartamento); ?>
                        <th id="departamento" value="<?= $departamento->depnombre ?>">DEPARTAMENTO: <?= $departamento->depnombre ?></th>
                        <?php $periodo = Utils::getPeriodoActivo(); ?>
                        <th id="periodo" value="<?= $periodo->idperiodo ?>">PERIODO: <?= $periodo->idperiodo ?></th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td colspan="6" class="text-center">
                          <center><strong> RESULTADOS OBTENIDOS </strong></center>
                        </td>
                      </tr>
                      <tr>
                        <td id="tableHap" colspan="2" class="text-center tableHap"><strong>PROMEDIO GENERAL:</strong> </td>
                        <td id="calificacion" value="<?= $promf ?>" colspan="4" class="text-center" style="background-color: #003970; color: #fff; font-size: 20px;">
                          <center><strong> <?= $promf ?> </strong></center>
                        </td>
                      </tr>


                      <!-- PRIMER PERIODO -->
                      <tr>
                        <td colspan="6" class="text-center tblbloquesperiodo">
                          <center><strong> EVALUACION DEL PERIODO 1</strong></center>
                        </td>
                      </tr>
                      <tr><!-- CALIFICACION 360° -->
                        <td colspan="2" id="tableHap" class="tableHap text-center"><strong>Calificacion 360° del Periodo 1:</strong></td>
                        <td colspan="4" class="text-center">
                          <?php if ($calif360userPeriodo1->calificacion == 0) : ?>
                            <center><span class="badge bg-yellow"><i class="fas fa-exclamation-triangle"></i> FALTA DE CAPTURAR CALIFICACION 360°! </br><small>PORFAVOR SOLICITA QUE LA CAPTUREN!</small></span></center>
                          <?php else : ?>
                            <center><strong> <?= $calif360userPeriodo1->calificacion ?> </strong></center>
                          <?php endif ?>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2" id="tableHap" class="tblbloques" style="background-color:rgba(255 ,255, 0, 0.6) !important;">
                          <center><strong>CALIFICACION POR CAPACITACIONES PERIODO 1</strong></center>
                        </td>
                        <td colspan="4" class="text-center fs-6">
                          <center><strong> <?= $califCapP1; ?> </strong></center>
                        </td>
                      </tr>

                      <tr>
                        <td id="tableHap" class="tableHap text-center" colspan="2">
                          <strong> Calificación competencias Tecnicas: </strong>
                        </td>
                        <?php

                        if ($califtecCap360Periodo1 < 0) {
                          $califtecCap360Periodo1 =  0;
                        }

                        ?>
                        <td colspan="4" class="text-center">
                          <center><strong><?= $califtecCap360Periodo1 ?></strong></center>
                        </td>
                      </tr>
                      <!-- /PRIMER PERIODO -->



                      <!-- SEGUNDO PERIODO -->
                      <tr>
                        <td colspan="6" class="text-center tblbloquesperiodo">
                          <center><strong> EVALUACION DEL PERIODO 2</strong></center>
                        </td>
                      </tr>
                      <tr><!-- CALIFICACION 360° -->
                        <td colspan="2" id="tableHap" class="tableHap text-center"><strong>Calificacion 360° del Periodo 2:</strong></td>
                        <td colspan="4" class="text-center">
                          <?php if ($calif360userPeriodo2->calificacion == 0) : ?>
                            <center><span class="badge bg-yellow"><i class="fas fa-exclamation-triangle"></i> FALTA DE CAPTURAR CALIFICACION 360°! </br><small>PORFAVOR SOLICITA QUE LA CAPTUREN!</small></span></center>
                          <?php else : ?>
                            <center><strong> <?= $calif360userPeriodo2->calificacion ?> </strong></center>
                          <?php endif ?>
                        </td>
                      </tr>

                      <!-- CALIFICACIONES POR CAPACITACIONES -->
                      <tr>
                        <td colspan="2" id="tableHap" class="tblbloques" style="background-color:rgba(255 ,255, 0, 0.6) !important;">
                          <center><strong>CALIFICACION POR CAPACITACIONES PERIODO 2</strong></center>
                        </td>
                        <td colspan="4" class="text-center fs-6">
                          <center><strong> <?= $califCapP2; ?> </strong></center>
                        </td>
                      </tr>

                      <tr>
                        <td id="tableHap" class="tableHap text-center" colspan="2">
                          <strong> Calificación competencias Tecnicas: </strong>
                        </td>
                        <td colspan="4" class="text-center">
                          <?php

                          if ($califtecCap360Periodo2 < 0) {
                            $califtecCap360Periodo2 =  0;
                          }

                          ?>
                          <center><strong><?= $califtecCap360Periodo2 ?> </strong></center>
                        </td>
                      </tr>

                      <input type="hidden" id="totalBloques" value="<?= $noBloques ?>">

                    </tbody>
                  </table>

                  <table width="775px" cellpadding="0" cellspacing="0" class="mitabla" style="margin-top: 5px;">
                    <!-- <table class="mitabla" cellpadding="0" cellspacing="0" style="float: left;" width="100%"> -->
                    <thead id="tableHap" class="table-hap">
                      <tr class="tableHap">
                        <th id="tableHap" class="text-center tblbloques">
                          <center><strong>COMPROMISOS</strong></center>
                        </th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php $compromisos = Utils::getCompromisoUsersReport($usuario->idusuario) ?>
                      <?php while ($comprmiso = $compromisos->fetch_object()) : ?>
                        <tr>
                          <td class="text-center">
                            <center><?= $comprmiso->compromiso ?></center>
                          </td>
                        </tr>
                      <?php endwhile; ?>

                    </tbody>
                  </table>




                  <table width="775px" cellpadding="0" cellspacing="0" class="mitabla" style="margin-top: 5px;">
                    <thead id="tableHap" class="table-hap">
                      <tr>
                        <th id="tableHap" class="text-center tblbloques">
                          <center><strong>CAPACITACIONES</strong></center>
                        </th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php $capacitaciones = Utils::getCapacitacionReport($usuario->idusuario) ?>
                      <?php while ($capacitacion = $capacitaciones->fetch_object()) : ?>
                        <tr>
                          <td class="text-center ">
                            <center><?= $capacitacion->nececitacapacitacion ?></center>
                          </td>
                        </tr>
                      <?php endwhile; ?>

                    </tbody>
                  </table>

                  <div style="text-align:center; margin: 20px;">
                    <h5>RECONOZCO Y ACEPTO RETROALIMENTACIÓN SOBRE MIS RESULTADOS OBTENIDOS</h5>
                  </div>

                  <table width="775px" cellpadding="0" cellspacing="0" class="mitabla" style="margin-top: 5px;">
                    <thead>
                      <tr>
                        <?php $nombreEvaluador = Utils::getNombreEvaluador($usuario->idevaluadopor) ?>
                        <th>EVALUADOR <p><?= $nombreEvaluador->nombreuser . ' ' . $nombreEvaluador->appaterno . ' ' . $nombreEvaluador->apmaterno ?></p>
                        </th>
                        <th>EVALUADO <p><?= $usuario->nombreuser . ' ' . $usuario->appaterno . ' ' . $usuario->apmaterno ?></p>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th><br>
                          <hr width="60%">
                        </th>
                        <th><br>
                          <hr width="60%">
                        </th>
                      </tr>
                    </tbody>
                  </table>

                  <!-- END CONTENIDO -->
                </div>
                <div class="row">
                  <div class="d-grid gap-2 d-md-flex mt-3 mb-2 justify-content-md-end">
                    <?php if ($lookimprimirP1 == 2 && $lookimprimirP2 == 2) : ?>
                      <button href="#" class="btn btn-primary me-md-2" onclick="alertcalificacion();"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                          <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                          <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                        </svg> Imprimir reporte </button>
                    <?php else : ?>
                      <button href="#" class="btn btn-primary me-md-2" onclick="javascript:imprim1(printReprt);"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                          <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                          <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                        </svg> Imprimir reporte </button>
                    <?php endif ?>

                  </div>
                </div>
              </div>

              <!-- /.card -->
            </div>
          </div>
        </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  function imprim1(printReprt) {
    var printContents = document.getElementById('printReprt').innerHTML;
    w = window.open();
    w.document.write(printContents);
    w.document.close(); // necessary for IE >= 10
    w.focus(); // necessary for IE >= 10
    w.print();
    w.close();
    return true;
  }
</script>

<?php
if ($_SESSION['identity']->rol == 'admin') {
?>
  <script>
    function alertcalificacion() {

      var url = location.origin;
      var path = window.location.pathname;
      Swal.fire({
        icon: 'error',
        confirmButtonColor: '#213c6d',
        title: 'FALTA LA CALIFICACION 360°!',
        text: 'No puedes Imprimir este Reporte sin Calificacion 360° SOLICITA SU CAPTURA!',
      })
      setTimeout(function() {
        window.location.href = url + path + "?controller=evaluacion&action=allUsuarioStatusEvaluacion";
      }, 2250);
    }
  </script>

<?php
} else {
?>
  <script>
    function alertcalificacion() {

      var url = location.origin;
      var path = window.location.pathname;
      Swal.fire({
        icon: 'error',
        confirmButtonColor: '#213c6d',
        title: 'FALTA LA CALIFICACION 360°!',
        text: 'No puedes Imprimir este Reporte sin Calificacion 360° SOLICITA SU CAPTURA!',
      })
      setTimeout(function() {
        window.location.href = url + path + "?controller=evausuario&action=index";
      }, 2250);
    }
  </script>
<?php
}

?>