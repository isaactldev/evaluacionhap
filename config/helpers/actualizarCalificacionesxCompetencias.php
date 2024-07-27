<?php

include '../../db/db.php';
include 'utils.php';

$db =  dataBase::conexion();


$sqlgetallCalificacionesPeriodo = "SELECT cusp.idusuario,us.noempleado,cusp.idperiodo,cusp.calificacionperiodo,cusp.fecha  FROM calificacionusuarioperiodo cusp
INNER JOIN usuarios us ON cusp.idusuario =  us.idusuario 
WHERE cusp.idperiodo = 1 AND cusp.fecha = 2024 ORDER BY cusp.idusuario ASC;";
$getallCalificacionesPeriodo =  $db->query($sqlgetallCalificacionesPeriodo);

foreach ($getallCalificacionesPeriodo as $usuario) {

    $cailfOficial =  Utils::calificacionCapacitacionbyUserPeriodo($usuario['noempleado'], $usuario['idperiodo'], $usuario['fecha'], $usuario['calificacionperiodo']);
    //echo "<pre>";
    $sqlupdateCalifUsuarioPeriodo = "UPDATE calificacionusuarioperiodo SET calificacionperiodo =  {$cailfOficial} WHERE idusuario = {$usuario['idusuario']} AND idperiodo = 1 AND fecha = 2024;";
    //echo "</pre>";
    //$updateCalifUsuarioPeriodo = $db->query($sqlupdateCalifUsuarioPeriodo);
    if ($updateCalifUsuarioPeriodo) {

        echo "Clificacion de " . $usuario['noempleado'] . " Actualizada = " . $cailfOficial;
    } else {
        echo "Calificacion de " . $usuario['noempleado'] . " sin actualizar";
    }
}
