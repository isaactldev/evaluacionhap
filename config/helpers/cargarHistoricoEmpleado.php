<?php
        $db = mysqli_connect('localhost', 'root', 'DesWeb15', 'evapersonal22');
        
        
        $sql = "SELECT * FROM `usuarios`;";
        $historicoEmpleado = mysqli_query($db,$sql);

        

        while ($hsitorico = $historicoEmpleado->fetch_object()){

                
                $sqlinserthsitorico = "INSERT INTO `historicoempleado` 
                (`idhistorico`,`idusuario`,`iddepartamento`,`idpuesto`,`idjerarquia`,`idevaluadopor`,`tipoevaluacion`,`autoevalua`,`evalua360`,`estatusevaluado`,`calificacion`,`anecdotario`,`periodo`,`fecha`) 
                VALUES 
                (NULL,{$hsitorico->idusuario},{$hsitorico->iddepartamento},{$hsitorico->idpuesto},{$hsitorico->idjerarquia},{$hsitorico->idevaluadopor},'{$hsitorico->tipoevaluacion}',{$hsitorico->autoevalua},'{$hsitorico->evalua360}',{$hsitorico->statusevaluado},{$hsitorico->calificacion},'{$hsitorico->anecdotario}', 2, 2022);";

                
                /* echo '<pre>';
                echo $sqlinserthsitorico;
                echo '</pre>'; */
               /*  mysqli_query($db,$sqlinserthsitorico); */
                }
