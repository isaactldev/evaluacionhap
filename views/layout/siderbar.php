<!-- Main Sidebar Container -->
<?php
date_default_timezone_set('America/Mexico_City');
$yearActual = date('Y');
$periodoreportActivo =  Utils::getPeriodoActivo();
?>
<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="<?= baseUrl ?>assets/img/HAPR.png" alt="" class="w-100 p-3">
    <span class="brand-text font-weight-light"></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="" class="img-circle elevation-2">
      </div>
      <div class="info text-center">
        <a href="#" class="d-block">SISTEMA DE EVALUACION <br><b> AL PERSONAL</b></a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <?php if ($_SESSION['admin']) : ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Encuestas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= baseUrl ?>?controller=evaluacion&action=allUsuarioStatusEvaluacion" class="nav-link active">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18px" viewBox="0 0 448 512">
                    <path d="M448 336v-288C448 21.49 426.5 0 400 0H96C42.98 0 0 42.98 0 96v320c0 53.02 42.98 96 96 96h320c17.67 0 32-14.33 32-31.1c0-11.72-6.607-21.52-16-27.1v-81.36C441.8 362.8 448 350.2 448 336zM143.1 128h192C344.8 128 352 135.2 352 144C352 152.8 344.8 160 336 160H143.1C135.2 160 128 152.8 128 144C128 135.2 135.2 128 143.1 128zM143.1 192h192C344.8 192 352 199.2 352 208C352 216.8 344.8 224 336 224H143.1C135.2 224 128 216.8 128 208C128 199.2 135.2 192 143.1 192zM384 448H96c-17.67 0-32-14.33-32-32c0-17.67 14.33-32 32-32h288V448z" />
                  </svg>
                  <p>Evaluaciones del Personal</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= baseUrl ?>?controller=evaluacion&action=tipoEvaluacion" class="nav-link">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18px" viewBox="0 0 384 512">
                    <path d="M336 64h-53.88C268.9 26.8 233.7 0 192 0S115.1 26.8 101.9 64H48C21.5 64 0 85.48 0 112v352C0 490.5 21.5 512 48 512h288c26.5 0 48-21.48 48-48v-352C384 85.48 362.5 64 336 64zM96 392c-13.25 0-24-10.75-24-24S82.75 344 96 344s24 10.75 24 24S109.3 392 96 392zM96 296c-13.25 0-24-10.75-24-24S82.75 248 96 248S120 258.8 120 272S109.3 296 96 296zM192 64c17.67 0 32 14.33 32 32c0 17.67-14.33 32-32 32S160 113.7 160 96C160 78.33 174.3 64 192 64zM304 384h-128C167.2 384 160 376.8 160 368C160 359.2 167.2 352 176 352h128c8.801 0 16 7.199 16 16C320 376.8 312.8 384 304 384zM304 288h-128C167.2 288 160 280.8 160 272C160 263.2 167.2 256 176 256h128C312.8 256 320 263.2 320 272C320 280.8 312.8 288 304 288z" />
                  </svg>
                  <p>Tipo de Evaluaciones</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= baseUrl ?>?controller=bloquecompetencias&action=index" class="nav-link">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18px" viewBox="0 0 512 512">
                    <path d="M234.5 5.709C248.4 .7377 263.6 .7377 277.5 5.709L469.5 74.28C494.1 83.38 512 107.5 512 134.6V377.4C512 404.5 494.1 428.6 469.5 437.7L277.5 506.3C263.6 511.3 248.4 511.3 234.5 506.3L42.47 437.7C17 428.6 0 404.5 0 377.4V134.6C0 107.5 17 83.38 42.47 74.28L234.5 5.709zM256 65.98L82.34 128L256 190L429.7 128L256 65.98zM288 434.6L448 377.4V189.4L288 246.6V434.6z" />
                  </svg>
                  <p>Bloque de Competencia</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="" data-bs-toggle="modal" data-bs-target="#actualizaPeriodo" class="nav-link">
                  <i class="fas fa-calendar-check"></i>
                  <p>Control de Periodo</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="" data-bs-toggle="modal" data-bs-target="#cardexhap" class="nav-link">
                  <i class="fas fa-folder-open"></i>
                  <p>Cardex de Calificaciones</p>
                </a>
              </li>


            </ul>
          <?php endif; ?>
          </li>
          <?php if ($_SESSION['admin']) : ?>
            <li class="nav-header">USUARIOS</li>
            <li class="nav-item">
              <a class="nav-link">
                <i class="far fa-user"></i>
                <p>Personal HAP</p>
                <i class="right fas fa-angle-left"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= baseUrl ?>?controller=usuario&action=index" class="nav-link">
                    <i class="fa fa-fw fa-user-plus"></i>
                    <p>Alta Personal</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php endif; ?>
          <?php if ($_SESSION['admin']) : ?>
            <li class="nav-header">DEPARTAMENTOS</li>
            <li class="nav-item">
              <a href="<?= baseUrl ?>?controller=departamento&action=index" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="18px" viewBox="0 0 512 512">
                  <path d="M320 336c0 8.844-7.156 16-16 16h-96C199.2 352 192 344.8 192 336V288H0v144C0 457.6 22.41 480 48 480h416c25.59 0 48-22.41 48-48V288h-192V336zM464 96H384V48C384 22.41 361.6 0 336 0h-160C150.4 0 128 22.41 128 48V96H48C22.41 96 0 118.4 0 144V256h512V144C512 118.4 489.6 96 464 96zM336 96h-160V48h160V96z" />
                </svg>
                <p>Control Departamento</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= baseUrl ?>?controller=puesto&action=index" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="18px" viewBox="0 0 640 512">
                  <path d="M192 96C192 113.7 206.3 128 224 128H320V192H288C243.8 192 208 227.8 208 272V384C187.1 384 169.3 397.4 162.7 416H48C21.49 416 0 394.5 0 368V48C0 21.49 21.49 0 48 0H192V96zM240 272C240 245.5 261.5 224 288 224H544C570.5 224 592 245.5 592 272V416H624C632.8 416 640 423.2 640 432V448C640 483.3 611.3 512 576 512H256C220.7 512 192 483.3 192 448V432C192 423.2 199.2 416 208 416H240V272zM304 288V416H528V288H304zM320 96H224V0L320 96z" />
                </svg>
                <p>Control Puestos</p>
              </a>
            </li>
          <?php endif; ?>

          <?php if ($_SESSION['identity']->rol == 'admin' || $_SESSION['identity']->rol == 'user') : ?>
            <li class="nav-header"><strong>MIS EVALUACIONES</strong></li>
            <li class="nav-item">
              <a href="<?= baseUrl ?>?controller=evausuario&action=index" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="18px" viewBox="0 0 512 512">
                  <path d="M152.1 38.16C161.9 47.03 162.7 62.2 153.8 72.06L81.84 152.1C77.43 156.9 71.21 159.8 64.63 159.1C58.05 160.2 51.69 157.6 47.03 152.1L7.029 112.1C-2.343 103.6-2.343 88.4 7.029 79.03C16.4 69.66 31.6 69.66 40.97 79.03L63.08 101.1L118.2 39.94C127 30.09 142.2 29.29 152.1 38.16V38.16zM152.1 198.2C161.9 207 162.7 222.2 153.8 232.1L81.84 312.1C77.43 316.9 71.21 319.8 64.63 319.1C58.05 320.2 51.69 317.6 47.03 312.1L7.029 272.1C-2.343 263.6-2.343 248.4 7.029 239C16.4 229.7 31.6 229.7 40.97 239L63.08 261.1L118.2 199.9C127 190.1 142.2 189.3 152.1 198.2V198.2zM224 96C224 78.33 238.3 64 256 64H480C497.7 64 512 78.33 512 96C512 113.7 497.7 128 480 128H256C238.3 128 224 113.7 224 96V96zM224 256C224 238.3 238.3 224 256 224H480C497.7 224 512 238.3 512 256C512 273.7 497.7 288 480 288H256C238.3 288 224 273.7 224 256zM160 416C160 398.3 174.3 384 192 384H480C497.7 384 512 398.3 512 416C512 433.7 497.7 448 480 448H192C174.3 448 160 433.7 160 416zM0 416C0 389.5 21.49 368 48 368C74.51 368 96 389.5 96 416C96 442.5 74.51 464 48 464C21.49 464 0 442.5 0 416z" />
                </svg>
                <p>Realizar Evaluacion</p>
              </a>
            </li>

            <?php
            // PERSONAL 360 QUE YA SE ECUENTRAN EVALUADOS
            $db360 = dataBase::conexion();
            $sqlexistUserEvaluador360 = "SELECT * FROM personal360 WHERE idevaluador = {$_SESSION['identity']->noempleado} AND periodo =  {$periodoreportActivo->idperiodo} AND statuseva360 = 2 AND fecha = {$yearActual};";
            $existUserEvaluador360 = mysqli_query($db360, $sqlexistUserEvaluador360);
            ?>

            <!--  SE MUESTRAN LAS EVALUACIONES PENDIENTES -->
            <?php if (mysqli_num_rows($existUserEvaluador360) > 0) : ?>
              <li class="nav-item">
                <a class="nav-link">
                  <i class="fas fa-street-view"></i>
                  <p>Evaluaciones 360° </p>
                  <i class="right fas fa-angle-left"></i>
                </a>
                <ul class="nav nav-treeview">

                  <?php while ($evaluado  = $existUserEvaluador360->fetch_object()) : ?>
                    <li class="nav-item">
                      <a href="<?= baseUrl ?>?controller=evaluacionpersonal360&action=iniciaEvaluacionA360&noEvaluador=<?= $_SESSION['identity']->noempleado ?>&noEvaluado=<?= $evaluado->idevaluado ?>" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" viewBox="0 0 576 512">
                          <path d="M172.1 40.16L268.1 3.76C280.9-1.089 295.1-1.089 307.9 3.76L403.9 40.16C425.6 48.41 440 69.25 440 92.52V204.7C441.3 205.1 442.6 205.5 443.9 205.1L539.9 242.4C561.6 250.6 576 271.5 576 294.7V413.9C576 436.1 562.9 456.2 542.5 465.1L446.5 507.3C432.2 513.7 415.8 513.7 401.5 507.3L288 457.5L174.5 507.3C160.2 513.7 143.8 513.7 129.5 507.3L33.46 465.1C13.13 456.2 0 436.1 0 413.9V294.7C0 271.5 14.39 250.6 36.15 242.4L132.1 205.1C133.4 205.5 134.7 205.1 136 204.7V92.52C136 69.25 150.4 48.41 172.1 40.16V40.16zM290.8 48.64C289 47.95 286.1 47.95 285.2 48.64L206.8 78.35L287.1 109.5L369.2 78.35L290.8 48.64zM392 210.6V121L309.6 152.6V241.8L392 210.6zM154.8 250.9C153 250.2 150.1 250.2 149.2 250.9L70.81 280.6L152 311.7L233.2 280.6L154.8 250.9zM173.6 455.3L256 419.1V323.2L173.6 354.8V455.3zM342.8 280.6L424 311.7L505.2 280.6L426.8 250.9C425 250.2 422.1 250.2 421.2 250.9L342.8 280.6zM528 413.9V323.2L445.6 354.8V455.3L523.2 421.2C526.1 419.9 528 417.1 528 413.9V413.9z" />
                        </svg>
                        <?php $nombreEvaluado360 =  Utils::UserByNoEmpleado($evaluado->idevaluado) ?>
                        <p style="font-size: 12px;">EVALUAR A <?= $nombreEvaluado360->nombreuser ?></p>
                      </a>
                    </li>
                  <?php endwhile; ?>

                </ul>
              </li>
            <?php else : ?>

            <?php endif; ?>
          <?php endif; ?>




          <!-- REPORTE  PERSONAL JEFE DIRECTO 360-->
          <?php if ($_SESSION['identity']->rol == 'admin' || $_SESSION['identity']->rol == 'user') : ?>
            <?php
            //REPORTES 360LIBERADOS ESTATUS 1 LIBERADO | ESTATUS 2 SIN EVALUAR
            $periodoreportActivo =  Utils::getPeriodoActivo();
            $reportes360Liberados =  Utils::reportesliberadosByEvaluadorPeriodo($_SESSION['identity']->noempleado, $periodoreportActivo->idperiodo);

            /* echo "<pre>";
            var_dump($reportes360Liberados);
            echo "</pre>"; */
            ?>
            <?php if (!empty($reportes360Liberados)) : ?>
              <li class="nav-header"><strong>REPORTES DE EVALUACIÓN 360°</strong></li>
              <li class="nav-item">
                <a class="nav-link" onclick="alertReportes360();">
                  <i class="fas fa-tachometer-alt"></i>
                  <p>Reportes 360°</p>
                  <i class="right fas fa-angle-left"></i>
                </a>
                <ul class="nav nav-treeview">

                  <?php foreach ($reportes360Liberados as $repLiberado360) : ?>
                    <li class="nav-item">
                      <?php $periodo =  Utils::getPeriodoActivo(); ?>
                      <!-- REPORTES LIBERADOS -->
                      <a href="#" onclick="ventana(<?= $repLiberado360->noempleado ?>,<?= $periodo->idperiodo ?>);" class="nav-link">
                        <i class="fas fa-file-invoice"></i>
                        <?php $nombreEvaluado360 =  Utils::UserByNoEmpleado($repLiberado360->noempleado) ?>
                        <p style="font-size: 12px;">REPORTE DE <?= $nombreEvaluado360->nombreuser ?></p>
                      </a>

                      <script>
                        function ventana(noEmpleado360, periodo) {
                          var url = location.origin;
                          var path = window.location.pathname;

                          var URL = url + path + "views/evaluacionesUsuarios360/reportecalif360.php?noEmpleado360=" + noEmpleado360 + "&periodo=" + periodo;
                          ventana = window.open(URL, "ventana1", "width=830,height=500,scrollbars=YES,location=no, menubar=no, scrollbars=YES, status=no, toolbar=no, resizable=no");
                          return ventana;
                        }
                      </script>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </li>
            <?php endif; ?>

            <!-- ESTO SE MUESTRA CUANDO AUN NO  -->
            <?php if (mysqli_num_rows($existUserEvaluador360) > 0) : ?>
              <li class="nav-header"><strong>REPORTES DE EVALUACIÓN 360°</strong></li>
              <li class="nav-item">
                <a class="nav-link" onclick="alertReportes360();">
                  <i class=" fas fa-tachometer-alt"></i>
                  <p>Reportes 360°</p>
                  <i class="right fas fa-angle-left"></i>
                </a>
                <ul class="nav nav-treeview">

                  <?php while ($evaluado  = $existUserEvaluador360->fetch_object()) : ?>
                    <li class="nav-item">
                      <?php $periodo =  Utils::getPeriodoActivo(); ?>
                      <a href="#" onclick="ventana(<?= $evaluado->idevaluado ?>,<?= $periodo->idperiodo ?>);" class="nav-link">
                        <i class="fas fa-file-invoice"></i>
                        <?php $nombreEvaluado360 =  Utils::UserByNoEmpleado($evaluado->idevaluado) ?>
                        <p style="font-size: 12px;">REPORTE DE <?= $nombreEvaluado360->nombreuser ?></p>
                      </a>

                      <script>
                        function ventana(noEmpleado360, periodo) {
                          var url = location.origin;
                          var path = window.location.pathname;

                          var URL = url + path + "views/evaluacionesUsuarios360/reportecalif360.php?noEmpleado360=" + noEmpleado360 + "&periodo=" + periodo;
                          ventana = window.open(URL, "ventana1", "width=830,height=500,scrollbars=YES,location=no, menubar=no, scrollbars=YES, status=no, toolbar=no, resizable=no");
                          return ventana;
                        }
                      </script>
                    </li>
                  <?php endwhile; ?>

                </ul>
              </li>

            <?php endif; ?>
          <?php endif; ?>
          <!-- /REPORTE  PERSONAL JEFE DIRECTO 360-->

          <?php if ($_SESSION['identity']->rol == 'admin') : ?>
            <li class="nav-header"><strong>EVALUACIONES 360°</strong></li>
            <li class="nav-item">
              <a class="nav-link">
                <i class="far fa-user"></i>
                <p>Evaluacion 360°</p>
                <i class="right fas fa-angle-left"></i>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="<?= baseUrl ?>?controller=calif360user&action=index" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18px" viewBox="0 0 576 512">
                      <path d="M172.1 40.16L268.1 3.76C280.9-1.089 295.1-1.089 307.9 3.76L403.9 40.16C425.6 48.41 440 69.25 440 92.52V204.7C441.3 205.1 442.6 205.5 443.9 205.1L539.9 242.4C561.6 250.6 576 271.5 576 294.7V413.9C576 436.1 562.9 456.2 542.5 465.1L446.5 507.3C432.2 513.7 415.8 513.7 401.5 507.3L288 457.5L174.5 507.3C160.2 513.7 143.8 513.7 129.5 507.3L33.46 465.1C13.13 456.2 0 436.1 0 413.9V294.7C0 271.5 14.39 250.6 36.15 242.4L132.1 205.1C133.4 205.5 134.7 205.1 136 204.7V92.52C136 69.25 150.4 48.41 172.1 40.16V40.16zM290.8 48.64C289 47.95 286.1 47.95 285.2 48.64L206.8 78.35L287.1 109.5L369.2 78.35L290.8 48.64zM392 210.6V121L309.6 152.6V241.8L392 210.6zM154.8 250.9C153 250.2 150.1 250.2 149.2 250.9L70.81 280.6L152 311.7L233.2 280.6L154.8 250.9zM173.6 455.3L256 419.1V323.2L173.6 354.8V455.3zM342.8 280.6L424 311.7L505.2 280.6L426.8 250.9C425 250.2 422.1 250.2 421.2 250.9L342.8 280.6zM528 413.9V323.2L445.6 354.8V455.3L523.2 421.2C526.1 419.9 528 417.1 528 413.9V413.9z" />
                    </svg>
                    <p>Calif.Evaluacion 360°</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?= baseUrl ?>?controller=bloquecompetencias&action=index360" class="nav-link">
                    <span><img src="<?= baseUrl ?>assets/img/360-view.png" alt=""></span>
                    <p>Competencias 360°</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= baseUrl ?>?controller=evaluacionpersonal360&action=cruces360" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18px" viewBox="0 0 576 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                      <path d="M550.5 241l-50.089-86.786c1.071-2.142 1.875-4.553 1.875-7.232 0-8.036-6.696-14.733-14.732-15.001l-55.447-95.893c.536-1.607 1.071-3.214 1.071-4.821 0-8.571-6.964-15.268-15.268-15.268-4.821 0-8.839 2.143-11.786 5.625H299.518C296.839 18.143 292.821 16 288 16s-8.839 2.143-11.518 5.625H170.411C167.464 18.143 163.447 16 158.625 16c-8.303 0-15.268 6.696-15.268 15.268 0 1.607.536 3.482 1.072 4.821l-55.983 97.233c-5.356 2.41-9.107 7.5-9.107 13.661 0 .535.268 1.071.268 1.607l-53.304 92.143c-7.232 1.339-12.59 7.5-12.59 15 0 7.232 5.089 13.393 12.054 15l55.179 95.358c-.536 1.607-.804 2.946-.804 4.821 0 7.232 5.089 13.393 12.054 14.732l51.697 89.732c-.536 1.607-1.071 3.482-1.071 5.357 0 8.571 6.964 15.268 15.268 15.268 4.821 0 8.839-2.143 11.518-5.357h106.875C279.161 493.857 283.447 496 288 496s8.839-2.143 11.518-5.357h107.143c2.678 2.946 6.696 4.821 10.982 4.821 8.571 0 15.268-6.964 15.268-15.268 0-1.607-.267-2.946-.803-4.285l51.697-90.268c6.964-1.339 12.054-7.5 12.054-14.732 0-1.607-.268-3.214-.804-4.821l54.911-95.358c6.964-1.339 12.322-7.5 12.322-15-.002-7.232-5.092-13.393-11.788-14.732zM153.535 450.732l-43.66-75.803h43.66v75.803zm0-83.839h-43.66c-.268-1.071-.804-2.142-1.339-3.214l44.999-47.41v50.624zm0-62.411l-50.357 53.304c-1.339-.536-2.679-1.34-4.018-1.607L43.447 259.75c.535-1.339.535-2.679.535-4.018s0-2.41-.268-3.482l51.965-90c2.679-.268 5.357-1.072 7.768-2.679l50.089 51.965v92.946zm0-102.322l-45.803-47.41c1.339-2.143 2.143-4.821 2.143-7.767 0-.268-.268-.804-.268-1.072l43.928-15.804v72.053zm0-80.625l-43.66 15.804 43.66-75.536v59.732zm326.519 39.108l.804 1.339L445.5 329.125l-63.75-67.232 98.036-101.518.268.268zM291.75 355.107l11.518 11.786H280.5l11.25-11.786zm-.268-11.25l-83.303-85.446 79.553-84.375 83.036 87.589-79.286 82.232zm5.357 5.893l79.286-82.232 67.5 71.25-5.892 28.125H313.714l-16.875-17.143zM410.411 44.393c1.071.536 2.142 1.072 3.482 1.34l57.857 100.714v.536c0 2.946.803 5.624 2.143 7.767L376.393 256l-83.035-87.589L410.411 44.393zm-9.107-2.143L287.732 162.518l-57.054-60.268 166.339-60h4.287zm-123.483 0c2.678 2.678 6.16 4.285 10.179 4.285s7.5-1.607 10.179-4.285h75L224.786 95.821 173.893 42.25h103.928zm-116.249 5.625l1.071-2.142a33.834 33.834 0 0 0 2.679-.804l51.161 53.84-54.911 19.821V47.875zm0 79.286l60.803-21.964 59.732 63.214-79.553 84.107-40.982-42.053v-83.304zm0 92.678L198 257.607l-36.428 38.304v-76.072zm0 87.858l42.053-44.464 82.768 85.982-17.143 17.678H161.572v-59.196zm6.964 162.053c-1.607-1.607-3.482-2.678-5.893-3.482l-1.071-1.607v-89.732h99.91l-91.607 94.821h-1.339zm129.911 0c-2.679-2.41-6.428-4.285-10.447-4.285s-7.767 1.875-10.447 4.285h-96.429l91.607-94.821h38.304l91.607 94.821H298.447zm120-11.786l-4.286 7.5c-1.339.268-2.41.803-3.482 1.339l-89.196-91.875h114.376l-17.412 83.036zm12.856-22.232l12.858-60.803h21.964l-34.822 60.803zm34.822-68.839h-20.357l4.553-21.16 17.143 18.214c-.535.803-1.071 1.874-1.339 2.946zm66.161-107.411l-55.447 96.697c-1.339.535-2.679 1.071-4.018 1.874l-20.625-21.964 34.554-163.928 45.803 79.286c-.267 1.339-.803 2.678-.803 4.285 0 1.339.268 2.411.536 3.75z" />
                    </svg>
                    <p>Cruces 360°</p>
                  </a>
                </li>



              </ul>

            </li>
          <?php endif; ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- alta modal -->
<div class="modal" id="actualizaPeriodo">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Activar Periodo a Evaluar</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="<?= baseUrl ?>?controller=evausuario&action=activarPeriodo" method="POST">
          <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Selecciona el Periodo a Evaluar</label>
            <?php $periodos = Utils::getPeridos(); ?>
            <select class="form-select" name="idperiodo" aria-label="Default select example">
              <option selected>Selecciona el estatus</option>
              <?php while ($periodo = $periodos->fetch_object()) : ?>
                <option value="<?= $periodo->idperiodo ?>">Activar <?= $periodo->NombrePeriodo ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4"><i class="fas fa-calendar-check"></i> Actualizar</button>
        </form>
      </div>
      <!-- Modal body -->
    </div>
  </div>
</div>


<!-- MODAL DEL CARDEX -->
<div class="modal" id="cardexhap">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">CARDEX DE CALIFICACIONES HAP</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="<?= baseUrl ?>?controller=evaluacion&action=cardexCalificaciones" method="POST">
          <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Selecciona el año para el "CARDEX"</label>
            <?php $incioPlataforma = 2022; ?>
            <select class="form-select" name="yearCardex" aria-label="Default select example">
              <option selected>Selecciona el Año</option>
              <?php for ($i = $incioPlataforma; $i < $yearActual; $i++) : ?>
                <option value="<?= $i ?>">Año <?= $i ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4"><i class="fas fa-calendar-check"></i> VER CARDEX</button>
        </form>
      </div>
      <!-- Modal body -->
    </div>
  </div>
</div>