<?php
$db = mysqli_connect('localhost', 'root', 'DesWeb15', 'evapersonal22');
if (isset($_POST)) {
    $id = $_POST['idDepartamento'];



    $sql = "SELECT * FROM `usuarios` WHERE `iddepartamento` ={$id};";
    $evaluadores = mysqli_query($db, $sql);
    $mensaje2 .= '<option selected value="">Selecciona el Evaluador</option>';
    while ($evaluador = $evaluadores->fetch_object()) {

        $mensaje2 .= '<option  value="' . $evaluador->noempleado . '">' . $evaluador->noempleado . '-' . $evaluador->nombreuser . ' ' . $evaluador->appaterno . ' ' . $evaluador->apmaterno . '</option>';
    }
}
echo  $mensaje2;
