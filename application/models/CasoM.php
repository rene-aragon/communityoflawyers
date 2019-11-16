<?php
    class CasoM extends CI_Model {
        
        
        public function __construct(){
            parent::__construct();
            $this->load->database();
            //$this->load->session();
        }

        public function get_client_id_by_email($data){
            
            $this->db->select('id_usuario');
            $this->db->from('usuario');
            $this->db->where('email',$data);
            $query = $this->db->get()->result_array();
            return ($query)?$query[0]['id_usuario']:false;

        }

        public function create_caso($data){


                return $this->db->insert('caso',$data);
            
            
            
        }

        public function get_casos($data){
            $this->db->select('*');
            $this->db->from('caso');
            $this->db->where('abogado_id',$data);
            $this->db->or_where('cliente_id',$data);
            $query = $this->db->get()->result_array();
            return ($query)?$query[0]['id_usuario']:false;
        }

        public function get_data_cliente($data){
            $this->db->select('*');
            $this->db->from('usuario,cliente');
            $this->db->where('cliente.usuario_id = usuario.id_usuario');
            $this->db->where('usuario.id_usuario',$data);
            $query = $this->db->get()->result_array();
            return ($query)?$query[0]['id_usuario']:false;

        }

        public function get_data_abogado($data){
            $this->db->select('*');
            $this->db->from('usuario,abogado');
            $this->db->where('abogado.usuario_id = usuario.id_usuario');
            $this->db->where('usuario.id_usuario',$data);
            $query = $this->db->get()->result_array();
            return ($query)?$query[0]['id_usuario']:false;

        }

        public function get_categoria(){
            $this->db->select('*');
            $this->db->from('categoria');
          
            $query = $this->db->get()->result_array();
            return ($query)?$query[0]['id_usuario']:false;
        }

        /*  
            NOTA:   Revisar que valores de las llaves foraneas se deben devolver, mientras solo se regresan las llaves 05:02 pm 15/11/19
        */
        public function get_caso_ByID($data){
            $this->db->select('*');
            $this->db->from('caso');
            $this->db->where('id_caso',$data);
            $query = $this->db->get()->result_array();
            return ($query);
        }

        public function get_caso_All(){
            $this->db->select('*');
            $this->db->from('caso');
            $query = $this->db->get()->result_array();
            return ($query);
        }
        
        /*
            NOTA: Cambiar si es necesario la forma de hacer la query
        */
        public function updateCaso($id,$data){
            $query =    "UPDATE
                            caso
                        SET
                        cliente_id = ".$this->db->escape($data['cliente_id']).",
                        categoria_id = ".$this->db->escape($data['categoria_id']).",
                        titulo = ".$this->db->escape($data['titulo']).",
                        descripcion = ".$this->db->escape($data['descripcion'])."
                        WHERE
                            id_caso = ".$this->db->escape($id)."
                        ";
            return $this->db->query($query);
        }

    }
?>