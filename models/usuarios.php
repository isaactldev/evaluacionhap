    <?php

    class Usuarios
    {
        private $idusuario;
        private $nombreuser;
        private $appaterno;
        private $apmaterno;
        private $usuario;
        private $noempleado;
        private $password;
        private $rol;
        private $idstatus;
        private $iddepartamento;
        private $idpuesto;
        private $idjerarquia;
        private $idevaluadopor;
        private $idcompromiso;
        private $requierecapacitacion;
        private $tipoevaluacion;
        private $autoevalua;
        private $evalua360;
        private $fechaalta;
        private $fecha;
        private $anecdotario;
        private $planta;
        private $db;

        public function __construct()
        {

            $this->db = dataBase::conexion();
        }
        public function getIdusuario()
        {
            return $this->idusuario;
        }
        public function setIdusuario($idusuario)
        {
            $this->idusuario = $idusuario;

            return $this;
        }
        public function getNoempleado()
        {
            return $this->noempleado;
        }
        public function setNoempleado($noempleado)
        {
            $this->noempleado = $noempleado;

            return $this;
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function setPassword($password)
        {
            $this->password = $password;

            return $this;
        }
        public function getRol()
        {
            return $this->rol;
        }
        public function setRol($rol)
        {
            $this->rol = $rol;
            return $this;
        }
        public function getIdstatus()
        {
            return $this->idstatus;
        }
        public function setIdstatus($idstatus)
        {
            $this->idstatus = $idstatus;

            return $this;
        }
        public function getIddepartamento()
        {
            return $this->iddepartamento;
        }
        public function setIddepartamento($iddepartamento)
        {
            $this->iddepartamento = $iddepartamento;

            return $this;
        }
        public function getIdpuesto()
        {
            return $this->idpuesto;
        }
        public function setIdpuesto($idpuesto)
        {
            $this->idpuesto = $idpuesto;

            return $this;
        }
        public function getIdjerarquia()
        {
            return $this->idjerarquia;
        }
        public function setIdjerarquia($idjerarquia)
        {
            $this->idjerarquia = $idjerarquia;

            return $this;
        }
        public function getIdevaluadopor()
        {
            return $this->idevaluadopor;
        }
        public function setIdevaluadopor($idevaluadopor)
        {
            $this->idevaluadopor = $idevaluadopor;
            return $this;
        }
        public function getIdcompromiso()
        {
            return $this->idcompromiso;
        }
        public function setIdcompromiso($idcompromiso)
        {
            $this->idcompromiso = $idcompromiso;

            return $this;
        }
        public function getRequierecapacitacion()
        {
            return $this->requierecapacitacion;
        }
        public function setRequierecapacitacion($requierecapacitacion)
        {
            $this->requierecapacitacion = $requierecapacitacion;

            return $this;
        }
        public function getTipoevaluacion()
        {
            return $this->tipoevaluacion;
        }
        public function setTipoevaluacion($tipoevaluacion)
        {
            $this->tipoevaluacion = $tipoevaluacion;

            return $this;
        }
        public function getAutoevalua()
        {
            return $this->autoevalua;
        }
        public function setAutoevalua($autoevalua)
        {
            $this->autoevalua = $autoevalua;

            return $this;
        }
        public function getEvalua360()
        {
            return $this->evalua360;
        }
        public function setEvalua360($evalua360)
        {
            $this->evalua360 = $evalua360;

            return $this;
        }
        public function getFechaalta()
        {
            return $this->fechaalta;
        }
        public function setFechaalta($fechaalta)
        {
            $this->fechaalta = $fechaalta;

            return $this;
        }
        public function getFecha()
        {
            return $this->fecha;
        }
        public function setFecha($fecha)
        {
            $this->fecha = $fecha;

            return $this;
        }
        public function getDb()
        {
            return $this->db;
        }
        public function setDb($db)
        {
            $this->db = $db;

            return $this;
        }
        public function getNombreuser()
        {
            return $this->nombreuser;
        }
        public function setNombreuser($nombreuser)
        {
            $this->nombreuser = $nombreuser;

            return $this;
        }
        public function getAppaterno()
        {
            return $this->appaterno;
        }
        public function setAppaterno($appaterno)
        {
            $this->appaterno = $appaterno;

            return $this;
        }
        public function getApmaterno()
        {
            return $this->apmaterno;
        }
        public function setApmaterno($apmaterno)
        {
            $this->apmaterno = $apmaterno;

            return $this;
        }
        public function getUsuario()
        {
            return $this->usuario;
        }
        public function setUsuario($usuario)
        {
            $this->usuario = $usuario;

            return $this;
        }
        public function getAllUsuarios()
        {
            $sql = "SELECT * FROM `usuarios`;";
            $usuarios = $this->db->query($sql);
            return $usuarios;
        }
        public function getAllUsuariosByDepartamento($iddepartamento)
        {
            $sql = "SELECT * FROM `usuarios` WHERE iddepartamento = {$iddepartamento};";
            $usuarios = $this->db->query($sql);
            return $usuarios;
        }
        public function getUserByNoEmpleado($noEmpleado)
        {
            $sql = "SELECT * FROM `usuarios` WHERE `noempleado`={$noEmpleado};";
            $usuario = $this->db->query($sql);
            return $usuario->fetch_object();
        }
        public function getUserById($id)
        {
            $sql = "SELECT * FROM `usuarios` WHERE idusuario={$id};";
            $usuario = $this->db->query($sql);
            return $usuario->fetch_object();
        }
        public function getUserEvaluadorById($id)
        {
            $sql = "SELECT * FROM `usuarios` WHERE noempleado={$id};";
            $usuario = $this->db->query($sql);
            return $usuario->fetch_object();
        }
        public function getAnecdotario()
        {
            return $this->anecdotario;
        }
        public function setAnecdotario($anecdotario)
        {
            $this->anecdotario = $anecdotario;
            return $this;
        }
        public function getPlanta()
        {
            return $this->planta;
        }
        public function setPlanta($planta)
        {
            $this->planta = $planta;
            return $this;
        }


        public function register()
        {
            $sql = "INSERT INTO `usuarios` (
                `idusuario` ,
                `nombreuser` ,
                `appaterno` ,
                `apmaterno` ,
                `usuario` ,
                `noempleado` ,
                `password` ,
                `rol`,
                `idstatus` ,
                `iddepartamento`,
                `idpuesto` ,
                `idjerarquia` ,
                `idevaluadopor` ,
                `idcompromiso` ,
                `idrequierecapacitacion` ,
                `tipoevaluacion` ,
                `autoevalua` ,
                `evalua360` ,
                `statusevaluado`,
                `calificacion`,
                `fechaalta` ,
                `fecha`,
                `anecdotario`,
                `enplanta`
                )
                VALUES (
                NULL ,
                '{$this->getNombreuser()}',
                '{$this->getAppaterno()}',
                '{$this->getApmaterno()}', 
                '{$this->getUsuario()}', 
                {$this->getNoempleado()},
                '{$this->getPassword()}', 
                'user',
                {$this->getIdstatus()},
                {$this->getIddepartamento()},
                {$this->getIdpuesto()},
                {$this->getIdjerarquia()},
                {$this->getIdevaluadopor()},
                NULL , 
                NULL ,
                '{$this->getTipoevaluacion()}',
                {$this->getAutoevalua()},
                '{$this->getEvalua360()}',
                2,
                0,
                '{$this->getFechaalta()}',
                CURRENT_TIMESTAMP(),
                '{$this->getAnecdotario()}',
                {$this->getPlanta()});";
            /* echo $sql;
            echo $this->db->error;
            die(); */

            $save = $this->db->query($sql);
            $result = false;
            if ($save) {
                $result = true;
            }
            return $result;
        }
        public function edit()
        {
            $sql = "UPDATE usuarios 
            SET
            `usuario`  = '{$this->getUsuario()}',
            `noempleado`  = {$this->getNoempleado()},
            `password`  = '{$this->getPassword()}',
            `idstatus`  = {$this->getIdstatus()},
            `iddepartamento`  = {$this->getIddepartamento()},
            `idpuesto`  = {$this->getIdpuesto()},
            `idjerarquia`  = {$this->getIdjerarquia()},
            `idevaluadopor` = {$this->getIdevaluadopor()},
            `tipoevaluacion`  = '{$this->getTipoevaluacion()}',
            `autoevalua`  = {$this->getAutoevalua()},
            `evalua360`  = '{$this->getEvalua360()}'
            WHERE `idusuario` = {$this->getIdusuario()};";
            $edit = $this->db->query($sql);
            $request = false;
            if ($edit) {
                $request = true;
            }
            return $request;
        }
        public function desactivar()
        {
            /* $sql = "DELETE FROM `usuarios` WHERE `idusuario` = {$this->getIdusuario()};"; */
            $sql = "UPDATE usuarios SET idstatus = 2 WHERE idusuario = {$this->getIdusuario()};";
            $delete = $this->db->query($sql);
            $request = false;
            if ($delete) {
                $request = true;
            }
            return $request;
        }
        public function Activar()
        {
            /* $sql = "DELETE FROM `usuarios` WHERE `idusuario` = {$this->getIdusuario()};"; */
            $sql = "UPDATE usuarios SET idstatus = 1 WHERE `idusuario` = {$this->getIdusuario()};";
            $delete = $this->db->query($sql);
            $request = false;
            if ($delete) {
                $request = true;
            }
            return $request;
        }
        public function login()
        {
            $result = false;
            $user = $this->usuario;
            $pass = $this->password;

            $sql = "SELECT * FROM `usuarios` WHERE  usuario = '{$user}';";
            $login = $this->db->query($sql);
            if ($login && $login->num_rows == 1) {
                # code...
                $usuario = $login->fetch_object();
                //verificacion de la contraseña
                if ($pass == $usuario->password) {
                    $result = $usuario;
                }
            }
            return $result;
        }
        public function getAllPersonalAcarg($id)
        {
            $sql = "SELECT * FROM `usuarios` WHERE `idevaluadopor` = {$id} AND idstatus = 1;";
            $personalAcargo = $this->db->query($sql);
            return $personalAcargo;
        }
        public function getAllUser360()
        {
            $sql = "SELECT * FROM `usuarios` WHERE idjerarquia IN ('1','2','3','4') AND `autoevalua` = 2 and `evalua360` = 'SI';";
            $users360 = $this->db->query($sql);
            return $users360;
        }

        public function updateCalifUser360($idUser, $calif)
        {
            $sql = "UPDATE usuarios SET calificacion = {$calif} WHERE idusuario = {$idUser};";
            $califusers360 = $this->db->query($sql);

            $request = false;
            if ($califusers360) {
                $request = true;
            }
            return $request;
        }

        public function getReporteEvaluacionPersonal()
        {
        }
    }


    ?>