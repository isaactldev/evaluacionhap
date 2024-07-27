<?php
class Departamentos
{
    private $iddepartamentto;
    private $idstatus;
    private $depnombre;
    private $fechaalta;
    private $db;

    public function __construct()
    {
        $this->db = dataBase::conexion();
    }
    public function getIddepartamentto()
    {
        return $this->iddepartamentto;
    }
    public function setIddepartamentto($iddepartamentto)
    {
        $this->iddepartamentto = $iddepartamentto;

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
    public function getDepnombre()
    {
        return $this->depnombre;
    }
    public function setDepnombre($depnombre)
    {
        $this->depnombre = $depnombre;

        return $this;
    }
    public function getFechaalta()
    {
        return $this->fechaalta;
    }
    public function setFechaalta($fechaalta)
    {
        $this->fechaalta = $fechaalta;

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
    public function getAlldepartamento(){
        $sql = "SELECT * FROM `departamento`;";
        $departamento = $this->db->query($sql);
        return $departamento;
    }
    public function getUserDepartamento($id){
        $sql = "SELECT * FROM `departamento` WHERE `iddepartamento` = '{$id}';";
        $userDep = $this->db->query($sql);
        return $userDep->fetch_object();
    }
    public function add(){
        $sql = "INSERT INTO `departamento` (`iddepartamento`, `idstatus`, `depnombre`, `fechaalta`) VALUES (NULL, 1, '{$this->getDepnombre()}', CURDATE());";
        $dep = $this->db->query($sql);

        $create = false;
        if ($dep) {
        $create = true;
        }
        return $create;
    }
    public function edit(){
    $sql = "UPDATE `departamento` SET  `idstatus`= '{$this->getIdstatus()}', `depnombre`= '{$this->getDepnombre()}' WHERE `iddepartamento`={$this->getIddepartamentto()};";
    $dep = $this->db->query($sql);

        $edit = false;
        if ($dep) {
        $edit = true;
        }
        return $edit;
    
    }
    public function delete() {
    $sql = "DELETE FROM `departamento` WHERE `iddepartamento` = {$this->getIddepartamentto()};";
    $dep = $this->db->query($sql);

    $delete = false;
    if ($dep) {
    $delete = true;
    }
    return $delete;
    }

}

?>