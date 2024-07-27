<?php
class Evaluaciones
{
private $idevaluacion;
private $idusuario;
private $idpregunta;
private $idponderacion;
private $totalpuntos;
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
public function getTotalpuntos()
{
return $this->totalpuntos;
}
public function setTotalpuntos($totalpuntos)
{
$this->totalpuntos = $totalpuntos;
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

/* FUNCIONES VISUALIZADO DE RESULTADOS DE EVALUACIONES */
public function getEvaluacionesUsuarios(){
    $sql = "SELECT * FROM evaluacionusario;";
    $evaluaciones = $this->db->query($sql);
    return $evaluaciones; /* estas haciendo el retorno del resultado de las encuestas */
}
public function getEvaluacionById(){
    $sql = "SELECT * FROM evaluacionusario WHERE `idevaluacion`= {$this->getIdevaluacion()};";
    $evaluacion = $this->db->query($sql);
    return $evaluacion->fetch_object(); /* estas haciendo el retorno del resultado de las encuestas */
}
}

?>