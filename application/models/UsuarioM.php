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

    }
