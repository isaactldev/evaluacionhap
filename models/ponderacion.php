<?php
class Ponderacion
{
private $idponderacion;
private $descripcion;
private $puntos;
private $db;

public function __construct()
{
    $this->db = dataBase::conexion();
}
public function getIdponderacion()
{
return $this->idponderacion;
}
public function setIdponderacion($idponderacion)
{
$this->idponderacion = $idponderacion;
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
public function getPuntos()
{
return $this->puntos;
}
public function setPuntos($puntos)
{
$this->puntos = $puntos;
return $this;
}

public function getAllPonderaciones(){
    $sql = "SELECT * FROM `ponderacion`;";
    $ponderaciones = $this->db->query($sql);
    return $ponderaciones;
}
public function coutPonderacines(){
    $sql = "SELECT COUNT( `idponderacion` )AS idponderacion FROM `ponderacion`;";
    $countPonderacion = $this->db->query($sql);
    return $countPonderacion->fetch_object();
}
}

?>