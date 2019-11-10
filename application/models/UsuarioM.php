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

    }