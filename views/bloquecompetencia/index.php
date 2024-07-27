<?php
if (isset($_SESSION['saveBloque']) && $_SESSION['saveBloque'] == 'saveBloque') {
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d', 
          title: 'Registro Exitoso!', 
          text: 'EL REGISTRO SE HA COMPLETADO TENDRAS UNA COMPETENCIA NUEVA!',})
        </script>";
}if(isset($_SESSION['saveBloque']) && $_SESSION['saveBloque'] == 'errorBloque') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d', 
          title: 'Registro Fallido!', 
          text: 'EL REGISTRO NO SE HA COMPLETADO CORRECTAMENTE!',})
        </script>";
}
if(isset($_SESSION['delteBloque']) && $_SESSION['delteBloque'] == 'delteBloque') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d', 
          title: 'Registro Eliminado!', 
          text: 'EL REGISTRO SE HA ELIMINADO CORRECTAMENTE!',})
        </script>";
}
if(isset($_SESSION['delteBloque']) && $_SESSION['delteBloque'] == 'errorBloque') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d', 
          title: 'Baja Fallida!', 
          text: 'EL REGISTRO NO SE HA ELIMINADO CORRECTAMENTE!',})
        </script>";
}
if(isset($_SESSION['editBloque']) && $_SESSION['editBloque'] == 'editBloque') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d', 
          title: 'Registro Modificado!', 
          text: 'EL REGISTRO SE HA MODIFICADO CORRECTAMENTE!',})
        </script>";
}
if(isset($_SESSION['editBloque']) && $_SESSION['editBloque'] == 'errorBloque') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d', 
          title: 'Error al Modificar!', 
          text: 'EL REGISTRO NO SE HA MODIFICADO CORRECTAMENTE!',})
        </script>";
}
Utils::deleteSession('editBloque');
Utils::deleteSession('delteBloque');
Utils::deleteSession('saveBloque');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- container fluit-->
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>ALTA DE BLOQUES DE COMPETENCIAS</h1>
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
                <h3 class="card-title">Bloques de Competencias</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="d-grid gap-2 d-md-flex mb-2 justify-content-md-end">
                  <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#altabloqueCompetencia"><i class="fa fa-fw fa-plus-square-o"></i> Agregar Bloque de Competencias</button>
                </div>
                  <table id="crud" class="table table-hover text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Bloque de Competencia</th>
                            <th>Estatus</th>
                            <th>Fecha de Alta</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($bloques = $bloque->fetch_object()):?>
                        <tr>
                            <td><?=$bloques->idbloque?></td>
                            <td><?=$bloques->bloquecompetencia?></td>
                            <td>
                            <?php if($bloques->idstatus == 1):?>
                            <span class="badge bg-green">Activo</span>
                            <?php elseif($bloques->idstatus == 2):?>
                            <span class="badge bg-yellow">Inactivo</span>
                            <?php endif;?>
                            </td>
                            <td><?=$bloques->fecha?></td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-secondary btn-flat dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Acción</button>
                                  <ul class="dropdown-menu">
                                    <a class="dropdown-item" href="<?=baseUrl?>?controller=bloquecompetencias&action=delete&id=<?=$bloques->idbloque?>"><li class="fa fa-fw fa-trash"></li> Eliminar</a>
                                    <a id="editmodal" class="dropdown-item editbtn" data-bs-toggle="modal" data-bs-target="#editbloqueCompetencia"><li class="fa fa-fw fa-eye"></li> Ver Evaluación</a> <!-- href="<?=baseUrl?>?controller=evaluacion&action=enditTipoEvaluacion&id=<?=$tipoEncuesta->idtipoeveluacion?>" -->
                                  </ul>
                              </div>
                            </td>
                            
                        </tr>
                    <?php endwhile;?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Bloque de Competencia</th>
                            <th>Estatus</th>
                            <th>Fecha de Alta</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                  </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <?php echo $date= date("Y-m-d");?>
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
      <!-- alta modal -->
      <div class="modal" id="altabloqueCompetencia">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Nuevo Bloque de Competencias</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <form action="<?= baseUrl ?>?controller=bloquecompetencias&action=altaBloque" method="POST">
                  <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">Bloque de la Competencias</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" name="nameblocomp" placeholder="Ingresa el Nombre...">
                </div>
                <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4"><i class="fas fa-plus-square"></i> Guardar</button>
              </form>
            </div>
            <!-- Modal body -->
          </div>
        </div>
      </div>
      <!-- /alta modal -->
      <!-- EDIT modal -->
      <div class="modal" id="editbloqueCompetencia">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edicion del Bloque de Competencia</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <!-- EDIT -->
              <form action="<?= baseUrl ?>?controller=bloquecompetencias&action=edit" method="POST">
              <input type="hidden" class="form-control" id="editid" name="editid">
                  <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">Nombre del Bloque</label>
                  <input type="text" class="form-control" id="nameid" name="namebloque">
                </div>
                <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Estatus</label>
                <?php $estado = Utils::showEstatus(); ?>
                  <select class="form-select" name="idestatus" aria-label="Default select example">
                    <option selected>Selecciona el estatus</option>
                    <?php while ($status = $estado->fetch_object()):?>
                    <option value="<?= $status->idstatus?>"><?= $status->status?></option>
                    <?php endwhile;?>
                  </select>
                </div>
                <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4"><i class="fas fa-plus-square"></i> Guardar</button>
              </form>
              <!-- EDIT -->
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
  $('.editbtn').on('click', function(){

    $tr=$(this).closest('tr');
    var datos=$tr.children('td').map(function(){
      return $(this).text();
    });
    $('#editid').val(datos[0]);
    $('#nameid').val(datos[1]);
    $('#idestatus').val(datos[2]);
  });
  </script>