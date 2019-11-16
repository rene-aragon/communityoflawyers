<?php
    class AbogadoM extends CI_Model {
        
        
        public function __construct(){
            parent::__construct();
            $this->load->database();
            //$this->load->session();
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

    }
?>