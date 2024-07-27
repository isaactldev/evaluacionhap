<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CRUCES DE LA EVALUACION 360° <?= $date = date('Y'); ?></h1>
                    <form action="<?= baseUrl ?>reportsEcxel/cargarcruces360.php" method="POST" enctype="multipart/form-data">
                        <div class="custom-file">
                            <input type="file" class="form-control-file border" name="carga360">
                            <span class="badge bg-warning p-2 text-dark bg-opacity-25 mt-1 font-italic">Recuerda que el formato del Archivo debe ser (.CSV) Con el Siguiente Formato: | No_Empleado_Evaluador | No_Empleado_Evaluado |calif | Periodo | status | tipo_Evaluador | fecha |
                            </span>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">Generar Cruces 360°</button>
                        </div>
                    </form>
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
                    <?php while ($evaluado360 = $evaluados360->fetch_object()) : ?>
                        <div class="card card-primary">
                            <div class="card-header">
                                <?php $infoUser360 = Utils::UserByNoEmpleado($evaluado360->noempleado); ?>
                                <h3 class="card-title">PERSONAL QUE EVALUA A <strong><?= $infoUser360->noempleado . " " . $infoUser360->nombreuser . ' ' . $infoUser360->appaterno . ' ' . $infoUser360->apmaterno ?></strong></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <?php $allEvaluadores = Utils::getEvaluadoresByIdEvaluado($evaluado360->noempleado, $periodoActivo->idperiodo); ?>
                            <div class="card-body">
                                <table class="table table-hover text-center" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="display: none;">idperosnal360</th>
                                            <th>No.Empleado</th>
                                            <th>Evaluador</th>
                                            <th>No.Empleado</th>
                                            <th>Evaluado</th>
                                            <th>Promedio</th>
                                            <th>Periodo</th>
                                            <th>Estatus</th>
                                            <th>Tipo Evaluador</th>
                                            <th>Fecha</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($allEvaluadores == false) : ?>
                                            <tr>
                                                <td colspan="10" rowspan="10"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                    </svg> SIN INFORMACION POR MOSTRAR!</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php while ($evaluador360 = $allEvaluadores->fetch_object()) : ?>
                                                <tr>
                                                    <td style="display: none;"><?= $evaluador360->idpersonal360 ?></td>
                                                    <td><?= $evaluador360->idevaluador ?></td>

                                                    <?php $infoUserEvaluador360 = Utils::UserByNoEmpleado($evaluador360->idevaluador); ?>
                                                    <td><?= $infoUserEvaluador360->nombreuser . " " . $infoUserEvaluador360->appaterno . " " . $infoUserEvaluador360->apmaterno ?></td>

                                                    <td><?= $evaluador360->idevaluado ?></td>
                                                    <?php $infoUserEvaluado360 = Utils::UserByNoEmpleado($evaluador360->idevaluador); ?>
                                                    <td><?= $infoUserEvaluado360->nombreuser . " " . $infoUserEvaluado360->appaterno . " " . $infoUserEvaluado360->apmaterno ?></td>

                                                    <?php

                                                    if ($evaluador360->promFinalCalif360 == null) {
                                                        $calif360 = 0;
                                                    } else {
                                                        $calif360 = $evaluador360->promFinalCalif360;
                                                    }
                                                    ?>
                                                    <td><a><span class="badge bg-light text-dark"><?= $calif360 ?></span></a></td>
                                                    <td><?= $evaluador360->periodo ?></td>

                                                    <?php if ($evaluador360->statuseva360 === 1) : ?>
                                                        <td><span class="badge bg-success">Evaluado</span></td>
                                                    <?php else : ?>
                                                        <td><span class="badge bg-yellow">Pendiente de Evaluar</span></td>
                                                    <?php endif; ?>

                                                    <td><?= $evaluador360->tipoevaluador ?></td>
                                                    <td><?= $evaluador360->fecha ?></td>
                                                    <td>
                                                        <center><a id="editarCruce360" class="btn btn-outline-secondary" data-toggle="tooltip" title="Editar Cruce360"><svg xmlns="http://www.w3.org/2000/svg" width="18px" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z" />
                                                                </svg></a></center>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th style="display: none;">idperosnal360</th>
                                            <th>No.Empleado</th>
                                            <th>Evaluador</th>
                                            <th>No.Empleado</th>
                                            <th>Evaluado</th>
                                            <th>Promedio</th>
                                            <th>Periodo</th>
                                            <th>Estatus</th>
                                            <th>Tipo Evaluador</th>
                                            <th>Fecha</th>
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
                    <?php endwhile; ?>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>
    var url = location.origin;
    var path = window.location.pathname;
    console.log(url + path + "?controller=evaluacionpersonal360&action=cruces360");
</script>