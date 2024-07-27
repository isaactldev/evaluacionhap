<?php
require_once 'models/evaluacionusario.php';
require_once 'models/cuestionariogeneral.php';
require_once 'models/usuarios.php';
require_once 'models/tipoevaluacion.php';
require_once 'models/periodo.php';
require_once 'models/compromisos.php';
require_once 'models/requierecapacitacion.php';
require_once 'models/calificacion360.php';
require_once 'models/calificacionPeriodoUsuario.php';
require_once 'models/historicoempleado.php';
require_once 'models/personal360.php';
require_once 'models/periodo.php';
require_once 'models/calificacioncapacitacion.php';

class evausuarioController
{
    /* MOSTRAMOS TODOS LOS COLABORES A CARGO DEL IDENTIFICADO EN EL MOMENTO */
    public function index()
    {
        $idusuarioEvaluador = $_SESSION['identity']->noempleado;
        $idDepartamento = $_SESSION['identity']->iddepartamento;
        $idjerarquia = $_SESSION['identity']->idjerarquia;
        $autoEvalua = $_SESSION['identity']->autoevalua;
        $dep = Utils::userDepartamento($idDepartamento);
        $userEvalua = new Usuarios();
        $personalAcargo = $userEvalua->getAllPersonalAcarg($idusuarioEvaluador);

        /* VALIDACION DEL PERIODO */
        $periodo = new periodo();
        $periodoactivo = $periodo->getPeriodoActiva();
        if ($periodoactivo) {
            $periodo = "<span class='badge bg-secondary'>" . $periodoactivo->NombrePeriodo . "</span>";
        }

        /* PERIODOS */
        $periodo1 = 1;
        $periodo2 = 2;

        /* ALERTA DE EVALUACIONES 360° */
        $dbalert = mysqli_connect('localhost', 'root', 'DesWeb15', 'evapersonal22');
        $sqlAlertaEvaluaciones360 = "SELECT * FROM `personal360` WHERE idevaluador = {$_SESSION['identity']->noempleado} AND statuseva360 = 2 ;";
        $existAlert = mysqli_query($dbalert, $sqlAlertaEvaluaciones360);

        if (mysqli_num_rows($existAlert) > 0) {
            $_SESSION['existAlertEva360'] = 'existAlertEva360';
        }

        require_once 'views/evaluacionesUsuario/index.php';
    }
    public function activarPeriodo()
    {
        Utils::isAdmin();
        if (isset($_POST)) {
            $idperiodo = $_POST['idperiodo'];


            $actualizaPeriodo = new periodo();
            $actualizado = $actualizaPeriodo->actualizarPeridoActivo($idperiodo);

            if ($actualizado) {
                $_SESSION['actualizaPeriodo'] = 'actualizaPeriodo';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=evausuario&action=index");
                    </script>';
            } else {
                $_SESSION['actualizaPeriodo'] = 'errorActualizaPeriodo';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=evausuario&action=index");
                    </script>';
            }
        }
    }
    public function iniciaEvaluaciones()
    {
        if (isset($_GET['iduser'])) {
            $id = $_GET['iduser'];
            $usuarioEvaluado = new Usuarios();
            $usuario = $usuarioEvaluado->getUserById($id);
            $periodoActivo = Utils::getPeriodoActivo();
            $fecha = date('Y');

            /* VALIDACION  PARA SABER SI EL USUARIO ES 360° */
            if ($usuario->evalua360 == 'SI') {
                /* RECOGEMOS LA CALIFICACION DEL USUARIO EN CASO DE QUE SEA 360° */
                $userCalif360 = new calificacion360();
                $calif360user = $userCalif360->getCalifByUser($id, $periodoActivo->idperiodo, $fecha);
            }

            /* CALIFICACION DE LA PLATAFORMA DE CAPACITACIONES */
            $califCapByUser =  new calificacionCapacitacion();
            $califCapByUser->setNoempleado($usuario->noempleado);
            $califCapByUser->setIdperiodo($periodoActivo->idperiodo);
            $califCapByUser->setFecha($fecha);
            $califCap =  $califCapByUser->getCalificacionCapByUser();

            /* cuestionario general se califica a colaboradores*/
            if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 2  && $usuario->evalua360 == 'NO') {
                require_once 'views/evaluacionesUsuario/cuestionario.php';
            }
            /* OPERATIVA 360 */
            if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 2 &&  $usuario->evalua360 == 'SI') {
                require_once 'views/evaluacionesUsuario/cuestionarioOperativa360.php';
            }
            /* CUESTIONARIO A SUPERVISORES [AUTOEVALUACION]*/
            if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 1 &&  $usuario->evalua360 == 'SI') {
                require_once 'views/evaluacionesUsuario/cuestionarioAutoevalua.php';
            }
            /* CUESTIONARIO A SUPERVISORES [AUTOEVALUACION]*/
            if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 1 &&  $usuario->evalua360 == 'NO') {
                require_once 'views/evaluacionesUsuario/cuestionarioAutoevalua.php';
            }
            /* CUESTIONARIO A COORDINADORES 360 SOLO SE CALIFICA [COMPETENCIAS TECNICAS]*/
            if ($usuario->tipoevaluacion == 'DIRECTIVO' && $usuario->autoevalua == 2 &&  $usuario->evalua360 == 'SI') {
                require_once 'views/evaluacionesUsuario/cuestionario360.php';
            }
        }
    }
    public function verEvaluacionByUserEvaluado()
    {

        if (isset($_GET['iduser'])) {
            $iduser = $_GET['iduser'];
            $idperiodo = $_GET['idperiodo'];
            $fechaperiodo = $_GET['fecha'];

            $usuarioEvaluadoInfo = new Usuarios();
            $usuarioInfo = $usuarioEvaluadoInfo->getUserById($iduser);


            //validamos si el id del usuario si existe algun cambio de puesto en el Historico

            $sqlhistorico = "SELECT  MAX(idhistorico) AS idhistorico FROM `historicoempleado` h WHERE idusuario = {$iduser}  AND periodo = {$idperiodo}  AND fecha =  {$fechaperiodo};";
            $db = dataBase::conexion();
            $historicouserVrff = mysqli_query($db, $sqlhistorico);
            $historicouserVrf = $historicouserVrff->fetch_object()->idhistorico;
            /* VERIFICACION DEL USUARIO  */
            if (!isset($historicouserVrff)) {

                $periodo1 = 1;
                $usuarioEvaluado = new historycomptecperiodo();
                $usuario = $usuarioEvaluado->getHistoricoByUserPeriodoYear($iduser, $periodo1, $fechaperiodo);
            } else {
                $usuarioEvaluadoInfo = new Usuarios();
                $usuario = $usuarioEvaluadoInfo->getUserById($iduser);
            }

            $fecha = date('Y');
            $periodoActivo = Utils::getPeriodoActivo();
            /* VALIDACION  PARA SABER SI EL USUARIO ES 360° */
            /* RECOGEMOS LA CALIFICACION DEL USUARIO EN CASO DE QUE SEA 360° */
            $userCalif360 = new calificacion360();
            $calif360user = $userCalif360->getCalifByUser($iduser, $idperiodo, $fecha);


            /* CALIFICACION POR PERIODO */
            $fechaAct = date('Y');
            $califPorPeridodo =  new Calificacionusuarioperiodo();
            $califPeriodo = $califPorPeridodo->getCalificacionPeriodoByUser($iduser, $idperiodo, $fechaAct);


            /* COMPROMISOS DEL COLABORADOR DEL AÑO EN CURSO */
            $allCompromisosByUser =  new Comprimisos();
            $compromisosByUser = $allCompromisosByUser->getDetalleCompromisosByIdUser($iduser, $idperiodo, $fechaperiodo);


            /* CAPACITACION DEL COLABORADOR DEL AÑO EN CURSO */
            $allCapacitaciones =  new requierecapacitacion();
            $capacitaciones = $allCapacitaciones->getAllCapacionesDetalle($iduser, $idperiodo, $fechaperiodo);


            /* CALIFICACION DE LA PLATAFORMA DE CAPACITACIONES */
            $califCapByUser =  new calificacionCapacitacion();
            $califCapByUser->setNoempleado($usuario->noempleado);
            $califCapByUser->setIdperiodo($periodoActivo->idperiodo);
            $califCapByUser->setFecha($fecha);
            $califCap =  $califCapByUser->getCalificacionCapByUser();

            /* cuestionario general se califica a colaboradores*/
            if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 2  && $usuario->evalua360 == 'NO') {
                /* OBTENCION DE RESPUESTAS DEL USARIO */
                $respuestas = new evaluacionusario();
                $respuestasUser = $respuestas->getAllEvaluacionesByIduser($iduser, $idperiodo);/* CONSULTA DE LA EVALUACION POR EL ID DE USUARIO Y POR PERIODO */

                /* OBTENEMOS LOS COMENTARIOS DEL USUARIO DE LA EVALUACION */
                $compromiso = new Comprimisos();
                $userCompromisos = $compromiso->getCompromisosByIdUser($iduser);

                /* OBTENEMOS LAS CAPACITACION DEL USUARIO DE LA EVALUACION */
                $capacitacion = new requierecapacitacion();
                $userCapacitacion = $capacitacion->getCapacitacionByIdUser($iduser);


                require_once 'views/evaluacionesUsuario/detalleEvaluacion.php';
            }


            /* OPERATIVA 360 */
            if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 2 &&  $usuario->evalua360 == 'SI') {
                /* OBTENCION DE RESPUESTAS DEL USARIO */
                $respuestas = new evaluacionusario();
                $respuestasUser = $respuestas->getAllEvaluacionesByIduser($iduser, $idperiodo);/* CONSULTA DE LA EVALUACION POR EL ID DE USUARIO Y POR PERIODO */

                /* OBTENEMOS LOS COMENTARIOS DEL USUARIO DE LA EVALUACION */
                $compromiso = new Comprimisos();
                $userCompromisos = $compromiso->getCompromisosByIdUser($iduser);

                /* OBTENEMOS LAS CAPACITACION DEL USUARIO DE LA EVALUACION */
                $capacitacion = new requierecapacitacion();
                $userCapacitacion = $capacitacion->getCapacitacionByIdUser($iduser);

                require_once 'views/evaluacionesUsuario/detalleEvaluacion360Ope.php';
            }


            /* CUESTIONARIO A SUPERVISORES [AUTOEVALUACION]*/
            if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 1 &&  $usuario->evalua360 == 'SI') {
                /* OBTENCION DE RESPUESTAS DEL USARIO */
                $respuestas = new evaluacionusario();
                $respuestasUser = $respuestas->getAllEvaluaciones360ByIduser($iduser, $idperiodo);/* CONSULTA DE LA EVALUACION POR EL ID DE USUARIO Y POR PERIODO */

                /* OBTENEMOS LOS COMENTARIOS DEL USUARIO DE LA EVALUACION */
                $compromiso = new Comprimisos();
                $userCompromisos = $compromiso->getCompromisosByIdUser($iduser);

                /* OBTENEMOS LAS CAPACITACION DEL USUARIO DE LA EVALUACION */
                $capacitacion = new requierecapacitacion();
                $userCapacitacion = $capacitacion->getCapacitacionByIdUser($iduser);


                require_once 'views/evaluacionesUsuario/detalleEvaluacion360Ope.php';
            }


            /* CUESTIONARIO A SUPERVISORES [AUTOEVALUACION]*/
            if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 1 &&  $usuario->evalua360 == 'NO') {
                /* OBTENCION DE RESPUESTAS DEL USARIO */
                $respuestas = new evaluacionusario();
                $respuestasUser = $respuestas->getAllEvaluaciones360ByIduser($iduser, $idperiodo);/* CONSULTA DE LA EVALUACION POR EL ID DE USUARIO Y POR PERIODO */

                /* OBTENEMOS LOS COMENTARIOS DEL USUARIO DE LA EVALUACION */
                $compromiso = new Comprimisos();
                $userCompromisos = $compromiso->getCompromisosByIdUser($iduser);

                /* OBTENEMOS LAS CAPACITACION DEL USUARIO DE LA EVALUACION */
                $capacitacion = new requierecapacitacion();
                $userCapacitacion = $capacitacion->getCapacitacionByIdUser($iduser);


                require_once 'views/evaluacionesUsuario/detalleEvaluacionSupervisores.php';
            }



            /* CUESTIONARIO A COORDINADORES 360 SOLO SE CALIFICA [COMPETENCIAS TECNICAS]*/
            if ($usuario->tipoevaluacion == 'DIRECTIVO' && $usuario->autoevalua == 2 &&  $usuario->evalua360 == 'SI') {

                /* OBTENCION DE RESPUESTAS DEL USARIO */
                $respuestas = new evaluacionusario();
                $respuestasUser = $respuestas->getAllEvaluaciones360ByIduser($iduser, $idperiodo);/* CONSULTA DE LA EVALUACION POR EL ID DE USUARIO Y POR PERIODO */

                /* OBTENEMOS LOS COMENTARIOS DEL USUARIO DE LA EVALUACION */
                $compromiso = new Comprimisos();
                $userCompromisos = $compromiso->getCompromisosByIdUser($iduser);

                /* OBTENEMOS LAS CAPACITACION DEL USUARIO DE LA EVALUACION */
                $capacitacion = new requierecapacitacion();
                $userCapacitacion = $capacitacion->getCapacitacionByIdUser($iduser);


                require_once 'views/evaluacionesUsuario/detalleEvaluacion360direc.php';
            }

            /* OBTENCION DE RESPUESTAS DEL USARIO */
            $respuestas = new evaluacionusario();
            $respuestasUser = $respuestas->getAllEvaluacionesByIduser($iduser, $idperiodo);/* CONSULTA DE LA EVALUACION POR EL ID DE USUARIO Y POR PERIODO */

            /* OBTENEMOS LOS COMENTARIOS DEL USUARIO DE LA EVALUACION */
            $compromiso = new Comprimisos();
            $userCompromisos = $compromiso->getCompromisosByIdUser($iduser);

            /* OBTENEMOS LAS CAPACITACION DEL USUARIO DE LA EVALUACION */
            $capacitacion = new requierecapacitacion();
            $userCapacitacion = $capacitacion->getCapacitacionByIdUser($iduser);
        }
    }
}
