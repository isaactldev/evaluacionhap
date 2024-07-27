<?php

class califTec360
{

    private $idcaliftec;
    private $idusario;
    private $calificaciontec;
    private $idperiodo;
    private $date;
    private $db;

    public function __construct()
    {
        $this->db = dataBase::conexion();
    }

    /**
     * Get the value of idcaliftec
     */
    public function getIdcaliftec()
    {
        return $this->idcaliftec;
    }

    /**
     * Set the value of idcaliftec
     *
     * @return  self
     */
    public function setIdcaliftec($idcaliftec)
    {
        $this->idcaliftec = $idcaliftec;

        return $this;
    }

    /**
     * Get the value of idusario
     */
    public function getIdusario()
    {
        return $this->idusario;
    }

    /**
     * Set the value of idusario
     *
     * @return  self
     */
    public function setIdusario($idusario)
    {
        $this->idusario = $idusario;

        return $this;
    }

    /**
     * Get the value of calificaciontec
     */
    public function getCalificaciontec()
    {
        return $this->calificaciontec;
    }

    /**
     * Set the value of calificaciontec
     *
     * @return  self
     */
    public function setCalificaciontec($calificaciontec)
    {
        $this->calificaciontec = $calificaciontec;

        return $this;
    }

    /**
     * Get the value of idperiodo
     */
    public function getIdperiodo()
    {
        return $this->idperiodo;
    }

    /**
     * Set the value of idperiodo
     *
     * @return  self
     */
    public function setIdperiodo($idperiodo)
    {
        $this->idperiodo = $idperiodo;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate($date)
    {
        $this->date = $date;

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

    public function getCaliftec($id, $periodo)
    {
        $date = date('Y');
        $sql = "SELECT * FROM `califtec360` WHERE `idusario` = {$id} AND `idperiodo` = {$periodo};";
        $calif  = $this->db->query($sql);
        return $calif->fetch_object();
    }

    public function getCaliftecByUser360($id, $periodo, $fecha)
    {
        $sql = "SELECT * FROM `califtec360` WHERE `idusario` = {$id} AND `idperiodo` = {$periodo} AND `date` =  {$fecha};";

        $calif  = $this->db->query($sql);
        return $calif->fetch_object();
    }
}
