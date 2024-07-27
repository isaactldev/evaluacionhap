<?php
if (isset($_SESSION['registroUser']) && $_SESSION['registroUser'] == 'registroUser') {
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d', 
          title: 'Registro Exitoso!', 
          text: 'EL REGISTRO SE HA COMPLETADO TENDRAS UN NUEVO COLABORADOR!',})
        </script>";
}
if (isset($_SESSION['registroUser']) && $_SESSION['registroUser'] == 'error_registroUser') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d',
          title: 'Registro Fallido!', 
          text: 'EL REGISTRO NO SE HA COMPLETADO CORRECTAMENTE!',})
        </script>";
}
if (isset($_SESSION['deleteUser']) && $_SESSION['deleteUser'] == 'deleteUser') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d', 
          title: 'Registro Eliminado!', 
          text: 'EL REGISTRO SE HA ELIMINADO CORRECTAMENTE!',})
        </script>";
}
if (isset($_SESSION['deleteUser']) && $_SESSION['deleteUser'] == 'error_deleteUser') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d', 
          title: 'Baja Fallida!', 
          text: 'EL REGISTRO NO SE HA ELIMINADO CORRECTAMENTE!',})
        </script>";
}
if (isset($_SESSION['editUser']) && $_SESSION['editUser'] == 'editUser') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d', 
          title: 'Registro Modificado!', 
          text: 'EL REGISTRO SE HA MODIFICADO CORRECTAMENTE!',})
        </script>";
}
if (isset($_SESSION['editUser']) && $_SESSION['editUser'] == 'error_editUser') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d', 
          title: 'Error al Modificar!', 
          text: 'EL REGISTRO NO SE HA MODIFICADO CORRECTAMENTE!',})
        </script>";
}
if (isset($_SESSION['registroUser']) && $_SESSION['registroUser'] == 'error_registroUserDupliate') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d', 
          title: 'Ups! Usuario Duplicado', 
          text: 'EL N°EMPLADO ESTA DUPLIADO VALIDALO PORFAVOR!',})
        </script>";
}
Utils::deleteSession('editUser');
Utils::deleteSession('deleteUser');
Utils::deleteSession('error_registroUserDupliate');
Utils::deleteSession('registroUser');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <!-- container fluit-->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>PANEL ADMINISTRADOR DEL PERSONAL A EVALUAR </h1>
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
              <h3 class="card-title">Personal</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="d-grid gap-2 d-md-flex mb-2 justify-content-md-end">
                <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#altatipoevaluacion"><i class="fa fa-fw fa-plus-square-o"></i> Agregar nuevo Usuario</button>
              </div>
              <table id="cruduser" class="display table table-striped table-hover text-center" style="width:100%">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>No°Empleado</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Puesto</th>
                    <th>Departamento</th>
                    <th>Eva_Personal</th>
                    <th>Evaluación 360°</th>
                    <th>Tipo de Evaluación</th>
                    <th>Estatus</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($usuario = $usuarios->fetch_object()) : ?>
                    <tr>
                      <td><input type="hidden" id="editidusuario" name="editidusuario" value="<?= $usuario->idusuario ?>"><?= $usuario->idusuario ?></td>
                      <td><?= $usuario->noempleado ?></td>
                      <td><?= $usuario->nombreuser . ' ' . $usuario->appaterno . ' ' . $usuario->apmaterno ?></td>
                      <td><?= $usuario->appaterno ?></td>
                      <td>
                        <?php $puesto = Utils::userPuesto($usuario->idpuesto); ?>
                        <?= $puesto->nombrepuesto ?>
                      </td>
                      <td>
                        <?php $userDepartamento = Utils::userDepartamento($usuario->iddepartamento); ?>
                        <?= $userDepartamento->depnombre ?>
                      </td>
                      <td>
                        <?php if ($usuario->autoevalua == 1) : ?>
                          <svg xmlns="http://www.w3.org/2000/svg" width="15px" viewBox="0 0 448 512">
                            <path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z" />
                          </svg>
                        <?php elseif ($usuario->autoevalua == 2) : ?>
                          <svg xmlns="http://www.w3.org/2000/svg" width="15px" viewBox="0 0 320 512">
                            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z" />
                          </svg>
                        <?php endif; ?>
                      </td>
                      <td><?= $usuario->evalua360 ?></td>

                      <td><?= $usuario->tipoevaluacion ?></td>
                      <td>
                        <?php if ($usuario->idstatus == 1) : ?>
                          <span class="badge bg-green">Activo</span>
                        <?php elseif ($usuario->idstatus == 2) : ?>
                          <span class="badge bg-yellow">Inactivo</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                          <button type="button" class="btn btn-secondary btn-flat dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Acción</button>
                          <ul class="dropdown-menu">
                            <a class="dropdown-item" href="<?= baseUrl ?>?controller=usuario&action=delete&id=<?= $usuario->idusuario ?>">
                              <li class="fa fa-fw fa-trash"></li> Eliminar
                            </a>
                            <a id="editmodal" class="dropdown-item editbtn" data-bs-toggle="modal" data-bs-target="#edittipoevaluacion<?= $usuario->idusuario ?>">
                              <li class="fa fa-fw fa-eye"></li> Ver Usuario
                            </a>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <?php include('modaleditUser.php'); ?>
                  <?php endwhile; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>id</th>
                    <th>No°Empleado</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Puesto</th>
                    <th>Departamento</th>
                    <th>Eva_Personal</th>
                    <th>Evaluación 360°</th>
                    <th>Tipo de Evaluación</th>
                    <th>Estatus</th>
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
          <!-- /.card -->
        </div>
      </div>
    </div>
    <!-- alta modal -->
    <div class="modal" id="altatipoevaluacion">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Alta de Personal</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <form action="<?= baseUrl ?>?controller=usuario&action=altaUsuario" method="POST">
              <div class="row">
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">No° Empleado</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" name="noEmpleado" placeholder="No.Empleado">
                </div>
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" name="nombre" placeholder="Ingresa el Nombre...">
                </div>
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Ap. Paterno</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" name="apaPaterno" placeholder="Ingresa el Apellido...">
                </div>
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Ap. Paterno</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" name="apaMaterno" placeholder="Ingresa el Apellido...">
                </div>
              </div>
              <!-- SELECT DEPARTAMENTO -->
              <div class="row">
                <div class="col-6 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Departamento</label>
                  <?php $departamentos = Utils::showDepartamento(); ?>
                  <select id="dep" class="form-select" name="dapa" aria-label="Default select example" onchange="altacargaPuesto();">
                    <option selected>Selecciona el Departamento</option>
                    <?php while ($departamento = $departamentos->fetch_object()) : ?>
                      <?= $puestodep = $departamento->iddepartamento ?>
                      <option value="<?= $departamento->iddepartamento ?>"><?= $departamento->depnombre ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
                <script language="javascript" type="text/javascript">
                  function altacargaPuesto() {
                    var idDep = $("#dep").val();
                    var idDep2 = $("#dep").val();
                    $.post("config/helpers/cargarPuesto.php", {
                      ID: idDep
                    }, function(mensaje) {
                      $("#puesto").html(mensaje);
                    });
                    $.post("config/helpers/cargarEvaluadorxdep.php", {
                      ID: idDep2
                    }, function(mensaje2) {
                      $("#altaEvluador").html(mensaje2);
                    });
                  }
                </script>
                <!-- /SELECT DEPARTAMENTO -->
                <!-- SELECT PUESTO -->
                <div class="col-6 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Puesto</label>
                  <select class="form-select" id="puesto" name="puesto" aria-label="Default select example">
                    <option selected>Selecciona el Puesto</option>
                  </select>
                </div>
              </div>
              <!-- /SELECT PUESTO -->
              <div class="row">
                <!-- SELECT JERARQUICO -->
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">P. Jerarquico</label>
                  <?php $jerarquias = Utils::showJerarquia(); ?>
                  <select class="form-select" id="jerarquico" name="jerarquico" aria-label="Default select example">
                    <option selected>Selecciona el Departamento</option>
                    <?php while ($jerarquia = $jerarquias->fetch_object()) : ?>
                      <option value="<?= $jerarquia->idjerarquia ?>"><?= $jerarquia->nombre ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Evaluador</label>
                  <select class="form-select" id="altaEvluador" name="evaluador" aria-label="Default select example">
                    <option selected>Selecciona el Departamento</option>
                  </select>
                </div>
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Evaluador Opcional</label>
                  <input type="text" class="form-control" id="EvluadorOpcional" name="evaluadorOpcional" placeholder="Ingresa el No.Empleado">
                </div>
                <!-- SELECT JERARQUICO -->
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Tipo Evaluación</label>
                  <select class="form-select" name="tipoEva" aria-label="Default select example">
                    <option selected>Selecciona el Tipo de Evaluación</option>
                    <option value="OPERATIVO">OPERATIVO</option>
                    <option value="DIRECTIVO">DIRECTIVO</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-8 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Auto Evaluación</label>
                  <select class="form-select" name="persEva" aria-label="Default select example">
                    <option selected>Selecciona el Tipo de Evaluación</option>
                    <option value="1">SI</option>
                    <option value="2">NO</option>
                  </select>
                </div>
                <div class="col-4 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Estatus</label>
                  <?php $estado = Utils::showEstatus(); ?>
                  <select class="form-select" name="idestatus" aria-label="Default select example">
                    <option selected>Selecciona el estatus</option>
                    <?php while ($status = $estado->fetch_object()) : ?>
                      <option value="<?= $status->idstatus ?>"><?= $status->status ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-6 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Evaluacion 360°</label>
                  <select class="form-select" name="eva360" aria-label="Default select example">
                    <option selected>Evaluacion 360°</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>
                <div class="col-6 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Fecha de alta</label>
                  <input type="date" class="form-control" id="birthday" name="date">
                </div>
              </div>
              <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4"><i class="fas fa-plus-square"></i> Guardar</button>
            </form>
          </div>
          <!-- Modal body -->
        </div>
      </div>
    </div>
    <!-- /alta modal -->



  </section>
</div>
<!-- /.content-wrapper -->

<script>
  $('.editbtn').on('click', function() {

    $tr = $(this).closest('tr');
    var datos = $tr.children('td').map(function() {
      return $(this).text();
    });
    /* optencion de info */

    /* $('#editid').val(datos[0]);
    $('#noEmpleado').val(datos[1]);
    $('#disabledTextInput').val(datos[2]);
    $('#apPaterno').val(datos[3]);
    $('#date').val(datos[7]); */

  });
</script>