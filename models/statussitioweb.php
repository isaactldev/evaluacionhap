<?php

class statusSitiiWeb
{

    private $idstatussitioweb;
    private $sitioactivo;
    private $db;


    public function __construct()
    {
        $this->db = dataBase::conexion();
    }


    /**
     * Get the value of idstatussitioweb
     */
    public function getIdstatussitioweb()
    {
        return $this->idstatussitioweb;
    }

    /**
     * Set the value of idstatussitioweb
     */
    public function setIdstatussitioweb($idstatussitioweb)
    {
        $this->idstatussitioweb = $idstatussitioweb;

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
     */
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }

    public function statusSitioWeb()
    {
        $sql = "SELECT * FROM statussitioweb;";
        $statusWeb = $this->db->query($sql)->fetch_object();

        return $statusWeb;
    }
    public function updatestatusActivo($status)
    {
        $sql = "UPDATE statussitioweb SET sitioactivo = {$status} WHERE idstatussitio = 1;";
        $activar  =  $this->db->query($sql);

        $update =  false;

        if ($activar) {
            $update  =  true;
            return $update;
        } else {
            return $update;
        }
    }
}
