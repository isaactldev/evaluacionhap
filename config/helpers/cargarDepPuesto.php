<?php
//CARGA DE RELACION DEL PUESTO Y DEPARTAMENTO DEL USUARIO 
include '../../db/db.php';
$db = dataBase::conexion();


$sql = "SELECT idpuesto, iddepartamento FROM `usuarios`;";
$deppuesto = mysqli_query($db, $sql);



while ($relaciondeppuesto = $deppuesto->fetch_object()) {

    $checkDepPuesto = "SELECT * FROM `deppuesto` WHERE `idpuesto` = {$relaciondeppuesto->idpuesto} AND iddepartamento = {$relaciondeppuesto->iddepartamento};";
    $exstiDepPuesto = mysqli_query($db, $checkDepPuesto);


    if ($exstiDepPuesto->num_rows == 0) {
        # code...
        $sqlinsertDepPuesto = "INSERT INTO `deppuesto`  (`iddeppuesto`, `idpuesto`, `iddepartamento`) VALUES (NULL, {$relaciondeppuesto->idpuesto},{$relaciondeppuesto->iddepartamento});";
        $sqlSaveDepPuesto = mysqli_query($db, $sqlinsertDepPuesto);
    }
}
