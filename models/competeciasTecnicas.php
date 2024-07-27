<?php
class competeciasTecnicas
{
    private $idcopentenciatecnica;
    private $idpuesto;
    private $idstatus;
    private $competencia;
    private $fecha_alta;
    private $db;
    private $periodo;

    public function __construct()
    {
        $this->db = dataBase::conexion();
    }
    public function getIdcopentenciatecnica()
    {
        return $this->idcopentenciatecnica;
    }
    public function setIdcopentenciatecnica($idcopentenciatecnica)
    {
        $this->idcopentenciatecnica = $idcopentenciatecnica;

        return $this;
    }
    public function getIdpuesto()
    {
        return $this->idpuesto;
    }
    public function setIdpuesto($idpuesto)
    {
        $this->idpuesto = $idpuesto;

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
    public function getCompetencia()
    {
        return $this->competencia;
    }
    public function setCompetencia($competencia)
    {
        $this->competencia = $competencia;

        return $this;
    }
    public function getFecha_alta()
    {
        return $this->fecha_alta;
    }
    public function setFecha_alta($fecha_alta)
    {
        $this->fecha_alta = $fecha_alta;

        return $this;
    }
    public function getPeriodo()
    {
        return $this->periodo;
    }
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;

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
    public function getAllcompetenciasTecnicas()
    {
    }
    public function getCompetenciasTecnicasbyId()
    {
        $sql = "SELECT * FROM `competenciastecnicas` WHERE idpuesto = {$this->getIdpuesto()}  AND `idstatus` = 1;";
        $request = $this->db->query($sql);
        return $request;
    }

    public function save()
    {
        $sql = "INSERT INTO `competenciastecnicas` (
            `idcopentenciatecnica` ,
            `idpuesto` ,
            `idstatus` ,
            `competencia` ,
            `fecha_alta`
            )
            VALUES (NULL , '{$this->getIdpuesto()}', '{$this->getIdstatus()}', '{$this->getCompetencia()}', CURDATE());";
        $save = $this->db->query($sql);
        $request = false;
        if ($save) {
            $request = true;
        }
        return $request;
    }
    public function delete()
    {
        $sql = "DELETE FROM `competenciastecnicas` WHERE `idcopentenciatecnica` = {$this->getIdcopentenciatecnica()};";
        $delete = $this->db->query($sql);
        $request = false;
        if ($delete) {
            $request = true;
        }
        return $request;
    }

    public function edit()
    {

        $sqlperiodo = "SELECT * FROM `periodo` WHERE `status`=1;";
        $periodoActivo = $this->db->query($sqlperiodo);
        $periodoActivo->fetch_object();


        /* SELECCIONAMOS LA ULTIMA VERSIOSN DE LA COMPETENCIA ANTES DE MODIFICARLA  */
        $sqlhistorico = "SELECT * FROM `competenciastecnicas` WHERE `idcopentenciatecnica` =  {$this->getIdcopentenciatecnica()};";
        $historicocompetec = $this->db->query($sqlhistorico);

        $historicocompetec->fetch_object();
        $fecha  = date('Y');

        /* GUARDAMOS LA ULTIMA VERSION EN EL HISTORICO CON EL PERIODO EN EL QUE SE MODIFICO*/
        $insertHistorico = "INSERT INTO `historycomptecperiodo` (`idhistoricocompetenciatec`,`idcompetenciatecnica`,`idpuesto`,`competencia`,`periodo`,`fecha`,`status`) 
        VALUE (NULL, {$historicocompetec->idcompetenciatecnica}, {$historicocompetec->idpuesto}, '{$historicocompetec->competencia}', {$periodoActivo->idperiodo}, {$fecha}, {$historicocompetec->idstatus});";
        $saveHistorico = $this->db->query($insertHistorico);

        /* ACTUALIZAMOS LA COMPETENCIA TECNICA */
        $sqlupdate = "UPDATE `competenciastecnicas` SET `competencia` = '{$this->getCompetencia()}', `idstatus` = {$this->getIdstatus()} WHERE `idcopentenciatecnica` = {$this->getIdcopentenciatecnica()};";
        $updateCompetenciaTec =  $this->db->query($sqlupdate);




        $update = false;

        if ($updateCompetenciaTec) {
            $update = true;
            return $update;
        } else {
            $update = false;
            return $update;
        }
    }
}
