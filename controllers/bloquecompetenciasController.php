<?php
require_once 'models/bloques.php';
require_once 'models/bloquecompetencia360.php';
require_once 'models/periodo.php';

class bloquecompetenciasController{

    public function index(){
        Utils::isAdmin();
        $bloques = new Bloques();
        $bloque = $bloques->getAllbloqueCompetencias();
        require_once 'views/bloquecompetencia/index.php';
    }

    public function index360(){
        Utils::isAdmin();
        $bloques360 = new  bloquecompetencia360();
        $allBloques360 = $bloques360->getAllbloquestec360();

        require_once 'views/bloquecompetencia360/index.php';

    }


    public function altaBloque(){
        Utils::isAdmin();
        if (isset($_POST)) {
        $nameBlocompe = $_POST['nameblocomp'];

        $bloqueCompetencia = new Bloques();
        $bloqueCompetencia->setBloquecompetencia($nameBlocompe);
        $save = $bloqueCompetencia->save();

        if ($save) {
            $_SESSION['saveBloque'] = 'saveBloque';
            echo '<script>
                window.location.replace("'. baseUrl .'?controller=bloquecompetencias&action=index");
                </script>';
        }else {
            $_SESSION['saveBloque'] = 'errorBloque';
            echo '<script>
                window.location.replace("'. baseUrl .'?controller=bloquecompetencias&action=index");
                </script>';
        }
        }
    }

    public function delete() {
        Utils::isAdmin();
    if (isset($_GET['id'])) {
    $iddelete = $_GET['id'];

    $bloqueDelete = new Bloques();
    $bloqueDelete->setIdbloque($iddelete);
    $delete = $bloqueDelete->delete();
    if ($delete) {
        $_SESSION['delteBloque'] = 'delteBloque';
        echo '<script>
            window.location.replace("'. baseUrl .'?controller=bloquecompetencias&action=index");
            </script>';
    }else {
        $_SESSION['delteBloque'] = 'errorBloque';
        echo '<script>
            window.location.replace("'. baseUrl .'?controller=bloquecompetencias&action=index");
            </script>';
    }
    }
    }


    public function edit(){
        Utils::isAdmin();
        if (isset($_POST)) {
        $idbloque = $_POST['editid'];
        $namebloque = $_POST['namebloque'];
        $status = $_POST['idestatus'];

        $bloque = new Bloques();
        $bloque->setIdbloque($idbloque);
        $bloque->setBloquecompetencia($namebloque);
        $bloque->setIdstatus($status);
        $edit = $bloque->edit();

        if ($edit) {
            $_SESSION['editBloque'] = 'editBloque';
            echo '<script>
                window.location.replace("'. baseUrl .'?controller=bloquecompetencias&action=index");
                </script>';
        }else {
            $_SESSION['editBloque'] = 'errorBloque';
            echo '<script>
                window.location.replace("'. baseUrl .'?controller=bloquecompetencias&action=index");
                </script>';
        }


        }
    }


    public function altabloque360(){
        Utils::isAdmin();
        if(isset($_POST)){
            $nameblocomp360 = $_POST['nameblocomp360'];

            $periodo = new periodo();
            $periodoActiv =  $periodo->getPeriodoActiva();

            $saveBloque360 =  new bloquecompetencia360();
            $saveBloque360->setNamebloque360($nameblocomp360);
            $saveBloque360->setIdperiodo($periodoActiv->idperiodo);
            $save = $saveBloque360->addBloque360();
            if ($save) {
                $_SESSION['saveBloque'] = 'saveBloque';
                echo '<script>
                    window.location.replace("'. baseUrl .'?controller=bloquecompetencias&action=index360");
                    </script>';
            }else {
                $_SESSION['saveBloque'] = 'errorBloque';
                echo '<script>
                    window.location.replace("'. baseUrl .'?controller=bloquecompetencias&action=index360");
                    </script>';
            }
        }
    }


    public function DesactivaryActivarBloque360(){
        Utils::isAdmin();
        if(isset($_GET)){

            $idstatus = $_GET['idstatus'];
            $idbloque360 =  $_GET['idbloque'];

            $statusBloque360 = new bloquecompetencia360();
            $statusBloque360->setIdbloqueCompeGen360($idbloque360);
            $statusBloque360->setIdstatus($idstatus);
            $activarBloque = $statusBloque360->actualizarStatus();

            if ($activarBloque) {
                $_SESSION['editBloque'] = 'editBloque';
                echo '<script>
                    window.location.replace("'. baseUrl .'?controller=bloquecompetencias&action=index360");
                    </script>';
            }else {
                $_SESSION['editBloque'] = 'errorBloque';
                echo '<script>
                    window.location.replace("'. baseUrl .'?controller=bloquecompetencias&action=index360");
                    </script>';
            }

        }
    }

    public function editBloque360(){
            Utils::isAdmin();
            if (isset($_POST)) {
            $idbloque360 = $_POST['editidbloque360'];
            $namebloque360 = $_POST['namebloque360'];
            

            $updateBloque360 = new bloquecompetencia360();
            $updateBloque360->setIdbloqueCompeGen360($idbloque360);
            $updateBloque360->setNamebloque360($namebloque360);
            
            $edit = $updateBloque360->bloqueedit360();

            if ($edit) {
                $_SESSION['editBloque'] = 'editBloque';
                echo '<script>
                    window.location.replace("'. baseUrl .'?controller=bloquecompetencias&action=index360");
                    </script>';
            }else {
                $_SESSION['editBloque'] = 'errorBloque';
                echo '<script>
                    window.location.replace("'. baseUrl .'?controller=bloquecompetencias&action=index360");
                    </script>';
            }
        }
    }
}
?>