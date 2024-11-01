<?php
include '../../db/db.php';
$db = dataBase::conexion();
if (isset($_POST)) {
        $idjerarquia = $_POST['idjerarquia'];
        $sql = "SELECT * FROM `jerarquia`;";
        $jerarquias = mysqli_query($db, $sql);

        while ($jerarquia = $jerarquias->fetch_object()) {
                $selected = $jerarquia->idjerarquia == $idjerarquia ? 'selected' : '';

                $mensaje .= '<option value="' . $jerarquia->idjerarquia . ' " ' . $selected . ' >' . $jerarquia->nombre . '</option>';
        }
        echo  $mensaje;
}
