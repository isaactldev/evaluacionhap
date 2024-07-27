<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CARDEX DE CALIFICACIONES DEL PERSONAL HAP <i class="fas fa-users"></i></h1>
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
                            <h3 class="card-title">CARDEX DE CALIFICACIONES DEL PEROSNAL HAP DEL <?= $yearCardex ?></h3>
                            <input type="hidden" id="fechaCardex" name="fechaCardex" value="<?= $yearCardex ?>">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="crudCardex" class="table table-hover text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No°Empleado</th>
                                        <th>Nombre</th>
                                        <th>Puesto</th>
                                        <th>Departamento</th>
                                        <th>Calificación del Periodo 1</th>
                                        <th>Calificación del Periodo 2</th>
                                        <th>Promedio</th>
                                        <th>Tipo de Evaluación</th>
                                        <th>Estatus</th>
                                        <th>Año</th>
                                        <!-- <th>Opciones</th> -->
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>No°Empleado</th>
                                        <th>Nombre</th>
                                        <th>Puesto</th>
                                        <th>Departamento</th>
                                        <th>Calificación del Periodo 1</th>
                                        <th>Calificación del Periodo 2</th>
                                        <th>Promedio</th>
                                        <th>Tipo de Evaluación</th>
                                        <th>Estatus</th>
                                        <th>Año</th>
                                        <!-- <th>Opciones</th> -->
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