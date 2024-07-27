<?php
class evaluacionusario
{
    private $idevaluacion;
    private $idusuario;
    private $idpregunta;
    private $idponderacion;
    private $totalpuntos;
    private $periodo;
    private $idstatus;
    private $fecharesolucion;
    private $db;
    private $dbEnf;

    public function __construct()
    {
        $this->db = dataBase::conexion();
    }
    public function getIdevaluacion()
    {
        return $this->idevaluacion;
    }
    public function setIdevaluacion($idevaluacion)
    {
        $this->idevaluacion = $idevaluacion;
        return $this;
    }
    public function getIdusuario()
    {
        return $this->idusuario;
    }
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;
        return $this;
    }
    public function getIdpregunta()
    {
        return $this->idpregunta;
    }
    public function setIdpregunta($idpregunta)
    {
        $this->idpregunta = $idpregunta;

        return $this;
    }
    public function getIdponderacion()
    {
        return $this->idponderacion;
    }
    public function setIdponderacion($idponderacion)
    {
        $this->idponderacion = $idponderacion;
        return $this;
    }
    public function getTotalpuntos()
    {
        return $this->totalpuntos;
    }
    public function setTotalpuntos($totalpuntos)
    {
        $this->totalpuntos = $totalpuntos;
        return $this;
    }
    public function getPeriodo()
    {
        return $this->periodo;
    }
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;

        return $this;
    }
    public function getIdstatus()
    {
        return $this->idstatus;
    }
    public function setIdstatus($idstatus)
    {
        $this->idstatus = $idstatus;
        return $this;
    }
    public function getFecharesolucion()
    {
        return $this->fecharesolucion;
    }
    public function setFecharesolucion($fecharesolucion)
    {
        $this->fecharesolucion = $fecharesolucion;
        return $this;
    }
    public function getDb()
    {
        return $this->db;
    }
    public function setDb($db)
    {
        $this->db = $db;
        return $this;
    }
    /**
     * Get the value of dbAnec
     */
    /* public function getDbAnec()
    {
        return $this->dbAnec;
    } */

    /**
     * Set the value of dbAnec
     *
     * @return  self
     */
    /* public function setDbAnec($dbAnec)
    {
        $this->dbAnec = $dbAnec;

        return $this;
    } */
    /* FUNCION PARA CONSULTAR TODAS LAS EVALUACIONES DESDE EL ADMIN */
    public function getAllEvaluacionesUsuario()
    {
        $sql = "SELECT * FROM `evaluacionusario`;";
        $evaluacionesUsuario = $this->db->query($sql);
        return $evaluacionesUsuario;
    }
    public function crearEvaluacion()
    {
        $sql = "SELECT tipv.evaluacion, c.idcuestionariog, c.pregunta, b.bloquecompetencia
                FROM cuestionariogeneral c /* TABLA CENTRAL PARA EL ARMADO DEL CUESTIONARIO */
                INNER JOIN bloquecompetencia b ON b.idbloque = c.idbloque /*   */
                INNER JOIN tipoevaluacion tipv ON tipv.idtipoeveluacion = c.idtipoevaluacion
                WHERE b.idbloque
                IN ('1', '2', '3', '4', '5', '6', '7', '8', '9','13') ORDER BY b.idbloque;";
        $cuestionarioUsuario = $this->db->query($sql);
        return $cuestionarioUsuario;
    }
    public function crearBloquedeEvaluacionByid($idbloque)
    {
        $sql = "SELECT tipv.evaluacion, c.idcuestionariog, c.pregunta, b.bloquecompetencia
                FROM cuestionariogeneral c 
                INNER JOIN bloquecompetencia b ON b.idbloque = c.idbloque 
                INNER JOIN tipoevaluacion tipv ON tipv.idtipoeveluacion = c.idtipoevaluacion
                WHERE b.idbloque = {$idbloque} AND c.idtipoevaluacion = 8 AND c.idstatus = 1 ORDER BY b.idbloque;";
        $cuestionarioUsuario = $this->db->query($sql);
        return $cuestionarioUsuario;
    }

    /* FUNCION PARA OBTENER LAS EVALUACIONES DE UN USUARIO OPERATIVO  */
    public function getAllEvaluacionesByIduser($id, $periodo)
    {
        $fecha = date("Y");
        $sql = "SELECT * FROM `evaluacionusario` WHERE `idusuario` = {$id} AND `periodo` = {$periodo} AND `fecharesolucion` LIKE '%{$fecha}%';";
        $preguntas = $this->db->query($sql);
        return $preguntas;
    }
    /* FUNCION PARA OBTENER LAS EVALUACIONES DE UN USUARIO OPERATIVO 360 */
    public function getAllEvaluaciones360ByIduser($id, $periodo)
    {
        $dateinicioP = date("Y-01-01");
        $dateFinP = date("Y-12-31");
        $sql = "SELECT * FROM `evaluacionrespusuariotecnica` WHERE idusuario = {$id} AND periodo = {$periodo} AND fecharesolucion BETWEEN '{$dateinicioP}' AND '{$dateFinP}';";
        $preguntas = $this->db->query($sql);
        return $preguntas;
    }
    /* FUNCION PARA OBTENER LAS RESPUESTAS DE LA EVALUACION DE USUARIOS OPERATIVOS */
    public function getPreguntaEvaluacionesByIduser($id, $idpregunta, $periodo)
    {
        $dateinicioP = date("Y-01-01");
        $dateFinP = date("Y-12-31");
        $sql = "SELECT * FROM `evaluacionusario` WHERE idusuario = {$id} AND idpregunta = {$idpregunta} AND  periodo = {$periodo} AND fecharesolucion BETWEEN '{$dateinicioP}' AND '{$dateFinP}';";
        $preguntas = $this->db->query($sql);
        return $preguntas->fetch_object();
    }



    /* FUNCION PARA OBTENER LAS RESPUESTAS DE LA EVALUACION DE USUARIOS OPERATIVOS 360° */
    public function getPregEvaluacionesByIduser360($id, $periodo, $fecha)
    {

        $sql = "SELECT * FROM `evaluacionrespusuariotecnica` WHERE idusuario = {$id} AND  periodo = {$periodo} AND fecharesolucion LIKE '%{$fecha}%';";
        $preguntas = $this->db->query($sql);

        return $preguntas;
    }
    /* FUNCION PARA OBTENER LAS RESPUESTAS DE LA EVALUACION DE USUARIOS OPERATIVOS 360° */
    public function getPreguntaEvaluacionesByIduser360($id, $idpregunta, $periodo, $fecha)
    {

        $sql = "SELECT * FROM `evaluacionrespusuariotecnica` WHERE idusuario = {$id} AND idcopentenciatecnica = {$idpregunta} AND  periodo = {$periodo} AND fecharesolucion LIKE '%{$fecha}%';";
        $preguntas = $this->db->query($sql);

        return $preguntas->fetch_object();
    }
    /* FUNCION PARA VER LA CALIFICACION DEL ANECDORARIO */
    public function getCalificacionAnecdotario($id)
    {
        /* conexion al anecdotario */
        $dbEnf = mysqli_connect('172.16.1.105', 'remoto', 'remoto', 'anecdotarioenfermeria');

        $yaer = date("Y");
        $sql = "SELECT p.*,am.* FROM personal AS p 
        LEFT OUTER JOIN acumuladomensual AS am ON p.idusuario = am.idusuario 
        WHERE p.noempleado = {$id}  and am.anio= {$yaer};";
        $calificacionesAnecdorario = mysqli_query($dbEnf, $sql);

        /* SE VALIDA SI EL USUARIO DEL ANECDOTARIO TIENE O NO EXISTENTE UNA CALIFICACION */
        if ($calificacionesAnecdorario == false) {

            $anecdotarioCalif = false;
            return $anecdotarioCalif;
        } else {/* SI EXISTEN  CALIFICACIONES LA MOSTRAMOS  */
            if (mysqli_num_rows($calificacionesAnecdorario) > 0) {
                $count = 0;
                $total = 0;
                while ($promedio = $calificacionesAnecdorario->fetch_object()) {


                    $califAnecdotario = $promedio->rtotalevaluacion;

                    if ($califAnecdotario != 0) {
                        $total += $califAnecdotario;
                        $count++;
                    } else {
                        $calificacionAnecdorarioTotal = false;
                        $anecdotarioCalif = false;
                        return $anecdotarioCalif;
                    }
                }

                if ($count == 0 && $total == 0) {
                    $anecdotarioCalif = false;
                    return $anecdotarioCalif;
                } else {
                    $total = $total  /  $count;

                    $calificacionAnecdorarioTotal = $total * .60; /*PARA OBTENER EL PORCENTAJE DE LA EVALUACION DE ACUERDO A LA COMPETENCIA TECNICA*/
                    $anecdotarioCalif = $calificacionAnecdorarioTotal / 10;
                    $anecdotarioCalif = round($anecdotarioCalif, 2); // 0.75    

                    return $anecdotarioCalif;
                }
            } else {

                $anecdotarioCalif = false;
                return $anecdotarioCalif;
            }
        }
    }
}
