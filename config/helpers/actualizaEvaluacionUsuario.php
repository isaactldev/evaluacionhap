<?php
$db = mysqli_connect('localhost', 'root', 'DesWeb15', 'evapersonal22');

if (isset($_POST['objtUseR'])) {
    /*  $mensaje2 = "exito"; */
    $idUser = $_POST['objtUseR']["idusuario"];
    $totalPuntosG = $_POST['objtUseR']["totalPuntosG"];
    $totalPuntosTec = $_POST['objtUseR']["totalPuntosTec"];
    $resp = COUNT($_POST['objtUseR']['respuestas']);
    $respTec = COUNT($_POST['objtUseR']['respuestasTec']);
    $califCapacitacion =  $_POST['objtUseR']['califCapacitacion'];
    $periodo = $_POST['objtUseR']['periodo'];
    $year = date('Y');


    $sqlinfoUserEva =  "SELECT * FROM usuarios WHERE idusuario =  {$idUser};";
    $infoUserEva =  mysqli_query($db, $sqlinfoUserEva)->fetch_object();

    $maxPuntosG = $resp * 4;
    $maxPuntosTec = $respTec * 4;


    $year =  date("Y");
    /* /VALIDACION DEL PERIODO */
    for ($i = 0; $i < $resp; $i++) {
        # code..
        $idpregunta  = $_POST['objtUseR']['respuestas'][$i]['idPreguntra'];
        $idrespuesta = $_POST['objtUseR']['respuestas'][$i]['respuesta'];
        $idBloque = $_POST['objtUseR']['respuestas'][$i]['idbloque'];

        /* INSERSION DE LAS RESPUESTAS DEL AL EVALUACION  */
        $sqlupDateponderaciones = "UPDATE `evaluacionusario` SET idponderacion = {$idrespuesta} WHERE idusuario = {$idUser} AND idpregunta = {$idpregunta} AND periodo= {$periodo} AND  fecharesolucion LIKE '%{$year}%';";
        $puesto = mysqli_query($db, $sqlupDateponderaciones);
    }

    /* VALIDACION DE CALIFICACION PARA ENFERMERAS */
    $califAnecdotario = $_POST['objtUseR']["califAnecdotario"];
    $existAnecdotario = $_POST['objtUseR']["existAnecdotario"];

    if ($existAnecdotario == 1) {

        $calf1 = (($totalPuntosG * 0.4) / $maxPuntosG) * 10;
        $calf2 = $califAnecdotario;


        /* ACTUALIZACION DE CALIFTEC PARA ENFERMERAS */
        $year = date('Y');
        /* INSERCION DE CALIFICACION TECNICA PARA REPORTE */
        $sqlcheckCaliftec360Enf = "SELECT * FROM `califtec360` WHERE `idusario` = {idUser} AND `idperiodo` = {$periodo} AND  `date` = {$year};";
        $checkCaliftec360Enf = mysqli_query($db, $sqlcheckCaliftec360Enf);

        if ($checkcaliftec->num_rows >= 1) {
            /* INSERCION DE CALIFICACION TECNICA PARA REPORTE */
            $sqlupdatecaliftecEnf = "UPDATE `califtec360` SET `calificaciontec` = {$calf2} WHERE `idusario` = {$idUser} AND `idperiodo` = {$periodo} AND `date` =  {$year};";
            $updatecaliftecEnf = mysqli_query($db, $sqlupdatecaliftecEnf);
        } else {
            $sqlcaliftecEnf = "INSERT INTO `califtec360` (`idcaliftec`, `idusario`,`calificaciontec`,`idperiodo`,`date`) 
                VALUES (NULL, {$idUser}, {$calf2}, {$periodo}, {$year});";
            $savecaliftecEnf = mysqli_query($db, $sqlcaliftecEnf);
        }

        $calificacion = ($calf1 + $calf2);

        if ($calificacion >= 10) {
            $calificacionOficial = 10;
        } else {
            $calificacionOficial = round($calificacion, 2);/* CALCULO A 2 DECIMALES */
        }
    } else {

        /* CALCULO DE CALIFICACION OPARA OPERATIVOS */
        $calf1 = ($totalPuntosG * 0.6) / $maxPuntosG;
        $calf2 = ($totalPuntosTec * 0.4) / $maxPuntosTec;

        $califtec = $calf2 * 10;

        $calificacion = ($calf1 + $calf2) * 10;



        /* SE PONDERA LA CALIFICACION SI ES MAYOR A 10 SE QUEDA EN UN 10 ABSOLUTO */
        if ($calificacion >= 10) {
            $calificacionOficial = 10;
        } else {
            $calificacionOficial = round($calificacion, 2);/* CALCULO A 2 DECIMALES */
        }

        $year = date('Y');
        /* INSERCION DE CALIFICACION TECNICA PARA REPORTE */
        $sqlcheckCaliftec360 = "SELECT * FROM `califtec360` WHERE `idusario` = {idUser} AND `idperiodo` = {$periodo} AND  `date` = {$year};";
        $checkCaliftec360 = mysqli_query($db, $sqlcheckCaliftec360);

        if ($checkcaliftec->num_rows >= 1) {
            /* INSERCION DE CALIFICACION TECNICA PARA REPORTE */
            $sqlupdatecaliftec = "UPDATE `califtec360` SET `calificaciontec` = {$califtec} WHERE `idusario` = {$idUser} AND `idperiodo` = {$periodo} AND `date` =  {$year};";
            $updatecaliftec = mysqli_query($db, $sqlupdatecaliftec);
        } else {
            $sqlcaliftec = "INSERT INTO `califtec360` (`idcaliftec`, `idusario`,`calificaciontec`,`idperiodo`,`date`) 
                VALUES (NULL, {$idUser}, {$califtec}, {$periodo}, {$year});";
            $savecaliftec = mysqli_query($db, $sqlcaliftec);
        }


        for ($j = 0; $j < $respTec; $j++) {
            # code...
            $idPreguntaTec = $_POST['objtUseR']['respuestasTec'][$j]['idPreguntaTecr'];
            $idrespTec = $_POST['objtUseR']['respuestasTec'][$j]['respTec'];

            $sqlupdaterespuestasTec = "UPDATE `evaluacionrespusuariotecnica` SET `idponderacion` = {$idrespTec} WHERE `idusuario` =  {$idUser} AND `idcopentenciatecnica` = {$idPreguntaTec} AND `periodo` = {$periodo} AND `fecharesolucion` LIKE '%{$year}%'";
            $updaterespuestasTec = mysqli_query($db, $sqlupdaterespuestasTec);
        }
    }
    $year = date('Y');
    /* VALIDAMOS SI LA CALIFICACION A GUARDAR ES DEL PERIODO 1 O 2  */
    $chekCalifPeriodo = "SELECT * FROM `calificacionusuarioperiodo` WHERE `idusuario` = {$idUser} AND idperiodo = {$periodo} AND fecha = {$year};";
    $existcchekCalifPeriodo = mysqli_query($db, $chekCalifPeriodo);

    if ($existcchekCalifPeriodo->num_rows >= 1) {
        $sqlupdateCalifPeriodo = "UPDATE `calificacionusuarioperiodo` SET `calificacionperiodo` = {$calificacionOficial} WHERE `idusuario` = {$idUser} AND idperiodo = {$periodo} AND fecha = {$year};";
        $updateCalifPeriodo = mysqli_query($db, $sqlupdateCalifPeriodo);
    } else {
        /* INSERCION DE CALIFICACION TECNICA PARA REPORTE */
        $sqlCalifPeriodo = "INSERT INTO `calificacionusuarioperiodo` (`idcalificacionperiodo`, `idusuario`,`idperiodo`,`calificacionperiodo`,`fecha`) 
        VALUES (NULL, {$idUser},{$periodo}, {$calificacionOficial}, {$year});";
        $savecaliftec = mysqli_query($db, $sqlCalifPeriodo);
    }

    $sqlCalificacionTotal = "UPDATE `usuarios` SET calificacion = {$calificacionOficial} WHERE idusuario = {$idUser};";
    $updateCalif = mysqli_query($db, $sqlCalificacionTotal);


    $request = false;
    if ($updateCalifPeriodo) {
        $request = true;
        $sqluser = "UPDATE `usuarios` SET statusevaluado = 1 WHERE idusuario = {$idUser};";
        $actualizaStatusevaluado = mysqli_query($db, $sqluser);
        $request2 = false;
        if ($actualizaStatusevaluado) {
            $request2 = true;
            $_SESSION['evaluacion'] = 'evaluacionSave';
            echo '<script>
                window.location.replace("' . baseUrl . '?controller=evausuario&action=index");
                </script>';
        } else {
            $_SESSION['evaluacion'] = "evaluacionError";
            echo '<script>
                window.location.replace("' . baseUrl . '?controller=evausuario&action=index");
                </script>';
        }
    } else {
        $mensaje2 .= "REGRISTRO FALLIDO";
        $_SESSION['evaluacion'] = 'evaluacionError';
        echo '<script>
        window.location.replace("?controller=evausuario&action=index");
        </script>';
    }
} else {
    $mensaje2 .= "No Se Guardo Correctamente la Evaluaion";
    $_SESSION['evaluacion'] = 'evaluacionError';
    echo '<script>
    window.location.replace("?controller=evausuario&action=index");
    </script>';
}


$mensaje2 .= "REGRISTRO EXITOSO";
print_r($mensaje2);
