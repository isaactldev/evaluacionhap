<?php
require_once 'models/competeciasTecnicas.php';

class competecnicaController{

    public function competenciasTecnicasPuesto(){
        Utils::isAdmin();
        /* COMPETENCIAS ACORDE AL PUESTO */
        if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $competencias = new competeciasTecnicas();
        $competencias->setIdpuesto($id);
        $competencia = $competencias->getCompetenciasTecnicasbyId();

        require_once 'views/puesto/competenicatec_puesto.php';
        }
    }
    public function saveCompetenciaTecnica(){
        Utils::isAdmin();
        if (isset($_POST)) {
        $idPuesto = $_POST['puesto'];
        $idStatus = $_POST['idestatus'];
        $competencia = $_POST['descriPuesto'];

        $competenciaTec = new competeciasTecnicas();
        $competenciaTec->setIdpuesto($idPuesto);
        $competenciaTec->setIdstatus($idStatus);
        $competenciaTec->setCompetencia($competencia);
        $save = $competenciaTec->save();

        if ($save) {
            $_SESSION['addcompetencia'] = 'addcompetencia';
            echo '<script>
            window.location.replace("'. baseUrl .'?controller=competecnica&action=competenciasTecnicasPuesto&id='.$idPuesto.'");
            </script>';
            }else {
            $_SESSION['addcompetencia'] = 'errorCompetencia';
            echo '<script>
            window.location.replace("'. baseUrl .'?controller=competecnica&action=competenciasTecnicasPuesto&id='.$idPuesto.'");
            </script>';
            }
        }
        
    }
    public function delete(){
        Utils::isAdmin();
        if (isset($_GET['id']) && $_GET['idpuesto']) {
        $id = $_GET['id'];
        $idPuesto = $_GET['idpuesto'];
        $competenicaDelete = new competeciasTecnicas();
        $competenicaDelete->setIdcopentenciatecnica($id);
        $delete = $competenicaDelete->delete();
        if ($delete) {
            $_SESSION['deletecompetencia'] = 'deletecompetencia';
            echo '<script>
            window.location.replace("'. baseUrl .'?controller=competecnica&action=competenciasTecnicasPuesto&id='.$idPuesto.'");
            </script>';
            }else {
            $_SESSION['deletecompetencia'] = 'errorCompetencia';
            echo '<script>
            window.location.replace("'. baseUrl .'?controller=competecnica&action=competenciasTecnicasPuesto&id='.$idPuesto.'");
            </script>';
            }
        }

    
    }
    public function editCompetenciaTecnica(){
        Utils::isAdmin();
        if (isset($_POST)) {

            $idpuesto = $_POST['idpuesto'];
            $idcompetencia = $_POST['idcompetec'];
            $competenciatecnica = $_POST['competenciatecnica'];
            $idStatus = $_POST['idestatus'];

            $competenicaedit = new competeciasTecnicas();
            $competenicaedit->setIdcopentenciatecnica($idcompetencia);
            $competenicaedit->setCompetencia($competenciatecnica);
            $competenicaedit->setIdstatus($idStatus);

            $editCompetenica = $competenicaedit->edit();

            if ($editCompetenica) {
                $_SESSION['editcompetencia'] = 'editcompetencia';
                echo '<script>
                window.location.replace("'. baseUrl .'?controller=competecnica&action=competenciasTecnicasPuesto&id='.$idpuesto.'");
                </script>';
                }else {
                $_SESSION['editcompetencia'] = 'erroreditcompetencia';
                echo '<script>
                window.location.replace("'. baseUrl .'?controller=competecnica&action=competenciasTecnicasPuesto&id='.$idpuesto.'");
                </script>';
                }
            }
    }
}

?>