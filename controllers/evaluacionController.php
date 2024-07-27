<?php
require_once 'models/usuarios.php';
require_once 'models/evaluaciones.php';
require_once 'models/tipoevaluacion.php';
require_once 'models/calificacion360.php';
require_once 'models/califTec360.php';
require_once 'models/statussitioweb.php';
require_once 'models/califCapacitaciones.php';
require_once 'models/calificacioncapacitacion.php';

class evaluacionController
{

    public function guiaEvaluacion()
    {
        require_once 'views/guiaEvaluacion/index.php';
    }

    public function index()
    {
        /* PANTALLA DEL LOGIN */
        require_once 'views/login.php';
    }
    public function allUsuarioStatusEvaluacion()
    {
        Utils::isAdmin();
        /* EN ESTA VISTA SE MUESTRA EL RECOPILADO DE LAS EVALUACIONES */
        $resultadosEvaluaciones = new Usuarios();
        $evaluacionesResult = $resultadosEvaluaciones->getAllUsuarios();
        require_once 'views/dashboard/index.php';
    }

    public function login()
    {
        /* VALIDACION DE LOGIN */
        if (isset($_POST)) {
            $user =  $_POST['user'];
            $pass = $_POST['pass'];
            # IDENTIFICAR AL USUARIO 
            # GENERAR LA CONSULATA A LA BD 
            # CREAR LA SESSION PARA EL USUARIO
            $usuario = new Usuarios();
            $usuario->setUsuario($user);
            $usuario->setPassword($pass);
            $identity = $usuario->login(); # ESTE ES EL METODO DE LA CLASE USUARIO PARA GENERAR LA CONSULTA Y HACER EL LOGIN

            /* ESTATUS SITIO WEB ->1 = ACTIVO PARA USUARIOS COLABORADORES
                ESTATUS SITIO WEB ->2 = INACTIVO PARA USUARIOS COLABORADORES */
            $statusSitioWeb = new statusSitiiWeb();
            $statusWeb = $statusSitioWeb->statusSitioWeb();
            if ($identity->rol ==  "user" && $statusWeb->sitioactivo == 2) {
                echo '<script>
                        window.location.replace("' . baseUrl . 'views/errors/closePlataform.php");
                        </script>';
            }

            if ($identity == false) {
                /* VALIDACION DEL USUARIO */
                $_SESSION['errorLogin'] = true;

                if (isset($_SESSION['errorLogin']) && $_SESSION['errorLogin'] == true) { ?>
                    <script>
                        var url = location.origin;
                        var path = window.location.pathname;
                        Swal.fire({
                            icon: "warning",
                            title: "Error al Iniciar Session!",
                            text: "El Usuario o la Contraseña son Incorrectos!",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            allowEnterKey: true,
                            allowEscapeKey: false,
                        })
                        setTimeout(function() {
                            window.location.href = url + path; //URL DEL LOGIN
                        }, 2100); //SI EL USUARIO  NO EXISTE MUESTRA LA ALERTA Y REDIRIQUE A LA URL DE LOGIN 
                    </script>
                    <?php

                }
            } else {
                if ($identity && is_object($identity)) {
                    # code...
                    $_SESSION['identity'] = $identity;
                    #validamos si la session es de un "Admin"
                    if ($identity->rol == 'admin') {
                        # code...
                        $_SESSION['admin'] = true;
                        echo '<script>
                        window.location.replace("' . baseUrl . '?controller=evaluacion&action=guiaEvaluacion");
                        </script>';
                        require_once 'views/dashboard/index.php';
                    }
                    if ($identity->rol == 'user') {
                        $_SESSION['user'] = true;
                        echo '<script>
                        window.location.replace("' . baseUrl . '?controller=evausuario&action=guiaEvaluacion");
                        </script>';
                        require_once 'views/dashboard/index.php';
                    }
                } else {
                    //sino no hace login mostramos una session de error en el login
                    $_SESSION['errorLogin'] = true;
                    if (isset($_SESSION['errorLogin']) && $_SESSION['errorLogin'] == true) { ?>
                        <script>
                            var url = location.origin;
                            var path = window.location.pathname;
                            Swal.fire({
                                icon: "warning",
                                title: "Error al Iniciar Session!",
                                text: "El Usuario o la Contraseña son Incorrectos!",
                                showConfirmButton: false
                            })
                            setTimeout(function() {
                                window.location.href = url + path; //URL DEL LOGIN
                            }, 2100); //SI EL USUARIO  NO EXISTE MUESTRA LA ALERTA Y REDIRIQUE A LA URL DE LOGIN 
                        </script>
<?php

                    }
                }
            }
        }
    }
    public function logout()
    {
        //Borramos la session del usuario
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']); //asi se elimina la session activa
        }
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        echo '<script>
                window.location.replace("' . baseUrl . '");
            </script>';
    }
    public function tipoEvaluacion()
    {
        Utils::isAdmin();
        $tipoevaluaciones = new TipoEvaliaciones();
        $tipoEvaluacion = $tipoevaluaciones->getAlltipoEncuestas();
        require_once 'views/tipoevaluaciones/index.php';
    }
    public function altaTipoEvaluacion()
    {
        Utils::isAdmin();
        if (isset($_POST)) {
            $nameEncuessta = $_POST['nameTipoEva'];
            $encuesta = new TipoEvaliaciones();
            $encuesta->setEvaluacion($nameEncuessta);
            $save = $encuesta->addtipoEncuesta();
            if ($save) {
                $_SESSION['saveEncuesta'] = 'saveEncuesta';
                echo '<script>
                window.location.replace("' . baseUrl . '?controller=evaluacion&action=tipoEvaluacion");
                </script>';
            } else {
                $_SESSION['saveEncuesta'] = 'errorEncuesta';
                echo '<script>
                window.location.replace("' . baseUrl . '?controller=evaluacion&action=tipoEvaluacion");
                </script>';
            }
        }
    }
    public function editTipoEvaluacion()
    {
        Utils::isAdmin();
        if (isset($_POST)) {
            $idEcnuesta = $_POST['editid'];
            $nameEncuessta = $_POST['nameid'];
            $estatus = $_POST['idestatus'];

            $encuesta = new TipoEvaliaciones();
            $encuesta->setIdtipoEvaluacion($idEcnuesta);
            $encuesta->setEvaluacion($nameEncuessta);
            $encuesta->setIdstatus($estatus);
            $edit = $encuesta->edit();
            if ($edit) {
                $_SESSION['editEncuesta'] = 'editEncuesta';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=evaluacion&action=tipoEvaluacion");
                    </script>';
            } else {
                $_SESSION['editEncuesta'] = 'errorEncuesta';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=evaluacion&action=tipoEvaluacion");
                    </script>';
            }
        }
    }
    public function deleteTipoEvaluacion()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $idtipoEvaluacion = $_GET['id'];

            $tipoEvaluacion = new TipoEvaliaciones();
            $tipoEvaluacion->setIdtipoEvaluacion($idtipoEvaluacion);
            $deleteEvaluacion = $tipoEvaluacion->delete();
            if ($deleteEvaluacion) {
                $_SESSION['deleteEncuesta'] = 'deleteEncuesta';
                echo '<script>
                window.location.replace("' . baseUrl . '?controller=evaluacion&action=tipoEvaluacion");
                </script>';
            } else {
                $_SESSION['deleteEncuesta'] = 'errorEncuesta';
                echo '<script>
                window.location.replace("' . baseUrl . '?controller=evaluacion&action=tipoEvaluacion");
                </script>';
            }
        }
    }
    public function allUsuarioEvaluacionesByDepartamento()
    {
        Utils::isAdmin();
        /* EN ESTA VISTA SE MUESTRA EL RECOPILADO DE LAS EVALUACIONES */
        if (isset($_GET['iddep'])) {
            $idDepartamento = $_GET['iddep'];

            $resultadosEvaluaciones = new Usuarios();
            $evaluacionesByDep = $resultadosEvaluaciones->getAllUsuariosByDepartamento($idDepartamento);
            require_once 'views/departamento/evaluacionesDepartamento.php';
        } else {
            echo '<script>
                window.location.replace("' . baseUrl . '?controller=departamento&action=index");
                </script>';
        }
    }
    public function getReporteEvaluacionByUser()
    {
        /* Utils::isAdmin(); */
        if ($_GET['user']) {
            $id = $_GET['user'];
            $usuarios = new Usuarios();
            $usuario = $usuarios->getUserById($id);

            /* PERIODOS */
            $periodo1 = 1;
            $periodo2 = 2;
            $fecha = date('Y');
            $periodoActivo =  Utils::getPeriodoActivo();
            //$fecha = 2023;

            /* PROMEDIO */
            $califPeriodo1 =  Utils::getCalifPorPeriodo($usuario->idusuario, $periodo1, $fecha);
            $califPeriodo2 =  Utils::getCalifPorPeriodo($usuario->idusuario, $periodo2, $fecha);


            if (!isset($califPeriodo1) && isset($califPeriodo2)) {
                $promedio  = $califPeriodo2->calificacionperiodo;
            }
            if (isset($califPeriodo1) && !isset($califPeriodo2)) {
                $promedio  = $califPeriodo1->calificacionperiodo;
            }

            if (isset($califPeriodo1) && isset($califPeriodo2)) {

                if ($califPeriodo1->calificacionperiodo == 0) {
                    $promedio  = $califPeriodo2->calificacionperiodo;
                } else {
                    $promedio  = ($califPeriodo1->calificacionperiodo + $califPeriodo2->calificacionperiodo) / 2;
                }

                if ($califPeriodo2->calificacionperiodo == 0) {
                    $promedio  = $califPeriodo1->calificacionperiodo;
                } else {
                    $promedio  = ($califPeriodo1->calificacionperiodo + $califPeriodo2->calificacionperiodo) / 2;
                }
            }

            //PORCENTAJE DE CAPACITACIONES PERIODO 1
            $califCapacitaciones1 =  new califCapacitaciones();
            $califCapacitaciones1->setNoempleado($usuario->noempleado);
            $califCapacitaciones1->setIdperiodo($periodo1);
            $califCapacitaciones1->setFecha($fecha);
            $calificacionCap1 =  $califCapacitaciones1->getCalificacionCapacitacionByUsPerriodo();

            //PORCENTAJE DE CAPACITACIONES PERIODO 2
            $califCapacitaciones2 =  new califCapacitaciones();
            $califCapacitaciones2->setIdperiodo($periodo2);
            $califCapacitaciones2->setFecha($fecha);
            $calificacionCap2 =  $califCapacitaciones2->getCalificacionCapacitacionByUsPerriodo();

            if ($calificacionCap1 == false) {
                $califCapP1  =  0;
            } else {
                $califCapP1 = $calificacionCap1->calif_competencia;
            }
            if ($calificacionCap2 == false) {
                $califCapP2 =  0;
            } else {
                $califCapP2 = $calificacionCap2->calif_competencia;
            }

            //PROMEDIO GENERAL FINAL
            $promf = bcdiv($promedio, '1', 2);


            $calificacionTecnica = new califTec360();
            $calificacionTecnicaP1 = $calificacionTecnica->getCaliftecByUser360($usuario->idusuario, $periodo1, $fecha);
            $calificacionTecnicaP2 = $calificacionTecnica->getCaliftecByUser360($usuario->idusuario, $periodo2, $fecha);

            /* CANDADO PARA IMPRIMIR REPORTE */
            if (isset($calificacionTecnicaP1)) {
                # code...
                $lookimprimirP1 = 0;
            } else {
                $lookimprimirP1 = 2;
                $mensajeperiodo = "<center><span class='badge bg-yellow'><i class='fas fa-exclamation-triangle'></i> NO APLICO PARA EVALUAR EN EL PERIODO!</span></center>";
            }
            if (isset($calificacionTecnicaP2)) {
                # code...
                $lookimprimirP2 = 0;
            } else {
                $lookimprimirP2 = 2;
                $mensajeperiodo = "<center><span class='badge bg-yellow'><i class='fas fa-exclamation-triangle'></i> NO APLICO PARA EVALUAR EN EL PERIODO!</span></center>";
            }


            /* validacion en caso de no captuta de la califtec a enfermeras */
            if (!isset($calificacionTecnicaP1) && !isset($calificacionTecnicaP2) && $usuario->anecdotario == 'SI') {
                $calificacionTecnicaP1 = "SE CALIFICO CON ANECDORARIO";
                $calificacionTecnicaP2 = "SE CALIFICO CON ANECDORARIO";
            }


            /* VALIDACION  PARA SABER SI EL USUARIO ES 360° */
            if ($usuario->evalua360 == 'SI') {
                /* RECOGEMOS LA CALIFICACION DEL USUARIO EN CASO DE QUE SEA 360° */
                $userCalif360 = new calificacion360();
                $calif360userPeriodo1 = $userCalif360->getCalifByUser($usuario->idusuario, $periodo1, $fecha);
                $calif360userPeriodo2 = $userCalif360->getCalifByUser($usuario->idusuario, $periodo2, $fecha);

                $califtec360Periodo1 = Utils::getcalifTec360($usuario->idusuario, $periodo1, $fecha);
                $califtecCap360Periodo1 = bcdiv($califtec360Periodo1->calificaciontec, '1', 2);

                $califtec360Periodo2 = Utils::getcalifTec360($usuario->idusuario, $periodo2, $fecha);
                $califtecCap360Periodo2 = bcdiv($califtec360Periodo2->calificaciontec, '1', 2);
            }

            /* cuestionario general se califica a colaboradores*/
            if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 2  && $usuario->evalua360 == 'NO') {
                require_once 'views/reportes/reporteEvaluacionByUser.php';
            }
            /* CUESTIONARIO A COORDINADORES 360 SOLO SE CALIFICA [COMPETENCIAS TECNICAS]*/
            if ($usuario->tipoevaluacion == 'DIRECTIVO' && $usuario->autoevalua == 2 &&  $usuario->evalua360 == 'SI') {
                require_once 'views/reportes/reporteEvaluacionByUser360.php';
            }
            /* OPERATIVA 360 */
            if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 2 &&  $usuario->evalua360 == 'SI') {
                require_once 'views/reportes/reporteEvaluacionByUser360.php';
            }
            /* CUESTIONARIO A SUPERVISORES [AUTOEVALUACION]*/
            if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 1 &&  $usuario->evalua360 == 'SI') {
                require_once 'views/reportes/reporteEvaluacionByUser.php';
            }
            /* CUESTIONARIO A SUPERVISORES [AUTOEVALUACION]*/
            if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 1 &&  $usuario->evalua360 == 'NO') {
                require_once 'views/reportes/reporteEvaluacionByUser.php';
            }
        }
    }
    public function cardexCalificaciones()
    {
        Utils::isAdmin();
        if (isset($_POST['yearCardex'])) {
            $yearCardex = $_POST['yearCardex'];
            require_once 'views/cardexCalificaciones/index.php';
        }
        require_once 'views/cardexCalificaciones/index.php';
    }
}


?>