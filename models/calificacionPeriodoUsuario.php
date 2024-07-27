<?php
class Calificacionusuarioperiodo
{

    private $idcalificacionperiodo;
    private $idusuario;
    private $idperiodo;
    private $calificacionperiodo;
    private $fecha;
    private $db;

    public function __construct()
    {
        $this->db = dataBase::conexion();
    }



    /**
     * Get the value of idcalificacionperiodo
     */
    public function getIdcalificacionperiodo()
    {
        return $this->idcalificacionperiodo;
    }

    /**
     * Set the value of idcalificacionperiodo
     *
     * @return  self
     */
    public function setIdcalificacionperiodo($idcalificacionperiodo)
    {
        $this->idcalificacionperiodo = $idcalificacionperiodo;

        return $this;
    }

    /**
     * Get the value of idusuario
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * Set the value of idusuario
     *
     * @return  self
     */
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;

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
     * Get the value of calificacionperiodo
     */
    public function getCalificacionperiodo()
    {
        return $this->calificacionperiodo;
    }

    /**
     * Set the value of calificacionperiodo
     *
     * @return  self
     */
    public function setCalificacionperiodo($calificacionperiodo)
    {
        $this->calificacionperiodo = $calificacionperiodo;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

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


    public function getCalificacionPeriodoByUser($idusuario, $idperiodo, $fechaAct)
    {
        $sql = "SELECT * FROM `calificacionusuarioperiodo` WHERE `idusuario` = {$idusuario} AND `idperiodo` = {$idperiodo} AND `fecha` = {$fechaAct};";
        $calificacionPeriodoUser = $this->db->query($sql);

        return $calificacionPeriodoUser->fetch_object();
    }

    public function updateCalifPeriodo($calificacionPeriodo, $idusuario, $idperiodo, $fecha)
    {

        $sql = "UPDATE `calificacionusuarioperiodo` SET `calificacionperiodo` = {$calificacionPeriodo} WHERE `idusuario` = {$idusuario} AND `idperiodo` = {$idperiodo} AND `fecha` = {$fecha} ;";
        $actualizaCalificacionPerido = $this->db->query($sql);

        $updateCalif = false;
        if ($actualizaCalificacionPerido) {
            $updateCalif = true;
        } else {
            $updateCalif = false;
        }
        return $updateCalif;
    }
}
