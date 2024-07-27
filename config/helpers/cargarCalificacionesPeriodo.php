<?php
        $db = mysqli_connect('localhost', 'root', 'DesWeb15', 'evapersonal22');
        
        
        $sql = "SELECT * FROM `usuarios`;";
        $califPeriodoUsuarios = mysqli_query($db,$sql);

        

        while ($califuser = $califPeriodoUsuarios->fetch_object()){

            if ($califuser->calificacion == '') {
                $califcapturada = 0;
            }else{
                $califcapturada = $califuser->calificacion;
            }
                
                $sqlinsertCalif = "INSERT INTO `calificacionusuarioperiodo` (`idcalificacionperiodo`, `idusuario`, `idperiodo`, `calificacionperiodo`, `date`) 
                VALUES (NULL, {$califuser->idusuario}, 1, {$califcapturada}, 2022);";
                die();
                /* mysqli_query($db,$sqlinsertCalif); */
                }
