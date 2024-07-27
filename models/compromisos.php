<?php

class Comprimisos
{
    private $idcompromiso;
    private $idusuario;
    private $compromiso;
    private $fechacompromiso;
    private $fechaCaptura;
    private $db;


    public function __construct()
    {
        $this->db = dataBase::conexion();
    }
    public function getIdcompromiso()
    {
        return $this->idcompromiso;
    }
    public function setIdcompromiso($idcompromiso)
    {
        $this->idcompromiso = $idcompromiso;

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
    public function getCompromiso()
    {
        return $this->compromiso;
    }
    public function setCompromiso($compromiso)
    {
        $this->compromiso = $compromiso;

        return $this;
    }
    public function getFechacompromiso()
    {
        return $this->fechacompromiso;
    }
    public function setFechacompromiso($fechacompromiso)
    {
        $this->fechacompromiso = $fechacompromiso;

        return $this;
    }
    public function getFechaCaptura()
    {
        return $this->fechaCaptura;
    }
    public function setFechaCaptura($fechaCaptura)
    {
        $this->fechaCaptura = $fechaCaptura;

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

    /* NO EXISTE EL METODO ADD COMPRIMISO YA QUE SE REALIZA ASINCRONO CUNDO DE GENERA LA EVALUACION */

    /* METODO PARTA MOSTRAR LOS COMPRIMISOS POR EL USUARIO REALIZADOS EN 1 AÑO */
    public function getCompromisosByIdUser($id)
    {
        $dateinicioP = date("Y-01-01");
        $dateFinP = date("Y-12-31");
        $sql = "SELECT * FROM `compromisos` WHERE idusuario = {$id} AND fechacompromiso BETWEEN '{$dateinicioP}' AND '{$dateFinP}';";
        $capacitacionUser = $this->db->query($sql);
        return $capacitacionUser;
    }

    public function addCompromisosByUser($idUser, $compromisos)
    {

        $sql = "INSERT INTO `compromisos` (
        `idcompromiso` ,
        `idusuario` ,
        `compromiso` ,
        `fechacompromiso` ,
        `fechaCaptura`
        )
        VALUES (NULL , '{$idUser}', '{$compromisos}', CURDATE(), NOW());";
        $addComprimiso =  $this->db->query($sql);

        $save =  false;

        if ($addComprimiso) {
            $save =  true;
            return $save;
        } else {
            $save =  false;
            return $save;
        }
    }

    public function getDetalleCompromisosByIdUser($id, $periodo, $fecha)
    {
        $year =  date('Y');

        if ($periodo == 1 && $fecha == $year) {
            $dateinicioP = date("Y-01-01");
            $dateFinP = date("Y-06-31");
            $sql = "SELECT * FROM `compromisos` WHERE idusuario = {$id} AND fechacompromiso BETWEEN '{$dateinicioP}' AND '{$dateFinP}';";
            $capacitacionUser = $this->db->query($sql);
            return $capacitacionUser;
        } else {
            $dateinicioP = date("Y-07-01");
            $dateFinP = date("Y-12-31");
            $sql = "SELECT * FROM `compromisos` WHERE idusuario = {$id} AND fechacompromiso BETWEEN '{$dateinicioP}' AND '{$dateFinP}';";
            $capacitacionUser = $this->db->query($sql);
            return $capacitacionUser;
        }
    }

    public function editCompromisisByUsers($idcompromisos, $iduser, $compromiso)
    {
        $editsql =  "UPDATE compromisos SET compromiso = '{$compromiso}' WHERE idcompromiso = {$idcompromisos} AND idusuario = {$iduser};";
        $saveEditCompromiso  =  $this->db->query($editsql);

        $save =  false;

        if ($saveEditCompromiso) {
            $save =  true;
            return $save;
        } else {
            $save =  false;
            return $save;
        }
    }
}
