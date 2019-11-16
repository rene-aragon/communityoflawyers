<?php
    class UsuarioM extends CI_Model {


        public function __construct(){
            parent::__construct();
            $this->load->database();
        }

        function getUsuarioID(){
            $query =    "
                            SELECT
                                *
                            FROM
                                usuario
                        ";
            return $this->db->query($query);

        }

        //=================FUNCIONES DE TIPO POST=================//
        function validatedLogin($email,$contra){
            $query =    "SELECT
                            id_usuario,
                            nombre,
                            apellidoP,
                            apellidoM,
                            email,
                            fechaNac,
                            nombreRol,
                            valuePermission
                        FROM
                            usuario
                            LEFT JOIN(rol) ON usuario.rol_id = rol.id_rol
                        WHERE
                            usuario.email = ".$this->db->escape($email)." AND
                            pass = ".$this->db->escape($contra)."
                        ";
            return $this->db->query($query);
        }

        public function updateUser($id,$data){
            $query =    "UPDATE
                            usuario
                        SET
                            nombre = ".$this->db->escape($data['nombre']).",
                            apellidoP = ".$this->db->escape($data['apellidoP']).",
                            apellidoM = ".$this->db->escape($data['apellidoM']).",
                            email = ".$this->db->escape($data['email']).",
                            fechaNac = ".$this->db->escape($data['fechaNac'])."                            
                        WHERE
                            id_usuario = ".$this->db->escape($id)."
                        ";
            return $this->db->query($query);
        }

        public function changePass($id,$passNew){
            $query =    "UPDATE
                            usuario
                        SET
                            pass = ".$this->db->escape($passNew)."
                        WHERE
                            id_usuario = ".$this->db->escape($id)."
                        ";
            return $this->db->query($query);
        }

        function createAbo($nombre,$apellidoP,$apellidoM,$email,$pass,$fechaNac,$cuentaBanco,$costoBase,$descripcion,$cedulaPro){
            $query =    "INSERT INTO usuario(
                            nombre,
                            apellidoP,
                            apellidoM,
                            email,
                            pass,
                            fechaNac,
                            rol_id
                        )
                        VALUES(
                            ".$this->db->escape($nombre).",
                            ".$this->db->escape($apellidoP).",
                            ".$this->db->escape($apellidoM).",
                            ".$this->db->escape($email).",
                            ".$this->db->escape($pass).",
                            ".$this->db->escape($fechaNac).",
                            2
                        )
                        ";
            $result = $this->db->query($query);
            if($result){
                $utlimoID = $this->db->insert_id();
                $query =    "INSERT INTO abogado(
                                cuentaBanco,
                                costoBase,
                                descripcion,
                                cedulaPro,
                                usuario_id
                            )
                            VALUES(
                                ".$this->db->escape($cuentaBanco).",
                                ".$this->db->escape($costoBase).",
                                ".$this->db->escape($descripcion).",
                                ".$this->db->escape($cedulaPro).",
                                ".$utlimoID."
                            )
                            ";
                $result = $this->db->query($query);
                if($result)
                    $result = $utlimoID;
            }
            return $result;
        }

        function createCli($nombre,$apellidoP,$apellidoM,$email,$pass,$fechaNac,$metodoPago){
            $query =    "INSERT INTO usuario(
                            nombre,
                            apellidoP,
                            apellidoM,
                            email,
                            pass,
                            fechaNac,
                            rol_id
                        )
                        VALUES(
                            ".$this->db->escape($nombre).",
                            ".$this->db->escape($apellidoP).",
                            ".$this->db->escape($apellidoM).",
                            ".$this->db->escape($email).",
                            ".$this->db->escape($pass).",
                            ".$this->db->escape($fechaNac).",
                            3
                        )
                        ";
            $result = $this->db->query($query);
            if($result){
                $utlimoID = $this->db->insert_id();
                $query =    "INSERT INTO cliente(
                                metodoPago,
                                usuario_id
                            )
                            VALUES(
                                ".$this->db->escape($metodoPago).",
                                ".$utlimoID."
                            )
                            ";
                $result = $this->db->query($query);
                if($result)
                    $result = $utlimoID;
            }
            return $result;
        }

        //=================FUNCIONES DE TIPO GET=================//
        function getAbogadoID($id){
            $query =    "SELECT
                            nombre,
                            apellidoP,
                            apellidoM,
                            email,
                            fechaNac,
                            valuePermission,
                            cuentaBanco,
                            costoBase,
                            descripcion,
                            cedulaPro
                        FROM
                            usuario
                            LEFT JOIN(rol) ON usuario.rol_id = rol.id_rol
                            LEFT JOIN(abogado) ON usuario.id_usuario = abogado.usuario_id
                        WHERE
                            usuario.id_usuario = ".$this->db->escape($id)." AND
                            rol.valuePermission = 1
                        ";
            return $this->db->query($query);
        }

        function getClientID($id){
            $query =    "SELECT
                            nombre,
                            apellidoP,
                            apellidoM,
                            email,
                            fechaNac,
                            valuePermission,
                            metodoPago
                        FROM
                            usuario
                            LEFT JOIN(rol) ON usuario.rol_id = rol.id_rol
                            LEFT JOIN(cliente) ON usuario.id_usuario = cliente.usuario_id
                        WHERE
                            usuario.id_usuario = ".$this->db->escape($id)." AND
                            rol.valuePermission = 2
                        ";
            return $this->db->query($query);
        }

        function verifyPassCurrently($id,$passCurrently){
            $query =    "SELECT
                            id_usuario
                        FROM
                            usuario
                        WHERE
                            pass = ".$this->db->escape($passCurrently)." AND
                            id_usuario = ".$this->db->escape($id)."
                        ";
            return $this->db->query($query);
        }

        



    }
?>
