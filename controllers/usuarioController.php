<?php
require_once 'models/usuarios.php';

class usuarioController
{
    public function index()
    {

        Utils::isAdmin();
        $usuario = new Usuarios();
        $usuarios = $usuario->getAllUsuarios();
        require_once 'views/usuarios/index.php';
    }
    public function altaUsuario()
    {
        Utils::isAdmin();
        if (isset($_POST)) {
            $noEmpleado = $_POST['noEmpleado'];
            $nombre = strtoupper($_POST['nombre']);
            $apPaterno = strtoupper($_POST['apaPaterno']);
            $apMaterno = strtoupper($_POST['apaMaterno']);
            $departamento = $_POST['dapa'];
            $puesto = $_POST['puesto'];
            $jerarquia = $_POST['jerarquico'];
            if ($_POST['evaluador'] == '' && $_POST['evaluadorOpcional' == '']) {
                $idevaluadopor = 20051;
            } else {
                if ($_POST['evaluador'] == '' && $_POST['evaluadorOpcional'] != '') {
                    $idevaluadopor = $_POST['evaluadorOpcional'];
                } else
                    $idevaluadopor = $_POST['evaluador'];
            }
            $tipoEva = $_POST['tipoEva'];
            $persEva = $_POST['persEva'];
            $status = $_POST['idestatus'];
            $eva360 = $_POST['eva360'];
            $fechaAlta = $_POST['date'];
            $isEnfermera = $_POST['isEnfermera'];
            $planta = $_POST['idplanta'];

            $user = $apPaterno . '' . $noEmpleado;

            $usuario = new Usuarios();
            $usuario->setNoempleado($noEmpleado);
            $usuario->setNombreuser($nombre);
            $usuario->setAppaterno($apPaterno);
            $usuario->setApmaterno($apMaterno);
            $usuario->setUsuario($user);
            $usuario->setPassword($noEmpleado);
            $usuario->setIdstatus($status);
            $usuario->setIddepartamento($departamento);
            $usuario->setIdpuesto($puesto);
            $usuario->setIdjerarquia($jerarquia);
            $usuario->setIdevaluadopor($idevaluadopor);
            $usuario->setTipoevaluacion($tipoEva);
            $usuario->setAutoevalua($persEva);
            $usuario->setEvalua360($eva360);
            $usuario->setFechaalta($fechaAlta);
            $usuario->setAnecdotario($isEnfermera);
            $usuario->setPlanta($planta);

            //validamos si el N°Empleado  ya existe en la BD
            $sql = "select * from usuarios where  noempleado='$noEmpleado';";
            $db = dataBase::conexion();
            $userVrf = mysqli_query($db, $sql);

            if (mysqli_num_rows($userVrf) > 0) {
                $_SESSION['registroUser'] = 'error_registroUserDupliate';
                echo '<script>
                window.location.replace("' . baseUrl . '?controller=usuario&action=index");
                </script>';
            } else {
                $registro = $usuario->register();


                if ($registro) {
                    $_SESSION['registroUser'] = 'registroUser';
                    echo '<script>
                    window.location.replace("' . baseUrl . '?controller=usuario&action=index");
                    </script>';
                } else {
                    $_SESSION['registroUser'] = 'error_registroUser';
                    echo '<script>
                    window.location.replace("' . baseUrl . '?controller=usuario&action=index");
                    </script>';
                }
            }
        }
    }
    public function edit()
    {
        Utils::isAdmin();
        if (isset($_POST)) {
            $apPaterno = strtoupper($_POST['apaPaterno']);
            $idUser = $_POST['id'];
            $noEmpleado = $_POST['noEmpleado'];
            $departamento = $_POST['dapa'];
            $puesto = $_POST['puesto'];
            $jerarquia = $_POST['jerarquico'];
            $idevaluadopor = $_POST['evaluador'];
            $tipoEva = $_POST['tipoEva'];
            $persEva = $_POST['persEva'];
            $status = $_POST['idestatus'];
            $eva360 = $_POST['eva360'];
            $planta = $_POST['idplanta'];
            $user = $apPaterno . '' . $noEmpleado;

            $usuario = new Usuarios();
            $usuario->setIdusuario($idUser);
            $usuario->setNoempleado($noEmpleado);
            $usuario->setUsuario($user);
            $usuario->setPassword($noEmpleado);
            $usuario->setIdstatus($status);
            $usuario->setIddepartamento($departamento);
            $usuario->setIdpuesto($puesto);
            $usuario->setIdjerarquia($jerarquia);
            $usuario->setIdevaluadopor($idevaluadopor);
            $usuario->setTipoevaluacion($tipoEva);
            $usuario->setAutoevalua($persEva);
            $usuario->setEvalua360($eva360);
            $usuario->setPlanta($planta);
            $edit = $usuario->edit();
            if ($edit) {
                $_SESSION['editUser'] = 'editUser';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=usuario&action=index");
                    </script>';
            } else {
                $_SESSION['editUser'] = 'error_editUser';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=usuario&action=index");
                    </script>';
            }
        }
    }
    public function delete()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $userDelete = new Usuarios();
            $userDelete->setIdusuario($id);
            $delete = $userDelete->desactivar();
            if ($delete) {
                $_SESSION['deleteUser'] = 'deleteUser';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=usuario&action=index");
                    </script>';
            } else {
                $_SESSION['deleteUser'] = 'error_deleteUser';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=usuario&action=index");
                    </script>';
            }
        }
    }
    public function activar()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $userActivar = new Usuarios();
            $userActivar->setIdusuario($id);
            $Activar = $userActivar->Activar();
            if ($Activar) {
                $_SESSION['userActivar'] = 'userActivar';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=usuario&action=index");
                    </script>';
            } else {
                $_SESSION['userActivar'] = 'error_userActivar';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=usuario&action=index");
                    </script>';
            }
        }
    }
    public function desactivar()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $userActivar = new Usuarios();
            $userActivar->setIdusuario($id);
            $Activar = $userActivar->desactivar();
            if ($Activar) {
                $_SESSION['userActivar'] = 'userActivar';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=usuario&action=index");
                    </script>';
            } else {
                $_SESSION['userActivar'] = 'error_userActivar';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=usuario&action=index");
                    </script>';
            }
        }
    }
}
