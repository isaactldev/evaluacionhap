<?php

class historycomptecperiodo
{
    private $idhistorico;
    private $idusuario;
    private $iddepartamento;
    private $idpuesto;
    private $idjerarquia;
    private $idevaluadopor;
    private $tipoevaluacion;
    private $autoevalua;
    private $evalua360;
    private $estatusevaluado;
    private $calificacion;
    private $anecdotario;
    private $periodo;
    private $fecha;
    private $db;


    public function __construct()
    {
        $this->db = dataBase::conexion();
    }
    

    /**
     * Get the value of idhistorico
     */ 
    public function getIdhistorico()
    {
        return $this->idhistorico;
    }

    /**
     * Set the value of idhistorico
     *
     * @return  self
     */ 
    public function setIdhistorico($idhistorico)
    {
        $this->idhistorico = $idhistorico;

        return $this;
    }

    /**
     * Get the value of idusuario
     */ 
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * Set the value of idusuario
     *
     * @return  self
     */ 
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * Get the value of iddepartamento
     */ 
    public function getIddepartamento()
    {
        return $this->iddepartamento;
    }

    /**
     * Set the value of iddepartamento
     *
     * @return  self
     */ 
    public function setIddepartamento($iddepartamento)
    {
        $this->iddepartamento = $iddepartamento;

        return $this;
    }

    /**
     * Get the value of idpuesto
     */ 
    public function getIdpuesto()
    {
        return $this->idpuesto;
    }

    /**
     * Set the value of idpuesto
     *
     * @return  self
     */ 
    public function setIdpuesto($idpuesto)
    {
        $this->idpuesto = $idpuesto;

        return $this;
    }

    /**
     * Get the value of idjerarquia
     */ 
    public function getIdjerarquia()
    {
        return $this->idjerarquia;
    }

    /**
     * Set the value of idjerarquia
     *
     * @return  self
     */ 
    public function setIdjerarquia($idjerarquia)
    {
        $this->idjerarquia = $idjerarquia;

        return $this;
    }

    /**
     * Get the value of idevaluadopor
     */ 
    public function getIdevaluadopor()
    {
        return $this->idevaluadopor;
    }

    /**
     * Set the value of idevaluadopor
     *
     * @return  self
     */ 
    public function setIdevaluadopor($idevaluadopor)
    {
        $this->idevaluadopor = $idevaluadopor;

        return $this;
    }

    /**
     * Get the value of tipoevaluacion
     */ 
    public function getTipoevaluacion()
    {
        return $this->tipoevaluacion;
    }

    /**
     * Set the value of tipoevaluacion
     *
     * @return  self
     */ 
    public function setTipoevaluacion($tipoevaluacion)
    {
        $this->tipoevaluacion = $tipoevaluacion;

        return $this;
    }

    /**
     * Get the value of autoevalua
     */ 
    public function getAutoevalua()
    {
        return $this->autoevalua;
    }

    /**
     * Set the value of autoevalua
     *
     * @return  self
     */ 
    public function setAutoevalua($autoevalua)
    {
        $this->autoevalua = $autoevalua;

        return $this;
    }

    /**
     * Get the value of evalua360
     */ 
    public function getEvalua360()
    {
        return $this->evalua360;
    }

    /**
     * Set the value of evalua360
     *
     * @return  self
     */ 
    public function setEvalua360($evalua360)
    {
        $this->evalua360 = $evalua360;

        return $this;
    }

    /**
     * Get the value of estatusevaluado
     */ 
    public function getEstatusevaluado()
    {
        return $this->estatusevaluado;
    }

    /**
     * Set the value of estatusevaluado
     *
     * @return  self
     */ 
    public function setEstatusevaluado($estatusevaluado)
    {
        $this->estatusevaluado = $estatusevaluado;

        return $this;
    }

    /**
     * Get the value of calificacion
     */ 
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set the value of calificacion
     *
     * @return  self
     */ 
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }

    /**
     * Get the value of anecdotario
     */ 
    public function getAnecdotario()
    {
        return $this->anecdotario;
    }

    /**
     * Set the value of anecdotario
     *
     * @return  self
     */ 
    public function setAnecdotario($anecdotario)
    {
        $this->anecdotario = $anecdotario;

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

    public function getHistoricoByUserPeriodoYear($idusuario, $periodo, $fecha){
        $sql = "SELECT  MAX(idhistorico) AS idhistorico, idusuario,iddepartamento,idpuesto,idjerarquia,idevaluadopor,tipoevaluacion,autoevalua,evalua360,estatusevaluado,calificacion,anecdotario,periodo,fecha   FROM `historicoempleado` h WHERE idusuario = {$idusuario}  AND periodo = {$periodo}  AND fecha =  {$fecha}; ";
        $userHistoricoByUserPeriodoYear = $this->db->query($sql);
        return $userHistoricoByUserPeriodoYear->fetch_object();
        
    }
}


?>


















