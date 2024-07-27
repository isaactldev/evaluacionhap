<?php
class Deppuesto{
private $iddeppuesto;
private $idpuesto;
private $iddepartemetno;
private $db;

public function __construct()
{
    $this->db = dataBase::conexion();
}

public function getIddeppuesto()
{
return $this->iddeppuesto;
}
public function setIddeppuesto($iddeppuesto)
{
$this->iddeppuesto = $iddeppuesto;
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
public function getIddepartemetno()
{
return $this->iddepartemetno;
}
public function setIddepartemetno($iddepartemetno)
{
$this->iddepartemetno = $iddepartemetno;
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


public function getDepartementoPuesto(){
    $sql = "SELECT d.iddepartamento, p.idpuesto, dep.depnombre, p.nombrepuesto, p.descripcion, p.idstatus FROM deppuesto d
    INNER JOIN  puestos p ON d.idpuesto = p.idpuesto
	INNER JOIN  departamento dep ON d.iddepartamento = dep.iddepartamento 
    WHERE d.iddepartamento = {$this->getIddepartemetno()};";
    $puestos = $this->db->query($sql);
    return $puestos;
}
}

?>