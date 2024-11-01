<?php
include '../../db/db.php';
$db = dataBase::conexion();


$sql = "SELECT * FROM `competenciastecnicas`;";
$historicocompetenciastecnicas = mysqli_query($db, $sql);



while ($hsitorico = $historicocompetenciastecnicas->fetch_object()) {


        $sqlinserthsitorico = "UPDATE `evaluacionrespusuariotecnica`  SET `competencia` = '{$hsitorico->competencia}' WHERE idcopentenciatecnica = {$hsitorico->idcopentenciatecnica};";


        /* echo '<pre>';
                echo $sqlinserthsitorico;
                echo '</pre>'; */
        mysqli_query($db, $sqlinserthsitorico);
}
