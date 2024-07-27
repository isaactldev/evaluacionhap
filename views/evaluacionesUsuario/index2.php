<?php
if (isset($_SESSION['evaluacion']) && $_SESSION['evaluacion'] == 'evaluacionSave') {
  ?>
  <script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d', 
          title: 'Evaluacion Guardada!', 
          text: 'La evaluacion se ha guardado CORRECTAMENTE!',})
        </script>
<?php
}
if(isset($_SESSION['evaluacion']) && $_SESSION['evaluacion'] == 'evaluacionError') {
?>
  <script>
        Swal.fire({ 
          icon: 'error',
          confirmButtonColor: '#213c6d', 
          title: 'Registro Fallido!', 
          text: 'NO SE A GUARDADO LA EVALUACION CORRECTAMENTE!',})
        </script>
<?php
}
if(isset($_SESSION['actualizaPeriodo']) && $_SESSION['actualizaPeriodo'] == 'actualizaPeriodo') {
?>
  <script>
        Swal.fire({ 
          icon: 'success',
          confirmButtonColor: '#213c6d',
          title: 'SE HA ACTUALIZADO EL PERIODO A EVULUAR!', 
          text: 'AHORA LAS EVALUACIONES QUE REALICES SE REGISTRARAN CON EL PERIODO ACTIVADO',})
        </script>
<?php
}


Utils::deleteSession('evaluacion');
Utils::deleteSession('actualizaPeriodo');

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- container fluit-->
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>PERSONAL A EVALUAR DEL DEPARTAMENTO <?=$dep->depnombre?></h1>
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
                <h3 class="card-title">Evaluaciones del Personal a cargo</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                  <table id="crud" class="table table-hover text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>N° Empleado</th>
                            <th>Nombre Completo</th>
                            <th>Puesto</th>
                            <th>Evaluado</th>
                            <th>Calificación</th>
                            <th>Periodo 1er/2do</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($personaAcargo = $personalAcargo->fetch_object()):?>
                        <tr>
                            <td><?=$personaAcargo->noempleado?></td>
                            <td><?=$personaAcargo->appaterno. ' '.$personaAcargo->apmaterno.' '.$personaAcargo->nombreuser?></td>
                            <td>
                              <?php $puesto = Utils::userPuesto($personaAcargo->idpuesto);?>
                              <?= $puesto->nombrepuesto ?>
                            </td>
                            <td>
                            <?php if($personaAcargo->statusevaluado == 1):?>
                            <span class="badge bg-green">Evaluado</span>
                            <?php elseif($personaAcargo->statusevaluado == 2):?>
                            <span class="badge bg-yellow">Pendiente</span> 
                            <?php endif;?>
                            </td>
                            <td>
                            <?php if($personaAcargo->calificacion != ''):?>
                            <span class="badge bg-light text-dark"><?=$personaAcargo->calificacion?></span>
                            <?php elseif($personaAcargo->calificacion = 'null'):?>
                            <span class="badge bg-light text-dark">Evaluación Pendiente</span> 
                            <?php endif;?>
                            </td>
                            <td><?=$periodo?></td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-secondary btn-flat dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Acción</button>
                                  <ul class="dropdown-menu">
                                    <?php if($personaAcargo->statusevaluado == 1 && !empty($personaAcargo->calificacion)):?>
                                    <a id="editmodal" class="dropdown-item editbtn" href="<?=baseUrl?>?controller=evausuario&action=verEvaluacionByUserEvaluado&iduser=<?=$personaAcargo->idusuario?>"><li class="fa fa-fw fa-eye"></li> Ver Evaluación</a>
                                    <a id="editmodal" class="dropdown-item editbtn" href="<?=baseUrl?>?controller=evaluacion&action=getReporteEvaluacionByUser&user=<?=$personaAcargo->idusuario?>"><i class="fa-solid fa-file-arrow-down"></i> Ver Reporte</a>
                                    <?php elseif($personaAcargo->statusevaluado == 2):?>
                                    <a class="dropdown-item" href="<?=baseUrl?>?controller=evausuario&action=iniciaEvaluaciones&iduser=<?=$personaAcargo->idusuario?>"><svg xmlns="http://www.w3.org/2000/svg" width="18px" viewBox="0 0 512 512"><path d="M152.1 38.16C161.9 47.03 162.7 62.2 153.8 72.06L81.84 152.1C77.43 156.9 71.21 159.8 64.63 159.1C58.05 160.2 51.69 157.6 47.03 152.1L7.029 112.1C-2.343 103.6-2.343 88.4 7.029 79.03C16.4 69.66 31.6 69.66 40.97 79.03L63.08 101.1L118.2 39.94C127 30.09 142.2 29.29 152.1 38.16V38.16zM152.1 198.2C161.9 207 162.7 222.2 153.8 232.1L81.84 312.1C77.43 316.9 71.21 319.8 64.63 319.1C58.05 320.2 51.69 317.6 47.03 312.1L7.029 272.1C-2.343 263.6-2.343 248.4 7.029 239C16.4 229.7 31.6 229.7 40.97 239L63.08 261.1L118.2 199.9C127 190.1 142.2 189.3 152.1 198.2V198.2zM224 96C224 78.33 238.3 64 256 64H480C497.7 64 512 78.33 512 96C512 113.7 497.7 128 480 128H256C238.3 128 224 113.7 224 96V96zM224 256C224 238.3 238.3 224 256 224H480C497.7 224 512 238.3 512 256C512 273.7 497.7 288 480 288H256C238.3 288 224 273.7 224 256zM160 416C160 398.3 174.3 384 192 384H480C497.7 384 512 398.3 512 416C512 433.7 497.7 448 480 448H192C174.3 448 160 433.7 160 416zM0 416C0 389.5 21.49 368 48 368C74.51 368 96 389.5 96 416C96 442.5 74.51 464 48 464C21.49 464 0 442.5 0 416z"/></svg> Evaluar</a>
                                    <?php endif;?>
                                  </ul>
                              </div>
                            </td>
                            
                        </tr>
                    <?php endwhile;?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>N° Empleado</th>
                            <th>Nombre Completo</th>
                            <th>Puesto</th>
                            <th>Evaluado</th>
                            <th>Calificación</th>
                            <th>Periodo 1er/2do</th>
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
          </div>
          <!-- /.card -->

          <!-- AUTOEVALUACION SUPERVISORES -->
          <!-- <?php if($autoEvalua == 1 && $idjerarquia == 5 ):?>
          <div class="col-12 mb-3">
            <div class="card card-primary">
              <div class="card-header ">
                <h3 class="card-title">AutoEvaluación</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                  <table id="crud2" class="table table-hover text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>N° Empleado</th>
                            <th>Nombre Completo</th>
                            <th>Puesto</th>
                            <th>Evaluado</th>
                            <th>Periodo 1er/2do</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?=$_SESSION['identity']->noempleado?></td>
                            <td><?=$_SESSION['identity']->appaterno. ' '.$_SESSION['identity']->apmaterno.' '.$_SESSION['identity']->nombreuser?></td>
                            <td>
                              <?php $puesto = Utils::userPuesto($_SESSION['identity']->idpuesto);?>
                              <?= $puesto->nombrepuesto ?>
                            </td>
                            <td>
                            <?php $puesto = Utils::UserById($_SESSION['identity']->idusuario);?>
                            <?php if($puesto->statusevaluado == 1):?>
                            <span class="badge bg-green">Evaluado</span>
                            <?php elseif($puesto->statusevaluado == 2):?>
                            <span class="badge bg-yellow">Pendiente</span>
                            <?php endif;?>
                            </td>
                            <td><?=$periodo?></td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-secondary btn-flat dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Acción</button>
                                  <ul class="dropdown-menu">
                                  <?php if($_SESSION['identity']->statusevaluado == 1):?>
                                    <a id="editmodal" class="dropdown-item editbtn" href="<?=baseUrl?>?controller=evausuario&action=detalleEvaluacionByUserEvaluado&iduser=<?=$_SESSION['identity']->idusuario?>"><li class="fa fa-fw fa-eye"></li> Ver Evaluación</a>
                                    <?php elseif($_SESSION['identity']->statusevaluado == 2):?>
                                    <a class="dropdown-item" href="<?=baseUrl?>?controller=evausuario&action=iniciaEvaluaciones&iduser=<?=$_SESSION['identity']->idusuario?>"><svg xmlns="http://www.w3.org/2000/svg" width="18px" viewBox="0 0 512 512"><path d="M152.1 38.16C161.9 47.03 162.7 62.2 153.8 72.06L81.84 152.1C77.43 156.9 71.21 159.8 64.63 159.1C58.05 160.2 51.69 157.6 47.03 152.1L7.029 112.1C-2.343 103.6-2.343 88.4 7.029 79.03C16.4 69.66 31.6 69.66 40.97 79.03L63.08 101.1L118.2 39.94C127 30.09 142.2 29.29 152.1 38.16V38.16zM152.1 198.2C161.9 207 162.7 222.2 153.8 232.1L81.84 312.1C77.43 316.9 71.21 319.8 64.63 319.1C58.05 320.2 51.69 317.6 47.03 312.1L7.029 272.1C-2.343 263.6-2.343 248.4 7.029 239C16.4 229.7 31.6 229.7 40.97 239L63.08 261.1L118.2 199.9C127 190.1 142.2 189.3 152.1 198.2V198.2zM224 96C224 78.33 238.3 64 256 64H480C497.7 64 512 78.33 512 96C512 113.7 497.7 128 480 128H256C238.3 128 224 113.7 224 96V96zM224 256C224 238.3 238.3 224 256 224H480C497.7 224 512 238.3 512 256C512 273.7 497.7 288 480 288H256C238.3 288 224 273.7 224 256zM160 416C160 398.3 174.3 384 192 384H480C497.7 384 512 398.3 512 416C512 433.7 497.7 448 480 448H192C174.3 448 160 433.7 160 416zM0 416C0 389.5 21.49 368 48 368C74.51 368 96 389.5 96 416C96 442.5 74.51 464 48 464C21.49 464 0 442.5 0 416z"/></svg> Evaluar</a>
                                    <?php endif;?>
                                  </ul>
                              </div>
                            </td>
                            
                        </tr>
                    
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>N° Empleado</th>
                            <th>Nombre Completo</th>
                            <th>Puesto</th>
                            <th>Evaluado</th>
                            <th>Periodo 1er/2do</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                  </table>
              </div>
              <div class="card-footer">
                <?php echo $date= date("Y-m-d");?>
              </div>
            </div>
          <?php endif;?> -->
          <!-- END AUTOEVALUA -->
        </div>
      </div>
      <!-- alta modal -->
      <div class="modal" id="altaDepartamento">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Nuevo Departamento</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <form action="<?= baseUrl ?>?controller=departamento&action=add" method="POST">
                  <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">Nombre del Departamento </label>
                  <input type="text" class="form-control" id="formGroupExampleInput" name="namedepartamento" placeholder="Ingresa el Nombre...">
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
      <div class="modal" id="editDepartamento">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Editar Departamento</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <!-- EDIT -->
              <form action="<?= baseUrl ?>?controller=departamento&action=edit" method="POST">
              <input type="hidden" class="form-control" id="editid" name="editid">
                  <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">Nombre del Departamento</label>
                  <input type="text" class="form-control" id="nameid" name="namedep">
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