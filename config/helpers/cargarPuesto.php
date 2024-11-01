<?php
include '../../db/db.php';
$db = dataBase::conexion();
if (isset($_POST)) {
        $id = $_POST['ID'];
        $idPuestoUser = $_POST['idPuestoUser'];
        /* PUESTOS DEL DEPARTAMENTO */
        $sql = "SELECT d.iddepartamento, p.idpuesto, p.nombrepuesto from deppuesto d
                INNER JOIN  puestos p ON d.idpuesto = p.idpuesto WHERE d.iddepartamento = {$id};";
        $puesto = mysqli_query($db, $sql);

        $sqlpuestoUser = "SELECT idpuesto FROM `puestos` WHERE `idpuesto` = '{$idPuestoUser}';";
        $userpuesto = mysqli_query($db, $sqlpuestoUser);
        $userpuesto = $userpuesto->fetch_object()->idpuesto;


        while ($deppuesto = $puesto->fetch_object()) {
                $result = ($userpuesto == $deppuesto->idpuesto) ? 'selected'  : '';
                $mensaje .= '<option ' . $result . ' value="' . $deppuesto->idpuesto . '">' . $deppuesto->idpuesto . '-' . $deppuesto->nombrepuesto . '</option>';
        }
}
echo  $mensaje;
