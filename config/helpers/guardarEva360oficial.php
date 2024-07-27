<?php
$db = mysqli_connect('localhost', 'root', 'DesWeb15', 'evapersonal22');

if (isset($_POST['objtUseR'])) {


    /*  $mensaje2 = "exito"; */
    $noEvaluador = $_POST['objtUseR']["noEvaluador"];
    $noEvaluado = $_POST['objtUseR']["noEvaluado"];
    $periodoActivo = $_POST['objtUseR']['periodoActivo'];
    $totalPreguntas = $_POST['objtUseR']['totalPreguntas'];
    $promedioFinal360 = $_POST['objtUseR']['promedioFinal360'];

    $fecha = date('Y');

    /* /VALIDACION DEL PERIODO */
    for ($i = 0; $i < $totalPreguntas; $i++) {
        # code..
        $idBloque = $_POST['objtUseR']['respuestas360'][$i]['idBloque'];
        $idpregunta  = $_POST['objtUseR']['respuestas360'][$i]['idPregunta'];
        $respuesta = $_POST['objtUseR']['respuestas360'][$i]['valorRespuesta'];

        /* INSERSION DE LAS RESPUESTAS DEL AL EVALUACION  */
        $sql = "INSERT INTO `evaluacionausuarios360` (`idevaluaciona360`,`noempleadoEvaluador`,`noempleadoEvaluado`,`idbloqueCompeGen360`,`idcuestionarioeva360`,`ponderacion`,`periodo`,`fecha`) 
        VALUES(NULL, {$noEvaluador}, {$noEvaluado}, {$idBloque}, {$idpregunta}, {$respuesta}, {$periodoActivo},{$fecha});";
        $saveRespuesta = mysqli_query($db, $sql);
    }


    /* VALIDAMOS SI EL PERSONAL 360 ESTA EVALUADO EN LA TABLA `personal360` */
    $chekPersonal360statusEvaluado = "SELECT * FROM `personal360` WHERE `idevaluador` = {$noEvaluador} AND `periodo` = {$periodoActivo} AND `statuseva360` = 2 AND `fecha` = {$fecha};";
    $existcchekCalifPeriodo360 = mysqli_query($db, $chekPersonal360statusEvaluado);


    if ($existcchekCalifPeriodo360->num_rows >= 1) {
        /* ACTULIZAMOS EL ESTATUS EVALUADO */
        $updatestatuscalif360  = "UPDATE `personal360` SET `statuseva360` = 1 WHERE `idevaluador` = {$noEvaluador} AND `idevaluado` = {$noEvaluado} AND `periodo` = {$periodoActivo} AND `statuseva360` = 2 AND `fecha` = {$fecha};";
        $updatestatuscalif360save = mysqli_query($db, $updatestatuscalif360);

        $sqlpromFinalCalif360 = "UPDATE `personal360` SET promFinalCalif360 = {$promedioFinal360} WHERE `idevaluador` = {$noEvaluador} AND `idevaluado` = {$noEvaluado} AND `periodo` = {$periodoActivo} AND `fecha` = {$fecha};";
        $saveCalif = mysqli_query($db, $sqlpromFinalCalif360);
    }


    $request = false;
    if ($updatestatuscalif360save && $saveCalif) {
        $request = true;
        $_SESSION['evaluacion'] = 'evaluacionSave';
        echo '<script>
        window.location.replace("' . baseUrl . '?controller=evausuario&action=index");
        </script>';
    } else {
        $mensaje2 .= "REGRISTRO FALLIDO";
        $_SESSION['evaluacion'] = 'evaluacionError';
        echo '<script>
        window.location.replace("' . baseUrl . '?controller=evausuario&action=index");
        </script>';
    }
} else {
    $mensaje2 .= "No Se Guardo Correctamente la Evaluaion";
    $_SESSION['evaluacion'] = 'evaluacionError';
    echo '<script>
    window.location.replace("' . baseUrl . '?controller=evausuario&action=index");
    </script>';
}


$mensaje2 .= "REGRISTRO EXITOSO";
print_r($mensaje2);
