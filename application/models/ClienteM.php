<?php
    class ClienteM extends CI_Model {


        public function __construct(){
            parent::__construct();
            $this->load->database();
            //$this->load->session();
        }

        //=================FUNCIONES DE TIPO POST=================//
        public function updateCliente($id,$data){
            $query =    "UPDATE
                            cliente
                        SET
                            metodoPago = ".$this->db->escape($data['metodoPago'])."
                        WHERE
                            usuario_id = ".$this->db->escape($id)."
                        ";
            return $this->db->query($query);
        }
        //=================FUNCIONES DE TIPO GET=================//

        public function get_Info($data){
            $this->db->select('*');
            $this->db->from('usuario,cliente');
            $this->db->where('cliente.usuario_id = usuario.id_usuario');
            $this->db->where('usuario_id',$data);
            $query = $this->db->get()->result_array();
            return ($query);
        }

        public function get_abogados(){
          $this->db->select('*');
          $this->db->from('usuarios');
          $this->db->where('rol_id',1);
          $query = $this->db->get()->result_array();
          return ($query);
        }

    }

?>
