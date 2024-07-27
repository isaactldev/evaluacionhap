<?php

class CalificacionEvaluacionUsuario
{

private $idevaluacion;
private $idusuario;
private $idbloque;
private $idpregunta;
private $idponderacion;
private $periodo;
private $idstatus;
private $fecharesolucion;
private $db;

public function __construct()
{
    $this->db = dataBase::conexion();
}
public function getIdevaluacion()
{
return $this->idevaluacion;
}
public function setIdevaluacion($idevaluacion)
{
$this->idevaluacion = $idevaluacion;

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
public function getIdbloque()
{
return $this->idbloque;
}
public function setIdbloque($idbloque)
{
$this->idbloque = $idbloque;

return $this;
}
public function getIdpregunta()
{
return $this->idpregunta;
}
public function setIdpregunta($idpregunta)
{
$this->idpregunta = $idpregunta;

return $this;
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
public function getPeriodo()
{
return $this->periodo;
}
public function setPeriodo($periodo)
{
$this->periodo = $periodo;

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
public function getFecharesolucion()
{
return $this->fecharesolucion;
}
public function setFecharesolucion($fecharesolucion)
{
$this->fecharesolucion = $fecharesolucion;

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

/* FUNCION PARA EL REPORTE DE CALIFICACIONES POR BLOQUE Y USUARIO  */
public function calificacionXBloque(){
$sql = "SELECT COUNT(idbloque) AS NoPreguntas, SUM(idponderacion) AS Calificacion FROM `evaluacionusario` WHERE `idbloque` = {$this->getIdbloque()} AND `idusuario` = {$this->getIdusuario()} AND `periodo`={$this->getPeriodo()} AND `fecharesolucion` like '%{$this->getFecharesolucion()}%'  ;";
    $calificacionBloque = $this->db->query($sql);

    /* $error = $this->db->error;
    var_dump($sql);
    die(); */
    return $calificacionBloque->fetch_object();
}
}

?>