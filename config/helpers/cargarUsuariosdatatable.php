<?php

include '../../db/db.php';
$db = dataBase::conexion();

if ($_POST['funcion'] && $_POST['funcion'] == 'verUsuarios') {
    //$db = mysqli_connect('localhost', 'root', 'DesWeb15', 'evapersonal22');
    /* SE CONSULTA LA VISTA */
    $sql = "SELECT * FROM `vw_usuarios`;";
    $usuarios = mysqli_query($db, $sql);

    $objeusersJon = array();
    while ($user = $usuarios->fetch_assoc()) {
        $objeusersJon["data"][] =  $user;
    }

    print $json = json_encode($objeusersJon);
    $archivo = file_put_contents("datatableUsers.json", $json);
    # Solo se Guardara la imagen si Existe el Fichero "uploads/imgProducts" y sea de tipo imagens
}


/* CONTROLADOR CUANDO LA SOLICITUD ES EDIT */
if ($_POST['funcion'] && $_POST['funcion'] == 'editar') {
    //$db = mysqli_connect('localhost', 'root', 'DesWeb15', 'evapersonal22');

    /* OBTENEMOS LOS DATOS DEL AJAX PARA EDITARLOS  6602*/
    $editid = $_POST['editid'];
    $noEmpleado = $_POST['noEmpleado'];
    $editname =  strtoupper($_POST['editname']);
    $editapPatertno =  strtoupper($_POST['editapPatertno']);
    $editapMaterno =  strtoupper($_POST['editapMaterno']);
    $editdepa = $_POST['editdepa'];
    $editpuestoUser = $_POST['editpuestoUser'];
    $editjerarquico = $_POST['editjerarquico'];

    /* NOEMPLEADO DEL EVALUADOR ASIGNADO */
    if ($_POST['editEvluador'] == '' && $_POST['editevluadorOpcional'] == '') {
        $idevaluadopor = 20051;
    } else {
        if ($_POST['editEvluador'] == '' && $_POST['editevluadorOpcional'] != '') {
            $idevaluadopor = $_POST['editevluadorOpcional'];
        } else
            $idevaluadopor = $_POST['editEvluador'];
    }

    $edittipoEva = $_POST['edittipoEva'];
    $editpersEva = $_POST['editpersEva'];
    $editevalua360 = $_POST['editevalua360'];
    $idstatus = $_POST['idstatus'];


    /* ACTUALIZAMOS LE HISTORICO DEL EMPLEADO */
    $sqluser = "SELECT * FROM `usuarios` WHERE `idusuario` = {$editid};";
    $usuarioHistorico = mysqli_query($db, $sqluser);
    $historicoUser = $usuarioHistorico->fetch_object();

    /* CONSULTA DEL PERIODO ACTIVO PARA EL HISTORICO */
    $sqlPeriodo = "SELECT * FROM `periodo` WHERE `status`= 1;";
    $periodoActivo = mysqli_query($db, $sqlPeriodo);
    $periodo = $periodoActivo->fetch_object();

    $fecha = date('Y');

    $sqlhistorico = "INSERT INTO `historicoempleado` 
        (`idhistorico`,`idusuario`,`iddepartamento`,`idpuesto`,`idjerarquia`,`idevaluadopor`,`tipoevaluacion`,`autoevalua`,`evalua360`,`estatusevaluado`,`calificacion`,`anecdotario`,`periodo`,`fecha`) 
        VALUES 
        (NULL, {$historicoUser->idusuario},{$historicoUser->iddepartamento},{$historicoUser->idpuesto},{$historicoUser->idjerarquia},{$historicoUser->idevaluadopor},'{$historicoUser->tipoevaluacion}',{$historicoUser->autoevalua},'{$historicoUser->evalua360}',{$historicoUser->estatusevaluado},{$historicoUser->calificacion},'{$historicoUser->anecdotario}',{$periodo->idperiodo},{$fecha});";
    $historicoUserActual =  mysqli_query($db, $sqlhistorico);

    /* ARMAMOS LA CONSULTA DE ACTUALIZACION DE LOS DATOS DEL PACIENTE  */
    $sqlEdit = "UPDATE `usuarios` SET `noempleado` = {$noEmpleado}, nombreuser = '{$editname}', appaterno = '{$editapPatertno}', apmaterno = '{$editapMaterno}', usuario = '{$editapPatertno}{$noEmpleado}', `idstatus` = {$idstatus}, `iddepartamento` = {$editdepa}, `idpuesto` = {$editpuestoUser}, `idjerarquia` = {$editjerarquico}, `idevaluadopor` = {$idevaluadopor}, `tipoevaluacion` = '{$edittipoEva}', `autoevalua` = {$editpersEva}, `evalua360` = '{$editevalua360}' WHERE `idusuario` = {$editid}";
    $usuariosUpdate = mysqli_query($db, $sqlEdit);
    //echo $response = ("Error description: " . mysqli_error($db));
    $response =  "okeditUser";
    echo $response;
    mysqli_close($db);
}
