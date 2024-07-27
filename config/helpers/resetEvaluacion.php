<?php

include '../../db/db.php';
$db = dataBase::conexion();


if (isset($_POST)) {

    $idUsuario = $_POST['idusuario'];
    $fecha =  $_POST['yearC'];
    $pariodoCalif =  $_POST['pariodoCalif'];


    //FLUJO PARA REINICIO DE EVALUACIONES
    $sqlinfoUserReset =  "SELECT * FROM usuarios WHERE idusuario =  {$idUsuario};";
    $infoUserReset =  $db->query($sqlinfoUserReset)->fetch_object();

    //ACTUALIZMOS EL ESTATUS DEL COLABORADOR Y ACUALIZAMOS LA ULTIMA CALIFICACION EN LA TABLA DE usuarios
    $sqlUpdateestatusCalifUsuarios =  "UPDATE usuarios SET statusevaluado =  2, calificacion =  0 WHERE idusuario =  {$idUsuario}; ";
    $UpdateestatusCalifUsuarios = $db->query($sqlUpdateestatusCalifUsuarios);

    //ELIMINAMOS RESPUESTAS DE LA TABLA evaluacionusario
    $sqldeleteRespEvaUser =  "DELETE FROM evaluacionusario WHERE idusuario = {$idUsuario} AND periodo =  {$pariodoCalif} AND fecharesolucion LIKE '%{$fecha}%';";
    $deleteRespEvaUser =  $db->query($sqldeleteRespEvaUser);

    if ($deleteRespEvaUser) {
        $sqldeleteRespEvaTec =  "DELETE FROM evaluacionrespusuariotecnica WHERE idusuario = {$idUsuario} AND periodo =  {$pariodoCalif} AND fecharesolucion LIKE '%{$fecha}%';";
        $deleteRespEvaTec =  $db->query($sqldeleteRespEvaTec);

        if ($deleteRespEvaTec) {
            $sqldeleteCalifPeriodo =  "DELETE FROM calificacionusuarioperiodo WHERE idusuario = {$idUsuario} AND idperiodo =  {$pariodoCalif} AND fecha = {$fecha};";
            $deleteCalifPeriodo = $db->query($sqldeleteCalifPeriodo);

            if ($deleteCalifPeriodo) {
                $sqlUpdatecaliftec360 =  "DELETE FROM califtec360  WHERE idusario = {$idUsuario} AND idperiodo =  {$pariodoCalif} AND `date` = {$fecha};";
                $Updatecaliftec360 = $db->query($sqlUpdatecaliftec360);

                if ($Updatecaliftec360) {
                    $response = "200";
                    echo $response;
                } else {
                    $response = "NO SE LOGRO ELIMINAR LA CALIFICACION TECNICA DEL COLABORADOR!";
                    echo $response;
                }
            } else {
                $response = "NO SE LOGRO ELIMINAR LA CALIFICACION DEL PERIODO EN CURSO DEL COLABORADOR!";
                echo $response;
            }
        } else {
            $response = "NO SE LOGRARON ELIMINAR LAS RESPUESTAS TECNICAS DE LA EVALUACION DEL COLABORADOR!";
            echo $response;
        }
    } else {
        $response = "NO SE LOGRARON ELIMINAR LAS RESPUESTAS DE LA EVALUACION DEL COLABORADOR!";
        echo $response;
    }
}
