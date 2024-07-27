<?php

require_once 'models/cuestionariogeneral.php';
require_once 'models/cuestionariogeneral360.php';

class cuestionariogenController{

    public function cuestionarioGeneral(){
        Utils::isAdmin();
        if (isset($_GET['id']) && $_GET['id'] !=  9) {
            $evaid = $_GET['id'];
            $preguntas = new cuestionarioGen();
            $preguntas->setIdtipoevaluacion($evaid);
            $pregunta = $preguntas->getAllpreguntasByIdTipoEva();
            require_once 'views/cuestionariogeneral/index.php';
    }else{

            $evaid = $_GET['id'];
            $preguntas = new cuestionarioGen360();
            $preguntas->setIdtipoevaluacion($evaid);
            $pregunta = $preguntas->getAllpreguntasByIdTipoEva360();
            require_once 'views/cuestionariogeneral/index360.php';
    }
}
    public function addPregunta(){
        Utils::isAdmin();
        if (isset($_POST)) {
        $pregunta = strtoupper($_POST['pregunta']);
        $idBloque = $_POST['idbloque'];
        $idStatus = $_POST['idestatus'];
        $idevaluacion = $_POST['idevaluacion'];

        $cuestionario = new cuestionarioGen();
        $cuestionario->setPregunta($pregunta);
        $cuestionario->setIdbloque($idBloque);
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
    public function desactivarPregunta(){
        Utils::isAdmin();
        if ($_GET['id'] && $_GET['evaid']) {
        $idevaluacion = $_GET['evaid'];
        $id = $_GET['id'];
        $preguntaDelete = new cuestionarioGen();
        $preguntaDelete->setIdtipoevaluacion($idevaluacion);
        $preguntaDelete->setIdcuestionariog($id);
        $deletePregunta = $preguntaDelete->desactivarPregunta();
        if ($deletePregunta) {
            $_SESSION['desactivarPregunta'] = 'desactivarPregunta';
            echo '<script>
            window.location.replace("'. baseUrl .'?controller=cuestionariogen&action=cuestionarioGeneral&id='.$idevaluacion.'");
            </script>';
            }else {
            $_SESSION['desactivarPregunta'] = 'errordesactivarPregunta';
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

        $editPregunta = new cuestionarioGen();
        $editPregunta->setIdcuestionariog($idPregunta);
        $editPregunta->setPregunta($pregunta);
        $editPregunta->setIdstatus($idStatus);
        $editPregunta->setIdbloque($bloque);
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