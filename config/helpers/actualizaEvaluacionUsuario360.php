<?php
        $db = mysqli_connect('localhost', 'root', 'DesWeb15', 'evapersonal22');
        
if (isset($_POST['objtUseR'])) {
   /*  $mensaje2 = "exito"; */
    $idUser = $_POST['objtUseR']["idusuario"];
    $calif360user = $_POST['objtUseR']['calif360user'];
    $totalPuntosTec = $_POST['objtUseR']["totalPuntosTec"];
    $respTec = $_POST['objtUseR']['totalrespTec'];
    $capacitacion = $_POST['objtUseR']['capacitacion'];
    $compromisos = $_POST['objtUseR']['compromisos'];
    $periodo = $_POST['objtUseR']['periodo'];


    $califpreliminarTec = $_POST['objtUseR']['califpreliminarTec'];
    $calificacionUser = $_POST['objtUseR']['calificacionUser'];
    $califtec360 = $_POST['objtUseR']['califtec360'];

    $chekCaliftec360 = "SELECT * FROM `califtec360` WHERE `idusario` = {$idUser};";
    $existchekCaliftec360 = mysqli_query($db,$chekCaliftec360);

            if ($existchekCaliftec360->num_rows == 1) {

                $sqlcaliftec = "UPDATE `califtec360` SET `calificaciontec` = {$califtec360} WHERE `idusario` = {$idUser};";
                $savecaliftec = mysqli_query($db,$sqlcaliftec);
            }else{
            /* INSERCION DE CALIFICACION TECNICA PARA REPORTE */
            $sqlcaliftec = "INSERT INTO `califtec360` (`idcaliftec`, `idusario`,`calificaciontec`,`idperiodo`,`date`) 
            VALUES (NULL, {$idUser}, {$califtec360}, {$periodo}, {$year});";
            $savecaliftec = mysqli_query($db,$sqlcaliftec);
        }
    /* FIN CALCULO DE CALIFICACION OPARA OPERATIVOS */

    for ($i=0; $i <$respTec ; $i++) { 
        # code..
        $idPreguntaTec = $_POST['objtUseR']['respuestasTec'][$i]['idPreguntaTecr'];
        $idrespTec = $_POST['objtUseR']['respuestasTec'][$i]['respTec'];
                
        /* ACTUALIZACION DE LAS RESPUESTAS DEL AL EVALUACION  */
        $sql = "UPDATE `evaluacionrespusuariotecnica` SET idponderacion = {$idrespTec} WHERE idusuario = {$idUser} AND idcopentenciatecnica = {$idPreguntaTec} AND periodo= {$periodo};";
        $puesto = mysqli_query($db,$sql);
    }

    $sqlCalificacionTotal = "UPDATE `usuarios` SET calificacion = {$calificacionUser} WHERE idusuario = {$idUser};";
    $updateCalif = mysqli_query($db,$sqlCalificacionTotal);
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
    if ($puesto && $comp && $capa) {
        $request = true;
        $sqluser = "UPDATE `usuarios` SET statusevaluado = 1 WHERE idusuario = {$idUser};";
            $actualizaStatusevaluado = mysqli_query($db, $sqluser);
            $request2 = false;
            if ($actualizaStatusevaluado) {
                $request2 = true;
                $_SESSION['evaluacion'] = 'evaluacionSave';
                echo '<script>
                window.location.replace("'. baseUrl .'?controller=evausuario&action=index");
                </script>';
            }else {
                $_SESSION['evaluacion'] = "evaluacionError";
                echo '<script>
                window.location.replace("'. baseUrl .'?controller=evausuario&action=index");
                </script>'; 
            }
        
    }else{
        $mensaje2 .= "REGRISTRO FALLIDO";
        $_SESSION['evaluacion'] = 'evaluacionError';
        echo '<script>
        window.location.replace("?controller=evausuario&action=index");
        </script>';
    }
}else{
    $mensaje2 .= "No Se Guardo Correctamente la Evaluaion";
    $_SESSION['evaluacion'] = 'evaluacionError';
    echo '<script>
    window.location.replace("?controller=evausuario&action=index");
    </script>';
}


    $mensaje2 .= "REGRISTRO EXITOSO";
    print_r($mensaje2);
?>