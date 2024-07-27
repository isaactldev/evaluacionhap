<?php
class calificacion360
{
    private $idcalificacion360;
    private $idusuario;
    private $calificacion;
    private $idstatus;
    private $idperiodo;
    private $fehca;
    private $db;

    public function __construct()
    {
        $this->db = dataBase::conexion();
    }
    public function getIdcalificacion360()
    {
        return $this->idcalificacion360;
    }
    public function setIdcalificacion360($idcalificacion360)
    {
        $this->idcalificacion360 = $idcalificacion360;

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

    /**
     * Get the value of calificacion
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set the value of calificacion
     *
     * @return  self
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

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
     * Get the value of fehca
     */
    public function getFehca()
    {
        return $this->fehca;
    }

    /**
     * Set the value of fehca
     *
     * @return  self
     */
    public function setFehca($fehca)
    {
        $this->fehca = $fehca;

        return $this;
    }

    public function getAllCalifUsers()
    {
        $sql = "SELECT *  FROM `calificacion360`;";
        $calificacionesUsers = $this->db->query($sql);
        return $calificacionesUsers;
    }
    public function getCalifByUser($id, $idperiodo, $fecha)
    {
        $sql = "SELECT * FROM `calificacion360` WHERE idusuario = {$id} AND `idperiodo` = {$idperiodo} AND `fecha` = {$fecha};";
        $userCalificacion360 = $this->db->query($sql);
        return $userCalificacion360->fetch_object();
    }
    /* ACTUALIZACIO0N DE LA CALIFICACION 360 DESDE EL MODAL DE CAPTURA O EDICION EN EL APARTADO DE PERSONAL360 */
    public function updateCalifByUser()
    {
        $sql = "UPDATE  `calificacion360` SET `calificacion` = '{$this->getCalificacion()}', `idstatus` = '1' WHERE `idusuario` = {$this->getIdusuario()}  AND `idperiodo`= {$this->getIdperiodo()} AND `fecha`= {$this->getFehca()};";
        $updateCalif = $this->db->query($sql);

        $update = false;

        if ($updateCalif) {
            $update = true;
        }
        return $update;
    }

    /* ESTA FUNCION ACTUALIZA EL NUMERO DE USUARIOS360 EN LA BASE DE DATOS PARA CAPTURAR SUS CALIFICACIONES */
    public function actualizaUserCalif($users360, $periodo, $fecha)
    {



        while ($user = $users360->fetch_object()) {
            $sqlusers360 = "SELECT * FROM `calificacion360` WHERE `idusuario` = {$user->idusuario} AND `idperiodo`= {$periodo} AND `fecha` = {$fecha};";
            $userCalif360_vrf = $this->db->query($sqlusers360);

            $userCalif_exist = false;
            /* validamos si el idususario existe en la tabla */
            if (mysqli_num_rows($userCalif360_vrf) <= 0) {
                /* REALIZAMOS LA ACTUALIZACION DE LOS REGISTROS DE LOS UUSARIOS 360 */
                $insertsqlusers360 = "INSERT INTO `calificacion360` (`idcalificacion360`,`idusuario`, `calificacion`,`idstatus`, `idperiodo`, `fecha`) VALUES (NULL, {$user->idusuario}, 0, 2, {$periodo}, {$fecha});";
                $userSave = $this->db->query($insertsqlusers360);
                /*  echo '<pre>';//ASI IMPRIMES UN OBJETO EN ORDEN EN EL NAVEGADOR
                var_dump($insertsqlusers360);
                echo '</pre>'; */
            } else {
            }


            if ($userSave) {
                $userCalif_exist = true;
            } else {
                $userCalif_exist = false;
            }
        }

        return $userCalif_exist;
    }
}
