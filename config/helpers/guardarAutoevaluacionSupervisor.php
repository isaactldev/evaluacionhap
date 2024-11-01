<?php
include '../../config/helpers/utils.php';
include '../../db/db.php';
$db = dataBase::conexion();


if (isset($_POST['objtUseR'])) {
    /*  $mensaje2 = "exito"; */
    $idUser = $_POST['objtUseR']["idusuario"];
    $totalPuntosG = $_POST['objtUseR']["totalPuntosG"];
    $totalPuntosTec = $_POST['objtUseR']["totalPuntosTec"];
    $resp = COUNT($_POST['objtUseR']['respuestas']);
    $respTec = COUNT($_POST['objtUseR']['respuestasTec']);
    $capacitacion = $_POST['objtUseR']['capacitacion'];
    $compromisos = $_POST['objtUseR']['compromisos'];
    $periodo = $_POST['objtUseR']['periodo'];
    $califCapacitacion =  $_POST['objtUseR']['califCapacitacion'];
    $year = date('Y');
    $maxPuntosG = $resp * 4;
    $maxPuntosTec = $respTec * 4;

    $sqlinfoUserEva =  "SELECT * FROM usuarios WHERE idusuario =  {$idUser};";
    $infoUserEva =  mysqli_query($db, $sqlinfoUserEva)->fetch_object();

    /* /VALIDACION DEL PERIODO */
    for ($i = 0; $i < $resp; $i++) {
        # code..
        $idpregunta  = $_POST['objtUseR']['respuestas'][$i]['idPreguntra'];
        $idrespuesta = $_POST['objtUseR']['respuestas'][$i]['respuesta'];
        $idBloque = $_POST['objtUseR']['respuestas'][$i]['idbloque'];

        /* INSERSION DE LAS RESPUESTAS DEL AL EVALUACION  */
        $sql = "INSERT INTO `evaluacionusario` (`idevaluacion`, `idusuario`, `idbloque`, `idpregunta`, `idponderacion`, `periodo`, `idstatus`, `fecharesolucion`) 
            VALUES(NULL,{$idUser},{$idBloque}, {$idpregunta}, {$idrespuesta}, {$periodo}, 1,CURDATE());";
        $puesto = mysqli_query($db, $sql);
    }

    /* VALIDACION DE CALIFICACION PARA ENFERMERAS */
    $califAnecdotario = $_POST['objtUseR']["califAnecdotario"];
    $existAnecdotario = $_POST['objtUseR']["existAnecdotario"];

    if ($existAnecdotario == 1) {

        $calf1 = (($totalPuntosG * 0.4) / $maxPuntosG) * 10;
        $calf2 = $califAnecdotario;

        $calificacion = ($calf1 + $calf2);

        if ($calificacion >= 10) {
            $calificacionOficial = 10;
            $calificacionOficialAjuste = $calificacionOficial - 1;
            $calificacionOficial =  $calificacionOficialAjuste + $califCapacitacion;
        } else {
            $calificacionOficial = round($calificacion, 2);/* CALCULO A 2 DECIMALES */
            $calificacionOficialAjuste = $calificacionOficial - 1;
            $calificacionOficial =  $calificacionOficialAjuste + $califCapacitacion;
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
            $calificacionOficialAjuste = $calificacionOficial - 1;
            $calificacionOficial =  $calificacionOficialAjuste + $califCapacitacion;
        } else {
            $calificacionOficial = round($calificacion, 2);/* CALCULO A 2 DECIMALES */
            $calificacionOficialAjuste = $calificacionOficial - 1;
            $calificacionOficial =  $calificacionOficialAjuste + $califCapacitacion;
        }

        $year = date('Y');
        /* INSERCION DE CALIFICACION TECNICA PARA REPORTE */
        $sqlcaliftec = "INSERT INTO `califtec360` (`idcaliftec`, `idusario`,`calificaciontec`,`idperiodo`,`date`) 
            VALUES (NULL, {$idUser}, {$califtec}, {$periodo}, {$year});";
        $savecaliftec = mysqli_query($db, $sqlcaliftec);

        for ($j = 0; $j < $respTec; $j++) {
            # code...
            $idPreguntaTec = $_POST['objtUseR']['respuestasTec'][$j]['idPreguntaTecr'];
            $competenciatec = mysqli_real_escape_string($db, $_POST['objtUseR']['respuestasTec'][$j]['competenciatec']);
            $idrespTec = $_POST['objtUseR']['respuestasTec'][$j]['respTec'];

            $sqltec = "INSERT INTO `evaluacionrespusuariotecnica` (`idevaluaciontec`, `idusuario`,`idcopentenciatecnica`, `competencia`, `idponderacion`,`periodo`,`idstatus`,`fecharesolucion`) 
            VALUES (NULL, {$idUser}, {$idPreguntaTec}, '{$competenciatec}', {$idrespTec}, {$periodo}, 1, CURDATE());";
            $evaCompetenicaTecnica = mysqli_query($db, $sqltec);
        }
    }

    $year = date('Y');
    /* VALIDAMOS SI LA CALIFICACION A GUARDAR ES DEL PERIODO 1 O 2  */
    $chekCalifPeriodo = "SELECT * FROM `calificacionusuarioperiodo` WHERE `idusuario` = {$idUser} AND idperiodo = {$periodo} AND fecha = {$year};";
    $existcchekCalifPeriodo = mysqli_query($db, $chekCalifPeriodo);
    if ($existcchekCalifPeriodo->num_rows != 1) {
        /* INSERCION DE CALIFICACION TECNICA PARA REPORTE */
        $sqlCalifPeriodo = "INSERT INTO `calificacionusuarioperiodo` (`idcalificacionperiodo`, `idusuario`,`idperiodo`,`calificacionperiodo`,`fecha`) 
        VALUES (NULL, {$idUser},{$periodo}, {$calificacionOficial}, {$year});";
        $savecaliftec = mysqli_query($db, $sqlCalifPeriodo);
    }


    $sqlCalificacionTotal = "UPDATE `usuarios` SET calificacion = {$calificacionOficial} WHERE idusuario = {$idUser};";
    $saveCalif = mysqli_query($db, $sqlCalificacionTotal);

    /* INSERT DE COMPROMISOS */
    $sqlA = "INSERT INTO `compromisos` (
        `idcompromiso` ,
        `idusuario` ,
        `compromiso` ,
        `fechacompromiso` ,
        `fechaCaptura`
        )
        VALUES (NULL , '{$idUser}', '{$compromisos}', CURDATE(), NOW());";
    $comp = mysqli_query($db, $sqlA);



    /* INSERT DEL REQUIERE CAPACITACION */
    $sqlB = "INSERT INTO `requierecapacitacion` (
        `idcapacitacion` ,
        `idusuario` ,
        `nececitacapacitacion` ,
        `fecha`
        )
        VALUES (
        NULL , '{$idUser}', '{$capacitacion}', CURDATE());";
    $capa = mysqli_query($db, $sqlB);

    $request = false;
    if ($saveCalif && $comp && $capa) {
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
