<?php
include 'config/helpers/utils.php';
/* PERSONAL 360 OPERATIVOS */
include '../../db/db.php';
$db = dataBase::conexion();

if (isset($_POST['objtUseR'])) {
    /*  $mensaje2 = "exito"; */
    $idUser = $_POST['objtUseR']["idusuario"];
    $calif360user = $_POST['objtUseR']['calif360user'];
    $totalPuntosTec = $_POST['objtUseR']["totalPuntosTec"];
    $respTec = COUNT($_POST['objtUseR']['respuestasTec']);
    $respTec2 = $_POST['objtUseR']['totalrespTec'];
    $capacitacion = $_POST['objtUseR']['capacitacion'];
    $compromisos = $_POST['objtUseR']['compromisos'];
    $periodo = $_POST['objtUseR']['periodo'];
    $califCap =  $_POST['objtUseR']['califCap'];
    $year = date('Y');

    $sqlinfoUserEva =  "SELECT * FROM usuarios WHERE idusuario =  {$idUser};";
    $infoUserEva =  mysqli_query($db, $sqlinfoUserEva)->fetch_object();

    $maxPuntosTec = $respTec2 * 4;

    /* CALCULO DE CALIFICACION OPARA OPERATIVOS */
    $calf1preliminar = ($totalPuntosTec * 0.5) / $maxPuntosTec;/* calificacion de Competencias Tecnicas */
    $calf2 = ($calif360user * 0.4);/* calificacion de la 360 */

    $calif1 = $calf1preliminar * 10;

    $calificacion = ($calif1 + $calf2);
    /* SE PONDERA LA CALIFICACION SI ES MAYOR A 10 SE QUEDA EN UN 10 ABSOLUTO */
    if ($calificacion >= 10) {
        $calificacionOficial = 10;
        $calificacionOficial =  $calificacionOficial + $califCap;
    } else {
        $calificacionOficial = bcdiv($calificacion, '1', 2);/* CALCULO A 2 DECIMALES */
        $calificacionOficial =  $calificacionOficial + $califCap;
    }

    /* INSERCION DE CALIFICACION TECNICA PARA REPORTE */

    $sqlcheckcaliftec = "SELECT * FROM `califtec360`  WHERE `idusario` = {$idUser} AND `idperiodo` = {$periodo} AND `date` =  {$year};";
    $checkcaliftec = mysqli_query($db, $sqlcheckcaliftec);


    if ($checkcaliftec->num_rows >= 1) {
        /* INSERCION DE CALIFICACION TECNICA PARA REPORTE */
        $sqlupdatecaliftec = "UPDATE `califtec360` SET `calificaciontec` = {$calif1} WHERE `idusario` = {$idUser} AND `idperiodo` = {$periodo} AND `date` =  {$year};";
        $updatecaliftec = mysqli_query($db, $sqlupdatecaliftec);
    } else {
        $sqlcaliftec = "INSERT INTO `califtec360` (`idcaliftec`, `idusario`,`calificaciontec`,`idperiodo`,`date`) 
            VALUES (NULL, {$idUser}, {$calif1}, {$periodo}, {$year});";
        $savecaliftec = mysqli_query($db, $sqlcaliftec);
    }


    /* FIN CALCULO DE CALIFICACION OPARA OPERATIVOS */
    for ($i = 0; $i < $respTec; $i++) {
        # code...
        $idPreguntaTec = $_POST['objtUseR']['respuestasTec'][$i]['idPreguntaTecr'];
        $competenciatec = mysqli_real_escape_string($db, $_POST['objtUseR']['respuestasTec'][$i]['competenciatec']);
        $idrespTec = $_POST['objtUseR']['respuestasTec'][$i]['respTec'];

        $sql = "INSERT INTO `evaluacionrespusuariotecnica` (`idevaluaciontec`, `idusuario`,`idcopentenciatecnica`, `competencia`, `idponderacion`,`periodo`,`idstatus`,`fecharesolucion`) 
        VALUES (NULL, {$idUser}, {$idPreguntaTec}, '{$competenciatec}', {$idrespTec}, {$periodo}, 1, CURDATE());";
        $evaCompetenicaTecnica = mysqli_query($db, $sql);
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
    $updateCalif = mysqli_query($db, $sqlCalificacionTotal);

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
    if ($updateCalif && $comp && $capa) {
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
