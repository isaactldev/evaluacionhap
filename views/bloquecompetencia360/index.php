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
                    <h1>ALTA DE BLOQUES DE COMPETENCIAS 360°</h1>
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
                    <h3 class="card-title">Competencias 360°</h3>
                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2 d-md-flex mb-2 justify-content-md-end">
                    <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#altabloqueCompetencia"><i class="fa fa-fw fa-plus-square-o"></i> Agregar Competencias 360°</button>
                    </div>
                    <table id="crud" class="table table-hover text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Bloque de Competencia 360°</th>
                                <th>Estatus</th>
                                <th>Fecha</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($bloques360 = $allBloques360->fetch_object()):?>
                            <tr>
                                <td><?=$bloques360->idbloqueCompeGen360?></td>
                                <td><?=$bloques360->namebloque360?></td>
                                <td>
                                <?php if($bloques360->idstatus == 1):?>
                                <span class="badge bg-green">Activo</span>
                                <?php elseif($bloques360->idstatus == 2):?>
                                <span class="badge bg-yellow">Inactivo</span>
                                <?php endif;?>
                                </td>
                                <td><?=$bloques360->fecha?></td>
                                <td>
                                <?php if($bloques360->idstatus == 1):?>
                                    <a class="btn btn-outline-danger" href="<?= baseUrl ?>?controller=bloquecompetencias&action=DesactivaryActivarBloque360&idstatus=2&idbloque=<?=$bloques360->idbloqueCompeGen360?>"><i class="fa-solid fa-square-minus"></i></a>
                                <?php elseif($bloques360->idstatus == 2):?>
                                    <a class="btn btn-outline-success" href="<?= baseUrl ?>?controller=bloquecompetencias&action=DesactivaryActivarBloque360&idstatus=1&idbloque=<?=$bloques360->idbloqueCompeGen360?>"><i class="fa-solid fa-square-check"></i></a>
                                <?php endif;?>
                                <a id="editmodal" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editbloqueCompetencia<?=$bloques360->idbloqueCompeGen360?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                </td>

                                    <!-- EDIT MODAL -->
                                    <div class="modal" id="editbloqueCompetencia<?=$bloques360->idbloqueCompeGen360?>">
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
                                            <form action="<?= baseUrl ?>?controller=bloquecompetencias&action=editBloque360" method="POST">
                                            <input type="hidden" class="form-control" id="editid" name="editidbloque360" value="<?=$bloques360->idbloqueCompeGen360?>">
                                                <div class="mb-3">
                                                <label for="formGroupExampleInput" class="form-label">Nombre del Bloque</label>
                                                <input type="text" class="form-control" id="nameid" name="namebloque360" value="<?=$bloques360->namebloque360?>">
                                                </div>
                                                
                                                <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4"><i class="fas fa-plus-square"></i> Guardar</button>
                                            </form>
                                            <!-- EDIT -->
                                            </div>
                                            <!-- Modal body -->
                                        </div>
                                        </div>
                                    </div>
                                    <!-- /EDIT MODAL -->
                            </tr>
                        <?php endwhile;?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>N°</th>
                                <th>Bloque de Competencia 360°</th>
                                <th>Estatus</th>
                                <th>Fecha</th>
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



        
        <!-- ALTA MODAL -->
        <div class="modal" id="altabloqueCompetencia">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Nueva Competencias 360°</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                <form action="<?= baseUrl ?>?controller=bloquecompetencias&action=altabloque360" method="POST">
                    <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Competencias 360°</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" name="nameblocomp360" placeholder="Ingresa el Nombre...">
                    </div>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4"><i class="fas fa-plus-square"></i> Guardar</button>
                </form>
                </div>
                <!-- Modal body -->
            </div>
            </div>
        </div>
        <!-- /ALTA MODAL -->

        

        <!-- /alta modal -->
        </section>
    </div>
    <!-- /.content-wrapper -->