<?php
class bloquecompetencia360{

private $idbloqueCompeGen360;
private $namebloque360;
private $idstatus;
private $idperiodo;
private $fecha;
private $db;

public function __construct()
{
    $this->db = dataBase::conexion();
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
 * Get the value of namebloque360
 */ 
public function getNamebloque360()
{
return $this->namebloque360;
}

/**
 * Set the value of namebloque360
 *
 * @return  self
 */ 
public function setNamebloque360($namebloque360)
{
$this->namebloque360 = $namebloque360;

return $this;
}

/**
 * Get the value of idstatus
 */ 
public function getIdstatus()
{
return $this->idstatus;
}

/**
 * Set the value of idstatus
 *
 * @return  self
 */ 
public function setIdstatus($idstatus)
{
$this->idstatus = $idstatus;

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


public function getAllbloquestec360(){
    $sql =  "SELECT * FROM `bloquecompetencia360`;";
    $sqlbloque360 = $this->db->query($sql);

    return $sqlbloque360;
}
public function getBloque360ById($idbloqueCompeGen360){
    $sql =  "SELECT * FROM `bloquecompetencia360` WHERE `idbloqueCompeGen360` = {$idbloqueCompeGen360};";
    $sqlbloque360 = $this->db->query($sql);

    return $sqlbloque360->fetch_object();
}

public function addBloque360(){
    $fecha =  date('Y');

    $sql = "INSERT INTO `bloquecompetencia360` (`idbloqueCompeGen360`,`namebloque360`,`idstatus`,`idperiodo`,`fecha`) VALUES(NULL, '{$this->getNamebloque360()}',1,{$this->getIdperiodo()},{$fecha});";
    $savesql = $this->db->query($sql);

    $save =  false;

    if($savesql){
        $save = true;
        return $save;
    }else{
        $save = false;
        return $save;
    }
}

public function actualizarStatus(){

    $sql = "UPDATE `bloquecompetencia360` SET  `idstatus` = {$this->getIdstatus()} WHERE `idbloqueCompeGen360` = {$this->getIdbloqueCompeGen360()}";
    $update =  $this->db->query($sql);

    $editstatus =  false;

    if($update){
        $editstatus = true;
        return $editstatus;
    }else{
        $editstatus = false;
        return $editstatus;
    }

}

public function bloqueedit360(){
    $sql = "UPDATE `bloquecompetencia360` SET  `namebloque360` = '{$this->getNamebloque360()}' WHERE `idbloqueCompeGen360` = {$this->getIdbloqueCompeGen360()}";
    $update =  $this->db->query($sql);

    $editstatus =  false;

    if($update){
        $editstatus = true;
        return $editstatus;
    }else{
        $editstatus = false;
        return $editstatus;
    }
}
}
?>


