<?php

require_once 'models/compromisos.php';
require_once 'models/requierecapacitacion.php';

class capcompromisoController
{

    public function saveCompromisos()
    {
        if ($_POST) {
            $iduserCompromiso =  $_POST['iduserCompromiso'];
            $compromiso =  strtoupper($_POST['addcompromiso']);
            $periodo = $_POST['idperiodo'];
            $fechaperiodo =  $_POST['fechaperiodoCompromiso'];

            $addCompromiso  =  new Comprimisos();
            $saveNewCompromiso =  $addCompromiso->addCompromisosByUser($iduserCompromiso, $compromiso);

            if ($saveNewCompromiso == true) {
                $_SESSION['saveCompromiso'] = 'saveNewCompromiso';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=evausuario&action=verEvaluacionByUserEvaluado&iduser=' . $iduserCompromiso . '&idperiodo=' . $periodo . '&fecha=' . $fechaperiodo . '");
                    </script>';
            } else {
                $_SESSION['saveCompromiso'] = 'error_saveNewCompromiso';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=evausuario&action=verEvaluacionByUserEvaluado&iduser=' . $iduserCompromiso . '&idperiodo=' . $periodo . '&fecha=' . $fechaperiodo . '");
                    </script>';
            }
        } else {
            $_SESSION['saveCompromiso'] = 'error_saveCompromiso';
            echo '<script>
                window.location.replace("' . baseUrl . 'controller=evausuario&action=guiaEvaluacion");
                </script>';
        }
    }
    public function editCompromiso()
    {
        if ($_POST) {
            $idCompromiso = $_POST['ideditidCompromiso'];
            $iduserCompromiso =  $_POST['idusereditidCompromiso'];
            $compromiso =  strtoupper($_POST['compromisoedit']);
            $periodo = $_POST['periodo'];
            $fechaperiodo = $_POST['fechaperiodoCompromiso'];


            $editCompromiso =  new Comprimisos();
            $saveEditCompromiso =  $editCompromiso->editCompromisisByUsers($idCompromiso, $iduserCompromiso, $compromiso);

            if ($saveEditCompromiso == true) {
                $_SESSION['saveCompromiso'] = 'saveCompromiso';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=evausuario&action=verEvaluacionByUserEvaluado&iduser=' . $iduserCompromiso . '&idperiodo=' . $periodo . '&fecha=' . $fechaperiodo . '");
                    </script>';
            } else {
                $_SESSION['saveCompromiso'] = 'error_saveCompromiso';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=evausuario&action=verEvaluacionByUserEvaluado&iduser=' . $iduserCompromiso . '&idperiodo=' . $periodo . '&fecha=' . $fechaperiodo . '");
                    </script>';
            }
        } else {
            $_SESSION['saveCompromiso'] = 'error_saveCompromiso';
            echo '<script>
                window.location.replace("' . baseUrl . 'controller=evausuario&action=guiaEvaluacion");
                </script>';
        }
    }

    public function saveCapacitacion()
    {
        if ($_POST) {
            $iduserCapacitacion = $_POST['iduserCapacitacion'];
            $idperiodoCapacitacion = $_POST['idperiodoCapacitacion'];
            $fechaperiodoCap = $_POST['fechaperiodoCap'];
            $capacitacionsave = $_POST['capacitacionsave'];

            $saveCapacitacion =  new requierecapacitacion();
            $saveNewCapacitacion = $saveCapacitacion->addCapacitacion($iduserCapacitacion, $capacitacionsave);

            if ($saveNewCapacitacion == true) {
                $_SESSION['saveCapacitacion'] = 'saveCapacitacion';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=evausuario&action=verEvaluacionByUserEvaluado&iduser=' . $iduserCapacitacion . '&idperiodo=' . $idperiodoCapacitacion . '&fecha=' . $fechaperiodoCap . '");
                    </script>';
            } else {
                $_SESSION['saveCapacitacion'] = 'error_saveCapacitacion';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=evausuario&action=verEvaluacionByUserEvaluado&iduser=' . $iduserCapacitacion . '&idperiodo=' . $idperiodoCapacitacion . '&fecha=' . $fechaperiodoCap . '");
                    </script>';
            }
        } else {
            $_SESSION['saveCapacitacion'] = 'error_saveCapacitacion';
            echo '<script>
                window.location.replace("' . baseUrl . 'controller=evausuario&action=guiaEvaluacion");
                </script>';
        }
    }

    public function aditCapacitacion()
    {
        if ($_POST) {
            $idcapacitacion  =  $_POST['ideditidCapacitaciones'];
            $iduserCapacitacion =  $_POST['idusereditidCapacitacion'];
            $editCapacitacion  =  strtoupper($_POST['capacitacionedit']);
            $periodo =  $_POST['periodo'];
            $fechaperiodoCapacitacion = $_POST['fechaperiodoCapacitacion'];

            $editCapacitaciones =  new requierecapacitacion();
            $saveEditCapacitacion = $editCapacitaciones->editCapacitacion($idcapacitacion, $iduserCapacitacion, $editCapacitacion);

            if ($saveEditCapacitacion == true) {
                $_SESSION['saveeditCapacitacion'] = 'saveeditCapacitacion';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=evausuario&action=verEvaluacionByUserEvaluado&iduser=' . $iduserCapacitacion . '&idperiodo=' . $periodo . '&fecha=' . $fechaperiodoCapacitacion . '");
                    </script>';
            } else {
                $_SESSION['saveeditCapacitacion'] = 'error_saveeditCapacitacion';
                echo '<script>
                    window.location.replace("' . baseUrl . '?controller=evausuario&action=verEvaluacionByUserEvaluado&iduser=' . $iduserCapacitacion . '&idperiodo=' . $periodo . '&fecha=' . $fechaperiodoCapacitacion . '");
                    </script>';
            }
        } else {
            $_SESSION['saveeditCapacitacion'] = 'error_saveCapacitacion';
            echo '<script>
                window.location.replace("' . baseUrl . 'controller=evausuario&action=guiaEvaluacion");
                </script>';
        }
    }
}
