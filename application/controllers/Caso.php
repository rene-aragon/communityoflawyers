<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Content-Type: multipart/form-data ; charset=utf-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


use Restserver\libraries\REST_Controller;
use Restserver\libraries\REST_Controller_Definitions;

require APPPATH . '/libraries/REST_Controller_Definitions.php';
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';

class Caso extends CI_Controller{

	use REST_Controller {
		REST_Controller::__construct as private __resTraitConstruct;
    }
    
	public function test_get(){
        $this->load->model('CasoM');
        //$array = $this->UsuarioM->getUsuarioID();
        //$result = $array->result_array();
		//$this->response($result);
	}

    //=================FUNCIONES DE TIPO POST=================//

    public function mostrarDatos(){
        //$email = $this->input->post('email');
        //$id = $this->CasoM->get_client_id_by_email($email);
        //$edo = 1;
        $this->load->model('CasoM');
        $tipo = $this->session->tipo;
        $data = $this->session->id;



	
		$resultId = $this->CasoM->get_casos($data);
		if($resultId != false){
			$respuesta = array("respuesta" => "Se creo el abogado exitosamente","id:" => $resultId,"error" => 0);
		}else{
			$respuesta = array("respuesta" => "Error al crear cliente", "error" => 11);
		}
		$this->response($respuesta);
	}
    
    public function mostrarCaso(){
        //$email = $this->input->post('email');
        //$id = $this->CasoM->get_client_id_by_email($email);
        //$edo = 1;
        $this->load->model('CasoM');

        $data = $this->session->id;

	
		$resultId = $this->CasoM->get_casos($data);
		if($resultId != false){
			$respuesta = array("respuesta" => "Se creo el abogado exitosamente","id:" => $resultId,"error" => 0);
		}else{
			$respuesta = array("respuesta" => "Error al crear cliente", "error" => 11);
		}
		$this->response($respuesta);
	}
	

	public function createCaso_post(){
        $this->load->model('CasoM');
        $email = $this->input->post('email');
        $id = $this->CasoM->get_client_id_by_email($email);
        $edo = 1;

		$data = array(
            'abogado_id' => $this->session->id,
            'cliente_id' => $id[0]['id_usuario'],
            'categoria_id' => $this->input->post('categoria'),
            'titulo' => $this->input->post('titulo'),
            'descripcion' => $this->input->post('descripcion'),
            'estado' => $edo
        );
		$resultId = $this->CasoM->create_caso($data);
		if($resultId != false){
			$respuesta = array("respuesta" => "Se creo el abogado exitosamente","id:" => $resultId,"error" => 0);
		}else{
			$respuesta = array("respuesta" => "Error al crear cliente", "error" => 11);
		}
		$this->response($respuesta);
	}

	
}
