<?php
if (isset($_SESSION['addPregunta']) && $_SESSION['addPregunta'] == 'addPregunta') {
  echo "<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2550,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  
  Toast.fire({
    icon: 'success',
    title: 'Pregunta Añadida Correctamente!'
  })
        </script>";
}if(isset($_SESSION['addPregunta']) && $_SESSION['addPregunta'] == 'erroraddPregunta') {
  # code...
  echo "<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2550,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  
  Toast.fire({
    icon: 'error',
    title: 'Ups! La Pregunta no se Añadio Correctamente'
  })
        </script>";
}
if(isset($_SESSION['desactivarPregunta']) && $_SESSION['desactivarPregunta'] == 'desactivarPregunta') {
  # code...
  echo "<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2550,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  
  Toast.fire({
    icon: 'success',
    title: 'Pregunta Desactivada Correctamente!'
  })
        </script>";
}
if(isset($_SESSION['desactivarPregunta']) && $_SESSION['desactivarPregunta'] == 'errordesactivarPregunta') {
  # code...
  echo "<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2550,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  
  Toast.fire({
    icon: 'error',
    title: 'Ups! No se Desactivo Correctamente'
  })
        </script>";
}
if(isset($_SESSION['editPregunta']) && $_SESSION['editPregunta'] = 'editPregunta') {
  # code...
  echo "<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2550,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  
  Toast.fire({
    icon: 'success',
    title: 'Pregunta Editada Correctamente!'
  })
        </script>";
}
if(isset($_SESSION['editPregunta']) && $_SESSION['editPregunta'] == 'erroreditPreguntaPregunta') {
  # code...
  echo "<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2550,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  
  Toast.fire({
    icon: 'error',
    title: 'Ups! No pudimos Editar la Pregunta Correctamente'
  })
        </script>";
}
Utils::deleteSession('editPregunta');
Utils::deleteSession('desactivarPregunta');
Utils::deleteSession('addPregunta');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- container fluit-->
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>CUESTIONARIO DE EVALUACION AL PERSONAL HAP </h1>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><strong>GENERA LAS PREGUNTAS PARA LA EVALUACION</strong></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <?php 
                if (isset($_GET['id']) && $_GET['id'] == 9) {
                  $action  = "?controller=cuestionariogen360&action=addPregunta";
                }else{
                  $action = "?controller=cuestionariogen&action=addPregunta";
                }
                ?>
                <form action="<?= baseUrl.$action?>" method="POST">
                  <div class="row">
                    <div class="col-8 mb-3">
                      <label for="formGroupExampleInput" class="form-label">Redacta la Pregunta </label>
                      <input type="text" class="form-control" id="pregunta" name="pregunta" placeholder="Escribe una Pregunta para la Evaluacion">
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
                  <div class="row">
                    <div class="col-4">
                      <?php
                        $id = $_GET['id'];
                        $evaluacion = Utils::showEvaluacionById($id);
                      ?>
                      <label for="formGroupExampleInput" class="form-label">Evaluacion a la que Pertenece</label>
                          <select id="eva" class="form-select" name="idevaluacion" aria-label="Default select example" onchange="altacargaPuesto();">
                            <option value="<?= $evaluacion->idtipoeveluacion?>" selected><?= $evaluacion->idtipoevaluacion . $evaluacion->evaluacion ?></option>
                          </select>
                    </div>
                    <div class="col-8 mb-3">
                      <label for="formGroupExampleInput" class="form-label">Bloque de competencia</label>

                      <?php 
                          $bloques = Utils::showBloqueCompetencia360();
                      ?>
                        
                        <select class="form-select" name="idbloque" aria-label="Default select example">
                          <option selected>Bloque al que Pertenece</option>
                          <?php while ($bloque = $bloques->fetch_object()):?>
                          <option value="<?= $bloque->idbloqueCompeGen360?>"><?= $bloque->namebloque360?></option>
                          <?php endwhile;?>
                        </select>


                      </div>
                    </div>
                <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4"><i class="fas fa-save"> </i> Agregar al Listado</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card card-primary">
              <div class="card-header">
              <?php
              $ideva = $_GET['id'];
              $evaluacion = Utils::showEvaluacionById($ideva);
              ?>
                <h3 class="card-title">Cuestionatio de la Evaluacion: <strong> <?= $evaluacion->evaluacion;?></strong></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                  <table id="crud" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Pregunta</th>
                            <th>Bloque de Competencia</th>
                            <th>Estatus</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($preg = $pregunta->fetch_object()):?>
                        <tr>
                            <td><?=$preg->idcuestionarioeva360?></td>
                            <td><?=$preg->pregunta360?></td>

                            <?php $bloque = Utils::showBloqueCompetencia360ById($preg->idbloque360);?>
                            <td><?=$bloque->namebloque360?></td>
                            
                            <td>
                            <?php if($preg->idstatus == 1):?>
                            <span class="badge bg-green">Activo</span>
                            <?php elseif($preg->idstatus == 2):?>
                            <span class="badge bg-yellow">Inactivo</span>
                            <?php endif;?>
                            </td>
                            
                            <td>
                              
                              <?php if($preg->idstatus == 1):?>
                                    <a class="btn btn-outline-danger" href="<?= baseUrl ?>?controller=cuestionariogen360&action=DesactivaryActivarPregunta360&idstatus=2&idpregunta=<?=$preg->idcuestionarioeva360?>&ideva=<?=$ideva?>"><i class="fa-solid fa-square-minus"></i></a>
                                <?php elseif($preg->idstatus == 2):?>
                                    <a class="btn btn-outline-success" href="<?= baseUrl ?>?controller=cuestionariogen360&action=DesactivaryActivarPregunta360&idstatus=1&idpregunta=<?=$preg->idcuestionarioeva360?>&ideva=<?=$ideva?>"><i class="fa-solid fa-square-check"></i></a>
                                <?php endif;?>
                                <a id="editmodal" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editbloqueCompetencia<?=$bloques360->idbloqueCompeGen360?>"><i class="fa-solid fa-pen-to-square"></i></a>

                            </td>
                            
                        </tr>
                    <?php endwhile;?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Pregunta</th>
                            <th>Bloque de Competencia</th>
                            <th>Estatus</th>
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
      <!-- EDIT modal -->
      <div class="modal" id="editPreguna">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Editar Pregunta</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <!-- EDIT -->
              <form action="<?= baseUrl ?>?controller=cuestionariogen&action=editPregunta" method="POST">
              <input type="hidden" class="form-control" id="ideva" name="ideva" value="<?=$evaid?>">
              <input type="hidden" class="form-control" id="editid" name="editid">
                  <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">Pregunta del Cuestionario</label>
                  <input type="text" class="form-control" id="nameid" name="pregunta">
                </div>
                <div class="form-group mb-3">
                  <label for="formGroupExampleInput" class="form-label">Bloque de competencia</label>
                  <?php 
                    $bloques = Utils::showBloqueCompetencia();
                  ?>
                    <select class="form-select" name="idbloque" aria-label="Default select example">
                      <option value="">Bloque al que Pertenece</option>
                      <?php while ($bloque = $bloques->fetch_object()):?>
                      <option value="<?= $bloque->idbloque?>"><?= $bloque->bloquecompetencia?></option>
                      <?php endwhile;?>
                    </select>
                    <p><small>Si no se selecciona ningun Bloque no se cambiara el Bloque actual.</small></p>
                </div>
                <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Estatus</label>
                <?php $estado = Utils::showEstatus(); ?>
                  <select class="form-select" name="idestatus" aria-label="Default select example" require>
                    <option value="" >Selecciona el estatus</option>
                    <?php while ($status = $estado->fetch_object()):?>
                    <option value="<?= $status->idstatus?>"><?= $status->status?></option>
                    <?php endwhile;?>
                  </select>
                  <p><small>Si no se selecciona el estatus se quedara el Actual.</small></p>
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