<?php

class periodo
{
    private $idPerio;
    private $NombrePeriodo;
    private $status;
    private $db;

    public function __construct()
    {
        $this->db = dataBase::conexion();
    }

    public function getIdPerio()
    {
        return $this->idPerio;
    }
    public function setIdPerio($idPerio)
    {
        $this->idPerio = $idPerio;

        return $this;
    }
    public function getNombrePeriodo()
    {
        return $this->NombrePeriodo;
    }
    public function setNombrePeriodo($NombrePeriodo)
    {
        $this->NombrePeriodo = $NombrePeriodo;

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


    public function getAllPeridos()
    {
        $sql = "SELECT *  FROM `periodo`;";
        $periodos = $this->db->query($sql);
        return $periodos;
    }
    public function actualizarPeridoActivo($id)
    {
        $sql = "UPDATE  `periodo` SET  `status` = 1 WHERE `idperiodo` = {$id};";
        $actualizaPeriodo = $this->db->query($sql);

        $sql2 = "UPDATE  `periodo` SET  `status` = 2 WHERE NOT `idperiodo` = {$id}";
        $actualizaPeriodo2 = $this->db->query($sql2);

        $actualzaP  = false;

        if ($actualizaPeriodo2) {
            $actualzaP = true;
        }
        return $actualzaP;
    }
    public function getPeriodoActiva()
    {
        $sql = "SELECT * FROM `periodo` WHERE `status`=1;";
        $periodoActivo = $this->db->query($sql);
        return $periodoActivo->fetch_object();
    }
}
