<?php
    class UsuarioM extends CI_Model {


        public function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function get_abogados_inactivos(){
          $this->db->select('usuario.nombre as nombre,
          usuario.apellidoP as apellidop, usuario.apellidoM as apellidom,
          abogado.categoria1 as cat1, abogado.categoria2 as cat2,
          abogado.categoria3 as cat3, id_usuario as id
          ');
          $this->db->from('abogado');
          $this->db->join('usuario', 'usuario.id_usuario = abogado.usuario_id', 'inner');
          $id = 0;
          $this->db->where('usuario.estado',$id);
          return $this->db->get()->result_array();
        }

        public function get_abogados_activos(){
          $this->db->select('usuario.nombre as nombre,
          usuario.apellidoP as apellidop, usuario.apellidoM as apellidom,
          abogado.categoria1 as cat1, abogado.categoria2 as cat2,
          abogado.categoria3 as cat3, id_usuario as id
          ');
          $this->db->from('abogado');
          $this->db->join('usuario', 'usuario.id_usuario = abogado.usuario_id', 'inner');
          $id = 1;
          $this->db->where('usuario.estado',$id);
          return $this->db->get()->result_array();
        }

        public function contactar_abogado($id){
          $this->db->select('usuario.nombre as nombre,
          usuario.apellidoP as apellidop, usuario.apellidoM as apellidom,
          usuario.imagen as imagen,
          abogado.categoria1 as cat1, abogado.categoria2 as cat2,
          abogado.categoria3 as cat3, id_usuario as id
          ');
          $this->db->from('abogado');
          $this->db->join('usuario', 'usuario.id_usuario = abogado.usuario_id', 'inner');
          $this->db->where('usuario.id_usuario',$id);
          return $this->db->get()->result_array();
        }

        public function get_clientes(){
          $this->db->select('*');
          $this->db->from('usuario');
          $edo = 3;
          $this->db->where('rol_id',$edo);
          return $this->db->get()->result_array();
        }

        public function get_admin(){
          $this->db->select('*');
          $this->db->from('usuario');
          $edo = 1;
          $this->db->where('rol_id',$edo);
          return $this->db->get()->result_array();
        }


        function get_categorias(){
          $this->db->select('*');
          $this->db->from('categoria');
          return $this->db->get()->result_array();
        }

        function get_categorias_id($id){
          $this->db->select('*');
          $this->db->from('categoria');
          $this->db->where('categoria_id',$id);
          return $this->db->get()->result_array();
        }

        public function create_user($data){
          $this->db->insert('usuario',$data);
          return $this->db->insert_id();
        }

        public function crearAbogado($data){
          $this->db->insert('abogado',$data);
          return $this->db->insert_id();
        }

        public function crearCliente($data){
          $this->db->insert('cliente',$data);
          return $this->db->insert_id();
        }

        public function delete_usuario($id = null){
            if($id){
                $data = array(
                    'estado' => 0
                );

                $this->db->where('id_usuario',$id);
                $this->db->update('usuario',$data);
            }
        }

        public function aprobar_usuario($id = null){
            if($id){
                $data = array(
                    'estado' => 1
                );

                $this->db->where('id_usuario',$id);
                $this->db->update('usuario',$data);
            }
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

        public function get_user($data){
          $this->db->select('*');
          $this->db->from('usuario');
          $this->db->where('email',$data);
          return $this->db->get()->result_array();
        }



        //=================FUNCIONES DE TIPO POST=================//
        function validatedLogin($email,$contra){
            $query =    "SELECT
                            *
                        FROM
                            usuario
                            LEFT JOIN(rol) ON usuario.rol_id = rol.id_rol
                        WHERE
                            estado = 1 and
                            usuario.email = ".$this->db->escape($email)." AND
                            pass = ".$this->db->escape($contra)."
                        ";
            return $this->db->query($query);
        }

      public function Abo($id = null){

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





    }
?>
