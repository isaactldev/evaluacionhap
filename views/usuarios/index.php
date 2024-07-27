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
                  <!-- AQUI SE MUESTRA EL AJAX DATATABLES-->

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
                  <label for="formGroupExampleInput" class="form-label">Ap. Materno</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" name="apaMaterno" placeholder="Ingresa el Apellido...">
                </div>
              </div>
              <!-- SELECT DEPARTAMENTO -->
              <div class="row">
                <div class="col-6 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Departamento</label>
                  <?php $departamentos = Utils::showDepartamento(); ?>
                  <select id="dep" class="form-select" name="dapa" aria-label="Default select example" onchange="altacargaPuesto();cargarEvaluador();">
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
                    console.log("idDep: " + idDep);
                    $.post("config/helpers/cargarPuesto.php", {
                      ID: idDep
                    }, function(mensaje) {
                      $("#puesto").html(mensaje);
                    });
                  }

                  function cargarEvaluador() {
                    var evaluadoresDep = $("#dep").val();
                    console.log("evaluadoresDep: " + evaluadoresDep);
                    $.post("config/helpers/altacargarEvaluadorxdep.php", {
                      idDepartamento: evaluadoresDep
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
                    <option selected>Selecciona el Evaluador</option>
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
                <div class="col-4 mb-3">
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
                <div class="col-4 mb-3">
                  <label for="formGroupExampleInput" class="form-label">¿Es Enfermera?</label>
                  <select class="form-select" name="isEnfermera" aria-label="Default select example">
                    <option selected>Selecciona el Tipo de Evaluación</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-4 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Evaluacion 360°</label>
                  <select class="form-select" name="eva360" aria-label="Default select example">
                    <option selected>Evaluacion 360°</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>
                <div class="col-4 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Fecha de alta</label>
                  <input type="date" class="form-control" id="birthday" name="date">
                </div>
                <div class="col-4 mb-3">
                  <label for="formGroupExampleInput" class="form-label">¿Tiene Planta?</label>
                  <select class="form-select" name="idplanta" aria-label="Default select example">
                    <option value="2" selected>NO</option>
                    <option value="1">SI</option>
                  </select>
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



    <!-- Edicion modal -->
    <div class="modal" id="editinfoUsuarios">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Edicion de Usuario</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <!-- action="<?= baseUrl ?>?controller=usuario&action=edit" method="POST"-->
            <form id="editformUserinfo">
              <div class="row">
                <div class="col-3 mb-3">
                  <input type="hidden" class="form-control" id="editid" name="id">
                  <label for="formGroupExampleInput" class="form-label">No° Empleado</label>
                  <input type="text" class="form-control" id="noEmpleado" name="noEmpleado" placeholder="No.Empleado">
                </div>
                <div class="col-3 mb-3">
                  <label for="editname" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="editname" name="editname" placeholder="Ingresa el Nombre...">
                </div>
                <div class="col-3 mb-3">
                  <label for="editapPatertno" class="form-label">Ap. Paterno</label>
                  <input type="text" class="form-control" id="editapPatertno" name="editapPatertno">
                </div>
                <div class="col-3 mb-3">
                  <label for="editapMaterno" class="form-label">Ap. Materno</label>
                  <input type="text" class="form-control" id="editapMaterno" name="editapMaterno" placeholder="Ingresa el Apellido...">
                </div>
              </div>
              <!-- SELECT DEPARTAMENTO -->
              <div class="row">
                <div class="col-6 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Departamento</label>
                  <?php $departamentos = Utils::showDepartamento(); ?>
                  <select id="editdepa" class="form-select" name="dapa" aria-label="Default select example" onchange="cargaPuesto();">
                    <option selected>Selecciona el Departamento</option>
                    <?php while ($departamento = $departamentos->fetch_object()) : ?>
                      <?= $puestodep = $departamento->iddepartamento ?>
                      <option value="<?= $departamento->iddepartamento ?>"><?= $departamento->depnombre ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
                <script language="javascript" type="text/javascript">
                  function cargaPuesto() {
                    var idDep = parseInt($("#editdepa").val());
                    var idDep2 = parseInt($("#editdepa").val());
                    var idPuestoUser = parseInt($("#editid").val());
                    $.post("config/helpers/cargarPuesto.php", {
                      ID: idDep,
                      idPuestoUser: idPuestoUser
                    }, function(mensaje) {
                      $("#editpuestoUser").html(mensaje);
                    });
                    $.post("config/helpers/cargarEvaluadorxdep.php", {
                      ID: idDep2
                    }, function(mensaje2) {
                      $("#editEvluador").html(mensaje2);
                    });
                  }
                </script>
                <!-- /SELECT DEPARTAMENTO -->
                <!-- SELECT PUESTO -->
                <div class="col-6 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Puesto</label>
                  <select id="editpuestoUser" class="form-select" name="puesto" aria-label="Default select example">
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
                  <select class="form-select" id="editjerarquico" name="jerarquico" aria-label="Default select example">
                    <option selected>Selecciona el P. Jerarquico</option>
                    <?php while ($jerarquia = $jerarquias->fetch_object()) : ?>
                      <option value="<?= $jerarquia->idjerarquia ?>"><?= $jerarquia->nombre ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Evaluador</label>
                  <select class="form-select" id="editEvluador" name="evaluador" aria-label="Default select example">
                    <option selected>Selecciona el Evaluador</option>
                  </select>
                </div>
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Evaluador Opcional</label>
                  <input type="text" class="form-control" id="editevluadorOpcional" name="evaluadorOpcional" placeholder="Ingresa el No.Empleado">
                </div>
                <!-- SELECT JERARQUICO -->
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Tipo Evaluación</label>
                  <select id="edittipoEva" class="form-select" name="tipoEva" aria-label="Default select example">
                    <option selected>Selecciona el Tipo de Evaluación</option>
                    <option value="OPERATIVO">OPERATIVO</option>
                    <option value="DIRECTIVO">DIRECTIVO</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Evaluacion Personal</label>
                  <select id="editpersEva" class="form-select" name="editpersEva" aria-label="Default select example">
                    <option selected>Selecciona si tiene Evaluacion Personal</option>
                    <option value="1">SI</option>
                    <option value="2">NO</option>
                  </select>
                </div>
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Evaluacion 360°</label>
                  <select id="editevalua360" class="form-select" name="eva360" aria-label="Default select example">
                    <option selected>Evaluacion 360°</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Estatus</label>
                  <?php $estado = Utils::showEstatus(); ?>
                  <select id="idstatus" class="form-select" name="idestatus" aria-label="Default select example">
                    <option selected>Selecciona el estatus</option>
                    <?php while ($status = $estado->fetch_object()) : ?>
                      <option value="<?= $status->idstatus ?>"><?= $status->status ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">¿Tiene Planta?</label>
                  <select class="form-select" id="idplanta" name="idplanta" aria-label="Default select example">
                    <option value="2" selected>NO</option>
                    <option value="1">SI</option>
                  </select>
                </div>
              </div>
              <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4"><i class="fas fa-plus-square"></i> Editar Usuario</button>
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