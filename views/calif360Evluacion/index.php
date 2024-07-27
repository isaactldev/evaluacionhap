<?php
if (isset($_SESSION['actualizaUser360']) && $_SESSION['actualizaUser360'] == 'actualizaUser360') {
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d', 
          title: 'Registros Actualizados con Exitoso!', 
          text: 'SE HAN ACTUALIZADO EL NUMERO DE USUARIOS 360°!',})
        </script>";
}
if (isset($_SESSION['actualizaUser360']) && $_SESSION['actualizaUser360'] == 'error_actualizaUser360') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'info',
          confirmButtonColor: '#213c6d',
          title: 'LA LISTA ESTA ACTUALIZADA!', 
          text: 'TODOS LOS USUARIOS ESTAN LISTADOS !',})
        </script>";
}
if (isset($_SESSION['califSave']) && $_SESSION['califSave'] == 'califSave') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d', 
          title: 'Calificacion Capturada!', 
          text: 'LA CALIFICACION SE HA CAPTURADO CORRECTAMENTE!',})
        </script>";
}
if (isset($_SESSION['califSave']) && $_SESSION['califSave'] == 'califFail') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d', 
          title: 'No logramos Capturar la Calificacion Correctamente!', 
          text: 'LA CALIFICACION NO SE HA CAPTURADO CORRECTAMENTE!',})
        </script>";
}
Utils::deleteSession('actualizaUser360');
Utils::deleteSession('califSave');

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <!-- container fluit-->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>CAPTURA DE CALIFICACION DE EVALUACION 360°</h1>
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
        <div class="col-12">
          <!-- Default box -->
          <div class="card card-primary">
            <div class="card-header ">
              <h3 class="card-title">Personal 360°</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="d-grid gap-2 d-md-flex mb-2 justify-content-md-end">
                <a class="btn btn-primary me-md-2" type="button" href="<?= baseUrl ?>?controller=calif360user&action=actuaizarUsuarios360"><i class="fas fa-sync-alt"></i> Actualizar Usuarios 360°</a>
              </div>
              <table id="crud" class="table table-striped table-hover text-center" style="width:100%">
                <thead>
                  <tr>
                    <th>N</th>
                    <th>No. Empleado</th>
                    <th>Nombre</th>
                    <th>Calificacion Periodo 1</th>
                    <th>status</th>
                    <th>Calificacion Periodo 2</th>
                    <th>status</th>

                  </tr>
                </thead>
                <tbody>
                  <?php while ($user360 = $users360->fetch_object()) : ?>
                    <tr>
                      <td><?= $user360->idusuario ?></td>
                      <td><?= $user360->noempleado ?></td>
                      <td><?= $user360->nombreuser . ' ' . $user360->appaterno . ' ' . $user360->apmaterno ?></td>

                      <!-- PERIODO 1 -->
                      <td><!-- CALIFICIACION -->
                        <?php $calificacion360Periodo1 = Utils::getuserCalif360byId($user360->idusuario, $perido1, $fecha); ?>
                        <?php if ($calificacion360Periodo1->idstatus == 2) : ?>
                          <a class="dropdown-item editbtn" href="<?= baseUrl ?>?controller=evaluacionpersonal360&action=index&iduser=<?= $user360->noempleado ?>&periodo=<?= $perido1 ?>"><?= $calificacion360Periodo1->calificacion ?> <i class="fas fa-user-check"></i></a>
                        <?php else : ?>
                          <!-- reporte -->
                          <a href="#" class="dropdown-item editbtn" onclick="ventana(<?= $user360->noempleado ?>,<?= $perido1 ?>);"><?= $calificacion360Periodo1->calificacion ?> <i class="fas fa-file-pdf fa-xl"></i></a>
                          <script>
                            function ventana(noEmpleado360, periodo) {
                              var url = location.origin;
                              var path = window.location.pathname;

                              var URL = url + path + "views/evaluacionesUsuarios360/reportecalif360.php?noEmpleado360=" + noEmpleado360 + "&periodo=" + periodo;
                              ventana = window.open(URL, "ventana1", "width=830,height=500,scrollbars=YES,location=no, menubar=no, scrollbars=YES, status=no, toolbar=no, resizable=no");
                              return ventana;
                            }
                          </script>

                        <?php endif; ?>
                      </td>

                      <td><!-- ESTATUS -->
                        <?php if ($calificacion360Periodo1->idstatus == 1) : ?>
                          <span class="badge bg-green">Calif. Capturada <svg xmlns="http://www.w3.org/2000/svg" width="15px" viewBox="0 0 448 512">
                              <path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z" />
                            </svg></span>
                        <?php elseif ($calificacion360Periodo1->idstatus == 2) : ?>
                          <span class="badge bg-yellow">Pendiente por Capturar <svg xmlns="http://www.w3.org/2000/svg" width="15px" viewBox="0 0 576 512">
                              <path d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z" />
                            </svg></span>
                        <?php endif; ?>
                      </td>







                      <!-- PERIODO 2 -->
                      <td><!-- CALIFICIACION -->
                        <?php $calificacion360Periodo2 = Utils::getuserCalif360byId($user360->idusuario, $perido2, $fecha); ?>
                        <?php if ($calificacion360Periodo2->idstatus == 2) : ?>
                          <!-- <a id="editmodal"  class="dropdown-item capcalif2" data-bs-toggle="modal" data-bs-target="#capturaCalificacionP2_<?= $user360->idusuario ?>"><?= $calificacion360Periodo2->calificacion ?> <i class="fas fa-user-check"></i></a> -->
                          <a class="dropdown-item editbtn" href="<?= baseUrl ?>?controller=evaluacionpersonal360&action=index&iduser=<?= $user360->noempleado ?>&periodo=<?= $perido2 ?>"><?= $calificacion360Periodo2->calificacion ?> <i class="fas fa-user-check"></i></a>
                        <?php else : ?>
                          <!-- reporte -->

                          <a href="#" class="dropdown-item editbtn" onclick="ventana(<?= $user360->noempleado ?>,<?= $perido2 ?>);"><?= $calificacion360Periodo2->calificacion ?> <i class="fas fa-file-pdf fa-xl"></i></a>
                          <script>
                            function ventana(noEmpleado360, periodo) {
                              var url = location.origin;
                              var path = window.location.pathname;

                              var URL = url + path + "views/evaluacionesUsuarios360/reportecalif360.php?noEmpleado360=" + noEmpleado360 + "&periodo=" + periodo;
                              ventana = window.open(URL, "ventana1", "width=830,height=500,scrollbars=YES,location=no, menubar=no, scrollbars=YES, status=no, toolbar=no, resizable=no");
                              return ventana;
                            }
                          </script>
                        <?php endif; ?>
                      </td>




                      <td>
                        <?php if ($calificacion360Periodo2->idstatus == 1) : ?>
                          <span class="badge bg-green">Calif. Capturada <svg xmlns="http://www.w3.org/2000/svg" width="15px" viewBox="0 0 448 512">
                              <path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z" />
                            </svg></span>
                        <?php elseif ($calificacion360Periodo2->idstatus == 2) : ?>
                          <span class="badge bg-yellow">Pendiente por Capturar <svg xmlns="http://www.w3.org/2000/svg" width="15px" viewBox="0 0 576 512">
                              <path d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z" />
                            </svg></span>
                        <?php endif; ?>
                      </td>

                    </tr>

                  <?php endwhile; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>N</th>
                    <th>No. Empleado</th>
                    <th>Nombre</th>
                    <th>Calificacion Periodo 1</th>
                    <th>status</th>
                    <th>Calificacion Periodo 2</th>
                    <th>status</th>

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
          <!-- /.card -->
        </div>
      </div>
    </div>





    <!-- /alta modal -->
  </section>
</div>
<!-- /.content-wrapper -->

<script>
  $('.capcalif1').on('click', function() {

    $tr = $(this).closest('tr');
    var datos = $tr.children('td').map(function() {
      return $(this).text();
    });
    $('#iduser1').val(datos[0]);
  });


  /* FUNCION PERIODO2 */
  $('.capcalif2').on('click', function() {

    $tr = $(this).closest('tr');
    var datos = $tr.children('td').map(function() {
      return $(this).text();
    });
    $('#iduser2').val(datos[0]);
  });
</script>