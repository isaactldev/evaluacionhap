<?php
/* echo $this->db->error;//PARA MOSTRAR ERRORES DE LOS QUERYS EN PHP POO
    die(); */

/* echo '<pre>';//ASI IMPRIMES UN OBJETO EN ORDEN EN EL NAVEGADOR
                var_dump($usuario);
                echo '</pre>'; */

/* OPERADORES RELACIONALES */
/* 
MAYOR QUE: >
MENOR QUE: <
MAYOR O IGUAL QUE : >=
MENOR O IGUAL QUE : <=
IGUAL : =
DISTINTO : !=
*/
class Utils
{
    //FUNCION PARA VER LOS SLIDERS DE LA PAGINA DE HOME
    public static function urlActual()
    {
        $host = $_SERVER["HTTP_HOST"];
        $url = $_SERVER["REQUEST_URI"];
        $urlactual = "http://" . $host . $url;

        return $urlactual;
    }
    public static function deleteSession($namesession)
    {

        if (isset($_SESSION[$namesession])) {
            $_SESSION[$namesession] = null; //declaramos la variable vacia
            unset($_SESSION[$namesession]);
        }
        return $namesession;
    }
    public static function existSessionUser()
    {
        if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
        } else {
            echo '<script>
            window.location.replace("' . baseUrl . '");
        </script>';
        }
    }
    public static function isAdmin()
    {
        if (!isset($_SESSION['admin'])) {
            # code...
            //en caso de NO ser administrador lo regresamos a la pagina de inicio
            echo '<script> Swal.fire({ icon: "warning", title: "Error de Session!", text: "No tienes una Cuenta ADMINISTRADORA para ingresar!",})
            window.location.replace("' . baseUrl . '");
            </script>';
        } else {
            return true;
        }
    }
    /* FUNCION PARA VISUALIZAR EL ESTATUS */
    public static function showEstatus()
    {
        require_once 'models/estatus.php';
        $estatus = new Estatus();
        $estado = $estatus->getAllstatus();
        return $estado;
    }
    /* FUNCION PARA MOSTRAR LOS DEPARTAMENTOS */
    public static function showDepartamento()
    {
        require_once 'models/departamentos.php';
        $departamentos = new Departamentos();
        $departamento = $departamentos->getAlldepartamento();
        return $departamento;
    }
    /* FUNCION PARA MOSTRAR LOS PUESTOS  */
    public static function showPuesto()
    {
        require_once 'models/puestos.php';
        $puesto = new Puestos();
        $puestos = $puesto->getAllpuestos();
        return $puestos;
    }
    /* FUNCION PARA VISUALIZAR LA JERARQUIA EN LA ALTA DEL USUARIO */
    public static function showJerarquia()
    {
        require_once 'models/jerarquia.php';
        $jerarquias = new Jerarquia();
        $jerarquia = $jerarquias->getAllJerarquia();
        return $jerarquia;
    }
    /* FUNCION PARA VER EL PUESTO EN EL LISTADO DE PEROSONAL AVTIVO */
    public static function userPuesto($id)
    {
        require_once 'models/puestos.php';
        $puesto = new Puestos();
        $puestos = $puesto->getUserPuesto($id);
        return $puestos;
    }
    /* FUNCION PARA VER EL DEPARTAMENTO EN EL LISTADO DE PEROSONAL ACTIVO */
    public static function userDepartamento($id)
    {
        require_once 'models/departamentos.php';
        $departamentos = new Departamentos();
        $userDepartamento = $departamentos->getUserDepartamento($id);
        return $userDepartamento;
    }
    /*  */
    public static function evaPersonal()
    {
        require_once 'models/tipoevaluacion.php';
        $tipoevaluacion = new TipoEvaliaciones();
        $tipoevaluaciones = $tipoEvaluacion->getAlltipoEncuestas();
        return $tipoevaluaciones;
    }
    public static function showPuestoid($id)
    {
        require_once 'models/puestos.php';
        $puesto = new Puestos();
        $nombrePuesto = $puesto->getUserPuesto($id);
        return $nombrePuesto;
    }
    /* MUESTRA LA INFORMACION DE 1 SOLA ENCUESTA EN LA VISTA DE PREGUNTAS POR EVALUACION*/
    public static function showEvaluacionById($id)
    {
        require_once 'models/tipoevaluacion.php';
        $tipoevaluacion = new TipoEvaliaciones();
        $tipoevaluaciones = $tipoevaluacion->getEvaluacionById($id);
        return $tipoevaluaciones;
    }
    /* FUNCION PARA MOSTRA EL BLOQUE DE COMPETENCIAS EN EL MODULO DE  ALTA DE CUESTIONARIO */
    public static function showBloqueCompetencia()
    {
        require_once 'models/bloques.php';
        $bloque = new Bloques();
        $bloques = $bloque->getAllbloqueCompetencias();
        return $bloques;
    }
    /* FUNCION PARA MOSTRA EL BLOQUE DE COMPETENCIAS EN EL MODULO DE  ALTA DE CUESTIONARIO PARA LA EVALUACION 360 */
    public static function showBloqueCompetencia360()
    {
        require_once 'models/bloquecompetencia360.php';
        $bloque360 = new bloquecompetencia360();
        $allBloque360s = $bloque360->getAllbloquestec360();
        return $allBloque360s;
    }
    /* FUNCION PARA LISTAR LOS BLOQUES A LOS QUE PERTENECEN LAS PREGUNTAS EN EL ARMADO DEL CUESTIONARIO [VIEWS/EVALUACIONES/CUESTIONARIO.PHP] */
    public static function showBloqueCompetenciaActivas()
    {
        require_once 'models/bloques.php';
        $bloque = new Bloques();
        $bloques = $bloque->getAllbloqueCompetenciasEva();
        return $bloques;
    }
    /* MOSTRAMOS LAS PREGUNTAS DE LA EVALUACION */
    public static function showPreguntasdelBloque($idBloque)
    {
        $cuestionario = new evaluacionusario();
        $preguntasBloque = $cuestionario->crearBloquedeEvaluacionByid($idBloque);
        return $preguntasBloque;
    }
    /* FUNCION PARA VISUAIZAR LAS COMPETENICAS TECNICAS DEL COLABORADOR AL MOMENTO DE EVALUAR */
    public static function showPreguntasCompetenciasTecnicas($idpuesto)
    {
        require_once 'models/competeciasTecnicas.php';
        $competenciasTecnicas = new competeciasTecnicas();
        $competenciasTecnicas->setIdpuesto($idpuesto);
        $preguntasCompTecnicas = $competenciasTecnicas->getCompetenciasTecnicasbyId();
        return $preguntasCompTecnicas;
    }

    /* FUNCION PARA VER EL BLOQUE DE COMPETENCIA POR EL ID */
    public static function showBloqueCompetenciaById($id)
    {
        require_once 'models/bloques.php';
        $bloque = new Bloques();
        $bloques = $bloque->getBloqueCompetenciaById($id);
        return $bloques;
    }

    /* FUNCION PARA VER EL BLOQUE DE COMPETENCIA POR EL ID EN LA EVALUACION360 */
    public static function showBloqueCompetencia360ById($id)
    {
        require_once 'models/bloquecompetencia360.php';
        $bloque = new bloquecompetencia360();
        $bloques = $bloque->getBloque360ById($id);
        return $bloques;
    }

    public static function getAllPonderaciones()
    {
        require_once 'models/ponderacion.php';
        $ponderaciones = new Ponderacion();
        $ponderacion = $ponderaciones->getAllPonderaciones();
        return $ponderacion;
    }
    public static function countPonderacines()
    {
        require_once 'models/ponderacion.php';
        $ponderaciones = new Ponderacion();
        $countPonderacion = $ponderaciones->coutPonderacines();
        return $countPonderacion;
    }
    public static function getPonderaciones()
    {
        require_once 'models/ponderacion.php';
        $ponderaciones = new Ponderacion();
        $ponderacionesV = $ponderaciones->getAllPonderaciones();
        return $ponderacionesV;
    }
    /* FUNCION PARA ACTIVAR EL PERIODO DESEADO A EVALUAR */
    public static function getPeridos()
    {
        require_once 'models/periodo.php';
        $periodoaActualiza = new periodo();
        $periodos = $periodoaActualiza->getAllPeridos();
        return $periodos;
    }
    public static function getPeriodoActivo()
    {
        require_once 'models/periodo.php';
        $periodoActv = new periodo();
        $periodos = $periodoActv->getPeriodoActiva();
        return $periodos;
    }
    /* GET INFO EMPLEADO POR ID */
    public static function UserById($id)
    {
        require_once 'models/usuarios.php';
        $user = new Usuarios();
        $userEva = $user->getUserById($id);
        return $userEva;
    }
    /* GET INFO EMPLEADO POR NOEMPLEADO */
    public static function UserByNoEmpleado($noEmpleado)
    {
        require_once 'models/usuarios.php';
        $user = new Usuarios();
        $userinfo = $user->getUserByNoEmpleado($noEmpleado);
        return $userinfo;
    }
    /* FUNCION PARA VER LA RESPUESTA SELECCIONADA POR EL USUARIO EN EL DETALLE DE LA EVALUACION  */
    public static function getRespuestaByPreguntaByIdUser($id, $idpregunta, $periodo)
    {
        require_once 'models/evaluacionusario.php';
        $respuesta = new evaluacionusario();
        $resp = $respuesta->getPreguntaEvaluacionesByIduser($id, $idpregunta, $periodo);
        return $resp;
    }



    /* FUNCION PARA VER TODAS LAS PREGUNTAS TECNICAS RESPONDIDAS EN EL DETALLE DE LA EVALUACION */
    public static function getPreguntaTecEvaluacionesByIduser360($id, $periodo, $fechaperiodo)
    {
        require_once 'models/evaluacionusario.php';
        $respuesta = new evaluacionusario();
        $preguntatec = $respuesta->getPregEvaluacionesByIduser360($id, $periodo, $fechaperiodo);
        return $preguntatec;
    }
    public static function getPreguntaRespTecEvaluacionesByIduser360($id, $idpregunta, $periodo, $fechaperiodo)
    {
        require_once 'models/evaluacionusario.php';
        $respuesta = new evaluacionusario();
        $resp = $respuesta->getPreguntaEvaluacionesByIduser360($id, $idpregunta, $periodo, $fechaperiodo);
        return $resp;
    }




    /* FUNCION PARA MOSTRAR LAS CALIFICACIONES EN EL MODULO DE CALIFICACIONES 360  */
    public static function getuserCalif360byId($id, $periodo, $fecha)
    {
        require_once 'models/calificacion360.php';
        $user360Calif = new calificacion360();
        $userCalif = $user360Calif->getCalifByUser($id, $periodo, $fecha);
        return $userCalif;
    }
    /* FUNCION PARA CALCULAR LA CALIFICACION POR BLOQUE  EN EL REPORTE*/
    public static function getCalificacioXBloque($idusuario, $idbloque, $periodo, $fecha)
    {
        require_once 'models/calificacionGeneralUsuario.php';
        $calificacionReporte = new CalificacionEvaluacionUsuario();
        $calificacionReporte->setIdusuario($idusuario);
        $calificacionReporte->setIdbloque($idbloque);
        $calificacionReporte->setPeriodo($periodo);
        $calificacionReporte->setFecharesolucion($fecha);
        $calificacion = $calificacionReporte->calificacionXBloque();

        if ($calificacion->NoPreguntas == 0  && $calificacion->Calificacion == 0) {
            $calificacionBloque2 = "<span class='badge bg-yellow'>¡PENDIENTE DE EVALUAR! </br><small>EVALUA PARA VER RESULTADOS!</small></span></strong>";
            return $calificacionBloque2;
        } else {
            $califmaxBloque = $calificacion->NoPreguntas * 4;
            $califmaxUserBloque = $calificacion->Calificacion;

            $calificacionBloque = ($califmaxUserBloque * 1) / $califmaxBloque;
            $calificacionBloque2 = $calificacionBloque * 10;
            return $calificacionBloque2;
        }
    }
    public static function getCompromisoUsersReport($iduser)
    {
        require_once 'models/compromisos.php';
        $compromiso = new Comprimisos();
        $userCompromisos = $compromiso->getCompromisosByIdUser($iduser);
        return $userCompromisos;
    }
    public static function getCapacitacionReport($iduser)
    {
        require_once 'models/requierecapacitacion.php';
        $capacitacion = new requierecapacitacion();
        $userCapacitacion = $capacitacion->getCapacitacionByIdUser($iduser);
        return $userCapacitacion;
    }
    public static function getCalificacionAnecdotario($id)
    {
        require_once 'models/evaluacionusario.php';
        $calificacionAnec = new evaluacionusario();
        $anecdotarioCalif = $calificacionAnec->getCalificacionAnecdotario($id);

        $anecdotarioCalificacion = new stdClass();
        if ($anecdotarioCalif == false) {

            $anecdotarioCalificacion->mensaje = '<span class="badge bg-yellow"><i class="fas fa-exclamation-triangle"></i> EL USUARIO NO CUENTA CON CALIFICACION EN EL ANECDOTARIO! </br><small>PORFAVOR SOLICITA QUE LA CAPTUREN!</small></span>';
            $anecdotarioCalificacion->noSave = 1;
            $anecdotarioCalificacion->noAnec = 2;
        } else {
            $anecdotarioCalificacion->calif = $anecdotarioCalif;
            $anecdotarioCalificacion->Save = 2;
        }
        return $anecdotarioCalificacion;
    }
    public static function getNombreEvaluador($id)
    {
        require_once 'models/usuarios.php';

        $evaluadorhap = new Usuarios();
        $evaluadorNombre = $evaluadorhap->getUserEvaluadorById($id);


        return $evaluadorNombre;
    }
    public static function getcalifTec360($id, $periodo, $fecha)
    {
        require_once 'models/califTec360.php';
        $califtec360 = new califTec360();
        $califreport = $califtec360->getCaliftecByUser360($id, $periodo, $fecha);
        return $califreport;
    }

    /* FUNCION PARA OBTENER CALIFICACION DEL USUARIO POR PERIODO */
    public static function getCalifPorPeriodo($idusuario, $idperiodo, $fechaAct)
    {

        require_once 'models/calificacionPeriodoUsuario.php';

        $califPorPeridodo =  new Calificacionusuarioperiodo();
        $califPeriodo = $califPorPeridodo->getCalificacionPeriodoByUser($idusuario, $idperiodo, $fechaAct);

        return $califPeriodo;
    }

    /* FUNCION PARA TRAER LAS PREGUNTAS  DE LAS EVALUACIONES DEL PERSONAL 360 */

    public static function getcountPreguntaXbloque($idbloque360)
    {
        require_once 'models/cuestionariogeneral360.php';

        $coutPreguntasXbloque = new cuestionarioGen360();
        $totalPreguntasxBloque = $coutPreguntasXbloque->coutPreguntasXbloque($idbloque360);
        return $totalPreguntasxBloque;
    }
    public static function getAllPreguntasEncuesta360ByBloque($idbloque)
    {
        require_once 'models/cuestionariogeneral360.php';

        $preguntas360 = new cuestionarioGen360();
        $allPreguntas360 = $preguntas360->getAllpreguntasxBloque($idbloque);

        return $allPreguntas360;
    }

    public static function  getAllRespuestasByNoEvaluadorxPregunta($idcuestionarioeva360, $noempleadoEvaluador, $noempleadoEvaluado, $periodo, $fecha)
    {
        require_once 'models/evaluacionausuarios360.php';

        $respuestaxPreguntaByUser = new evaluacionausuarios360();
        $allRepuesta360 = $respuestaxPreguntaByUser->getAllExpresionEscritaByEmpleado($idcuestionarioeva360, $noempleadoEvaluador, $noempleadoEvaluado, $periodo, $fecha);
        return $allRepuesta360;
    }

    public static function getPromedioxPreguntaxEvaluador($noempleadoevaluado, $idcuestionarioeva360, $periodo, $fecha)
    {
        require_once 'models/evaluacionausuarios360.php';

        $countPuntosXpregunta = new evaluacionausuarios360();
        $totalcountPuntosXpregunta = $countPuntosXpregunta->getcountCalificacionXPregunta($noempleadoevaluado, $idcuestionarioeva360, $periodo, $fecha);
        return $totalcountPuntosXpregunta;
    }
    public static function getEvaluadoresByIdEvaluado($idevaluado, $idperiodo)
    {
        require_once 'models/personal360.php';

        $allEvaluiadores = new personal360();
        $allEvaluiadores->setPeriodo($idperiodo);
        $allEvaluiadores->setIdevaluado($idevaluado);
        /* $evaluadores = $allEvaluiadores->getPersonalEvaluador360ByEvaluado(); */
        $evaluadores = $allEvaluiadores->getPersonalEvaluador360ByEvaluadoPrueba();

        return $evaluadores;
    }


    public function getStatusPlataforma()
    {
        require_once 'models/statussitioweb.php';
        $statusPlataforma  =  new statusSitiiWeb();
        $statusPlataformaActual =  $statusPlataforma->statusSitioWeb();

        return $statusPlataformaActual;
    }


    public static function reportesliberadosByEvaluadorPeriodo($Evaluador, $periodo)
    {
        require_once 'models/personal360.php';
        $reportes360Liberados =  new personal360();
        $allreportes360Liberados =  $reportes360Liberados->getpersonas360Liberadas($Evaluador, $periodo);
        return $allreportes360Liberados;
    }

    public static function getcalificacionCapacitacionbyUserPeriodo($noempleado, $periodo, $fecha, $calif)
    {
        require_once 'models/califCapacitaciones.php';
        $califCapacitaciones =  new califCapacitaciones();
        $califCapacitaciones->setNoempleado($noempleado);
        $califCapacitaciones->setIdperiodo($periodo);
        $califCapacitaciones->setFecha($fecha);
        $calificacionCap =  $califCapacitaciones->getCalificacionCapacitacionByUsPerriodo();

        $califOrigin =  $calif - 1;
        $result =  $califOrigin + $calificacionCap->calif_competencia;
        return $result;
    }

    //ESTE METODO SE IMPLEMENTO PARA ACTUALIZAR LAS CALIFIACIONES CON LA IMPLEMENTACION DE SIS.CAPACITACIONES
    public static function calificacionCapacitacionbyUserPeriodo($noempleado, $periodo, $fecha, $calif)
    {
        include '../../models/califCapacitaciones.php';
        include '../../db/db.php';
        $califCapacitaciones =  new califCapacitaciones();
        $califCapacitaciones->setNoempleado($noempleado);
        $califCapacitaciones->setIdperiodo($periodo);
        $califCapacitaciones->setFecha($fecha);
        $calificacionCap =  $califCapacitaciones->getCalificacionCapacitacionByUsPerriodo();

        $califOrigin =  $calif - 1;
        $result =  $califOrigin + $calificacionCap->calif_competencia;
        return $result;
    }
}
