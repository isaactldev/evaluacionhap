<?php
include '../config/helpers/utils.php';
include '../config/parameters.php';
include '../views/layout/head.php';
include '../autoload.php';
include '../db/db.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="http://172.16.1.93/EvaluacionPersonalHAP/assets/css/stylereport.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <style type="text/css">
        
		*{
            font-family: calibri !important;
            @colPrim: #003970;
            @colAC: #679fd3;
            @colSec: #ddd;
            @colVerde : #03b739;
            @colTer: #494949;
		}
		table{
			border: 0px solid #ddd;
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
		th{
			padding: 5px !important;
			margin: 2px !important;
			
		}
		td{
			border: 1px solid #ddd;
			padding: 2px !important;
			margin: 2px !important;
		}

		.txt{
			font-size: 14px;
		}
		.txt2{
			font-size: 14px;
			padding-left: 10px;
			color: #213c6d;
			padding-top: 15px;
			display: block;
		} 
		.line{
			border-bottom: 1px solid #213c6d;
        }
        .titulo{
            font-family: calibri; 
            font-size: 14px; 
            padding: 10px;
            text-align: right;
        }
        .resaltar{
            color: #003970;
            font-weight: bolder;
		}
		.mitabla thead tr td
		{
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

		.clear{
			clear: both;
		}

		.separartabla{
			margin-top: 50px;
		}
		.bt{
			border-top: 1px solid #ddd;
		}

		.bb{
			border-bottom: 1px solid #ddd;
		}

		.br{
			border-right: 1px solid #ddd;
		}

		.bl{
			border-left: 1px solid #ddd;
		}

		@media print {

			body {
				-webkit-print-color-adjust: exact;
			}

			div.saltopagina{
				display:block;
				page-break-before:always;
			}

		}

	</style>
    <title>Reporte | Calificacion</title>
</head>
<body>
<div class="container-fluid">
    <div id="printReprt" class="row" style="margin: 50px 20px 50px">
	
		<table width="975px" cellpadding="0" cellspacing="0" class="mitabla">
				<thead>
					<tr>
						<th width="150px" >
							<img src="<?=baseUrl?>assets/img/HAPR.png" width="120px">
						</td>
						<th width="400px" class="titulo" style="border-right:1px solid #003970;">
							<span class="txtBlack">Administración del</span> <span class="resaltar">Hospital Aranda de la Parra</span><br>
							<span class="resaltar">Hidalgo N°329 Tel. 719-71-00 León, Gto.</span><br>
							<span class="resaltar"><small> COD-FOR-POR_DEFINIR | Versión-POR_DEFINIR | Revisión-POR_DEFINIR</small></span>
						</th>
						<th width="200px" class="titulo">
							<b class="resaltar"><small><strong>Reporte de Evaluación al Personal</strong></small></b><br>
							<?php
							setlocale(LC_TIME,"spanish");
							$fecha = strftime("%A, %d de %B de %Y");
							?>
							<span class="resaltar"><?= $fecha?></span>
						</th>
					</tr>	
					<tr>
						<th width="975px" colspan="4" style="border-top:1px solid #003970;">
						<?php $year = date('Y');?>
							<center>  <span class="resaltar tituloformato"> REPORTE DE LA EVALUACION DE COMPETENCIAS LABORALES <?= $year?></span> </center>
						</th>
					</tr>
				</thead>
			</table>



			<table width="975px" cellpadding="0" cellspacing="0" class="mitabla" style="margin-top: 5px;">
						<thead >
							<tr class="tableHap">
							<th width="90px"><strong>Cod</strong> : 7158</th>
							<th width="250px" >TORRES URIBE CRISTIAN ISAAC</th>
							
							<th>PUESTO: PROGRAMADOR ANALISTA</th>
							
							<th>DEPARTAMENTO: SISTEMAS</th>
							
							<th>PERIODO: 1</th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<td colspan="6" class="text-center"><strong> RESULTADOS OBTENIDOS </strong></td>
							</tr>
							<tr>
							<td class="tableHap" colspan="2" class="text-center"><strong>PROMEDIO GENERAL:</strong> </td>
							<td colspan="4" class="text-center"> <h5><strong>9</strong></h5></td>
							</tr> 
							<tr>
							<td colspan="6" class="text-center"><strong> CALIFICACION POR BLOQUE DE COMPETENCIA </strong></td>
							</tr> 
							<!-- CONSULTAT  -->
							<tr>
								<td  colspan="2" class="text-center"><strong>COMPETENCIA GENERICA</strong></td><td colspan="4" class="text-center"><strong> CALIFICACION OBTENIDA  </strong></td>
							</tr>
							<tr>
							<td id="tableHap" colspan="2"><strong>BLOQUE DE COMPETENCIA</strong></td><td colspan="4" class="text-center"><strong> 9.pts </strong></td>
							</tr>
							
							<tr>
							<td colspan="6" class="text-center"><strong> OTROS </strong></td>
							</tr>
							<td id="tableHap" colspan="2"><strong>COMPROMISOS:</strong></td>
							<td colspan="4" class="text-center"><strong>
							
							<p>- COMPROMISOS</p>
							
							</strong></td>
							</tr>
							<tr>
							<td id="tableHap" colspan="2"><strong>NECESIDADES DE CAPACITACION:</strong></td>
							<td colspan="4" class="text-center"><strong>
							
							
							<p>- CAPACITACIONES</p><br>
							
							</strong></td>
							
							</tr>
						</tbody>
						</table>
				<div style="text-align:center; margin: 20px;">
					<h5>RECONOZCO Y ACEPTO RETROALIMENTACIÓN SOBRE MIS RESULTADOS OBTENIDOS</h5>
				</div>
				<div class="row" style="text-align:center; margin: 20px;">
					<div class="col" style="text-align:center; margin: 50px 20px 50px">NOMBRE DEL EVALUADOR
						<hr width="60%" style="margin: 10% 20% 50%">
					</div>
					<div class="col" style="text-align:center; margin: 50px 20px 50px">NOMBRE DEL EVALUADO
						<hr width="60%" style="margin: 10% 20% 50%">
					</div>
				</div>
	</div>
</div>
</body>
</html>