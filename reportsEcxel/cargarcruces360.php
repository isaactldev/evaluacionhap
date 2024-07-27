<?php
//PARA QUE PUEDEAN INSERTAR EL FORMATO DEL ARCHIVO EDBE SER UN .CSV
if (isset($_POST)) {

    $db = mysqli_connect('localhost', 'root', 'DesWeb15', 'evapersonal22');

    $date = date('Y');

    $mimetype   = $_FILES['carga360']['type'];
    $size       = $_FILES['carga360']['size'];
    $archivotmp = $_FILES['carga360']['tmp_name'];
    $lineas = file($archivotmp);


    $i = 0;
    $countError = 0;
    foreach ($lineas as $liena) {
        $cantidad_registros = count($lineas);
        $cantidad_registrosAdd =  ($cantidad_registros - 1); //QUITAMOS EL ENCABEZADO DEL ARCHIVO


        if ($i != 0) {
            //INSERCION Y OPTENCION DE LOS CAMPOS DEL ARCHVIO CSV
            $datos = explode(",", $liena);

            $noEvaluador = !empty($datos[0]) ? ($datos[0]) : '';
            $noEvaluado = !empty($datos[1]) ? ($datos[1]) : '';
            $calif = !empty($datos[2]) ? ($datos[2]) : '';
            $periodo = !empty($datos[3]) ? ($datos[3]) : '';
            $status = !empty($datos[4]) ? ($datos[4]) : '';
            $tipoEvaluador = !empty($datos[5]) ? ($datos[5]) : '';
            $fecha = !empty($datos[6]) ? ($datos[6]) : '';

            $sqlCruce360 = "INSERT INTO personal360 (idpersonal360,idevaluador,idevaluado,promFinalCalif360,periodo,statuseva360,tipoevaluador,fecha) VALUES (NULL,{$noEvaluador},{$noEvaluado},{$calif},{$periodo},{$status},'{$tipoEvaluador}',{$fecha});";
            $cruce360Succes = mysqli_query($db, $sqlCruce360);


            if ($cruce360Succes) {
                $countError = 0;
            } else {
                $countError++;
                echo mysqli_error($db);
            }
        }
        $i++;
    }
    if ($countError ==  0) {
        $_SESSION['cruce360Succes'] = 'cruce360Succes';
        echo '<script>
            window.location.replace("http://172.16.1.100:82/evaluacionhap/?controller=evaluacionpersonal360&action=cruces360");
            </script>';
    } else {
        $_SESSION['cruce360fail'] = 'cruce360fail';
        echo '<script>
            window.location.replace("http://172.16.1.100:82/evaluacionhap/?controller=evaluacionpersonal360&action=cruces360");
        </script>';
    }
}
