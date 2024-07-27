<?php

class personal360
{

    private $idpersonal360;
    private $idevaluador;
    private $idevaluado;
    private $promFinalCalif360;
    private $periodo;
    private $status;
    private $tipoevaluador;
    private $fecha;
    private $db;

    public function __construct()
    {
        $this->db =  dataBase::conexion();
    }

    /**
     * Get the value of idpersonal360
     */
    public function getIdpersonal360()
    {
        return $this->idpersonal360;
    }

    /**
     * Set the value of idpersonal360
     *
     * @return  self
     */
    public function setIdpersonal360($idpersonal360)
    {
        $this->idpersonal360 = $idpersonal360;

        return $this;
    }

    /**
     * Get the value of idevaluador
     */
    public function getIdevaluador()
    {
        return $this->idevaluador;
    }

    /**
     * Set the value of idevaluador
     *
     * @return  self
     */
    public function setIdevaluador($idevaluador)
    {
        $this->idevaluador = $idevaluador;

        return $this;
    }

    /**
     * Get the value of idevaluado
     */
    public function getIdevaluado()
    {
        return $this->idevaluado;
    }

    /**
     * Set the value of idevaluado
     *
     * @return  self
     */
    public function setIdevaluado($idevaluado)
    {
        $this->idevaluado = $idevaluado;

        return $this;
    }

    /**
     * Get the value of promFinalCalif360
     */
    public function getPromFinalCalif360()
    {
        return $this->promFinalCalif360;
    }

    /**
     * Set the value of promFinalCalif360
     *
     * @return  self
     */
    public function setPromFinalCalif360($promFinalCalif360)
    {
        $this->promFinalCalif360 = $promFinalCalif360;

        return $this;
    }

    /**
     * Get the value of periodo
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * Set the value of periodo
     *
     * @return  self
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
    public function getTipoevaluador()
    {
        return $this->tipoevaluador;
    }

    /**
     * Set the value of tipoevaluador
     */
    public function setTipoevaluador($tipoevaluador)
    {
        $this->tipoevaluador = $tipoevaluador;
        return $this;
    }

    /**
     * Get the value of db
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }


    public function getPersonalEvaluador360ByEvaluado()
    {
        $fecha = date('Y');
        $sql = "SELECT * FROM  `personal360` WHERE `idevaluado` = {$this->getIdevaluado()} AND `periodo` = {$this->getPeriodo()} AND `fecha` = {$fecha};";
        $userEvaluador = $this->db->query($sql);


        return $userEvaluador;
    }
    public function getPersonalEvaluador360ByEvaluadoPrueba()
    {
        $fecha = date('Y');
        $sql = "SELECT * FROM  `personal360` WHERE `idevaluado` = {$this->getIdevaluado()} AND `periodo` = {$this->getPeriodo()} AND `fecha` = {$fecha};";
        $userEvaluador = $this->db->query($sql);

        if ($userEvaluador->num_rows <= 0) {
            $sinCruces360 = false;
            return $sinCruces360;
        } else {
            return $userEvaluador;
        }
    }
    public function countPendientesxCalificacion()
    {
        $fecha = date('Y');
        $sql = "SELECT COUNT(`statuseva360`) AS countPendientes  FROM `personal360` WHERE `statuseva360` = 2 AND `idevaluado` =  {$this->getIdevaluado()} AND `periodo` = {$this->getPeriodo()} AND `fecha` = {$fecha};";
        $pendientesxCalif360 = $this->db->query($sql);

        return $pendientesxCalif360->fetch_object();
    }


    public function getusuariosEvaluado360($periodo)
    /* noempleado <>20051 AND */
    {
        $sql = "SELECT * FROM `usuarios` WHERE idjerarquia IN ('1','2','3','4') AND `autoevalua` = 2 and `evalua360` = 'SI';";
        $query = $this->db->query($sql);

        return $query;
    }

    public function getpersonas360Liberadas($idevaluador, $periodo)
    {
        // VALIDAMOS SI YA EXISTEN REPORTES LIBERADOS
        $fecha = date('Y');
        $sql = "SELECT * FROM personal360 WHERE idevaluador = {$idevaluador} AND periodo = {$periodo} AND statuseva360 =  1 AND tipoevaluador LIKE '%JEFE INMEDIATO%'  AND fecha = {$fecha};";
        $rows =  $this->db->query($sql);

        $allreportes360liberadosOk = array();

        if (mysqli_num_rows($rows) > 0) {

            foreach ($rows as $evaluado) {
                $sqlinfoEvaluado =  "SELECT idusuario FROM usuarios WHERE noempleado =  {$evaluado['idevaluado']};";
                $infoidEvaluado =  $this->db->query($sqlinfoEvaluado)->fetch_object()->idusuario;

                $sqlinfoReporte360Liberado = "SELECT calif360.idusuario, us.noempleado, calif360.idperiodo, calif360.fecha FROM calificacion360 calif360
                INNER JOIN usuarios us ON calif360.idusuario = us.idusuario
                WHERE calif360.idusuario  = $infoidEvaluado AND calif360.idperiodo = {$periodo} AND calif360.fecha = {$fecha};";
                $allreportes360liberados =  $this->db->query($sqlinfoReporte360Liberado);

                //VALIDAMOS SI EL RESULTADO TIENE INFO
                if ($allreportes360liberados->num_rows >= 1) {
                    $allreportes360liberados = $allreportes360liberados->fetch_object();
                    array_push($allreportes360liberadosOk, $allreportes360liberados);
                }
            }
        }
        return $allreportes360liberadosOk;
    }
}
