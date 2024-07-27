<?php

require_once 'models/cuestionariogeneral360.php';

class cuestionariogen360Controller{

    

    public function addPregunta(){
        Utils::isAdmin();
        if (isset($_POST)) {
        $pregunta = strtoupper($_POST['pregunta']);
        $idBloque = $_POST['idbloque'];
        $idStatus = $_POST['idestatus'];
        $idevaluacion = $_POST['idevaluacion'];

        $cuestionario = new cuestionarioGen360();
        $cuestionario->setPregunta360($pregunta);
        $cuestionario->setIdbloque360($idBloque);
        $cuestionario->setIdtipoevaluacion($idevaluacion);
        $cuestionario->setIdstatus($idStatus);
        $addPregunta = $cuestionario->addPregunta();

        if ($addPregunta) {
            $_SESSION['addPregunta'] = 'addPregunta';
            echo '<script>
            window.location.replace("'. baseUrl .'?controller=cuestionariogen&action=cuestionarioGeneral&id='.$idevaluacion.'");
            </script>';
            }else {
            $_SESSION['addPregunta'] = 'erroraddPregunta';
            echo '<script>
            window.location.replace("'. baseUrl .'?controller=cuestionariogen&action=cuestionarioGeneral&id='.$idevaluacion.'");
            </script>';
            }
        }
    }
    public function DesactivaryActivarPregunta360(){
        Utils::isAdmin();
        if (isset($_GET)) {
            $idstatus = $_GET['idstatus'];
            $idpregunta = $_GET['idpregunta'];

            $idevaluacion = $_GET['ideva'];

            $newstatus = new cuestionarioGen360();
            $newstatus->setIdcuestionarioeva360($idpregunta);
            $newstatus->setIdstatus($idstatus);
            $updateStatus = $newstatus->activaYdesactivarregunta();

            if ($updateStatus) {
                $_SESSION['editPregunta'] = 'editPregunta';
                echo '<script>
                window.location.replace("'. baseUrl .'?controller=cuestionariogen&action=cuestionarioGeneral&id='.$idevaluacion.'");
                </script>';
                }else {
                $_SESSION['editPregunta'] = 'erroreditPreguntaPregunta';
                echo '<script>
                window.location.replace("'. baseUrl .'?controller=cuestionariogen&action=cuestionarioGeneral&id='.$idevaluacion.'");
                </script>';
                }

        
        }
    }
    public function editPregunta(){
        Utils::isAdmin();
        if ($_POST) {
        $idevaluacion = $_POST['ideva'];
        $idPregunta = $_POST['editid'];
        $pregunta = strtoupper($_POST['pregunta']);
        $idStatus = $_POST['idestatus'];
        $bloque = $_POST['idbloque'];

        $editPregunta = new cuestionarioGen360();
        $editPregunta->setIdcuestionarioeva360($idPregunta);
        $editPregunta->setPregunta360($pregunta);
        $editPregunta->setIdstatus($idStatus);
        $editPregunta->setIdbloque360($bloque);
        $edit = $editPregunta->edit();
        if ($edit) {
            $_SESSION['editPregunta'] = 'editPregunta';
            echo '<script>
            window.location.replace("'. baseUrl .'?controller=cuestionariogen&action=cuestionarioGeneral&id='.$idevaluacion.'");
            </script>';
            }else {
            $_SESSION['editPregunta'] = 'erroreditPreguntaPregunta';
            echo '<script>
            window.location.replace("'. baseUrl .'?controller=cuestionariogen&action=cuestionarioGeneral&id='.$idevaluacion.'");
            </script>';
            }
        }
    }
}
?>