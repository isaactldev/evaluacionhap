<?php
require_once 'models/usuarios.php';
require_once 'models/calificacion360.php';
require_once 'models/calificacionPeriodoUsuario.php';
require_once 'models/califTec360.php';

class calif360userController
{
    public function index()
    {
        Utils::isAdmin();
        $users = new Usuarios();

        $fecha = date('Y');
        $perido1  = 1;
        $perido2  = 2;
        $users360 = $users->getAllUser360();

        require_once 'views/calif360Evluacion/index.php';
    }
    public function insertCalif360User()
    {
        Utils::isAdmin();
        if (isset($_POST)) {

            $iduser = $_POST['id'];
            $periodo =  $_POST['perido'];
            $fecha = $_POST['fecha'];
            $calif =  $_POST['calificacionUser'];


            $userCalif = new calificacion360();
            $userCalif->setIdusuario($iduser);
            $userCalif->setIdperiodo($periodo);
            $userCalif->setFehca($fecha);
            $userCalif->setCalificacion($calif);

            /* INSERSION DE LA CALIFICACION 360 */
            $userCalifSave = $userCalif->updateCalifByUser();

            /* OBTENCION DE CALIFICACION DE LOS USUARIOS360 */
            $usuarioEvaluadocalifTec360 = new califTec360();
            $usuariocalifTec360 = $usuarioEvaluadocalifTec360->getCaliftecByUser360($iduser, $periodo, $fecha);


            $usuarioEvaluado = new Usuarios();
            $usuario = $usuarioEvaluado->getUserById($iduser);

            /* CUESTIONARIO A COORDINADORES 360 SOLO SE CALIFICA [COMPETENCIAS TECNICAS]*/
            if ($usuario->tipoevaluacion == 'DIRECTIVO' && $usuario->autoevalua == 2 &&  $usuario->evalua360 == 'SI') {
                $calificacion360 = ($calif * 0.6);
                $calificaionOficial = ($calificacion360 + $usuariocalifTec360->calificaciontec);

                $updateCalifOficial = new Usuarios();
                $updateCalif = $updateCalifOficial->updateCalifUser360($iduser, $calificaionOficial);


                if ($userCalifSave) {
                    $_SESSION['califSave'] = 'califSave';
                    echo '<script>
                            window.location.replace("' . baseUrl . '?controller=calif360user&action=index");
                        </script>';
                } else {
                    $_SESSION['califSave'] = 'califFail';
                    echo '<script>
                            window.location.replace("' . baseUrl . '?controller=calif360user&action=index");
                        </script>';
                }
            }

            /* OPERATIVA 360 */
            if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 2 &&  $usuario->evalua360 == 'SI') {
                $calificacion360 = ($calif * 0.4);
                $calificaionOficial = ($calificacion360 + $usuariocalifTec360->calificaciontec);

                $updateCalifOficial = new Usuarios();
                $updateCalif = $updateCalifOficial->updateCalifUser360($iduser, $calificaionOficial);


                $actualizaCalifPeriodo = new Calificacionusuarioperiodo();
                $updateCalifPeriodo = $actualizaCalifPeriodo->updateCalifPeriodo($calificaionOficial, $iduser, $periodo, $fecha);

                if ($userCalifSave) {
                    $_SESSION['califSave'] = 'califSave';
                    echo '<script>
                            window.location.replace("' . baseUrl . '?controller=calif360user&action=index");
                        </script>';
                } else {
                    $_SESSION['califSave'] = 'califFail';
                    echo '<script>
                            window.location.replace("' . baseUrl . '?controller=calif360user&action=index");
                        </script>';
                }
            }
            /* CUESTIONARIO A SUPERVISORES [AUTOEVALUACION]*/
            if ($usuario->tipoevaluacion == 'OPERATIVO' && $usuario->autoevalua == 1 &&  $usuario->evalua360 == 'SI') {
                $calificacion360 = ($calif * 0.6);
                $calificaionOficial = ($calificacion360 + $usuariocalifTec360->calificaciontec);

                $updateCalifOficial = new Usuarios();
                $updateCalif = $updateCalifOficial->updateCalifUser360($iduser, $calificaionOficial);
                if ($userCalifSave) {
                    $_SESSION['califSave'] = 'califSave';
                    echo '<script>
                            window.location.replace("' . baseUrl . '?controller=calif360user&action=index");
                        </script>';
                } else {
                    $_SESSION['califSave'] = 'califFail';
                    echo '<script>
                            window.location.replace("' . baseUrl . '?controller=calif360user&action=index");
                        </script>';
                }
            }
        }
    }
    public function editCalif360User()
    {
        Utils::isAdmin();
        if (isset($_POST)) {
            $iduser = $_POST['iduser'];
            $periodo =  $_POST['perido'];
            $fecha = $_POST['fecha'];
            $calificacionUser = $_POST['editcalificacionUser'];

            $editcalig360 = new calificacion360();
            $editcalig360->setIdusuario($iduser);
            $editcalig360->setIdperiodo($periodo);
            $editcalig360->setFehca($fecha);
            $editcalig360->setCalificacion($calificacionUser);


            /* echo $iduser;
            echo '<pre>';
            echo $periodo;
            echo '<pre>';
            echo $fecha;
            echo '<pre>';
            echo $calificacionUser;
            die(); */

            $successEdit = $editcalig360->updateCalifByUser();

            if ($successEdit) {
                $_SESSION['actualizaUser360'] = 'actualizaUser360';
                echo '<script>
                            window.location.replace("' . baseUrl . '?controller=calif360user&action=index");
                            </script>';
            } else {
                $_SESSION['actualizaUser360'] = 'error_actualizaUser360';
                echo '<script>
                        window.location.replace("' . baseUrl . '?controller=calif360user&action=index");
                        </script>';
            }
        }
    }
    /* FUNCION PARA ACTUALIZAR LOS USUARIOS CON EVALUACION360 SEGUN EL PERIODO */
    public function actuaizarUsuarios360()
    {
        Utils::isAdmin();
        $users = new Usuarios();
        $users360 = $users->getAllUser360();

        $fecha = date('Y');

        $periodoActivo  =  Utils::getPeriodoActivo();


        $califUsers = new calificacion360();
        $actualizado = $califUsers->actualizaUserCalif($users360, $periodoActivo->idperiodo, $fecha);

        if ($actualizado) {
            $_SESSION['actualizaUser360'] = 'actualizaUser360';
            echo '<script>
                        window.location.replace("' . baseUrl . '?controller=calif360user&action=index");
                        </script>';
        } else {
            $_SESSION['actualizaUser360'] = 'error_actualizaUser360';
            echo '<script>
                    window.location.replace("' . baseUrl . '?controller=calif360user&action=index");
                    </script>';
        }
    }
}
