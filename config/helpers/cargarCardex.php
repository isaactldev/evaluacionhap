<?php

if ($_POST['funcion'] && $_POST['funcion'] == 'verCardex') {
	$db = mysqli_connect('localhost', 'root', 'DesWeb15', 'evapersonal22');

	$fechaCardex = $_POST['fechaCardex'];
	/* SE CONSULTA LA VISTA */
	$sql = "SELECT
	`us`.`idusuario` AS `idusuario`,
	`us`.`noempleado` AS `noempleado`,
	`us`.`nombreuser` AS `nombreuser`,
	`us`.`appaterno` AS `appaterno`,
	`us`.`apmaterno` AS `apmaterno`,
	`us`.`idevaluadopor` AS `idevaluadopor`,
	`us`.`tipoevaluacion` AS `tipoevaluacion`,
	`us`.`autoevalua` AS `autoevalua`,
	`us`.`evalua360` AS `evalua360`,
	`us`.`statusevaluado` AS `statusevaluado`,
	`us`.`anecdotario` AS `anecdotario`,
	`us`.`nombrecompleto` AS `nombrecompleto`,
	`us`.`evaluador` AS `evaluador`,
	`us`.`nombrepuesto` AS `nombrepuesto`,
	`us`.`idpuesto` AS `idpuesto`,
	`us`.`depnombre` AS `depnombre`,
	`us`.`iddepartamento` AS `iddepartamento`,
	`us`.`idjerarquia` AS `idjerarquia`,
	`us`.`status` AS `status`,
	`us`.`FECHAEVA` AS `FECHAEVA`,
    ( SELECT `cup`.`calificacionperiodo` FROM `calificacionusuarioperiodo` `cup` WHERE ((`cup`.`fecha` = {$fechaCardex}) AND ( `cup`.`idusuario` = `us`.`idusuario`) AND ( `cup`.`idperiodo` = 1 )) GROUP BY `cup`.`idcalificacionperiodo` DESC LIMIT 1 ) AS `cp1`,
    ( SELECT `cup`.`calificacionperiodo` FROM `calificacionusuarioperiodo` `cup` WHERE ((`cup`.`fecha` = {$fechaCardex}) AND (`cup`.`idusuario` = `us`.`idusuario` ) AND ( `cup`.`idperiodo` = 2 )) GROUP BY `cup`.`idcalificacionperiodo` DESC LIMIT 1 ) AS `cp2` 
    FROM `vw_usuarios` `us`;";
	$usuarios = mysqli_query($db, $sql);


	if (mysqli_num_rows($usuarios) >= 1) {
		$objeusersJon = array();
		while ($user = $usuarios->fetch_assoc()) {
			$objeusersJon["data"][] =  $user;
		}
		print $json = json_encode($objeusersJon);
		$archivo = file_put_contents("datatableUsers.json", $json);
		# Solo se Guardara la imagen si Existe el Fichero "uploads/imgProducts" y sea de tipo imagens
	} else {
		echo "<script>
		var url = location.origin;var path = window.location.pathname;
		Swal.fire({
			icon: 'warning',
			confirmButtonColor: '#213c6d',
			title: 'SIN RESULTADOS EN EL AÑO SELECCIONADO!',
			text: 'No existen registros en el año seleccionado PorFavor selecciona otro año!',
		})
		etTimeout(function() {window.location.href = url + path + ?controller=evaluacion&action=allUsuarioStatusEvaluacion;}, 1150);
		</script>";
	}
}
