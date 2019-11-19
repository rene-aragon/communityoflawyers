<?php
    class AbogadoM extends CI_Model {


        public function __construct(){
            parent::__construct();
            $this->load->database();
            //$this->load->session();
        }


        public function get_casos_pendientes($id){
          $this->db->select('caso.id_caso as id_caso, usuario.nombre as nombre, usuario.apellidoP as apellido,
           caso.fecha as fecha, caso.titulo as titulo');
          $this->db->from('caso');
          $this->db->join('usuario', 'usuario.id_usuario = caso.cliente_id', 'inner');
          $this->db->where('caso.abogado_id',$id);
          $edo = 0;
          $this->db->where('caso.estado',$edo);
          return $this->db->get()->result_array();
        }

        public function get_casos_activos($id){
          $this->db->select('caso.id_caso as id_caso, usuario.nombre as nombre, usuario.apellidoP as apellido,
           caso.fecha as fecha, caso.titulo as titulo');
          $this->db->from('caso');
          $this->db->join('usuario', 'usuario.id_usuario = caso.cliente_id', 'inner');
          $this->db->where('caso.abogado_id',$id);
          $edo = 1;
          $this->db->where('caso.estado',$edo);
          return $this->db->get()->result_array();
        }

        public function get_casos_rechazados($id){
          $this->db->select('usuario.nombre as nombre, usuario.apellidoP as apellido,
           caso.fecha as fecha, caso.titulo as titulo');
          $this->db->from('caso');
          $this->db->join('usuario', 'usuario.id_usuario = caso.cliente_id', 'inner');
          $this->db->where('caso.abogado_id',$id);
          $edo = 2;
          $this->db->where('caso.estado',$edo);
          return $this->db->get()->result_array();
        }

        public function get_casos_completos($id){
          $this->db->select('usuario.nombre as nombre, usuario.apellidoP as apellido,
           caso.fecha as fecha, caso.titulo as titulo');
          $this->db->from('caso');
          $this->db->join('usuario', 'usuario.id_usuario = caso.cliente_id', 'inner');
          $this->db->where('caso.abogado_id',$id);
          $edo = 3;
          $this->db->where('caso.estado',$edo);
          return $this->db->get()->result_array();
        }
        //=================FUNCIONES DE TIPO POST=================//
        public function updateAbogado($id,$data){
            $query =    "UPDATE
                            abogado
                        SET
                            cuentaBanco = ".$this->db->escape($data['cuentaBanco']).",
                            costoBase = ".$this->db->escape($data['costoBase']).",
                            descripcion = ".$this->db->escape($data['descripcion']).",
                            cedulaPro = ".$this->db->escape($data['cedulaPro'])."
                        WHERE
                            usuario_id = ".$this->db->escape($id)."
                        ";
            return $this->db->query($query);
        }
        //=================FUNCIONES DE TIPO GET=================//

        public function get_Info($data){
            $this->db->select('*');
            $this->db->from('usuario,abogado');
            $this->db->where('abogado.usuario_id = usuario.id_usuario');
            $this->db->where('usuario_id',$data);
            $query = $this->db->get()->result_array();
            return ($query);
        }

    }

?>
