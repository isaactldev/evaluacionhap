<?php
if (isset($_SESSION['addPuesto']) && $_SESSION['addPuesto'] == 'addPuesto') {
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d', 
          title: 'Registro Exitoso!', 
          text: 'EL REGISTRO SE HA COMPLETADO TENDRAS UN DEPARTAMENTO NUEVO!',})
        </script>";
}if(isset($_SESSION['addPuesto']) && $_SESSION['addPuesto'] == 'errorPuesto') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d', 
          title: 'Registro Fallido!', 
          text: 'EL REGISTRO NO SE HA COMPLETADO CORRECTAMENTE!',})
        </script>";
}
if(isset($_SESSION['deletePuesto']) && $_SESSION['deletePuesto'] == 'deletePuesto') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'success', 
          confirmButtonColor: '#213c6d',
          title: 'Registro Eliminado!', 
          text: 'EL REGISTRO SE HA ELIMINADO CORRECTAMENTE!',})
        </script>";
}
if(isset($_SESSION['deletePuesto']) && $_SESSION['deletePuesto'] == 'errorPuesto') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d', 
          title: 'Baja Fallida!', 
          text: 'EL REGISTRO NO SE HA ELIMINADO CORRECTAMENTE!',})
        </script>";
}
if(isset($_SESSION['editPuesto']) && $_SESSION['editPuesto'] == 'editPuesto') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d',
          title: 'Registro Modificado!', 
          text: 'EL REGISTRO SE HA MODIFICADO CORRECTAMENTE!',})
        </script>";
}
if(isset($_SESSION['editPuesto']) && $_SESSION['editPuesto'] == 'errorPuesto') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d',
          title: 'Error al Modificar!', 
          text: 'EL REGISTRO NO SE HA MODIFICADO CORRECTAMENTE!',})
        </script>";
}
Utils::deleteSession('deletePuesto');
Utils::deleteSession('editPuesto');
Utils::deleteSession('addPuesto');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- container fluit-->
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>PUESTOS DEL HAP</h1>
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
                <h3 class="card-title">Control de Puestos</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="d-grid gap-2 d-md-flex mb-2 justify-content-md-end">
                  <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#altaDepartamento"><i class="fa fa-fw fa-plus-square-o"></i> Agregar Puesto</button>
                </div>
                  <table id="crud" class="table table-striped table-hover text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Puesto</th>
                            <th>Descripción</th>
                            <th>Estatus</th>
                            <th>Fecha Alta</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($puestos = $puesto->fetch_object()):?>
                        <tr>
                            <td><?=$puestos->idpuesto?></td>
                            <td><?=$puestos->nombrepuesto?></td>
                            <td><?=substr($puestos->descripcion, 0, 30) . ""?></td>
                            <td>
                            <?php if($puestos->idstatus == 1):?>
                            <span class="badge bg-green">Activo</span>
                            <?php elseif($puestos->idstatus == 2):?>
                            <span class="badge bg-yellow">Inactivo</span>
                            <?php endif;?>
                            </td>
                            <td><?=$puestos->fechaalta?></td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-secondary btn-flat dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Acción</button>
                                  <ul class="dropdown-menu">
                                    <a class="dropdown-item" href="<?=baseUrl?>?controller=puesto&action=delete&id=<?=$puestos->idpuesto?>"><li class="fa fa-fw fa-trash"></li> Eliminar</a>
                                    <a class="dropdown-item" href="<?=baseUrl?>?controller=competecnica&action=competenciasTecnicasPuesto&id=<?=$puestos->idpuesto?>"><i class="fa fa-fw fa-trophy"></i> Competencias Tecnicas</a>
                                    <a id="editmodal" class="dropdown-item editbtn" data-bs-toggle="modal" data-bs-target="#editPuesto"><li class="fa fa-fw fa-eye"></li> Ver Puesto</a>
                                  </ul>
                              </div>
                            </td>
                            
                        </tr>
                    <?php endwhile;?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Puesto</th>
                            <th>Descripción</th>
                            <th>Estatus</th>
                            <th>Fecha Alta</th>
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
      <div class="modal" id="altaDepartamento">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Nuevo Puesto</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <form action="<?= baseUrl ?>?controller=puesto&action=add" method="POST">
                  <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">Nombre del Puesto </label>
                  <input type="text" class="form-control" id="formGroupExampleInput" name="namePuesto" placeholder="Ingresa el Nombre..." required>
                </div>
                <div class="mb-3">
              <label for="formGroupExampleInput" class="form-label">Departamento</label>
                <?php $departamentos = Utils::showDepartamento(); ?>
                  <select id="dep" class="form-select" name="dapa" aria-label="Default select example" onchange="altacargaPuesto();">
                    <option selected>Selecciona el Departamento</option>
                    <?php while ($departamento = $departamentos->fetch_object()) : ?>
                    <?=$puestodep = $departamento->iddepartamento?>
                    <option value="<?= $departamento->iddepartamento ?>"><?= $departamento->depnombre ?></option>
                    <?php endwhile; ?>
                  </select>
              </div>
                <div class="form-group">
                        <label>Descripcion del Puesto</label>
                        <textarea class="form-control" rows="3" name="descriPuesto" placeholder="Descripcion del Puesto ..."></textarea>
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
      <div class="modal" id="editPuesto">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Editar Puesto</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <!-- EDIT -->
              <form action="<?= baseUrl ?>?controller=puesto&action=edit" method="POST">
              <input type="hidden" class="form-control" id="editid" name="editid">
                  <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Nombre del Puesto</label>
                    <input type="text" class="form-control" id="nameid" name="namedep" required>
                  </div>
                  <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Cambiar Departamento al que Pertenece</label>
                      <?php $departamentos = Utils::showDepartamento(); ?>
                          <select id="dep" class="form-select" name="dapa" aria-label="Default select example" onchange="altacargaPuesto();" required>
                            <option selected>Selecciona el Departamento</option>
                            <?php while ($departamento = $departamentos->fetch_object()) : ?>
                            <?=$puestodep = $departamento->iddepartamento?>
                            <option value="<?= $departamento->iddepartamento ?>"><?= $departamento->depnombre ?></option>
                            <?php endwhile; ?>
                          </select>
                  </div>
                <div class="form-group">
                        <label>Descripcion del Puesto</label>
                        <textarea id="descPuesto" class="form-control" rows="3" name="descriPuesto" placeholder="Descripcion del Puesto ..."></textarea>
                      </div>
                <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Estatus</label>
                <?php $estado = Utils::showEstatus(); ?>
                  <select class="form-select" name="idestatus" aria-label="Default select example" required>
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
    $('#descPuesto').val(datos[2]);
    $('#idestatus').val(datos[3]);
  });
  </script>