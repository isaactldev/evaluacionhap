<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REPORTE DE EVALUACION 360</title>
</head>

<body>
    <?php
    include '../../db/db.php';
    include '../../config/helpers/utils.php';
    include '../../models/usuarios.php';
    include '../../models/bloquecompetencia360.php';
    include '../../models/calificacion360.php';
    include '../../models/cuestionariogeneral360.php';
    include '../../models/evaluacionausuarios360.php';
    include '../../models/personal360.php';
    include '../../models/puestos.php';
    include '../../models/bloques.php';

    $k = 0;
    $b = 0;
    $j = 0;
    $countt = 0;

    if (isset($_GET['noEmpleado360']) && isset($_GET['periodo'])) {
        $noEmpleado360evaluado = $_GET['noEmpleado360'];
        $periodo = $_GET['periodo'];
        $fecha = date('Y');

        if ($periodo == 1) {
            $doer = "er.";
        } else {
            $doer = "do.";
        }

        $host = $_SERVER["HTTP_HOST"];
        $urlactual = "http://" . $host . "/evaluacionhap/";

        $db = mysqli_connect('localhost', 'root', 'DesWeb15', 'evapersonal22');
    }
    ?>

    <style type="text/css">
        * {
            font-family: calibri !important;
            @colPrim: #003970;
            @colAC: #679fd3;
            @colSec: #ddd;
            @colVerde : #03b739;
            @colTer: #494949;
        }

        table {
            border: 0px solid #ddd;
            border-collapse: collapse;
        }


        .tblreport360 {
            background-color: #213c6d !important;
            color: #fff !important;
            font-size: 15px !important;
        }

        .tblreport360campo {
            background-color: #fff !important;
            color: #000 !important;
            border: 0.5px solid #000 !important;
        }

        .tblreport360ecabezadogris {
            background-color: #A6A6A6 !important;
            color: #000 !important;
            border: 0.5px solid #000 !important;

        }

        .tblreport360ecabezadorosa {
            background-color: #FF99CC !important;
            color: #000 !important;
            border: 0.5px solid #000 !important;
        }

        .tblreport360bordebloque {
            border: 1px solid #000 !important;

        }

        .tblreport360calificacionF {
            background-color: #92D050 !important;
            color: #000 !important;
            font-size: 20px !important;
        }

        .tblreport360resumengrafico {
            background-color: #FFE699 !important;
            color: #000 !important;
            border: 0.5px solid #000 !important;
        }

        .tblreport360mejoroportunidad {
            background-color: #92D050 !important;
            color: #000 !important;
            border: 0.5px solid #000 !important;
        }

        .tblreport360oportunidadmejora {
            background-color: #FFFF00 !important;
            color: #000 !important;
            border: 0.5px solid #000 !important;
        }

        .pintartitulo {
            border-top: 1px solid #e9ebee;
            border-right: 1px solid #e9ebee;
            border-left: 1px solid #e9ebee;
            background-color: #e9ebee;
            -webkit-print-color-adjust: exact;
            font-size: 14px !important
        }

        .tableHap {
            background-color: #CEDEDD !important;
            color: #213c6d !important;
            padding: 5px !important;
            margin: 5px !important;
            -webkit-print-color-adjust: exact;
        }

        th {
            padding: 5px !important;
            /* margin: 2px !important; */

        }

        td {
            border: 1px solid #ddd;
            padding: 2px !important;
            margin: 2px !important;
        }

        .txt {
            font-size: 14px;
        }

        .txt2 {
            font-size: 14px;
            padding-left: 10px;
            color: #213c6d;
            padding-top: 15px;
            display: block;
        }

        .line {
            border-bottom: 1px solid #213c6d;
        }

        .titulo {
            font-family: calibri;
            font-size: 14px;
            padding: 10px;
            text-align: right;
        }

        .resaltar {
            color: #003970;
            font-weight: bolder;
        }

        .mitabla thead tr td {
            padding: 10px;
            /* color: #fff; */
        }

        .txtBlack {
            color: #000
        }

        .pagebreak {
            clear: both;
            page-break-after: always;
        }


        .clear {
            clear: both;
        }

        .separartabla {
            margin-top: 50px;
        }

        .bt {
            border-top: 1px solid #ddd;
        }

        .bb {
            border-bottom: 1px solid #ddd;
        }

        .br {
            border-right: 1px solid #ddd;
        }

        .bl {
            border-left: 1px solid #ddd;
        }

        @media print {

            body {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>


    <!-- ENCABEZADO -->
    <table width="800" cellpadding="0" cellspacing="0" class="mitabla">
        <thead>
            <tr>
                <th width="150px">
                    <img src="<?= $urlactual ?>assets/img/HAPR.png" width="120px">
                    </td>
                <th width="400px" class="titulo" style="border-right:1px solid #003970;">
                    <span class="txtBlack">Administración del</span> <span class="resaltar">Hospital Aranda de la Parra</span><br>
                    <span class="resaltar">Hidalgo N°329 Tel. 719-71-00 León, Gto.</span><br>
                    <span class="resaltar"><small> CDO-FOR-002 | VERSION:002 | Revisión: 22/01/2024</small></span>
                </th>
                <th width="200px" class="titulo">
                    <b class="resaltar"><small><strong>RESULTADO EVALUACIÓN 360°</strong><br><?= $periodo ?><?= $doer ?> PERIODO <?= $fecha ?></small></b><br>
                    <?php
                    setlocale(LC_TIME, "spanish");
                    $fechareport = strftime("%A, %d de %B de %Y");
                    ?>
                    <span class="resaltar"><?= utf8_encode($fechareport) ?></span>
                </th>
            </tr>
            <tr>
                <th width="775px" colspan="4" style="border-top:1px solid #003970;">
                    <?php $year = date('Y'); ?>
                    <center> <span class="resaltar tituloformato"> RESULTADO EVALUACIÓN 360° <?= $fecha ?></span> </center>
                </th>
            </tr>
        </thead>
    </table>
    <!-- ENCABEZADOEND -->



    <!-- CONTENIDO DEL REPORTE -->
    <table width="800" cellpadding="0" cellspacing="0" class="mitabla" style="margin-top: 5px;">
        <?php
        $sqluserinfo360 = "SELECT CONCAT(user360.nombreuser,' ', user360.appaterno,' ', user360.apmaterno) AS nombrecompleto360, ps.nombrepuesto AS puesto360 FROM usuarios user360 INNER JOIN puestos ps ON user360.idpuesto = ps.idpuesto WHERE user360.noempleado = {$noEmpleado360evaluado};";

        $userinfo360 = mysqli_query($db, $sqluserinfo360);

        $userinfo360 = $userinfo360->fetch_object();
        ?>
        <thead id="tableHap" class="table-hap">
            <tr class="tableHap">
                <th class="tblreport360" style="font-size: 12px;">NOMBRE</th>
                <th colspan="6" class="tblreport360campo" style="font-size: 12px;"><?= $userinfo360->nombrecompleto360 ?></th>
            </tr>
            <tr class="tableHap">
                <th class="tblreport360" style="font-size: 12px;">PUESTO</th>
                <th colspan="6" class="tblreport360campo" style="font-size: 12px;"><?= $userinfo360->puesto360 ?></th>
            </tr>
        </thead>
    </table>



    <!-- CONTENIDO DEL REPORTE -->
    <table width="800" cellpadding="0" cellspacing="0" class="mitabla" style="margin-top: 5px;">

        <thead>
            <tr>
                <th scope="col" class="tblreport360ecabezadogris" style="font-size: 12px !important;">TEMA</th>
                <th scope="col" class="tblreport360ecabezadogris" style="font-size: 12px !important;">COMPETENCIA</th>
                <th scope="col" class="tblreport360ecabezadogris" style="font-size: 12px !important;">CALIFICACIÓN</th>
            </tr>
        </thead>

        <tbody>

            <!-- CONSULTA -->
            <?php
            $sqlbloques360 = "SELECT * FROM `bloquecompetencia360`;";
            $bloques360 = mysqli_query($db, $sqlbloques360);
            $califFinalPromedio = 0;

            $arrayV = [];
            $minbloquearray = [];
            $maxbloquearray = [];
            ?>

            <?php while ($bloque360 = $bloques360->fetch_object()) : ?>

                <tr class="tblreport360bordebloque">

                    <?php
                    $sqlPreguntasBloque360 = "SELECT COUNT(`idcuestionarioeva360`) AS totalPreguntasBloque FROM `cuestionariogen360` WHERE `idbloque360` = {$bloque360->idbloqueCompeGen360};";
                    $totalPreguntasBloque360 = mysqli_query($db, $sqlPreguntasBloque360);

                    $totalPreguntasBloque3602 = $totalPreguntasBloque360->fetch_object()->totalPreguntasBloque;
                    $rowspan = $totalPreguntasBloque3602 + 1;
                    ?>
                    <td rowspan="<?= $rowspan ?>" class="tblreport360bordebloque" style="background-color: #E7E6E6; ">
                        <center><strong><?= $bloque360->namebloque360 ?></strong></center>
                    </td>
                </tr>

                <?php

                $sqlPreguntas = "SELECT * FROM `cuestionariogen360` WHERE `idbloque360` = {$bloque360->idbloqueCompeGen360};";
                $allPreguntas = mysqli_query($db, $sqlPreguntas);

                $sqlcountPreguntasBloque = "SELECT COUNT(idcuestionarioeva360) AS totalPreguntasBloque FROM `cuestionariogen360` WHERE `idbloque360` = {$bloque360->idbloqueCompeGen360};";
                $totalPreguntasBloque360 = mysqli_query($db, $sqlcountPreguntasBloque);
                $totalPreguntasxBloque = $totalPreguntasBloque360->fetch_object()->totalPreguntasBloque;

                ?>
                <?php $califFinalPromedioPromedioXbloque = 0; ?>
                <?php while ($pregunta = $allPreguntas->fetch_object()) : ?>


                    <tr class="tblreport360bordebloque">
                        <td class="tblreport360bordebloque" style="font-size: 15px !important;"><?= $pregunta->pregunta360 ?></td>
                        <td class="tblreport360bordebloque" style="font-size: 15px !important;">

                            <?php

                            /* CALCULO DE CALIFICACION PROMEDIADA POR PREGUNTA, POR COLABORADOR EVALUADOR, POR BLOQUE*/
                            $sqlpromediosxPregunta = "SELECT SUM(`ponderacion`) AS sumPuntos, COUNT(`ponderacion`) AS countPuntos FROM `evaluacionausuarios360` WHERE `noempleadoEvaluado` = {$noEmpleado360evaluado} AND noempleadoEvaluador <> {$noEmpleado360evaluado} AND `idcuestionarioeva360` = {$pregunta->idcuestionarioeva360} AND `periodo`= {$periodo} AND `fecha` = {$fecha};";
                            $promediosxPregunta = mysqli_query($db, $sqlpromediosxPregunta);
                            $promediosxPreguntaF = $promediosxPregunta->fetch_object();

                            $promedioPorPregunta = ($promediosxPreguntaF->sumPuntos / $promediosxPreguntaF->countPuntos);
                            $califFinalPromedio = $califFinalPromedio + $promedioPorPregunta;

                            $califFinalPromedioPromedioXbloque = $califFinalPromedioPromedioXbloque + $promedioPorPregunta;
                            $promedioPorPregunta = round($promedioPorPregunta, 2);
                            ?>
                            <center><strong><?= $promedioPorPregunta ?></strong></center>


                        </td>
                    </tr>


                <?php endwhile; ?>
                <tr>
                    <?php
                    $califBloque360prom = ($califFinalPromedioPromedioXbloque / $totalPreguntasxBloque);
                    $califBloque360prom = round($califBloque360prom, 2);
                    ?>
                    <td colspan="2" class="tblreport360">
                        <center><strong>TOTAL</strong></center>
                    </td>
                    <td class="tblreport360">
                        <center><strong><?= $califBloque360prom ?></strong></center>
                    </td>
                </tr>
                <?php

                $arrayV[$bloque360->idbloqueCompeGen360] = [
                    'namebloque360' => $bloque360->namebloque360,
                    'califminBloque' => $califBloque360prom,
                ];
                array_push($minbloquearray, $califBloque360prom);
                array_push($maxbloquearray, $califBloque360prom);
                ?>

            <?php endwhile; ?>

            <?php
            $calificacion360Oficial = ($califFinalPromedio / 27);
            $calificacion360Oficial = round($calificacion360Oficial, 2);

            $califmin = min($minbloquearray);
            $califmax = max($minbloquearray);

            for ($i = 1; $i <= count($arrayV); $i++) {
                # code...

                if ($arrayV[$i]['califminBloque'] <= $califmin) {
                    $califmin = $arrayV[$i]['califminBloque'];
                    $competenciasMayorOportunidad = $arrayV[$i]['namebloque360'] . "<br>";
                }

                if ($arrayV[$i]['califminBloque'] >= $califmax) {
                    $califmax = $arrayV[$i]['califminBloque'];
                    $competenciasMejorEvaluada = $arrayV[$i]['namebloque360'] . "<br>";
                }
            }

            ?>
            <tr>
                <td colspan="2" style="font-size: 18px !important;">
                    <center><strong>TOTAL GENERAL</strong></center>
                </td>
                <td class="tblreport360calificacionF">
                    <center><strong><?= $calificacion360Oficial ?></strong></center>
                </td>
            </tr>
        </tbody>
    </table>



    <div class="pagebreak"></div>


    <!-- ENCABEZADO -->
    <table width="800" cellpadding="0" cellspacing="0" class="mitabla">
        <thead>
            <tr>
                <th width="150px">
                    <img src="<?= $urlactual ?>assets/img/HAPR.png" width="120px">
                    </td>
                <th width="400px" class="titulo" style="border-right:1px solid #003970;">
                    <span class="txtBlack">Administración del</span> <span class="resaltar">Hospital Aranda de la Parra</span><br>
                    <span class="resaltar">Hidalgo N°329 Tel. 719-71-00 León, Gto.</span><br>
                    <span class="resaltar"><small> CDO-FOR-002 | VERSION:002 | Revisión: 16/07/2021</small></span>
                </th>
                <th width="200px" class="titulo">
                    <b class="resaltar"><small><strong>RESULTADO EVALUACIÓN 360°</strong><br><?= $periodo ?><?= $doer ?> PERIODO <?= $fecha ?></small></b><br>
                    <?php
                    setlocale(LC_TIME, "spanish");
                    $fechareport = strftime("%A, %d de %B de %Y");
                    ?>
                    <span class="resaltar"><?= utf8_encode($fechareport); ?></span>
                </th>
            </tr>
            <tr>
                <th width="775px" colspan="4" style="border-top:1px solid #003970;">
                    <?php $year = date('Y'); ?>
                    <center> <span class="resaltar tituloformato"> RESULTADO EVALUACIÓN 360° <?= $fecha ?></span> </center>
                </th>
            </tr>
        </thead>
    </table>
    <!-- ENCABEZADOEND -->



    <!-- CONTENIDO DEL REPORTE -->
    <table width="800" cellpadding="0" cellspacing="0" class="mitabla" style="margin-top: 5px;">

        <thead id="tableHap" class="table-hap">
            <tr class="tableHap">
                <th class="tblreport360" style="font-size: 12px;">NOMBRE</th>
                <th colspan="6" class="tblreport360campo" style="font-size: 12px;"><?= $userinfo360->nombrecompleto360 ?></th>
            </tr>
            <tr class="tableHap">
                <th class="tblreport360" style="font-size: 12px;">PUESTO</th>
                <th colspan="6" class="tblreport360campo" style="font-size: 12px;"><?= $userinfo360->puesto360 ?></th>
            </tr>
        </thead>
    </table>



    <center>
        <p style="font-size: 15px;"><strong>2. ANÁLISIS DE EVALUACIÓN<strong></p>
    </center>
    <center>
        <div>
            <!-- GRAFICO DE RADAR -->

            <canvas id="myChart" width="475" height="475"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        </div>
    </center>

    <center>
        <table width="800" cellpadding="0" cellspacing="0" class="mitabla" style="margin-top: 1px;">
            <thead>
                <tr>
                    <th colspan="9" class="tblreport360resumengrafico" style="font-size: 12px;">RESUMEN GRÁFICO</th>
                </tr>
                <tr class="tblreport360ecabezadogris">
                    <th></th>
                    <th class="tblreport360ecabezadogris" style="font-size: 10px;">Recursos Expresivos</th>
                    <th class="tblreport360ecabezadogris" style="font-size: 10px;">Sociales y de interacción</th>
                    <th class="tblreport360ecabezadogris" style="font-size: 10px;">Administrativas </th>
                    <th class="tblreport360ecabezadogris" style="font-size: 10px;">Productividad</th>
                    <th class="tblreport360ecabezadogris" style="font-size: 10px;">Desarrollo de Equipo</th>
                    <th class="tblreport360ecabezadogris" style="font-size: 10px;">Capacidad Resolutiva</th>
                    <th class="tblreport360ecabezadogris" style="font-size: 10px;">Conciencia organizacional</th>
                </tr>

            </thead>
            <tbody>


                <tr>
                    <td class="tblreport360ecabezadogris" style="font-size: 12px;">Autoevaluación</td>
                    <?php
                    $promtotalcolaborador = 0;
                    for ($i = 1; $i <= 7; $i++) {
                        $sqlponderacionAutoEva = "SELECT SUM(everesp.ponderacion) AS `totalProm`, COUNT(everesp.ponderacion) AS `countPonderaciones` FROM `personal360` p360
                                                                        INNER JOIN `evaluacionausuarios360` everesp ON p360.idevaluador = everesp.noempleadoEvaluador
                                                                        WHERE everesp.noempleadoEvaluador = {$noEmpleado360evaluado} AND everesp.noempleadoEvaluado = {$noEmpleado360evaluado} AND everesp.noempleadoEvaluado = {$noEmpleado360evaluado} AND tipoevaluador LIKE  '%AUTOEVALUACION%' AND everesp.idbloqueCompeGen360 = {$i};";
                        $ponderacionAutoEva = mysqli_query($db, $sqlponderacionAutoEva);
                        $totalAutoEva = $ponderacionAutoEva->fetch_object();
                        $califpromtotalAutoEva = $totalAutoEva->totalProm / $totalAutoEva->countPonderaciones;

                        if ($califpromtotalAutoEva == 0) {
                            echo '<td class="tblreport360ecabezadorosa" style="font-size: 12px;"><center> NA </center></td>';
                        } else {
                            echo '<td class="tblreport360ecabezadorosa" style="font-size: 12px;"><center>' . round($califpromtotalAutoEva, 2) . '</center></td>';
                            $valorgrafAutoEva .= $califpromtotalAutoEva . ",";
                        }
                    }
                    ?>
                    <?php
                    $valorgrafAutoEva = substr($valorgrafAutoEva, 0, -1);
                    ?>
                </tr>


                <?php
                /* VALIDACION DE EXISTENCIA DE COLABORADORES */
                $sqlcountColaboradores = "SELECT * FROM personal360 WHERE idevaluado = {$noEmpleado360evaluado} AND tipoevaluador LIKE '%COLABORADOR%' AND periodo = {$periodo};";
                $countColaboradores = mysqli_query($db, $sqlcountColaboradores);
                $numrowsColaboradores = mysqli_num_rows($countColaboradores);

                if ($numrowsColaboradores != 0) {
                ?>
                    <tr>
                        <td class="tblreport360ecabezadogris" style="font-size: 12px;">Colaboradores</td>
                        <?php
                        while ($colaboradores = $countColaboradores->fetch_object()) {
                            $busquedacolaboradores .= $colaboradores->idevaluador . ",";
                        }

                        $valorcolaboradores = substr($busquedacolaboradores, 0, -1);
                        $promtotalcolaborador = 0;
                        for ($i = 1; $i <= 7; $i++) {
                            $sqlponderacionColabor = "SELECT SUM(ponderacion) AS totalProm, COUNT(ponderacion) AS countPonderaciones FROM evaluacionausuarios360
                        WHERE noempleadoEvaluado = {$noEmpleado360evaluado} AND noempleadoEvaluador IN ({$valorcolaboradores})  AND idbloqueCompeGen360 = {$i};";
                            $ponderacionColabor = mysqli_query($db, $sqlponderacionColabor);
                            $totalColaborador = $ponderacionColabor->fetch_object();

                            $califpromColaborador = $totalColaborador->totalProm / $totalColaborador->countPonderaciones;

                            if ($califpromColaborador == 0) {
                                echo '<td class="tblreport360ecabezadorosa" style="font-size: 12px;"><center> NA </center></td>';
                            } else {
                                echo '<td class="tblreport360ecabezadorosa" style="font-size: 12px;"><center>' . round($califpromColaborador, 2) . '</center></td>';
                                $valorgrafColaborador .= $califpromColaborador . ",";
                            }
                        }
                        ?>
                        <?php
                        $valorgrafColaborador = substr($valorgrafColaborador, 0, -1);
                        ?>
                    </tr>
                <?php
                }
                ?>



                <tr>
                    <td class="tblreport360ecabezadogris" style="font-size: 12px;">Colegas</td>
                    <?php

                    $sqlcountColegas = "SELECT * FROM personal360 WHERE idevaluado = {$noEmpleado360evaluado} AND tipoevaluador LIKE '%COLEGA%' AND periodo = {$periodo};";
                    $countColegas = mysqli_query($db, $sqlcountColegas);

                    while ($colega = $countColegas->fetch_object()) {
                        $busquedacolegas .= $colega->idevaluador . ",";
                    }

                    $valorColega = substr($busquedacolegas, 0, -1);
                    $promtotalcolaborador = 0;


                    for ($i = 1; $i <= 7; $i++) {

                        $sqlponderacionColega = "SELECT SUM(ponderacion) AS totalProm, COUNT(ponderacion) AS countPonderaciones FROM evaluacionausuarios360
                        WHERE noempleadoEvaluado = {$noEmpleado360evaluado} AND noempleadoEvaluador IN ({$valorColega})  AND idbloqueCompeGen360 = {$i};";
                        $ponderacionColega = mysqli_query($db, $sqlponderacionColega);

                        $totalponderacionColega = $ponderacionColega->fetch_object();

                        $califpromColega = $totalponderacionColega->totalProm / $totalponderacionColega->countPonderaciones;
                        $califgrafpromColega = round($califpromColega, 2);

                        if ($califgrafpromColega == 0) {
                            echo '<td class="tblreport360ecabezadorosa" style="font-size: 12px;"><center> NA </center></td>';
                        } else {
                            echo '<td class="tblreport360ecabezadorosa" style="font-size: 12px;"><center>' . round($califgrafpromColega, 2) . '</center></td>';
                            $valorgrafColega .= $califgrafpromColega . ",";
                        }
                    }

                    ?>
                    <?php
                    $valorgrafColega = substr($valorgrafColega, 0, -1);
                    ?>
                </tr>


                <tr>
                    <td class="tblreport360ecabezadogris" style="font-size: 12px;">Jefe inmediato</td>
                    <?php
                    $sqlcountjefe = "SELECT * FROM personal360 WHERE idevaluado = {$noEmpleado360evaluado} AND tipoevaluador LIKE '%JEFE INMEDIATO%' AND periodo = {$periodo};";
                    $countjefe = mysqli_query($db, $sqlcountjefe);

                    while ($jefe = $countjefe->fetch_object()) {
                        $busquedajefe .= $jefe->idevaluador . ",";
                    }

                    $valorjefe = substr($busquedajefe, 0, -1);


                    $promtotalcolaborador = 0;
                    for ($i = 1; $i <= 7; $i++) {
                        $sqlponderacionjefe = "SELECT SUM(ponderacion) AS totalProm, COUNT(ponderacion) AS countPonderaciones FROM evaluacionausuarios360
                        WHERE noempleadoEvaluado = {$noEmpleado360evaluado} AND noempleadoEvaluador IN ({$valorjefe})  AND idbloqueCompeGen360 = {$i};";

                        $ponderacionjefe = mysqli_query($db, $sqlponderacionjefe);
                        $totaljefe = $ponderacionjefe->fetch_object();
                        $califpromjefe = $totaljefe->totalProm / $totaljefe->countPonderaciones;

                        if ($califpromjefe == 0) {
                            echo '<td class="tblreport360ecabezadorosa" style="font-size: 12px;"><center> NA </center></td>';
                        } else {
                            echo '<td class="tblreport360ecabezadorosa" style="font-size: 12px;"><center>' . round($califpromjefe, 2) . '</center></td>';
                            $valorgrafjefe .= $califpromjefe . ",";
                        }
                    }
                    ?>
                    <?php

                    $valorgrafjefe = substr($valorgrafjefe, 0, -1);

                    ?>
                </tr>

            </tbody>
        </table>
    </center>



    <script>
        const data = {
            labels: [
                'Recursos Expresivos',
                'Sociales y de Interacción HAP',
                'Administrativas HAP',
                'Productividad HAP',
                'Desarrollo de Equipo HAP',
                'Capacidad Resolutiva HAP',
                'Conciencia Organizacional HAP'
            ],
            datasets: [{
                    label: 'Colaboradores',
                    data: [<?= $valorgrafColaborador ?>],
                    fill: true,
                    backgroundColor: 'rgba(146, 208, 80, 0.2)',
                    borderColor: 'rgb(146, 208, 80)',
                    pointBackgroundColor: 'rgb(146, 208, 80)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(146, 208, 80)'
                }, {
                    label: 'Colegas',
                    data: [<?= $valorgrafColega ?>],
                    fill: true,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgb(54, 162, 235)',
                    pointBackgroundColor: 'rgb(54, 162, 235)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(54, 162, 235)'
                }, {
                    label: 'Jefe inmediato',
                    data: [<?= $valorgrafjefe ?>],
                    fill: true,
                    backgroundColor: 'rgba(255, 87, 51, 0.2)',
                    borderColor: 'rgb(255, 87, 51)',
                    pointBackgroundColor: 'rgb(255, 87, 51)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(255, 87, 51)'
                },
                {
                    label: 'Autoevaluación',
                    data: [<?= $valorgrafAutoEva ?>],
                    fill: true,
                    backgroundColor: 'rgba(236, 2, 254, 0.2)',
                    borderColor: 'rgb(236, 2, 254)',
                    pointBackgroundColor: 'rgb(236, 2, 254)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(236, 2, 254)'
                }
            ]
        };
        const config = {
            type: 'radar',
            data: data,
            options: {
                responsive: false,
                elements: {
                    line: {
                        borderWidth: 1
                    }
                }
            },
        };


        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>



    <center>
        <p style="font-size: 15px;"><strong>3. CONCLUSIÓN<strong></p>
    </center>

    <center>
        <table width="500" cellpadding="0" cellspacing="0" class="mitabla">
            <thead>
                <tr class="tblreport360mejoroportunidad">
                    <th class="tblreport360mejoroportunidad" style="font-size: 12px;">
                        <center>Competencia Mejor Evaluada:<center>
                    </th>
                    <td class="tblreport360mejoroportunidad" style="font-size: 12px;">
                        <center><?= $competenciasMejorEvaluada ?><center>
                    </td>
                    <td class="tblreport360mejoroportunidad" style="font-size: 11px;">
                        <center><strong><?= $califmax ?></strong>
                            <center>
                    </td>
                </tr>
                <tr class="tblreport360oportunidadmejora">
                    <th class="tblreport360oportunidadmejora" style="font-size: 12px;">
                        <center>Competencias de mayor oportunidad:</center>
                    </th>
                    <td class="tblreport360oportunidadmejora" style="font-size: 12px;">
                        <center><?= $competenciasMayorOportunidad ?></center>
                    </td>
                    <td class="tblreport360oportunidadmejora" style="font-size: 11px;">
                        <center><strong><?= $califmin ?></strong></center>
                    </td>
                </tr>
                <tr class="tblreport360campo">
                    <th class="tblreport360campo" style="font-size: 20px;">
                        <center>CALIFICACIÓN GENERAL 360:<center>
                    </th>
                    <td colspan="2" class="tblreport360campo" style="font-size: 20px;">
                        <center><strong><?= $calificacion360Oficial ?></strong>
                            <center>
                    </td>
                </tr>
            </thead>
        </table>
    </center>


    <center>
        <p>RECONOZCO Y ACEPTO RETROALIMENTACIÓN SOBRE MIS RESULTADOS OBTENIDOS</p>
    </center>

    <!-- <center>
                        <table width="800px" cellpadding="0" cellspacing="0" class="mitabla">
                            <thead>
                            <tr>

                                <?php $sqlevaluador360 = "SELECT  `idevaluador` AS evaluador FROM `personal360` WHERE `idevaluado` = {$noEmpleado360evaluado} AND `tipoevaluador` LIKE  '%JEFE INMEDIATO%';";
                                $evaluador360firma = mysqli_query($db, $sqlevaluador360);
                                $evaluador360firma = $evaluador360firma->fetch_object()->evaluador;

                                $sqlinfoevaluador360 = "SELECT * FROM `usuarios` WHERE `noempleado` = {$evaluador360firma};";
                                $infoevaluador360 = mysqli_query($db, $sqlinfoevaluador360);
                                $infoevaluador360 = $infoevaluador360->fetch_object();
                                ?>
                                <th style="font-size: 15px;">EVALUADOR <br><?= $infoevaluador360->nombreuser . " " . $infoevaluador360->appaterno . " " . $infoevaluador360->apmate ?></th>
                                <th style="font-size: 15px;">EVALUADO <br><?= $userinfo360->nombrecompleto360 ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th><br><hr width="50%"></th>
                                <th><br><hr width="50%"></th>
                            </tr>
                            </tbody>
                        </table>
                        </center> -->

    <!-- END CONTENIDO -->
    </div>

    </div>

    <!-- /.card -->
    </div>
    </div>
    </div>
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <script type="text/javascript">
        setTimeout(function() {
            window.onload = window.print();
        }, 1000);
    </script>

</body>

</html>