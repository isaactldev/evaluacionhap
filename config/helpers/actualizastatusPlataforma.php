<?php
include '../../db/db.php';
$db = dataBase::conexion();

if (isset($_POST['statusPlataforma'])) {
    echo $status = $_POST['statusPlataforma'];

    $sql = "UPDATE statussitioweb SET sitioactivo = {$status} WHERE idstatussitioweb = 1;";
    $activar  =  mysqli_query($db, $sql);

    $update =  false;

    if ($activar) {
        $update  =  true;
        return $update;
    } else {
        return $update;
    }
}
