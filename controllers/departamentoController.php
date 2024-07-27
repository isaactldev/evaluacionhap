<?php
require_once 'models/departamentos.php';
require_once 'models/puestos.php';
require_once 'models/deppuesto.php';
class departamentoController{

    public function index(){
        Utils::isAdmin();
        $departamento = new Departamentos();
        $dep = $departamento->getAlldepartamento();
        require_once 'views/departamento/index.php';
    }
    public function add(){
        Utils::isAdmin();
        if (isset($_POST)) {
        $nameDepartametno = $_POST['namedepartamento'];
        
        $departamenoAlta = strtoupper($nameDepartametno);/* convertimos el nombre del departamento a MAYUSCULAS */
        $departamento = new Departamentos();
        $departamento->setDepnombre($departamenoAlta);
        $edit = $departamento->add();

        if ($edit) {
        $_SESSION['createDep'] = 'createDep';
        echo '<script>
        window.location.replace("'. baseUrl .'?controller=departamento&action=index");
        </script>';
        }else {
        $_SESSION['createDep'] = 'errorDep';
        echo '<script>
        window.location.replace("'. baseUrl .'?controller=departamento&action=index");
        </script>';
        }

        }
    }
    public function edit(){
        Utils::isAdmin();
        if (isset($_POST)) {
            $id = $_POST['editid'];
            $namedep = $_POST['namedep'];
            $statusdep = $_POST['idestatus'];
            
            $editDep = new Departamentos();
            $editDep->setIddepartamentto($id);
            $editDep->setDepnombre($namedep);
            $editDep->setIdstatus($statusdep);

            $edit = $editDep->edit();
            if ($edit) {
                $_SESSION['editDep'] = 'editDep';
                echo '<script>
                window.location.replace("'. baseUrl .'?controller=departamento&action=index");
                </script>';
                }else {
                $_SESSION['editDep'] = 'errorDep';
                echo '<script>
                window.location.replace("'. baseUrl .'?controller=departamento&action=index");
                </script>';
                }
        }
    }
    public function delete(){
        Utils::isAdmin();
        if (isset($_GET['id'])) {
        $deleteid = $_GET['id'];

        $deletedep = new Departamentos();
        $deletedep->setIddepartamentto($deleteid);
        $delete = $deletedep->delete();

        if ($delete) {
            $_SESSION['deleteDep'] = 'deleteDep';
            echo '<script>
            window.location.replace("'. baseUrl .'?controller=departamento&action=index");
            </script>';
            }else {
            $_SESSION['deleteDep'] = 'errorDep';
            echo '<script>
            window.location.replace("'. baseUrl .'?controller=departamento&action=index");
            </script>';
            }
        }
    }
    public function getPuestosDepartamento(){

        Utils::isAdmin();
        if (isset($_GET['iddep'])) {
            # code...
            $iddep = $_GET['iddep'];

            $puestosdep = new Deppuesto();
            $puestosdep->setIddepartemetno($iddep);
            $puestos = $puestosdep->getDepartementoPuesto();

            require_once 'views/departamento/puestosDepartamento.php';
            
        }

    }
}

?>