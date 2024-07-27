<?php
class TipoEvaliaciones{
    private $idtipoEvaluacion;
    private $evaluacion;
    private $fechaalta;
    private $idstatus;
    private $db;

    public function __construct()
    {
        $this->db = dataBase::conexion();
    }
    public function getIdtipoEvaluacion()
    {
        return $this->idtipoEvaluacion;
    }
    public function setIdtipoEvaluacion($idtipoEvaluacion)
    {
        $this->idtipoEvaluacion = $idtipoEvaluacion;

        return $this;
    }
    public function getEvaluacion()
    {
        return $this->evaluacion;
    }
    public function setEvaluacion($evaluacion)
    {
        $this->evaluacion = $evaluacion;

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
    public function getDb()
    {
        return $this->db;
    }
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }
    /* MOSTRAMOS TODAS LAS TIPO DE ENCUESTAS DADAS DE ALTA */
    public function getAlltipoEncuestas(){
        $tipoEncuestas = $this->db->query("SELECT * FROM `tipoevaluacion`;");
        return $tipoEncuestas;
    }
    public function getEvaluacionById($id){
        $sql = "SELECT * FROM `tipoevaluacion` WHERE `idtipoeveluacion`= {$id};";
        $evaluacion = $this->db->query($sql);
        return $evaluacion->fetch_object(); /* estas haciendo el retorno del resultado de las encuestas */
    }
    /* AGREGAR NUEVA TIPO DE ENCUESTA */
    public function addtipoEncuesta(){
        $sql = "INSERT INTO `tipoevaluacion` (idtipoeveluacion, evaluacion, fechaalta, idstatus) VALUES(NULL, '{$this->getEvaluacion()}', CURDATE(), 1);";
        $addEvaluacion = $this->db->query($sql);
        $save = false;
        if ($addEvaluacion) {
        $save = true;
        }
        return $save;
    }
    public function edit(){
        $sql = "UPDATE `tipoevaluacion` SET evaluacion = '{$this->getEvaluacion()}', idstatus = '{$this->getIdstatus()}'  WHERE idtipoeveluacion = {$this->getIdtipoEvaluacion()};";
        $editEvaluacion = $this->db->query($sql);
        $edit = false;
        if ($editEvaluacion) {
        $edit = true;
        }
        return $edit;
    }
    public function delete(){
        $sql = "DELETE FROM `tipoevaluacion` WHERE idtipoeveluacion = {$this->idtipoEvaluacion};";
        $deletetipoEvaluacion = $this->db->query($sql);
        $delete = false;
        if ($deletetipoEvaluacion) {
        $delete = true;
        }
        return $delete;
    }
    
    
    
}
?>