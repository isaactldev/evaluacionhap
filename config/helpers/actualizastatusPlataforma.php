<?php


if (isset($_POST['statusPlataforma'])) {

    $db = mysqli_connect('localhost', 'root', 'DesWeb15', 'evapersonal22');

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
