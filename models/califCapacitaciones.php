<?php

class califCapacitaciones
{
    private $idcalifcapaccitacion;
    private $noempleado;
    private $calif_competencia;
    private $idperiodo;
    private $fecha;
    private $enlazado;
    private $fechaalta;
    private $db;


    public function __construct()
    {
        $this->db =  dataBase::conexion();
    }

    /**
     * Get the value of idcalifcapaccitacion
     */
    public function getIdcalifcapaccitacion()
    {
        return $this->idcalifcapaccitacion;
    }

    /**
     * Set the value of idcalifcapaccitacion
     *
     * @return  self
     */
    public function setIdcalifcapaccitacion($idcalifcapaccitacion)
    {
        $this->idcalifcapaccitacion = $idcalifcapaccitacion;

        return $this;
    }

    /**
     * Get the value of noempleado
     */
    public function getNoempleado()
    {
        return $this->noempleado;
    }

    /**
     * Set the value of noempleado
     *
     * @return  self
     */
    public function setNoempleado($noempleado)
    {
        $this->noempleado = $noempleado;

        return $this;
    }

    /**
     * Get the value of calif_competencia
     */
    public function getCalif_competencia()
    {
        return $this->calif_competencia;
    }

    /**
     * Set the value of calif_competencia
     *
     * @return  self
     */
    public function setCalif_competencia($calif_competencia)
    {
        $this->calif_competencia = $calif_competencia;

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
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of enlazado
     */
    public function getEnlazado()
    {
        return $this->enlazado;
    }

    /**
     * Set the value of enlazado
     *
     * @return  self
     */
    public function setEnlazado($enlazado)
    {
        $this->enlazado = $enlazado;

        return $this;
    }

    /**
     * Get the value of fechaalta
     */
    public function getFechaalta()
    {
        return $this->fechaalta;
    }

    /**
     * Set the value of fechaalta
     *
     * @return  self
     */
    public function setFechaalta($fechaalta)
    {
        $this->fechaalta = $fechaalta;

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


    public function getCalificacionCapacitacionByUsPerriodo()
    {
        $sql = "SELECT * FROM califcapacitacion WHERE noempleado = {$this->getNoempleado()} AND idperiodo = {$this->getIdperiodo()} AND fecha = {$this->getFecha()} AND enlazado =  1;";
        $califCapacitacion  =  $this->db->query($sql);

        if ($califCapacitacion->num_rows >= 1) {

            $califCapacitacion =  $califCapacitacion->fetch_object();
            return $califCapacitacion;
        } else {
            $califCapacitacion = false;
            return $califCapacitacion;
        }
    }
}
