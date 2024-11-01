<?php

/* CRON PARA ACTUALIZAR USUARIOS Y PASSWORD */
include '../../db/db.php';
$db = dataBase::conexion();

$sql_allUserpass = "SELECT idusuario,appaterno, noempleado, password FROM usuarios;";
$allUserpass =  mysqli_query($db, $sql_allUserpass);

while ($newuserPass = $allUserpass->fetch_object()) {
    # code...

    $updateUserPass = "UPDATE usuarios SET usuario= '{$newuserPass->appaterno}{$newuserPass->noempleado}', password =  '{$newuserPass->noempleado}' WHERE idusuario = {$newuserPass->idusuario};";
    $updateOk = mysqli_query($db, $updateUserPass);

    if (isset($updateOk)) {
        print_r($successUpdate = $newuserPass->noempleado . " =>REGISTRO ACTUALIZADO<br>");
    } else {
        print_r($successUpdate =  $newuserPass->noempleado . " =>NO PUDIMOS ACTUALIZAR EL REGISTRO");
    }
}
