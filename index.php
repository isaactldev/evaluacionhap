<?php
// Establecer la duración de la sesión en segundos
$session_lifetime = 3600; // 1 hora
// Establecer los parámetros de la cookie de la sesión
session_set_cookie_params($session_lifetime);
session_start(); #SIEMPRE SE INICIA UNA SESSION PARA EL MANEJO DE LAS ACTIVIDADES DEL USUARIO EN LA PAGINA
/* ARCHIVOS GESTORES DEL CONTENIDO */
require_once 'config/helpers/utils.php';
require_once 'config/parameters.php';
require_once 'views/layout/head.php';
require_once 'autoload.php';
require_once 'db/db.php';
/* VALIDASION DE LA SESSION ERRORLOGIN */

/* ARCHIVOS GESTORES DEL CONTENIDO */

$urlActual = Utils::urlActual();
header("Refresh: 1439; URL='" . $urlActual . "'");
// VALIDAMOS SI LA SESSION DEL USUARIO AUN EXISTE

if ($urlActual == baseUrl) {
?>

    <body class="hold-transition login-page">
        <div class="login-box">
        <?php

    } else {
        /* SON LOS ESTILOS DEL BODY DEL LOGIN */
        ?>

            <body class="hold-transition sidebar-mini">
                <div class="wrapper">
                <?php
                /* if (!$_SESSION['identity']->rol == 'admin' || !$_SESSION['identity']->rol == 'user') {
                    Utils::existSessionUser();
                } */
                /* SON LOS ESTILOS DEL BODY DEL SIDEBAR Y DEL HEADER DEL ADMINISTRADOR */
                require_once 'views/layout/header.php';
                require_once 'views/layout/siderbar.php';
                /* /SON LOS ESTILOS DEL SIDEBAR Y DEL HEADER */
                /* CONTENIDO DEL PANEL ACORDE AL CONTENIDO */
                /* Content Wrapper. Contains page content */
            }

            if (isset($_GET['controller'])) {
                $nameController = $_GET['controller'] . 'Controller';
            } else {
                $nameController = controller_default;
            }
            if (class_exists($nameController)) {
                $controller = new $nameController();
                if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
                    $action = $_GET['action'];
                    $controller->$action();
                } else {
                    $action_defauld = action_default;
                    $controller->$action_defauld();
                }
            }
                ?>
                <?php
                if ($urlActual == baseUrl) {
                } else {
                    require_once 'views/layout/footer.php';
                }
                /* ELIMINACION DE LA SESSSION */
                Utils::deleteSession('errorLogin');
                ?>
                </div>
                <!-- ./wrapper -->
                <!-- REQUIRED SCRIPTS -->
                <!-- jQuery -->
                <script src="<?= baseUrl ?>assets/js/alertreportes360.js"></script>
                <script src="https://kit.fontawesome.com/72dd9fd10e.js" crossorigin="anonymous"></script>
                <script src="<?= baseUrl ?>/adminLTE3/AdminLTE-3.2.0/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
                <!-- Bootstrap -->
                <script src="<?= baseUrl ?>/adminLTE3/AdminLTE-3.2.0/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                <!-- AdminLTE -->
                <script src="<?= baseUrl ?>/adminLTE3/AdminLTE-3.2.0/AdminLTE-3.2.0/dist/js/adminlte.js"></script>

                <!--DATA TABLES-->
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
                <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
                <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>



                <!-- ESTILOS DE EXPORTACION EXCEL -->
                <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.templates.min.js"></script>



                <!-- OPTIONAL SCRIPTS -->
                <?php if ($_SESSION['identity']->rol == 'admin') : ?>
                    <script>
                        $(document).ready(function() {
                            $('#crud').DataTable({
                                responsive: true,
                                autowdith: false,
                                "language": {
                                    "lengthMenu": "Ver _MENU_ por pagina",
                                    "zeroRecords": "SIN INFORMACION POR MOSTRAR! - Agrega informacion al catalogo",
                                    "info": "Pagina _PAGE_ de _PAGES_",
                                    "infoEmpty": "No records available",
                                    "infoFiltered": "(Filtrado por _MAX_ registros totales)",
                                    "search": "Buscar:",
                                    "paginate": {
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                dom: 'Bfrtilp',
                                buttons: {
                                    dom: {
                                        button: {
                                            className: 'btn'
                                        }
                                    },
                                    buttons: [{
                                            extend: "excel",
                                            title: 'Resultados Encuestas',
                                            text: '<i class="fas fa-file-excel"></i> Exportar Excel',
                                            className: 'btn btn-success',
                                            excelStyles: {
                                                template: 'blue_medium',
                                            },
                                        }

                                    ]
                                }
                            });
                        });

                        $(document).ready(function() {
                            var url = location.origin;
                            var path = window.location.pathname;
                            var funcion = "verResultados";
                            var table = $('#crudResultados').DataTable({
                                processing: true,
                                stateSave: true,
                                "ajax": {
                                    url: 'config/helpers/cargarResultadosEvaluacionesUsuarios.php',
                                    "method": "POST",
                                    "data": {
                                        funcion: funcion
                                    },
                                    dataSrc: 'data'
                                },
                                columns: [{
                                        data: 'idusuario'
                                    },
                                    {
                                        data: 'noempleado'
                                    },
                                    {
                                        data: 'nombrecompleto'
                                    },
                                    {
                                        data: 'nombrepuesto'
                                    },
                                    {
                                        data: 'depnombre'
                                    },
                                    {
                                        data: 'autoevalua'
                                    },
                                    {
                                        data: 'evalua360'
                                    },
                                    {
                                        data: 'statusevaluado'
                                    },
                                    {
                                        data: 'cp1'
                                    },
                                    {
                                        data: 'cp2'
                                    },
                                    {
                                        data: 'tipoevaluacion'
                                    },
                                    {
                                        data: 'idstatus'
                                    },
                                    {
                                        data: ''
                                    },
                                    {
                                        data: ''
                                    },

                                ],


                                columnDefs: [{
                                        target: [0],
                                        visible: false,
                                        searchable: false,
                                    }, {
                                        /* ESTATUS SI APLICA AUTO EVALUACION */
                                        targets: [5],
                                        data: 'autoevalua',
                                        render: function(data, type, row) {
                                            if (data == '2') {
                                                return '<span class="badge bg-yellow">NO</span>';
                                            } else
                                                return '<span class="badge bg-success">SI</span>';
                                        }
                                    },
                                    {
                                        /* ESTATUS DE LA EVALIACION */
                                        targets: [7],
                                        data: 'statusevaluado',
                                        render: function(data, type, row) {
                                            if (data == '1') {
                                                return '<span class="badge bg-success">Evaluado</span>';
                                            } else
                                                return '<span class="badge bg-yellow">Pendiente de Evaluar</span>';
                                        }
                                    },
                                    {
                                        /* CALIFICACION PERIODO 1 */
                                        targets: [8],
                                        data: 'cp1',
                                        render: function(data, type, row) {
                                            if (data == null) {
                                                return '<a><span class="badge bg-light text-dark">0</span></a>';
                                            } else
                                                return '<a id="verEvaluacion1"><span class="badge bg-light text-dark">' + data + '</span></a><a id="resetEvaluacion1" class="btn btn-outline-secondary m-sm-2 btn-sm" data-toggle="tooltip" title="Reiniciar Evaluacion"><i class="fa-solid fa-rotate fa-2xs"></i></a>';


                                        }
                                    },
                                    {
                                        /* CALIFICACION PERIODO 2 */
                                        targets: [9],
                                        data: 'cp2',
                                        render: function(data, type, row) {
                                            if (data == null) {
                                                return '<a><span class="badge bg-light text-dark">0</span></a>';
                                            } else
                                                return '<a id="verEvaluacion2" ><span class="badge bg-light text-dark">' + data + '</span></a><a id="resetEvaluacion2" class="btn btn-outline-secondary m-sm-2 btn-sm" data-toggle="tooltip" title="Reiniciar Evaluacion"><i class="fa-solid fa-rotate fa-2xs"></i></a>';

                                        }
                                    },
                                    {
                                        /* TIPO EVALIACION */
                                        targets: [11],
                                        data: 'idstatus',
                                        render: function(data, type, row) {
                                            if (data == 1) {
                                                return '<span class="badge bg-success">Activo</span>';
                                            } else
                                                return '<span class="badge bg-danger">Inactivo</span>';
                                        }
                                    },
                                    {
                                        /* PROMEDIO */
                                        targets: [12],
                                        data: null,
                                        defaultContent: `<a><span class="badge bg-light text-dark">0</span></a>`,
                                        render: function(data, type, row) {
                                            if (row.cp1 != null && row.cp2 == null) {
                                                return '<a><span class="badge bg-light text-dark">' + row.cp1 + '</span></a>';
                                            } else if (row.cp1 == null && row.cp2 != null) {
                                                return '<a><span class="badge bg-light text-dark">' + row.cp2 + '</span></a>';
                                            } else if (row.cp1 != null && row.cp2 != null) {
                                                let promedio = (parseFloat(row.cp1) + parseFloat(row.cp2)) / 2;
                                                promedio = promedio.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0]; /* a 2 decimales sin redondeo */
                                                return '<a><span class="badge bg-light text-dark">' + promedio + '</span></a>';
                                            }

                                        }

                                    },
                                    {
                                        /* BOTONES */
                                        targets: [13],
                                        data: null,
                                        defaultContent: `
                                        <center>
                                        <a id="verReporte" class="btn btn-outline-secondary" data-toggle="tooltip" title="Ver Reporte"><i class="fa-solid fa-file-arrow-down"></i></a>
                                        </center>`,
                                    },


                                ],

                                responsive: true,
                                autowdith: false,

                                "language": {
                                    "lengthMenu": "Ver _MENU_ por pagina",
                                    "zeroRecords": "SIN INFORMACION POR MOSTRAR! - Agrega informacion al catalogo",
                                    "info": "Pagina _PAGE_ de _PAGES_",
                                    "infoEmpty": "No records available",
                                    "infoFiltered": "(Filtrado por _MAX_ registros totales)",
                                    "search": "Buscar:",
                                    "paginate": {
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    },
                                    "loadingRecords": "CARGANDO...",
                                },
                                dom: 'Bfrtilp',
                                buttons: {
                                    dom: {
                                        button: {
                                            className: 'btn'
                                        }
                                    },
                                    buttons: [{
                                            extend: "excel",
                                            title: 'Resultados Evaluaciones',
                                            text: '<i class="fas fa-file-excel"></i> Exportar Excel',
                                            className: 'btn btn-success',
                                            excelStyles: {
                                                template: 'blue_medium',
                                            },
                                        }

                                    ]
                                }
                            });
                            table.buttons().container()
                                .appendTo('#crud_wrapper .col-md-6:eq(0)');


                            /* FUNCION PARA REINICIAR LA EVALUACION */
                            $('#crudResultados tbody').on('click', '#resetEvaluacion1', function() {
                                var data = table.row($(this).parents()).data();
                                var idusuario = data.idusuario;
                                var url = location.origin;
                                var path = window.location.pathname;
                                var pariodoCalif = 1;
                                var y = new Date().getFullYear();
                                var fecha = y;


                                Swal.fire({
                                    title: '¿Estas segur@ de Reiniciar la Evaluación?',
                                    text: "Se reiniciara la evaluacion acorde al periodo seleccionado en el año en curso",
                                    icon: 'info',
                                    showCancelButton: true,
                                    confirmButtonColor: "#003467",
                                    confirmButtonText: 'Sí, recargar',
                                    cancelButtonText: 'No, cancelar'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            method: "POST",
                                            url: url + path + "config/helpers/resetEvaluacion.php",
                                            data: {
                                                idusuario: idusuario,
                                                yearC: fecha,
                                                pariodoCalif: pariodoCalif
                                            }
                                        }).done(function(response) {
                                            if (response == "200") {
                                                Swal.fire({
                                                    icon: "success",
                                                    title: "Evaluacion Reiniciada!",
                                                    text: "Notifica al Evaluador para que realice la Evaluacion Nuevamente",
                                                    showConfirmButton: false,
                                                    allowOutsideClick: false,
                                                    allowEnterKey: false,
                                                    allowEscapeKey: false,
                                                    timer: 3000
                                                });
                                                setTimeout(function() {
                                                    // Recargar la página
                                                    location.reload();
                                                }, 3100);
                                            } else {
                                                Swal.fire({
                                                    icon: "warning",
                                                    title: "Algo salio mal al Reiniciar la Evaluacion!",
                                                    text: response,
                                                    showConfirmButton: false,
                                                    allowOutsideClick: false,
                                                    allowEnterKey: false,
                                                    allowEscapeKey: false,
                                                    timer: 3000
                                                });
                                                setTimeout(function() {
                                                    // Recargar la página
                                                    location.reload();
                                                }, 3100);
                                            }
                                        });
                                    }
                                });



                            });



                            /* FUNCION PARA VER LAS RESPUESTAS DEL USUARIO DE LA EVALUACION1  */
                            $('#crudResultados tbody').on('click', '#verEvaluacion1',
                                function() {
                                    let data = table.row($(this).parents()).data();
                                    var url = location.origin;
                                    var path = window.location.pathname;

                                    let idusuario = data.idusuario;
                                    let idperiodo = 1;
                                    var y = new Date().getFullYear();
                                    let fecha = y;

                                    /* console.log(idusuario); */

                                    window.location.href = url + path + "?controller=evausuario&action=verEvaluacionByUserEvaluado&iduser=" + idusuario + "&idperiodo=1&fecha=" + fecha;
                                });
                            /* FUNCION PARA VER LAS RESPUESTAS DEL USUARIO DE LA EVALUACION1  */
                            $('#crudResultados tbody').on('click', '#verEvaluacion2',
                                function() {
                                    let data = table.row($(this).parents()).data();
                                    var url = location.origin;
                                    var path = window.location.pathname;

                                    let idusuario = data.idusuario;
                                    let idperiodo = 2;
                                    var y = new Date().getFullYear();
                                    let fecha = y;

                                    /* console.log(idusuario); */

                                    window.location.href = url + path + "?controller=evausuario&action=verEvaluacionByUserEvaluado&iduser=" + idusuario + "&idperiodo=2&fecha=" + fecha;
                                });

                            /* FUNCION PARA VER EL REPORTE DE CALIFICACIONES DEL USUARIO */
                            $('#crudResultados tbody').on('click', '#verReporte',
                                function() {
                                    let data = table.row($(this).parents()).data();
                                    var url = location.origin;
                                    var path = window.location.pathname;

                                    let idusuario = data.idusuario;
                                    console.log(idusuario);

                                    window.location.href = url + path + "?controller=evaluacion&action=getReporteEvaluacionByUser&user=" + idusuario;
                                })
                        });

                        /* CRUD DE INFOUSUARIOS EN EL ADMIN */

                        $(document).ready(function() {
                            var funcion = "verUsuarios";
                            var table = $('#cruduser').DataTable({
                                processing: true,
                                stateSave: true,
                                "ajax": {
                                    url: 'config/helpers/cargarUsuariosdatatable.php',
                                    "method": "POST",
                                    "data": {
                                        funcion: funcion
                                    },
                                    dataSrc: 'data'
                                },
                                columns: [{
                                        data: 'idusuario'
                                    },
                                    {
                                        data: 'noempleado'
                                    },
                                    {
                                        data: 'nombrecompleto'
                                    },
                                    {
                                        data: 'appaterno'
                                    },
                                    {
                                        data: 'nombrepuesto'
                                    },
                                    {
                                        data: 'depnombre'
                                    },
                                    {
                                        data: 'autoevalua'
                                    },
                                    {
                                        data: 'evalua360'
                                    },
                                    {
                                        data: 'tipoevaluacion'
                                    },
                                    {
                                        data: 'idstatus'
                                    },
                                    {
                                        data: ''
                                    },

                                ],
                                columnDefs: [{
                                        targets: -1,
                                        data: 'idstatus',
                                        defaultContent: `<button id="editmodal" type="button" class="btn btn-outline-secondary btn-block btn-flat editbtn" data-bs-toggle="modal" data-bs-target="#editinfoUsuarios">
                                        <i class="fas fa-user-edit"></i>
                                    </button>`,
                                    },
                                    {
                                        targets: [6],
                                        data: 'autoevalua',
                                        render: function(data, type, row) {
                                            if (data == '2') {
                                                return '<span class="badge bg-yellow">NO</span>';
                                            } else
                                                return '<span class="badge bg-success">SI</span>';
                                        }
                                    },
                                    {
                                        targets: [9],
                                        data: 'idstatus',
                                        render: function(data, type, row) {
                                            if (data == '1') {
                                                return '<span class="badge bg-success">ACTIVO</span>';
                                            } else
                                                return '<span class="badge bg-danger">INACTIVO</span>';
                                        }
                                    },

                                ],

                                responsive: true,
                                autowdith: false,
                                "language": {
                                    "lengthMenu": "Ver _MENU_ por pagina",
                                    "zeroRecords": "SIN INFORMACION POR MOSTRAR! - Agrega informacion al catalogo",
                                    "info": "Pagina _PAGE_ de _PAGES_",
                                    "infoEmpty": "No records available",
                                    "infoFiltered": "(Filtrado por _MAX_ registros totales)",
                                    "search": "Buscar:",
                                    "paginate": {
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    },
                                    "loadingRecords": "CARGANDO...",
                                },
                                dom: 'Bfrtilp',
                                buttons: {
                                    dom: {
                                        button: {
                                            className: 'btn'
                                        }
                                    },
                                    buttons: [{
                                            extend: "excel",
                                            title: 'Usuarios del Sistema',
                                            text: '<i class="fas fa-file-excel"></i> Exportar Excel',
                                            className: 'btn btn-success',
                                            excelStyles: {
                                                template: 'blue_medium',
                                            },
                                        }

                                    ]
                                }
                            });
                            table.buttons().container()
                                .appendTo('#crud_wrapper .col-md-6:eq(0)');

                            /* FUNCION DE EDITAR  */
                            $('#cruduser tbody').on('click', '#editmodal', function() {
                                let data = table.row($(this).parents()).data(); /* OPTENEMOS LA INFORMACION DEL RENGLON */
                                $('#editid').val(data.idusuario);
                                $('#noEmpleado').val(data.noempleado);
                                $('#username').val(data.nombrecompleto);
                                $('#editname').val(data.nombreuser);
                                $('#editapPatertno').val(data.appaterno);
                                $('#editapMaterno').val(data.apmaterno);
                                $('#editdepa').val(data.iddepartamento);
                                $('#editpuestoUser').val(data.idpuesto);
                                $('#editjerarquico').val(data.idjerarquia);
                                $('#editEvluador').val(data.evaluador);
                                $('#editevluadorOpcional').val(data.evaluador);
                                $('#edittipoEva').val(data.tipoevaluacion);
                                $('#editpersEva').val(data.autoevalua);
                                $('#editevalua360').val(data.evalua360);
                                $('#idstatus').val(data.idstatus);
                                $('#idplanta').val(data.enplanta);

                                /* ENVIAMOS EL DEPARTAMENTO PARA EL FILTRO */
                                var idDep = parseInt(data.iddepartamento);
                                var idPuestoUser = parseInt(data.idpuesto);
                                var idjerarquia = parseInt(data.idjerarquia);
                                var noEvaluador = parseInt(data.evaluador);


                                $.post("config/helpers/cargarPuesto.php", {
                                    ID: idDep,
                                    idPuestoUser: idPuestoUser
                                }, function(mensaje) {
                                    $("#editpuestoUser").html(mensaje);
                                });
                                $.post("config/helpers/cargarJerarquia.php", {
                                    idjerarquia: idjerarquia
                                }, function(mensaje) {
                                    $("#editjerarquico").html(mensaje);
                                });
                                $.post("config/helpers/cargarEvaluadorxdep.php", {
                                    idDepartamento: idDep,
                                    noEvaluador: noEvaluador
                                }, function(mensaje) {
                                    $("#editEvluador").html(mensaje);
                                });



                            })

                            $('#editformUserinfo').submit(e => {
                                /* CAPTURAMOS LOS VALORES DEL MODAL */

                                let editid = $('#editid').val();
                                let noEmpleado = $('#noEmpleado').val();
                                let editname = $('#editname').val();
                                let editapPatertno = $('#editapPatertno').val();
                                let editapMaterno = $('#editapMaterno').val();
                                let editdepa = $('#editdepa').val();
                                let editpuestoUser = $('#editpuestoUser').val();
                                let editjerarquico = $('#editjerarquico').val();
                                let editEvluador = $('#editEvluador').val();
                                let editevluadorOpcional = $('#editevluadorOpcional').val();
                                let edittipoEva = $('#edittipoEva').val();
                                let editpersEva = $('#editpersEva').val();
                                let editevalua360 = $('#editevalua360').val();
                                let idstatus = $('#idstatus').val();


                                var url = location.origin;
                                var path = window.location.pathname;

                                funcion = 'editar';
                                $.post("config/helpers/cargarUsuariosdatatable.php", {
                                        funcion,
                                        editid,
                                        noEmpleado,
                                        editname,
                                        editapPatertno,
                                        editapMaterno,
                                        editdepa,
                                        editpuestoUser,
                                        editjerarquico,
                                        editEvluador,
                                        editevluadorOpcional,
                                        edittipoEva,
                                        editpersEva,
                                        editevalua360,
                                        idstatus
                                    },
                                    (response) => {
                                        /* alert(response); */
                                        if (response == "okeditUser") {
                                            window.location.href = url + path + "?controller=usuario&action=index";
                                        } else {
                                            alert(response);
                                        }


                                    })

                            })


                        });
                    </script>

                <?php else : ?>
                    <script>
                        $(document).ready(function() {
                            $('#crud').DataTable({
                                responsive: true,
                                autowdith: false,
                                "language": {
                                    "lengthMenu": "Ver _MENU_ por pagina",
                                    "zeroRecords": "SIN INFORMACION POR MOSTRAR! - Agrega informacion al catalogo",
                                    "info": "Pagina _PAGE_ de _PAGES_",
                                    "infoEmpty": "No records available",
                                    "infoFiltered": "(Filtrado por _MAX_ registros totales)",
                                    "search": "Buscar:",
                                    "paginate": {
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                }
                            });
                        });
                    </script>
                <?php endif; ?>
                <script>
                    $(document).ready(function() {
                        $('#crud2').DataTable({
                            responsive: true,
                            autowdith: false,
                            "language": {
                                "lengthMenu": "Ver _MENU_ por pagina",
                                "zeroRecords": "SIN INFORMACION POR MOSTRAR! - Agrega informacion al catalogo",
                                "info": "Pagina _PAGE_ de _PAGES_",
                                "infoEmpty": "No records available",
                                "infoFiltered": "(Filtrado por _MAX_ registros totales)",
                                "search": "Buscar:",
                                "paginate": {
                                    "next": "Siguiente",
                                    "previous": "Anterior"
                                }
                            }
                        });
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        $('#compromisosTable').DataTable({
                            responsive: true,
                            autowdith: false,
                            "language": {
                                "lengthMenu": "Ver _MENU_ por pagina",
                                "zeroRecords": "SIN INFORMACION POR MOSTRAR! - Agrega informacion al catalogo",
                                "info": "Pagina _PAGE_ de _PAGES_",
                                "infoEmpty": "No records available",
                                "infoFiltered": "(Filtrado por _MAX_ registros totales)",
                                "search": false,
                                "paginate": {
                                    "next": "Siguiente",
                                    "previous": "Anterior"
                                }

                            }
                        });
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        $('#capacitacionTable').DataTable({
                            responsive: true,
                            autowdith: false,
                            "language": {
                                "lengthMenu": "Ver _MENU_ por pagina",
                                "zeroRecords": "SIN INFORMACION POR MOSTRAR! - Agrega informacion al catalogo",
                                "info": "Pagina _PAGE_ de _PAGES_",
                                "infoEmpty": "No records available",
                                "infoFiltered": "(Filtrado por _MAX_ registros totales)",
                                "search": false,
                                "paginate": {
                                    "next": "Siguiente",
                                    "previous": "Anterior"
                                }
                            }
                        });
                    });
                </script>
                <!-- DATATABLES JS CARDEX -->
                <script src="<?= baseUrl ?>assets/js/cardexCalificaciones.js"></script>
            </body>

            </html>