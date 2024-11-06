<?php
include '../../db/db.php';
$db = dataBase::conexion();

date_default_timezone_set('America/Mexico_City');
//$yearActual = 2023;
if ($_POST['funcion'] && $_POST['funcion'] == 'verResultados') {
	/* SE CONSULTA LA VISTA */
	$yearActual = date('Y');
	//$yearActual = 2023;
	$sql = "SELECT
	`us`.`idusuario` AS `idusuario`,
	`us`.`nombreuser` AS `nombreuser`,
	`us`.`appaterno` AS `appaterno`,
	`us`.`apmaterno` AS `apmaterno`,
	`us`.`usuario` AS `usuario`,
	`us`.`noempleado` AS `noempleado`,
	`us`.`password` AS `password`,
	`us`.`rol` AS `rol`,
	`us`.`idstatus` AS `idstatus`,
	`us`.`iddepartamento` AS `iddepartamento`,
	`us`.`idpuesto` AS `idpuesto`,
	`us`.`idjerarquia` AS `idjerarquia`,
	`us`.`idevaluadopor` AS `idevaluadopor`,
	`us`.`idcompromiso` AS `idcompromiso`,
	`us`.`idrequierecapacitacion` AS `idrequierecapacitacion`,
	`us`.`tipoevaluacion` AS `tipoevaluacion`,
	`us`.`autoevalua` AS `autoevalua`,
	`us`.`evalua360` AS `evalua360`,
	`us`.`statusevaluado` AS `statusevaluado`,
	`us`.`calificacion` AS `calificacion`,
	`us`.`fechaalta` AS `fechaalta`,
	`us`.`fecha` AS `fecha`,
	`us`.`anecdotario` AS `anecdotario`,
	`us`.`nombrecompleto` AS `nombrecompleto`,
	`us`.`evaluador` AS `evaluador`,
	`us`.`nombrepuesto` AS `nombrepuesto`,
	`us`.`depnombre` AS `depnombre`,
	`us`.`status` AS `status`,
	`us`.`fechaeva` AS `fechaeva`,
    (SELECT
		`cup`.`calificacionperiodo` 
	FROM
		`calificacionusuarioperiodo` `cup` 
	WHERE
		((
				`cup`.`idusuario` = `us`.`idusuario` 
				) 
		AND ( `cup`.`idperiodo` = 1 )
        AND (`cup`.`fecha` = {$yearActual} )
        ) 
	GROUP BY
		`cup`.`idcalificacionperiodo` 
		LIMIT 1 
		) AS `cp1`,
        (
	SELECT
		`cup`.`calificacionperiodo` 
	FROM
		`calificacionusuarioperiodo` `cup` 
	WHERE
		(
            (`cup`.`idusuario` = `us`.`idusuario`) 
		AND (`cup`.`idperiodo` = 2 )
        AND (`cup`.`fecha` = {$yearActual} )
        ) 
	GROUP BY
		`cup`.`idcalificacionperiodo` DESC 
		LIMIT 1 
	) AS `cp2` 
FROM
	`vw_usuarios` `us`;";
	$usuariosResultados = mysqli_query($db, $sql);

	$objeusersJon = array();
	while ($user = $usuariosResultados->fetch_assoc()) {
		$objeusersJon["data"][] =  $user;
	}
	header('Content-type: application/json; charset=utf-8');
	print $json = json_encode($objeusersJon);
	$archivo = file_put_contents("verResultados.json", $json);
}
