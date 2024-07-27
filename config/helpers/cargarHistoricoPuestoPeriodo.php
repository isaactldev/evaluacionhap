<?php
        $db = mysqli_connect('localhost', 'root', 'DesWeb15', 'evapersonal22');
        
        
        $sql = "SELECT * FROM `competenciastecnicas`;";
        $historicocompetenciastecnicas = mysqli_query($db,$sql);

        

        while ($hsitorico = $historicocompetenciastecnicas->fetch_object()){

                
                $sqlinserthsitorico = "UPDATE `evaluacionrespusuariotecnica`  SET `competencia` = '{$hsitorico->competencia}' WHERE idcopentenciatecnica = {$hsitorico->idcopentenciatecnica};";

                
                /* echo '<pre>';
                echo $sqlinserthsitorico;
                echo '</pre>'; */
                mysqli_query($db,$sqlinserthsitorico);
                }
                
        
?>



