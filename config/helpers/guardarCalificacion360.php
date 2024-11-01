<?php

include '../../db/db.php';
$db = dataBase::conexion();

if (isset($_POST['objtUseR'])) {


    $idusuario = $_POST['objtUseR']['idusuario'];
    $calificacion360 = $_POST['objtUseR']['calificacion360'];
    $idperiodo = $_POST['objtUseR']['idperiodoActivo'];
    $fecha = $_POST['objtUseR']['fecha'];



    /* INSERSION DE LA CALIFICACION 360 */
    $sqlcheckcalificacion360 = "SELECT * FROM `calificacion360` WHERE idusuario = {$idusuario}  AND `idperiodo` = {$idperiodo} AND `fecha` = {$fecha};";
    $checkcalificacion360 = mysqli_query($db, $sqlcheckcalificacion360);

    if ($checkcalificacion360->num_rows <= 0) {
        $insertsqlusers360 = "INSERT INTO `calificacion360` (`idcalificacion360`,`idusuario`, `calificacion`,`idstatus`, `idperiodo`, `fecha`) VALUES (NULL, {$idusuario}, {$calificacion360}, 1, {$idperiodo}, {$fecha});";
        $updateCalif360 = mysqli_query($db, $insertsqlusers360);
    } else {
        $sqlupdatecalif360 = "UPDATE  `calificacion360` SET `calificacion` = {$calificacion360}, `idstatus` = '1' WHERE `idusuario` = {$idusuario}  AND `idperiodo`= {$idperiodo} AND `fecha`= {$fecha};";
        $updateCalif360 = mysqli_query($db, $sqlupdatecalif360);
    }

    /* OBTENCION DE CALIFICACION TECNICA DE LOS USUARIOS 360 */
    $sqlgetcalifTec = "SELECT * FROM `califtec360` WHERE `idusario` = {$idusuario} AND `idperiodo` = {$idperiodo} AND `date` =  {$fecha};";
    $getcalifTec  = mysqli_query($db, $sqlgetcalifTec);
    $getcalifTec =  $getcalifTec->fetch_object()->calificaciontec;


    $sqlinfoUser360 = "SELECT * FROM `usuarios` WHERE idusuario={$idusuario};";
    $infoUser360 = mysqli_query($db, $sqlinfoUser360);
    $usuario = $infoUser360->fetch_object();


    /* EMPATE DE CALIFICACIONES 360  */

    /* CUESTIONARIO A COORDINADORES 360 SOLO SE CALIFICA [COMPETENCIAS TECNICAS]*/
    if ($usuario->tipoevaluacion == 'DIRECTIVO' && $usuario->autoevalua == 2 &&  $usuario->evalua360 == 'SI') {
        $calificacion360 = ($calificacion360 * 0.6);
        $calificaionOficial = ($calificacion360 + $getcalifTec);

        /* INSERTAMOS LA CALIFICACION EN LA TABLA DE USUARIOS  */
        $sqlusariocalificacion = "UPDATE usuarios SET calificacion = {$calificaionOficial} WHERE idusuario = {$idusuario};";
        $calificacionUsuario360 = mysqli_query($db, $sqlusariocalificacion);

        /* ACTUALIZAMOS LA calificacionusuarioperiodo POR EL IDUSUARIO Y VALIDAMOS SI EXISTE Y SI NO SE CREA */

        $sqlcheckcalifperiodo = "SELECT * FROM `calificacionusuarioperiodo` WHERE `idusuario` = {$idusuario} AND `idperiodo` = {$idperiodo} AND `fecha` = {$fecha} ;";
        $checkcalifperiodo = mysqli_query($db, $sqlcheckcalifperiodo);

        if ($checkcalificacion360->num_rows <= 0) {

            $sqlinsertcalifperiodo = "INSERT INTO `calificacionusuarioperiodo` (`idcalificacionperiodo`, `idusuario`, `idperiodo`, `calificacionperiodo`, `date`) 
            VALUES (NULL, {$idusuario}, 1, {$calificaionOficial}, {fecha});";
        } else {
            $sqlUpdateCalificacionPeriodo = $sql = "UPDATE `calificacionusuarioperiodo` SET `calificacionperiodo` = {$calificaionOficial} WHERE `idusuario` = {$idusuario} AND `idperiodo` = {$idperiodo} AND `fecha` = {$fecha} ;";
            $UpdateCalificacionPeriodo = mysqli_query($db, $sqlUpdateCalificacionPeriodo);
        }
    }

    /* OPERATIVA 360 */
    if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 2 &&  $usuario->evalua360 == 'SI') {
        $calificacion360 = ($calificacion360 * 0.4);
        $calificaionOficial = ($calificacion360 + $getcalifTec);

        /* INSERTAMOS LA CALIFICACION EN LA TABLA DE USUARIOS  */
        $sqlusariocalificacion = "UPDATE usuarios SET calificacion = {$calificaionOficial} WHERE idusuario = {$idusuario};";
        $calificacionUsuario360 = mysqli_query($db, $sqlusariocalificacion);

        /* ACTUALIZAMOS LA calificacionusuarioperiodo POR EL IDUSUARIO Y VALIDAMOS SI EXISTE Y SI NO SE CREA */

        $sqlcheckcalifperiodo = "SELECT * FROM `calificacionusuarioperiodo` WHERE `idusuario` = {$idusuario} AND `idperiodo` = {$idperiodo} AND `fecha` = {$fecha} ;";
        $checkcalifperiodo = mysqli_query($db, $sqlcheckcalifperiodo);

        if ($checkcalificacion360->num_rows <= 0) {

            $sqlinsertcalifperiodo = "INSERT INTO `calificacionusuarioperiodo` (`idcalificacionperiodo`, `idusuario`, `idperiodo`, `calificacionperiodo`, `date`) 
            VALUES (NULL, {$idusuario}, 1, {$calificaionOficial}, {fecha});";
        } else {
            $sqlUpdateCalificacionPeriodo = $sql = "UPDATE `calificacionusuarioperiodo` SET `calificacionperiodo` = {$calificaionOficial} WHERE `idusuario` = {$idusuario} AND `idperiodo` = {$idperiodo} AND `fecha` = {$fecha} ;";
            $UpdateCalificacionPeriodo = mysqli_query($db, $sqlUpdateCalificacionPeriodo);
        }
    }
    /* CUESTIONARIO A SUPERVISORES [AUTOEVALUACION]*/
    if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 1 &&  $usuario->evalua360 == 'SI') {
        $calificacion360 = ($calificacion360 * 0.6);
        $calificaionOficial = ($calificacion360 + $getcalifTec);

        /* INSERTAMOS LA CALIFICACION EN LA TABLA DE USUARIOS  */
        $sqlusariocalificacion = "UPDATE usuarios SET calificacion = {$calificaionOficial} WHERE idusuario = {$idusuario};";
        $calificacionUsuario360 = mysqli_query($db, $sqlusariocalificacion);

        /* ACTUALIZAMOS LA calificacionusuarioperiodo POR EL IDUSUARIO Y VALIDAMOS SI EXISTE Y SI NO SE CREA */

        $sqlcheckcalifperiodo = "SELECT * FROM `calificacionusuarioperiodo` WHERE `idusuario` = {$idusuario} AND `idperiodo` = {$idperiodo} AND `fecha` = {$fecha} ;";
        $checkcalifperiodo = mysqli_query($db, $sqlcheckcalifperiodo);

        if ($checkcalificacion360->num_rows <= 0) {

            $sqlinsertcalifperiodo = "INSERT INTO `calificacionusuarioperiodo` (`idcalificacionperiodo`, `idusuario`, `idperiodo`, `calificacionperiodo`, `date`) 
            VALUES (NULL, {$idusuario}, 1, {$calificaionOficial}, {fecha});";
        } else {
            $sqlUpdateCalificacionPeriodo = $sql = "UPDATE `calificacionusuarioperiodo` SET `calificacionperiodo` = {$calificaionOficial} WHERE `idusuario` = {$idusuario} AND `idperiodo` = {$idperiodo} AND `fecha` = {$fecha} ;";
            $UpdateCalificacionPeriodo = mysqli_query($db, $sqlUpdateCalificacionPeriodo);
        }
    }

    $request = false;

    if ($updateCalif360) {
        $request = true;
        $mensaje2 .= "REGRISTRO EXITOSO";
        $_SESSION['saveCalif360'] = 'saveCalif360';
        echo '<script>
                window.location.replace("' . baseUrl . '?controller=evausuario&action=index");
                </script>';
    } else {
        $request = false;
        $mensaje2 .= "REGRISTRO FALLIDO";
        $_SESSION['evaluacion'] = "evaluacionError";
        echo '<script>
                window.location.replace("' . baseUrl . '?controller=evausuario&action=index");
                </script>';
    }
    $mensaje2 .= "REGRISTRO EXITOSO";
    print_r($mensaje2);
}
