<?php

class requierecapacitacion
{

    private $idcapacitacion;
    private $idusuario;
    private $nececitacapacitacion;
    private $fecha;
    private $db;

    public function __construct()
    {
        $this->db = dataBase::conexion();
    }
    public function getIdcapacitacion()
    {
        return $this->idcapacitacion;
    }
    public function setIdcapacitacion($idcapacitacion)
    {
        $this->idcapacitacion = $idcapacitacion;

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
    public function getNececitacapacitacion()
    {
        return $this->nececitacapacitacion;
    }
    public function setNececitacapacitacion($nececitacapacitacion)
    {
        $this->nececitacapacitacion = $nececitacapacitacion;

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

    public function getCapacitacionByIdUser($id)
    {
        $dateinicioP = date("Y-01-01");
        $dateFinP = date("Y-12-31");
        $sql = "SELECT * FROM `requierecapacitacion` WHERE idusuario = {$id} AND fecha BETWEEN '{$dateinicioP}' AND '{$dateFinP}';";
        $capacitacionUser = $this->db->query($sql);
        return $capacitacionUser;
    }

    public function addCapacitacion($idUser, $capacitacion)
    {
        $sqlAdd = "INSERT INTO `requierecapacitacion` (
        `idcapacitacion` ,
        `idusuario` ,
        `nececitacapacitacion` ,
        `fecha`
        )
        VALUES (
        NULL , '{$idUser}', '{$capacitacion}', CURDATE());";
        $addCapacitacion = $this->db->query($sqlAdd);

        $addcap = false;

        if ($addCapacitacion) {
            $addcap = true;
            return $addcap;
        } else {
            $addcap = false;
            return $addcap;
        }
    }
    public function getAllCapacionesDetalle($id, $periodo, $fecha)
    {
        $year =  date('Y');

        if ($periodo == 1 && $fecha == $year) {
            $dateinicioP = date("Y-01-01");
            $dateFinP = date("Y-06-31");
            $sql = "SELECT * FROM `requierecapacitacion` WHERE idusuario = {$id} AND fecha BETWEEN '{$dateinicioP}' AND '{$dateFinP}';";
            $capacitacionUser = $this->db->query($sql);
            return $capacitacionUser;
        } else {
            $dateinicioP = date("Y-07-01");
            $dateFinP = date("Y-12-31");
            $sql = "SELECT * FROM `requierecapacitacion` WHERE idusuario = {$id} AND fecha BETWEEN '{$dateinicioP}' AND '{$dateFinP}';";
            $capacitacionUser = $this->db->query($sql);
            return $capacitacionUser;
        }
    }
    public function editCapacitacion($idCapacitacion, $iduser, $capacitacion)
    {
        $editsql =  "UPDATE requierecapacitacion SET nececitacapacitacion = '{$capacitacion}' WHERE idcapacitacion = {$idCapacitacion} AND idusuario = {$iduser};";
        $saveEditCapacitacion =  $this->db->query($editsql);

        $save =  false;

        if ($saveEditCapacitacion) {
            $save =  true;
            return $save;
        } else {
            $save =  false;
            return $save;
        }
    }
}
