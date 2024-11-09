<?php

require_once 'models/usuarios.php';
require_once 'models/personal360.php';
require_once 'models/bloquecompetencia360.php';
require_once 'models/cuestionariogeneral360.php';
require_once 'models/periodo.php';

class evaluacionpersonal360Controller
{

    public function index()
    {
        Utils::isAdmin();
        if (isset($_GET['iduser']))
            $idusuarioEvaluador = $_GET['iduser'];
        $periodo = $_GET['periodo'];

        $usuarioEvaluado = new Usuarios();
        $usuario = $usuarioEvaluado->getUserByNoEmpleado($idusuarioEvaluador);

        /* PeriodoActiv */
        $periodoActivo = Utils::getPeriodoActivo();
        $fecha = date('Y');

        /* optencion de Todos los colaboradores que evaluaran al colaborador360 */
        $idevaluado = new personal360();
        $idevaluado->setIdevaluado($idusuarioEvaluador);
        $idevaluado->setPeriodo($periodo);
        $allpersonalAEvaluador = $idevaluado->getPersonalEvaluador360ByEvaluado();

        $statusCaptura = $idevaluado->countPendientesxCalificacion();

        /* CONTAMOS SI EXISTEN PENDIENTES DE CAPTURA DE CALIFICACION360  PARA HABILITAR BOTON [GUARDAR CALIFICACIO 360] */
        if ($statusCaptura->countPendientes == 0) {
            $statusCaptura360 = false;
        } else {
            $statusCaptura360 = true;
        }
        $counPersonalEvaluador = count($allpersonalAEvaluador);

        $allpersonalAEvaluadorRes = $idevaluado->getPersonalEvaluador360ByEvaluado();
        $allpersonalAEvaluadorRes2 = $idevaluado->getPersonalEvaluador360ByEvaluado();

        /* TODAS LAS PREGUNTAS */
        $tipoevaluacion = 9;
        $preguntas = new cuestionarioGen360();
        $preguntas->setIdtipoevaluacion($tipoevaluacion);
        $allPreguntas  =  $preguntas->getAllpreguntasByIdTipoEva360();
        $allPreguntas1 =  $preguntas->getAllpreguntasByIdTipoEva360();

        require_once 'views/evaluacionesUsuarios360/index.php';
    }

    public function iniciaEvaluacionA360()
    {

        if (isset($_GET['noEvaluador'], $_GET['noEvaluado'])) {

            $noEvaluador = $_GET['noEvaluador'];
            $noEvaluado = $_GET['noEvaluado'];

            $periodoActivo = Utils::getPeriodoActivo();

            $userevaluador =  new Usuarios();
            $userEvaluador360 = $userevaluador->getUserByNoEmpleado($noEvaluador);
            $userEvaluado360 = $userevaluador->getUserByNoEmpleado($noEvaluado);

            /* BLOQUES DE LA ENCUESTA */

            $bloque360 = new bloquecompetencia360();
            $bloques360 = $bloque360->getAllbloquestec360();


            require_once 'views/evaluacionesUsuarios360/cuestionariopersonal360.php';
        }
    }
    public function cruces360()
    {
        Utils::isAdmin();
        $periodoActivo =  new periodo();
        $periodoActivo = $periodoActivo->getPeriodoActiva();


        $evaluado360 = new personal360();
        $evaluados360 = $evaluado360->getusuariosEvaluado360($periodoActivo->idperiodo);

        require_once 'views/calif360Evluacion/cruces360.php';
    }
}
