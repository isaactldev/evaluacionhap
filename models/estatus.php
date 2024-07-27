<?php
class Estatus
{
    private $idstatus;
    private $status;
    private $db;

    public function __construct()
{
    
    $this->db = dataBase::conexion();
    
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
    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;

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

    public function getAllstatus(){
        $tipoEncuestas = $this->db->query("SELECT * FROM `estatus`;");
        return $tipoEncuestas;
    }
}

?>