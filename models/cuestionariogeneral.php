<?php

class cuestionarioGen{

    private $idcuestionariog;
    private $pregunta;
    private $idbloque;
    private $fechaalta;
    private $idstatus;
    private $idtipoevaluacion;
    private $db;
    
    public function __construct()
    {
        $this->db = dataBase::conexion();
    }
    
    public function getIdcuestionariog()
    {
        return $this->idcuestionariog;
    }
    public function setIdcuestionariog($idcuestionariog)
    {
        $this->idcuestionariog = $idcuestionariog;

        return $this;
    }
    public function getPregunta()
    {
        return $this->pregunta;
    }
    public function setPregunta($pregunta)
    {
        $this->pregunta = $pregunta;

        return $this;
    }
    public function getIdbloque()
    {
        return $this->idbloque;
    }
    public function setIdbloque($idbloque)
    {
        $this->idbloque = $idbloque;

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

    public function getAllpreguntasByIdTipoEva(){
    $sql = "SELECT * FROM `cuestionariogeneral` WHERE `idtipoevaluacion` = {$this->getIdtipoevaluacion()};";
    $request = $this->db->query($sql);
    return $request;
    }

    public function addPregunta(){
        $sql = "INSERT INTO `cuestionariogeneral` (
            `idcuestionariog` ,
            `pregunta` ,
            `idbloque` ,
            `fechaalta` ,
            `idstatus` ,
            `idtipoevaluacion`
            )
            VALUES (NULL , '{$this->getPregunta()}', '{$this->getIdbloque()}', CURDATE(), '{$this->getIdstatus()}', '{$this->getIdtipoevaluacion()}');";
        $request = $this->db->query($sql);
        $save = false;
        if ($request) {
        $save = true;
        }
        return $save;
    }
    

    public function desactivarPregunta(){
        $sql = "UPDATE `cuestionariogeneral` SET `idstatus` = 2 WHERE `idcuestionariog`= {$this->getIdcuestionariog()} AND `idtipoevaluacion` = {$this->getIdtipoevaluacion()};";
    $request = $this->db->query($sql);
    
        $updateStatus = false;
        if ($request) {
        $updateStatus = true;
        }
        return $updateStatus;
    
    }

    public function edit(){
    $sql = "UPDATE `cuestionariogeneral` SET `pregunta`= '{$this->getPregunta()}'";
    if ($this->getIdbloque() != null ) {
    $sql .= ",`idbloque`='{$this->getIdbloque()}'";
    }
    if ($this->getIdstatus() != null) {
    $sql .=",`idstatus`='{$this->getIdstatus()}'";
    }
    $sql .= " WHERE `idcuestionariog`={$this->getIdcuestionariog()};";
    $request = $this->db->query($sql);
        $edit = false;
        if ($request) {
        $edit = true;
        }
        return $edit;
    }
}
?>