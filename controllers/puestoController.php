<?php
require_once 'models/puestos.php';
require_once 'models/deppuesto.php';
class puestoController
{
    public function index(){
        Utils::isAdmin();
        $puestos = new Puestos();
        $puesto = $puestos->getAllpuestos();
        require_once 'views/puesto/index.php';

    }
    public function add(){
        Utils::isAdmin();
        if (isset($_POST)) {
        $namePuesto = strtoupper($_POST['namePuesto']);
        $descriPuesto = $_POST['descriPuesto'];
        $departamento = $_POST['dapa'];
        
        $puesto = new Puestos();

        $puesto->setNombrePuesto($namePuesto);
        $puesto->setDescripcion($descriPuesto);
        $puesto->setDepartamento($departamento);
        $add = $puesto->add();

        $puestodep = $puesto->adddeppuesto();/* EVIAMOS LOS VALORES PARA LE RELACION DEL PUESTO CON EL DEPARTAMENTO */

        if ($add && $puestodep) {
        $_SESSION['addPuesto'] = 'addPuesto';
        echo '<script>
                    window.location.replace("'. baseUrl .'?controller=puesto&action=index");
                    </script>';
        }else {
        $_SESSION['addPuesto'] = 'errorPuesto';
        echo '<script>
                    window.location.replace("'. baseUrl .'?controller=puesto&action=index");
                    </script>';
        }
        }
    }
    public function edit(){
        Utils::isAdmin();
        if (isset($_POST)) {
        $id = $_POST['editid'];
        $puestoname = strtoupper($_POST['namedep']);
        $departamento = $_POST['dapa'];
        $descriPuesto = $_POST['descriPuesto'];
        $status = $_POST['idestatus'];

        $puesto = new Puestos();
        $puesto->setIdpuesto($id);
        $puesto->setNombrePuesto($puestoname);
        $puesto->setDescripcion($descriPuesto);
        $puesto->setDepartamento($departamento);
        $puesto->setIdstatus($status);
        
        $edit= $puesto->edit();



        if ($edit) {
            $_SESSION['editPuesto'] = 'editPuesto';
            echo '<script>
                        window.location.replace("'. baseUrl .'?controller=puesto&action=index");
                        </script>';
            }else {
            $_SESSION['addPuesto'] = 'errorPuesto';
            echo '<script>
                        window.location.replace("'. baseUrl .'?controller=puesto&action=index");
                        </script>';
            }

        }
    }
    public function delete(){
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $puesto = new Puestos();
            $puesto->setIdpuesto($id);
            $deletepuesto = $puesto->delete();

            if ($deletepuesto) {
                $_SESSION['deletePuesto'] = 'deletePuesto';
                echo '<script>
                            window.location.replace("'. baseUrl .'?controller=puesto&action=index");
                            </script>';
                }else {
                $_SESSION['deletePuesto'] = 'errorPuesto';
                echo '<script>
                            window.location.replace("'. baseUrl .'?controller=puesto&action=index");
                            </script>';
                }
            }
    }
    
}

?>