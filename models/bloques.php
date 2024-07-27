<?php
class Bloques
{
    private $idbloque;
    private $bloquecompetencia;
    private $idstatus;
    private $fecha;
    private $db;

    public function __construct()
    {
        $this->db = dataBase::conexion();
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
    public function getBloquecompetencia()
    {
        return $this->bloquecompetencia;
    }
    public function setBloquecompetencia($bloquecompetencia)
    {
        $this->bloquecompetencia = $bloquecompetencia;

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
    public function getFecha()
    {
        return $this->fecha;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

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

    public function getAllbloqueCompetencias(){
        $sql = "SELECT * FROM `bloquecompetencia`;";
        $bloques = $this->db->query($sql);
        return $bloques;
    }
    public function getAllbloqueCompetenciasEva(){
        $sql = "SELECT * FROM `bloquecompetencia` WHERE `idstatus` = 1;";
        $bloques = $this->db->query($sql);
        return $bloques;
    }
    public function getBloqueCompetenciaById($id){
        $sql = "SELECT * FROM `bloquecompetencia`WHERE idbloque = {$id};";
        $bloques = $this->db->query($sql);
        return $bloques->fetch_object();
    }
    public function save(){
        $sql = "INSERT INTO `bloquecompetencia` (idbloque, bloquecompetencia, idstatus, fecha) VALUES(NULL, '{$this->getBloquecompetencia()}', 1, CURDATE());";
        $savebloque = $this->db->query($sql);
        $save = false;
        if ($savebloque) {
        $save = true;
        }
        return $save;
    }
    public function delete(){
        $sql = "DELETE FROM `bloquecompetencia` WHERE idbloque = {$this->idbloque};";
        $deletebloque = $this->db->query($sql);
        $delete = false;
        if ($deletebloque) {
        $delete = true;
        }
        return $delete;
    }

    public function edit(){
        $sql = "UPDATE `bloquecompetencia` SET bloquecompetencia = '{$this->getBloquecompetencia()}', idstatus = '{$this->getIdstatus()}'  WHERE 	idbloque = {$this->getIdbloque()};";
        $editBloque = $this->db->query($sql);
        $edit = false;
        if ($editBloque) {
        $edit = true;
        }
        return $edit;
    }

}


?>
