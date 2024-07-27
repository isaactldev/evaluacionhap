<?php
class evaluacionausuarios360
{

 private $idevaluaciona360;
 private $noempleadoEvaluador;
 private $noempleadoEvaluado;
 private $idbloqueCompeGen360;
 private $idcuestionarioeva360;
 private $ponderacion;
 private $periodo;
 private $fecha;
 private $db;

 public function __construct()
 {
  $this->db = dataBase::conexion();
 }

/**
 * Get the value of idevaluaciona360
 */
 public function getIdevaluaciona360()
 {
  return $this->idevaluaciona360;
 }

/**
 * Set the value of idevaluaciona360
 *
 * @return  self
 */
 public function setIdevaluaciona360($idevaluaciona360)
 {
  $this->idevaluaciona360 = $idevaluaciona360;

  return $this;
 }

/**
 * Get the value of noempleadoEvaluador
 */
 public function getNoempleadoEvaluador()
 {
  return $this->noempleadoEvaluador;
 }

/**
 * Set the value of noempleadoEvaluador
 *
 * @return  self
 */
 public function setNoempleadoEvaluador($noempleadoEvaluador)
 {
  $this->noempleadoEvaluador = $noempleadoEvaluador;

  return $this;
 }

/**
 * Get the value of noempleadoEvaluado
 */
 public function getNoempleadoEvaluado()
 {
  return $this->noempleadoEvaluado;
 }

/**
 * Set the value of noempleadoEvaluado
 *
 * @return  self
 */
 public function setNoempleadoEvaluado($noempleadoEvaluado)
 {
  $this->noempleadoEvaluado = $noempleadoEvaluado;

  return $this;
 }

/**
 * Get the value of idbloqueCompeGen360
 */
 public function getIdbloqueCompeGen360()
 {
  return $this->idbloqueCompeGen360;
 }

/**
 * Set the value of idbloqueCompeGen360
 *
 * @return  self
 */
 public function setIdbloqueCompeGen360($idbloqueCompeGen360)
 {
  $this->idbloqueCompeGen360 = $idbloqueCompeGen360;

  return $this;
 }

/**
 * Get the value of idcuestionarioeva360
 */
 public function getIdcuestionarioeva360()
 {
  return $this->idcuestionarioeva360;
 }

/**
 * Set the value of idcuestionarioeva360
 *
 * @return  self
 */
 public function setIdcuestionarioeva360($idcuestionarioeva360)
 {
  $this->idcuestionarioeva360 = $idcuestionarioeva360;

  return $this;
 }

/**
 * Get the value of ponderacion
 */
 public function getPonderacion()
 {
  return $this->ponderacion;
 }

/**
 * Set the value of ponderacion
 *
 * @return  self
 */
 public function setPonderacion($ponderacion)
 {
  $this->ponderacion = $ponderacion;

  return $this;
 }

/**
 * Get the value of periodo
 */
 public function getPeriodo()
 {
  return $this->periodo;
 }

/**
 * Set the value of periodo
 *
 * @return  self
 */
 public function setPeriodo($periodo)
 {
  $this->periodo = $periodo;

  return $this;
 }

/**
 * Get the value of fecha
 */
 public function getFecha()
 {
  return $this->fecha;
 }

/**
 * Set the value of fecha
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

 public function getAllevaluacion360byEvaluador()
 {

  $sql = "SELECT * FROM `evaluacionausuarios360` WHERE `noempleadoEvaluador` = {$this->getNoempleadoEvaluador()};";
  $respuestasU360 = $this->db->query($sql);
  return $respuestasU360;
 }

 public function getAllExpresionEscritaByEmpleado($idcuestionarioeva360, $noempleadoEvaluador, $noempleadoEvaluado, $periodo, $fecha)
 {
  $sql = "SELECT * FROM `evaluacionausuarios360` WHERE `idcuestionarioeva360` =  {$idcuestionarioeva360} AND `noempleadoEvaluador` = {$noempleadoEvaluador} AND `noempleadoEvaluado` = {$noempleadoEvaluado} AND `periodo` = {$periodo} AND `fecha` = {$fecha};";
  $respuestaEvaluador = $this->db->query($sql);
  return $respuestaEvaluador->fetch_object();

 }

 public function getcountCalificacionXPregunta($noempleadoevaluado, $idcuestionarioeva360, $periodo, $fecha)
 {
  $sql = "SELECT SUM(`ponderacion`) AS sumPuntos, COUNT(`ponderacion`) AS countPuntos FROM `evaluacionausuarios360` WHERE `noempleadoEvaluado` = {$noempleadoevaluado} AND noempleadoEvaluador <> {$noempleadoevaluado} AND `idcuestionarioeva360` = {$idcuestionarioeva360} AND `periodo`= {$periodo} AND `fecha` = {$fecha};";
  $countPuntos = $this->db->query($sql);
  return $countPuntos->fetch_object();
 }
}
