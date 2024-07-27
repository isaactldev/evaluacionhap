<?php

class cuestionarioGen360{

    private $idcuestionarioeva360;
    private $pregunta360;
    private $idbloque360;
    private $fechaalta;
    private $idstatus;
    private $idtipoevaluacion;
    private $db;
    
    public function __construct()
    {
        $this->db = dataBase::conexion();
    }
    
    /**
     * Get the value of idcuestionarioeva360
     */ 
    public function getIdcuestionarioeva360()
    {
        return $this->idcuestionarioeva360;
    }

    /**
     * Set the value of idcuestionarioeva360
     *
     * @return  self
     */ 
    public function setIdcuestionarioeva360($idcuestionarioeva360)
    {
        $this->idcuestionarioeva360 = $idcuestionarioeva360;

        return $this;
    }

    /**
     * Get the value of pregunta360
     */ 
    public function getPregunta360()
    {
        return $this->pregunta360;
    }

    /**
     * Set the value of pregunta360
     *
     * @return  self
     */ 
    public function setPregunta360($pregunta360)
    {
        $this->pregunta360 = $pregunta360;

        return $this;
    }

    /**
     * Get the value of idbloque360
     */ 
    public function getIdbloque360()
    {
        return $this->idbloque360;
    }

    /**
     * Set the value of idbloque360
     *
     * @return  self
     */ 
    public function setIdbloque360($idbloque360)
    {
        $this->idbloque360 = $idbloque360;

        return $this;
    }
    public function getFechaalta()
    {
        return $this->fechaalta;
    }
    public function setFechaalta($fechaalta)
    {
        $this->fechaalta = $fechaalta;

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
    public function getIdtipoevaluacion()
    {
        return $this->idtipoevaluacion;
    }
    public function setIdtipoevaluacion($idtipoevaluacion)
    {
        $this->idtipoevaluacion = $idtipoevaluacion;

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

    public function getAllpreguntasByIdTipoEva360(){
    $sql = "SELECT * FROM `cuestionariogen360` WHERE `idtipoevaluacion` = {$this->getIdtipoevaluacion()};";
    $request = $this->db->query($sql);
    return $request;
    }

    public function addPregunta(){
        $fecha =  date('Y');
        $sql = "INSERT INTO `cuestionariogen360` (
            `idcuestionarioeva360` ,
            `pregunta360` ,
            `idbloque360` ,
            `fechaalta` ,
            `idstatus` ,
            `idtipoevaluacion`
            )
            VALUES (NULL , '{$this->getPregunta360()}', '{$this->getIdbloque360()}', {$fecha}, '{$this->getIdstatus()}', '{$this->getIdtipoevaluacion()}');";
        $request = $this->db->query($sql);
        $save = false;
        if ($request) {
        $save = true;
        }
        return $save;
    }
    

    public function activaYdesactivarregunta(){
        $sql = "UPDATE `cuestionariogen360` SET `idstatus` = {$this->getIdstatus()} WHERE `idcuestionarioeva360`= {$this->getIdcuestionarioeva360()};";
        
        $request = $this->db->query($sql);
    
        $updateStatus = false;
        if ($request) {
        $updateStatus = true;
        }
        return $updateStatus;
    
    }

    public function edit(){
    $sql = "UPDATE `cuestionariogen360` SET `pregunta360`= '{$this->getPregunta360()}'";
    if ($this->getIdbloque360() != null ) {
    $sql .= ",`idbloque`='{$this->getIdbloque360()}'";
    }
    if ($this->getIdstatus() != null) {
    $sql .=",`idstatus`='{$this->getIdstatus()}'";
    }
    $sql .= " WHERE `idcuestionarioeva360`={$this->getIdcuestionarioeva360()};";
    $request = $this->db->query($sql);
        $edit = false;
        if ($request) {
        $edit = true;
        }
        return $edit;
    }

    public function coutPreguntasXbloque($idbloque360){
        $sql =  "SELECT COUNT(idcuestionarioeva360) AS totalPreguntasBloque FROM `cuestionariogen360` WHERE `idbloque360` = {$idbloque360} ";
        $totalPreguntasBloque360 = $this->db->query($sql);

        return $totalPreguntasBloque360->fetch_object();
    }

    public function getAllpreguntasxBloque($idbloque360){
        $sql = "SELECT * FROM `cuestionariogen360` WHERE `idbloque360` = {$idbloque360};";
        $allPreguntas = $this->db->query($sql);

        return $allPreguntas;
    }

    
}
?>