<?php
//CARGA DE RELACION DEL PUESTO Y DEPARTAMENTO DEL USUARIO 
        $db = mysqli_connect('localhost', 'root', 'DesWeb15', 'evapersonal22');
        
        
        $sql = "SELECT idpuesto, iddepartamento FROM `usuarios`;";
        $deppuesto = mysqli_query($db,$sql);

        

        while ($relaciondeppuesto = $deppuesto->fetch_object()){

                $checkDepPuesto = "SELECT * FROM `deppuesto` WHERE `idpuesto` = {$relaciondeppuesto->idpuesto} AND iddepartamento = {$relaciondeppuesto->iddepartamento};";
                $exstiDepPuesto = mysqli_query($db,$checkDepPuesto);


                if ($exstiDepPuesto->num_rows == 0) {
                    # code...
                    $sqlinsertDepPuesto = "INSERT INTO `deppuesto`  (`iddeppuesto`, `idpuesto`, `iddepartamento`) VALUES (NULL, {$relaciondeppuesto->idpuesto},{$relaciondeppuesto->iddepartamento});";
                    $sqlSaveDepPuesto = mysqli_query($db,$sqlinsertDepPuesto);

                }
                
                
                }
                
        
?>
