<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>EVALUACIÓN DE COMPETENCIAS LABORALES <?=$date = date('Y');?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Listado de Evaluaciones</h3>

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
                            <th>No°Empleado</th>
                            <th>Nombre</th>
                            <th>Puesto</th>
                            <th>Departamento</th>
                            <th>Eva_Personal</th>
                            <th>Evaluación 360°</th>
                            <th>Calificación</th>
                            <th>Tipo de Evaluación</th>
                            <th>Estatus</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php while ($usuario = $evaluacionesResult->fetch_object()) : ?>
                        <tr>
                            <td><?= $usuario->noempleado ?></td>
                            <td><?= $usuario->nombreuser . ' ' . $usuario->appaterno . ' ' . $usuario->apmaterno ?></td>
                            
                            <td>
                              <?php $puesto = Utils::userPuesto($usuario->idpuesto);?>
                              <?= $puesto->nombrepuesto ?>
                            </td>
                            <td>
                              <?php $userDepartamento = Utils::userDepartamento($usuario->iddepartamento);?>
                              <?= $userDepartamento->depnombre ?>
                            </td>
                            <td>
                            <?php if ($usuario->autoevalua == 1) : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15px" viewBox="0 0 448 512"><path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"/></svg>
                            <?php elseif ($usuario->autoevalua == 2) : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15px"viewBox="0 0 320 512"><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                            <?php endif; ?>
                            </td>
                            <td><?= $usuario->evalua360 ?></td>
                            <?php if(empty($usuario->calificacion)) :?>
                            <td><span class="badge bg-yellow">Pendiente de Evaluar</span></td>
                            <?php else : ?>
                            <td><?= $usuario->calificacion ?></td>
                            <?php endif?>
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
                                    <?php if($usuario->statusevaluado == 1 && !empty($usuario->calificacion)):?>
                                    <a id="editmodal" class="dropdown-item editbtn" href="<?=baseUrl?>?controller=evausuario&action=verEvaluacionByUserEvaluado&iduser=<?=$usuario->idusuario?>"><li class="fa fa-fw fa-eye"></li> Ver Evaluación</a>
                                    <a id="editmodal" class="dropdown-item editbtn" href="<?=baseUrl?>?controller=evaluacion&action=getReporteEvaluacionByUser&user=<?=$usuario->idusuario?>"><i class="fa-solid fa-file-arrow-down"></i> Ver Reporte</a>
                                    <?php else:?>
                                    <a id="editmodal" class="dropdown-item editbtn" ><i class="fas fa-exclamation"></i> Sin Opciones</a>
                                    <?php endif;?>
                                  </ul>
                              </div>
                            </td>
                            
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No°Empleado</th>
                            <th>Nombre</th>
                            <th>Puesto</th>
                            <th>Departamento</th>
                            <th>Eva_Personal</th>
                            <th>Evaluación 360°</th>
                            <th>Calificación</th>
                            <th>Tipo de Evaluación</th>
                            <th>Estatus</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                  </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                Footer
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->