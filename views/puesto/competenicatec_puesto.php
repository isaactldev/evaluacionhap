<?php
if (isset($_SESSION['addcompetencia']) && $_SESSION['addcompetencia'] == 'addcompetencia') {
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d', 
          title: 'Registro Exitoso!', 
          text: 'EL REGISTRO SE HA COMPLETADO TENDRAS UN DEPARTAMENTO NUEVO!',})
        </script>";
}if(isset($_SESSION['addcompetencia']) && $_SESSION['addcompetencia'] == 'errorCompetencia') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d', 
          title: 'Registro Fallido!', 
          text: 'EL REGISTRO NO SE HA COMPLETADO CORRECTAMENTE!',})
        </script>";
}
if(isset($_SESSION['deletecompetencia']) && $_SESSION['deletecompetencia'] == 'deletecompetencia') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'success', 
          confirmButtonColor: '#213c6d',
          title: 'Registro Eliminado!', 
          text: 'EL REGISTRO SE HA ELIMINADO CORRECTAMENTE!',})
        </script>";
}
if(isset($_SESSION['deletecompetencia']) && $_SESSION['deletecompetencia'] == 'errorCompetencia') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d', 
          title: 'Baja Fallida!', 
          text: 'EL REGISTRO NO SE HA ELIMINADO CORRECTAMENTE!',})
        </script>";
}
if(isset($_SESSION['editcompetencia']) && $_SESSION['editcompetencia'] == 'editcompetencia') {
  # code...
  echo "<script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d',
          title: 'Registro Modificado!', 
          text: 'EL REGISTRO SE HA MODIFICADO CORRECTAMENTE!',})
        </script>";
}
if(isset($_SESSION['editcompetencia']) && $_SESSION['editcompetencia'] == 'erroreditcompetencia') {
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
Utils::deleteSession('editcompetencia');
Utils::deleteSession('addcompetencia');
Utils::deleteSession('deletecompetencia');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- container fluit-->
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Competencias Tecnicas</h1>
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
              <?php
              $id = $_GET['id'];
              $puesto = Utils::showPuestoid($id);
              ?>
                <h3 class="card-title">Competencias Tecnicas del Puesto: <strong> <?= $puesto->nombrepuesto;?></strong></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="d-grid gap-2 d-md-flex mb-2 justify-content-md-end">
                  <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#altaCompetenciaTecnica"><i class="fa fa-fw fa-plus-square-o"></i> Agregar Competencias Tecnica</button>
                </div>
                  <table id="crud" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Puesto</th>
                            <th>Competenica Tecnica</th>
                            <th>Estatus</th>
                            <th>Fecha Alta</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($com = $competencia->fetch_object()):?>
                        <tr>
                            <td><?=$com->idcopentenciatecnica?></td>
                            <?php $puesto = Utils::showPuestoid($com->idpuesto);?>
                            <td><?=$puesto->nombrepuesto?></td>
                            <td><?=substr($com->competencia, 0, 100) . "..."?></td>
                            <td>
                            <?php if($com->idstatus == 1):?>
                            <span class="badge bg-green">Activo</span>
                            <?php elseif($com->idstatus == 2):?>
                            <span class="badge bg-yellow">Inactivo</span>
                            <?php endif;?>
                            </td>
                            <td><?=$com->fecha_alta?></td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <!-- <button type="button" class="btn btn-secondary btn-flat dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Acción</button>
                                  <ul class="dropdown-menu">
                                    <a class="dropdown-item" href="<?=baseUrl?>?controller=competecnica&action=edit&id=<?=$com->idcopentenciatecnica?>&idpuesto=<?=$com->idpuesto?>"><li class="fa fa-fw fa-trash"></li> Editar</a>
                                  </ul> -->

                                  <button id="editcompetec" type="button" class="btn btn-outline-secondary btn-block btn-flat editbtn" data-bs-toggle="modal" data-bs-target="#editcompetec<?=$com->idcopentenciatecnica?>">
                                        <i class="fas fa-user-edit"></i>
                                    </button>
                              </div>
                            </td>
                            
                        </tr>
                        <!-- EDIT MODAL COMPETENCIA TECNICA -->
                        <div class="modal" id="editcompetec<?=$com->idcopentenciatecnica?>">
                          <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Edicion Competencia Tecnica</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                                <form action="<?= baseUrl ?>?controller=competecnica&action=editCompetenciaTecnica" method="POST">
                                    
                                    <div class="form-group">
                                            <input type="hidden" name="idpuesto" value="<?=$id?>">
                                            <input type="hidden" name="idcompetec" value="<?=$com->idcopentenciatecnica?>">
                                            <label>Competencia Tecnica</label>
                                            <textarea class="form-control" rows="3" name="competenciatecnica"><?=$com->competencia?></textarea>
                                          </div>
                                    <div class="form-group">
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
                              </div>
                              <!-- Modal body -->
                            </div>
                          </div>
                        </div>
                        <!-- /EDIT MODAL COMPETENCIA TECNICA -->

      
                    <?php endwhile;?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Puesto</th>
                            <th>Competenica Tecnica</th>
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
      <div class="modal" id="altaCompetenciaTecnica">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Nueva Competencia Tecnica</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <form action="<?= baseUrl ?>?controller=competecnica&action=saveCompetenciaTecnica" method="POST">
              <div class="row">
              <div class="col-8 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Competenica del Puesto</label>
                      <?php 
                      $id = $_GET['id'];
                      $puesto = Utils::showPuestoid($id);?>
                        <select id="dep" class="form-select" name="puesto" aria-label="Default select example" onchange="altacargaPuesto();">
                          <option value="<?=$puesto->idpuesto?>"><?= $puesto->nombrepuesto ?></option>
                        </select>
                  </div>
                <div class="col-4 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Estatus</label>
                  <?php $estado = Utils::showEstatus(); ?>
                    <select class="form-select" name="idestatus" aria-label="Default select example">
                      <option selected>Selecciona el estatus</option>
                      <?php while ($status = $estado->fetch_object()):?>
                      <option value="<?= $status->idstatus?>"><?= $status->status?></option>
                      <?php endwhile;?>
                    </select>
                </div>
              
                </div>
                  <div class="form-group">
                          <label>Competencia Tecnica</label>
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