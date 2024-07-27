<?php
class Puestos{
    private  $idpuesto;
    private  $idstatus;
    private  $nombrePuesto;
    private  $descripcion;
    private  $fechaalta;
    private  $departamento;
    private  $db;

    public function __construct()
    {
        $this->db = dataBase::conexion();
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
    public function getNombrePuesto()
    {
        return $this->nombrePuesto;
    }
    public function setNombrePuesto($nombrePuesto)
    {
        $this->nombrePuesto = $nombrePuesto;

        return $this;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

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
    
    public function getDepartamento()
    {
        return $this->departamento;
    }
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;

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

    public function getAllpuestos(){
        $sql = "SELECT * FROM `puestos`";
        $puestos = $this->db->query($sql);
        return $puestos;
    }
    /* AQUI OBTENEMOS EL PUESTO DEL USUARIO/ TAMBIEN SE USA PARA OBTENER EL PUESTO PARA LAS CMPETENCIAS TECNICAS */
    public function getUserPuesto($id){
    $sql = "SELECT * FROM `puestos` WHERE `idpuesto` = '{$id}';";
    $userPuesto = $this->db->query($sql);
    return $userPuesto->fetch_object();
    }
    public function add(){
        $sql = "INSERT INTO `puestos` ( `idpuesto`, `idstatus`, `nombrepuesto`, `descripcion`, `fechaalta`) VALUES( NULL, 1, '{$this->getNombrePuesto()}', '{$this->getDescripcion()}', CURDATE());";
        $add = $this->db->query($sql);

        $save = false;
        if ($add) {
        $save = true;
        }
        return $save;
    }
    public function adddeppuesto(){
        $sql = "SELECT LAST_INSERT_ID() AS 'idpuesto';";// sacamos el ultimo insert para crear la relacion del puesto con el departamento
        $query = $this->db->query($sql);
        $idpuesto = $query->fetch_object()->idpuesto;

        $savedeppuesto = "INSERT INTO `deppuesto`(`iddeppuesto`, `idpuesto`, `iddepartamento`) VALUES(NULL, {$idpuesto}, {$this->getDepartamento()});";
        $save = $this->db->query($savedeppuesto);

        $add = false;
        if ($save) {
        $add = true;
        }
        return $add;
        
    }


    public function edit(){
    $sql ="UPDATE `puestos` SET `nombrepuesto`= '{$this->getNombrePuesto()}', `idstatus`= {$this->getIdstatus()}";
    if ($this->getDescripcion() != null) {
    $sql .=", `descripcion`= '{$this->getDescripcion()}'";
    }
    $sql .= " WHERE `idpuesto` = {$this->getIdpuesto()};";

    $edit = $this->db->query($sql);


    $sqlcheckDepPuesto = "SELECT * FROM `deppuesto` WHERE `idpuesto`= {$this->getIdpuesto()} AND `iddepartamento` = {$this->getDepartamento()}";
    $registroDepPuesto = $this->db->query($sqlcheckDepPuesto);

    /* VERIFICACION DE LA EXISTENCIA DE LA RELACION PUESTO => DEPARTAMENTO */
    if (mysqli_num_rows($registroDepPuesto)>0) {
        
        /* SE ACTUALIZA EL PUESTO Y EL DEPARTAMENTO AL AQUE PERTENECE */
        $sqlpuestodep = "UPDATE `deppuesto` SET `iddepartamento`= {$this->getDepartamento()} WHERE `idpuesto`= {$this->getIdpuesto()};";
        $editpuestodep = $this->db->query($sqlpuestodep);
    }else{
        /* EN CASO DE NO EXISTIR LA RELACION DEL PUESTO CON EL DEPARTAMENTO SE INSERTA LA RELACION */
        $savedeppuesto = "INSERT INTO `deppuesto`(`iddeppuesto`, `idpuesto`, `iddepartamento`) VALUES(NULL, {$this->getIdpuesto()}, {$this->getDepartamento()});";
        $savedeppuest = $this->db->query($savedeppuesto);
    }
    
        
    $update = false;
    if ($edit && $editpuestodep || $edit && $savedeppuest) {
        $update = true;
        }
        return $update;
    }


    public function delete(){
    $sql = "DELETE FROM `puestos` WHERE `idpuesto` ={$this->getIdpuesto()};";
    $puesto = $this->db->query($sql);

    $delete = false;
    if ($puesto) {
    $delete = true;
    }
    return $delete;
    }
}
?>