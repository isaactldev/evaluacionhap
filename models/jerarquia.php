<?php
class Jerarquia
{
private $idjerarquia;
private $idstatus;
private $nombre;
private $db;

public function __construct()
{
    $this->db = dataBase::conexion();
}
public function getIdjerarquia()
{
return $this->idjerarquia;
}
public function setIdjerarquia($idjerarquia)
{
$this->idjerarquia = $idjerarquia;

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
public function getNombre()
{
return $this->nombre;
}
public function setNombre($nombre)
{
$this->nombre = $nombre;
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

public function getAllJerarquia(){
    $sql = "SELECT * FROM `jerarquia`;";
        $bloques = $this->db->query($sql);
        return $bloques;
}
}

?>